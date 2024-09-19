<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Cotizaciones Pendientes</h4>
						</div>
                        <div class="header-title">
                        <button type="button" class="btn btn-outline-success mt-2"
												data-toggle="modal"
												data-target="#nuevaClave">Nueva Clave</button>
						</div>
					</div>
					<div class="card-body">

						<div class="table-responsive-lg">
							<?php if (empty($items)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
							<table id="datatable" class="table data-table table-striped table-bordered">
								<thead>
									<tr>
										<th class="centered-cell" rowspan="2" style="width: 140px;">Foto</th>
										<th class="centered-cell" rowspan="2" style="width: 90px !important;">Clave</th>
										<th class="centered-cell" colspan="4">Telas</th>
										<th class="centered-cell" colspan="2">Patas</th>
										<th class="centered-cell" colspan="2">Herraje Imp.</th>
										<th class="centered-cell" colspan="3">Ebanesteria</th>
										<th class="centered-cell" rowspan="2" style="width: 80px !important;">MO</th>
										<th class="centered-cell" rowspan="2" style="width: 110px;">Accion</th>
									</tr>
									<tr>
										<th class="centered-cell" style="width: 100px;">Mts1</th>
										<th class="centered-cell" style="width: 100px;">Mts2</th>
										<th class="centered-cell" style="width: 100px;">Mts3</th>
										<th class="centered-cell" style="width: 100px;">Mts4</th>
										<th class="centered-cell" style="width: 100px;">1</th>
										<th class="centered-cell" style="width: 100px;">2</th>
										<th class="centered-cell" style="width: 100px;">1</th>
										<th class="centered-cell" style="width: 100px;">2</th>
										<th class="centered-cell" style="width: 100px;">1</th>
										<th class="centered-cell" style="width: 100px;">2</th>
										<th class="centered-cell" style="width: 100px;">3</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach ($items as $item) : ?>
									<tr>
										<th class="centered-cell" scope="row"><img class="rounded img-fluid avatar-87"
												src="<?= base_url();?>assets/images/claves_pt/claves/<?= $item['concepto']; ?>.png"
												alt="profile">
										</th>
										<td class="centered-cell letra-small"><b><?= $item['concepto']; ?></b></td>
										<td class="centered-cell"><?= $item['mts_1']; ?></td>
										<td class="centered-cell"><?= $item['mts_2']; ?></td>
										<td class="centered-cell"><?= $item['mts_3']; ?></td>
										<td class="centered-cell"><?= $item['mts_4']; ?></td>
										<td class="centered-cell"><?= $item['pata_1']; ?></td>
										<td class="centered-cell"><?= $item['pata_2']; ?></td>
										<td class="centered-cell"><?= $item['herraje_1']; ?></td>
										<td class="centered-cell"><?= $item['herraje_2']; ?></td>
										<td class="centered-cell"><?= $item['ebanisteria_1']; ?></td>
										<td class="centered-cell"><?= $item['ebanisteria_2']; ?></td>
										<td class="centered-cell"><?= $item['ebanisteria_3']; ?></td>
										<td class="centered-cell">$ <?= number_format($item['mano_de_obra'],2,".",","); ?></td>
										<td class="centered-cell">
											<button type="button" class="btn btn-outline-success mt-2"
												data-toggle="modal"
												data-target="#editarClabe<?= $item["id_claves"]; ?>">Editar</button>
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

<?php foreach($items as $item): ?>
<div class="modal fade bd-example-modal-lg" id="editarClabe<?= $item["id_claves"]; ?>" tabindex="-1"
	role="dialog" aria-labelledby="editarClabe" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="<?= base_url(); ?>claves/actualizar" method="post">
				<div class="modal-header">
					<h5 class="modal-title" id="eliminar">Editar Clave </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!--  -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 col-lg-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between">
										<div class="header-title">
											<h4 class="card-title">Clave: <?= $item['concepto'];?></h4>
										</div>
									</div>
									<div class="card-body">

										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="validationDefault01">Concepto Clave</label>
												<input type="text" class="form-control" name="clave" value="<?= $item['concepto'];?>" disabled>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationDefault01">Mano de Obra</label>
												<input type="text" class="form-control" name="mano_obra" value="<?= $item['mano_de_obra'];?>" required>
											</div>
                                            <div class="col-md-12 mb-3 text-center">
												<h6>Metraje de Telas</h6>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_1"
													value="<?= $item['mts_1'];?>" required>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_2"
													value="<?= $item['mts_2'];?>" required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_3"
													value="<?= $item['mts_3'];?>" required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_4"
													value="<?= $item['mts_4'];?>" required>
											</div>
                                            <div class="col-md-6 mb-3 text-center">
												<h6>Cantidad de Patas</h6>
											</div>
                                            <div class="col-md-6 mb-3 text-center">
												<h6>Cantidad de Herrajes importados</h6>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Pata 1</label>
												<input type="text" class="form-control" name="pata_1"
													value="<?= $item['pata_1'];?>" required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Pata 2</label>
												<input type="text" class="form-control" name="pata_2"
													value="<?= $item['pata_2'];?>" required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Herraje Imp. 1</label>
												<input type="text" class="form-control" name="herraje_1"
													value="<?= $item['herraje_1'];?>" required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Herraje Imp. 2</label>
												<input type="text" class="form-control" name="herraje_2"
													value="<?= $item['herraje_2'];?>" required>
											</div>
                                            <div class="col-md-12 mb-3 text-center">
												<h6>Cantidad de Ebanisterías</h6>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 1</label>
												<input type="text" class="form-control" name="ebanisteria_1"
													value="<?= $item['ebanisteria_1'];?>" required>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 2</label>
												<input type="text" class="form-control" name="ebanisteria_2"
													value="<?= $item['ebanisteria_2'];?>" required>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 3</label>
												<input type="text" class="form-control" name="ebanisteria_3"
													value="<?= $item['ebanisteria_3'];?>" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--  -->
				</div>
				<div class="modal-footer">
                    <input type="hidden" name="id_claves" value="<?= $item['id_claves'];?>">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<div class="modal fade bd-example-modal-lg" id="nuevaClave" tabindex="-1"
	role="dialog" aria-labelledby="nuevaClave" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="<?= base_url(); ?>claves/registro" method="post">
				<div class="modal-header">
					<h5 class="modal-title">Nueva Clave </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!--  -->
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-12 col-lg-12">
								<div class="card">
									<div class="card-body">
										<div class="form-row">
											<div class="col-md-6 mb-3">
												<label for="validationDefault01">Concepto Clave</label>
												<input type="text" class="form-control" name="clave" required>
											</div>
											<div class="col-md-6 mb-3">
												<label for="validationDefault01">Mano de Obra</label>
												<input type="text" class="form-control" name="mano_obra" required>
											</div>
                                            <div class="col-md-12 mb-3 text-center">
												<h6>Metraje de Telas</h6>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_1"
													 required>
											</div>
											<div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_2"
													 required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_3"
													 required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Mts1</label>
												<input type="text" class="form-control" name="mts_4"
													 required>
											</div>
                                            <div class="col-md-6 mb-3 text-center">
												<h6>Cantidad de Patas</h6>
											</div>
                                            <div class="col-md-6 mb-3 text-center">
												<h6>Cantidad de Herrajes importados</h6>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Pata 1</label>
												<input type="text" class="form-control" name="pata_1"
													 required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Pata 2</label>
												<input type="text" class="form-control" name="pata_2"
													 required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Herraje Imp. 1</label>
												<input type="text" class="form-control" name="herraje_1"
													 required>
											</div>
                                            <div class="col-md-3 mb-3">
												<label for="validationDefault01">Herraje Imp. 2</label>
												<input type="text" class="form-control" name="herraje_2"
													 required>
											</div>
                                            <div class="col-md-12 mb-3 text-center">
												<h6>Cantidad de Ebanisterías</h6>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 1</label>
												<input type="text" class="form-control" name="ebanisteria_1"
													 required>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 2</label>
												<input type="text" class="form-control" name="ebanisteria_2"
													 required>
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="validationDefault01">Ebanistería 3</label>
												<input type="text" class="form-control" name="ebanisteria_3"
													 required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--  -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Registrar</button>
				</div>
			</form>
		</div>
	</div>
</div>