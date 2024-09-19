<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">

			<!-- Mensaje de procesamiento de peticion -->
			<div id="mns_procesando" class="card-body display-none">
				<div class="wrapper">
					<div class="container">
						<div class="row no-gutters height-self-center">
							<div class="col-sm-12 text-center align-self-center">
								<div class="iq-error position-relative">
									<img src="<?= base_url();?>/assets/images/carga/01.png"
										class="img-fluid iq-error-img" alt="">
									<h2 class="mb-0 mt-4">Estamos Procesando tu Peticion</h2>
									<p>Por favor espere.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Termina mensaje de peteicion  -->
			<!-- Datos generales -->
			<div class="col-sm-12 col-lg-5">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title"> Datos Generales</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<p>Folio: <?= $items[0]['folio_consecutivo'] ?></p>
								<p>Cliente: <?= $condiciones_comerciales[0]['card_foreign_name'] ?></p>
								<p>Factor: <?= number_format($factor_cotizacion,2,".",",") ?></p>
							</div>
							<div id="detalle_factores" class="col-md-6 mb-3 display-none">
								<?php foreach ($condiciones_comerciales as $item) : ?>
								<div class="form-row">
									<div class="col-md-6 mb-3">
										<?= $item['condicion'] ?>:
									</div>
									<div class="col-md-6 mb-3 text-center">
										<?= number_format($item['porcentaje'],2,".",",") ?>%
									</div>
								</div>

								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Termina datos generales -->
			<!-- Botones -->
			
			<!-- Fin de botones -->

			<div id="mns_detalle_6" class="col-lg-12 col-md-12">
				<div class="card card-block card-stretch card-height">
					<div class="card-header">
						<div class="header-title">
							<h6 class="card-title">Detalle de la Orden</h6>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="tabla-items" class="table">
								<thead>
									<tr>
										<th class="text-center letra-xxsmall" scope="col">#</th>
										<th class="text-center letra-xxsmall" scope="col">Fuente</th>
										<th class="text-center letra-xxsmall" scope="col">Clave</th>
										<th class="text-center letra-xxsmall" scope="col">Desc.</th>
										<th class="text-center letra-xxsmall" scope="col">T. MP</th>
										<th class="text-center letra-xxsmall" scope="col">T. Gastos</th>
										<th class="text-center letra-xxsmall" scope="col">T. Nom</th>
										<th class="text-center letra-xxsmall" scope="col">Des. Com</th>
										<th class="text-center letra-xxsmall" scope="col">Des. Fin.</th>
										<th class="text-center letra-xxsmall" scope="col">Des. Flete.</th>
										<th class="text-center letra-xxsmall" scope="col">Des. Com.</th>
										<th class="text-center letra-xxsmall" scope="col">Costo Total x Unidad</th>
										<th class="text-center letra-xxsmall" scope="col">Precio Sugerido</th>
										<th class="text-center letra-xxsmall" scope="col">Precio Fuente</th>
										<th class="text-center letra-xxsmall" scope="col">Incremento</th>
										<th class="text-center letra-xxsmall" scope="col">Precio Nuevo</th>
										<th class="text-center letra-xxsmall" scope="col">Inc N</th>
										<th class="text-center letra-xxsmall" scope="col">Observaciones</th>
										<th class="text-center letra-xxsmall" scope="col">Detalle</th>
									</tr>
								</thead>
								<?php foreach ($items as $item):?>
								<tbody>
									<tr>
										<!-- Imagen -->
										<th class="text-cente " scope="row"><img class="rounded img-fluid avatar-87"
												src="<?= base_url();?>assets/images/claves_pt/claves/<?= $item['codigo_sap_articulo']; ?>.png"
												alt="profile" data-toggle="modal" data-target="#imagenModal<?= $item["id_detalle_cotizacion"]; ?>" style="cursor: pointer;">
										</th>
										<!-- Fuente -->
										<td class="text-center letra-small">
											Nuevo <br/>
											<?php if($item["estatus"] == 1):?>
											<span class="badge badge-success">Aprobada</span>
											<?php elseif($item["estatus"] == 0):?>
											<span class="badge badge-danger">Cancelada</span>
											<?php endif;?>
										</td>
										<!-- Clave -->
										<td class="letra-small">
											<h6 class="mb-0" style="width: 75px;"><?= $item['codigo_sap_articulo'];?>
											</h6>
										</td>
										<!-- Descripcion -->
										<td class="text-center letra-small">
											<div class="flex align-items-center list-user-action">
												<span data-toggle="modal"
													data-target="#descripcion<?= $item["id_detalle_cotizacion"]; ?>">
													<a class="iq-bg-primary text-warning" data-toggle="tooltip"
														data-placement="top" title="" data-original-title="Descripción"
														href="#">
														<i class="ri-booklet-line"></i>
													</a>
												</span>
											</div>
										</td>

										<!-- T. MP -->
										<td class="text-center letra-small bg-warning-light">
											$<?= number_format(round($item['total_mp']),0,".",",");?>
										</td>
										<!-- T. Gastos -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['gastos_uni']),0,".",",");?>
										</td>
										<!-- T. Nom -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['nom_uni']),0,".",",");?>
										</td>
										<!-- Desc. Com. -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['desc_uni']),0,".",",");?>
										</td>
										<!-- Des. Fin. -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['gast_fin_uni']),0,".",",");?>
										</td>
										<!-- Desc. Flete -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['flete_uni']),0,".",",");?>
										</td>
										<!-- Des. Com -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['comision']),0,".",",");?>
										</td>
										<!-- Costo Total x Unidad -->
										<td class="text-center letra-small">
											$<?= number_format(round($item['costo_total']),0,".",",");?>
										</td>
										<!-- Precio Sugerido -->
										<td class="text-center letra-small bg-danger-light">
											$<?= number_format(round($item['precio_sugerido']),0,".",",");?>
										</td>
										<!-- Precio Fuente -->
										<td class="text-center letra-small bg-success-light">
											$<?= number_format(round(0),0,".",",");?>
										</td>
										<!-- Incremento -->
										<td class="text-center letra-small">
											$<?= number_format(round(0),0,".",",");?>
										</td>
										<!-- Precio Nuevo -->
										<td class="text-center letra-small bg-success-light">
											$<?= number_format(round(0),0,".",",");?>
										</td>
										<!-- Inc N -->
										<td class="text-center letra-small">
											$<?= number_format(round(0),0,".",",");?>
										</td>
										<!-- Observaciones -->
										<td class="text-center letra-small bg-warning-light">
											<?= $item['observaciones'];?>
										</td>

										<td>
											<div class="flex align-items-center list-user-action" style="width: 40px;">
												<span data-toggle="modal"
													data-target="#detalle<?= $item["id_detalle_cotizacion"]; ?>"
													class="btn-abrir-modal">
													<a class="iq-bg-primary text-warning" data-toggle="tooltip"
														data-placement="top" title="Detalle" href="#">
														<i class="ri-booklet-line"></i>
													</a>
												</span>
											</div>
										</td>
									</tr>
								</tbody>
								<?php endforeach; ?>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php foreach ($items as $item) : ?>
<!-- FOTO DEL PRODODUCTO -->
<div id="imagenModal<?= $item["id_detalle_cotizacion"]; ?>" class="modal fade" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
			<div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
               <div class="card">
                  
                  <div class="card-body">
                     
					 <img src="<?= base_url();?>assets/images/claves_pt/claves/<?= $item['codigo_sap_articulo']; ?>.png" class="img-fluid rounded" alt="profile">
                  </div>
               </div>
            </div>
         </div>
      </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
			</div>
		</div>
	</div>
</div>
<!-- DETALLE -->
<div class="modal fade bd-example-modal-xl" id="detalle<?= $item["id_detalle_cotizacion"]; ?>" tabindex="-1"
	role="dialog" aria-labelledby="margenObservacione" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="eliminar">Detalle</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Tabla donde se mostrarán los datos -->
				<div class="tabla-resultado<?= $item["id_detalle_cotizacion"]; ?>"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
			</div>
		</div>
	</div>
</div>

<!-- Datos filtrados por código SAP -->
<div id="datosFiltrados<?= $item["id_detalle_cotizacion"]; ?>" style="display: none;">
	<?php
			
		// Ejemplo de arreglo de datos (reemplaza esto con tu propio arreglo)
		$codigo_sap_articulo = $item['codigo_sap_articulo'];
		$familia_articulo = "109";
		$familia_articulo_pata = "135";
		$id_cotizacion = $item["id_cotizacion"];;
		
		$filteredItems = array_filter($kist, function($item) use ($codigo_sap_articulo) {
			$target = 'KIT-HAB-' . $codigo_sap_articulo;
			return ($item['fhater'] === $target);
		});
		
		$filteredKitHul = array_filter($kist, function($item) use ($codigo_sap_articulo) {
			$target = 'KIT-HUL-' . $codigo_sap_articulo;
			return ($item['fhater'] === $target);
		});

		$filteredKitMp = array_filter($kist, function($item) use ($codigo_sap_articulo) {
			$target = 'KIT-MP-' . $codigo_sap_articulo;
			return ($item['fhater'] === $target);
		});
		
		$filteredHn = array_filter($kist, function($item) use ($codigo_sap_articulo,$familia_articulo) {
			$target = 'KIT-MP-' . $codigo_sap_articulo;
			return ($item['fhater'] === $target && $item['familia_articulo'] == $familia_articulo);
		});

		

		$i=1;
		$j=1;
		$q =1;
		$n =1;
		$p = 1;
		$h = 1;
		$e = 1;
		$t = 1;
	?>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Kit de Habilitación </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($filteredItems as $filteredItem):?>
							<tr>
								<td scope="row"><b><?= $i++;?></b></td>
								<td><?= $filteredItem['code']; ?></td>
								<td><?= $filteredItem['descripcion']; ?></td>
								<td><?= $filteredItem['quantity']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($filteredItem['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($filteredItem['quantity'] * $filteredItem['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_kit_hab'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Kit de Hule Espuma </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($filteredKitHul as $datos):?>
							<tr>
								<td scope="row"><b><?= $j++;?></b></td>
								<td><?= $datos['code']; ?></td>
								<td><?= $datos['descripcion']; ?></td>
								<td><?= $datos['quantity']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['quantity'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_kit_hul'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Kit de Materia Prima </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($filteredKitMp as $datos):?>
							<tr>
								<td scope="row"><b><?= $q++;?></b></td>
								<td><?= $datos['code']; ?></td>
								<td><?= $datos['descripcion']; ?></td>
								<td><?= $datos['quantity']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['quantity'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_kit_mp'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Herraje incluido en materia prima </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($filteredHn as $datos):?>
							<tr>
								<td scope="row"><b><?= $n++;?></b></td>
								<td><?= $datos['code']; ?></td>
								<td><?= $datos['descripcion']; ?></td>
								<td><?= $datos['quantity']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['quantity'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_herraje_nacional'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Patas </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<?php if (empty($patas)) {
					echo "<h3 class='letra-small text-center'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
				} else {  ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($patas as $datos):?>
							<tr>
								<th scope="row"><?= $p++;?></th>
								<td><?= $datos['clave']; ?></td>
								<td><?= $datos['nombre']; ?></td>
								<td><?= $datos['piezas']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['piezas'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_g_patas'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Herraje importado </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<?php if (empty($herrajeI)) {
					echo "<h3 class='letra-small text-center'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
				} else {  ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($herrajeI as $datos):?>
							<tr>
								<td scope="row"><b><?= $h++;?></b></td>
								<td><?= $datos['clave']; ?></td>
								<td><?= $datos['nombre']; ?></td>
								<td><?= $datos['piezas']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['piezas'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_g_herrajes_importados'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h6 class="card-title">Contenido de Ebanistería </h6>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<?php if (empty($ebanesteria)) {
					echo "<h3 class='letra-small text-center'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
				} else {  ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($ebanesteria as $datos):?>
							<tr>
								<td scope="row"><?= $e++;?></td>
								<td><?= $datos['clave']; ?></td>
								<td><?= $datos['nombre']; ?></td>
								<td><?= $datos['piezas']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['piezas'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_g_ebanesteria'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h4 class="card-title">Contenido de Telas</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<?php if (empty($telas)) {
					echo "<h3 class='letra-small text-center'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
				} else {  ?>
					<table class="table">
						<thead>
							<tr>
								<th scope="col" class="letra-small text-center">#</th>
								<th scope="col" class="letra-small text-center">Codigo</th>
								<th scope="col" class="letra-small text-center">Concepto</th>
								<th scope="col" class="letra-small text-center">Cantidad</th>
								<th scope="col" class="letra-small text-center">Precio</th>
								<th scope="col" class="letra-small text-center">Importe</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($telas as $datos):?>
							<tr>
								<td scope="row"><b><?= $t++;?></b></td>
								<td><?= $datos['clave']; ?></td>
								<td><?= $datos['nombre']; ?></td>
								<td><?= $datos['piezas']; ?></td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
								<td>
									<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><?= number_format($datos['piezas'] * $datos['precio_costo'], 2, ".", ","); ?></span>
								</td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="5" class="text-right letra-small">Subtotal:</td>
								<td>
									<span class="float-left"><b>$</b></span>
									<!-- Símbolo de pesos alineado a la izquierda -->
									<span
										class="float-right"><b><?= number_format($item['total_g_telas'], 2, ".", ","); ?></b></span>
								</td>
							</tr>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<div class="header-title">
					<h4 class="card-title">Resumen</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="form-row">
					<div class="col-md-12 mb-3 border-right">
						<div class="form-row">
							<div class="col-md-6 mb-3 letra-small">
								MO:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format($item['mano_obra'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Costo Min:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format(1,2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								MO x CM:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format(1*$item['mano_obra'],2,".",","); ?></span>
							</div>

							<div class="col-md-6 mb-3 letra-small">
								Kits:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span
									class="float-right"><?= number_format($item['total_kit_hab']+$item['total_kit_hul']+$item['total_kit_mp'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Patas:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format($item['total_g_patas'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Ebanesteria:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span
									class="float-right"><?= number_format($item['total_g_ebanesteria'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Herraje Violanti:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span
									class="float-right"><?= number_format($item['total_herraje_nacional'],2,".",","); ?></span>
							</div>

							<div class="col-md-6 mb-3 letra-small">
								Materia Prima:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span
									class="float-right"><?= number_format($item['costo_materia_prima'],2,".",","); ?></span>
							</div>

							<div class="col-md-6 mb-3 letra-small">
								Telas:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format($item['total_g_telas'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Herraje Importado:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span
									class="float-right"><?= number_format($item['total_g_herrajes_importados'],2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Accesorios:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format(0,2,".",","); ?></span>
							</div>
							<div class="col-md-6 mb-3 letra-small">
								Total Materia prima:
							</div>
							<div class="col-md-6 mb-3 letra-small">
								<?php $suma = $item['total_kit_hab']+$item['total_kit_hul']+$item['total_kit_mp']+$item['total_g_patas']+$item['total_herraje_nacional']+$item['total_g_ebanesteria']+
											  $item['total_g_telas']+$item['total_g_herrajes_importados']; ?>
								<span class="float-left">$</span> <!-- Símbolo de pesos alineado a la izquierda -->
								<span class="float-right"><?= number_format($suma, 2, ".", ","); ?></span>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- Descripcion -->
<div class="modal fade bd-example-modal-lg" id="descripcion<?= $item["id_detalle_cotizacion"]; ?>" tabindex="-1"
	role="dialog" aria-labelledby="descripcion" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="eliminar">Descripción del codigo <?= $item['codigo_sap_articulo'];?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><?= $item['descripcion_general'];?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>

<div class="modal fade" id="detalleFactores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">etalle de factores</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				¿ Está seguro de exportar a Excel la Cotización <b> No. : <?= $items[0]['folio_consecutivo'] ?></b> aun
				sin validar?
			</div>
			<div class="modal-footer">
				<form action="<?= base_url(); ?>exportar-excel-cotizaciones-pendientes" method="post">
					<input type="hidden" name="id_cotizacion" value="<?= $items[0]['id_cotizacion'];?>">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Exportar</button>
				</form>
			</div>
		</div>
	</div>
</div>
