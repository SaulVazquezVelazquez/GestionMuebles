<?php
defined('BASEPATH') or exit('No direct script access allowed');
class McotPendientes extends CI_Model
{

    /**
     * Obtiene todos los datos de la tabla 'vis_cotizaciones_pendientes'.
     * Obtiene todos los registros de la tabla 'vis_cotizaciones_pendientes' y los retorna como un arreglo de resultados.
     *
     * @return array|bool Arreglo de resultados si se encuentran registros, o false si no hay registros.
     * @throws No lanza excepciones explícitamente.
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función ejecuta una consulta SQL para seleccionar todos los registros de la tabla 'vis_cotizaciones_pendientes'.
     * Retorna un arreglo de resultados si hay registros encontrados, o false si no se encuentran registros.
     *
     * Ejemplo de uso:
     * ```php
     * $data = getAllData();
     * if ($data) {
     *     foreach ($data as $row) {
     *         echo $row['nombre_columna']; // Acceder a los valores de cada columna de los registros obtenidos
     *     }
     * } else {
     *     echo "No se encontraron datos.";
     * }
     * ```
     */
    function getAllData()
    {
        $this->db->from('vis_cotizaciones_pendientes');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    /**
     * Obtiene los datos de los ítems de cotización asociados a una cotización específica.
     *
     * Obtiene los registros de la tabla 'vis_detalle_cotizacion_cotizacion' que están asociados
     * a la cotización identificada por el ID proporcionado.
     *
     * @param int $id_cotizacion ID de la cotización para la cual se desean obtener los ítems.
     * @return array|bool Arreglo de resultados si se encuentran ítems asociados a la cotización, o false si no hay resultados.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función ejecuta una consulta SQL para seleccionar los registros de la tabla 'vis_detalle_cotizacion_cotizacion'
     * que tienen el ID de cotización proporcionado.
     * Retorna un arreglo de resultados si hay ítems encontrados asociados a la cotización, o false si no se encuentran resultados.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 123; // ID de la cotización deseada
     * $data = getDataItemByIdCot($id_cotizacion);
     * if ($data) {
     *     foreach ($data as $row) {
     *         echo $row['nombre_columna']; // Acceder a los valores de cada columna de los ítems obtenidos
     *     }
     * } else {
     *     echo "No se encontraron ítems para la cotización con ID: " . $id_cotizacion;
     * }
     * ```
     */
    function getDataItemByIdCot($id_cotizacion)
    {
        $this->db->from('vis_detalle_cotizacion_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Obtiene los detalles de un ítem de cotización basado en su ID de detalle.
     *
     * Obtiene los detalles del ítem de cotización de la tabla 'vis_detalle_cotizacion_cotizacion'
     * que coincida con el ID de detalle proporcionado.
     *
     * @param int $id_detalle_cotizacion ID del detalle de cotización para el cual se desea obtener la información.
     * @return array|bool Arreglo de resultados si se encuentra el ítem con el ID proporcionado, o false si no se encuentra.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función ejecuta una consulta SQL para seleccionar los detalles del ítem de cotización de la tabla
     * 'vis_detalle_cotizacion_cotizacion' que tenga el ID de detalle de cotización proporcionado.
     * Retorna un arreglo de resultados si se encuentra el ítem con el ID proporcionado, o false si no se encuentra.
     *
     * Ejemplo de uso:
     * ```php
     * $id_detalle = 456; // ID del detalle de cotización deseado
     * $data = getItemByItems($id_detalle);
     * if ($data) {
     *     foreach ($data as $row) {
     *         echo $row['nombre_columna']; // Acceder a los valores de cada columna del ítem de cotización encontrado
     *     }
     * } else {
     *     echo "No se encontró ningún ítem de cotización con ID: " . $id_detalle;
     * }
     * ```
     */
    function getItemByItems($id_cotizacion)
    {
        $this->db->from('vis_detalle_cotizacion_cotizacion');
        $this->db->where('id_detalle_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los datos del cliente asociado a una cotización específica.
     *
     * Obtiene los datos del cliente de la tabla 'vis_cotizacion_claves' que está asociado
     * a la cotización identificada por el ID proporcionado.
     *
     * @param int $id_cotizacion ID de la cotización para la cual se desea obtener los datos del cliente.
     * @return array|bool Arreglo con los datos del cliente si se encuentra asociado a la cotización, o false si no hay resultados.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función ejecuta una consulta SQL para seleccionar los datos del cliente de la tabla 'vis_cotizacion_claves'
     * que está asociado a la cotización identificada por el ID proporcionado.
     * Retorna un arreglo con los datos del cliente si se encuentra asociado a la cotización, o false si no hay resultados.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 123; // ID de la cotización deseada
     * $cliente = getCliente($id_cotizacion);
     * if ($cliente) {
     *     echo "Nombre del cliente: " . $cliente['nombre_cliente'];
     *     echo "Correo electrónico: " . $cliente['email_cliente'];
     * } else {
     *     echo "No se encontró cliente para la cotización con ID: " . $id_cotizacion;
     * }
     * ```
     */
    function getCliente($id_cotizacion)
    {

        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * Actualiza el margen y las observaciones de un detalle de cotización específico.
     *
     * Actualiza los campos 'margen' y 'observaciones' en la tabla 'cat_detalle_cotizacion'
     * para el detalle de cotización identificado por el ID proporcionado.
     *
     * @param int $id_detalle_cotizacion ID del detalle de cotización que se desea actualizar.
     * @param float $margen Nuevo valor de margen a actualizar.
     * @param string $descripcion Nueva descripción u observación a actualizar.
     * @param array $param Array asociativo que contiene los siguientes elementos calculados:
     *                     - 'gastos_uni': Costo unitario de los gastos generales.
     *                     - 'nom_uni': Costo unitario de los gastos nominales.
     *                     - 'desc_uni': Costo unitario de los descuentos comerciales.
     *                     - 'gast_fin_uni': Costo unitario del financiamiento.
     *                     - 'flete_uni': Costo unitario del flete.
     *                     - 'comision': Costo unitario de las comisiones.
     *                     - 'costo_total': Costo total calculado de la cotización.
     *                     - 'precio_sugerido': Precio sugerido ajustado después del cálculo.
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función actualiza los campos 'margen' y 'observaciones' en la tabla 'cat_detalle_cotizacion'
     * para el registro que tiene el ID de detalle de cotización proporcionado.
     *
     * Ejemplo de uso:
     * ```php
     * $id_detalle = 123; // ID del detalle de cotización a actualizar
     * $nuevoMargen = 15.5; // Nuevo valor de margen
     * $nuevaDescripcion = "Actualización de observaciones"; // Nueva descripción u observación
     * $param = [
     *     'gastos_uni' => 50,
     *     'nom_uni' => 60,
     *     'desc_uni' => 5,
     *     'gast_fin_uni' => 30,
     *     'flete_uni' => 20,
     *     'comision' => 10,
     *     'costo_total' => 700,
     *     'precio_sugerido' => 800
     * ];
     * actualizaMargenObservacion($id_detalle, $nuevoMargen, $nuevaDescripcion, $param);
     * ```
     */
    function actualizaMargenObservacion($id_detalle_cotizacion,$margen,$descripcion,$param)
    {

        
        $campos = array(
            'gastos_uni' => $param['gastos_uni'],
            'nom_uni' => $param['nom_uni'],
            'desc_uni' => $param['desc_uni'],
            'gast_fin_uni' => $param['gast_fin_uni'],
            'flete_uni' => $param['flete_uni'],
            'comision' => $param['comision'],
            'costo_total' => $param['costo_total'],
            'margen' => $margen,
            'precio_sugerido' => $param['precio_sugerido'],
            'observaciones' => $descripcion
        );

        $this->db->where('id_detalle_cotizacion', $id_detalle_cotizacion);
        $this->db->update('cat_detalle_cotizacion', $campos);
    }

    /**
     * Actualiza el estatus (aprobar/cancelar) de un detalle de cotización específico.
     *
     * Actualiza el campo 'estatus' en la tabla 'cat_detalle_cotizacion'
     * para el detalle de cotización identificado por el ID proporcionado.
     *
     * @param int $id_detalle_cotizacion ID del detalle de cotización que se desea actualizar.
     * @param int $aprobarCancelar Nuevo valor de estatus (1 para aprobar, 0 para cancelar).
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función actualiza el campo 'estatus' en la tabla 'cat_detalle_cotizacion'
     * para el registro que tiene el ID de detalle de cotización proporcionado.
     * El parámetro $aprobarCancelar debe ser 1 para aprobar y 0 para cancelar.
     *
     * Ejemplo de uso:
     * ```php
     * $id_detalle = 123; // ID del detalle de cotización a actualizar
     * $estatus = 1; // 1 para aprobar, 0 para cancelar
     * actualizarItemAC($id_detalle, $estatus);
     * ```
     */
    function actualizarItemAC($id_detalle_cotizacion,$aprobarCancelar)
    {
        $campos = array(
            'estatus' => $aprobarCancelar
        );
        $this->db->where('id_detalle_cotizacion', $id_detalle_cotizacion);
        $this->db->update('cat_detalle_cotizacion', $campos);
    }
}
