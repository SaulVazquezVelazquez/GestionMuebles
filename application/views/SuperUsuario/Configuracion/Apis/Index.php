<div class="content-page rtl-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Inicio de Sesión - Login</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Servicio "Login", el cual se hace conexion a SAP Hana
							es necesario realizar el login para poder hacer peticiones de los otros
							servicios.
						</p>
						<form action="<?= base_url()?>login-sap">
							<button type="submit" class="btn btn-primary mt-2" id="btn_sinc_login">Sincronizar</button>
						</form>
						<div class="alert alert-success display-none" role="alert" id="mns_login">
							<div class="iq-alert-text">Estamos sincronizando por favor espere... Gracias</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Cerrar Sesión - Logout</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Servicio "Logout", se sincronizara una ves se termine de realizar
							las peticiones a los distintos servicios de SAP, es importante cerrar sesion cuando
							terminesmos.
						</p>
						<button type="button" class="btn btn-danger">Sincronizar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Items</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Sincronizamos los ITEMS que se encuentran en SAP</p>
						<div class="row">
							<div class="col-sm-3 col-lg-6">
								<form action="<?= base_url()?>sap-item-get-registros">
									<button type="submit" class="btn btn-outline-success mt-2"
										id="btn_sinc_producto">Sincronizar Productos</button>
								</form>
							</div>
							<div class="col-sm-3 col-lg-6">
								<form action="<?= base_url()?>sap-item-get-precio-costo">
									<button type="submit" class="btn btn-outline-success mt-2"
										id="btn_sinc_precio_costo">Sincronizar Precio Costo</button>
								</form>
							</div>
							<div class="alert alert-success display-none" role="alert" id="mns_items_producto">
								<div class="iq-alert-text">Estamos sincronizando por favor espere... Gracias</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">ItemGroups</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Sincronización de la lista de precios de los Items</p>
						<form action="<?= base_url()?>sap-item-oitb-get-registros">
							<button type="submit" class="btn btn-outline-success mt-2" id="btn_sinc_oitb">Sincronizar</button>
						</form>
						<div class="alert alert-success display-none" role="alert" id="msn_item-group">
							<div class="iq-alert-text">Estamos sincronizando por favor espere... Gracias</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">ProductTrees</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Sincronizamos del arbol de productos</p>
						<form action="<?= base_url()?>sap-item-ittm-get-registros">
							<button type="submit" class="btn btn-outline-success mt-2" id="btn_item-three">Sincronizar</button>
						</form>
						<div class="alert alert-success display-none" role="alert" id="msn_item-three">
							<div class="iq-alert-text">Estamos sincronizando por favor espere... Gracias</div>
						</div>
					</div>
				</div>
			</div>
		</div>


        <div class="row">
			<div class="col-sm-12 col-lg-4">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Business Partners</h4>
						</div>
					</div>
					<div class="card-body">
						<p class="mb-2">Sincronizamos los Clientes de SAP</p>
						<form action="<?= base_url()?>sap-clientes">
							<button type="submit" class="btn btn-outline-success mt-2" id="btn_business_partner">Sincronizar</button>
						</form>
						<div class="alert alert-success display-none" role="alert" id="msn_business_partner">
							<div class="iq-alert-text">Estamos sincronizando por favor espere... Gracias</div>
						</div>
					</div>
				</div>
			</div>
		</div>





























	</div>
</div>
