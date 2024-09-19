<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coitb extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Sap/my_sap_count_helper');
        $this->load->model('Apis/Mapis');
    }

    /**
     * Funcion para obtener los registro de la tabla OITB de SAP
     */
    function getRegistros()
    {
        $conexion = $this->Mapis->getEndPoint(1,3);
        $session_activa = $this->Mapis->getSessionSap();
        if($session_activa)
        {
            $session_id =  $session_activa['session_id'];
            $count = countRegistros($conexion,$session_id);
            log_message('info', '=====> INICIA CONSULTA A LOS GRUPOS DE ITEMS <=====');
            $url = $conexion['endpoint'];
            $metodo = $conexion['metodo'];
            $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';
            $paginas_reales = round($count);
            $endpoint = $url.$metodo.'?$select=GroupName,Number'; 
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
                    $familia_articulo = $item->Number;
                    $familia_descripcion = $item->GroupName;

                    $existe = $this->Mapis->compareFamiliaArticulo($familia_articulo);
                    if(!$existe){
                        log_message('info', "OITB registro nuevo : $familia_articulo");
                        $this->Mapis->registroFamiliaGrupo($familia_articulo,$familia_descripcion);
                    }else{
                        log_message('info', "OITB registro ya existe : $familia_articulo");
                    }
                }
                redirect(base_url().'sincronizar-apis', 'refresh');
            }catch (Exception $e) {
                $timezone = "America/Mexico_City";
                date_default_timezone_set($timezone);
                log_message('info', "OITB REGISTER_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
            }
        }else{
            log_message('info', "CItems_Error: La Sesión no es Valida");
        }
    }
}