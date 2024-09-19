<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $this->lang->line('tab_navegador'); ?> </title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico" />
	<link rel="stylesheet" href="<?= base_url(	); ?>assets/css/backend-plugin.min.css?v=2.0.0">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/backend.css?v=2.0.0">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/remixicon/fonts/remixicon.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/@icon/dripicons/dripicons.css">

	<link rel='stylesheet' href='<?= base_url(); ?>assets/vendor/fullcalendar/core/main.css' />
	<link rel='stylesheet' href='<?= base_url(); ?>assets/vendor/fullcalendar/daygrid/main.css' />
	<link rel='stylesheet' href='<?= base_url(); ?>assets/vendor/fullcalendar/timegrid/main.css' />
	<link rel='stylesheet' href='<?= base_url(); ?>assets/vendor/fullcalendar/list/main.css' />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/mapbox/mapbox-gl.css">
</head>

<body class=" ">
	<!-- loader Start -->
	<div id="loading">
		<div id="loading-center">
		</div>
	</div>
	<!-- loader END -->

	<div class="wrapper">
		<section class="login-content">
			<div class="container h-100">
				<div class="row align-items-center justify-content-center h-100">
					<div class="col-12">
						<div class="row align-items-center">
							<div class="col-lg-6">
								<h2 class="mb-2"><?= $this->lang->line('h2_0'); ?></h2>
								<form action="<?= base_url();?>inicio-sesion" method="post">
									<div class="row">
										<div class="col-lg-12">
											<div class="floating-label form-group">
												<input class="floating-input form-control" type="text" name="usuario" id="usuario">
												<label><?= $this->lang->line('lbl_0'); ?></label>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="floating-label form-group">
												<input class="floating-input form-control" type="password"
													name="contrasenia" id="contrasenia">
												<label><?= $this->lang->line('lbl_1'); ?></label>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="custom-control custom-checkbox mb-3">
												<input type="checkbox" class="custom-control-input" id="customCheck1">
												<label class="custom-control-label" for="customCheck1"><?= $this->lang->line('lbl_2'); ?></label>
											</div>
										</div>
										<div class="col-lg-6 rtl-left">
											<a href="auth-recoverpw.html" class="text-primary float-right"><?= $this->lang->line('link_0'); ?></a>
										</div>
									</div>
									<button type="submit" class="btn btn-primary"><?= $this->lang->line('btn_0'); ?></button>
								</form>
							</div>
							<div class="col-lg-6 mb-lg-0 mb-4 mt-lg-0 mt-4">
								<img src="<?= base_url(); ?>assets/images/login/01.png" class="img-fluid w-80" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- Backend Bundle JavaScript -->
	<script src="<?= base_url(); ?>assets/js/backend-bundle.min.js"></script>

	<!-- Flextree Javascript-->
	<script src="<?= base_url(); ?>assets/js/flex-tree.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/tree.js"></script>

	<!-- Table Treeview JavaScript -->
	<script src="<?= base_url(); ?>assets/js/table-treeview.js"></script>

	<!-- Masonary Gallery Javascript -->
	<script src="<?= base_url(); ?>assets/js/masonry.pkgd.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>

	<!-- Mapbox Javascript -->
	<script src="<?= base_url(); ?>assets/js/mapbox-gl.js"></script>
	<script src="<?= base_url(); ?>assets/js/mapbox.js"></script>

	<!-- Fullcalender Javascript -->
	<script src='<?= base_url(); ?>assets/vendor/fullcalendar/core/main.js'></script>
	<script src='<?= base_url(); ?>assets/vendor/fullcalendar/daygrid/main.js'></script>
	<script src='<?= base_url(); ?>assets/vendor/fullcalendar/timegrid/main.js'></script>
	<script src='<?= base_url(); ?>assets/vendor/fullcalendar/list/main.js'></script>

	<!-- SweetAlert JavaScript -->
	<script src="<?= base_url(); ?>assets/js/sweetalert.js"></script>

	<!-- Vectoe Map JavaScript -->
	<script src="<?= base_url(); ?>assets/js/vector-map-custom.js"></script>

	<!-- Chart Custom JavaScript -->
	<script src="<?= base_url(); ?>assets/js/customizer.js"></script>
	<script src="<?= base_url(); ?>assets/js/rtl.js"></script>

	<!-- Chart Custom JavaScript -->
	<script src="<?= base_url(); ?>assets/js/chart-custom.js"></script>

	<!-- slider JavaScript -->
	<script src="<?= base_url(); ?>assets/js/slider.js"></script>

	<!-- app JavaScript -->
	<script src="<?= base_url(); ?>assets/js/app.js"></script>
</body>

</html>
