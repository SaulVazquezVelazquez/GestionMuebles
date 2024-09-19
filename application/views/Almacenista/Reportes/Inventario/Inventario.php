<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title"><?= $this->lang->line('h4_0'); ?></h4>
						</div>
					</div>
					<div class="card-body">
						<form action="<?= base_url();?>generar-reporte-inventario" method="post">
							<div class="form-row">
								<div class="col-md-6 mb-3">
									<label for="tipo_reporte"><?= $this->lang->line('lbl_3'); ?></label>
									<select class="form-control" id="tipo_reporte" name="tipo_reporte" required>
										<option selected disabled value="nulo"><?= $this->lang->line('opt_0'); ?>
										</option>
									</select>
								</div>
								<div class="col-md-6 mb-3">
									<label for="almacen"><?= $this->lang->line('lbl_4'); ?></label>
									<select class="form-control" id="almacen" name="almacen" required>
										<option selected disabled value="nulo"><?= $this->lang->line('opt_0'); ?>
										</option>
									</select>
								</div>
								<input id="id_planta" name="id_planta" type="hidden">
								<div class="col-md-4 mb-3 display-none" id="mensaje_reporte">
									<div class="alert alert-success" role="alert">
										<div class="iq-alert-text">Se esta generando el reporte por favor espere...
											Gracias</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-primary disabled" type="submit"
									id="btn_generar_reporte"><?= $this->lang->line('btn_1'); ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
