<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Proceso de Cotización</h4>
						</div>
					</div>
					<div class="card-body">
						<p>Elije un cliente y un tipo de cotización para iniciar el proceso de cotización</p>
						<form action="<?= base_url()?>cotizacion-items" method="post">
							<div class="form-row">
								<div class="col-md-6 mb-3">
									<label for="clientes">Cliente</label>
									<select class="form-control" id="clientes" name="clientes">
                                        <option selected disabled value="">Selecciona una opción</option>
									</select>
								</div>
								<div class="col-md-6 mb-3">
									<label for="tipo_cotizacion">Tipo Cotización</label>
									<select class="form-control" id="tipo_cotizacion" name="tipo_cotizacion">
                                    <option selected disabled value="">Selecciona una opción</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-primary disabled" type="submit" id="btn_continuar">Continuar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
