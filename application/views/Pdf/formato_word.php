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
			top: 50px;
			left: -15px;
			right: -15px;
			margin-bottom: 100px;
		}
	</style>
</head>


<body>
	<!-- Defina bloques de encabezado y pie de página antes de su contenido -->
	<header>
		<b style="font-size: 13px; position: fixed; top: 10px; left: -15px;color: red;">COTIZACIÓN
			<?= $detalle_cotizacion[0]['folio_consecutivo']; ?> / CLIENTE: <?= $datos_cliente->card_foreign_name; ?> / FECHA <?= date('d/m/Y');?></b>

	</header>

	<footer>

	</footer>


	<!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
	<main>
  <?php if (empty($detalle_cotizacion)) {
        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
    } else {        ?>
		<table style="border-collapse: collapse;">
			<thead>
				<tr>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="30"
						height="20">FOTO</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="30"
						height="15">FUENTE</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="40"
						height="15">CÓDIGO SAP</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="40"
						height="15">CLAVE</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="60"
						height="15">DESCRIPCIÓN</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="20"
						height="15">COSTO MP</th>
					<th class="text-center align-middle" style="font-size: 6px; background: rgb(189, 215, 238);" width="20"
						height="15">HERRAJE</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="20"
						height="15">TELA</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="20"
						height="15">M OBRA</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(255, 255, 0);" width="20"
						height="15">TOTAL MP</th>
					<th class="text-center align-middle" style="font-size: 6px; background: rgb(255, 0, 0); color:white;"
						width="20" height="15">PRECIO SUGERIDO</th>
					<th class="text-center align-middle" style="font-size: 5px; background: rgb(189, 215, 238);" width="20"
						height="15">VALIDACIÓN</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(146, 208, 80);" width="20"
						height="15">PRECIO FUENTE</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(189, 215, 238);" width="20"
						height="15">INCREMENTO</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(198, 224, 180);" width="20"
						height="15">PRECIO NUEVO</th>
					<th class="text-center align-middle" style="font-size: 7px; background: rgb(255, 192, 0);" width="40"
						height="15">OBSERVACIONES</th>
				</tr>
			</thead>
			<tbody style="text-align: center">
      <?php foreach($detalle_cotizacion as $item): ?>
					<?php 
						$_precio_sugerido = $item['precio_sugerido'];
						$_precio_fuente = 6105;
						$incremento =  (($_precio_sugerido - $_precio_fuente) / $_precio_fuente) * 100;
						
						
						$precio_sugerido = ceil($_precio_sugerido / 5) * 5;
						$precio_fuente = ceil($_precio_fuente / 5) * 5;
					 ?>

				<tr style="border: solid 0.5px black;">
					<td><img width="30" height="20"
							src="<?= base_url(); ?>assets/images/claves_pt/claves/<?= $item['codigo_sap_articulo'] ?>.png"
							class="img-fluid"></td>
					<td style="font-size: 6px; border: solid 0.3px black;">NUEVO</td>
					<td style="font-size: 6px; border: solid 0.3px black;">N/A</td>
					<td style="font-size: 6px; border: solid 0.3px black;"><?= $item['codigo_sap_articulo'] ?></td>
					<td style="font-size: 6px; border: solid 0.3px black;"><?= $item['descripcion_general'] ?></td>
					<td style="font-size: 6px; border: solid 0.3px black;">$<?= number_format(round($item['costo_materia_prima']),0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;">
						<?php if($item['total_herraje_nacional'] > 0):?>
						$<?= number_format(round($item['total_herraje_nacional']),0,".",",");?>
						<?php else:?>
						$<?= number_format(round($item['total_g_herrajes_importados']),0,".",",");?>
						<?php endif;?>
					</td>
					<td style="font-size: 6px; border: solid 0.3px black;">$<?= number_format(round($item['total_g_telas']),0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;">$<?= number_format(round($item['mano_obra']),0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black; background: rgb(255, 255, 0);">$<?= number_format(round($item['total_mp']),0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;">$<?= number_format($precio_sugerido,0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;"><?= number_format($item['margen']/$item['precio_sugerido'],2,".",",");?>%</td>
					<!-- precio fuente -->
					<td style="font-size: 6px; border: solid 0.3px black; background: rgb(146, 208, 80);">$<?= number_format($precio_fuente,0,".",",");?></td> 
					<!-- incremento -->
					<td style="font-size: 6px; border: solid 0.3px black;"><?= number_format($incremento,2,".",",");?>%</td>
					<!--  precio nuevo -->
					<td style="font-size: 6px; border: solid 0.3px black; background: rgb(198, 224, 180);">$<?= number_format($precio_sugerido,0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;"><?= $item['observaciones'];?></td>
				</tr>
        <?php endforeach;?>
			</tbody>
		</table>
    <?php } ?>
		<br>
		<br>

		<table style="border-collapse: collapse;">
			<thead>
				<tr>
					<th style="font-size: 7px; border: solid 0.3px; text-align:left" width="55" height="10"><a>CONCEPTO</a></th>
					<th style="font-size: 7px; border: solid 0.3px; text-align:left" width="55" height="10"><a>DESCRIPCIÓN</a>
					</th>
					<th style="font-size: 7px; border: solid 0.3px; text-align:left" width="35" height="10"><a>PORCENTAJE</a></th>
				</tr>
			</thead>
			<tbody>
      		<?php foreach($condiciones_comerciales as $item): ?>
				<tr style="border: solid 0.5px black;">
					<td style="font-size: 7px; border: solid 0.3px black;"><?= $item['condicion'] ?></td>
					<td style="font-size: 7px; border: solid 0.3px black;"><?= $item['descripcion_condicion'] ?></td>
					<td style="font-size: 7px; border: solid 0.3px black; text-align:right"><?= number_format($item['porcentaje'],2,".",",") ?>%</td>
				</tr>
			<?php endforeach;?>


				<tr style="border: solid 0.5px black;">
					<td></td>
					<td></td>
					<td style="font-size: 7px; border: solid 0.3px black; text-align:right"><?= number_format($factor_cotizacion,2,".",",") ?>%
				</tr>
			</tbody>
		</table>

	</main>


	<script type="text/php">
		if (isset($pdf)) {
      $x = 510;
      $y = 800;
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