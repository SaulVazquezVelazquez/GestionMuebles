<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccombos extends CI_Controller {

	function __construct(){
        parent::__construct();  
        $this->load->model('Combos/Mcombos');
        
    }

    /**
     * Funcion para obtener los tipos de reporte de la base de datos
     * @return array
     */
    function getTipoReporte()
    {
        $resultado = $this->Mcombos->getTipoReporte();
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener los almacenes de la base de datos
     * @return Array
     */
    function getAlmacenes()
    {
        $id_tipo_reporte = $this->input->post('id_tipo_reporte');
        $resultado = $this->Mcombos->getAlmacenes($id_tipo_reporte);
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener las plantas de la base de datos
     * @return Array
     */
    function getPlantas()
    {
        $id_almacen = $this->input->post('id_almacen');
        $resultado = $this->Mcombos->getPlantas($id_almacen);
        echo json_encode($resultado);
    }

    /**
     * funcion para obtener los clientes de la base de datos
     * @return array
     */
    function getClientes()
    {
        $resultado = $this->Mcombos->getClientes();
        echo json_encode($resultado);
    }

     /**
     * funcion para obtener los tipos de cotización
     * @return array
     */
    function getTipoCotizacion()
    {
        $resultado = $this->Mcombos->getTipoCotizacion();
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener los tipos de telas
     * @return array
     */
    function getTelas()
    {
        $resultado = $this->Mcombos->getTelas();
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener los tipos de patas
     * @return array
     */
    function getPatas()
    {
        $resultado = $this->Mcombos->getPatas();
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener los tipos de herrajes importados
     * @return array
     */
    function getHerrajeImp()
    {
        $resultado = $this->Mcombos->getHerrajeImp();
        echo json_encode($resultado);
    }

    /**
     * Funcion para obtener los tipos de ebanesteria
     * @return array
     */
    function getEbasteneria()
    {
        $resultado = $this->Mcombos->getEbasteneria();
        echo json_encode($resultado);
    }


   
}