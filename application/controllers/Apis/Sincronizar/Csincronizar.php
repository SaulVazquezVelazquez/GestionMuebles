<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Csincronizar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Funcion para cargar la vista principal
     * para la sincronizacion de los servicios de SAP HANA
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    public function index()
    {
        $this->load->view('SuperUsuario/Layout/Header');
        $this->load->view('SuperUsuario/Layout/Menu');
        $this->load->view('SuperUsuario/Configuracion/Apis/Index');
        $this->load->view('SuperUsuario/Layout/Footer');
    }
}
