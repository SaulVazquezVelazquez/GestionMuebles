</div>
<!-- Wrapper End-->
<footer class="iq-footer rtl-footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 ">
				<ul class="list-inline mb-0  rtl-pr-0 rtl-right">
					<li class="list-inline-item "><a href="../backend/privacy-policy.html">Privacy Policy</a></li>
					<li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a></li>
				</ul>
			</div>
			<div class="col-lg-6 text-right ">
				Copyright 2024 <a href="#">NTS DATA</a> All Rights Reserved.
			</div>
		</div>
	</div>
</footer>
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
<script type="text/javascript"> var baseurl = "<?= base_url(); ?>"; </script>
<?php if($this->uri->segment(1)=='cotizador'){ ?>
	<script src="<?= base_url() ?>assets/js/violanti/combos/combos.js"></script>
	<script src="<?= base_url() ?>assets/js/violanti/cotizacion/seleccion-cliente.js"></script>
<?php }else if($this->uri->segment(1)=='cotizacion-items'){?>
	<script src="<?= base_url() ?>assets/js/violanti/cotizacion/cotizacion-items.js"></script>
<?php }else if($this->uri->segment(1)=='cotizacion-items-detalles'){?>
	<script src="<?= base_url() ?>assets/js/violanti/cotizacion/cotizacion-items-detalles.js"></script>
<?php }else if($this->uri->segment(1)=='detalle-cotizacion' || $this->uri->segment(1)=='cotizaciones-pendientes-detalle' ){?>
	<script src="<?= base_url() ?>assets/js/violanti/DetalleCot/detalle-cot.js"></script>
	<?php }else if($this->uri->segment(1)=='cotizaciones-aprobada-detalle'){?>
<script src="<?= base_url() ?>assets/js/violanti/cotizacion/cotizacion-aprobadas-detalle.js"></script>
<script src="<?= base_url() ?>assets/js/violanti/cotizacion/cotizacion-modal-detalle.js"></script>
	<?php }else{?>
<?php }?>

</body>

</html>
