<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class CreporteInventario extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Reportes/MreporteInventario');
    }

	/** 
	 * Funcion para la carga principal del repore
	 */
	function index()
	{
		$this->load->view('Almacenista/Layout/Header');
        $this->load->view('Almacenista/Layout/Menu');
        $this->load->view('Almacenista/Reportes/Inventario/Inventario');
        $this->load->view('Almacenista/Layout/Footer');
	}

	/**
	 * Funcion para obtener la informacion para mostrar en el reporte generadp
	 */
	function generarReporte()
	{
		$tipo_reporte = $this->input->post('tipo_reporte');
		$almacen = $this->input->post('almacen');
		$id_planta = $this->input->post('id_planta');

		
		$data['datos_g'] = $this->MreporteInventario->getDatosGeneral($tipo_reporte,$almacen,$id_planta);
        $data['datos_m'] = $this->MreporteInventario->getDatosReporte($almacen,$id_planta);
		$data['gran_total'] = $this->getGranTotal($data);
        $data['i'] = 1;

		$this->load->view('Almacenista/Layout/Header');
        $this->load->view('Almacenista/Layout/Menu');
        $this->load->view('Almacenista/Reportes/Inventario/VistaPrevia',$data);
        $this->load->view('Almacenista/Layout/Footer');
	}

	/** 
	 * Funcion para obtener el valor del total del reporte
	 * @param Array $data: datos de la consulta del reporte
	 * @return Float $total
	 */
	function getGranTotal($data)
	{
		$total = 0;
		foreach($data['datos_m'] as $value){
     		$total+=$value['importe'];
		}
		return $total;
	}

	/**
	 * Funcion para exportar en formato excel el reporte
	 */
	function exportExcel()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		foreach(range('A','G') as $coulumID){
			$spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutoSize(true);
		}

		$sheet->setCellValue('A1','Codigo_sap');
		$sheet->setCellValue('B1','Material');
		$sheet->setCellValue('C1','Familia');
		$sheet->setCellValue('D1','Unidad');
		$sheet->setCellValue('E1','Precio');
		$sheet->setCellValue('F1','Stock');
		$sheet->setCellValue('G1','Importe');

		$tipo_reporte = $this->input->post('tipo_reporte');
		$almacen = $this->input->post('almacen');
		$id_planta = $this->input->post('id_planta');
		$datos_g = $this->MreporteInventario->getDatosGeneral($tipo_reporte,$almacen,$id_planta);
		
		$datos_r = $this->MreporteInventario->getDatosReporte($almacen,$id_planta);
		$x = 2;

		foreach($datos_r as $row)
		{
			$sheet->setCellValue('A'.$x,$row['codigo_sap_articulo']);
			$sheet->setCellValue('B'.$x,$row['material']);
			$sheet->setCellValue('C'.$x,$row['familia_descripcion']);
			$sheet->setCellValue('D'.$x,$row['unidad']);
			$sheet->setCellValue('E'.$x,$row['precio']);
			$sheet->setCellValue('F'.$x,$row['stock']);
			$sheet->setCellValue('G'.$x,$row['importe']);
			$x++;
		}
		
		$write = new Xls($spreadsheet);
		$fileName = 'Reporte-Inventario-'.date('Y-m-d')."-".$datos_g['planta'];
		    
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
		
  	}
}

