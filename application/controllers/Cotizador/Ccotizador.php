<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccotizador extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizador/Mcotizador');
        $this->load->model('Combos/Mcombos');
        $this->load->model('Configuracion/Mconfiguracion');
        
        $this->load->helper('my_configuracionGlobal_helper');
        $this->load->helper('Cotizador/CalculosGenerales_helper');
        $this->load->helper('Cotizador/cotizador_helper');
        
    }

    /**
     * Carga las vistas necesarias para mostrar la página de inicio del cotizador.
     *
     * Este método carga las vistas del encabezado, menú, página principal del cotizador y pie de página
     * específicas para la sección de Diseño e Ingeniería del Directorio.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @since 2024-06-17
     */
    function index()
    {
      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/Index');
      $this->load->view('DirDisenioIngenieria/Layout/Footer');
    }

    /**
     * Realiza el proceso de cotización de ítems para un cliente específico.
     *
     * Este método recibe datos del formulario de cotización, realiza registros en la base de datos,
     * y carga las vistas necesarias para mostrar los detalles y resultados de la cotización.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @since 2024-06-17
     *
     * @throws Exception Cuando ocurre algún error durante el proceso de cotización.
     * @param void No recibe parámetros explícitos, utiliza datos del formulario POST.
     * @return void No devuelve ningún valor explícito, pero carga vistas para mostrar resultados de la cotización.
     */
    function cotizacionItems()
    {
      
      $clientes = $this->input->post('clientes');
      $tipo_cotizacion = $this->input->post('tipo_cotizacion');
      $usuario = $this->session->userdata('s_id_sesiones');
      $id_estatus = 1;
      log_message('info', "PDC: Inicamos el proceso de cotizacion con el cliente: $clientes y se cotizo: $tipo_cotizacion, el usuario que cotiza es: $usuario");
      $consecutivo = $this->Mcotizador->getConsecutivo();
      
      if($consecutivo == 0){
        $const = 1;
      }else{
        $const = $consecutivo['folio_consecutivo']+1;
      }

      $param['folio_consecutivo'] = $const;
      $param['id_tipo_cotizacion'] = $tipo_cotizacion;
      $param['id_estatus'] = $id_estatus;
      $param['id_business_partnes'] = $clientes;
      $param['u_registro'] = $usuario;

      $data['id_cotizcion'] = $this->Mcotizador->registroPreCot($param);
      log_message('info', "PDC: Guardamos en registroPreCot =>".print_r($param,true));

      if($tipo_cotizacion == 1){
        log_message('info', "PDC: Vamos a Cotizar una Clave");
        $data['datos'] = $this->Mcotizador->getClaves();
      }

      $data['detalle'] = $this->Mcotizador->getDetalleCliente($const);
      $condicionesComerciales= getCondicionComercial($clientes);
      $data['factor_cotizacion'] = granTotal($condicionesComerciales);
      $data['condiciones_comerciales'] = comisiones_comerciales($condicionesComerciales);
      log_message('info', "PDC: Terminamos el proceso en cotizacionItems");

      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/Items',$data);
      $this->load->view('DirDisenioIngenieria/Layout/Footer');
    }

    /**
     * Realiza el proceso de agregar detalles de ítems a una cotización existente.
     *
     * Este método recibe datos del formulario de selección de claves para una cotización específica,
     * valida la existencia de cada clave en la cotización y realiza registros si es necesario.
     * Luego carga las vistas necesarias para mostrar los detalles y costos adicionales de los ítems.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @since 2024-06-17
     *
     * @throws Exception Cuando ocurre algún error durante el proceso de agregado de detalles de ítems.
     * @param void No recibe parámetros explícitos, utiliza datos del formulario POST.
     * @return void No devuelve ningún valor explícito, pero carga vistas para mostrar detalles de los ítems.
     */
    function cotizacionItemsDetalle()
    {
      log_message('info', "PDCC: Iniciamos el proceso de agregar las claves seleccionadas");
      $array_items = $this->input->post('claves[]'); 
      $id_cotizcion = $this->input->post('id_cotizcion'); 
      log_message('info', "PDC: Las claves seleccionadas:".print_r($array_items,true)." de la cotizacion $id_cotizcion");

      foreach($array_items as $item){

        log_message('info', "PDC: Validamos que la clave: $item exista en la cotizacion: $id_cotizcion");
        $existe = $this->Mcotizador->validaCotClave($item,$id_cotizcion);
        if(!$existe){
          log_message('info', "PDC: No existe la clave: $item en la cotización: $id_cotizcion se registra");
          $this->Mcotizador->registroCotCla($item,$id_cotizcion);
        }
      }

      $data['detalle_items'] = $this->Mcotizador->MdetalleItemsT($id_cotizcion);
      $data['telas'] = $this->Mcombos->getTelas();
      $data['patas'] = $this->Mcombos->getPatas();
      $data['herraje'] = $this->Mcombos->getHerrajeImp();
      $data['ebanesteria'] = $this->Mcombos->getEbasteneria();
      $data['i'] = 1;
      log_message('info', "PDC: Termina el proceso en cotizacionItemsDetalle y mandamos los datos:".print_r($data,true));

      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/ItemCost',$data);
      $this->load->view('DirDisenioIngenieria/Layout/Footer');
    }

    /**
     * Función para procesar y registrar los detalles previos de una cotización.
     *
     * Esta función recibe datos del formulario de cotización, procesa cada ítem
     * y sus detalles asociados (telas, patas, herrajes, ebanistería, etc.) para
     * almacenarlos en la base de datos temporal de cotización.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @param void
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para gestionar los detalles previos de una cotización,
     * incluyendo el registro de telas, patas, herrajes, ebanistería y kits asociados.
     * Utiliza llamadas a modelos de base de datos para obtener información específica
     * de cada componente.
     *
     * La función itera sobre los datos recibidos del formulario de cotización para
     * construir arreglos asociativos detallados que luego son almacenados en la
     * base de datos temporal de cotización. También calcula costos asociados a
     * telas, patas, herrajes y otros componentes para cada ítem de cotización.
     *
     * Las llamadas a funciones de modelos internos (`$this->Mcotizador->...`) son
     * utilizadas para obtener información detallada de cada componente como precios,
     * descripciones y configuraciones específicas.
     */
    function previoCotizacionDetalle()
    {
      log_message('info', "PDCD: Iniciamos previoCotizacionDetalle" );
      $id_cotizacion = $this->input->post('id_cotizacion');
      
      $param['id_cotizacion'] = $id_cotizacion;

      $array_padres = $this->input->post('id_padre');

      $array_cotizaciones_clave = $this->input->post('id_cotizaciones_claves[]');
     
      $arrya_concepto = $this->input->post('concepto');
      $arrya_mano_de_obra = $this->input->post('mano_de_obra[]');
      $arrya_imagenes = $this->input->post('images[]');

      $array_clientes_name = $this->input->post('card_foreign_name[]');
      $array_clientes_id = $this->input->post('id_business_partnes[]');

      $array_telas1 = $this->input->post('telas_uno');
      $array_telas2 = $this->input->post('telas_dos');
      $array_telas3 = $this->input->post('telas_tres');
      $array_telas4 = $this->input->post('telas_cuatro');
  
      $array_pata1 = $this->input->post('pata_uno');
      $array_pata2 = $this->input->post('pata_dos');

      $array_herraje1 = $this->input->post('herraje_uno');
      $array_herraje2 = $this->input->post('herraje_dos');

      $array_ebasn1 = $this->input->post('ebanesteria_uno');
      $array_ebasn2 = $this->input->post('ebanesteria_dos');
      $array_ebasn3 = $this->input->post('ebanesteria_tres');

      // Arrays dados
      $array1 = $arrya_concepto;
      $array2 = $arrya_mano_de_obra;
      $array3 = $array_telas1;
      $array4 = $array_telas2;
      $array5 = $array_telas3;
      $array6 = $array_telas4;
      $array7 = $array_pata1;
      $array8 = $array_pata2;
      $array9 = $array_herraje1;
      $array10 = $array_herraje2;
      $array11 = $array_ebasn1;
      $array12 = $array_ebasn2;
      $array13 = $array_ebasn3;
      $array14 = $array_padres;
      $array15 = $arrya_imagenes;
      $array16 = $array_clientes_name;
      $array17 = $array_clientes_id;
      $array18 = $array_cotizaciones_clave;
      $resultado = array();

      foreach ($array1 as $indice => $valor) {
          $resultado[] = array(
              "concepto" => $valor,
              "mano_obra" => $array2[$indice],
              "telas" => array($array3[$indice],$array4[$indice],$array5[$indice],$array6[$indice]),
              "patas" => array($array7[$indice],$array8[$indice]),
              "herrajes" => array($array9[$indice],$array10[$indice]),
              "ebanisteria" => array($array11[$indice],$array12[$indice],$array13[$indice]),
              "variante" => array($array14[$indice]),
              "imagen" => $array15[$indice],
              'clientes' => array($array16[$indice],$array17[$indice]),
              "id_cotizacion_clave" => $array18[$indice],
          );
      }

      $resultado_asociativo = array();
      foreach ($resultado as $elemento) {
          $resultado_asociativo[] = array_combine(array('concepto', 'mano_obra', 'telas', 'patas', 'herrajes', 'ebanisteria','variante','imagen','clientes','id_cotizacion_clave'), $elemento);
      }

      log_message('info', "PDCD: Creamos el arreglo asociativo:". print_r($resultado_asociativo,true) );
      log_message('info', "PDCD: Buscamos el detalle de las telas:");

      foreach($resultado_asociativo as $ra => $ra_item)
      {
        $param = [];
        $param['id_cotizacion'] = $id_cotizacion;
        $id_cotizaciones_claves = $ra_item['id_cotizacion_clave'];
        $descripcion_general = "";

        $detalles_claves = $this->Mcotizador->getTelasDetalle($id_cotizacion); 

        $mts1 = $detalles_claves[$ra]['mts_1'];
        $mts2 = $detalles_claves[$ra]['mts_2'];
        $mts3 = $detalles_claves[$ra]['mts_3'];
        $mts4 = $detalles_claves[$ra]['mts_4'];

        $pata1 = $detalles_claves[$ra]['pata_1'];
        $pata2 = $detalles_claves[$ra]['pata_2'];

        $herraje1 = $detalles_claves[$ra]['herraje_1'];
        $herraje2 = $detalles_claves[$ra]['herraje_2'];
        
        $ebanesteria1 = $detalles_claves[$ra]['ebanisteria_1'];
        $ebanesteria2 = $detalles_claves[$ra]['ebanisteria_2'];
        $ebanesteria3 = $detalles_claves[$ra]['ebanisteria_3'];
        
        $param['codigo_sap_articulo'] = $ra_item['concepto'];
        $param['mano_obra'] = $ra_item['mano_obra'];
        $param['id_padre'] = $ra_item['variante'][0];
        $param['imagen'] = $ra_item['imagen'];
        $param['id_cliente'] = $ra_item['clientes'][1];
        $param['cliente'] = $ra_item['clientes'][0];
        $param['id_cotizaciones_claves'] = $id_cotizaciones_claves;
       

        /** TELAS */
        foreach($ra_item['telas'] as $telas => $tela){
          $i = $telas+1;
          $total1 = 0;
          $total2 = 0;
          $total3 = 0;
          $total4 = 0;
          $id_tela = str_replace("tela$i-","",$tela);  
          $precio_tela = $this->Mcotizador->getCostoTela($id_tela);
          $precio_c = 0;

          if(isset($precio_tela['id_oitm'])){
            $precio_c = $precio_tela['precio_costo'];
          }
          
          if($i == 1 && $mts1 > 0){
            $param["id_tela_uno"] = $id_tela;
            $param['mts_uno'] = $mts1;
            $param["precio_costo_uno"] = $precio_c;
            $total1 = $precio_c*$mts1;
            $param["importe_uno"] = $total1;
            $descripcion = $this->Mcotizador->getDescripcion($id_tela);
            $param["nombre_tela_uno"] = $descripcion['nombre_articulo'];
            $param["clave_tela_uno"] = $descripcion['numero_tela'];
            $descripcion_general .= $descripcion['numero_tela'].",";
          }else if($i == 2 && $mts2 > 0){
            $param["id_tela_dos"] = $id_tela;
            $param['mts_dos'] = $mts2;
            $param["precio_costo_dos"] = $precio_c;
            $total2 = $precio_c*$mts2;
            $param["importe_dos"] = $total2;
            $descripcion = $this->Mcotizador->getDescripcion($id_tela);
            $param["nombre_tela_dos"] = $descripcion['nombre_articulo'];
            $param["clave_tela_dos"] = $descripcion['numero_tela'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else if ($i == 3 && $mts3 > 0){
            $param["id_tela_tres"] = $id_tela;
            $param['mts_tres'] = $mts3;
            $param["precio_costo_tres"] = $precio_c;
            $total3 = $precio_c*$mts3;
            $param["importe_tres"] = $total3;
            $descripcion = $this->Mcotizador->getDescripcion($id_tela);
            $param["nombre_tela_tres"] = $descripcion['nombre_articulo'];
            $param["clave_tela_tres"] = $descripcion['numero_tela'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else if($i == 4 && $mts4 > 0){
            $param["id_tela_cuatro"] = $id_tela;
            $param['mts_cuatro'] = $mts4;
            $param["precio_costo_cuatro"] = $precio_c;
            $total4 = $precio_c*$mts4;
            $param["importe_cuatro"] = $total4;
            $descripcion = $this->Mcotizador->getDescripcion($id_tela);
            $param["nombre_tela_cuatro"] = $descripcion['nombre_articulo'];
            $param["clave_tela_cuatro"] = $descripcion['numero_tela'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else{
          }
          $total_telas = $total1+$total2+$total3+$total4;
        }
            
        /** PATAS */
        foreach($ra_item['patas'] as $patas => $pata){

          $i = $patas+1;
          $id_pata = str_replace("pata$i-","",$pata);  
          $precio_pata = $this->Mcotizador->getCostoPata($id_pata);
          $precio_cp = 0;
          if(isset($precio_pata['id_oitm'])){
            $precio_cp = $precio_pata['precio_costo'];
          }

          if($i == 1 && $pata1 > 0){
            $param["id_pata_uno"] = $id_pata;
            $param['pata_uno'] = $pata1;
            $param["precio_costo_pata_uno"] = $precio_cp;
            $total_pt1 = $precio_cp*$pata1;
            $param["importe_pata_uno"] = $total_pt1;
            $descripcion = $this->Mcotizador->getDescripcion($id_pata);
            $param["nombre_pata_uno"] = $descripcion['nombre_articulo'];
            $param["clave_pata_uno"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
            
          }else if($i == 2 && $pata2 > 0){
            $param["id_pata_dos"] = $id_pata;
            $param['pata_dos'] = $pata2;
            $param["precio_costo_pata_dos"] = $precio_cp;
            $total = $precio_cp*$pata2;
            $param["importe_pata_dos"] = $total;
            $descripcion = $this->Mcotizador->getDescripcion($id_pata);
            $param["nombre_pata_dos"] = $descripcion['nombre_articulo'];
            $param["clave_pata_dos"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else{
          }
        }

        /** HERRAJES */
        foreach($ra_item['herrajes'] as $herrajes => $herraje){
          $i = $herrajes+1;
          $id_herraje = str_replace("herraje$i-","",$herraje);  
          $precio_herraje = $this->Mcotizador->getCostoHerraje($id_herraje);
          $precio_cp = 0;
          if(isset($precio_herraje['id_oitm'])){
            $precio_cp = $precio_herraje['precio_costo'];
          }

          if($i == 1 && $herraje1 > 0){
            $param["id_herraje_uno"] = $id_herraje;
            $param['herraje_uno'] = $herraje1;
            $param["precio_costo_herraje_uno"] = $precio_cp;
            $total_hj1 = $precio_cp*$herraje1;
            $param["importe_herraje_uno"] = $total_hj1;
            $descripcion = $this->Mcotizador->getDescripcion($id_herraje);
            $param["nombre_herraje_uno"] = $descripcion['nombre_articulo'];
            $param["clave_herraje_uno"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else if($i == 2 && $herraje2 > 0){
            $param["id_herraje_dos"] = $id_herraje;
            $param['herraje_dos'] = $herraje2;
            $param["precio_costo_herraje_dos"] = $precio_cp;
            $total = $precio_cp*$herraje2;
            $param["importe_herraje_dos"] = $total;
            $descripcion = $this->Mcotizador->getDescripcion($id_herraje);
            $param["nombre_herraje_dos"] = $descripcion['nombre_articulo'];
            $param["clave_herraje_dos"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else{
          }
        }

        /** EBANESTERIA */
        foreach($ra_item['ebanisteria'] as $ebanisterias => $ebanisteria){
          $i = $ebanisterias+1;
          $id_ebanesteria = str_replace("ebanesteria$i-","",$ebanisteria);  
          $precio_ebanesteria = $this->Mcotizador->getCostoEbanesteria($id_ebanesteria);
          $precio_cp = 0;
          if(isset($precio_ebanesteria['id_oitm'])){
            $precio_cp = $precio_ebanesteria['precio_costo'];
          }

          if($i == 1 && $ebanesteria1 > 0){
            $param["id_ebanesteria_uno"] = $id_ebanesteria;
            $param['ebanesteria_uno'] = $ebanesteria1;
            $param["precio_costo_ebanesteria_uno"] = $precio_cp;
            $total_hj1 = $precio_cp*$ebanesteria1;
            $param["importe_ebanesteria_uno"] = $total_hj1;
            $descripcion = $this->Mcotizador->getDescripcion($id_ebanesteria);
            $param["nombre_ebanesteria_uno"] = $descripcion['nombre_articulo'];
            $param["clave_ebanesteria_uno"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else if($i == 2 && $ebanesteria2 > 0){
            $param["id_ebanesteria_dos"] = $id_ebanesteria;
            $param['ebanesteria_dos'] = $ebanesteria2;
            $param["precio_costo_ebanesteria_dos"] = $precio_cp;
            $total_hj1 = $precio_cp*$ebanesteria2;
            $param["importe_ebanesteria_dos"] = $total_hj1;
            $descripcion = $this->Mcotizador->getDescripcion($id_ebanesteria);
            $param["nombre_ebanesteria_dos"] = $descripcion['nombre_articulo'];
            $param["clave_ebanesteria_dos"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else if($i == 2 && $ebanesteria3 > 0){
            $param["id_ebanesteria_tres"] = $id_ebanesteria;
            $param['ebanesteria_tres'] = $ebanesteria3;
            $param["precio_costo_ebanesteria_tres"] = $precio_cp;
            $total = $precio_cp*$ebanesteria3;
            $param["importe_ebanesteria_tres"] = $total;
            $descripcion = $this->Mcotizador->getDescripcion($id_ebanesteria);
            $param["nombre_ebanesteria_tres"] = $descripcion['nombre_articulo'];
            $param["clave_ebanesteria_tres"] = $descripcion['clave_articulo'];
            $descripcion_general .= $descripcion['nombre_articulo'].",";
          }else{
          }
        }

        $param['descripcion_general'] = $descripcion_general;

        
        log_message('info', "PDCD: Recorremos el array de resultado asociativo :". print_r($param,true) );

        log_message('info', "PDCD: Guardamos en  registroTempCot:". $ra_item['concepto'] );
        $id_registro_temp_cot = $this->Mcotizador->registroTempCot($param);
       
        
      }

      $pre_cotizacion_detalles = $this->Mcotizador->getDetallesTempCotItem($id_cotizacion);
      log_message('info', "PDCD: Obtenemos getDetallesTempCotItem:". print_r($pre_cotizacion_detalles,true) );

      foreach($pre_cotizacion_detalles as $i => $detalle_prCot){

        $total_tela_uno = 0;
        $total_tela_dos = 0;
        $total_tela_tres = 0;
        $total_tela_cuatro = 0;

        $total_pata_uno = 0;
        $total_pata_dos = 0;

        $total_herraje_uno = 0;
        $total_herraje_dos = 0;

        $importe_ebanesteria_uno = 0;
        $importe_ebanesteria_dos = 0;
        $importe_ebanesteria_tres = 0;

        $importe_herraje_nacional = 0;
        $kit_hab_total = 0;
        $kit_hub_total = 0;
        $kit_mp_total = 0;

        $total_g_telas = 0;
        $total_g_patas = 0;
        $total_g_herrajes_importados = 0;
        $total_g_ebanesteria = 0;
        $costo_materia_prima = 0;
        $total_herraje_nacional = 0;
        $total_materia_prima = 0;

        $id_cotizaciones_claves = $detalle_prCot['id_cotizaciones_claves'];
        $id_temp_cotizacion = $detalle_prCot['id_temp_cotizacion'];

        $total_tela_uno+=$detalle_prCot['importe_uno'];
        $total_tela_dos+=$detalle_prCot['importe_dos'];
        $total_tela_tres+=$detalle_prCot['importe_tres'];
        $total_tela_cuatro+=$detalle_prCot['importe_cuatro'];

        $total_pata_uno = $detalle_prCot['importe_pata_uno'];
        $total_pata_dos = $detalle_prCot['importe_pata_dos'];

        $total_herraje_uno+=$detalle_prCot['importe_herraje_uno'];
        $total_herraje_dos+=$detalle_prCot['importe_herraje_dos'];

        $importe_ebanesteria_uno += $detalle_prCot['importe_ebanesteria_uno'];
        $importe_ebanesteria_dos += $detalle_prCot['importe_ebanesteria_dos'];
        $importe_ebanesteria_tres += $detalle_prCot['importe_ebanesteria_tres'];

        $codigo_sap_articulo = $detalle_prCot['codigo_sap_articulo'];

        $KIT_HAB_ = "KIT-HAB-".$codigo_sap_articulo;
        $KIT_HUL_ = "KIT-HUL-".$codigo_sap_articulo;
        $KIT_MP_ = "KIT-MP-".$codigo_sap_articulo;

        $kitHab = $this->Mcotizador->getKit($KIT_HAB_,$codigo_sap_articulo);
        $kitHul = $this->Mcotizador->getKit($KIT_HUL_,$codigo_sap_articulo);
        $KitMp = $this->Mcotizador->getKit($KIT_MP_,$codigo_sap_articulo);

        log_message('info', "PDCD: Obtenemos el kit de habilitacion:". print_r($kitHab,true) );
        log_message('info', "PDCD: Obtenemos el kit de hule:". print_r($kitHul,true) );
        log_message('info', "PDCD: Obtenemos el kit de materia prima:". print_r($KitMp,true) );

        if($kitHab !== false)
        {
          foreach($kitHab as $khab)
          {
            $id_ittm1 = $khab['id_ittm1'];
            $fhater = $khab['fhater'];
            $code = $khab['code'];
            $quantity = $khab['quantity'];
            $id_itm1 = $khab['id_itm1'];
            $precio_costo = $khab['precio_costo'];
            $kit = "hab";
            $descripcion_hb = $khab['nombre_articulo'];
            $familia = $khab['familia_articulo'];

            $paramKitHab['id_ittm1'] = $id_ittm1;
            $paramKitHab['fhater'] = $fhater;
            $paramKitHab['code'] = $code;
            $paramKitHab['quantity'] = $quantity;
            $paramKitHab['id_itm1'] = $id_itm1;
            $paramKitHab['precio_costo'] = $precio_costo;
            $paramKitHab['kit'] = $kit;
            $paramKitHab['id_cotizaciones_claves'] = $id_cotizaciones_claves;
            $paramKitHab['id_cotizacion'] = $id_cotizacion;
            $paramKitHab['descripcion'] = $descripcion_hb;
            $paramKitHab['familia_articulo'] = $familia;
            
            $total_kithab = $precio_costo *$quantity;
            $kit_hab_total += $total_kithab;
            $this->Mcotizador->registroKits($paramKitHab);
          }    
        }

        if($kitHul !== false)
        {
          foreach($kitHul as $khul)
          {
            $id_ittm1 = $khul['id_ittm1'];
            $fhater = $khul['fhater'];
            $code = $khul['code'];
            $quantity = $khul['quantity'];
            $id_itm1 = $khul['id_itm1'];
            $precio_costo = $khul['precio_costo'];
            $kit = "hul";
            $descripcion_hu = $khul['nombre_articulo'];
            $familia = $khul['familia_articulo'];
            
            $paramKitHub['id_ittm1'] = $id_ittm1;
            $paramKitHub['fhater'] = $fhater;
            $paramKitHub['code'] = $code;
            $paramKitHub['quantity'] = $quantity;
            $paramKitHub['id_itm1'] = $id_itm1;
            $paramKitHub['precio_costo'] = $precio_costo;
            $paramKitHub['kit'] = $kit;
            $paramKitHub['id_cotizaciones_claves'] = $id_cotizaciones_claves;
            $paramKitHub['id_cotizacion'] = $id_cotizacion;
            $paramKitHub['descripcion'] = $descripcion_hu;
            $paramKitHub['familia_articulo'] = $familia;
            
            $total_kithub = $precio_costo *$quantity;
            $kit_hub_total += $total_kithub;
            $this->Mcotizador->registroKits($paramKitHub);
          }
        }
        
        if($KitMp !== false)
        {
          foreach($KitMp as $kmp)
          {
            $id_ittm1 = $kmp['id_ittm1'];
            $fhater = $kmp['fhater'];
            $code = $kmp['code'];
            $quantity = $kmp['quantity'];
            $id_itm1 = $kmp['id_itm1'];
            $precio_costo = $kmp['precio_costo'];
            $kit = "mp";
            $descripcion_mp = $kmp['nombre_articulo'];
            $familia = $kmp['familia_articulo'];

            if($kmp['familia_articulo'] == 109){
              $total_hn = $precio_costo *$quantity;
              $importe_herraje_nacional+=$total_hn;
            }

            $paramKitMp['id_ittm1'] = $id_ittm1;
            $paramKitMp['fhater'] = $fhater;
            $paramKitMp['code'] = $code;
            $paramKitMp['quantity'] = $quantity;
            $paramKitMp['id_itm1'] = $id_itm1;
            $paramKitMp['precio_costo'] = $precio_costo;
            $paramKitMp['kit'] = $kit;
            $paramKitMp['id_cotizaciones_claves'] = $id_cotizaciones_claves;
            $paramKitMp['id_cotizacion'] = $id_cotizacion;
            $paramKitMp['descripcion'] = $descripcion_mp;
            $paramKitMp['familia_articulo'] = $familia;
            
            $total_kitmp = $precio_costo *$quantity;
            $kit_mp_total += $total_kitmp;
            $this->Mcotizador->registroKits($paramKitMp);
          }
        }

        $id_temp_cotizacion = $detalle_prCot['id_temp_cotizacion'];
        $mano_obra = $detalle_prCot['mano_obra'];
        
        $total_g_telas = $total_tela_uno + $total_tela_dos + $total_tela_tres + $total_tela_cuatro;
        $total_g_patas = $total_pata_uno+$total_pata_dos;
        $total_g_herrajes_importados = $total_herraje_uno+$total_herraje_dos;
        $total_g_ebanesteria = $importe_ebanesteria_uno+$importe_ebanesteria_dos+$importe_ebanesteria_tres;
        $total_herraje_nacional = $importe_herraje_nacional;
        
        $costo_materia_prima = $total_g_patas+$total_g_ebanesteria+$kit_hab_total+$kit_hub_total+$kit_mp_total;
        $total_materia_prima = $total_g_herrajes_importados+$costo_materia_prima+$total_g_telas;

        $id_clientes = $this->Mcotizador->getClienteCotizacion($id_cotizacion);
        $clientes = $id_clientes['id_business_partnes'];
        $condicionesComerciales= getCondicionComercial($clientes);
        $data['condiciones_comerciales'] = comisiones_comerciales($condicionesComerciales);
        
        $financiamiento = $data['condiciones_comerciales']['financiamiento'];
        $flete = $data['condiciones_comerciales']['flete'];
        
        if(isset($data['condiciones_comerciales']['comision'])){
          $comision = $data['condiciones_comerciales']['comision'];
        }else{
          $comision = $data['condiciones_comerciales']['comision'] = 0;
        }

        $descuentos_comerciales = $data['condiciones_comerciales']['descuentos_comerciales'];

        $paramDtc['id_temp_cotizacion'] = $id_temp_cotizacion;
        $paramDtc['total_g_telas'] = $total_g_telas;
        $paramDtc['total_g_patas'] = $total_g_patas;
        $paramDtc['total_g_herrajes_importados'] = $total_g_herrajes_importados;
        $paramDtc['total_g_ebanesteria'] = $total_g_ebanesteria;
        $paramDtc['costo_materia_prima'] = $costo_materia_prima;
        $paramDtc['total_herraje_nacional'] = $total_herraje_nacional;
        $paramDtc['total_kit_hab'] = $kit_hab_total;
        $paramDtc['total_kit_hul'] = $kit_hub_total;
        $paramDtc['total_kit_mp'] = $kit_mp_total;
        $paramDtc['total_mp'] = $total_materia_prima;
        
        $margen_dinamico = getMargenGlobal();
        
        $param['mano_obra'] = $mano_obra;
        $param['descuentos_comerciales'] = $descuentos_comerciales;
        $param['financiamiento'] = $financiamiento;
        $param['flete'] = $flete;
        $param['comision'] = $comision;
        $param['total_materia_prima'] = $total_materia_prima;
        $param['margen_dinamico'] = $margen_dinamico;
        $fijos = $this->Mconfiguracion->getFijos();
        $data_cotizacion = calcular_cotizacion($param,$fijos);
        
        $paramDtc['gastos_uni'] = $data_cotizacion['gastos_uni'];
        $paramDtc['nom_uni'] = $data_cotizacion['nom_uni'];
        $paramDtc['desc_uni'] = $data_cotizacion['desc_uni'];
        $paramDtc['gast_fin_uni'] = $data_cotizacion['gast_fin_uni'];
        $paramDtc['flete_uni'] = $data_cotizacion['flete_uni'];
        $paramDtc['comision'] = $data_cotizacion['comision'];
        $paramDtc['costo_total'] = $data_cotizacion['costo_total'];
        $paramDtc['margen'] = $data_cotizacion['margen'];
        $paramDtc['precio_sugerido'] = $data_cotizacion['precio_sugerido'];
        $this->Mcotizador->registroTotalesTemp($paramDtc);
      }

      log_message('info', "PDCD: Terminamos el proceso previoCotizacionDetalle");
      redirect(base_url()."detalle-cotizacion/$id_cotizaciones_claves/$id_cotizacion", 'refresh');
    }

    /**
     * Función para mostrar el detalle de una orden de cotización.
     *
     * Esta función inicia el proceso de mostrar el detalle completo de una orden
     * de cotización, incluyendo la obtención de los ítems de cotización asociados
     * y la carga de la vista correspondiente para mostrar estos detalles al usuario.
     * 
     * Utiliza el segmento de URI para obtener los identificadores necesarios de la
     * cotización y luego llama al modelo `Mcotizador` para obtener los ítems de
     * cotización previamente registrados.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para gestionar y mostrar el detalle completo de una orden de
     * cotización. Registra mensajes de log para seguir el flujo de ejecución y
     * determinar el inicio y finalización de la función.
     *
     * La función carga las vistas necesarias (`Header`, `Menu`, `DetalleCotizacion`,
     * `Footer`) utilizando el framework CodeIgniter. Prepara los datos necesarios
     * como el tamaño del arreglo de ítems, los propios ítems de cotización y otros
     * datos relevantes para la vista de detalle.
     */
    function detalleOrder()
    {
      log_message('info', "PDCDO: Iniciamos detalleOrder");
      $id_cotizaciones_claves = $this->uri->segment(2);
      $id_cotizacion = $this->uri->segment(3);

      $items_cot = $this->Mcotizador->getPrevioCot($id_cotizacion);
      
      log_message('info', "PDCDO: Terminamos detalleOrder");

      $tamanio_array = sizeof($items_cot);

      $data['tamanio_array'] = $tamanio_array;
      $data['items'] = $items_cot;
      $data['i'] = 1;
      $data['id_cotizaciones_claves'] = $id_cotizaciones_claves;
      $data['id_cotizacion'] = $id_cotizacion;
      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/DetalleCotizacion',$data);
      $this->load->view('DirDisenioIngenieria/Layout/Footer');
    }

    /**
     * Función para editar un ítem de cotización.
     *
     * Esta función permite la edición de un ítem específico de una cotización,
     * obteniendo datos detallados del ítem y otros datos necesarios como telas,
     * patas, herrajes y ebanistería desde los modelos correspondientes.
     * 
     * Utiliza segmentos de la URI para obtener los identificadores necesarios de
     * la cotización y del ítem específico a editar. Luego carga la vista para
     * editar el costo del ítem con los datos obtenidos.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para gestionar la edición de un ítem de cotización en un
     * sistema de gestión de cotizaciones. Utiliza datos de diversos modelos para
     * obtener información detallada del ítem y de elementos adicionales como telas,
     * patas, herrajes y ebanistería.
     *
     * La función carga las vistas necesarias (`Header`, `Menu`, `ItemEditCost`,
     * `Footer`) utilizando el framework CodeIgniter. Prepara los datos necesarios
     * para la vista de edición de costo del ítem, incluyendo detalles específicos
     * del ítem y opciones de selección para telas, patas, herrajes y ebanistería.
     *
     * Ejemplo de uso:
     * ```php
     * editarItemCot();
     * ```
     */
    function editarItemCot()
    {
      $id_temp_cotizacion = $this->uri->segment(2);
      $id_cotizaciones_claves = $this->uri->segment(3);
      $id_cotizacion = $this->uri->segment(4);

      $data['datos_items'] = $this->Mcotizador->MItemDetalleById($id_cotizacion);
      $data['detalle_items'] = $this->Mcotizador->MdetalleItemsById($id_cotizaciones_claves);
      $data['telas'] = $this->Mcombos->getTelas();
      $data['patas'] = $this->Mcombos->getPatas();
      $data['herraje'] = $this->Mcombos->getHerrajeImp();
      $data['ebanesteria'] = $this->Mcombos->getEbasteneria();
      $data['i'] = 1;

      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/ItemEditCost',$data);
      $this->load->view('DirDisenioIngenieria/Layout/Footer');

    }

    /**
     * Función para mostrar el detalle de un ítem de cotización.
     *
     * Esta función carga y muestra el detalle completo de un ítem específico de una cotización,
     * utilizando diversos parámetros obtenidos de la URI para identificar y obtener los datos
     * necesarios del ítem, como el código SAP del artículo, identificadores de cotización y
     * otros elementos relacionados como kits, herrajes, patas, ebanistería y telas.
     * 
     * Utiliza modelos para obtener datos detallados del ítem, kits relacionados y elementos
     * adicionales como telas, patas, herrajes y ebanistería. Luego carga la vista con los datos
     * obtenidos para mostrar el detalle completo del ítem de cotización.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para mostrar el detalle completo de un ítem de cotización en un sistema de
     * gestión de cotizaciones. Utiliza datos de diversos modelos para obtener información detallada
     * del ítem y de elementos adicionales como kits, telas, patas, herrajes y ebanistería.
     *
     * La función carga las vistas necesarias (`Header`, `Menu`, `DetalleItem`, `Footer`) utilizando
     * el framework CodeIgniter. Prepara los datos necesarios para la vista de detalle del ítem,
     * incluyendo kits relacionados, elementos de fabricación y opciones de personalización.
     */
    function detalleItem()
    {
      $codigo_sap_articulo = $this->uri->segment(2);
      $id_temp_cotizacion = $this->uri->segment(3);
      $id_cotizaciones_claves = $this->uri->segment(4);
      $id_cotizacion = $this->uri->segment(5);
      $id_padre = $this->uri->segment(6);

      $KIT_HAB_ = "KIT-HAB-".$codigo_sap_articulo;
      $KIT_HUL_ = "KIT-HUL-".$codigo_sap_articulo;
      $KIT_MP_ = "KIT-MP-".$codigo_sap_articulo;

      $kitHab = $this->Mcotizador->getKitDetalle($KIT_HAB_,$codigo_sap_articulo);
      $kitHul = $this->Mcotizador->getKitDetalle($KIT_HUL_,$codigo_sap_articulo);
      $KitMp = $this->Mcotizador->getKitDetalle($KIT_MP_,$codigo_sap_articulo);

      $herrajeN = $this->Mcotizador->getItemByFamilia($KIT_MP_,109); 
      $patas = $this->Mcotizador->getItemByFamilia($KIT_MP_,135); 
      $herrajeI = $this->Mcotizador->getItemByFamilia($KIT_MP_,147); 
      $ebanesteria = $this->Mcotizador->getItemByFamilia($KIT_MP_,132); 
      $telas = $this->Mcotizador->getItemByFamilia($KIT_MP_,101);

      $item = $this->Mcotizador->getItemByItems($id_temp_cotizacion,$id_cotizaciones_claves,$id_cotizacion,$id_padre);
      

      $data['codigo_sap_articulo'] = $codigo_sap_articulo;
      $data['kitHab'] = $kitHab;
      $data['kitHul'] = $kitHul;
      $data['KitMp'] = $KitMp;
      $data['herrajeN'] = $herrajeN;
      $data['patas'] = $patas;
      $data['herrajeI'] = $herrajeI;
      $data['ebanesteria'] = $ebanesteria;
      $data['telas'] = $telas;
      $data['item'] = $item;
      $data['id_cotizaciones_claves'] = $id_cotizaciones_claves;
      $data['id_cotizacion'] = $id_cotizacion;
      $data['id_temp_cotizacion'] = $id_temp_cotizacion;
      $data['i'] = 1;
      $data['j'] = 1;
      $data['h'] = 1;
      $data['q'] = 1;
      $data['l'] = 1;
      $data['f'] = 1;
      $data['e'] = 1;
      $data['t'] = 1;
      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/DetalleItem',$data);
      $this->load->view('DirDisenioIngenieria/Layout/Footer');

    }

    /**
     * Función para cargar la vista de edición de un ítem de cotización.
     *
     * Esta función carga la vista de edición de un ítem específico de una cotización,
     * utilizando los identificadores obtenidos de la URI para determinar el ítem exacto
     * que se desea editar. La función carga las vistas necesarias para mostrar la interfaz
     * de edición del ítem, incluyendo el encabezado, menú, la vista de edición del ítem
     * y el pie de página.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para cargar la vista de edición de un ítem de cotización en un sistema de
     * gestión de cotizaciones. Utiliza los parámetros de la URI para identificar el ítem específico
     * que se desea editar y carga la vista correspondiente (`EditarItem`) utilizando el framework
     * CodeIgniter.
     */
    function editarItem()
    {
      $id_temp_cotizacion = $this->uri->segment(3);
      $id_cotizaciones_claves = $this->uri->segment(4);
      $id_cotizacion = $this->uri->segment(5);
      $id_padre = $this->uri->segment(6);

      $this->load->view('DirDisenioIngenieria/Layout/Header');
      $this->load->view('DirDisenioIngenieria/Layout/Menu');
      $this->load->view('DirDisenioIngenieria/Cotizador/EditarItem');
      $this->load->view('DirDisenioIngenieria/Layout/Footer');

    }

    /**
     * Función para enviar una cotización.
     *
     * Esta función se encarga de procesar y enviar una cotización, utilizando los
     * parámetros obtenidos desde la URI para recuperar los detalles de los ítems
     * de la cotización y realizar el registro de la cotización y sus detalles en
     * la base de datos. Finalmente, la función redirige al usuario a la página principal
     * del cotizador después de completar el proceso.
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @return void
     * @throws No lanza excepciones
     *
     * @description
     * Función técnica para enviar una cotización en un sistema de gestión de cotizaciones.
     * Utiliza los parámetros de la URI para identificar y procesar los detalles de los ítems
     * de la cotización desde la base de datos. Después de registrar la cotización y sus detalles,
     * se elimina la información temporal asociada y se redirige al usuario de vuelta al cotizador.
     */
    function enviarCotizacion()
    {
      $id_cotizaciones_claves = $this->uri->segment(2);
      $id_cotizacion = $this->uri->segment(3);
      $id_temp_cotizacion = $this->uri->segment(4);

      $items_tem_cot = $this->Mcotizador->getDetallesTempCotItem($id_cotizacion);
      
      foreach($items_tem_cot as $item)
      {

        $paramDC['codigo_sap_articulo'] = $item['codigo_sap_articulo'];
        $paramDC['mano_obra'] = $item['mano_obra'];

        $paramDC['id_tela_uno'] = $item['id_tela_uno'];
        $paramDC['clave_tela_uno'] = $item['clave_tela_uno'];
        $paramDC['nombre_tela_uno'] = $item['nombre_tela_uno'];
        $paramDC['mts_uno'] = $item['mts_uno'];
        $paramDC['precio_costo_uno'] = $item['precio_costo_uno'];
        $paramDC['importe_uno'] = $item['importe_uno'];

        $paramDC['id_tela_dos'] = $item['id_tela_dos'];
        $paramDC['clave_tela_dos'] = $item['clave_tela_dos'];
        $paramDC['nombre_tela_dos'] = $item['nombre_tela_dos'];
        $paramDC['mts_dos'] = $item['mts_dos'];
        $paramDC['precio_costo_dos'] = $item['precio_costo_dos'];
        $paramDC['importe_dos'] = $item['importe_dos'];

        $paramDC['id_tela_tres'] = $item['id_tela_tres'];
        $paramDC['clave_tela_tres'] = $item['clave_tela_tres'];
        $paramDC['nombre_tela_tres'] = $item['nombre_tela_tres'];
        $paramDC['mts_tres'] = $item['mts_tres'];
        $paramDC['precio_costo_tres'] = $item['precio_costo_tres'];
        $paramDC['importe_tres'] = $item['importe_tres'];

        $paramDC['id_tela_cuatro'] = $item['id_tela_cuatro'];
        $paramDC['clave_tela_cuatro'] = $item['clave_tela_cuatro'];
        $paramDC['nombre_tela_cuatro'] = $item['nombre_tela_cuatro'];
        $paramDC['mts_cuatro'] = $item['mts_cuatro'];
        $paramDC['precio_costo_cuatro'] = $item['precio_costo_cuatro'];
        $paramDC['importe_cuatro'] = $item['importe_cuatro'];

        $paramDC['id_pata_uno'] = $item['id_pata_uno'];
        $paramDC['clave_pata_uno'] = $item['clave_pata_uno'];
        $paramDC['nombre_pata_uno'] = $item['nombre_pata_uno'];
        $paramDC['pz_pata_uno'] = $item['pz_pata_uno'];
        $paramDC['precio_costo_pata_uno'] = $item['precio_costo_pata_uno'];
        $paramDC['importe_pata_uno'] = $item['importe_pata_uno'];

        $paramDC['id_pata_dos'] = $item['id_pata_dos'];
        $paramDC['clave_pata_dos'] = $item['clave_pata_dos'];
        $paramDC['nombre_pata_dos'] = $item['nombre_pata_dos'];
        $paramDC['pz_pata_dos'] = $item['pz_pata_dos'];
        $paramDC['precio_costo_pata_dos'] = $item['precio_costo_pata_dos'];
        $paramDC['importe_pata_dos'] = $item['importe_pata_dos'];

        $paramDC['id_herraje_uno'] = $item['id_herraje_uno'];
        $paramDC['clave_herraje_uno'] = $item['clave_herraje_uno'];
        $paramDC['nombre_herraje_uno'] = $item['nombre_herraje_uno'];
        $paramDC['pz_herraje_uno'] = $item['pz_herraje_uno'];
        $paramDC['precio_costo_herraje_uno'] = $item['precio_costo_herraje_uno'];
        $paramDC['importe_herraje_uno'] = $item['importe_herraje_uno'];

        $paramDC['id_herraje_dos'] = $item['id_herraje_dos'];
        $paramDC['clave_herraje_dos'] = $item['clave_herraje_dos'];
        $paramDC['nombre_herraje_dos'] = $item['nombre_herraje_dos'];
        $paramDC['pz_herraje_dos'] = $item['pz_herraje_dos'];
        $paramDC['precio_costo_herraje_dos'] = $item['precio_costo_herraje_dos'];
        $paramDC['importe_herraje_dos'] = $item['importe_herraje_dos'];

        $paramDC['id_ebanesteria_uno'] = $item['id_ebanesteria_uno'];
        $paramDC['clave_ebanesteria_uno'] = $item['clave_ebanesteria_uno'];
        $paramDC['nombre_ebanesteria_uno'] = $item['nombre_ebanesteria_uno'];
        $paramDC['pz_ebanesteria_uno'] = $item['pz_ebanesteria_uno'];
        $paramDC['precio_costo_ebanesteria_uno'] = $item['precio_costo_ebanesteria_uno'];
        $paramDC['importe_ebanesteria_uno'] = $item['importe_ebanesteria_uno'];

        $paramDC['id_ebanesteria_dos'] = $item['id_ebanesteria_dos'];
        $paramDC['clave_ebanesteria_dos'] = $item['clave_ebanesteria_dos'];
        $paramDC['nombre_ebanesteria_dos'] = $item['nombre_ebanesteria_dos'];
        $paramDC['pz_ebanesteria_dos'] = $item['pz_ebanesteria_dos'];
        $paramDC['precio_costo_ebanesteria_dos'] = $item['precio_costo_ebanesteria_dos'];
        $paramDC['importe_ebanesteria_dos'] = $item['importe_ebanesteria_dos'];

        $paramDC['id_ebanesteria_tres'] = $item['id_ebanesteria_tres'];
        $paramDC['clave_ebanesteria_tres'] = $item['clave_ebanesteria_tres'];
        $paramDC['nombre_ebanesteria_tres'] = $item['nombre_ebanesteria_tres'];
        $paramDC['pz_ebanesteria_tres'] = $item['pz_ebanesteria_tres'];
        $paramDC['precio_costo_ebanesteria_tres'] = $item['precio_costo_ebanesteria_tres'];
        $paramDC['importe_ebanesteria_tres'] = $item['importe_ebanesteria_tres'];

        $paramDC['total_g_telas'] = $item['total_g_telas'];
        $paramDC['total_g_patas'] = $item['total_g_patas'];
        $paramDC['total_g_herrajes_importados'] = $item['total_g_herrajes_importados'];
        $paramDC['total_g_ebanesteria'] = $item['total_g_ebanesteria'];
        $paramDC['costo_materia_prima'] = $item['costo_materia_prima'];
        $paramDC['total_herraje_nacional'] = $item['total_herraje_nacional'];
        $paramDC['precio_sugerido'] = $item['precio_sugerido'];
        $paramDC['gastos_uni'] = $item['gastos_uni'];
        $paramDC['nom_uni'] = $item['nom_uni'];
        $paramDC['desc_uni'] = $item['desc_uni'];
        $paramDC['gast_fin_uni'] = $item['gast_fin_uni'];
        $paramDC['flete_uni'] = $item['flete_uni'];
        $paramDC['comision'] = $item['comision'];
        $paramDC['costo_total'] = $item['costo_total'];
        $paramDC['concepto'] = $item['concepto'];
        $paramDC['descripcion_general'] = $item['descripcion_general'];
        $paramDC['total_kit_hab'] = $item['total_kit_hab'];
        $paramDC['total_kit_hul'] = $item['total_kit_hul'];
        $paramDC['total_kit_mp'] = $item['total_kit_mp'];
        $paramDC['total_mp'] = $item['total_mp'];
        $paramDC['margen'] = 17;
        $paramDC['estatus'] = 3;

        $id_cat_detalle_cotizacion = $this->Mcotizador->registroCotizacion($paramDC);
        $this->Mcotizador->registroDetalleCot($id_cat_detalle_cotizacion,$id_cotizacion);        
      }

      $this->Mcotizador->actualizarCotizacion($id_cotizacion);
      $this->Mcotizador->eliminarTempCot($id_cotizaciones_claves,$id_cotizacion);
      redirect(base_url()."cotizador", 'refresh');
      
    }

    /**
     * Función para agregar una variante a una cotización.
     *
     * Verifica si ya existe una asociación entre la clave y la cotización.
     * Si no existe, registra la variante en la base de datos y luego carga la vista para
     * mostrar los detalles actualizados de los items de la cotización junto con los combos de telas,
     * patas, herrajes y ebanistería.
     *
     * @param int $id_cotizacion El ID de la cotización.
     * @param int $id_claves El ID de la clave asociada.
     * @param int $id_padre El ID del elemento padre.
     * @return void
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @throws No lanza excepciones
     *
     * @description
     * Esta función técnica verifica la existencia de una asociación clave-cotización y, si no existe,
     * registra una variante asociada. Luego carga la vista que muestra los detalles actualizados de
     * los items de la cotización, incluyendo los combos de telas, patas, herrajes y ebanistería.
     *
     * Ejemplo de uso:
     * ```php
     * agregarVariante(1, 5, 10);
     * ```
     */
    function agregarVariante()
    {
      $id_cotizacion = $this->uri->segment(2);
      $id_claves = $this->uri->segment(3);
      $id_padre = $this->uri->segment(4);
      
      $existe = $this->Mcotizador->validaCotClave($id_claves,$id_cotizacion);
        if($existe){
          $param['id_cotizacion'] = $id_cotizacion;
          $param['id_claves'] = $id_claves;
          $param['variante'] = true;
          $param['id_padre'] = $id_padre;
          $this->Mcotizador->registroCotClaV($param);
        }
      
        $data['detalle_items'] = $this->Mcotizador->MdetalleItemsT($id_cotizacion);
        $data['telas'] = $this->Mcombos->getTelas();
        $data['patas'] = $this->Mcombos->getPatas();
        $data['herraje'] = $this->Mcombos->getHerrajeImp();
        $data['ebanesteria'] = $this->Mcombos->getEbasteneria();
        $data['i'] = 1;
        $data['t'] = 1;
        $this->load->view('DirDisenioIngenieria/Layout/Header');
        $this->load->view('DirDisenioIngenieria/Layout/Menu');
        $this->load->view('DirDisenioIngenieria/Cotizador/ItemCost',$data);
        $this->load->view('DirDisenioIngenieria/Layout/Footer');
    }

    /**
     * Función para eliminar un item de una cotización.
     *
     * Obtiene el ID del item a eliminar desde los datos POST recibidos,
     * así como los IDs de las claves y la cotización asociadas.
     * Luego, utiliza el modelo `Mcotizador` para eliminar el item de la base de datos.
     * Finalmente, redirige al usuario de vuelta a la página de detalle de la cotización
     * desde donde se originó la solicitud de eliminación.
     *
     * @return void
     *
     * @author Ing. Alonso Montiel Villar
     * @version 1
     * @throws No lanza excepciones
     *
     * @description
     * Esta función técnica elimina un item específico de una cotización basado en los datos recibidos
     * por POST. Después de la eliminación, redirige al usuario de vuelta a la página de detalle
     * de la cotización para mostrar los cambios actualizados.
     */ 
    function eliminarItem()
    {
      $item = $this->input->post('id_temp_cotizacion');
      $id_cotizaciones_claves = $this->input->post('id_cotizaciones_claves');
      $id_cotizacion = $this->input->post('id_cotizacion');

          $this->Mcotizador->eliminarItem($item);
          redirect(base_url() . "detalle-cotizacion/$id_cotizaciones_claves/$id_cotizacion", 'refresh');
    }


}
