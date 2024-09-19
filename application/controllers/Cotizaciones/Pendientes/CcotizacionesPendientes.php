<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
class CcotizacionesPendientes extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones/McotPendientes');
        $this->load->model('Cotizador/Mcotizador');
        $this->load->model('Configuracion/Mconfiguracion');
        $this->load->helper('Cotizador/cotizador_helper');
        $this->load->helper('Cotizador/CalculosGenerales_helper');
    }

	/**
     * Controlador principal para la página de inicio del módulo de Cotizaciones Pendientes.
     *
     * Carga los datos necesarios según el rol del usuario actual y renderiza la vista correspondiente.
     *
     * Si el rol del usuario es 2 (Director General), carga las vistas y datos específicos para ese rol.
     * Si el rol no es 2, asume que pertenece al módulo de Diseño e Ingeniería y carga las vistas y datos correspondientes.
     *
     * @return void
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @throws No lanza excepciones explícitamente.
     *
     * @description
     * Esta función verifica el rol del usuario actual utilizando la sesión de CodeIgniter.
     * Carga los datos de cotizaciones pendientes utilizando el modelo McotPendientes.
     * Luego, selecciona y carga las vistas adecuadas según el rol del usuario para mostrar los datos.
     */
    function index()
	{
        $id_rol = $this->session->userdata('s_id_roles');
        $data['items'] = $this->McotPendientes->getAllData();
        $data['i'] = 1;
        
        if($id_rol == 2 ){
            $this->load->view('DirGeneral/Layout/Header');
            $this->load->view('DirGeneral/Layout/Menu');
            $this->load->view('DirGeneral/Cotizaciones/Pendientes/Index',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }else{
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Cotizaciones/Pendientes/Index',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }

        
	}

    /**
     * Detalle de la cotización pendiente según el rol del usuario.
     *
     * Carga los detalles específicos de una cotización pendiente basándose en el rol del usuario actual.
     * Obtiene y calcula las condiciones comerciales asociadas al cliente de la cotización.
     * Renderiza la vista correspondiente según el rol del usuario para mostrar los detalles de la cotización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param int $id_cotizacion ID de la cotización pendiente.
     * @param int $clientes ID del cliente asociado a la cotización.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función verifica el rol del usuario actual utilizando la sesión de CodeIgniter.
     * Obtiene las condiciones comerciales del cliente utilizando el modelo Mcotizador.
     * Calcula el factor de cotización a partir de las condiciones comerciales utilizando la función granTotal().
     * Carga los detalles de los ítems de la cotización utilizando el modelo McotPendientes.
     * Finalmente, selecciona y carga las vistas adecuadas según el rol del usuario para mostrar los detalles de la cotización.
     *
     * Ejemplo de uso:
     * ```php
     * // Esta función se ejecuta automáticamente al acceder a la URL del controlador correspondiente.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function detalle()
    {
        $id_rol = $this->session->userdata('s_id_roles');

        $id_cotizacion = $this->uri->segment(2);
        
        $clientes = $this->uri->segment(3);

        $condicionesComerciales= getCondicionComercial($clientes);
        $data['factor_cotizacion'] = granTotal($condicionesComerciales);
        $data['condiciones_comerciales'] = $condicionesComerciales;
        $item = $this->McotPendientes->getDataItemByIdCot($id_cotizacion);
        $data['items'] = $item;
       
        $data['id_cotizacion'] =  $id_cotizacion;
        $data['kist'] = $this->Mcotizador->getAllKits($id_cotizacion);
    
        $nuevo_arreglo_patas = array();
        $pata_total_uno = 0;
        $pata_total_dos = 0;

        if ($item[0]["id_pata_uno"] !== null) {
            $pata_total_uno = $item[0]["pz_pata_uno"] * $item[0]["precio_costo_pata_uno"];
            $nuevo_arreglo_patas[] = array(
                "id" => $item[0]["id_pata_uno"],
                "clave" => $item[0]["clave_pata_uno"],
                "nombre" => $item[0]["nombre_pata_uno"],
                "piezas" => $item[0]["pz_pata_uno"],
                "precio_costo" => $item[0]["precio_costo_pata_uno"],
                "importe_total" => $item[0]["importe_pata_uno"]
            );
        }

        if ($item[0]["id_pata_dos"] !== null) {
            $pata_total_dos = $item[0]["pz_pata_dos"] * $item[0]["precio_costo_pata_dos"];
            $nuevo_arreglo_patas[] = array(
                "id" => $item[0]["id_pata_dos"],
                "clave" => $item[0]["clave_pata_dos"],
                "nombre" => $item[0]["nombre_pata_dos"],
                "piezas" => $item[0]["pz_pata_dos"],
                "precio_costo" => $item[0]["precio_costo_pata_dos"],
                "importe_total" => $item[0]["importe_pata_dos"]
            );
        }

        $nuevo_arreglo_herraje_i = array();
        if ($item[0]["id_herraje_uno"] !== null) {
            $nuevo_arreglo_herraje_i[] = array(
                "id" => $item[0]["id_herraje_uno"],
                "clave" => $item[0]["clave_herraje_uno"],
                "nombre" => $item[0]["nombre_herraje_uno"],
                "piezas" => $item[0]["pz_herraje_uno"],
                "precio_costo" => $item[0]["precio_costo_herraje_uno"],
                "importe_total" => $item[0]["importe_herraje_uno"]
            );
        }

        if ($item[0]["id_herraje_dos"] !== null) {
            $nuevo_arreglo_herraje_i[] = array(
                "id" => $item[0]["id_herraje_dos"],
                "clave" => $item[0]["clave_herraje_dos"],
                "nombre" => $item[0]["nombre_herraje_dos"],
                "piezas" => $item[0]["pz_herraje_dos"],
                "precio_costo" => $item[0]["precio_costo_herraje_dos"],
                "importe_total" => $item[0]["importe_herraje_dos"]
            );
        }

        $nuevo_arreglo_ebanisteria = array();
        $ebanesteria_total_uno = 0;
        $ebanesteria_total_dos = 0;
        $ebanesteria_total_tres = 0;
        if ($item[0]["id_ebanesteria_uno"] !== null) {
            $ebanesteria_total_uno = $item[0]["pz_ebanesteria_uno"]*$item[0]["precio_costo_ebanesteria_uno"];
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_uno"],
                "clave" => $item[0]["clave_ebanesteria_uno"],
                "nombre" => $item[0]["nombre_ebanesteria_uno"],
                "piezas" => $item[0]["pz_ebanesteria_uno"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_uno"],
                "importe_total" => $item[0]["importe_ebanesteria_uno"]
            );
        }

        if ($item[0]["id_ebanesteria_dos"] !== null) {
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_dos"],
                "clave" => $item[0]["clave_ebanesteria_dos"],
                "nombre" => $item[0]["nombre_ebanesteria_dos"],
                "piezas" => $item[0]["pz_ebanesteria_dos"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_dos"],
                "importe_total" => $item[0]["importe_ebanesteria_dos"]
            );
        }

        if ($item[0]["id_ebanesteria_tres"] !== null) {
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_tres"],
                "clave" => $item[0]["clave_ebanesteria_tres"],
                "nombre" => $item[0]["nombre_ebanesteria_tres"],
                "piezas" => $item[0]["pz_ebanesteria_tres"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_tres"],
                "importe_total" => $item[0]["importe_ebanesteria_tres"]
            );
        }

        $nuevo_arreglo_telas = array();
        if ($item[0]["id_tela_uno"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_uno"],
                "clave" => $item[0]["clave_tela_uno"],
                "nombre" => $item[0]["nombre_tela_uno"],
                "piezas" => $item[0]["mts_uno"],
                "precio_costo" => $item[0]["precio_costo_uno"],
                "importe_total" => $item[0]["importe_uno"]
            );
        }

        if ($item[0]["id_tela_dos"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_dos"],
                "clave" => $item[0]["clave_tela_dos"],
                "nombre" => $item[0]["nombre_tela_dos"],
                "piezas" => $item[0]["mts_dos"],
                "precio_costo" => $item[0]["precio_costo_dos"],
                "importe_total" => $item[0]["importe_dos"]
            );
        }

        if ($item[0]["id_tela_tres"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_tres"],
                "clave" => $item[0]["clave_tela_tres"],
                "nombre" => $item[0]["nombre_tela_tres"],
                "piezas" => $item[0]["mts_tres"],
                "precio_costo" => $item[0]["precio_costo_tres"],
                "importe_total" => $item[0]["importe_tres"]
            );
        }

        if ($item[0]["id_tela_cuatro"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_cuatro"],
                "clave" => $item[0]["clave_tela_cuatro"],
                "nombre" => $item[0]["nombre_tela_cuatro"],
                "piezas" => $item[0]["mts_cuatro"],
                "precio_costo" => $item[0]["precio_costo_cuatro"],
                "importe_total" => $item[0]["importe_cuatro"]
            );
        }


        $data['patas'] = $nuevo_arreglo_patas;
        $data['herrajeI'] = $nuevo_arreglo_herraje_i;
        $data['ebanesteria'] = $nuevo_arreglo_ebanisteria;
        $data['telas'] = $nuevo_arreglo_telas;

        if($id_rol == 2){
            $this->load->view('DirGeneral/Layout/Header');
            $this->load->view('DirGeneral/Layout/Menu');
            $this->load->view('DirGeneral/Cotizaciones/Pendientes/Detalle',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }elseif($id_rol == 3){
            $this->load->view('DirComercial/Layout/Header');
            $this->load->view('DirComercial/Layout/Menu');
            $this->load->view('DirComercial/Cotizaciones/Pendientes/Detalle',$data);;
            $this->load->view('DirComercial/Layout/Footer');
        }elseif($id_rol == 12){
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Cotizaciones/Pendientes/Detalle',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }elseif($id_rol == 4){
            $this->load->view('DirContable/Layout/Header');
            $this->load->view('DirContable/Layout/Menu');
            $this->load->view('DirContable//Cotizaciones/Pendientes/Detalle',$data);
            $this->load->view('DirContable/Layout/Footer');
        }else{}
        
        
    }

    /**
     * Detalle del ítem de la cotización pendiente según el rol del usuario.
     *
     * Carga los detalles específicos de un ítem de cotización pendiente basándose en el rol del usuario actual.
     * Obtiene detalles de kits, herrajes, patas, ebanisterías y telas asociadas al ítem.
     * Calcula sumatorias y totales necesarios para la vista de detalle del ítem.
     * Renderiza la vista correspondiente según el rol del usuario para mostrar el detalle del ítem de la cotización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param int $codigo_sap_articulo Código SAP del artículo asociado al ítem.
     * @param int $id_cotizacion ID de la cotización pendiente.
     * @param int $id_detalle_cotizacion ID del detalle de la cotización.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función verifica el rol del usuario actual utilizando la sesión de CodeIgniter.
     * Obtiene detalles específicos de kits, herrajes, patas, ebanisterías y telas asociadas al ítem utilizando los modelos Mcotizador y McotPendientes.
     * Calcula totales y sumatorias necesarios para la vista de detalle del ítem.
     * Finalmente, selecciona y carga las vistas adecuadas según el rol del usuario para mostrar el detalle del ítem de la cotización.
     *
     * Ejemplo de uso:
     * ```php
     * // Esta función se ejecuta automáticamente al acceder a la URL del controlador correspondiente.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function detalleItem()
    {
        $id_rol = $this->session->userdata('s_id_roles');

        $codigo_sap_articulo = $this->uri->segment(2);
        $id_cotizacion = $this->uri->segment(3);
        $id_detalle_cotizacion = $this->uri->segment(4);
        

        $KIT_HAB_ = "KIT-HAB-".$codigo_sap_articulo;
        $KIT_HUL_ = "KIT-HUL-".$codigo_sap_articulo;
        $KIT_MP_ = "KIT-MP-".$codigo_sap_articulo;

        $kitHab = $this->Mcotizador->getKitDetalle($KIT_HAB_,$codigo_sap_articulo);
        $kitHul = $this->Mcotizador->getKitDetalle($KIT_HUL_,$codigo_sap_articulo);
        $KitMp = $this->Mcotizador->getKitDetalle($KIT_MP_,$codigo_sap_articulo);

        $herrajeN = $this->Mcotizador->getItemByFamilia($KIT_MP_,109); 

        $item = $this->McotPendientes->getItemByItems($id_detalle_cotizacion);
        $cliente = $this->McotPendientes->getCliente($id_cotizacion);

        $nuevo_arreglo_telas = array();
        if ($item[0]["id_tela_uno"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_uno"],
                "clave" => $item[0]["clave_tela_uno"],
                "nombre" => $item[0]["nombre_tela_uno"],
                "piezas" => $item[0]["mts_uno"],
                "precio_costo" => $item[0]["precio_costo_uno"],
                "importe_total" => $item[0]["importe_uno"]
            );
        }

        if ($item[0]["id_tela_dos"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_dos"],
                "clave" => $item[0]["clave_tela_dos"],
                "nombre" => $item[0]["nombre_tela_dos"],
                "piezas" => $item[0]["mts_dos"],
                "precio_costo" => $item[0]["precio_costo_dos"],
                "importe_total" => $item[0]["importe_dos"]
            );
        }

        if ($item[0]["id_tela_tres"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_tres"],
                "clave" => $item[0]["clave_tela_tres"],
                "nombre" => $item[0]["nombre_tela_tres"],
                "piezas" => $item[0]["mts_tres"],
                "precio_costo" => $item[0]["precio_costo_tres"],
                "importe_total" => $item[0]["importe_tres"]
            );
        }

        if ($item[0]["id_tela_cuatro"] !== null) {
            $nuevo_arreglo_telas[] = array(
                "id" => $item[0]["id_tela_cuatro"],
                "clave" => $item[0]["clave_tela_cuatro"],
                "nombre" => $item[0]["nombre_tela_cuatro"],
                "piezas" => $item[0]["mts_cuatro"],
                "precio_costo" => $item[0]["precio_costo_cuatro"],
                "importe_total" => $item[0]["importe_cuatro"]
            );
        }

        $nuevo_arreglo_patas = array();
        $pata_total_uno = 0;
        $pata_total_dos = 0;
        if ($item[0]["id_pata_uno"] !== null) {
            $pata_total_uno = $item[0]["pz_pata_uno"] * $item[0]["precio_costo_pata_uno"];
            $nuevo_arreglo_patas[] = array(
                "id" => $item[0]["id_pata_uno"],
                "clave" => $item[0]["clave_pata_uno"],
                "nombre" => $item[0]["nombre_pata_uno"],
                "piezas" => $item[0]["pz_pata_uno"],
                "precio_costo" => $item[0]["precio_costo_pata_uno"],
                "importe_total" => $item[0]["importe_pata_uno"]
            );
        }

        if ($item[0]["id_pata_dos"] !== null) {
            $pata_total_dos = $item[0]["pz_pata_dos"] * $item[0]["precio_costo_pata_dos"];
            $nuevo_arreglo_patas[] = array(
                "id" => $item[0]["id_pata_dos"],
                "clave" => $item[0]["clave_pata_dos"],
                "nombre" => $item[0]["nombre_pata_dos"],
                "piezas" => $item[0]["pz_pata_dos"],
                "precio_costo" => $item[0]["precio_costo_pata_dos"],
                "importe_total" => $item[0]["importe_pata_dos"]
            );
        }

        $nuevo_arreglo_ebanisteria = array();
        $ebanesteria_total_uno = 0;
        $ebanesteria_total_dos = 0;
        $ebanesteria_total_tres = 0;
        if ($item[0]["id_ebanesteria_uno"] !== null) {
            $ebanesteria_total_uno = $item[0]["pz_ebanesteria_uno"]*$item[0]["precio_costo_ebanesteria_uno"];
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_uno"],
                "clave" => $item[0]["clave_ebanesteria_uno"],
                "nombre" => $item[0]["nombre_ebanesteria_uno"],
                "piezas" => $item[0]["pz_ebanesteria_uno"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_uno"],
                "importe_total" => $item[0]["importe_ebanesteria_uno"]
            );
        }

        if ($item[0]["id_ebanesteria_dos"] !== null) {
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_dos"],
                "clave" => $item[0]["clave_ebanesteria_dos"],
                "nombre" => $item[0]["nombre_ebanesteria_dos"],
                "piezas" => $item[0]["pz_ebanesteria_dos"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_dos"],
                "importe_total" => $item[0]["importe_ebanesteria_dos"]
            );
        }

        if ($item[0]["id_ebanesteria_tres"] !== null) {
            $nuevo_arreglo_ebanisteria[] = array(
                "id" => $item[0]["id_ebanesteria_tres"],
                "clave" => $item[0]["clave_ebanesteria_tres"],
                "nombre" => $item[0]["nombre_ebanesteria_tres"],
                "piezas" => $item[0]["pz_ebanesteria_tres"],
                "precio_costo" => $item[0]["precio_costo_ebanesteria_tres"],
                "importe_total" => $item[0]["importe_ebanesteria_tres"]
            );
        }

        $nuevo_arreglo_herraje_i = array();
        if ($item[0]["id_herraje_uno"] !== null) {
            $nuevo_arreglo_herraje_i[] = array(
                "id" => $item[0]["id_herraje_uno"],
                "clave" => $item[0]["clave_herraje_uno"],
                "nombre" => $item[0]["nombre_herraje_uno"],
                "piezas" => $item[0]["pz_herraje_uno"],
                "precio_costo" => $item[0]["precio_costo_herraje_uno"],
                "importe_total" => $item[0]["importe_herraje_uno"]
            );
        }

        if ($item[0]["id_herraje_dos"] !== null) {
            $nuevo_arreglo_herraje_i[] = array(
                "id" => $item[0]["id_herraje_dos"],
                "clave" => $item[0]["clave_herraje_dos"],
                "nombre" => $item[0]["nombre_herraje_dos"],
                "piezas" => $item[0]["pz_herraje_dos"],
                "precio_costo" => $item[0]["precio_costo_herraje_dos"],
                "importe_total" => $item[0]["importe_herraje_dos"]
            );
        }

        $total_kit_hab = isset($item[0]["total_kit_hab"]) ? floatval($item[0]["total_kit_hab"]) : 0;
        $total_kit_hul = isset($item[0]["total_kit_hul"]) ? floatval($item[0]["total_kit_hul"]) : 0;
        $total_kit_mp = isset($item[0]["total_kit_mp"]) ? floatval($item[0]["total_kit_mp"]) : 0;
        
        $suma_total = $total_kit_hab + $total_kit_hul + $total_kit_mp;
        $suma_patas = $pata_total_uno + $pata_total_dos;

        $data['codigo_sap_articulo'] = $codigo_sap_articulo;
        $data['cliente'] = $cliente;
        $data['kitHab'] = $kitHab;
        $data['kitHul'] = $kitHul;
        $data['KitMp'] = $KitMp;
        $data['herrajeN'] = $herrajeN;
        $data['patas'] = $nuevo_arreglo_patas;
        $data['herrajeI'] = $nuevo_arreglo_herraje_i;
        $data['ebanesteria'] = $nuevo_arreglo_ebanisteria;
        $data['telas'] = $nuevo_arreglo_telas;
        $data['item'] = $item;
        $data['total_kits'] = $suma_total;
        $data['total_patas'] = $suma_patas;
        
        $data['i'] = 1;
        $data['j'] = 1;
        $data['h'] = 1;
        $data['q'] = 1;
        $data['l'] = 1;
        $data['f'] = 1;
        $data['e'] = 1;
        $data['t'] = 1;
        
        if($id_rol == 2){
            $this->load->view('DirGeneral/Layout/Header');
            $this->load->view('DirGeneral/Layout/Menu');
            $this->load->view('DirGeneral/Cotizaciones/Pendientes/DetalleItem',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }else{
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Cotizaciones/Pendientes/DetalleItem',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
    
        }
    }

    /**
     * Actualiza el margen y la observación de un detalle de cotización pendiente.
     *
     * Actualiza el margen y la observación de un detalle de cotización pendiente utilizando los datos recibidos por POST.
     * Llama al modelo McotPendientes para realizar la actualización en la base de datos.
     * Redirige al usuario a la página de detalle de la cotización pendiente después de la actualización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param float $margen Nuevo margen a actualizar para el detalle de la cotización.
     * @param string $descripcion Nueva descripción u observación a asociar al detalle de la cotización.
     * @param int $id_detalle_cotizacion ID del detalle de la cotización pendiente que se va a actualizar.
     * @param int $id_cotizacion ID de la cotización pendiente asociada al detalle.
     * @param int $id_business_partner ID del business partner asociado a la cotización pendiente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función es invocada cuando se envía un formulario para actualizar el margen y la observación de un detalle de cotización pendiente.
     * Recibe los datos necesarios desde el formulario mediante POST.
     * Llama al modelo McotPendientes para realizar la actualización en la base de datos utilizando los datos recibidos.
     * Redirige al usuario de vuelta a la página de detalle de la cotización pendiente correspondiente después de la actualización.
     *
     * Ejemplo de uso:
     * ```php
     * // Este método es invocado automáticamente al enviar el formulario de actualización de margen y observación desde la interfaz de usuario.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function actualizarMargenObservacion()
    {
        $margen = $this->input->post("margen");
        $descripcion = $this->input->post("descripcion");
        $id_detalle_cotizacion = $this->input->post("id_detalle_cotizacion");

        $id_cotizacion = $this->input->post("id_cotizacion");
        $id_business_partnes = $this->input->post("id_business_partnes");

        $data_detalle_cotizacion = $this->McotPendientes->getItemByItems($id_detalle_cotizacion);

        $condicionesComerciales= getCondicionComercial($id_business_partnes);
        $data_condicionesCom = comisiones_comerciales($condicionesComerciales);

        $financiamiento = $data_condicionesCom['financiamiento'];
        $flete = $data_condicionesCom['flete'];

        if(isset($data_condicionesCom['comision'])){
            $comision = $data_condicionesCom['comision'];
        }else{
            $comision = $data_condicionesCom['comision'] = 0;
        }

        $descuentos_comerciales = $data_condicionesCom['descuentos_comerciales'];
        
        $param['mano_obra'] = $data_detalle_cotizacion[0]['mano_obra'];
        $param['descuentos_comerciales'] = $descuentos_comerciales;
        $param['financiamiento'] = $financiamiento;
        $param['flete'] = $flete;
        $param['comision'] = $comision;
        $param['total_materia_prima'] = $data_detalle_cotizacion[0]['total_mp'];
        $param['margen_dinamico'] = $margen;
        $fijos = $this->Mconfiguracion->getFijos();
        $data_cotizacion = calcular_cotizacion($param,$fijos);
        $this->McotPendientes->actualizaMargenObservacion($id_detalle_cotizacion,$margen,$descripcion,$data_cotizacion);
        redirect(base_url()."cotizaciones-pendientes-detalle/$id_cotizacion/$id_business_partnes", 'refresh');
    }

    /**
     * Actualiza el margen y la observación de varios detalles de cotización pendiente de manera conjunta.
     *
     * Actualiza el margen y la observación de varios detalles de cotización pendiente de manera conjunta
     * utilizando los datos recibidos por POST, incluidos los ítems seleccionados y la acción a realizar
     * (aprobar o cancelar). Llama al modelo McotPendientes para realizar las actualizaciones en la base de datos.
     * Redirige al usuario a la página de detalle de la cotización pendiente después de las actualizaciones.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param float $margen Nuevo margen a actualizar para los detalles de la cotización.
     * @param string $descripcion Nueva descripción u observación a asociar a los detalles de la cotización.
     * @param int $id_cotizacion ID de la cotización pendiente asociada a los detalles.
     * @param int $id_business_partnes ID del business partner asociado a la cotización pendiente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función es invocada cuando se envía un formulario para actualizar el margen y la observación de varios detalles de cotización pendiente.
     * Recibe los datos necesarios desde el formulario mediante POST, incluidos los ítems seleccionados y la acción a realizar (aprobar o cancelar).
     * Llama al modelo McotPendientes para realizar las actualizaciones en la base de datos utilizando los datos recibidos.
     * Redirige al usuario de vuelta a la página de detalle de la cotización pendiente correspondiente después de las actualizaciones.
     *
     * Ejemplo de uso:
     * ```php
     * // Este método es invocado automáticamente al enviar el formulario de actualización conjunta de margen y observación desde la interfaz de usuario.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function actualizarMargenObservacionConjunta()
    {
        $margen = $this->input->post("nuevoMargen");
        
        $descripcion = $this->input->post("nuevaDescripcion");
        $id_cotizacion = $this->input->post("id_cotiza");
        $id_business_partnes = $this->input->post("id_bussiness_par");

        $items = $this->input->post('itemsSeleccionadosMargen');
        $items = trim($items,'[]');
        $array_item = explode(',',$items);
        $array_items = [];
        
        foreach($array_item as $ai){
            $array_items[] = trim($ai, '"');
        }

        $condicionesComerciales= getCondicionComercial($id_business_partnes);
        $data_condicionesCom = comisiones_comerciales($condicionesComerciales);

        $financiamiento = $data_condicionesCom['financiamiento'];
        $flete = $data_condicionesCom['flete'];

        if(isset($data_condicionesCom['comision'])){
            $comision = $data_condicionesCom['comision'];
        }else{
            $comision = $data_condicionesCom['comision'] = 0;
        }

        $descuentos_comerciales = $data_condicionesCom['descuentos_comerciales'];

        $param['descuentos_comerciales'] = $descuentos_comerciales;
        $param['financiamiento'] = $financiamiento;
        $param['flete'] = $flete;
        $param['comision'] = $comision;
        $param['margen_dinamico'] = $margen;
        $fijos = $this->Mconfiguracion->getFijos();
        foreach($array_items as $i){
            $data_items = $this->McotPendientes->getItemByItems($i);
            $param['mano_obra'] = $data_items[0]['mano_obra'];
            $param['total_materia_prima'] = $data_items[0]['total_mp'];
            $data_cotizacion = calcular_cotizacion($param,$fijos);
            $this->McotPendientes->actualizaMargenObservacion($i,$margen,$descripcion,$data_cotizacion);
        }

        redirect(base_url()."cotizaciones-pendientes-detalle/$id_cotizacion/$id_business_partnes", 'refresh');
    }

    /**
     * Realiza acciones conjuntas (aprobar o cancelar) sobre varios ítems de cotización pendiente.
     *
     * Realiza acciones conjuntas (aprobar o cancelar) sobre varios ítems de cotización pendiente
     * utilizando los datos recibidos por POST, incluidos los ítems seleccionados y la acción a realizar.
     * Llama al modelo McotPendientes para realizar las actualizaciones correspondientes en la base de datos.
     * Redirige al usuario a la página de detalle de la cotización pendiente después de las actualizaciones.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param int $id_business_partnes ID del business partner asociado a la cotización pendiente.
     * @param int $id_cotizacion ID de la cotización pendiente asociada a los ítems.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función es invocada cuando se envía un formulario para realizar acciones conjuntas (aprobar o cancelar)
     * sobre varios ítems de cotización pendiente.
     * Recibe los datos necesarios desde el formulario mediante POST, incluidos los ítems seleccionados y la acción a realizar.
     * Llama al modelo McotPendientes para actualizar el estado de los ítems en la base de datos utilizando los datos recibidos.
     * Redirige al usuario de vuelta a la página de detalle de la cotización pendiente correspondiente después de las actualizaciones.
     *
     * Ejemplo de uso:
     * ```php
     * // Este método es invocado automáticamente al enviar el formulario de acciones conjuntas sobre ítems desde la interfaz de usuario.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function accionesConjunta()
    {
        $id_business_partnes = $this->input->post('id_bussinees_p');
        $id_cotizacion = $this->input->post('id_cot');
        $items = $this->input->post('itemsSeleccionados');
        $aprobarCancelar = $this->input->post('accion');
        $items = trim($items,'[]');
        $array_item = explode(',',$items);
        $array_items = [];
        foreach($array_item as $ai){
            $array_items[] = trim($ai, '"');
        }

        foreach($array_items as $i){
            $this->McotPendientes->actualizarItemAC($i,$aprobarCancelar);
        }

        redirect(base_url()."cotizaciones-pendientes-detalle/$id_cotizacion/$id_business_partnes", 'refresh');

    }


    /**
     * Actualiza el estado de aprobación o cancelación de un ítem de cotización pendiente.
     *
     * Actualiza el estado de aprobación o cancelación de un ítem de cotización pendiente utilizando los datos recibidos por POST.
     * Llama al modelo McotPendientes para realizar la actualización en la base de datos.
     * Redirige al usuario a la página de detalle de la cotización pendiente después de la actualización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param int $id_detalle_cotizacion ID del detalle de cotización pendiente que se va a actualizar.
     * @param string $aprobarCancelar Acción a realizar sobre el ítem ("A" para aprobar, "C" para cancelar).
     * @param int $id_cotizacion ID de la cotización pendiente asociada al detalle.
     * @param int $id_business_partnes ID del business partner asociado a la cotización pendiente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función es invocada cuando se envía un formulario para actualizar el estado de aprobación o cancelación de un ítem de cotización pendiente.
     * Recibe los datos necesarios desde el formulario mediante POST.
     * Llama al modelo McotPendientes para realizar la actualización en la base de datos utilizando los datos recibidos.
     * Redirige al usuario de vuelta a la página de detalle de la cotización pendiente correspondiente después de la actualización.
     *
     * Ejemplo de uso:
     * ```php
     * // Este método es invocado automáticamente al enviar el formulario de actualización de estado de ítem desde la interfaz de usuario.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function actualizarItemAC()
    {
        $id_detalle_cotizacion = $this->input->post("id_detalle_cotizacion");
        $aprobarCancelar = $this->input->post("aprobarCancelar");
        
        $id_cotizacion = $this->input->post("id_cotizacion");
        $id_business_partnes = $this->input->post("id_business_partnes");
        $this->McotPendientes->actualizarItemAC($id_detalle_cotizacion,$aprobarCancelar);
        redirect(base_url()."cotizaciones-pendientes-detalle/$id_cotizacion/$id_business_partnes", 'refresh');
    }

    /**
     * Exporta los datos de una cotización pendiente a un archivo Excel.
     *
     * Exporta los datos de una cotización pendiente a un archivo Excel utilizando PHPExcel.
     * Genera un archivo Excel con las columnas correspondientes y los datos obtenidos del modelo McotPendientes.
     * El archivo Excel se descarga automáticamente al ser generado.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @param int $id_cotizacion ID de la cotización pendiente cuyos datos se van a exportar a Excel.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función es invocada cuando se solicita exportar los datos de una cotización pendiente a un archivo Excel.
     * Utiliza PHPExcel para crear un nuevo documento Excel y exportar los datos obtenidos del modelo McotPendientes.
     * Configura las columnas y los datos de acuerdo con las necesidades del archivo Excel generado.
     * El archivo Excel generado se descarga automáticamente en el navegador del usuario.
     *
     * Ejemplo de uso:
     * ```php
     * // Este método es invocado automáticamente al solicitar la exportación de datos de cotización pendiente a Excel desde la interfaz de usuario.
     * // No se llama directamente desde ningún otro código.
     * ```
     */
    function exportarExcel()
    {

        // Define la ruta base de las imágenes
        define('IMAGES_PATH', FCPATH . 'assets/images/claves_pt/claves/');

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

        foreach (range('B', 'V') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setCellValue('A1','Imagen');
        $sheet->setCellValue('B1','Fuente');
		$sheet->setCellValue('C1','Clave');
		$sheet->setCellValue('D1','Descripción');
		$sheet->setCellValue('E1','MP');
		$sheet->setCellValue('F1','Herraje');
		$sheet->setCellValue('G1','Telas');
		$sheet->setCellValue('H1','MO');
        $sheet->setCellValue('I1','T. MP');
        $sheet->setCellValue('J1','T. Gastos');
        $sheet->setCellValue('K1','T. Nom');
        $sheet->setCellValue('L1','Des. Com');
        $sheet->setCellValue('M1','Des. Fin.');
        $sheet->setCellValue('N1','Des. Com');
        $sheet->setCellValue('O1','Costo Total x Unidad');
        $sheet->setCellValue('P1','Margen');
        $sheet->setCellValue('Q1','Precio Sugerido');
        $sheet->setCellValue('R1','Precio Fuente');
        $sheet->setCellValue('S1','Incremento');
        $sheet->setCellValue('T1','Precio Nuevo');
        $sheet->setCellValue('U1','Inc N');
        $sheet->setCellValue('V1','Observaciones');

        $id_cotizacion = $this->input->post("id_cotizacion");
        $datos = $this->McotPendientes->getDataItemByIdCot($id_cotizacion);
        $x = 2;

        foreach($datos as $row)
		{
            $codigo_sap_articulo = $row['codigo_sap_articulo'];
            $imagenPath = IMAGES_PATH.$codigo_sap_articulo.'.png';

            if (file_exists($imagenPath)) {
                $drawing = new Drawing();
                $drawing->setName('Producto');
                $drawing->setDescription('Imagen del Producto');
                $drawing->setPath($imagenPath);
    
                // Establecer la posición y tamaño de la imagen dentro de la celda A$x
                $drawing->setCoordinates('A' . $x); // Columna A, fila $x
                $drawing->setWorksheet($sheet);
    
                // Ajustar el tamaño de la celda para que la imagen quepa
                $sheet->getRowDimension($x)->setRowHeight(80); // Ajustar según sea necesario
                $sheet->getColumnDimension('A')->setWidth(50); // Ajustar según sea necesario
            }

			
            $sheet->setCellValue('B'.$x,"NUEVO");
            $sheet->setCellValue('C'.$x,$row['codigo_sap_articulo']);
			$sheet->setCellValue('D'.$x,$row['descripcion_general']);
			$sheet->setCellValue('E'.$x,$row['total_mp']);
			$sheet->setCellValue('F'.$x,$row['total_herraje_nacional']);
			$sheet->setCellValue('G'.$x,$row['total_g_telas']);
			$sheet->setCellValue('H'.$x,$row['mano_obra']);
            $sheet->setCellValue('I'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('J'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('K'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('L'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('M'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('N'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('O'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('P'.$x,$row['margen']);
            $sheet->setCellValue('Q'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('R'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('S'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('T'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('U'.$x,$row['costo_materia_prima']);
            $sheet->setCellValue('V'.$x,$row['observaciones']);
            
			$x++;
		}

        $write = new Xls($spreadsheet);
		$fileName = 'Cotización No'.$datos[0]['folio_consecutivo'];
		
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');


    }

}
