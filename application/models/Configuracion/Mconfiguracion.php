<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mconfiguracion extends CI_Model
{

    function getFijos()
    {
        $this->db->from('conf_fijos');
        $this->db->where('activo',1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}
