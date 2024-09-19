<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mlogin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @version: 1.0
     * @author Ing. Alonso Montiel Villar
     * Funcion que valida el usuario que exista para el inicio de sesion
     * @param Array $param: Arreglo con los datos del usuario que iniciara sesion
     * @return Array|String
     */
    public function validaUsuario($param)
    {
        $this->db->select('*');
        $this->db->from('vis_usuarios');
        $this->db->where('usuario', $param['usuario']);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $resultado = $query->row();
            $activo = $resultado->usuario_activo;
            if ($activo == 1) {
                $primer_n = explode(" ", $resultado->nombre);
                $primer_nombre = $primer_n[0];
                $vars_sesion = array(
                    's_id_sesiones' => $resultado->id_usuario,
                    's_nombre' => $resultado->nombre,
                    's_primer_nombre' => $primer_nombre,
                    's_apellidos' => $resultado->apellidos,
                    's_nombre_completo' => $resultado->nombre." ".$resultado->apellidos,
                    's_usuario' => $resultado->usuario,
                    's_id_roles' => $resultado->id_roles,
                    's_rol' => $resultado->rol,
                    's_id_departamento' => $resultado->id_departamento,
                    's_departamento' => $resultado->departamento,
                    's_id_plantas' => $resultado->id_plantas,
                    's_planta' => $resultado->planta
                );
                $verificar = password_verify($param['contrasenia'], $resultado->contrasenia);
                if ($verificar == 1) {
                    $this->session->set_userdata($vars_sesion);
                    return $resultado;
                }
                return "error";
            }
                log_message('error', $this->lang->line('log_err_no_hay_usuarios'));
                return "activado";
        }
    }
    /**
     * @version: 1.0
     * @author 0000001
     * Funcion para actulizar la contraseña de un usuario 
     */
    public function actualizaContrasenia($param)
    {
        $correo_electronico = $param['correo_electronico'];
        $contrasenia = $param['contrasenia'];

        $this->db->select('*');
        $this->db->from('ent_usuario');
        $this->db->where('correo_electronico', $correo_electronico);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $campos = array(
                'contrasenia' => $contrasenia
            );
            $this->db->where('correo_electronico', $correo_electronico);
            $this->db->update('ent_usuario', $campos);
            return true;
        }
        return false;
    }
}
