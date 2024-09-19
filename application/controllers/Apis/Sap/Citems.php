<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Citems extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('Sap/my_sap_count_helper');
        $this->load->model('Apis/Mapis');
    }

    /** 
     * Funcion para obtener los registros de los ITEM de SAP
     */
    function getRegistros()
    {
        $conexion = $this->Mapis->getEndPoint(1,2);
        $session_activa = $this->Mapis->getSessionSap();
        if($session_activa)
        {
            $session_id =  $session_activa['session_id'];
            $count = countRegistros($conexion,$session_id);

            log_message('info', '=====> INICIA CONSULTA A LOS ITEMS <=====');
            $url = $conexion['endpoint'];
            $metodo = $conexion['metodo'];
            $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';

            $paginas_reales = round($count);
            $endpoint = $url.$metodo.'?$select=ItemCode,ItemName,ForeignName,ItemsGroupCode,QuantityOnStock,Mainsupplier,U_IsModel,U_Tipo1,U_Tipo2,U_CodeClient,U_numtela,InventoryUOM,ItemWarehouseInfoCollection'; 
            try{

                $client = new \GuzzleHttp\Client(['verify' => false ]);
                $response = $client->request('GET',$endpoint,[
                    'headers' => [
                        'Prefer' => 'odata.maxpagesize='.$paginas_reales,
                        'Cookie' => $cookie
                    ]
                ]);
                
                $success = $response->getBody()->getContents();
                $resp_decode = json_decode($success);
        
                foreach($resp_decode->value as $item){
                    $codigo_sap_articulo = $item->ItemCode;

                    $param['codigo_sap_articulo'] = $codigo_sap_articulo;
                    $param['nombre_articulo'] = $item->ItemName;
                    $param['clave_articulo'] = $item->ForeignName;
                    $param['familia_articulo'] = $item->ItemsGroupCode;
                    $param['en_stock_sap'] = $item->QuantityOnStock;
                    $param['proveedor_linea'] = $item->Mainsupplier;
                    $param['es_pt'] = $item->U_IsModel;
                    $param['tipo_material1'] = $item->U_Tipo1;
                    $param['tipo_material2'] = $item->U_Tipo2;
                    $param['cliente'] = $item->U_CodeClient;
                    $param['numero_tela'] = $item->U_numtela;
                    $param['unidad_costo'] = $item->InventoryUOM;

                    $existe = $this->Mapis->comparaItems($codigo_sap_articulo);
                    if(!$existe){
                        log_message('info', "IOTM registro nuevo : $codigo_sap_articulo");
                        $this->Mapis->registroItems($param);
                        foreach($item->ItemWarehouseInfoCollection as $warehouse){

                            $codigo_sap_articulo;
                            $w_code = $warehouse->WarehouseCode;
                            $w_in_stock = $warehouse->InStock;

                            if(!is_null($codigo_sap_articulo)){

                                $param_w['item_code'] = $codigo_sap_articulo;
                                $param_w['warehouse_code'] = $w_code;
                                $param_w['in_stock'] = $w_in_stock;

                                $existe_w = $this->Mapis->compareWhereHouse($codigo_sap_articulo);

                                if(!$existe_w){
                                    $id_warehoue = $this->Mapis->registroWhereHouse($param_w);
                                    $_id_almacen = $this->Mapis->obtenerIdAlmacen($w_code);
                                    $id_almacen = $_id_almacen['id_almacen'];
                                    $this->Mapis->registroWhereHouseAlmacen($id_warehoue,$id_almacen);
                                }
                            }
                        }
                    }else{
                        log_message('info', "IOTM registro ya existe : $codigo_sap_articulo");
                    }
                }
                redirect(base_url().'sincronizar-apis', 'refresh');
            }catch (Exception $e) {
                $timezone = "America/Mexico_City";
                date_default_timezone_set($timezone);
                log_message('info', "ITEMS REGISTER_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
            }

        }else{
            log_message('info', "CItems_Error: La Sesión no es Valida");
        }
    }

    /**
     * Funcion para obtener el precio costo de los ITEMS
     */
    function getPrecioCosto()
    {
        $conexion = $this->Mapis->getEndPoint(1,2);
        $session_activa = $this->Mapis->getSessionSap();
        if($session_activa)
        {
            $session_id =  $session_activa['session_id'];
           
            $count = countRegistros($conexion,$session_id);
            log_message('info', '=====> INICIA CONSULTA A LAS LISTAS DE PRECIO <=====');
            $url = $conexion['endpoint'];
            $metodo = $conexion['metodo'];
            $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';
            $paginas_reales = round($count);
            $endpoint = $url.$metodo.'?$select=ItemCode,ItemPrices'; 
            try{
                $client = new \GuzzleHttp\Client(['verify' => false ]);
                $response = $client->request('GET',$endpoint,[
                    'headers' => [
                        'Prefer' => 'odata.maxpagesize='.$paginas_reales,
                        'Cookie' => $cookie
                    ]
                ]);
                $success = $response->getBody()->getContents();
                $resp_decode = json_decode($success);
                foreach($resp_decode->value as $item){
                    $param['codigo_sap_articulo'] = $item->ItemCode;

                    foreach($item->ItemPrices as $precio_lista){

                        $p_lista = $precio_lista->PriceList;
                        $precio = $precio_lista->Price;
                        $existe = $this->Mapis->compareListaPrecios($item->ItemCode);
                        if(!$existe){
                            if($p_lista == 10){
                                $param['lista_precio'] = $p_lista;
                                $param['precio_costo'] = $precio;
                                $this->Mapis->registroPlista($param);
                                log_message('info', "LISTA PRECIO registro nuevo : $item->ItemCode");
                            }else{
                                log_message('info', "LISTA DE PREIOS registro ya existe : $item->ItemCode");
                            }
                        }else{

                        }
                       
                    }
                }
                redirect(base_url().'sincronizar-apis', 'refresh');
            }catch (Exception $e) {
                $timezone = "America/Mexico_City";
                date_default_timezone_set($timezone);
                log_message('info', "ITEM LISTA DE PRECIO_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
            }
        }else{
            log_message('info', "Citems Precio Costo: La Sesión no es Valida");
        }
    }
}