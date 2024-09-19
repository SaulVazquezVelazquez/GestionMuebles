<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class CvalidacionesAprobadas extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones/McotPendientes');
        $this->load->model('Cotizador/Mcotizador');
    }

	/**
     * Funcion para cargar el dashboard del perfil
     * @author Ing. Alonso Montiel Villar
     * @version 1.0
     */
    function index()
	{
        $id_rol = $this->session->userdata('s_id_roles');
        $data['items'] = array(
            array("Folio" => 19, "Cliente" => "CMURUAPAN", "Fecha creacion" => "10/05/2023", "Folio anterior" => 0, "Fecha aplicacion" => "10/05/2023", "Factor cot" => 7.5, "LP Anterior" => 0, "LP Nueva" => 1349),
            array("Folio" => 20, "Cliente" => "CMUEBLERO", "Fecha creacion" => "10/05/2023", "Folio anterior" => 0, "Fecha aplicacion" => "10/05/2023", "Factor cot" => 7.5, "LP Anterior" => 0, "LP Nueva" => 1348),
            array("Folio" => 21, "Cliente" => "TELEBODEGA", "Fecha creacion" => "10/05/2023", "Folio anterior" => 0, "Fecha aplicacion" => "10/05/2023", "Factor cot" => 7.5, "LP Anterior" => 0, "LP Nueva" => 1346),
            array("Folio" => 25, "Cliente" => "CHEDRAUI PR", "Fecha creacion" => "19/06/2023", "Folio anterior" => 22, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 18, "LP Anterior" => 1353, "LP Nueva" => 1357),
            array("Folio" => 27, "Cliente" => "HOMEDEPOT", "Fecha creacion" => "20/06/2023", "Folio anterior" => 10, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 8, "LP Anterior" => 1340, "LP Nueva" => 1359),
            array("Folio" => 33, "Cliente" => "DEUROPE", "Fecha creacion" => "27/06/2023", "Folio anterior" => 11, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 6.5, "LP Anterior" => 1341, "LP Nueva" => 1365),
            array("Folio" => 34, "Cliente" => "CHAPUR", "Fecha creacion" => "03/07/2023", "Folio anterior" => 16, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 15, "LP Anterior" => 1351, "LP Nueva" => 1366),
            array("Folio" => 35, "Cliente" => "CIMACO", "Fecha creacion" => "04/07/2023", "Folio anterior" => 12, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 15, "LP Anterior" => 1342, "LP Nueva" => 1367),
            array("Folio" => 39, "Cliente" => "RADA", "Fecha creacion" => "14/07/2023", "Folio anterior" => 18, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 7.5, "LP Anterior" => 1347, "LP Nueva" => 1371),
            array("Folio" => 40, "Cliente" => "STANDARD", "Fecha creacion" => "14/07/2023", "Folio anterior" => 36, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 13, "LP Anterior" => 1368, "LP Nueva" => 1372),
            array("Folio" => 42, "Cliente" => "ELIZONDO", "Fecha creacion" => "20/07/2023", "Folio anterior" => 15, "Fecha aplicacion" => "01/07/2023", "Factor cot" => 15.5, "LP Anterior" => 1350, "LP Nueva" => 1374),
            array("Folio" => 44, "Cliente" => "VILLAREAL", "Fecha creacion" => "28/08/2023", "Folio anterior" => 0, "Fecha aplicacion" => "28/08/2023", "Factor cot" => 16, "LP Anterior" => 0, "LP Nueva" => 1376),
            array("Folio" => 45, "Cliente" => "VIZCAYA", "Fecha creacion" => "07/09/2023", "Folio anterior" => 28, "Fecha aplicacion" => "01/09/2023", "Factor cot" => 18, "LP Anterior" => 1360, "LP Nueva" => 1377),
            array("Folio" => 48, "Cliente" => "NASSER", "Fecha creacion" => "06/10/2023", "Folio anterior" => 38, "Fecha aplicacion" => "06/10/2023", "Factor cot" => 5.5, "LP Anterior" => 1370, "LP Nueva" => 1380),
            array("Folio" => 50, "Cliente" => "CHEDRAUI", "Fecha creacion" => "20/10/2023", "Folio anterior" => 47, "Fecha aplicacion" => "20/10/2023", "Factor cot" => 28, "LP Anterior" => 1379, "LP Nueva" => 1382),
            array("Folio" => 51, "Cliente" => "ELEKTRA", "Fecha creacion" => "10/11/2023", "Folio anterior" => 29, "Fecha aplicacion" => "10/11/2023", "Factor cot" => 23.5, "LP Anterior" => 1361, "LP Nueva" => 1383),
            array("Folio" => 52, "Cliente" => "LIVERPOOL", "Fecha creacion" => "15/11/2023", "Folio anterior" => 26, "Fecha aplicacion" => "15/11/2023", "Factor cot" => 14.2, "LP Anterior" => 1358, "LP Nueva" => 1384),
            array("Folio" => 53, "Cliente" => "GAIA", "Fecha creacion" => "29/11/2023", "Folio anterior" => 46, "Fecha aplicacion" => "30/11/2023", "Factor cot" => 11, "LP Anterior" => 1378, "LP Nueva" => 1385),
            array("Folio" => 54, "Cliente" => "COSTCO", "Fecha creacion" => "13/12/2023", "Folio anterior" => 0, "Fecha aplicacion" => "13/12/2023", "Factor cot" => 4, "LP Anterior" => 1369, "LP Nueva" => 1386),
            array("Folio" => 57, "Cliente" => "PH", "Fecha creacion" => "23/01/2024", "Folio anterior" => 56, "Fecha aplicacion" => "23/01/2024", "Factor cot" => 18, "LP Anterior" => 1388, "LP Nueva" => 1389),
            array("Folio" => 60, "Cliente" => "SEARS", "Fecha creacion" => "20/03/2024", "Folio anterior" => 43, "Fecha aplicacion" => "20/03/2024", "Factor cot" => 35, "LP Anterior" => 1375, "LP Nueva" => 1392),
            array("Folio" => 63, "Cliente" => "SEARSC1", "Fecha creacion" => "27/03/2024", "Folio anterior" => 61, "Fecha aplicacion" => "27/03/2024", "Factor cot" => 20, "LP Anterior" => 1393, "LP Nueva" => 1395)
        );
        $data['i'] = 1;
        if($id_rol == 2 ){
            $this->load->view('DirGeneral/Layout/Header');
            $this->load->view('DirGeneral/Layout/Menu');
            $this->load->view('DirGeneral/Cotizaciones/Aprobadas/Index',$data);
            $this->load->view('DirGeneral/Layout/Footer');
        }else{
            $this->load->view('DirDisenioIngenieria/Layout/Header');
            $this->load->view('DirDisenioIngenieria/Layout/Menu');
            $this->load->view('DirDisenioIngenieria/Validaciones/Aprobadas/Index',$data);
            $this->load->view('DirDisenioIngenieria/Layout/Footer');
        }

        
	}
}
