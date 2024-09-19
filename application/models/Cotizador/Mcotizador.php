<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mcotizador extends CI_Model
{

   /**
     * Obtiene el último número consecutivo de cotización desde la tabla 'vis_cotizacion_consecutivo'.
     *
     * Busca el último número consecutivo de cotización ordenado de manera descendente por el ID de cotización.
     *
     * @return array|int|array|bool Devuelve un arreglo con los datos del último consecutivo de cotización si se encuentra, de lo contrario devuelve 0.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la tabla 'vis_cotizacion_consecutivo' para obtener el último
     * número consecutivo de cotización registrado. Devuelve un arreglo con los datos si se encuentra algún registro,
     * de lo contrario devuelve 0 si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $consecutivo = getConsecutivo();
     * print_r($consecutivo); // Imprime el arreglo con los datos del último consecutivo de cotización o 0 si no hay registros.
     * ```
     */
    function getConsecutivo()
    {
        $this->db->from('vis_cotizacion_consecutivo');
        $this->db->order_by('id_cotizacion',"desc");
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return 0;
        }
    }

    /**
     * Registra una pre-cotización en la tabla 'ent_cotizacion'.
     *
     * Inserta un nuevo registro de pre-cotización en la tabla 'ent_cotizacion'
     * con los campos y valores proporcionados en el parámetro $param.
     *
     * @param array $param Arreglo asociativo con los datos de la pre-cotización a registrar.
     *                    Debe incluir: 'folio_consecutivo', 'id_tipo_cotizacion', 'id_estatus',
     *                    'id_business_partnes', 'u_registro'.
     * @return int|false Retorna el ID generado del registro insertado si la inserción fue exitosa,
     *                   de lo contrario retorna false.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función inserta un nuevo registro de pre-cotización en la tabla 'ent_cotizacion'
     * con los datos proporcionados en el parámetro $param. Retorna el ID generado del registro insertado
     * si la inserción fue exitosa, de lo contrario retorna false.
     *
     * Ejemplo de uso:
     * ```php
     * $datos_precotizacion = array(
     *     'folio_consecutivo' => 'PRE-COT-2024-001',
     *     'id_tipo_cotizacion' => 1,
     *     'id_estatus' => 1,
     *     'id_business_partnes' => 123,
     *     'u_registro' => 'usuario123'
     * );
     * $id_insertado = registroPreCot($datos_precotizacion);
     * if ($id_insertado) {
     *     echo "Pre-cotización registrada con ID: " . $id_insertado;
     * } else {
     *     echo "Error al registrar la pre-cotización";
     * }
     * ```
     */
    function registroPreCot($param)
    {
        $campos = array(
            'folio_consecutivo' => $param['folio_consecutivo'],
            'id_tipo_cotizacion' => $param['id_tipo_cotizacion'],
            'id_estatus' => $param['id_estatus'],
            'id_business_partnes' =>$param['id_business_partnes'],
            'u_registro' =>$param['u_registro'],
            'f_registro' => date('Y-m-d\TH:i:sO')
        );
        $this->db->insert('ent_cotizacion', $campos);
        return $this->db->insert_id();
    }

   /**
     * Obtiene todas las claves y sus conceptos de la tabla 'cat_claves'.
     *
     * Realiza una consulta para obtener todas las claves y sus conceptos desde la tabla 'cat_claves',
     * ordenadas alfabéticamente por el concepto.
     *
     * @return array|bool Retorna un arreglo de claves y conceptos si se encuentran registros,
     *                   de lo contrario retorna false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la tabla 'cat_claves' para obtener todas las claves y sus conceptos.
     * Retorna un arreglo con los datos si se encuentran registros, o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $claves = getClaves();
     * if ($claves) {
     *     foreach ($claves as $clave) {
     *         echo "ID: " . $clave['id_claves'] . ", Concepto: " . $clave['concepto'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron claves.";
     * }
     * ```
     */
    function getClaves()
    {
        $this->db->select('id_claves,concepto');
        $this->db->from('cat_claves');
        $this->db->order_by('concepto',"ASC");
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene el detalle del cliente basado en el folio consecutivo.
     *
     * Realiza una consulta para obtener el detalle del cliente desde la vista 'vis_detalle_cot_cliente',
     * filtrando por el folio consecutivo proporcionado.
     *
     * @param string $const El folio consecutivo utilizado para filtrar el detalle del cliente.
     * 
     * @return array|bool Retorna un arreglo con los datos del detalle del cliente si se encuentra un registro,
     *                   de lo contrario retorna false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_detalle_cot_cliente' para obtener el detalle del cliente
     * basado en el folio consecutivo proporcionado. Retorna un arreglo con los datos si se encuentra un registro,
     * o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $folio = 'ABC123'; // Ejemplo de folio consecutivo
     * $detalleCliente = getDetalleCliente($folio);
     * if ($detalleCliente) {
     *     echo "Nombre del cliente: " . $detalleCliente['nombre_cliente'] . "<br>";
     *     echo "Correo electrónico: " . $detalleCliente['email_cliente'] . "<br>";
     *     // Mostrar otros detalles según sea necesario
     * } else {
     *     echo "No se encontró detalle del cliente para el folio consecutivo '$folio'.";
     * }
     * ```
     */
    function getDetalleCliente($const)
    {
        $this->db->from(' vis_detalle_cot_cliente');
        $this->db->where('folio_consecutivo',$const);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /**
     * Registra una relación entre una clave y una cotización en la tabla 'rom_cotizacion_has_claves'.
     *
     * Inserta un nuevo registro en la tabla 'rom_cotizacion_has_claves' para establecer la relación
     * entre una clave específica y una cotización específica.
     *
     * @param int $item El ID de la clave que se desea relacionar con la cotización.
     * @param int $id_cotizacion El ID de la cotización a la cual se desea asociar la clave.
     * 
     * @return int El ID generado automáticamente para el nuevo registro insertado en la tabla 'rom_cotizacion_has_claves'.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función inserta un nuevo registro en la tabla 'rom_cotizacion_has_claves' para relacionar una clave específica
     * con una cotización específica. Retorna el ID generado automáticamente para el nuevo registro insertado.
     *
     * Ejemplo de uso:
     * ```php
     * $idClave = 1; // Ejemplo de ID de la clave a relacionar
     * $idCotizacion = 100; // Ejemplo de ID de la cotización a asociar
     * $registroId = registroCotCla($idClave, $idCotizacion);
     * echo "Se ha registrado la relación entre la clave $idClave y la cotización $idCotizacion con ID $registroId.";
     * ```
     */
    function registroCotCla($item,$id_cotizcion)
    {
        $campos = array(
            'id_claves' => $item,
            'id_cotizacion' => $id_cotizcion
        );
        $this->db->insert('rom_cotizacion_has_claves', $campos);
        return $this->db->insert_id();
    }

    /**
     * Obtiene los detalles de los ítems de una cotización específica.
     *
     * Consulta la tabla 'vis_cotizacion_claves' para obtener los detalles de los ítems asociados a una cotización
     * específica identificada por su ID.
     *
     * @param int $id_cotizacion El ID de la cotización para la cual se desean obtener los detalles de los ítems.
     * 
     * @return array|false Un array de filas de resultados de la consulta si se encuentran registros, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función consulta la tabla 'vis_cotizacion_claves' y retorna un array de filas con los detalles de los ítems
     * asociados a la cotización específica identificada por $id_cotizacion. Retorna false si no se encuentran registros.
     *
     * Ejemplo de uso:
     * ```php
     * $idCotizacion = 1; // ID de la cotización de la cual se desean obtener los detalles de los ítems
     * $detallesItems = MdetalleItemsT($idCotizacion);
     * if ($detallesItems) {
     *     foreach ($detallesItems as $item) {
     *         echo "ID Clave: " . $item['id_claves'] . ", Concepto: " . $item['concepto'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron detalles de ítems para la cotización con ID $idCotizacion.";
     * }
     * ```
     */
    function MdetalleItemsT($id_cotizcion)
    {
        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizacion',$id_cotizcion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los detalles de un ítem de cotización por su ID específico.
     *
     * Consulta la tabla 'vis_cotizacion_claves' para obtener los detalles de un ítem de cotización específico
     * identificado por su ID.
     *
     * @param int $id_cotizaciones_claves El ID del ítem de cotización para el cual se desean obtener los detalles.
     * 
     * @return array|false Un array de filas de resultados de la consulta si se encuentra el ítem, o false si no se encuentra ningún ítem con el ID especificado.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función consulta la tabla 'vis_cotizacion_claves' y retorna un array de filas con los detalles de un
     * ítem de cotización específico identificado por $id_cotizaciones_claves. Retorna false si no se encuentra ningún ítem con ese ID.
     *
     * Ejemplo de uso:
     * ```php
     * $idItemCotizacion = 1; // ID del ítem de cotización del cual se desean obtener los detalles
     * $detallesItem = MdetalleItemsById($idItemCotizacion);
     * if ($detallesItem) {
     *     echo "ID Clave: " . $detallesItem['id_claves'] . ", Concepto: " . $detallesItem['concepto'];
     * } else {
     *     echo "No se encontró ningún ítem de cotización con ID $idItemCotizacion.";
     * }
     * ```
     */
    function MdetalleItemsById($id_cotizcion)
    {
        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizaciones_claves',$id_cotizcion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los detalles de un ítem de cotización temporal por su ID específico.
     *
     * Consulta la tabla 'vis_temp_cotizacion' para obtener los detalles de un ítem de cotización temporal específico
     * identificado por su ID.
     *
     * @param int $id_temp_cotizacion El ID del ítem de cotización temporal para el cual se desean obtener los detalles.
     * 
     * @return array|false Un array de filas de resultados de la consulta si se encuentra el ítem, o false si no se encuentra ningún ítem con el ID especificado.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función consulta la tabla 'vis_temp_cotizacion' y retorna un array de filas con los detalles de un
     * ítem de cotización temporal específico identificado por $id_temp_cotizacion. Retorna false si no se encuentra ningún ítem con ese ID.
     *
     * Ejemplo de uso:
     * ```php
     * $idItemCotizacionTemporal = 1; // ID del ítem de cotización temporal del cual se desean obtener los detalles
     * $detallesItemTemporal = MItemDetalleById($idItemCotizacionTemporal);
     * if ($detallesItemTemporal) {
     *     echo "ID Temporal Cotización: " . $detallesItemTemporal[0]['id_temp_cotizacion'] . ", Descripción: " . $detallesItemTemporal[0]['descripcion'];
     * } else {
     *     echo "No se encontró ningún ítem de cotización temporal con ID $idItemCotizacionTemporal.";
     * }
     * ```
     */
    function MItemDetalleById($id_cotizcion)
    {
        $this->db->from('vis_temp_cotizacion');
        $this->db->where('id_temp_cotizacion',$id_cotizcion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Valida la existencia de una relación entre una cotización y una clave específica.
     *
     * Verifica si existe una relación entre una cotización identificada por $id_cotizcion y una clave identificada por $item
     * en la tabla 'rom_cotizacion_has_claves'.
     *
     * @param int $item El ID de la clave que se desea verificar si está relacionada con la cotización.
     * @param int $id_cotizcion El ID de la cotización con la que se desea verificar la relación de la clave.
     * 
     * @return bool Retorna true si existe una relación entre la cotización y la clave especificadas, o false en caso contrario.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función consulta la tabla 'rom_cotizacion_has_claves' para verificar si existe una relación entre
     * la cotización identificada por $id_cotizcion y la clave identificada por $item. Retorna true si la relación existe, 
     * o false si no existe ninguna relación.
     *
     * Ejemplo de uso:
     * ```php
     * $idClave = 1; // ID de la clave que se desea verificar
     * $idCotizacion = 5; // ID de la cotización con la que se desea verificar la relación de la clave
     * if (validaCotClave($idClave, $idCotizacion)) {
     *     echo "La clave con ID $idClave está relacionada con la cotización $idCotizacion.";
     * } else {
     *     echo "La clave con ID $idClave no está relacionada con la cotización $idCotizacion.";
     * }
     * ```
     */
    function validaCotClave($item,$id_cotizcion)
    {
        $this->db->from('rom_cotizacion_has_claves');
        $this->db->where('id_cotizacion',$id_cotizcion);
        $this->db->where('id_claves',$item);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return true;

        }else{
            return false;
        }
    }

    /**
     * Registra una relación entre una cotización y una clave con variante en la base de datos.
     *
     * Inserta un nuevo registro en la tabla 'rom_cotizacion_has_claves' para establecer una relación entre una cotización
     * y una clave con variante específicas, según los parámetros proporcionados.
     *
     * @param array $param Un array asociativo que contiene los siguientes elementos:
     *   - 'id_cotizacion' (int): El ID de la cotización con la que se desea establecer la relación.
     *   - 'id_claves' (int): El ID de la clave con la que se desea establecer la relación.
     *   - 'variante' (string): La variante asociada a la clave en la relación.
     *   - 'id_padre' (int): El ID del elemento padre asociado a la clave en la relación (si aplica).
     * 
     * @return int El ID generado automáticamente del nuevo registro insertado en la tabla 'rom_cotizacion_has_claves'.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función inserta un nuevo registro en la tabla 'rom_cotizacion_has_claves' con los datos proporcionados en el
     * parámetro $param. Retorna el ID generado automáticamente para el nuevo registro insertado.
     *
     * Ejemplo de uso:
     * ```php
     * $datos = [
     *     'id_cotizacion' => 1,
     *     'id_claves' => 5,
     *     'variante' => 'Variante A',
     *     'id_padre' => 10
     * ];
     * $idNuevoRegistro = registroCotClaV($datos);
     * echo "Se ha registrado correctamente la relación con ID $idNuevoRegistro.";
     * ```
     */
    function registroCotClaV($param)
    {
        $campos = array(
            'id_cotizacion' => $param['id_cotizacion'],
            'id_claves' => $param['id_claves'],
            'variante' => $param['variante'],
            'id_padre' => $param['id_padre']
        );
        $this->db->insert('rom_cotizacion_has_claves', $campos);
        return $this->db->insert_id();
    }

    /**
     * Obtiene los detalles de telas asociados a una clave específica de una cotización.
     *
     * Realiza una consulta a la base de datos para obtener los detalles de telas asociados a una clave específica
     * de una cotización, identificada por los parámetros proporcionados.
     *
     * @param int $id_cotizaciones_claves El ID de la clave de la cotización para la cual se desean obtener los detalles de telas.
     * @param int $id_cotizacion El ID de la cotización a la cual pertenece la clave.
     * 
     * @return array|false Un array de filas resultantes de la consulta si se encontraron detalles de telas para la clave y cotización especificadas,
     *                     o false si no se encontraron resultados.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_cotizacion_claves' para obtener los detalles de telas asociados a una clave específica de una cotización.
     * Retorna un array de filas resultantes de la consulta si se encontraron detalles de telas para la clave y cotización especificadas, o false si no se encontraron resultados.
     *
     * Ejemplo de uso:
     * ```php
     * $id_clave = 1;
     * $id_cotizacion = 10;
     * $detallesTelas = getTelasDetalle($id_clave, $id_cotizacion);
     * if ($detallesTelas) {
     *     foreach ($detallesTelas as $detalle) {
     *         echo "Detalles de Telas: " . print_r($detalle, true) . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron detalles de telas para la clave y cotización especificadas.";
     * }
     * ```
     */
    function getTelasDetalle($id_cotizacion)
    {
        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene el costo de una tela específica basado en su ID.
     *
     * Realiza una consulta a la base de datos para obtener el costo de una tela específica
     * identificada por el ID proporcionado.
     *
     * @param int $id_tela El ID de la tela para la cual se desea obtener el costo.
     * 
     * @return array|false Un array con la fila resultante de la consulta si se encontró el costo de la tela,
     *                     o false si no se encontraron resultados.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_precios_telas' para obtener el costo de una tela específica.
     * Retorna un array con la fila resultante de la consulta si se encontró el costo de la tela, o false si no se encontraron resultados.
     *
     * Ejemplo de uso:
     * ```php
     * $id_tela = 1;
     * $costoTela = getCostoTela($id_tela);
     * if ($costoTela) {
     *     echo "Costo de la tela: " . print_r($costoTela, true);
     * } else {
     *     echo "No se encontró el costo de la tela para el ID especificado.";
     * }
     * ```
     */
    function getCostoTela($id_tela)
    {
        
        $this->db->from('vis_precios_telas');
        $this->db->where('id_oitm',$id_tela);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    
    /**
     * Registra una cotización temporal con todos los detalles específicos.
     *
     * Inserta una nueva fila en la tabla 'temp_cotizacion' con los parámetros proporcionados,
     * incluyendo detalles como telas, patas, herrajes, ebanistería, entre otros.
     *
     * @param array $params Un array asociativo con todos los parámetros necesarios para registrar la cotización temporal.
     *                      Los parámetros pueden incluir:
     *                      - id_cotizaciones_claves: ID de las claves asociadas a la cotización.
     *                      - id_cotizacion: ID de la cotización principal.
     *                      - codigo_sap_articulo: Código SAP del artículo.
     *                      - mano_obra: Costo de la mano de obra.
     *                      - id_tela_uno, id_tela_dos, id_tela_tres, id_tela_cuatro: IDs de las telas utilizadas.
     *                      - mts_uno, mts_dos, mts_tres, mts_cuatro: Metros de tela utilizados.
     *                      - precio_costo_uno, precio_costo_dos, precio_costo_tres, precio_costo_cuatro: Precios de costo de las telas.
     *                      - importe_uno, importe_dos, importe_tres, importe_cuatro: Importes calculados para las telas.
     *                      - id_pata_uno, id_pata_dos: IDs de las patas utilizadas.
     *                      - pata_uno, pata_dos: Cantidades de patas utilizadas.
     *                      - precio_costo_pata_uno, precio_costo_pata_dos: Precios de costo de las patas.
     *                      - importe_pata_uno, importe_pata_dos: Importes calculados para las patas.
     *                      - id_herraje_uno, id_herraje_dos: IDs de los herrajes utilizados.
     *                      - herraje_uno, herraje_dos: Cantidades de herrajes utilizados.
     *                      - precio_costo_herraje_uno, precio_costo_herraje_dos: Precios de costo de los herrajes.
     *                      - importe_herraje_uno, importe_herraje_dos: Importes calculados para los herrajes.
     *                      - id_ebanesteria_uno, id_ebanesteria_dos, id_ebanesteria_tres: IDs de la ebanistería utilizada.
     *                      - ebanesteria_uno, ebanesteria_dos, ebanesteria_tres: Cantidades de ebanistería utilizada.
     *                      - precio_costo_ebanesteria_uno, precio_costo_ebanesteria_dos, precio_costo_ebanesteria_tres: Precios de costo de la ebanistería.
     *                      - importe_ebanesteria_uno, importe_ebanesteria_dos, importe_ebanesteria_tres: Importes calculados para la ebanistería.
     *                      - id_padre: ID del padre si existe.
     *                      - descripcion_general: Descripción general de la cotización.
     *                      - imagen: Ruta o nombre de la imagen asociada.
     *                      - id_cliente: ID del cliente asociado.
     *                      - nombre_tela_uno, nombre_tela_dos, nombre_tela_tres, nombre_tela_cuatro: Nombres de las telas utilizadas.
     *                      - nombre_pata_uno, nombre_pata_dos: Nombres de las patas utilizadas.
     *                      - nombre_herraje_uno, nombre_herraje_dos: Nombres de los herrajes utilizados.
     *                      - nombre_ebanesteria_uno, nombre_ebanesteria_dos, nombre_ebanesteria_tres: Nombres de la ebanistería utilizada.
     *                      - clave_tela_uno, clave_tela_dos, clave_tela_tres, clave_tela_cuatro: Claves de las telas utilizadas.
     *                      - clave_pata_uno, clave_pata_dos: Claves de las patas utilizadas.
     *                      - clave_herraje_uno, clave_herraje_dos: Claves de los herrajes utilizados.
     *                      - clave_ebanesteria_uno, clave_ebanesteria_dos, clave_ebanesteria_tres: Claves de la ebanistería utilizada.
     *
     * @return int El ID generado automáticamente por la base de datos para la nueva cotización temporal registrada.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función permite registrar una cotización temporal en la base de datos con todos los detalles
     * necesarios para el artículo, incluyendo especificaciones de telas, patas, herrajes, ebanistería, etc.
     * Retorna el ID generado automáticamente por la base de datos para la nueva cotización temporal.
     *
     * Ejemplo de uso:
     * ```php
     * $params = array(
     *     'id_cotizaciones_claves' => 1,
     *     'id_cotizacion' => 100,
     *     'codigo_sap_articulo' => 'ART001',
     *     // Incluir todos los demás parámetros necesarios
     * );
     * $registroId = registroTempCot($params);
     * echo "ID de la cotización temporal registrada: " . $registroId;
     * ```
     */
    function registroTempCot($params)
    {
        $id_cotizaciones_claves = isset($params['id_cotizaciones_claves']) ? $params['id_cotizaciones_claves'] : null;
        $id_cotizacion = isset($params['id_cotizacion']) ? $params['id_cotizacion'] : null;
        $codigo_sap_articulo = isset($params['codigo_sap_articulo']) ? $params['codigo_sap_articulo'] : null;
        $mano_obra = isset($params['mano_obra']) ? $params['mano_obra'] : null;

        $id_tela_uno = isset($params['id_tela_uno']) ? $params['id_tela_uno'] : null;
        $mts_uno = isset($params['mts_uno']) ? $params['mts_uno'] : null;
        $precio_costo_uno = isset($params['precio_costo_uno']) ? $params['precio_costo_uno'] : null;
        $importe_uno = isset($params['importe_uno']) ? $params['importe_uno'] : null;

        $id_tela_dos = isset($params['id_tela_dos']) ? $params['id_tela_dos'] : null;
        $mts_dos = isset($params['mts_dos']) ? $params['mts_dos'] : null;
        $precio_costo_dos = isset($params['precio_costo_dos']) ? $params['precio_costo_dos'] : null;
        $importe_dos = isset($params['importe_dos']) ? $params['importe_dos'] : null;

        $id_tela_tres = isset($params['id_tela_tres']) ? $params['id_tela_tres'] : null;
        $mts_tres = isset($params['mts_tres']) ? $params['mts_tres'] : null;
        $precio_costo_tres = isset($params['precio_costo_tres']) ? $params['precio_costo_tres'] : null;
        $importe_tres = isset($params['importe_tres']) ? $params['importe_tres'] : null;

        $id_tela_cuatro = isset($params['id_tela_cuatro']) ? $params['id_tela_cuatro'] : null;
        $mts_cuatro = isset($params['mts_cuatro']) ? $params['mts_cuatro'] : null;
        $precio_costo_cuatro = isset($params['precio_costo_cuatro']) ? $params['precio_costo_cuatro'] : null;
        $importe_cuatro = isset($params['importe_cuatro']) ? $params['importe_cuatro'] : null;

        $id_pata_uno = isset($params['id_pata_uno']) ? $params['id_pata_uno'] : null;
        $pata_uno = isset($params['pata_uno']) ? $params['pata_uno'] : null;
        $precio_costo_pata_uno = isset($params['precio_costo_pata_uno']) ? $params['precio_costo_pata_uno'] : null;
        $importe_pata_uno = isset($params['importe_pata_uno']) ? $params['importe_pata_uno'] : null;

        $id_pata_dos = isset($params['id_pata_dos']) ? $params['id_pata_dos'] : null;
        $pata_dos = isset($params['pata_dos']) ? $params['pata_dos'] : null;
        $precio_costo_pata_dos = isset($params['precio_costo_pata_dos']) ? $params['precio_costo_pata_dos'] : null;
        $importe_pata_dos = isset($params['importe_pata_dos']) ? $params['importe_pata_dos'] : null;

        $id_herraje_uno = isset($params['id_herraje_uno']) ? $params['id_herraje_uno'] : null;
        $herraje_uno = isset($params['herraje_uno']) ? $params['herraje_uno'] : null;
        $precio_costo_herraje_uno = isset($params['precio_costo_herraje_uno']) ? $params['precio_costo_herraje_uno'] : null;
        $importe_herraje_uno = isset($params['importe_herraje_uno']) ? $params['importe_herraje_uno'] : null;

        $id_herraje_dos = isset($params['id_herraje_dos']) ? $params['id_herraje_dos'] : null;
        $herraje_dos = isset($params['herraje_dos']) ? $params['herraje_dos'] : null;
        $precio_costo_herraje_dos = isset($params['precio_costo_herraje_dos']) ? $params['precio_costo_herraje_dos'] : null;
        $importe_herraje_dos = isset($params['importe_herraje_dos']) ? $params['importe_herraje_dos'] : null;

        $id_ebanesteria_uno = isset($params['id_ebanesteria_uno']) ? $params['id_ebanesteria_uno'] : null;
        $ebanesteria_uno = isset($params['ebanesteria_uno']) ? $params['ebanesteria_uno'] : null;
        $precio_costo_ebanesteria_uno = isset($params['precio_costo_ebanesteria_uno']) ? $params['precio_costo_ebanesteria_uno'] : null;
        $importe_ebanesteria_uno = isset($params['importe_ebanesteria_uno']) ? $params['importe_ebanesteria_uno'] : null;

        $id_ebanesteria_dos = isset($params['id_ebanesteria_dos']) ? $params['id_ebanesteria_dos'] : null;
        $ebanesteria_dos = isset($params['ebanesteria_dos']) ? $params['ebanesteria_dos'] : null;
        $precio_costo_ebanesteria_dos = isset($params['precio_costo_ebanesteria_dos']) ? $params['precio_costo_ebanesteria_dos'] : null;
        $importe_ebanesteria_dos = isset($params['importe_ebanesteria_dos']) ? $params['importe_ebanesteria_dos'] : null;

        $id_ebanesteria_tres = isset($params['id_ebanesteria_tres']) ? $params['id_ebanesteria_tres'] : null;
        $ebanesteria_tres = isset($params['ebanesteria_tres']) ? $params['ebanesteria_tres'] : null;
        $precio_costo_ebanesteria_tres = isset($params['precio_costo_ebanesteria_tres']) ? $params['precio_costo_ebanesteria_tres'] : null;
        $importe_ebanesteria_tres = isset($params['importe_ebanesteria_tres']) ? $params['importe_ebanesteria_tres'] : null;

        $id_padre = isset($params['id_padre']) ? $params['id_padre'] : null;

        $descripcion_general = isset($params['descripcion_general']) ? $params['descripcion_general'] : null;
        $imagen = isset($params['imagen']) ? $params['imagen'] : null;
        $id_cliente = isset($params['id_cliente']) ? $params['id_cliente'] : null;
        $cliente = isset($params['cliente']) ? $params['cliente'] : null;

        $nombre_tela_uno = isset($params['nombre_tela_uno']) ? $params['nombre_tela_uno'] : null;
        $nombre_tela_dos = isset($params['nombre_tela_dos']) ? $params['nombre_tela_dos'] : null;
        $nombre_tela_tres = isset($params['nombre_tela_tres']) ? $params['nombre_tela_tres'] : null;
        $nombre_tela_cuatro = isset($params['nombre_tela_cuatro']) ? $params['nombre_tela_cuatro'] : null;

        $nombre_pata_uno = isset($params['nombre_pata_uno']) ? $params['nombre_pata_uno'] : null;
        $nombre_pata_dos = isset($params['nombre_pata_dos']) ? $params['nombre_pata_dos'] : null;

        $nombre_herraje_uno = isset($params['nombre_herraje_uno']) ? $params['nombre_herraje_uno'] : null;
        $nombre_herraje_dos = isset($params['nombre_herraje_dos']) ? $params['nombre_herraje_dos'] : null;

        $nombre_ebanesteria_uno = isset($params['nombre_ebanesteria_uno']) ? $params['nombre_ebanesteria_uno'] : null;
        $nombre_ebanesteria_dos = isset($params['nombre_ebanesteria_dos']) ? $params['nombre_ebanesteria_dos'] : null;
        $nombre_ebanesteria_tres = isset($params['nombre_ebanesteria_tres']) ? $params['nombre_ebanesteria_tres'] : null;

        $clave_tela_uno = isset($params['clave_tela_uno']) ? $params['clave_tela_uno'] : null;
        $clave_tela_dos = isset($params['clave_tela_dos']) ? $params['clave_tela_dos'] : null;
        $clave_tela_tres = isset($params['clave_tela_tres']) ? $params['clave_tela_tres'] : null;
        $clave_tela_cuatro = isset($params['clave_tela_cuatro']) ? $params['clave_tela_cuatro'] : null;

        $clave_pata_uno = isset($params['clave_pata_uno']) ? $params['clave_pata_uno'] : null;
        $clave_pata_dos = isset($params['clave_pata_dos']) ? $params['clave_pata_dos'] : null;

        $clave_herraje_uno = isset($params['clave_herraje_uno']) ? $params['clave_herraje_uno'] : null;
        $clave_herraje_dos = isset($params['clave_herraje_dos']) ? $params['clave_herraje_dos'] : null;

        $clave_ebanesteria_uno = isset($params['clave_ebanesteria_uno']) ? $params['clave_ebanesteria_uno'] : null;
        $clave_ebanesteria_dos = isset($params['clave_ebanesteria_dos']) ? $params['clave_ebanesteria_dos'] : null;
        $clave_ebanesteria_tres = isset($params['clave_ebanesteria_tres']) ? $params['clave_ebanesteria_tres'] : null;



        $campos = array(
            'id_cotizaciones_claves' => $id_cotizaciones_claves,
            'id_cotizacion' => $id_cotizacion,
            'codigo_sap_articulo' => $codigo_sap_articulo,
            'mano_obra' =>$mano_obra,
            'id_tela_uno' =>$id_tela_uno,
            'mts_uno' => $mts_uno,
            'precio_costo_uno' => $precio_costo_uno,
            'importe_uno' => $importe_uno,
            'id_tela_dos' =>$id_tela_dos,
            'mts_dos' => $mts_dos,
            'precio_costo_dos' => $precio_costo_dos,
            'importe_dos' => $importe_dos,
            'id_tela_tres' =>$id_tela_tres,
            'mts_tres' => $mts_tres,
            'precio_costo_tres' => $precio_costo_tres,
            'importe_tres' => $importe_tres,
            'id_tela_cuatro' =>$id_tela_cuatro,
            'mts_cuatro' => $mts_cuatro,
            'precio_costo_cuatro' => $precio_costo_cuatro,
            'importe_cuatro' => $importe_cuatro,
            'id_pata_uno' =>$id_pata_uno,
            'pz_pata_uno' => $pata_uno,
            'precio_costo_pata_uno' => $precio_costo_pata_uno,
            'importe_pata_uno' => $importe_pata_uno,
            'id_pata_dos' => $id_pata_dos,
            'pz_pata_dos' => $pata_dos,
            'precio_costo_pata_dos' => $precio_costo_pata_dos,
            'importe_pata_dos' => $importe_pata_dos,
            'id_herraje_uno' => $id_herraje_uno,
            'pz_herraje_uno' => $herraje_uno,
            'precio_costo_herraje_uno' => $precio_costo_herraje_uno,
            'importe_herraje_uno' => $importe_herraje_uno,
            'id_herraje_dos' => $id_herraje_dos,
            'pz_herraje_dos' => $herraje_dos,
            'precio_costo_herraje_dos' => $precio_costo_herraje_dos,
            'importe_herraje_dos' => $importe_herraje_dos,
            'id_ebanesteria_uno' => $id_ebanesteria_uno,
            'pz_ebanesteria_uno' => $ebanesteria_uno,
            'precio_costo_ebanesteria_uno' => $precio_costo_ebanesteria_uno,
            'importe_ebanesteria_uno' => $importe_ebanesteria_uno,
            'id_ebanesteria_dos' => $id_ebanesteria_dos,
            'pz_ebanesteria_dos' => $ebanesteria_dos,
            'precio_costo_ebanesteria_dos' => $precio_costo_ebanesteria_dos,
            'importe_ebanesteria_dos' => $importe_ebanesteria_dos,
            'id_ebanesteria_tres' => $id_ebanesteria_tres,
            'pz_ebanesteria_tres' => $ebanesteria_tres,
            'precio_costo_ebanesteria_tres' => $precio_costo_ebanesteria_tres,
            'importe_ebanesteria_tres' => $importe_ebanesteria_tres,
            'id_padre' => $id_padre,
            'descripcion_general' => $descripcion_general,
            'imagen' => $imagen,
            'id_cliente' => $id_cliente,
            'nombre_tela_uno' => $nombre_tela_uno,
            'nombre_tela_dos' => $nombre_tela_dos,
            'nombre_tela_tres' => $nombre_tela_tres,
            'nombre_tela_cuatro' => $nombre_tela_cuatro,
            'nombre_pata_uno' => $nombre_pata_uno,
            'nombre_pata_dos' => $nombre_pata_dos,
            'nombre_herraje_uno' => $nombre_herraje_uno,
            'nombre_herraje_dos' => $nombre_herraje_dos,
            'nombre_ebanesteria_uno' => $nombre_ebanesteria_uno,
            'nombre_ebanesteria_dos' => $nombre_ebanesteria_dos,
            'nombre_ebanesteria_tres' => $nombre_ebanesteria_tres,
            'clave_tela_uno' => $clave_tela_uno,
            'clave_tela_dos' => $clave_tela_dos,
            'clave_tela_tres' => $clave_tela_tres,
            'clave_tela_cuatro' => $clave_tela_cuatro,
            'clave_pata_uno' => $clave_pata_uno,
            'clave_pata_dos' => $clave_pata_dos,
            'clave_herraje_uno' => $clave_herraje_uno,
            'clave_herraje_dos' => $clave_herraje_dos,
            'clave_ebanesteria_uno' => $clave_ebanesteria_uno,
            'clave_ebanesteria_dos' => $clave_ebanesteria_dos,
            'clave_ebanesteria_tres' => $clave_ebanesteria_tres
        );
        $this->db->insert('temp_cotizacion', $campos);
        return $this->db->insert_id();
    }

    /**
     * Obtiene el costo de una pata específica por su ID.
     *
     * Busca en la vista 'vis_patas' el registro que corresponda al ID de la pata proporcionado.
     *
     * @param int $id_pata El ID de la pata cuyo costo se desea obtener.
     *
     * @return array|false Un array con la fila correspondiente al costo de la pata si se encuentra,
     *                     o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_patas' para obtener el costo de una pata específica
     * identificada por su ID. Retorna un array con la información del costo de la pata si se encuentra,
     * o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $id_pata = 1;
     * $costoPata = getCostoPata($id_pata);
     * if ($costoPata) {
     *     echo "El costo de la pata es: " . $costoPata['costo'];
     * } else {
     *     echo "No se encontró información de la pata con ID: " . $id_pata;
     * }
     * ```
     */
    function getCostoPata($id_pata)
    {
        
        $this->db->from('vis_patas');
        $this->db->where('id_oitm',$id_pata);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene el costo de un herraje específico por su ID.
     *
     * Busca en la vista 'vis_herraje_importado' el registro que corresponda al ID del herraje proporcionado.
     *
     * @param int $id_herraje El ID del herraje cuyo costo se desea obtener.
     *
     * @return array|false Un array con la fila correspondiente al costo del herraje si se encuentra,
     *                     o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_herraje_importado' para obtener el costo de un herraje específico
     * identificado por su ID. Retorna un array con la información del costo del herraje si se encuentra,
     * o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $id_herraje = 1;
     * $costoHerraje = getCostoHerraje($id_herraje);
     * if ($costoHerraje) {
     *     echo "El costo del herraje es: " . $costoHerraje['costo'];
     * } else {
     *     echo "No se encontró información del herraje con ID: " . $id_herraje;
     * }
     * ```
     */
    function getCostoHerraje($id_herraje)
    {
        
        $this->db->from('vis_herraje_importado');
        $this->db->where('id_oitm',$id_herraje);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene el costo de una ebanistería específica por su ID.
     *
     * Busca en la vista 'vis_ebanisteria' el registro que corresponda al ID de la ebanistería proporcionado.
     *
     * @param int $id_ebanesteria El ID de la ebanistería cuyo costo se desea obtener.
     *
     * @return array|false Un array con la fila correspondiente al costo de la ebanistería si se encuentra,
     *                     o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_ebanisteria' para obtener el costo de una ebanistería específica
     * identificada por su ID. Retorna un array con la información del costo de la ebanistería si se encuentra,
     * o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $id_ebanisteria = 1;
     * $costoEbanisteria = getCostoEbanisteria($id_ebanisteria);
     * if ($costoEbanisteria) {
     *     echo "El costo de la ebanistería es: " . $costoEbanisteria['costo'];
     * } else {
     *     echo "No se encontró información de la ebanistería con ID: " . $id_ebanisteria;
     * }
     * ```
     */
    function getCostoEbanesteria($id_ebanesteria)
    {
        
        $this->db->from('vis_ebanesteria');
        $this->db->where('id_oitm',$id_ebanesteria);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los detalles de los ítems temporales de una cotización por su ID de cotización.
     *
     * Realiza una consulta a la tabla 'temp_cotizacion' para obtener todos los detalles de los ítems temporales
     * correspondientes a una cotización específica identificada por su ID de cotización.
     *
     * @param int $id_cotizacion El ID de la cotización para la cual se desean obtener los detalles de los ítems temporales.
     *
     * @return array|false Un array con todas las filas correspondientes a los detalles de los ítems temporales si se encuentran,
     *                     o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la tabla 'temp_cotizacion' para obtener los detalles de los ítems temporales
     * de una cotización específica identificada por su ID de cotización. Retorna un array con todas las filas
     * correspondientes a los detalles de los ítems temporales si se encuentran, o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 1;
     * $detallesTempCot = getDetallesTempCotItem($id_cotizacion);
     * if ($detallesTempCot) {
     *     foreach ($detallesTempCot as $detalle) {
     *         echo "ID Temp Cotización: " . $detalle['id_temp_cotizacion'] . ", Código SAP Artículo: " . $detalle['codigo_sap_articulo'] . "\n";
     *     }
     * } else {
     *     echo "No se encontraron detalles de ítems temporales para la cotización con ID: " . $id_cotizacion;
     * }
     * ```
     */
    function getDetallesTempCotItem($id_cotizacion)
    {
        $this->db->from('temp_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene el kit asociado a un artículo padre y código SAP dado.
     *
     * Realiza una consulta a la vista 'vis_precios_items' para obtener el kit asociado a un artículo padre específico
     * identificado por su código SAP y que esté habilitado para el kit.
     *
     * @param string $kitHab El código del artículo padre que representa el kit habilitado.
     * @param string $codigo_sap El código SAP del artículo para el cual se desea obtener el kit asociado.
     *
     * @return array|false Un array con todas las filas correspondientes al kit asociado si se encuentran,
     *                     o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función realiza una consulta a la vista 'vis_precios_items' para obtener el kit asociado a un artículo padre
     * específico identificado por su código SAP y que esté habilitado para el kit. Retorna un array con todas las filas
     * correspondientes al kit asociado si se encuentran, o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $kitHab = 'KIT001';
     * $codigo_sap = 'ART001';
     * $kit = getKit($kitHab, $codigo_sap);
     * if ($kit) {
     *     foreach ($kit as $item) {
     *         echo "ID: " . $item['id'] . ", Descripción: " . $item['descripcion'] . "\n";
     *     }
     * } else {
     *     echo "No se encontró ningún kit asociado para el artículo padre: " . $kitHab . " y código SAP: " . $codigo_sap;
     * }
     * ```
     */
    function getKit($kitHab,$codigo_sap)
    {
        $this->db->from('vis_precios_items');
        $this->db->where('fhater',$kitHab);
        
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Registra un nuevo kit en la tabla 'temp_kits_hb'.
     *
     * Registra un nuevo kit con los parámetros proporcionados en la tabla 'temp_kits_hb'. Los parámetros incluyen
     * información como el ID del artículo padre, el código del kit, la cantidad, el ID del artículo, el precio de costo,
     * y las claves de cotización asociadas.
     *
     * @param array $params Un array asociativo con los siguientes índices opcionales:
     *   - 'id_ittm1' (int): El ID del artículo padre.
     *   - 'fhater' (string): El código del kit.
     *   - 'code' (string): El código del artículo.
     *   - 'quantity' (int): La cantidad del kit.
     *   - 'id_itm1' (int): El ID del artículo.
     *   - 'precio_costo' (float): El precio de costo del kit.
     *   - 'kit' (string): El kit.
     *   - 'id_cotizaciones_claves' (int): El ID de las claves de la cotización.
     *   - 'id_cotizacion' (int): El ID de la cotización.
     *
     * @return int El ID generado para el registro insertado en la tabla 'temp_kits_hb', o 0 si la inserción falla.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función registra un nuevo kit en la tabla 'temp_kits_hb' con los parámetros proporcionados. Retorna el ID
     * generado para el registro insertado en la tabla 'temp_kits_hb', o 0 si la inserción falla.
     *
     * Ejemplo de uso:
     * ```php
     * $params = [
     *     'id_ittm1' => 1,
     *     'fhater' => 'KIT001',
     *     'code' => 'ART001',
     *     'quantity' => 2,
     *     'id_itm1' => 10,
     *     'precio_costo' => 20.5,
     *     'kit' => 'Kit A',
     *     'id_cotizaciones_claves' => 5,
     *     'id_cotizacion' => 100
     * ];
     *
     * $registroId = registroKits($params);
     * if ($registroId > 0) {
     *     echo "Kit registrado correctamente. ID generado: " . $registroId;
     * } else {
     *     echo "Error al registrar el kit.";
     * }
     * ```
     */
    function registroKits($params)
    {
        $id_ittm1 = isset($params['id_ittm1']) ? $params['id_ittm1'] : null;
        $fhater = isset($params['fhater']) ? $params['fhater'] : null;
        $code = isset($params['code']) ? $params['code'] : null;
        $quantity = isset($params['quantity']) ? $params['quantity'] : null;

        $id_itm1 = isset($params['id_itm1']) ? $params['id_itm1'] : null;
        $precio_costo = isset($params['precio_costo']) ? $params['precio_costo'] : null;
        $kit = isset($params['kit']) ? $params['kit'] : null;
        $id_cotizaciones_claves = isset($params['id_cotizaciones_claves']) ? $params['id_cotizaciones_claves'] : null;
        $id_cotizacion = isset($params['id_cotizacion']) ? $params['id_cotizacion'] : null;
        $descripcion = isset($params['descripcion']) ? $params['descripcion'] : null;
        $familia_articulo = isset($params['familia_articulo']) ? $params['familia_articulo'] : null;

        $campos = array(
            'id_ittm1' => $id_ittm1,
            'fhater' => $fhater,
            'code' => $code,
            'quantity' =>$quantity,
            'id_itm1' =>$id_itm1,
            'precio_costo' => $precio_costo,
            'kit' => $kit,
            'id_cotizaciones_claves' => $id_cotizaciones_claves,
            'id_cotizacion' => $id_cotizacion,
            'descripcion' => $descripcion,
            'familia_articulo' => $familia_articulo
        );
        $this->db->insert('temp_kits_hb', $campos);
        return $this->db->insert_id();
    }

    /**
     * Actualiza los totales en la tabla 'temp_cotizacion' para un registro específico.
     *
     * Esta función actualiza los totales en la tabla 'temp_cotizacion' para un registro específico identificado por
     * 'id_temp_cotizacion'. Los totales incluyen costos de telas, patas, herrajes importados, ebanistería, costo de
     * materia prima, herrajes nacionales, precio sugerido, y totales de kits habilitados, HUL y MP.
     *
     * @param array $params Un array asociativo con los siguientes índices opcionales:
     *   - 'id_temp_cotizacion' (int): El ID del registro en 'temp_cotizacion' que se actualizará.
     *   - 'total_g_telas' (float): El total general de costos de telas.
     *   - 'total_g_patas' (float): El total general de costos de patas.
     *   - 'total_g_herrajes_importados' (float): El total general de costos de herrajes importados.
     *   - 'total_g_ebanesteria' (float): El total general de costos de ebanistería.
     *   - 'costo_materia_prima' (float): El costo total de materia prima.
     *   - 'total_herraje_nacional' (float): El total de costos de herrajes nacionales.
     *   - 'precio_sugerido' (float): El precio sugerido para la cotización.
     *   - 'total_kit_hab' (float): El total de kits habilitados.
     *   - 'total_kit_hul' (float): El total de kits HUL.
     *   - 'total_kit_mp' (float): El total de kits MP.
     *   - 'total_mp' (float): El total de materia prima.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función actualiza los totales en la tabla 'temp_cotizacion' para un registro específico identificado por
     * 'id_temp_cotizacion'. Los totales incluyen costos de telas, patas, herrajes importados, ebanistería, costo de
     * materia prima, herrajes nacionales, precio sugerido, y totales de kits habilitados, HUL y MP.
     *
     * Ejemplo de uso:
     * ```php
     * $params = [
     *     'id_temp_cotizacion' => 1,
     *     'total_g_telas' => 150.5,
     *     'total_g_patas' => 75.25,
     *     'total_g_herrajes_importados' => 120.75,
     *     'total_g_ebanesteria' => 200.0,
     *     'costo_materia_prima' => 550.0,
     *     'total_herraje_nacional' => 80.0,
     *     'precio_sugerido' => 1200.0,
     *     'total_kit_hab' => 300.0,
     *     'total_kit_hul' => 150.0,
     *     'total_kit_mp' => 250.0,
     *     'total_mp' => 800.0
     * ];
     *
     * registroTotalesTemp($params);
     * echo "Totales actualizados correctamente.";
     * ```
     */
    function registroTotalesTemp($params)
    {
        $id_temp_cotizacion = isset($params['id_temp_cotizacion']) ? $params['id_temp_cotizacion'] : null;
        $total_g_telas = isset($params['total_g_telas']) ? $params['total_g_telas'] : null;
        $total_g_patas = isset($params['total_g_patas']) ? $params['total_g_patas'] : null;
        $total_g_herrajes_importados = isset($params['total_g_herrajes_importados']) ? $params['total_g_herrajes_importados'] : null;

        $total_g_ebanesteria = isset($params['total_g_ebanesteria']) ? $params['total_g_ebanesteria'] : null;
        $costo_materia_prima = isset($params['costo_materia_prima']) ? $params['costo_materia_prima'] : null;
        $total_herraje_nacional = isset($params['total_herraje_nacional']) ? $params['total_herraje_nacional'] : null;
        $precio_sugerido = isset($params['precio_sugerido']) ? $params['precio_sugerido'] : null;
        
        $total_kit_hab = isset($params['total_kit_hab']) ? $params['total_kit_hab'] : null;
        $total_kit_hul = isset($params['total_kit_hul']) ? $params['total_kit_hul'] : null;
        $total_kit_mp = isset($params['total_kit_mp']) ? $params['total_kit_mp'] : null;

        $gastos_uni = isset($params['gastos_uni']) ? $params['gastos_uni'] : null;
        $nom_uni = isset($params['nom_uni']) ? $params['nom_uni'] : null;
        $desc_uni = isset($params['desc_uni']) ? $params['desc_uni'] : null;
        $gast_fin_uni = isset($params['gast_fin_uni']) ? $params['gast_fin_uni'] : null;
        $flete_uni = isset($params['flete_uni']) ? $params['flete_uni'] : null;
        $comision = isset($params['comision']) ? $params['comision'] : null;
        $costo_total = isset($params['costo_total']) ? $params['costo_total'] : null;
        $margen = isset($params['margen']) ? $params['margen'] : null;
        $precio_sugerido = isset($params['precio_sugerido']) ? $params['precio_sugerido'] : null;

        $total_mp = isset($params['total_mp']) ? $params['total_mp'] : null;

        $campos = array(
            'total_g_telas' => $total_g_telas,
            'total_g_patas' => $total_g_patas,
            'total_g_herrajes_importados' => $total_g_herrajes_importados,
            'total_g_ebanesteria' =>$total_g_ebanesteria,
            'costo_materia_prima' =>$costo_materia_prima,
            'total_herraje_nacional' =>$total_herraje_nacional,
            'precio_sugerido' =>$precio_sugerido,
            'total_kit_hab' =>$total_kit_hab,
            'total_kit_hul' =>$total_kit_hul,
            'total_kit_mp' =>$total_kit_mp,
            'total_mp' =>$total_mp,
            'gastos_uni' =>$gastos_uni,
            'nom_uni' =>$nom_uni,
            'desc_uni' =>$desc_uni,
            'gast_fin_uni' =>$gast_fin_uni,
            'flete_uni' =>$flete_uni,
            'comision' =>$comision,
            'costo_total' =>$costo_total,
            'margen' =>$margen
        );
        $this->db->where('id_temp_cotizacion', $id_temp_cotizacion);
        $this->db->update('temp_cotizacion', $campos);
        
    }

    /** Funcion para obtener las condiciones generales
     * del cliente en SAP
     * @param Int $businesPartnes: Id del cliente seleccionado
     */
    function getClienteCotizacion($id_cotizacion)
    {
        $this->db->from('vis_cotizacion_claves');
        $this->db->where('id_cotizacion',$id_cotizacion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->row_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los detalles del cliente asociado a una cotización.
     *
     * Esta función consulta la tabla 'vis_cotizacion_claves' para obtener los detalles del cliente
     * asociado a una cotización específica identificada por 'id_cotizacion'.
     *
     * @param int $id_cotizacion El ID de la cotización para la cual se desea obtener los detalles del cliente.
     *
     * @return array|false Un array asociativo con los detalles del cliente si se encuentra, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función obtiene los detalles del cliente asociado a una cotización específica consultando
     * la tabla 'vis_cotizacion_claves'.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 123; // ID de la cotización deseada
     * $cliente = getClienteCotizacion($id_cotizacion);
     *
     * if ($cliente) {
     *     echo "Cliente: " . $cliente['nombre_cliente'] . ", Teléfono: " . $cliente['telefono'];
     * } else {
     *     echo "No se encontró ningún cliente para la cotización con ID " . $id_cotizacion;
     * }
     * ```
     */
    function getDescripcion($id){
        $this->db->from('vis_sap');
        $this->db->where('id_oitm',$id);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row_array();
        }else{
            return 0;
        }
    }

    /**
     * Obtiene los detalles del previo de cotización asociado a una cotización.
     *
     * Esta función consulta la tabla 'vis_previo_cotizacion' para obtener los detalles del previo de cotización
     * asociado a una cotización específica identificada por 'id_cotizacion'.
     *
     * @param int $id_cotizacion El ID de la cotización para la cual se desea obtener los detalles del previo de cotización.
     *
     * @return array|false Un array de arrays asociativos con los detalles del previo de cotización si se encuentra, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función obtiene los detalles del previo de cotización asociado a una cotización específica consultando
     * la tabla 'vis_previo_cotizacion'.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 123; // ID de la cotización deseada
     * $previo_cotizacion = getPrevioCot($id_cotizacion);
     *
     * if ($previo_cotizacion) {
     *     foreach ($previo_cotizacion as $detalle) {
     *         echo "Detalle: " . $detalle['campo1'] . ", " . $detalle['campo2'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontró ningún previo de cotización para la cotización con ID " . $id_cotizacion;
     * }
     * ```
     */
    function getPrevioCot($id_cotizcion)
    {
        $this->db->from('vis_previo_cotizacion');
        $this->db->where('id_cotizacion',$id_cotizcion);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los detalles de un kit según el tipo y el código SAP.
     *
     * Esta función consulta la tabla 'vis_articulo_nombre_precio' para obtener los detalles de un kit
     * según el tipo especificado por 'fhater' y el código SAP especificado por 'codigo_sap'.
     *
     * @param string $kitHab El tipo de kit (fhater) para el cual se desean obtener los detalles.
     * @param string $codigo_sap El código SAP del artículo para el cual se desean obtener los detalles del kit.
     *
     * @return array|false Un array de arrays asociativos con los detalles del kit si se encuentran, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función obtiene los detalles de un kit según el tipo (fhater) y el código SAP del artículo
     * consultando la tabla 'vis_articulo_nombre_precio'.
     *
     * Ejemplo de uso:
     * ```php
     * $kitHab = 'TipoKit'; // Tipo de kit deseado
     * $codigo_sap = 'SAP123'; // Código SAP del artículo
     * $kit_detalle = getKitDetalle($kitHab, $codigo_sap);
     *
     * if ($kit_detalle) {
     *     foreach ($kit_detalle as $detalle) {
     *         echo "Detalle: " . $detalle['campo1'] . ", " . $detalle['campo2'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron detalles de kit para el tipo '{$kitHab}' y código SAP '{$codigo_sap}'.";
     * }
     * ```
     */
    function getKitDetalle($kitHab,$codigo_sap)
    {
        $this->db->from('vis_precios_items');
        $this->db->where('fhater',$kitHab);
        
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    function getAllKits($id_cotizacion)
    {
        $this->db->from('temp_kits_hb');
        $this->db->where('id_cotizacion',$id_cotizacion); // Agregar condición LIKE
        $query = $this->db->get();
    
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * Obtiene los artículos según el tipo de kit y la familia del artículo.
     *
     * Esta función consulta la tabla 'vis_articulo_nombre_precio' para obtener los artículos
     * según el tipo especificado por 'fhater' y la familia del artículo especificada por 'familia_articulo'.
     *
     * @param string $kitHab El tipo de kit (fhater) para el cual se desean obtener los artículos.
     * @param string $familia_articulo La familia del artículo para la cual se desean obtener los artículos.
     *
     * @return array|false Un array de arrays asociativos con los detalles de los artículos si se encuentran, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función obtiene los detalles de los artículos según el tipo (fhater) y la familia del artículo
     * consultando la tabla 'vis_articulo_nombre_precio'.
     *
     * Ejemplo de uso:
     * ```php
     * $kitHab = 'TipoKit'; // Tipo de kit deseado
     * $familia_articulo = 'Familia123'; // Familia del artículo
     * $articulos = getItemByFamilia($kitHab, $familia_articulo);
     *
     * if ($articulos) {
     *     foreach ($articulos as $articulo) {
     *         echo "Artículo: " . $articulo['nombre_articulo'] . ", Precio: $" . $articulo['precio'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron artículos para el tipo '{$kitHab}' y la familia '{$familia_articulo}'.";
     * }
     * ```
     */
    function getItemByFamilia($kitHab,$familia_articulo)
    {
        $this->db->from('vis_precios_items');
        $this->db->where('fhater',$kitHab);
        $this->db->where('familia_articulo',$familia_articulo);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Obtiene los elementos de la tabla temp_cotizacion según varios parámetros.
     *
     * Esta función consulta la tabla 'temp_cotizacion' para obtener los elementos que coincidan con
     * los parámetros especificados.
     *
     * @param int $id_temp_cotizacion El ID de la cotización temporal.
     * @param int $id_cotizaciones_claves El ID de las claves de las cotizaciones.
     * @param int $id_cotizacion El ID de la cotización.
     * @param int $id_padre El ID del padre.
     *
     * @return array|false Un array de arrays asociativos con los detalles de los elementos si se encuentran, o false si no se encuentra ningún registro.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función obtiene los detalles de los elementos de la tabla 'temp_cotizacion' según varios parámetros.
     * Retorna un array con los resultados si se encuentran coincidencias, o false si no se encuentra ningún registro.
     *
     * Ejemplo de uso:
     * ```php
     * $id_temp_cotizacion = 123;
     * $id_cotizaciones_claves = 456;
     * $id_cotizacion = 789;
     * $id_padre = 1001;
     * $items = getItemByItems($id_temp_cotizacion, $id_cotizaciones_claves, $id_cotizacion, $id_padre);
     *
     * if ($items) {
     *     foreach ($items as $item) {
     *         echo "Elemento encontrado: " . $item['nombre_campo'] . "<br>";
     *     }
     * } else {
     *     echo "No se encontraron elementos para los parámetros especificados.";
     * }
     * ```
 */
    function getItemByItems($id_temp_cotizacion,$id_cotizaciones_claves,$id_cotizacion,$id_padre)
    {
        $this->db->from('temp_cotizacion');
        $this->db->where('id_temp_cotizacion',$id_temp_cotizacion);
        $this->db->where('id_cotizaciones_claves',$id_cotizaciones_claves);
        $this->db->where('id_cotizacion',$id_cotizacion);
        $this->db->where('id_padre',$id_padre);
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /**
     * Elimina un registro de la tabla 'temp_cotizacion' basado en el ID de la cotización temporal.
     *
     * Esta función elimina un registro específico de la tabla 'temp_cotizacion' donde el ID de la cotización temporal coincide con el parámetro proporcionado.
     *
     * @param int $item El ID de la cotización temporal que se desea eliminar.
     *
     * @return void No retorna ningún valor.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función elimina un registro de la tabla 'temp_cotizacion' donde el campo 'id_temp_cotizacion' coincide con el valor proporcionado en el parámetro $item.
     *
     * Ejemplo de uso:
     * ```php
     * $id_temp_cotizacion = 123;
     * eliminarItem($id_temp_cotizacion);
     * ```
     */
    function eliminarItem($item)
    {
        $this->db->where('id_temp_cotizacion', $item);
        $this->db->delete('temp_cotizacion');
    }

    /**
     * Registra una nueva entrada en la tabla 'cat_detalle_cotizacion' con los parámetros proporcionados.
     *
     * Esta función inserta un nuevo registro en la tabla 'cat_detalle_cotizacion' utilizando los parámetros especificados.
     *
     * @param array $params Los datos a insertar en la tabla, como un array asociativo donde las claves corresponden a los nombres de las columnas.
     *
     * @return int El ID generado automáticamente para el nuevo registro insertado.
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función inserta una nueva fila en la tabla 'cat_detalle_cotizacion' con los datos proporcionados en el array $params.
     *
     * Ejemplo de uso:
     * ```php
     * $datos_cotizacion = [
     *     'campo1' => 'valor1',
     *     'campo2' => 'valor2',
     *     // Agregar más campos según sea necesario
     * ];
     * $id_nueva_cotizacion = registroCotizacion($datos_cotizacion);
     * echo "Se registró la cotización con ID: " . $id_nueva_cotizacion;
     * ```
     */
    function registroCotizacion($params)
    {
        $this->db->insert('cat_detalle_cotizacion', $params);
        return $this->db->insert_id();
    }

    /**
     * Registra un nuevo detalle de cotización asociado a un ID de catálogo de detalle de cotización y un ID de cotización.
     *
     * Esta función inserta un nuevo registro en la tabla 'rom_detalle_cotizacion_has_cotizacion' con los parámetros especificados.
     *
     * @param int $id_cat_detalle_cotizacion El ID del catálogo de detalle de cotización.
     * @param int $id_cotizacion El ID de la cotización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función inserta una nueva relación entre un detalle de cotización y una cotización en la tabla 'rom_detalle_cotizacion_has_cotizacion'.
     * Los parámetros $id_cat_detalle_cotizacion y $id_cotizacion deben ser proporcionados para establecer la relación.
     *
     * Ejemplo de uso:
     * ```php
     * $id_detalle_cotizacion = 123;
     * $id_cotizacion = 456;
     * registroDetalleCot($id_detalle_cotizacion, $id_cotizacion);
     * echo "Se registró el detalle de cotización asociado.";
     * ```
     */
    function registroDetalleCot($id_cat_detalle_cotizacion,$id_cotizacion)
    {
        $campos = array(
            'id_detalle_cotizacion' => $id_cat_detalle_cotizacion,
            'id_cotizacion' => $id_cotizacion
        );
        $this->db->insert('rom_detalle_cotizacion_has_cotizacion', $campos);
    }

    /**
     * Actualiza el estado de una cotización en la tabla 'ent_cotizacion'.
     *
     * Esta función actualiza el campo 'id_estatus' de la cotización identificada por el ID especificado.
     *
     * @param int $id_cotizacion El ID de la cotización que se desea actualizar.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función actualiza el estado de una cotización a través de su ID en la tabla 'ent_cotizacion'.
     * Establece el estado de la cotización al valor 3 (indicando un estado específico, ajustar según la lógica de tu sistema).
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizacion = 123;
     * actualizarCotizacion($id_cotizacion);
     * echo "Se actualizó el estado de la cotización con ID: " . $id_cotizacion;
     * ```
     */
    function actualizarCotizacion($id_cotizacion)
    {
        $campos = array(
            'id_estatus' => 3
        );
        $this->db->where('id_cotizacion', $id_cotizacion);
        $this->db->update('ent_cotizacion', $campos);
    }

    /**
     * Elimina registros temporales de cotización según las claves de cotización y el ID de la cotización.
     *
     * Esta función elimina registros de la tabla 'temp_cotizacion' que coincidan con las claves de cotización y el ID de la cotización especificados.
     *
     * @param int $id_cotizaciones_claves El ID de las claves de las cotizaciones.
     * @param int $id_cotizacion El ID de la cotización.
     *
     * @return void
     *
     * @throws No lanza excepciones explícitamente.
     *
     * @global CI_Controller $this Instancia del controlador de CodeIgniter.
     *
     * @description
     * Esta función elimina registros temporales de la tabla 'temp_cotizacion' según las claves de cotización y el ID de la cotización proporcionados.
     * Los registros que coincidan con ambos parámetros son eliminados de forma permanente.
     *
     * Ejemplo de uso:
     * ```php
     * $id_cotizaciones_claves = 123;
     * $id_cotizacion = 456;
     * eliminarTempCot($id_cotizaciones_claves, $id_cotizacion);
     * echo "Se eliminaron los registros temporales de cotización asociados a las claves y cotización especificadas.";
     * ```
     */
    function eliminarTempCot($id_cotizaciones_claves,$id_cotizacion)
    {
        $this->db->where('id_cotizaciones_claves', $id_cotizaciones_claves);
        $this->db->where('id_cotizacion', $id_cotizacion);
        $this->db->delete('temp_cotizacion');
    }
}
