<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Selecciona las Claves a cotizar</h4>
						</div>
					</div>
					<div class="card-body">
						<form action="<?= base_url()?>cotizacion-items-detalles" method="post">
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<label for="tipo_cotizacion">Claves a Cotizar</label>
									<select id="multiple" class="js-states form-control" name="claves[]" multiple>
										<?php foreach ($datos as $item) : ?>
										<option value="<?= $item['id_claves'];?>"><?= $item['concepto'];?> </option>
										<?php endforeach; ?>
									</select>
								</div>
                                <input type="hidden" value="<?= $id_cotizcion; ?>" name="id_cotizcion" id="id_cotizcion">
							</div>
							<div class="form-group">
								<button id="btn_continuar" class="btn btn-primary disabled"  type="submit">Continuar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Detalles del Cliente</h4>
						</div>
					</div>
					<div class="card-body">

						<div class="form-row">
							<div class="col-md-6 mb-3">
								<h6>No. de Cotización: <?= $detalle['folio_consecutivo'] ?></h6>
							</div>
                            <div class="col-md-6 mb-3">
								<h6>Cliente: <?= $detalle['card_foreign_name'] ?></h6>
							</div>
                            <div class="col-md-6 mb-3">
								<h6>Factor de Cotización: <?= $factor_cotizacion ?>%</h6>
							</div>
                            <div class="col-md-6 mb-3">
								<h6>Tipo Cotización: <?= $detalle['tipo_cotizacion'] ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
