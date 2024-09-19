<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CdireccionDisenioIngenieria extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
		$this->load->view('DirDisenioIngenieria/Layout/Header');
        $this->load->view('DirDisenioIngenieria/Layout/Menu');
        $this->load->view('DirDisenioIngenieria/Index');
        $this->load->view('DirDisenioIngenieria/Layout/Footer');
	}
}
