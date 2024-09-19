<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cittm1 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Sap/my_sap_count_helper');
        $this->load->model('Apis/Mapis');
    }

    /**
     * Funcion para obtener el arbol de procutos de SAP
     */
    function getRegistros()
    {
        $conexion = $this->Mapis->getEndPoint(1,4);
        $session_activa = $this->Mapis->getSessionSap();
        if($session_activa)
        {
            $session_id =  $session_activa['session_id'];
            $count = countRegistros($conexion,$session_id);
            log_message('info', '=====> INICIA CONSULTA A ARBOL DE PRODUCTOS <=====');

            $url = $conexion['endpoint'];
            $metodo = $conexion['metodo'];
            $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';
            $paginas_reales = round($count);
            $endpoint = $url.$metodo.'?$select=TreeCode,ProductTreeLines'; 
            try{

                $client = new \GuzzleHttp\Client(['verify' => false ]);
                $response = $client->request('GET',$endpoint,[
                    'headers' => [
                        'Prefer' => 'odata.maxpagesize='.$paginas_reales,
                        'Cookie' => $cookie
                    ]
                ]);
                $success = $response->getBody()->getContents();
                $resp_decode = json_decode($success);

                foreach($resp_decode->value as $item){
                    $father = $item->TreeCode;
                    $param['father']= $father;
                    foreach($item->ProductTreeLines as $it){

                        $code = $it->ItemCode;
                        $quantity = $it->Quantity;

                        $param['code']= $code;
                        $param['quantity']= $quantity;

                        $existe = $this->Mapis->compareThreeItem($father,$code);
                        if(!$existe){
                            $this->Mapis->registroThreeItem($param);
                            log_message('info', "ARBOL DE PRODUCTO registro nuevo : $father");
                        }else{
                            log_message('info', "ARBOL DE PRODUCTO registro ya existe : $father");
                        }
                    }
                }
                redirect(base_url().'sincronizar-apis', 'refresh');
            }catch (Exception $e) {
                $timezone = "America/Mexico_City";
                date_default_timezone_set($timezone);
                log_message('info', "ARBOL DE PRODUCTOS_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
            }
        }
    }
}