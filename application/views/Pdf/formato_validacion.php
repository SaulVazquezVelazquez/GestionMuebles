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
			top: 160px;
			left: -5px;
			right: -5px;
			margin-bottom: 360px;
		}
	</style>
</head>

<body>
	<!-- Defina bloques de encabezado y pie de página antes de su contenido -->
	<header>



		<?php

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Round;

        date_default_timezone_set('America/Mexico_City');
        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");  
     
        foreach ($condiciones_comerciales as $cantidad_factores_cliente):
        endforeach;
        $factores = round(((count($cantidad_factores_cliente) - 3) / 2),0);
     
     ?>

		<div style="position: fixed; top: 7px; left: -20px; "><!--  border: solid 1.5px black; width: 717px; height: 835px-->
		</div>

		<div style="position: fixed; top: 20px; left: -20px; border: solid 1.5px black; width: 110px; height: 42px">

			<a style="font-size: 7px; position: fixed; top: 23px; left: -15px;"><b>Cliente: </b></a>
			<a style="font-size: 6px; position: fixed; top: 23px; left: 19px;"><?= $datos_cliente->card_foreign_name; ?></a>

			<a style="font-size: 7px; position: fixed; top: 33px; left: -15px;"><b>Fecha: </b></a>
			<a style="font-size: 6px; position: fixed; top: 33px; left: 28px;"><?= date('d') ?> de <?= $meses[date('n')-1]?>
				del <?= date('Y')?></a>

			<a style="font-size: 7px; position: fixed; top: 43px; left: -15px;"><b>Folio ant: </b></a>
			<a style="font-size: 7px; position: fixed; top: 43px; left: 75px;">62</a>

			<a style="font-size: 7px; position: fixed; top: 53px; left: -15px;"><b>Folio: </b></a>
			<a style="font-size: 7px; position: fixed; top: 53px; left: 75px;">65</a>

		</div>

		<div style="position: fixed; top: 20px; left: 125px; border: solid 1.5px black; width: 150px; height: 32px">

			<a style="font-size: 7px; position: fixed; top: 23px; left: 130px;"><b>Sustituye a L.P. </b></a>
			<a style="font-size: 7px; position: fixed; top: 23px; left: 255px;">1394</a>

			<a style="font-size: 7px; position: fixed; top: 33px; left: 130px;"><b>Nueva L.P. </b></a>
			<a style="font-size: 7px; position: fixed; top: 33px; left: 255px;">1397</a>

			<a style="font-size: 7px; position: fixed; top: 43px; left: 130px;"><b>Fecha de aplicación: </b></a>
			<a style="font-size: 7px; position: fixed; top: 43px; left: 202px;"> <?= date('d') ?> de <?= $meses[date('n')-1]?>
				del <?= date('Y')?></a>

		</div>



		<div style="position: fixed; top: 7px; left: 310px; border: solid 1.5px black; width: 255px; height: 11px">

			<b style="font-size: 7px; position: fixed; top: 10px; left: 395px;">Condiciones comerciales</b>

		</div>



		<div>

			<table
				style="position: fixed; top: 20px; left: 310px; border-top: solid 1.5px black; border-left: solid 1.5px black; border-bottom: solid 1.5px black;">
				<tbody>

					<?php 
            $i = 0;
            foreach($condiciones_comerciales as $item): ?>
					<tr>
						<td style="font-size: 7px; width:60px; height:10px;"><b><?= $item['condicion'] ?>: </b></td>
						<td style="font-size: 7px; width:30px; height:10px;"><?= number_format($item['porcentaje'],2,".",",") ?>%
						</td>
					</tr>
					<?php 
            $i++;
            if($i == ($factores+1))
              {
                break;
              }
            endforeach;?>
				</tbody>
			</table>

			<table
				style="position: fixed; top: 20px; left: 410px; border-top: solid 1.5px black; border-right: solid 1.5px black; border-bottom: solid 1.5px black;">
				<tbody>

					<?php 
            $i = 0;
            foreach($condiciones_comerciales as $item):
            $i++; 
            if($i > ($factores+1)) {?>
					<tr>
						<td style="font-size: 7px; width:60px; height:10px;"><b><?= $item['condicion'] ?>: </b></td>
						<td style="font-size: 7px; width:30px; height:10px;"><?= number_format($item['porcentaje'],2,".",",") ?> %
						</td>
					</tr>
					<?php } endforeach;?>
				</tbody>
			</table>
		</div>



		<div style="position: fixed; top: 20px; left: 510px; border: solid 1.5px black; width: 55px; height: 25px">

			<b
				style="font-size: 14px; position: fixed; top: 25px; left: 515px;"><?= number_format($factor_cotizacion,2,".",",") ?>%</b>

		</div>


		<div style="position: fixed; top: 7px; left: 567px; border: solid 1.5px black; width: 130px; height: 38px">

			<img style="position: fixed; top: 9px; left: 569px;" width="128" height="36"
				src="<?= base_url(); ?>assets/images/principal/logoviolantiblanco.jpg"
				class="img-fluid" alt="Responsive image">

		</div>


	</header>

	<footer>

		
		
		<div class="text-center align-middle"
			style="border-top: 2px solid #000000; position: fixed; top: 915px; left: 20px; height:40px; width:108px;">
			<?php if(!empty($detalle_cotizacion[0]['auto_ventas'])):?>
				<div style="position: absolute; top: -65px; left: 10px;">
					<img width="130" height="85" src="<?= base_url(); ?>assets/images/firmas/direccion_ventas.png" class="img-fluid">
				</div>
			<?php endif;?>
			<a style="font-size: 8px;position: fixed; top: 918px; left: 50px;">Luis Esquete</a>
		</div>

		<div class="text-center align-middle"
			style="border-top: 2px solid #000000; position: fixed; top: 915px; left: 205px; height: 40px; width: 108px;">
			<?php if(!empty($detalle_cotizacion[0]['auto_direccion'])):?>
				<div style="position: absolute; top: -65px; left: 15px;">
					<img width="100" height="100" src="<?= base_url(); ?>assets/images/firmas/direccion_general.png" class="img-fluid">
				</div>
			<?php endif;?>
			<a style="font-size: 8px; position: fixed; top: 918px; left: 230px;">Gerardo Violante</a>
		</div>

		<div class="text-center align-middle"
		style="border-top: 2px solid #000000; position: fixed; top: 915px; left: 375px; height:40px; width:108px;">
			<?php if(!empty($detalle_cotizacion[0]['auto_disenio'])):?>
				<div style="position: absolute; top: -65px; left: 15px;">
					<img width="100" height="100" src="<?= base_url(); ?>assets/images/firmas/direccion_disenio.png" class="img-fluid">
				</div>
			<?php endif;?>
			<a style="font-size: 8px;position: fixed; top: 918px; left: 405px;">Jezabel Aguirre</a>
		</div>


		<div class="text-center align-middle"
		style="border-top: 2px solid #000000; position: fixed; top: 915px; left: 560px; height:40px; width:108px;">
			<?php if(!empty($detalle_cotizacion[0]['auto_contabilidad'])):?>
				<div style="position: absolute; top: -65px; left: 15px;">
					<img width="100" height="100" src="<?= base_url(); ?>assets/images/firmas/direccion_contabilidad.png" class="img-fluid">
				</div>
			<?php endif;?>
			<a style="font-size: 8px;position: fixed; top: 918px; left: 590px;">Erika Mendoza</a>
		</div>

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
					<td style="font-size: 6px; border: solid 0.3px black; background: rgb(146, 208, 80);">$<?= number_format($precio_fuente,0,".",",");?></td> 
					<td style="font-size: 6px; border: solid 0.3px black;"><?= number_format($incremento,2,".",",");?>%</td>
					<td style="font-size: 6px; border: solid 0.3px black; background: rgb(198, 224, 180);">$<?= number_format($precio_sugerido,0,".",",");?></td>
					<td style="font-size: 6px; border: solid 0.3px black;"><?= $item['observaciones'];?></td>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
    <?php } ?>
	</main>


	<script type="text/php">
		if (isset($pdf)) {
      $x = 528;
      $y = 73;
      $text = "Página {PAGE_NUM} / {PAGE_COUNT}";
      $font = "sans-serif";
      $size = 5;
      $color = array(0,0,0);
      $word_space = 0.0;  //  default
      $char_space = 0.0;  //  default
      $angle = 0.0;   //  default
      $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
  }
</script>

</body>

</html>