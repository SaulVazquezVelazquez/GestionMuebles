<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mcotizaciones extends CI_Model
{

    function getAllData()
    {
        $this->db->from('vis_cotizaciones');
        $this->db->order_by('id_cotizacion', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
