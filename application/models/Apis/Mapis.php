<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mapis extends CI_Model
{
    /**
     * Funcion que nos dira si existe una session activa de SAP
     * @return Array|Boolean
     */
    function getSessionSap()
    {
        $this->db->from('sap_session');
        $this->db->where('activo', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * Funcion para obtener las claves de los endpoint
     * de acuerdo al flujo que corresponde
     * @param int $flujo valor que debemos enviar para verificar el flujo que deseamos consultar
     * @return Array|Boolean
     */
    function getEndPoint($flujo,$flujo_metodo)
    {
        if(empty($flujo) || is_null($flujo)){
            return false;
        }else{
            $this->db->from('vis_endpoint_metodo');
            $this->db->where('flujo', $flujo);
            $this->db->where('flujo_metodo', $flujo_metodo);
            $this->db->where('endpoint_activo', 1);
            $this->db->where('metodo_activo', 1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return false;
            }
        }
    }

    /**
     * Funcion para el guardado de la sesion que nos genera SAP
     * Para poder consultar otras apis
     * @param String $sessionId: Valor que nos regresa la peticion de SAP al hacer login
     * @param Int $sessionTimeout: Valor de la duración de la sesion de SAP
     */
    function registroSession($sessionId,$sessionTimeout)
    {
        $campos = array(
            'session_id' => $sessionId,
            'session_timeout' => $sessionTimeout,
            'activo' => TRUE,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_session', $campos);
    }

    /**
     * Funcion para el regitro de los item que obtenemos de SAP
     * @param Array $params: Arreglo de datos a registrar
     */
    function registroItems($params)
    {
        $codigo_sap_articulo = isset($params['codigo_sap_articulo']) ? $params['codigo_sap_articulo'] : null;
        $nombre_articulo = isset($params['nombre_articulo']) ? $params['nombre_articulo'] : null;
        $clave_articulo = isset($params['clave_articulo']) ? $params['clave_articulo'] : null;
        $numero_tela = isset($params['numero_tela']) ? $params['numero_tela'] : null;
        $familia_articulo = isset($params['familia_articulo']) ? $params['familia_articulo'] : null;
        $en_stock_sap = isset($params['en_stock_sap']) ? $params['en_stock_sap'] : null;
        $proveedor_linea = isset($params['proveedor_linea']) ? $params['proveedor_linea'] : null;
        $es_pt = isset($params['es_pt']) ? $params['es_pt'] : null;
        $tipo_material1 = isset($params['tipo_material1']) ? $params['tipo_material1'] : null;
        $tipo_material2 = isset($params['tipo_material2']) ? $params['tipo_material2'] : null;
        $cliente = isset($params['cliente']) ? $params['cliente'] : null;
        $unidad_costo = isset($params['unidad_costo']) ? $params['unidad_costo'] : null;
       
        $campos = array(
            'codigo_sap_articulo' => $codigo_sap_articulo,
            'nombre_articulo' => $nombre_articulo,
            'clave_articulo' => $clave_articulo,
            'numero_tela' => $numero_tela,
            'familia_articulo' => $familia_articulo,
            'en_stock_sap' => $en_stock_sap,
            'proveedor_linea' => $proveedor_linea,
            'es_pt' => $es_pt ,
            'tipo_material1' => $tipo_material1,
            'tipo_material2' => $tipo_material2,
            'cliente' => $cliente,
            'unidad_costo' => $unidad_costo,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO'),
        );
        $this->db->insert('sap_oitm', $campos);
    }

    /**
     * Funcion para validar si ya existe un ITEM en el sistema
     * @param String $codigo_sap: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function comparaItems($codigo_sap)
    {
        $this->db->from('sap_oitm');
        $this->db->where('codigo_sap_articulo', $codigo_sap);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para el registro de la lista de precios y precios de los
     * productos que tenemos en SAP
     * @param Array $param: arrglo de datos para el registro de la base de datos
     */
    function registroPlista($params)
    {
        $codigo_sap_articulo = isset($params['codigo_sap_articulo']) ? $params['codigo_sap_articulo'] : null;
        $lista_precio = isset($params['lista_precio']) ? $params['lista_precio'] : null;
        $precio_costo = isset($params['precio_costo']) ? $params['precio_costo'] : null;

        $campos = array(
            'codigo_sap_articulo' => $codigo_sap_articulo,
            'lista_precio' => $lista_precio,
            'precio_costo' => $precio_costo,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_itm1', $campos);
    }

    /**
     * Funcion para validar si ya existe una lista de precios
     * @param String $codigo_sap_articulo: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function compareListaPrecios($codigo_sap_articulo)
    {
        $this->db->from('sap_itm1');
        $this->db->where('codigo_sap_articulo', $codigo_sap_articulo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para el registro de la lista de precios y precios de los
     * productos que tenemos en SAP
     * @param Array $param: arrglo de datos para el registro de la base de datos
     */
    function registroFamiliaGrupo($familia_articulo,$familia_descripcion)
    {

        $campos = array(
            'familia_articulo' => $familia_articulo,
            'familia_descripcion' => $familia_descripcion,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_oitb', $campos);
    }

    /**
     * Funcion para validar si ya existe una lista de precios
     * @param String $familia_articulo: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function compareFamiliaArticulo($familia_articulo)
    {
        $this->db->from('sap_oitb');
        $this->db->where('familia_articulo', $familia_articulo);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para validar si ya existe una lista de precios
     * @param String $father: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function compareThreeItem($father,$code)
    {
        $this->db->from('sap_ittm1');
        $this->db->where('fhater', $father);
        $this->db->where('code', $code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para el registro del arbol de prdocutos obtenidos por SAP
     * @param Array $param: arrglo de datos para el registro de la base de datos
     */
    function registroThreeItem($params)
    {

        $father = isset($params['father']) ? $params['father'] : null;
        $code = isset($params['code']) ? $params['code'] : null;
        $quantity = isset($params['quantity']) ? $params['quantity'] : null;


        $campos = array(
            'fhater' => $father,
            'code' => $code,
            'quantity' => $quantity,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_ittm1', $campos);
    }

    /**
     * Funcion para el registro del warehouses por SAP
     * @param Array $param: arrglo de datos para el registro de la base de datos
     * @return Int
     */
    function registroWhereHouse($params)
    {

        $item_code = isset($params['item_code']) ? $params['item_code'] : null;
        $warehouse_code = isset($params['warehouse_code']) ? $params['warehouse_code'] : null;
        $in_stock = isset($params['in_stock']) ? $params['in_stock'] : null;

        $campos = array(
            'item_code' => $item_code,
            'warehouse_code' => $warehouse_code,
            'in_stock' => $in_stock,
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_warehouse', $campos);
        return $this->db->insert_id();
    }

    /** 
     * Funcion que busca y obtenemos el ID del almacen
     * @return Aarray|Boolean
     * */
    function obtenerIdAlmacen($w_code)
    {
        $this->db->from('cat_almacen');
        $this->db->where('codigo', $w_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * Funcion para el registro del werehouse relacionado al producto y almacen
     * @param Int $id_werehouse
     * @param Int $id_almacen
     */
    function registroWhereHouseAlmacen($id_warehoue,$id_almacen)
    {
        $campos = array(
            'id_warehouse' => $id_warehoue,
            'id_almacen' => $id_almacen
        );
        $this->db->insert('rom_warehouse_has_almacen', $campos);
    }

    /**
     * Funcion para validar si ya existe un codigo en werehouse
     * @param String $item_code: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function compareWhereHouse($item_code)
    {
        $this->db->from('sap_warehouse');
        $this->db->where('item_code', $item_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para validar si ya existe una lista de precios
     * @param String $familia_articulo: Valor que nos da SAP en su base de datos
     * @return Boolean
     */
    function compareBusinessPartner($card_code)
    {
        $this->db->from('sap_business_partnes');
        $this->db->where('card_code', $card_code);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion para el registro de la lista de precios y precios de los
     * productos que tenemos en SAP
     * @param Array $param: arrglo de datos para el registro de la base de datos
     */
    function registroBusinessPartner($param)
    {

        $campos = array(
            'card_code' => $param['card_code'],
            'card_name' => $param['card_name'],
            'card_foreign_name' => $param['card_foreign_name'],
            'contact_employee' => $param['contact_employee'],
            'f_sincronizacion' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('sap_business_partnes', $campos);
    }
}
