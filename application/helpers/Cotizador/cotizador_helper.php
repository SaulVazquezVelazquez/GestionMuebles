<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Calcula el costo total y el precio sugerido de una cotización basado en los parámetros proporcionados.
 *
 * Esta función realiza cálculos detallados para determinar el costo total y el precio sugerido de una cotización,
 * considerando diferentes componentes como mano de obra, descuentos, financiamiento, flete, comisiones y margen dinámico.
 *
 * @param array $params Un array asociativo que contiene los siguientes parámetros:
 *                     - 'mano_obra': Costo de la mano de obra.
 *                     - 'descuentos_comerciales': Porcentaje de descuentos comerciales aplicados.
 *                     - 'precio_sugerido': Precio sugerido inicial.
 *                     - 'financiamiento': Porcentaje de financiamiento aplicado.
 *                     - 'flete': Porcentaje de flete aplicado.
 *                     - 'comision': Porcentaje de comisión aplicado.
 *                     - 'total_materia_prima': Costo total de la materia prima.
 *                     - 'margen_dinamico': Margen dinámico, proporcionado como un valor decimal.
 *
 * @return array Un array asociativo con los siguientes elementos calculados:
 *               - 'gastos_uni': Costo unitario de los gastos generales.
 *               - 'nom_uni': Costo unitario de los gastos nominales.
 *               - 'desc_uni': Costo unitario de los descuentos comerciales.
 *               - 'gast_fin_uni': Costo unitario del financiamiento.
 *               - 'flete_uni': Costo unitario del flete.
 *               - 'comision_uni': Costo unitario de las comisiones.
 *               - 'costo_total': Costo total calculado de la cotización.
 *               - 'margen': Margen calculado.
 *               - 'precio_sugerido': Precio sugerido ajustado después del cálculo.
 *
 * @throws No lanza excepciones explícitamente.
 *
 * @description
 * Esta función realiza cálculos iterativos para ajustar el precio sugerido de una cotización hasta que se alcance
 * el margen deseado con respecto al costo total calculado. Devuelve un array con los costos unitarios y totales,
 * así como el precio sugerido final ajustado.
 *
 * Ejemplo de uso:
 * ```php
 * $params = [
 *     'mano_obra' => 100,
 *     'descuentos_comerciales' => 5,
 *     'precio_sugerido' => 1000,
 *     'financiamiento' => 3,
 *     'flete' => 2,
 *     'comision' => 1,
 *     'total_materia_prima' => 500,
 *     'margen_dinamico' => 20
 * ];
 * $resultado = calcular_cotizacion($params);
 * print_r($resultado);
 * ```
 */
if (!function_exists('calcular_cotizacion'))
{
    function calcular_cotizacion($params,$fijos) {
        $factor_gasto = $fijos[0]['valor'];
        $factor_nomina = $fijos[1]['valor'];

        $mano_obra = $params['mano_obra'];
        $descuentos_comerciales = $params['descuentos_comerciales'];
        $precio_sugerido = 100;
        $financiamiento = $params['financiamiento'];
        $flete = $params['flete'];
        $comision = $params['comision'];
        $total_materia_prima = $params['total_materia_prima'];
        
        $margen_dinamico = floatval($params['margen_dinamico']);
        $margen_real = 100-$margen_dinamico;

        $operacion1 = $margen_real/100;
        
        do {
            $gastos_uni = $mano_obra * $factor_gasto;
            $nom_uni = $mano_obra * $factor_nomina;
            $desc_uni = ($descuentos_comerciales / 100) * $precio_sugerido;
            $gast_fin_uni = ($financiamiento / 100) * $precio_sugerido;
            $flete_uni = ($flete / 100) * $precio_sugerido;
            $comision_uni = ($comision / 100) * $precio_sugerido;
            $costo_total = $total_materia_prima + $gastos_uni + $nom_uni + $desc_uni + $gast_fin_uni + $flete_uni + $comision_uni;            
            $margen = $costo_total / $operacion1;
            $validacion = (($margen / $precio_sugerido) - 1) * 100;
            $precio_sugerido = $margen;
        } while ($validacion > 0);
        
        $param['gastos_uni'] = $gastos_uni;
        $param['nom_uni'] = $nom_uni;
        $param['desc_uni'] = $desc_uni;
        $param['gast_fin_uni'] = $gast_fin_uni;
        $param['flete_uni'] = $flete_uni;
        $param['comision'] = $comision_uni;
        $param['costo_total'] = $costo_total;
        $param['margen'] = $margen;
        $param['precio_sugerido'] = $precio_sugerido;

        return $param;
    }
}