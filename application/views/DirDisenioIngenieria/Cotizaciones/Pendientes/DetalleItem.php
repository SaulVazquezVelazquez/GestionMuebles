<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-5">
				<div class="card card-block p-card" style="height: 450px;">
					<div class="profile-box" style="height: 420px;">
						<div class="profile-card rounded">
							<img src="<?= base_url();?>assets/images/claves_pt/claves/<?= $codigo_sap_articulo; ?>.png"
								alt="profile-bg" class="avatar-155 rounded d-block mx-auto img-fluid mb-3">
							<h3 class="font-600 text-white text-center mb-0"><?= $codigo_sap_articulo; ?></h3>
							<p class="text-white text-center mb-5">Precio Sugerido:
								$<?= number_format($item[0]['precio_sugerido'],2,".","."); ?></p>
						</div>
						<div class="pro-content rounded">
							<a  class="btn btn-block btn-outline-primary mt-2" href="<?= base_url();?>cotizaciones-pendientes-detalle/<?= $item[0]['id_cotizacion']; ?>/<?= $cliente['id_business_partnes']; ?>"><i class="ri-heart-line"></i>Regresar a la cotización</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Resumen Costos </h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Mano de Obra</th>
										<th scope="col">Costo Minuto</th>
										<th scope="col">Mano de Obra x Costo Minuto</th>
									</tr>
								</thead>
								<tbody>

									<tr>
										<td><?= number_format($item[0]['mano_obra'],2,".",".");?></td>
										<td>$<?= number_format(1,2,".",".");?></td>
										<td>$<?= number_format($item[0]['mano_obra']*1,2,".",".");?></td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card card-block mb-3">
					
					<div class="card-body">
						<div class="table-responsive">
							
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Kits</th>
										<th scope="col">Patas</th>
										<th scope="col">H.Viometal</th>
										<th scope="col">Ebanes.</th>
										<th scope="col">MP</th>
										<th scope="col">Telas</th>
                                        <th scope="col">H.Imp.</th>
                                        <th scope="col">Acces.</th>
                                        <th scope="col">Total MP</th>
									</tr>
								</thead>
								<tbody>
									<tr>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
                                    <td>$<?= number_format($item[0]['mano_obra'],2,".",","); ?></td>
										
									</tr>
								</tbody>
							</table>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Kit de Habilitación </h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_kit_hab'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kitHab as $itemkhab) : ?>
									<tr>
										<th scope="row"><?= $i++;?></th>
										<td><?= $itemkhab['codigo_sap_articulo']; ?></td>
										<td><?= $itemkhab['nombre_articulo']; ?></td>
										<td><?= $itemkhab['quantity']; ?></td>
										<td>$<?= number_format($itemkhab['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemkhab['quantity']*$itemkhab['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">

				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Kit de Hule y Espuma</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_kit_hul'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($kitHul)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($kitHab as $itemkhab) : ?>
									<tr>
										<th scope="row"><?= $i++;?></th>
										<td><?= $itemkhab['codigo_sap_articulo']; ?></td>
										<td><?= $itemkhab['nombre_articulo']; ?></td>
										<td><?= $itemkhab['quantity']; ?></td>
										<td>$<?= number_format($itemkhab['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemkhab['quantity']*$itemkhab['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!-- ccccccccccc -->
			<div class="col-lg-6">
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Kit de Materia Prima</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_kit_mp'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($KitMp)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($KitMp as $itemMp) : ?>
									<tr>
										<th scope="row"><?= $h++;?></th>
										<td><?= $itemMp['codigo_sap_articulo']; ?></td>
										<td><?= $itemMp['nombre_articulo']; ?></td>
										<td><?= $itemMp['quantity']; ?></td>
										<td>$<?= number_format($itemMp['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemMp['quantity']*$itemMp['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Herraje incluido en materia prima</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_herraje_nacional'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($herrajeN as $itemHN) : ?>
									<tr>
										<th scope="row"><?= $q++;?></th>
										<td><?= $itemHN['codigo_sap_articulo']; ?></td>
										<td><?= $itemHN['nombre_articulo']; ?></td>
										<td><?= $itemHN['quantity']; ?></td>
										<td>$<?= number_format($itemHN['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemHN['quantity']*$itemHN['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Patas</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($patas)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($patas as $itemPata) : ?>
									<tr>
										<th scope="row"><?= $l++;?></th>
										<td><?= $itemPata['codigo_sap_articulo']; ?></td>
										<td><?= $itemPata['nombre_articulo']; ?></td>
										<td><?= $itemPata['quantity']; ?></td>
										<td>$<?= number_format($itemPata['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemPata['quantity']*$itemPata['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Herraje Importado</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_g_herrajes_importados'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($herrajeI)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($herrajeI as $itemHi) : ?>
									<tr>
										<th scope="row"><?= $f++;?></th>
										<td><?= $itemHi['codigo_sap_articulo']; ?></td>
										<td><?= $itemHi['nombre_articulo']; ?></td>
										<td><?= $itemHi['quantity']; ?></td>
										<td>$<?= number_format($itemHi['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemHi['quantity']*$itemHi['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Ebanesteria</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_g_ebanesteria'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($ebanesteria)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($ebanesteria as $itemEb) : ?>
									<tr>
										<th scope="row"><?= $e++;?></th>
										<td><?= $itemEb['codigo_sap_articulo']; ?></td>
										<td><?= $itemEb['nombre_articulo']; ?></td>
										<td><?= $itemEb['quantity']; ?></td>
										<td>$<?= number_format($itemEb['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemEb['quantity']*$itemEb['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="card card-block mb-3">
					<div class="card-header d-flex justify-content-between">
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Contenido de Telas</h4>
						</div>
						<div class="iq-header-title">
							<h4 class="card-title mb-0">Total:
								$<?= number_format($item[0]['total_g_telas'],2,".","."); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php if (empty($telas)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Codigo</th>
										<th scope="col">Concepto</th>
										<th scope="col">Cantidad</th>
										<th scope="col">Precio</th>
										<th scope="col">Importe</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($telas as $itemEb) : ?>
									<tr>
										<th scope="row"><?= $t++;?></th>
										<td><?= $itemEb['codigo_sap_articulo']; ?></td>
										<td><?= $itemEb['nombre_articulo']; ?></td>
										<td><?= $itemEb['quantity']; ?></td>
										<td>$<?= number_format($itemEb['precio_costo'],2,".",","); ?></td>
										<td>$<?= number_format($itemEb['quantity']*$itemEb['precio_costo'],2,".",","); ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
