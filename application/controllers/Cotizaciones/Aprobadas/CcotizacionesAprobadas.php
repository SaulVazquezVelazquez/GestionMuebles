<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class CcotizacionesAprobadas extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones/Maprobadas');
        $this->load->model('Cotizador/Mcotizador');
        $this->load->helper('Cotizador/CalculosGenerales_helper');
        $this->load->library('pdf');
        
    }

    function index()
	{
        $id_rol = $this->session->userdata('s_id_roles');
        $data['items'] = $this->Maprobadas->getAllData();
        $data['i'] = 1;
        
        if($id_rol == 2){
            $this->load->view('DirGeneral/Layout/Header');
            $this->load->view('DirGeneral/Layout/Menu');
            $this->load->view('DirGeneral/Cotizaciones/Index',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }elseif($id_rol == 3){
            $this->load->view('DirComercial/Layout/Header');
            $this->load->view('DirComercial/Layout/Menu');
            $this->load->view('DirComercial/Cotizaciones/Index',$data);;
            $this->load->view('DirComercial/Layout/Footer');
        }elseif($id_rol == 12){
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Cotizaciones/Index',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }elseif($id_rol == 4){
            $this->load->view('DirContable/Layout/Header');
            $this->load->view('DirContable/Layout/Menu');
            $this->load->view('DirContable/Cotizaciones/Index',$data);
            $this->load->view('DirContable/Layout/Footer');
        }else{}

        
	}

    function detalle()
    {
        $id_rol = $this->session->userdata('s_id_roles');

        $id_cotizacion = $this->uri->segment(2);
        $clientes = $this->uri->segment(3);
        
        $condicionesComerciales= getCondicionComercial($clientes);
        $data['factor_cotizacion'] = granTotal($condicionesComerciales);
        $data['condiciones_comerciales'] = $condicionesComerciales;
        $item = $this->Maprobadas->getItemByItems($id_cotizacion);
        $data['items'] = $item;
        $data['id_cotizacion'] =  $id_cotizacion;
        $data['clientes'] =  $clientes;
        $data['kist'] = $this->Mcotizador->getAllKits($id_cotizacion);
        
        // Obtener todos los códigos únicos de "codigo_sap_articulo"
        $codigos_sap = array_unique(array_column($item, 'codigo_sap_articulo'));

        // Arreglo para almacenar los resultados de la búsqueda
        $datos_clave_cot = [];

        // Recorrer cada código SAP y buscar en la base de datos
        foreach ($codigos_sap as $codigo) {
            // Buscar en el modelo Mcotizador utilizando el código SAP
            $resultado = $this->Maprobadas->getByCodigoSAP($codigo);
            
            // Si se encontraron resultados, agregar al arreglo de datos
            if ($resultado) {
                $datos_clave_cot[$codigo] = $resultado;
            }
        }

        // Ahora $datos_clave_cot contiene los datos buscados organizados por "codigo_sap_articulo"
        $data['datos_clave_cot'] = $datos_clave_cot;

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
            $this->load->view('DirGeneral/Cotizaciones/Aprobadas/Detalle',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }elseif($id_rol == 3){
            $this->load->view('DirComercial/Layout/Header');
            $this->load->view('DirComercial/Layout/Menu');
            $this->load->view('DirComercial/Cotizaciones/Aprobadas/Detalle',$data);;
            $this->load->view('DirComercial/Layout/Footer');
        }elseif($id_rol == 12){
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Cotizaciones/Aprobadas/Detalle',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }elseif($id_rol == 4){
            $this->load->view('DirContable/Layout/Header');
            $this->load->view('DirContable/Layout/Menu');
            $this->load->view('DirContable//Cotizaciones/Aprobadas/Detalle',$data);
            $this->load->view('DirContable/Layout/Footer');
        }else{}
    }


    function aprobar()
    {
        $id_cotizacion_aprobar = $this->input->post("id_cotizacion_aprobar");
        actualizarCotizacion($id_cotizacion_aprobar,4);
        redirect(base_url()."cotizaciones", 'refresh');

    }

    function exportarExcel()
    {

        $spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		foreach(range('A','V') as $coulumID){
			$spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutoSize(true);
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
            $imagenPath = base_url()+"assets/images/claves_pt/claves/"+$row['codigo_sap_articulo']+".png";

            if (file_exists($imagenPath)) {
                $drawing = new Drawing();
                $drawing->setName('Producto');
                $drawing->setDescription('Imagen del Producto');
                $drawing->setPath($imagenPath);
                $drawing->setCoordinates('A' . $x); // Columna E, fila $x
                $drawing->setOffsetX(5); // Ajustar según sea necesario
                $drawing->setOffsetY(5); // Ajustar según sea necesario
                $drawing->setWidth(100); // Ajustar según sea necesario
                $drawing->setHeight(100); // Ajustar según sea necesario
                $drawing->setWorksheet($sheet);
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

    public function genera_formato_formal_cotizacion_pdf() 
    {
        $id_cotizacion = $this->input->post('id_cotizacion_ffc');
        $data['datos_cliente'] = $this->Maprobadas->getCliente($id_cotizacion);
        $data['detalle_cotizacion'] = $this->Maprobadas->getDataItemByIdCotAprobadas($id_cotizacion);
    
        $this->pdf->load_view('Pdf/formato_formal_cotizacion', $data);
    }

    public function genera_formato_word_pdf() 
    {
        
        $id_cotizacion = $this->input->post('id_cotizacion_ffc');
        $data['datos_cliente'] = $this->Maprobadas->getCliente($id_cotizacion);

        $clientes = $data['datos_cliente']->id_business_partnes;
        $condicionesComerciales= getCondicionComercial($clientes);
        $data['factor_cotizacion'] = granTotal($condicionesComerciales);

        $data['condiciones_comerciales'] = $condicionesComerciales;
        $data['detalle_cotizacion'] = $this->Maprobadas->getDataItemByIdCotAprobadas($id_cotizacion);
    
        $this->pdf->load_view('Pdf/formato_word', $data);
    }

    public function genera_formato_validacion_pdf() 
    {
        $id_cotizacion = $this->input->post('id_cotizacion_ffc');
        $data['datos_cliente'] = $this->Maprobadas->getCliente($id_cotizacion);

        $clientes = $data['datos_cliente']->id_business_partnes;
        $condicionesComerciales= getCondicionComercial($clientes);
        $data['factor_cotizacion'] = granTotal($condicionesComerciales);
        
        $data['condiciones_comerciales'] = $condicionesComerciales;
        $data['detalle_cotizacion'] = $this->Maprobadas->getDataItemByIdCotAprobadas($id_cotizacion);
    
        $this->pdf->load_view('Pdf/formato_validacion', $data);
    }

}
