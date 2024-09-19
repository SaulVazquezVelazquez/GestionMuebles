<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-block card-stretch card-height print rounded">
					<div class="card-header d-flex justify-content-between bg-primary header-invoice">
						<div class="iq-header-title">
							<h4 class="card-title mb-0"><?= $this->lang->line('h4_0') ?> "<?= $datos_g['planta'] ?>"</h4>
						</div>
						<div class="invoice-btn">
						
                            <form action="<?= base_url();?>excel-reporte-inventario" method="post">
                                <input type="hidden" id="tipo_reporte" name="tipo_reporte" value="<?= $datos_g['id_tipo_reporte'] ?>" >
                                <input type="hidden" id="almacen" name="almacen" value="<?= $datos_g['id_almacen'] ?>" >
                                <input type="hidden" id="id_planta" name="id_planta" value="<?= $datos_g['id_plantas'] ?>" >
                                <button type="submit" class="btn btn-primary-dark" id="generar_excel"><i class="las la-file-excel"></i> Generar excel</button>
                            </form>
							<div class="col-md-4 mb-3 display-none" id="mensaje_reporte">
									<div class="alert alert-success" role="alert">
										<div class="iq-alert-text">Se esta generando el Excel por favor espere.</div>
									</div>
								</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="table-responsive-sm">
									<table class="table">
										<thead>
											<tr>
												<th scope="col"><?= $this->lang->line('th_0') ?></th>
												<th scope="col"><?= $this->lang->line('th_1') ?></th>
												<th scope="col"><?= $this->lang->line('th_2') ?></th>
												<th scope="col"><?= $this->lang->line('th_3') ?></th>
                                                <th scope="col"><?= $this->lang->line('th_4') ?></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?= $datos_g['tipo_reporte'] ?></td>
												<td><?= $datos_g['almacen'] ?></td>
												<td><?= $datos_g['planta'] ?></td>
												<td><?= date('d-m-Y') ?></td>
                                                <td><h3 class="text-primary font-weight-700">$<?= number_format($gran_total,2,'.',','); ?></h3></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<h5 class="mb-3"><?= $this->lang->line('h5_0') ?></h5>
								<div class="table-responsive-sm">
									<?php if (empty($datos_m)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>". $this->lang->line('h3_0') ."</h3>";
                                    } else {        ?>
									<table class="table">
										<thead>
											<tr>
												<th class="text-center" scope="col"><?= $this->lang->line('th_5') ?></th>
												<th class="text-center" scope="col"><?= $this->lang->line('th_6') ?></th>
												<th class="text-center" scope="col"><?= $this->lang->line('th_7') ?></th>
												<th class="text-center" scope="col"><?= $this->lang->line('th_8') ?></th>
                                                <th class="text-center" scope="col"><?= $this->lang->line('th_9') ?></th>
												<th class="text-center" scope="col"><?= $this->lang->line('th_10') ?></th>
												<th class="text-center" scope="col"><?= $this->lang->line('th_11') ?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($datos_m as $item) : ?>
											<tr>
												<th class="text-center" scope="row"><?= $i++ ?></th>
												<td>
													<h6 class="mb-0"><?= $item['material']; ?></h6>
													<p class="mb-0"><?= $item['codigo_sap_articulo']; ?></p>
												</td>
												<td class="text-center"><?= $item['familia_descripcion']; ?></td>
												<td class="text-center"><?= $item['unidad']; ?></td>
                                                <td class="text-center"><?= $item['stock']; ?></td>
												<td class="text-center">$ <?php if(($item['precio'] >= 0.01) && ($item['precio'] <= 0.99)){
                                                    echo number_format($item['precio'],4,'.',',');
                                                }else{
                                                    echo number_format($item['precio'],2,'.',',');
                                                } ?>
                                                    </td>
												<td class="text-center"><b>$<?= number_format($item['importe'],2,'.',','); ?></b></td>
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
	</div>
</div>
