<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<!--  -->
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
			<!--  -->
			<div id="mns_detalle_1" class="col-lg-12">
				<div class="card car-transparent">
					<div class="card-body p-0">
						<div class="profile-image position-relative">
							<img src="<?= base_url();?>assets/images/page-img/PORTADA 1278x436.jpg"
								class="img-fluid rounded w-100" alt="">
						</div>
						<div class="profile-overly">
							<h3><?= $items[0]['card_foreign_name'] ?></h3>
							<span>Cotización: <?= $items[0]['folio_consecutivo'] ?></span>
						</div>
					</div>
				</div>
			</div>
			<div id="mns_detalle_3" class="col-lg-4 col-md-6 col-sm-6">
				<div class="card card-block card-stretch card-height">
					<div class="card-body text-center">
						<svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
								fill="#05bbc9" />
						</svg>
						<h2 class="mb-2 mt-3 text-primary">Imprimir</h2>

					</div>
				</div>
			</div>
			<div id="mns_detalle_4" class="col-lg-4 col-md-6 col-sm-6">
				<div class="card card-block card-stretch card-height">
					<div class="card-body text-center">
						<svg width="60" height="48" viewBox="0 0 60 48" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M23.9091 24.5297C24.495 25.1156 25.4447 25.1156 26.0306 24.5297L27.0909 23.4694C27.6769 22.8834 27.6769 21.9338 27.0909 21.3478L23.7422 18L27.09 14.6512C27.6759 14.0653 27.6759 13.1156 27.09 12.5297L26.0297 11.4694C25.4437 10.8834 24.4941 10.8834 23.9081 11.4694L18.4387 16.9387C17.8528 17.5247 17.8528 18.4744 18.4387 19.0603L23.9091 24.5297V24.5297ZM32.91 23.4703L33.9703 24.5306C34.5563 25.1166 35.5059 25.1166 36.0919 24.5306L41.5613 19.0613C42.1472 18.4753 42.1472 17.5256 41.5613 16.9397L36.0919 11.4703C35.5059 10.8844 34.5563 10.8844 33.9703 11.4703L32.91 12.5306C32.3241 13.1166 32.3241 14.0662 32.91 14.6522L36.2578 18L32.91 21.3488C32.3241 21.9347 32.3241 22.8844 32.91 23.4703V23.4703ZM58.5 39H35.7694C35.7 40.8572 34.3903 42 32.7 42H27C25.2478 42 23.9044 40.3622 23.9278 39H1.5C0.675 39 0 39.675 0 40.5V42C0 45.3 2.7 48 6 48H54C57.3 48 60 45.3 60 42V40.5C60 39.675 59.325 39 58.5 39ZM54 4.5C54 2.025 51.975 0 49.5 0H10.5C8.025 0 6 2.025 6 4.5V36H54V4.5ZM48 30H12V6H48V30Z"
								fill="#37e6b0" />
						</svg>
						<h2 class="mb-2 mt-3 text-success">Cancelar Cotización </h2>
					</div>
				</div>
			</div>
			<div id="mns_detalle_5" class="col-lg-4 col-md-6 col-sm-6">
				<a href="<?= base_url();?>enviar-cotizacion/<?= $id_cotizaciones_claves; ?>/<?= $id_cotizacion; ?>">
					<div class="card card-block card-stretch card-height">
						<div class="card-body text-center">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
									d="M35.3676 11.2517C34.8398 11.2372 34.3256 11.3198 33.8438 11.4898V7.03125C33.8438 4.70503 31.9512 2.8125 29.625 2.8125C29.0759 2.8125 28.5517 2.91909 28.0701 3.11072C27.5821 1.32047 25.9428 0 24 0C22.0572 0 20.4179 1.32047 19.9299 3.11072C19.4483 2.91909 18.9241 2.8125 18.375 2.8125C16.0488 2.8125 14.1562 4.70503 14.1562 7.03125V11.4895C13.6747 11.3198 13.1607 11.2372 12.6324 11.2517C10.3711 11.3136 8.53125 13.2316 8.53125 15.5272V48H36.6562V41.2395L38.5637 36.4704C39.1643 34.9689 39.4688 33.3877 39.4688 31.7705V15.5272C39.4688 13.2316 37.6289 11.3136 35.3676 11.2517V11.2517ZM11.3438 45.1875V42.375H33.8438V45.1875H11.3438ZM36.6562 31.7705C36.6562 33.0283 36.4194 34.2581 35.9523 35.4261L34.2979 39.5625H11.3438V15.5272C11.3438 14.7405 11.9564 14.0837 12.7095 14.0631C13.0926 14.0504 13.4561 14.1937 13.7305 14.4607C14.0051 14.7278 14.1563 15.0858 14.1563 15.4687V21.9843H16.9688V7.03125C16.9688 6.25584 17.5997 5.625 18.3751 5.625C19.1505 5.625 19.7813 6.25584 19.7813 7.03125V21.9844H22.5938V4.21875C22.5938 3.44334 23.2247 2.8125 24.0001 2.8125C24.7755 2.8125 25.4063 3.44334 25.4063 4.21875V21.9844H28.2188V7.03125C28.2188 6.25584 28.8497 5.625 29.6251 5.625C30.4005 5.625 31.0313 6.25584 31.0313 7.03125V24.1714C24.712 24.8732 19.7812 30.2467 19.7812 36.75H22.5938C22.5938 31.3222 27.0097 26.9062 32.4375 26.9062H33.8438V15.4688C33.8438 15.0859 33.995 14.7278 34.2696 14.4608C34.544 14.1938 34.9067 14.0508 35.2906 14.0632C36.0436 14.0838 36.6562 14.7406 36.6562 15.5273V31.7705Z"
									fill="#ffca44" />
							</svg>
							<h2 class="mb-2 mt-3 text-warning">Enviar Cotización</h2>
						</div>
					</div>
				</a>
				

			</div>
			<div id="mns_detalle_6" class="col-lg-12 col-md-6">
				<div class="card card-block card-stretch card-height">
					<div class="card-header">
						<div class="header-title">
							<h4 class="card-title">Detalle de la Orden</h4>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive-lg">
							<table class="table">
								<thead>
									<tr>
										<th class="text-center letra-xxsmall" scope="col">#</th>
										<th scope="col" class="letra-xxsmall">Item</th>
										<th class="text-center letra-xxsmall" scope="col">Fuente</th>
										<th class="text-center letra-xxsmall" scope="col">Descripción</th>
										<th class="text-center letra-xxsmall" scope="col">K. Hab</th>
										<th class="text-center letra-xxsmall" scope="col">K. Hul</th>
										<th class="text-center letra-xxsmall" scope="col">K. MP</th>
										<th class="text-center letra-xxsmall" scope="col">H.Nacional</th>
										<th class="text-center letra-xxsmall" scope="col">H.Import</th>
										<th class="text-center letra-xxsmall" scope="col">Patas</th>
										<th class="text-center letra-xxsmall" scope="col">Ebanest.</th>
										<th class="text-center letra-xxsmall" scope="col">Costo MP</th>
										<th class="text-center letra-xxsmall" scope="col">Telas</th>
										<th class="text-center letra-xxsmall" scope="col">Acceso.</th>
										<th class="text-center letra-xxsmall" scope="col">Total MP</th>
										<th class="text-center letra-xxsmall" scope="col">MO</th>
										<!-- <th class="text-center letra-xxsmall" scope="col">P.Cotizado</th> -->
										<th class="text-center letra-xxsmall" scope="col">Opciones</th>
									</tr>
								</thead>
								<?php foreach ($items as $item) : ?>
								<tbody>
									<tr>
										<th class="text-cente " scope="row"><img class="rounded img-fluid avatar-40"
												src="<?= base_url();?>assets/images/claves_pt/claves/<?= $item['imagen']; ?>.png"
												alt="profile"></th>
										<td class="letra-xxsmall">
											<h6 class="mb-0"><?= $item['codigo_sap_articulo'];?></h6>
										</td>
										<td class="text-center letra-small"><?= $item['id_cotizaciones_claves'];?></td>
										<td class="text-center letra-small"><?= $item['descripcion_general'];?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_kit_hab'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_kit_hul'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_kit_mp'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_herraje_nacional'],2,".",",");?></td>
											<td class="text-center letra-small">
											$<?= number_format($item['total_g_herrajes_importados'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_g_patas'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_g_ebanesteria'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['costo_materia_prima'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_g_telas'],2,".",",");?></td>
										<td class="text-center letra-small">$0.00</td>
										<td class="text-center letra-small">
											$<?= number_format($item['total_mp'],2,".",",");?></td>
										<td class="text-center letra-small">
											$<?= number_format($item['mano_obra'],2,".",",");?></td>
										<!-- <td class="text-center letra-small">
											$<?= number_format($item['precio_sugerido'],2,".",",");?></td> -->
										<td class="text-center letra-small">
											<div class="flex align-items-center list-user-action">
												<a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
													title="" data-original-title="Detalle" id="detalle_cot"
													href="<?= base_url();?>detalle-item/<?= $item['codigo_sap_articulo'];?>/<?= $item['id_temp_cotizacion'];?>/<?= $item['id_cotizaciones_claves'];?>/<?= $item['id_cotizacion'];?>/<?= $item['id_padre'];?> "><i
														class="ri-booklet-line"></i></a>
												<a class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
													title="" data-original-title="Edit"
													href="<?= base_url(); ?>editar-item/<?= $item['id_temp_cotizacion'];?>/<?= $item['id_cotizaciones_claves'];?>/<?= $item['id_cotizacion'];?>"><i
														class="ri-pencil-line"></i></a>
												<?php if($tamanio_array > 1):?>
												<span data-toggle="modal"
													data-target="#eliminar<?= $item["id_temp_cotizacion"]; ?>"><a
														class="iq-bg-primary" data-toggle="tooltip" data-placement="top"
														title="" data-original-title="Eliminar" href="#"><i
															class="ri-delete-bin-line"></i></a></span>
												<?php endif;?>
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
<div class="modal fade" id="eliminar<?= $item["id_temp_cotizacion"]; ?>" tabindex="-1" role="dialog"
	aria-labelledby="eliminar" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="eliminar">Eliminar Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Vas a eliminar el item <?= $item["codigo_sap_articulo"]; ?> una vez eliminado no podras recuperarlo
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<form action="<?= base_url(); ?>eliminar-item" method="post">
					<input type="hidden" id="id_temp_cotizacion" name="id_temp_cotizacion"
						value="<?= $item["id_temp_cotizacion"]; ?>">
					<input type="hidden" id="id_cotizaciones_claves" name="id_cotizaciones_claves"
						value="<?= $item["id_cotizaciones_claves"]; ?>">
					<input type="hidden" id="id_cotizacion" name="id_cotizacion" value="<?= $item["id_cotizacion"]; ?>">
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>

			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>
