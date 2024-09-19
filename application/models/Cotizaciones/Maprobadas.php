<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Maprobadas extends CI_Model
{

    function getAllData()
    {
        $this->db->from('vis_cotizaciones_aprobadas');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function aproba($id_detalle_cotizacion,$margen,$descripcion,$param)
    {

        
        $campos = array(
            'gastos_uni' => $param['gastos_uni'],
            'nom_uni' => $param['nom_uni'],
            'desc_uni' => $param['desc_uni'],
            'gast_fin_uni' => $param['gast_fin_uni'],
            'flete_uni' => $param['flete_uni'],
            'comision' => $param['comision'],
            'costo_total' => $param['costo_total'],
            'margen' => $margen,
            'precio_sugerido' => $param['precio_sugerido'],
            'observaciones' => $descripcion
        );

        $this->db->where('id_detalle_cotizacion', $id_detalle_cotizacion);
        $this->db->update('cat_detalle_cotizacion', $campos);
    }

    function getDataItemByIdCot($id_cotizacion)
    {
        $this->db->from('vis_detalle_cotizacion_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getItemByItems($id_cotizacion)
    {
        $this->db->from('vis_detalle_cotizacion_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function getByCodigoSAP($concepto)
    {
        $this->db->select('id_claves,concepto,u_registro,u_nom_usuario');
        $this->db->from('vis_cotizacion_claves');
        $this->db->where('concepto',$concepto);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function getCliente($id_cotizacion)
    {

        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function getDataItemByIdCotAprobadas($id_cotizacion)
    {
        $this->db->from('vis_detalle_cotizacion_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $this->db->where('estatus',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
