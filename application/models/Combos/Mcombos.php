<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mcombos extends CI_Model{
    

    /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getTipoReporte(){
        $this->db->from('cat_tipo_reporte');
        $this->db->where('activo',1);
        $query = $this->db->get(); 
        return $query->result_array();
    }

     /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getAlmacenes($id_tipo_reporte){
        $this->db->from('vis_almacen_tipo_reporte');
        $this->db->where('id_tipo_reporte',$id_tipo_reporte);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getPlantas($id_almacen){
        $this->db->from('vis_almacen_tipo_reporte');
        $this->db->where('id_almacen',$id_almacen);
        $query = $this->db->get(); 
        return $query->result_array();
    }

    /** Funcion para obtener los clientes de
     * la base de datos
     * @return array
     */
    function getClientes(){
        $this->db->from('sap_business_partnes');
        $this->db->like('card_code',"C", 'after');
        $this->db->order_by("card_foreign_name", "asc");
        $query = $this->db->get(); 
        return $query->result_array();
    }

    /** Funcion para obtener los tipos de cotizacion de
     * la base de datos
     * @return array
     */
    function getTipoCotizacion(){
        $this->db->from('cat_tipo_cotizacion');
        $this->db->where('activo',1);
        $this->db->order_by("concepto", "asc");
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getTelas(){
        $this->db->from('vis_precios_telas');
        $query = $this->db->get(); 
        return $query->result_array();
    }

    /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getPatas(){
        $this->db->from('vis_patas');
        $query = $this->db->get(); 
        return $query->result_array();
    }

    /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getHerrajeImp(){
        $this->db->from('vis_herraje_importado');
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
     /** Funcion para la consulta a la base de datos
     * y obtener los registro de dicha consulta
     * @return array
     */
    function getEbasteneria(){
        $this->db->from('vis_ebanesteria');
        $query = $this->db->get(); 
        return $query->result_array();
    }
}
