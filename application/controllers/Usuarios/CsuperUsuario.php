<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CsuperUsuario extends CI_Controller {

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
	public function index()
	{
          $this->load->view('SuperUsuario/Layout/Header');
          $this->load->view('SuperUsuario/Layout/Menu');
          $this->load->view('SuperUsuario/Index');
          $this->load->view('SuperUsuario/Layout/Footer');
	}
}
