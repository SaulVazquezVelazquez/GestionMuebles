<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdisenio extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('Disenio/Layout/Header');
        $this->load->view('Disenio/Layout/Menu');
        $this->load->view('Disenio/Index');
        $this->load->view('Disenio/Layout/Footer');
	}
}
