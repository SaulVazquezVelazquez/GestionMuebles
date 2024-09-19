<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!--  -->
				<div id="mns_procesando" class="card-body display-none">
					<div class="wrapper">
						<div class="container">
							<div class="row no-gutters height-self-center">
								<div class="col-sm-12 text-center align-self-center">
									<div class="iq-error position-relative">
										<img src="<?= base_url();?>/assets/images/carga/02.png"
											class="img-fluid iq-error-img" alt="">
										<h2 class="mb-0 mt-4">Estamos Procesando tu Cotizacion</h2>
										<p>Por favor espere.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--  -->
				<form action="<?= base_url();?>previo-items-detalles" method="post">
					<div class="card">

						<div id="mns_titulo" class="card-header d-flex justify-content-between">
							<div class="header-title">
								<h4 class="card-title">Detalle de las Claves seleccionadas</h4>
							</div>
							<div class="header-title">
								<button id="procesar_orden" type="submit" class="btn btn-primary">Actualizar</button>
							</div>
						</div>

						<div id="mns_detalle" class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center text-center" scope="col">#</th>
											<th scope="col" class="text-center">Item</th>
											<th class="text-center" scope="col">Tela 1</th>
											<th class="text-center" scope="col">Tela 2</th>
											<th class="text-center" scope="col">Tela 3</th>
											<th class="text-center" scope="col">Tela 4</th>
											<th class="text-center" scope="col">Pata 1</th>
											<th class="text-center" scope="col">Pata 2</th>
											<th class="text-center" scope="col">Herraje 1</th>
											<th class="text-center" scope="col">Herraje 2</th>
											<th class="text-center" scope="col">Ebanist. 1</th>
											<th class="text-center" scope="col">Ebanist. 2</th>
											<th class="text-center" scope="col">Ebanist. 3</th>
										</tr>
									</thead>
									<?php foreach ($detalle_items as $item) : ?>
									<tbody>
										<tr>
											<th>
												<img class="rounded img-fluid avatar-40"
													src="<?= base_url();?>assets/images/claves_pt/claves/<?= $item['imagen']; ?>.png	"
													alt="profile">
											</th>
											<th>
												<h6 class="mb-0"><?= $item['concepto'];?></h6>
												<p class="mb-0">MO:
													$<?= number_format($item['mano_de_obra'], 2, '.', ',') ;?>
												</p>
											</th>

											<!-- TELAS -->
											<th class="th-cot text-center"><?= $item['mts_1']; ?> mts</th>
											<th class="th-cot text-center"><?= $item['mts_2']; ?> mts</th>
											<th class="th-cot text-center"><?= $item['mts_3']; ?> mts</th>
											<th class="th-cot text-center"><?= $item['mts_4']; ?> mts</th>
											<!-- PATAS -->
											<th class="th-cot text-center"><?= $item['pata_1']; ?> pz</th>
											<th class="th-cot text-center"><?= $item['pata_2']; ?> pz</th>
											<!-- HERRAJES -->
											<th class="th-cot text-center"><?= $item['herraje_1']; ?> pz</th>
											<th class="th-cot text-center"><?= $item['herraje_2']; ?> pz</th>
											<!-- EBANESTEROIA -->
											<th class="th-cot text-center"><?= $item['ebanisteria_1']; ?> pz</th>
											<th class="th-cot text-center"><?= $item['ebanisteria_2']; ?> pz</th>
											<th class="th-cot text-center"><?= $item['ebanisteria_3']; ?> pz</th>
										</tr>

										<tr>
											<th colspan="2" class="text-center">
												<?php if($item['variante'] == 0): ?>
												<a
													href="<?= base_url();?>agregar-variante/<?= $item['id_cotizacion']; ?>/<?= $item['id_claves']; ?>/<?= $item['id_cotizaciones_claves']; ?>">
													<button type="button" class="btn btn-outline-warning mt-2"><i
															class="las la-plus-circle"></i>Variante</button></a>
												<?php endif;?>

											</th>
											<!-- TELAS -->
											<th>
												<?php if ($item['mts_1'] > 0): ?>
												<select class="form-control" id="tela_uno" name="telas_uno[]">
													<?php foreach ($telas as $item_t1) : ?>
													<div class="input-group">
														<option value="tela1-<?= $item_t1['id_oitm'];?>">
															<?= $item_t1['numero_tela'];?> </option>
													</div>
													<?php endforeach; ?>
												</select>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="telas_uno[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['mts_2'] > 0): ?>
												<select class="form-control" id="tela_dos" name="telas_dos[]">
													<?php foreach ($telas as $item_t2) : ?>
													<div class="input-group">
														<option value="tela2-<?= $item_t2['id_oitm'];?>">
															<?= $item_t2['numero_tela'];?> </option>
													</div>
													<?php endforeach; ?>
												</select>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="telas_dos[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['mts_3'] > 0): ?>
												<select class="form-control" id="tela_3" name="telas_tres[]">
													<?php foreach ($telas as $item_t3) : ?>
													<div class="input-group">
														<option value="tela3-<?= $item_t1['id_oitm'];?>">
															<?= $item_t1['numero_tela'];?> </option>
													</div>
													<?php endforeach; ?>
												</select>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="telas_tres[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['mts_4'] > 0): ?>
												<select class="form-control" id="tela_cuatro" name="telas_cuatro[]">
													<?php foreach ($telas as $item_t4) : ?>
													<div class="input-group">
														<option value="tela4-<?= $item_t1['id_oitm'];?>">
															<?= $item_t1['numero_tela'];?> </option>
													</div>
													<?php endforeach; ?>
												</select>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="telas_cuatro[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<!-- PATAS -->
											<th>
												<?php if ($item['pata_1'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="pata_uno[]">
														<?php foreach ($patas as $item_p1) : ?>
														<div class="input-group">
															<option value="pata1-<?= $item_p1['id_oitm'];?>">
																<?= $item_p1['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="pata_uno[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['pata_2'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="pata_dos[]">
														<?php foreach ($patas as $item_p2) : ?>
														<div class="input-group">
															<option value="pata2-<?= $item_p2['id_oitm'];?>">
																<?= $item_p2['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="pata_dos[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<!-- HERRAJES -->
											<th>
												<?php if ($item['herraje_1'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="herraje_uno[]">
														<?php foreach ($herraje as $item_h1) : ?>
														<div class="input-group">
															<option value="herraje1-<?= $item_h1['id_oitm'];?>">
																<?= $item_h1['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="herraje_uno[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['herraje_2'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="herraje_dos[]">
														<?php foreach ($herraje as $item_h2) : ?>
														<div class="input-group">
															<option value="herraje2-<?= $item_h2['id_oitm'];?>">
																<?= $item_h2['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="herraje_dos[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<!-- EBANESTERIA -->
											<th>
												<?php if ($item['ebanisteria_1'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="ebanesteria_uno[]">
														<?php foreach ($ebanesteria as $item_eb1) : ?>
														<div class="input-group">
															<option value="ebanesteria1-<?= $item_eb1['id_oitm'];?>">
																<?= $item_eb1['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="ebanesteria_uno[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['ebanisteria_2'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="ebanesteria_dos[]">
														<?php foreach ($ebanesteria as $item_eb2) : ?>
														<div class="input-group">
															<option value="ebanesteria2-<?= $item_eb2['id_oitm'];?>">
																<?= $item_eb2['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="ebanesteria_dos[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
											<th>
												<?php if ($item['ebanisteria_3'] > 0): ?>
												<div class="input-group">
													<select class="form-control" name="ebanesteria_tres[]">
														<?php foreach ($ebanesteria as $item_eb3) : ?>
														<div class="input-group">
															<option value="ebanesteria3-<?= $item_eb3['id_oitm'];?>">
																<?= $item_eb3['clave_articulo'];?> </option>
														</div>
														<?php endforeach; ?>
													</select>
												</div>
												<?php else: ?>
												<div class="input-group">
													<input type="text" class="form-control" disabled>
													<input type="hidden" class="form-control" name="ebanesteria_tres[]"
														value="0">
												</div>
												<?php endif; ?>
											</th>
										</tr>
									</tbody>
									<?php endforeach; ?>
								</table>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
