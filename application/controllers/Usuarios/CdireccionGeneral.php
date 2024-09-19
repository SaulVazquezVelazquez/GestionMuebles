<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CdireccionGeneral extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('DirGeneral/Layout/Header');
        $this->load->view('DirGeneral/Layout/Menu');
        $this->load->view('DirGeneral/Index');
        $this->load->view('DirGeneral/Layout/Footer');
	}
}
