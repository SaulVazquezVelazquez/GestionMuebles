<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Apis/Mapis');
    }

    /**
     * Funcion que realiza el Lgoin con SAP donde obtener el ID de sesion que usaremos
     * para las proximas consultas dentro del sistema
     */
    public function index()
    {
        $conexion = $this->Mapis->getEndPoint(1,1);
        if($conexion == false){
            log_message('info', "CLOGIN_ERROR: El Flujo es incorrecto intentalo de nuevo");
        }else{
            $session_activa = $this->Mapis->getSessionSap();
            if($session_activa){
                $fechaInicio = new DateTime($session_activa['f_sincronizacion']);
                $fechaFin = new DateTime(date("Y-m-d H:i:s"));
                $intervalo = $fechaInicio->diff($fechaFin);
                $minutos = $intervalo->i;
                $time_out = $session_activa['session_timeout'];
                
                if($minutos > $time_out ){
                    $this->db->truncate('sap_session');
                    $this->loginSap($conexion);
                }

            }else{
                $this->loginSap($conexion);
            }
            redirect(base_url().'sincronizar-apis', 'refresh');
        }
    }

    /** Funcion que ejecutra el login al sap
     * @param Array $conexion : Variables de coneccion de SAP
     */
    function loginSap($conexion)
    {
        log_message('info', '=====> INICIO SESIÓN EN LOGIN SAP <=====');
        $url = $conexion['endpoint'];
        $user = $conexion['user_name'];
        $password = $conexion['password'];
        $company_db = $conexion['company_db'];
        $metodo = $conexion['metodo'];

        $endpoint = $url.$metodo;
        $user_name = "itconsultant\\".$user;
    
        try{

            $client = new \GuzzleHttp\Client(['verify' => false ]);
            $response = $client->request('POST',$endpoint,[
                'json' => [
                    "UserName"=> $user_name,
                    "Password"=> $password,
                    "CompanyDB"=> $company_db
                ],
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
            $success = $response->getBody()->getContents();
            $resp_decode = json_decode($success);
            $session_id = $resp_decode->SessionId;
            $session_out = $resp_decode->SessionTimeout;

            $this->Mapis->registroSession($session_id,$session_out);
            log_message('info', "CLOGIN_SUCCESS: Response: $success");   
        }catch (Exception $e) {
            echo $e;
            $timezone = "America/Mexico_City";
            date_default_timezone_set($timezone);
            log_message('info', "CLOGIN_ERROR: Problemas al consultar el inicio de sesion de SAP, Intenalo mas tarde. => $e");
        }
    }
}
