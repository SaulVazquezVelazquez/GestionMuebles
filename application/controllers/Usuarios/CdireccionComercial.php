<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CdireccionComercial extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('DirComercial/Layout/Header');
        $this->load->view('DirComercial/Layout/Menu');
        $this->load->view('DirComercial/Index');
        $this->load->view('DirComercial/Layout/Footer');
	}
}
