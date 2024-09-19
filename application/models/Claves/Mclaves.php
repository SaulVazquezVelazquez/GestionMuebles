<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mclaves extends CI_Model
{

    function getAllClaves()
    {
        $this->db->from('cat_claves');
        $this->db->order_by('concepto',"Asc");
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function actualizar($id_claves, $data)
    {
         // Actualizar registro en la tabla 'cat_claves'
         $this->db->where('id_claves', $id_claves);
         $this->db->update('cat_claves', $data);
 
         // Verificar si se actualizó correctamente
         return $this->db->affected_rows() > 0;
    }

    function registro($param)
    {
        $this->db->insert('cat_claves', $param);
        
    }
    
}
