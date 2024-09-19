<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
     * Función para calcular y organizar comisiones comerciales.
     *
     * Esta función recibe un array de datos que contiene porcentajes asociados a diferentes
     * condiciones comerciales. Organiza estos porcentajes en un arreglo asociativo según la
     * condición correspondiente ('financiamiento', 'flete', 'comision' y 'descuentos_comerciales').
     *
     * @param array $data El array de datos que contiene los porcentajes y las condiciones asociadas.
     * @return array Un arreglo asociativo con las comisiones comerciales organizadas.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para calcular y organizar diferentes comisiones comerciales
     * basadas en un conjunto de datos proporcionados. Cada porcentaje se asigna a una
     * clave específica ('financiamiento', 'flete', 'comision' y 'descuentos_comerciales')
     * según la condición asociada ('id_condicion').
     *
     * Ejemplo de uso:
     * ```php
     * $datos = array(
     *     array('id_condicion' => 1, 'porcentaje' => 10),
     *     array('id_condicion' => 2, 'porcentaje' => 5),
     *     array('id_condicion' => 18, 'porcentaje' => 2),
     *     array('id_condicion' => 5, 'porcentaje' => 3)
     * );
     * $comisiones = comisiones_comerciales($datos);
     * // Devuelve array('financiamiento' => 10, 'flete' => 5, 'comision' => 2, 'descuentos_comerciales' => 3)
     * ```
     */
    function comisiones_comerciales($data)
    {
      $total = 0;

      foreach($data as $value){

        if($value['id_condicion'] == 1){
          $param['financiamiento'] = $value['porcentaje'];
        }else if($value['id_condicion'] == 2){
          $param['flete'] = $value['porcentaje'];
        }else if($value['id_condicion'] == 18){
          $param['comision'] = $value['porcentaje'];
        }else{
          $total += floatval($value['porcentaje']);
          $param['descuentos_comerciales'] = floatval($total);
        }          
      }
      
      return $param;
    }

     /**
     * Obtiene las condiciones comerciales para un business partner específico.
     *
     * Realiza una consulta para obtener las condiciones comerciales desde la vista 'vis_condiciones_comerciales',
     * filtrando por el ID del business partner proporcionado.
     *
     * @param int $businesPartnes El ID del business partner para el cual se desea obtener las condiciones comerciales.
     * 
     * @return array|bool Retorna un arreglo con las condiciones comerciales si se encuentran registros,
     *                   de lo contrario retorna false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_condiciones_comerciales' para obtener las condiciones comerciales
     * basadas en el ID del business partner proporcionado. Retorna un arreglo con las condiciones comerciales si se encuentran registros,
     * o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $idBusinessPartner = 123; // Ejemplo de ID de business partner
     * $condicionesComerciales = getCondicionComercial($idBusinessPartner);
     * if ($condicionesComerciales) {
     *     foreach ($condicionesComerciales as $condicion) {
     *         echo "Condición: " . $condicion['condicion'] . "<br>";
     *         echo "Valor: " . $condicion['valor'] . "<br>";
     *         // Mostrar otros detalles de las condiciones comerciales según sea necesario
     *     }
     * } else {
     *     echo "No se encontraron condiciones comerciales para el business partner con ID '$idBusinessPartner'.";
     * }
     * ```
     */
    function getCondicionComercial($businesPartnes)
    {
        $CI = &get_instance();
        $CI->db->from('vis_condiciones_comerciales');
        $CI->db->where('id_business_partnes',$businesPartnes);
        $query = $CI->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function actualizarCotizacion($id_cotizacion,$id_estatus)
    {
      $campos = array('id_estatus' => $id_estatus );

        $CI = &get_instance();
        $CI->db->where('id_cotizacion', $id_cotizacion);
        $CI->db->update('ent_cotizacion', $campos);
  
    }

    /**
     * Calcula el gran total de porcentajes a partir de un arreglo de datos.
     *
     * Calcula el gran total de porcentajes sumando todos los valores de 'porcentaje'
     * presentes en el arreglo de datos proporcionado.
     *
     * @param array $data Arreglo de datos que contiene los porcentajes a sumar.
     * @return float Retorna el gran total de porcentajes calculado.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @description
     * Esta función suma los valores numéricos de la clave 'porcentaje' presentes en cada elemento del arreglo $data.
     * Retorna el resultado total de la suma de porcentajes.
     *
     * Ejemplo de uso:
     * ```php
     * $data = [
     *     ['porcentaje' => 10],
     *     ['porcentaje' => 20],
     *     ['porcentaje' => 15.5],
     * ];
     *
     * $totalPorcentaje = granTotal($data); // Retorna 45.5
     * ```
     */
    function granTotal($data)
    {
        $total = 0;
        foreach($data as $value){
            $total+=$value['porcentaje'];
        }
        return $total;
    }