<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class Cclaves extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Claves/Mclaves');
    }

    function index()
	{
        $id_rol = $this->session->userdata('s_id_roles');
        $data['items'] = $this->Mclaves->getAllClaves();
        $data['i'] = 1;
        
        if($id_rol == 12){
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Claves/Index',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }elseif($id_rol == 13){
            $this->load->view('Disenio/Layout/Header');
            $this->load->view('Disenio/Layout/Menu');
            $this->load->view('Disenio/Claves/Index',$data);
            $this->load->view('Disenio/Layout/Footer');
        } else{} 
	}

    function actualizar()
    {
        $id_claves = $this->input->post('id_claves');
        $mano_obra = $this->input->post('mano_obra');
        $mts_1 = $this->input->post('mts_1');
        $mts_2 = $this->input->post('mts_2');
        $mts_3 = $this->input->post('mts_3');
        $mts_4 = $this->input->post('mts_4');
        $pata_1 = $this->input->post('pata_1');
        $pata_2 = $this->input->post('pata_2');
        $herraje_1 = $this->input->post('herraje_1');
        $herraje_2 = $this->input->post('herraje_2');
        $ebanisteria_1 = $this->input->post('ebanisteria_1');
        $ebanisteria_2 = $this->input->post('ebanisteria_2');
        $ebanisteria_3 = $this->input->post('ebanisteria_3');

         // Datos a actualizar
         $data = array(
            'mano_de_obra' => $mano_obra,
            'mts_1' => $mts_1,
            'mts_2' => $mts_2,
            'mts_3' => $mts_3,
            'mts_4' => $mts_4,
            'pata_1' => $pata_1,
            'pata_2' => $pata_2,
            'herraje_1' => $herraje_1,
            'herraje_2' => $herraje_2,
            'ebanisteria_1' => $ebanisteria_1,
            'ebanisteria_2' => $ebanisteria_2,
            'ebanisteria_3' => $ebanisteria_3,
            'u_registro' => $this->session->userdata('s_id_sesiones'),
            'u_nom_usuario' => $this->session->userdata('s_usuario')
        );

        // Llamar al modelo para actualizar
        $result = $this->Mclaves->actualizar($id_claves, $data);
        redirect(base_url()."claves", 'refresh');

    }

    function registrar()
    {
        $concepto = $this->input->post('clave');
        $mano_obra = $this->input->post('mano_obra');
        $mts_1 = $this->input->post('mts_1');
        $mts_2 = $this->input->post('mts_2');
        $mts_3 = $this->input->post('mts_3');
        $mts_4 = $this->input->post('mts_4');
        $pata_1 = $this->input->post('pata_1');
        $pata_2 = $this->input->post('pata_2');
        $herraje_1 = $this->input->post('herraje_1');
        $herraje_2 = $this->input->post('herraje_2');
        $ebanisteria_1 = $this->input->post('ebanisteria_1');
        $ebanisteria_2 = $this->input->post('ebanisteria_2');
        $ebanisteria_3 = $this->input->post('ebanisteria_3');

        $param['concepto'] = $concepto;
        $param['mano_de_obra'] = $mano_obra;
        $param['mts_1'] = $mts_1; 
        $param['mts_2'] = $mts_2;
        $param['mts_3'] = $mts_3;
        $param['mts_4'] = $mts_4;
        $param['pata_1'] = $pata_1;
        $param['pata_2'] = $pata_2;
        $param['herraje_1'] = $herraje_1;
        $param['herraje_2'] = $herraje_2;
        $param['ebanisteria_1'] = $ebanisteria_1;
        $param['ebanisteria_2'] = $ebanisteria_2;
        $param['ebanisteria_3'] = $ebanisteria_3;
        $param['u_registro'] = $this->session->userdata('s_id_sesiones');
        $param['u_nom_usuario'] = $this->session->userdata('s_usuario');

        $this->Mclaves->registro($param);
        redirect(base_url()."claves", 'refresh');
       
    }
}
