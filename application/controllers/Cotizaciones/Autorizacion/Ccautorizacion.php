<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccautorizacion extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones/Mautorizacion');    
        $this->load->helper('Cotizador/CalculosGenerales_helper');    
    }


    function autorizar()
    {
        $id_cotizacion = $this->input->post("id_cotizacion");
        $campo = $this->input->post("campo");
        $clientes = $this->input->post("clientes");
        $this->Mautorizacion->autorizar($id_cotizacion,$campo);

        $id_rol = $this->session->userdata('s_id_roles');
        if($id_rol == 2){
            actualizarCotizacion($id_cotizacion,7);
        }

        redirect(base_url()."cotizaciones", 'refresh');

    }

}
