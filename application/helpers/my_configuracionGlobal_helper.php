<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Obtiene el margen global de la configuración.
 *
 * Esta función realiza una consulta a la tabla 'conf_margen_global' para obtener
 * el margen global de configuración. Si encuentra exactamente un registro, devuelve
 * un array asociativo con los datos. En caso contrario, devuelve false.
 *
 * @return array|false   Devuelve un array con los datos del margen global si se encuentra un registro,
 *                       o false si no se encuentra ningún registro o hay más de uno.
 *
 * @author Ing. Alonso Montiel Villar
 * @version 1
 * @throws No lanza excepciones explícitamente.
 *
 * @description
 * Esta función consulta la tabla 'conf_margen_global' utilizando el objeto de base de datos de CodeIgniter.
 * Retorna el resultado como un array asociativo si se encuentra un único registro, de lo contrario, retorna false.
 *
 * Ejemplo de uso:
 * ```php
 * $margenGlobal = getMargenGlobal();
 * if ($margenGlobal) {
 *     echo "Margen global encontrado: " . $margenGlobal['nombre'] . ", " . $margenGlobal['valor'];
 * } else {
 *     echo "No se encontró margen global configurado.";
 * }
 * ```
 */
function getMargenGlobal()
{
    $CI = &get_instance();
    $CI->db->from('conf_margen_global');
    $query = $CI->db->get();
    if($query->num_rows() == 1){
        return $query->row_array();
    }else{
        return false;
    }

}


