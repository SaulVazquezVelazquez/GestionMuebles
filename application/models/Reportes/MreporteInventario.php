<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MreporteInventario extends CI_Model
{

       /**
     * Funcion para obtener los datos para generar el reporte
     * @return Array|Boolean
     */
    function getDatosReporte($id_almacen,$id_planta)
    {
        $this->db->from('vis_reporte_almacen_mp_116');
        $this->db->where('id_almacen', $id_almacen);
        $this->db->where('id_plantas', $id_planta);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Funcion para obtener los datos para generar el reporte
     * @return Array|Boolean
     */
    function getDatosGeneral($tipo_reporte,$id_almacen,$id_planta)
    {
        $this->db->from('vis_almacen_tipo_reporte');
        $this->db->where('id_almacen', $id_almacen);
        $this->db->where('id_plantas', $id_planta);
        $this->db->where('id_plantas', $tipo_reporte);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    
}
