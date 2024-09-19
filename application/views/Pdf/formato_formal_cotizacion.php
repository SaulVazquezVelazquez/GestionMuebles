<html>

<head>

	<style>
		/** Defina ahora los márgenes reales de cada página en el PDF **/
		body {
			/** Estilos extra personales **/
			font-family: sans-serif;
		}

		/** Definir las reglas del encabezado **/
		header {
			position: fixed;
			top: -42px;
			left: -15px;
			right: -15px;
			/** Estilos extra personales text-align: center; **/
		}

		/** Definir las reglas del pie de página **/
		footer {
			position: fixed;
			top: 900px;
			left: -15px;
			right: -15px;
			/** Estilos extra personales **/
		}

		main {
			position: relative;
			top: 221px;
			left: -5px;
			right: -5px;
			margin-bottom: 630px;
		}
	</style>
</head>


<!-- {{--Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado puede ser de altura y anchura completas.--}} -->

<body>
	<!-- Defina bloques de encabezado y pie de página antes de su contenido -->
	<header>

		<img style="position: fixed; top: -42px; left: -15px;" width="715" height="60"
			src="<?= base_url(); ?>assets/images/principal/violanti.png"
			class="img-fluid" alt="Responsive image">

			

		<?php
        date_default_timezone_set('America/Mexico_City');
        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
      ?>

		<a style="font-size: 11px; position: fixed; top: 33px; left: 535px; text-align: left;"><?= $diassemana[date('w')] ?>,
			<?= date('d') ?>/<?= $meses[date('n')-1]?>/<?= date('Y')?> </a>


		<a style="font-size: 13px; position: fixed; top: 65px; left: -15px;"><?= $datos_cliente->card_foreign_name; ?></a>

		<b style="font-size: 13px; position: fixed; top: 87px; left: -15px;">GERENCIA DE COMPRAS</b>

		<b style="font-size: 13px; position: fixed; top: 110px; left: -15px;">AT´N</b>

		{{-- Inicia proceso de conexión a BD SQLServer de SAP --}}

		<a style="font-size: 13px; position: fixed; top: 110px; left: 30px;"><?= $datos_cliente->contact_employee ?></a>



		<b style="font-size: 13px; position: fixed; top: 161px; left: -15px;">COTIZACIÓN No.:</b>

		<a style="font-size: 13px; position: fixed; top: 161px; left: 130px;">FOLIO CONSECUTIVO</a>
		<!-- <?= $detalle_cotizacion[0]['folio_consecutivo']; ?> -->



	</header>

	<footer>

		<b style="font-size: 13px;position: fixed; top: 677px; left: 581px;">Precio + 16% I.V.A.</b>

		<b style="font-size: 13px;position: fixed; top: 674px; left: -10px;">A t e n t a m e n t e</b>




		<b style="font-size: 12px;position: fixed; top: 795px; left: 503px;">Datos para depósito:</b>

		<b style="font-size: 12px;position: fixed; top: 814px; left: 465px;">Dimensión en Tapizado, S.A de C.V.</b>

		<b style="font-size: 12px;position: fixed; top: 831px; left: 503px;">Banco: BBVA Bancomer</b>

		<b style="font-size: 12px;position: fixed; top: 850px; left: 510px;">Cuenta: 0148044406</b>

		<b style="font-size: 12px;position: fixed; top: 869px; left: 465px;">Cuenta: Clabe: 012180001480444067</b>


		<div class="text-center align-middle"
			style="border-top: 1px solid #000000; position: fixed; top: 837px; left: 43px; height:40px; width:140px;">

			<b style="font-size: 13px;position: fixed; top: 843px; left: 60px;">Sr. Luis Esquete</b>
			<b style="font-size: 13px;position: fixed; top: 861px; left: 53px;">Director Comercial</b>

		</div>

		<div class="text-center align-middle"
			style="border-top: 1px solid #000000; position: fixed; top: 837px; left: 285px; height:40px; width:140px;">

			<b style="font-size: 13px;position: fixed; top: 843px; left: 294px;">Sr. Gerardo Violante</b>
			<b style="font-size: 13px;position: fixed; top: 861px; left: 303px;">Director General</b>

		</div>


		<div class="text-center align-middle"
			style="border: 1px solid #000000; position: fixed; top: 923px; height:68px; width:715px; background-color:rgb(255, 197, 168)">

			<b style="font-size: 9px;position: fixed; top: 926px; left: -5px;"><u>Calle 3 No. 116</u></b>
			<b style="font-size: 9px;position: fixed; top: 942px; left: -5px;"><u>Col. Pantitlán, 08100</u></b>
			<b style="font-size: 9px;position: fixed; top: 959px; left: -5px;"><u>Iztacalco, CDMX</b>
			<b style="font-size: 9px;position: fixed; top: 976px; left: -5px;"><u>Tel: (55) 5558-0412</u></b>


			<b style="font-size: 9px;position: fixed; top: 976px; left: 565px;"><u>www.violanti.com.mx</u></b>

		</div>

	</footer>


	<!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
	<main>
		<?php if (empty($detalle_cotizacion)) {
        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
    } else {        ?>
		<table>
			<thead>
				<tr>
					<th class="text-center align-middle" style="font-size: 11px; border-bottom: medium double rgb(0, 0, 0);"
						width="60" height="15">CLAVE</th>
					<th class="text-center align-middle" style="font-size: 11px; border-bottom: medium double rgb(0, 0, 0);"
						width="385" height="15"></th>
					<th class="text-center align-middle" style="font-size: 11px; border-bottom: medium double rgb(0, 0, 0);"
						width="60" height="15">PRECIO</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($detalle_cotizacion as $item): ?>
				<tr>
					<td class="text-center align-middle" style="font-size: 11px"><?= $item['codigo_sap_articulo']; ?></td>

					<?php
            $text = $item['codigo_sap_articulo'];
            $arrayText = explode("-", $text); 
            if ($arrayText['0'] == "SC") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SOFA CAMA</td>
					<?php
            }

            if ($arrayText['0'] == "SCE") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SOFA CAMA-E</td>
					<?php
            }

            if ($arrayText['0'] == "SR") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE</td>
					<?php
            }

            if ($arrayText['0'] == "SRE") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE-E</td>
					<?php
            }

            if ($arrayText['0'] == "SRB") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE DE BOTON</td>
					<?php
            }

            if ($arrayText['0'] == "SRBE") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE DE BOTON-E</td>
					<?php
            }

            if ($arrayText['0'] == "SRBEX") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE DE BOTON ELECTRICO</td>
					<?php
            }

            if ($arrayText['0'] == "SRBX") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SILLON RECLINABLE DE BOTON ELECTRICO</td>
					<?php
            }

            if ($arrayText['0'] == "SD") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SALA DE DESCANSO</td>
					<?php
            }

            if ($arrayText['0'] == "SE") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SALA ESQUINERA</td>
					<?php
            }

            if ($arrayText['0'] == "SEE") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">SALA ESQUINERA-E</td>
					<?php
            }

            if ($arrayText['0'] == "MU") {
              ?>
					<td class="text-center align-middle" style="font-size: 11px">MU</td>
					<?php
            }
          ?>

					<?php
            $numero = floatval($item['precio_sugerido']);
            $nombre_format_francais = number_format($numero, 0, '.', ', ');
          ?>
					<td class="text-center align-middle" style="font-size: 11px; text-align: center;">$
						<?= $nombre_format_francais; ?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php } ?>
	</main>


	<script type="text/php">
		if (isset($pdf)) {
      $x = 437;
      $y = 75;
      $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
      $font = "sans-serif";
      $size = 7;
      $color = array(0,0,0);
      $word_space = 0.0;  //  default
      $char_space = 0.0;  //  default
      $angle = 0.0;   //  default
      $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
  }
</script>

</body>

</html>