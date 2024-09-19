<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CdireccionPlanta extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('DirPlanta/Layout/Header');
        $this->load->view('DirPlanta/Layout/Menu');
        $this->load->view('DirPlanta/Index');
        $this->load->view('DirPlanta/Layout/Footer');
	}
}
