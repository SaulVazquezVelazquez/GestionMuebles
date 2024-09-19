<body class="  ">
	<!-- loader Start -->
	<div id="loading">
		<div id="loading-center">
		</div>
	</div>
	<!-- loader END -->
	<!-- Wrapper Start -->
	<div class="wrapper">

		<div class="iq-sidebar  rtl-iq-sidebar sidebar-default ">
			<div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
				<a href="index.html" class="header-logo">
					<img src="<?= base_url(); ?>assets/images/logo.png" class="img-fluid rounded-normal light-logo"
						alt="logo">
					<img src="<?= base_url(); ?>assets/images/logo-white.png"
						class="img-fluid rounded-normal darkmode-logo" alt="logo">
				</a>
				<div class="iq-menu-bt-sidebar">
					<i class="las la-bars wrapper-menu"></i>
				</div>
			</div>
			<div class="data-scrollbar" data-scroll="1">
				<nav class="iq-sidebar-menu">
					<ul id="iq-sidebar-toggle" class="iq-menu">
						<li>
							<a href="../backend/index.html">
								<i class="las la-chart-bar"></i><span>Inicio</span>
							</a>
						</li>
						<li class=" ">
							<a href="#validaciones" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-clipboard-check"></i><span>Validaciones</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="validaciones" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/widget-simple.html">
										<i class="las la-clipboard-list"></i><span>Revisadas</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</nav>
				<!--<div id="sidebar-bottom" class="position-relative sidebar-bottom">
					<div class="card bg-primary rounded">
						<div class="card-body">
							<div class="sidebarbottom-content">
								<div class="image"><img src="<?= base_url(); ?>assets/images/layouts/side-bkg.png"
										class="img-fluid" alt="side-bkg"></div>
								<h5 class="mb-3 text-white mt-3">Did you Know ?</h5>
								<p class="mb-0 text-white">You can add additional user in your Account's Settings</p>
								<button type="button" class="btn bg-light  mt-3"><i class="fas fa-plus-square"></i> New
									Program</button>
							</div>
						</div>
					</div>
				</div>-->
				<div class="p-3"></div>
			</div>
		</div>
		<div class="iq-top-navbar rtl-iq-top-navbar ">
			<div class="iq-navbar-custom">
				<nav class="navbar navbar-expand-lg navbar-light p-0">
					<div class="iq-navbar-logo d-flex align-items-center justify-content-between">
						<i class="ri-menu-line wrapper-menu"></i>
						<a href="index.html" class="header-logo">
							<img src="<?= base_url(); ?>assets/images/logo.png"
								class="img-fluid rounded-normal light-logo" alt="logo">
							<img src="<?= base_url(); ?>assets/images/logo-white.png"
								class="img-fluid rounded-normal darkmode-logo" alt="logo">

						</a>
					</div>
					<div class="iq-search-bar device-search">
						<form action="#" class="searchbox">
							<a class="search-link" href="#"><i class="ri-search-line"></i></a>
							<input type="text" class="text search-input"
								placeholder="" disabled>
						</form>
					</div>
					<div class="d-flex align-items-center">

						<button class="navbar-toggler" type="button" data-toggle="collapse"
							data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
							aria-label="Toggle navigation">
							<i class="ri-menu-3-line"></i>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto navbar-list align-items-center">
								<li class="nav-item nav-icon search-content">
									<a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
										aria-haspopup="true" aria-expanded="false">
										<i class="ri-search-line"></i>
									</a>
									<div class="iq-search-bar iq-sub-dropdown dropdown-menu"
										aria-labelledby="dropdownSearch">
										<form action="#" class="searchbox p-2">
											<div class="form-group mb-0 position-relative">
												<input type="text" class="text search-input font-size-12"
													placeholder="type here to search...">
												<a href="#" class="search-link"><i class="las la-search"></i></a>
											</div>
										</form>
									</div>
								</li>
								<!--<li class="nav-item nav-icon dropdown">
									<a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="ri-mail-line  bg-orange p-2 rounded-small"></i>
										<span class="bg-primary"></span>
									</a>
									<div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
										<div class="card shadow-none m-0">
											<div class="card-body p-0 ">
												<div class="cust-title p-3">
													<h5 class="mb-0">All Messages</h5>
												</div>
												<div class="p-3">
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/01.jpg"
																	alt="01">
															</div>
															<div class="media-body ml-3 rtl-mr-3 rtl-ml-0">
																<h6 class="mb-0">Barry Emma Watson <small
																		class="badge badge-success float-right rtl-mr-1">New</small>
																</h6>
																<small class="float-left font-size-12">12:00 PM</small>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/02.jpg"
																	alt="02">
															</div>
															<div class="media-body ml-3 rtl-ml-0 rtl-mr-3">
																<h6 class="mb-0 ">Lorem Ipsum Watson</h6>
																<small class="float-left font-size-12">20 Apr</small>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/03.jpg"
																	alt="03">
															</div>
															<div class="media-body ml-3 rtl-mr-3 rtl-ml-0">
																<h6 class="mb-0 ">Why do we use it? <small
																		class="badge badge-success float-right rtl-mr-1">New</small>
																</h6>
																<small class="float-left font-size-12">1:24 PM</small>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/04.jpg"
																	alt="04">
															</div>
															<div class="media-body ml-3 rtl-ml-0 rtl-mr-3">
																<h6 class="mb-0">Variations Passages <small
																		class="badge badge-success float-right rtl-mr-1">New</small>
																</h6>
																<small class="float-left font-size-12">5:45 PM</small>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/05.jpg"
																	alt="05">
															</div>
															<div class="media-body ml-3 rtl-mr-3 rtl-ml-0">
																<h6 class="mb-0 ">Lorem Ipsum generators</h6>
																<small class="float-left font-size-12">1 day ago</small>
															</div>
														</div>
													</a>
												</div>
												<a class="right-ic btn btn-primary btn-block position-relative p-2"
													href="#" role="button">
													<div class="dd-icon"><i class="las la-arrow-right mr-0"></i></div>
													View All
												</a>
											</div>
										</div>
									</div>
								</li>
								<li class="nav-item nav-icon dropdown">
									<a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="ri-notification-line bg-info p-2 rounded-small"></i>
										<span class="bg-primary "></span>
									</a>
									<div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
										<div class="card shadow-none m-0">
											<div class="card-body p-0 ">
												<div class="cust-title p-3">
													<h5 class="mb-0">All Notifications</h5>
												</div>
												<div class="p-3">
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/01.jpg"
																	alt="01">
															</div>
															<div class="media-body ml-3 rtl-ml-0 rtl-mr-3">
																<h6 class="mb-0">Emma Watson Barry <small
																		class="badge badge-success float-right rtl-mr-1">New</small>
																</h6>
																<p class="mb-0">95 MB</p>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/02.jpg"
																	alt="02">
															</div>
															<div class="media-body ml-3 rtl-mr-3 rtl-ml-0">
																<h6 class="mb-0 ">New customer is join</h6>
																<p class="mb-0 ">Cyst Barry</p>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/03.jpg"
																	alt="03">
															</div>
															<div class="media-body ml-3 rtl-ml-0 rtl-mr-3">
																<h6 class="mb-0 ">Two customer is left</h6>
																<p class="mb-0">Cyst Barry</p>
															</div>
														</div>
													</a>
													<a href="#" class="iq-sub-card">
														<div class="media align-items-center">
															<div class="">
																<img class="avatar-40 rounded-small"
																	src="<?= base_url(); ?>assets/images/user/04.jpg"
																	alt="04">
															</div>
															<div class="media-body ml-3 rtl-mr-3 rtl-ml-0">
																<h6 class="mb-0 ">New Mail from Fenny <small
																		class="badge badge-success float-right">New</small>
																</h6>
																<p class="mb-0">Cyst Barry</p>
															</div>
														</div>
													</a>
												</div>
												<a class="right-ic btn btn-primary btn-block position-relative p-2"
													href="#" role="button">
													<div class="dd-icon"><i class="las la-arrow-right mr-0"></i></div>
													View All
												</a>
											</div>
										</div>
									</div>
								</li>
								<li class="nav-item iq-full-screen"><a href="#" class="" id="btnFullscreen"><i
											class="ri-fullscreen-line"></i></a>
								</li>-->
								<li class="caption-content">
									<a href="#" class="iq-user-toggle">
										<img src="<?= base_url(); ?>assets/images/user/1.png" class="img-fluid rounded"
											alt="user">
									</a>
									<div class="iq-user-dropdown">
										<div class="card">
											<div
												class="card-header d-flex justify-content-between align-items-center mb-0">
												<div class="header-title">
													<h4 class="card-title mb-0">Perfil</h4>
												</div>
												<div class="close-data text-right badge badge-primary cursor-pointer"><i
														class="ri-close-fill"></i></div>
											</div>
											<div class="data-scrollbar" data-scroll="2">
												<div class="card-body">
													<div class="profile-header">
														<div class="cover-container ">
															<div class="media align-items-center mb-4">
																<img src="<?= base_url(); ?>assets/images/user/1.png"
																	alt="profile-bg"
																	class="rounded img-fluid avatar-80">
																<div
																	class="media-body profile-detail ml-3 rtl-mr-3 rtl-ml-0">
																	<h3><?= $this->session->userdata('s_primer_nombre'); ?>
																	</h3>
																	<div class="d-flex flex-wrap">
																		<p class="mb-1">
																			<?= $this->session->userdata('s_apellidos'); ?>
																		</p><a href="<?= base_url(); ?>cerrar-sesion"
																			class=" ml-3 rtl-mr-3 rtl-ml-0">Salir</a>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-12 col-md-12  col-12 pr-0">
																<div class="profile-details text-center">
																	<a href="../app/user-profile.html"
																		class="iq-sub-card bg-primary-light rounded-small p-2">
																		<div class="rounded iq-card-icon-small">
																			<i class="ri-file-user-line"></i>
																		</div>
																		<h6 class="mb-0 ">Mi perfil</h6>
																	</a>
																</div>
															</div>
														</div>
														<div class="personal-details">
															<h5 class="card-title mb-3 mt-3">Detalles del perfil</h5>
															<div class="row align-items-center mb-2">
																<div class="col-sm-12">
																	<h6>Usuario:</h6>
																</div>
																<div class="col-sm-12">
																	<p class="mb-0"><?= $this->session->userdata('s_usuario'); ?></p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-12">
																	<h6>Perfil:</h6>
																</div>
																<div class="col-sm-12">
																	<p class="mb-0"><?= $this->session->userdata('s_rol'); ?></p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-12">
																	<h6>Departamento:</h6>
																</div>
																<div class="col-sm-12">
																	<p class="mb-0"><?= $this->session->userdata('s_departamento'); ?></p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-12">
																	<h6>Planta:</h6>
																</div>
																<div class="col-sm-12">
																	<p class="mb-0"><?= $this->session->userdata('s_planta'); ?></p>
																</div>
															</div>
														</div>
													</div>
													<div class="p-3"></div>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
