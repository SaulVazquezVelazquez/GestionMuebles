<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CbusinessPartners extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('Sap/my_sap_count_helper');
        $this->load->model('Apis/Mapis');
    }

    /**
     * Funcion para obtener los registro de la tabla OITB de SAP
     */
    function getRegistros()
    {

        $conexion = $this->Mapis->getEndPoint(1,5);
        $session_activa = $this->Mapis->getSessionSap();
        if($session_activa)
        {
            $session_id =  $session_activa['session_id'];
            $count = countRegistros($conexion,$session_id);
            log_message('info', '=====> INICIA CONSULTA A LOS BUSINESS <=====');
            $url = $conexion['endpoint'];
            $metodo = $conexion['metodo'];
            $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';
            $paginas_reales = round($count);
            $endpoint = $url.$metodo; 
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
                    $card_code = $item->CardCode;
                    $card_name = $item->CardName;
                    $card_foreign_name = $item->CardForeignName;
                    $employees = $item->ContactEmployees;
                    $nombre_completo = '';

                    $param['card_code'] = $card_code;
                    $param['card_name'] = $card_name;
                    $param['card_foreign_name'] = $card_foreign_name;

                    if(!empty($card_foreign_name)){

                        $existe = $this->Mapis->compareBusinessPartner($card_code);
                        if(!$existe){
                            $nombres_asistencia = "";
                            foreach($employees as $items){

                                if (strpos($items->Name, 'Atn') === 0) {   
                                    if(!empty($items->FirstName) || !empty($items->LastName)){
                                        $nombre = $items->FirstName;
                                        $apellido = $items->LastName;
                                    }
                                    $nombre_completo .= $nombre.' '.$apellido.',';
                                    $nombres_asistencia = substr($nombre_completo, 0, -1);
                                }  
                            }
                            $param['contact_employee'] = $nombres_asistencia;
                            log_message('info', "BUSINESS registro nuevo : $card_code");
                            $this->Mapis->registroBusinessPartner($param);
                        }else{
                            log_message('info', "BUSINESS registro ya existe : $card_code");
                        }
                    }
                }
                redirect(base_url().'sincronizar-apis', 'refresh');
            }catch (Exception $e) {
                $timezone = "America/Mexico_City";
                date_default_timezone_set($timezone);
                log_message('info', "BUSINESSS REGISTER_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
            }
        }else{
            log_message('info', "CItems_Error: La Sesión no es Valida");
        }
    }
}