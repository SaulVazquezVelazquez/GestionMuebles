<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CdireccionContable extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('DirContable/Layout/Header');
        $this->load->view('DirContable/Layout/Menu');
        $this->load->view('DirContable/Index');
        $this->load->view('DirContable/Layout/Footer');
	}
}
