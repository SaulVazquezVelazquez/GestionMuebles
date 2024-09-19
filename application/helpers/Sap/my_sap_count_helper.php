<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Realiza una solicitud para contar el número de registros desde un endpoint SAP.
 *
 * Esta función utiliza una conexión y sesión proporcionadas para realizar una solicitud GET
 * al endpoint SAP especificado, con el objetivo de obtener el número de registros disponibles.
 *
 * @param array $conexion   Arreglo que contiene los detalles de la conexión SAP, incluyendo 'endpoint' y 'metodo'.
 * @param string $session_id ID de sesión de SAP para autenticación.
 * @return mixed            Devuelve el resultado de la solicitud decodificado como un objeto JSON o null si falla.
 *
 * @author Ing. Alonso Montiel Villar
 * @version 1
 * @throws No lanza excepciones explícitamente, pero registra mensajes de error si hay problemas en la solicitud.
 *
 * @description
 * Esta función técnica realiza una solicitud GET al endpoint SAP especificado para contar el número de registros.
 * Utiliza Guzzle HTTP Client para realizar la solicitud y manejar la autenticación con SAP mediante cookies.
 * Registra mensajes de información en los logs para seguimiento y depuración.
 *
 * Ejemplo de uso:
 * ```php
 * $conexion = [
 *     'endpoint' => 'https://example.com/sap/api/',
 *     'metodo' => 'registros',
 * ];
 * $session_id = '1234567890abcdef';
 * $count = countRegistros($conexion, $session_id);
 * ```
 */
function countRegistros($conexion,$session_id) {
    log_message('info', '=====> INICIO COUNT EN SAP <=====');
    $url = $conexion['endpoint'];
    $metodo = $conexion['metodo'];
    $endpoint = $url.$metodo.'/$count';
    $cookie = 'B1SESSION='.$session_id.'; ROUTEID=.node3';

    try{

        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $response = $client->request('GET',$endpoint,[
            'headers' => [
                'return-no-content' => 'return-no-content',
                'Cookie' => $cookie
            ]
        ]);

        $success = $response->getBody()->getContents();
        $resp_decode = json_decode($success);
        return $resp_decode;
        log_message('info', "COUNT SAP SUCCESS: Response: $success");
    }catch (Exception $e) {
        $timezone = "America/Mexico_City";
        date_default_timezone_set($timezone);
        log_message('info', "COUNT SAP_ERROR: Problemas al consultar el servicio de SAP, Intenalo mas tarde. => $e");
    }

   
}


