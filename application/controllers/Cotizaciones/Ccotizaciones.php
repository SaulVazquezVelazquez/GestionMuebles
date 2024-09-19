<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccotizaciones extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones/Mcotizaciones');
    }

    function index()
    {
        $id_rol = $this->session->userdata('s_id_roles');

        $data['items'] = $this->Mcotizaciones->getAllData();
        $data['i'] = 1;
    
        // Definir el directorio base según el rol del usuario
        $directories = [
            2 => 'DirGeneral',
            3 => 'DirComercial',
            4 => 'DirContable',
            12 => 'DirDisenioIngenieria'
        ];
    
        // Determinar el directorio correspondiente al rol del usuario
        $directory = isset($directories[$id_rol]) ? $directories[$id_rol] : null;
    
        // Verificar si se encontró un directorio válido
        if ($directory !== null) {
            $this->load->view("$directory/Layout/Header");
            $this->load->view("$directory/Layout/Menu");
            $this->load->view("$directory/Cotizaciones/Index",$data);
            $this->load->view("$directory/Layout/Footer");
        } else {
            // Manejar el caso cuando el rol no coincide con ningún directorio (opcional)
            // Podrías redirigir a una página de error o mostrar un mensaje.
            show_error('Rol no autorizado', 403);
        }
    }  
	
}
