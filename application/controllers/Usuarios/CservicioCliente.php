<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CservicioCliente extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('ServCliente/Layout/Header');
        $this->load->view('ServCliente/Layout/Menu');
        $this->load->view('ServCliente/Index');
        $this->load->view('ServCliente/Layout/Footer');
	}
}
