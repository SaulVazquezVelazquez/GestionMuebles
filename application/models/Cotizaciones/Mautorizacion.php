<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mautorizacion extends CI_Model
{

    function autorizar($id_cotizacion,$campo)
    {
        $campos = array(
            $campo => 1
        );

        $this->db->where('id_cotizacion', $id_cotizacion);
        $this->db->update('ent_cotizacion', $campos);
    }
}
