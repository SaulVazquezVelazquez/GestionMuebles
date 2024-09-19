<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clogin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
        //$this->load->model('DigitalJaguar/Configuracion/Mgeneral');
        //$this->load->model('DigitalJaguar/Correo/Mcorreo');
    }

    /**
     * Funcion para cargar la vista del login
     */
    public function index()
    {
        $data['error'] = $this->session->flashdata('error');
        $data['info'] = $this->session->flashdata('info');
        $this->load->view('Index', $data);
    }

    /**
     * @version: 1.0
     * @author Ing. Alonso Montiel Villar
     * Funcion para realizar el inicio de sesion
     */
    public function inicioSesion()
    {
        $usuario = strtolower($this->input->post('usuario'));
        $contrasenia = $this->input->post('contrasenia');
        $param['usuario'] = $usuario;
        $param['contrasenia'] = $contrasenia;
        $valido = $this->Mlogin->validaUsuario($param);
		
        if (isset($valido->id_roles)) {
            $valida = $valido->id_roles;
        } else {
            $valida = $valido;
        }

        switch ($valida) {
            case 1:
				//Direccion Programación
                redirect(base_url() . 'dashboard-direccion-desarrollo', 'refresh');
                break;
            case 2:
				//Direccion General
				redirect(base_url() . 'dashboard-direccion-general', 'refresh');
                break;
            case 3:
				//Direccion Comercial
				redirect(base_url() . 'dashboard-direccion-comercial', 'refresh');
                break;
            case 4:
				//Direccion Contable
				redirect(base_url() . 'dashboard-direccion-contable', 'refresh');
                break;
			case 5:
				//Direccion Planta
				redirect(base_url() . 'dashboard-direccion-planta', 'refresh');
                break;
			case 6:
				//Direccion Recursos Humanos
				echo "direccion recursos humanos";
				die();
				log_message('error', $this->lang->line('log_err_usu_pass_inc'));
				$this->session->set_flashdata('error', $this->lang->line('err_no_activado'));
				redirect(base_url(), 'refresh');
				break;
			case 7:
				//Servicio al cliente
				redirect(base_url() . 'dashboard-servicio-cliente', 'refresh');
                break;
			case 12:
				//Direccion Diseño e Ingenieria 
				redirect(base_url() . 'dashboard-disenio-ingenieria', 'refresh');
                break;
            case 13:
                //Direccion Diseño e Ingenieria 
                redirect(base_url() . 'dashboard-disenio', 'refresh');
                break;
            case 'activado':
				//Usuario Inactivo
                log_message('error', $this->lang->line('log_err_usu_pass_inc'));
                $this->session->set_flashdata('error', $this->lang->line('err_usuario_contrasenia'));
                redirect(base_url(), 'refresh');
                break;
            default:
                log_message('error', $this->lang->line('log_err_usu_pass_inc'));
                $this->session->set_flashdata('error', $this->lang->line('err_usuario_contrasenia'));
                redirect(base_url(), 'refresh');
        }
    }

    /**
     * @version: 1.0
     * @author 0000001
     * Funcion de cierre de sesion
     */
    public function cerrarSesion()
    {
        $this->session->unset_userdata('vars_sesion');
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    /**
     * @version: 1.0
     * @author 0000001
     * Funcion de carga de la vista para recuperar contraseña 
     */
    public function recuperaContrasenia()
    {
        $data['error'] = $this->session->flashdata('error');
        $data['info'] = $this->session->flashdata('info');
        $this->load->view('Layout/Header');
        $this->load->view('Contrasenia/RestauraContrasenia', $data);
        $this->load->view('Layout/Footer');
    }

    /**
     * @version: 1.0
     * @author 0000001
     * Funcion para el reenvio de contraseña 
     */
    public function enviaContrasenia()
    {
        $correo_electronico = strtolower($this->input->post('correo_electronico'));
        $rut_nit = "";
        $compararUsuario = $this->Mgeneral->comparaUsuario($correo_electronico, $rut_nit);
        if (isset($compararUsuario['baneado']) == 0 || !$compararUsuario == 0) {
            if (isset($compararUsuario['activado']) == 1) {
                if (isset($compararUsuario['activo']) == 1) {
                    $codigo = $this->Mgeneral->generarCodigo();
                    $param['correo_electronico'] = $correo_electronico;
                    $param['contrasenia'] = password_hash($codigo, PASSWORD_DEFAULT);
                    $actualizado = $this->Mlogin->actualizaContrasenia($param);
                    if ($actualizado) {
                        $this->Mcorreo->reenvioContrasenia($correo_electronico, $codigo);
                        redirect(base_url() . 'contrasenia-enviada', 'refresh');
                    }
                }
                log_message('error',  $this->lang->line('log_err_no_activo') . ' ' . $correo_electronico);
                $this->session->set_flashdata('error', $this->lang->line('err_no_correo_incorrecto'));
                redirect(base_url() . 'recupera-contrasenia', 'refresh');
            }
            log_message('error',  $this->lang->line('log_err_usuario_no_activado') . ' ' . $correo_electronico);
            $this->session->set_flashdata('error', $this->lang->line('err_no_correo_incorrecto'));
            redirect(base_url() . 'recupera-contrasenia', 'refresh');
        }
        log_message('error',  $this->lang->line('log_err_usuario_baneado') . ' ' . $correo_electronico);
        $this->session->set_flashdata('error', $this->lang->line('err_no_correo_incorrecto'));
        redirect(base_url() . 'recupera-contrasenia', 'refresh');
    }

    /**
     * @version: 1.0
     * @author 0000001
     * Funcion para cargar la vista de contraseña enviada 
     */
    public function contraseniaEnviada()
    {
        $this->load->view('Layout/Header');
        $this->load->view('Contrasenia/ContraseniaEnviada');
        $this->load->view('Layout/Footer');
    }
}
