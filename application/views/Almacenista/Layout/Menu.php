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
						<!--<li class=" ">
							<a href="#Dashboards" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-home"></i><span>Dashboards</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="Dashboards" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class="active">
									<a href="../backend/index.html">
										<i class="lab la-blogger-b"></i><span>Dashboard 1</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/dashboard-2.html">
										<i class="las la-share-alt"></i><span>Dashboard 2</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/dashboard-3.html">
										<i class="las la-icons"></i><span>Dashboard 3</span>
									</a>
								</li>
							</ul>
						</li> -->
						<li class=" ">
							<a href="#reportes" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <i class="las la-poll"></i><span>Reportes</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="reportes" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="<?= base_url();?>reporte-inventario">
                                        <i class="las la-boxes"></i><span>Inventario</span>
									</a>
								</li>
							</ul>
						</li>
						<!--<li class=" ">
							<a href="#widget" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-chart-pie iq-arrow-left"></i><span>Widget</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="widget" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/widget-simple.html">
										<i class="las la-tools"></i><span>widget simple</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/widget-chart.html">
										<i class="las la-toolbox"></i><span>widget chart</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="lab la-uikit iq-arrow-left"></i><span>UI Elements</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="ui" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/ui-avatars.html">
										<i class="las la-user-tie"></i><span>Avatars</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-alerts.html">
										<i class="las la-exclamation-triangle"></i><span>Alerts</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-badges.html">
										<i class="las la-id-badge"></i><span>Badges</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-breadcrumb.html">
										<i class="las la-ellipsis-h"></i><span>Breadcrumb</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-buttons.html">
										<i class="las la-ticket-alt"></i><span>Buttons</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-buttons-group.html">
										<i class="las la-object-group"></i><span>Buttons Group</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-boxshadow.html">
										<i class="las la-boxes"></i><span>Box Shadow</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-colors.html">
										<i class="las la-brush"></i><span>Colors</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-cards.html">
										<i class="las la-credit-card"></i><span>Cards</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-carousel.html">
										<i class="las la-sliders-h"></i><span>Carousel</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-grid.html">
										<i class="las la-th-large"></i><span>Grid</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-helper-classes.html">
										<i class="las la-hands-helping"></i><span>Helper classes</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-images.html">
										<i class="las la-image"></i><span>Images</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-list-group.html">
										<i class="las la-list-alt"></i><span>list Group</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-media-object.html">
										<i class="las la-photo-video"></i><span>Media</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-modal.html">
										<i class="las la-columns"></i><span>Modal</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-notifications.html">
										<i class="las la-bell"></i><span>Notifications</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-pagination.html">
										<i class="las la-ellipsis-h"></i><span>Pagination</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-popovers.html">
										<i class="las la-spinner"></i><span>Popovers</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-progressbars.html">
										<i class="las la-heading"></i><span>Progressbars</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-typography.html">
										<i class="las la-tablet"></i><span>Typography</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-tabs.html">
										<i class="las la-tablet"></i><span>Tabs</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-tooltips.html">
										<i class="las la-magnet"></i><span>Tooltips</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/ui-embed-video.html">
										<i class="las la-play-circle"></i><span>Video</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#plugin" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-network-wired iq-arrow-left"></i><span>Plugins</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="plugin" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/plugin-rating.html">
										<i class="las la-smile"></i><span>Rating</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/plugin-tree-view.html">
										<i class="las la-seedling"></i><span>Treeview</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/plugin-sweetalert.html">
										<i class="las la-cookie"></i><span>Sweetalert</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/plugin-loader.html">
										<i class="las la-redo-alt"></i><span>Loader</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/plugin-image-crop.html">
										<i class="las la-crop-alt"></i><span>Image Croper</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#form" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="lab la-wpforms iq-arrow-left"></i><span>Forms</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="form" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="#form-controls" class="collapsed" data-toggle="collapse"
										aria-expanded="false">
										<i class="lab la-wpforms"></i><span>Form Controls</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="form-controls" class="iq-submenu collapse" data-parent="#form">
										<li class=" ">
											<a href="../backend/form-layout.html">
												<i class="las la-book"></i><span>Form Elements</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-input-group.html">
												<i class="las la-keyboard"></i><span>Form Input</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-validation.html">
												<i class="las la-edit"></i><span>Form Validation</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-switch.html">
												<i class="las la-toggle-off"></i><span>Form Switch</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-chechbox.html">
												<i class="las la-check-square"></i><span>Form Checkbox</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-radio.html">
												<i class="las la-yin-yang"></i><span>Form Radio</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-textarea.html">
												<i class="las la-text-height"></i><span>Form Textarea</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="#form-widget" class="collapsed" data-toggle="collapse"
										aria-expanded="false">
										<i class="lab la-elementor"></i><span>Form Widget</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="form-widget" class="iq-submenu collapse" data-parent="#form">
										<li class=" ">
											<a href="../backend/form-datepicker.html">
												<i class="las la-calendar"></i><span>Datepicker</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-select.html">
												<i class="las la-object-group"></i><span>Select2</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-file-uploader.html">
												<i class="las la-cloud-download-alt"></i><span>File Upload</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-quill.html">
												<i class="las la-text-height"></i><span>Form quill</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="#form-wizard" class="collapsed" data-toggle="collapse"
										aria-expanded="false">
										<i class="las la-archive"></i><span>Forms Wizard</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="form-wizard" class="iq-submenu collapse" data-parent="#form">
										<li class=" ">
											<a href="../backend/form-wizard.html">
												<i class="las la-box"></i><span>Simple Wizard</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-wizard-validate.html">
												<i class="las la-inbox"></i><span>Validate Wizard</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/form-wizard-vertical.html">
												<i class="las la-file-archive"></i><span>Vertical Wizard</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#table" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-table iq-arrow-left"></i><span>Table</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="table" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/tables-basic.html">
										<i class="las la-border-all"></i><span>Basic Tables</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/table-data.html">
										<i class="lab la-microsoft"></i><span>Data Table</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/table-editable.html">
										<i class="lab la-buromobelexperte"></i><span>Editable Table</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/table-tree.html">
										<i class="las la-tree"></i><span>Table Tree</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#icon" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-list iq-arrow-left"></i><span>Icons</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="icon" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/icon-dripicons.html">
										<i class="las la-layer-group"></i><span>Dripicons</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/icon-fontawesome.html">
										<i class="lab la-facebook-f"></i><span>Font Awesome</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/icon-lineawesome.html">
										<i class="las la-grip-lines-vertical"></i><span>Line Awesome</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/icon-remixicon.html">
										<i class="lab la-creative-commons-remix"></i><span>Remixicon</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#gallery" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-images iq-arrow-left"></i><span>Gallery</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="gallery" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/gallery-grid.html">
										<i class="las la-icons"></i><span>Gallery Grid</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/gallery-grid-desc.html">
										<i class="las la-file-image"></i><span>Gallery Grid Desc</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/gallery-masonry.html">
										<i class="las la-film"></i><span>Masonry Gallery</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/gallery-masonry-desc.html">
										<i class="las la-stream"></i><span>Masonry with Desc</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/gallery-hover-effect.html">
										<i class="las la-wallet"></i><span>Hover Effects</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#blog" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-blog iq-arrow-left"></i><span>Blog</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="blog" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/blog-simple.html">
										<i class="las la-boxes"></i><span>Simple Blog</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/blog-grid.html">
										<i class="las la-border-all"></i><span>Blog Grid</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/blog-list.html">
										<i class="las la-tasks"></i><span>Blog List</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/blog-detail.html">
										<i class="las la-scroll"></i><span>Blog Details</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#chart" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-chart-bar iq-arrow-left"></i><span>Charts</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="chart" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/chart-apex.html">
										<i class="las la-chart-area"></i><span>Apex Chart</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/chart-am.html">
										<i class="las la-project-diagram"></i><span>Am Chart</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/chart-morries.html">
										<i class="las la-chart-pie"></i><span>Morrish chart</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/chart-high.html">
										<i class="las la-chart-line"></i><span>High chart</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#map" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-map-marked iq-arrow-left"></i><span>Map</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="map" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/map-google.html">
										<i class="las la-map-marked-alt"></i><span>Google Map</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/map-vector.html">
										<i class="las la-globe-africa"></i><span>Vector Map</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-torah iq-arrow-left"></i><span>Authentication</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="auth" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="../backend/auth-sign-in.html">
										<i class="las la-sign-in-alt"></i><span>Login</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/auth-sign-up.html">
										<i class="las la-registered"></i><span>Register</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/auth-recoverpw.html">
										<i class="las la-unlock-alt"></i><span>Recover Password</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/auth-confirm-mail.html">
										<i class="las la-envelope-square"></i><span>Confirm Mail</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/auth-lock-screen.html">
										<i class="las la-lock"></i><span>Lock Screen</span>
									</a>
								</li>
							</ul>
						</li>
						<li class=" ">
							<a href="#pages" class="collapsed" data-toggle="collapse" aria-expanded="false">
								<i class="las la-book-reader iq-arrow-left"></i><span>Extra Pages</span>
								<i class="las la-angle-right iq-arrow-right arrow-active"></i>
								<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
							</a>
							<ul id="pages" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
								<li class=" ">
									<a href="#contact" class="collapsed" data-toggle="collapse" aria-expanded="false">
										<i class="las la-id-card"></i><span>Contact</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="contact" class="iq-submenu collapse" data-parent="#pages">
										<li class=" ">
											<a href="../backend/contact-list.html">
												<i class="las la-file-alt"></i><span>Contact List</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/contact-detail.html">
												<i class="las la-address-card"></i><span>Contact Details</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="#timeline" class="collapsed" data-toggle="collapse" aria-expanded="false">
										<i class="las la-stream"></i><span>Timeline</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="timeline" class="iq-submenu collapse" data-parent="#pages">
										<li class=" ">
											<a href="../backend/timeline.html">
												<i class="las la-circle-notch"></i><span>Timeline 1</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/timeline-1.html">
												<i class="las la-compact-disc"></i><span>Timeline 2</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/timeline-2.html">
												<i class="las la-cog"></i><span>Timeline 3</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/timeline-3.html">
												<i class="las la-snowflake"></i><span>Timeline 4</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="#pricing" class="collapsed" data-toggle="collapse" aria-expanded="false">
										<i class="las la-coins"></i><span>Pricing</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="pricing" class="iq-submenu collapse" data-parent="#pages">
										<li class=" ">
											<a href="../backend/pricing.html">
												<i class="las la-weight"></i><span>Pricing 1</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/pricing-1.html">
												<i class="las la-crutch"></i><span>Pricing 2</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/pricing-2.html">
												<i class="las la-tablets"></i><span>Pricing 3</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/pricing-3.html">
												<i class="las la-dna"></i><span>Pricing 4</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="#pages-error" class="collapsed" data-toggle="collapse"
										aria-expanded="false">
										<i class="las la-exclamation-triangle"></i><span>Error</span>
										<i class="las la-angle-right iq-arrow-right arrow-active"></i>
										<i class="las la-angle-down iq-arrow-right arrow-hover"></i>
									</a>
									<ul id="pages-error" class="iq-submenu collapse" data-parent="#pages">
										<li class=" ">
											<a href="../backend/pages-error.html">
												<i class="las la-bomb"></i><span>Error 404</span>
											</a>
										</li>
										<li class=" ">
											<a href="../backend/pages-error-500.html">
												<i class="las la-exclamation-circle"></i><span>Error 500</span>
											</a>
										</li>
									</ul>
								</li>
								<li class=" ">
									<a href="../backend/pages-invoice.html">
										<i class="las la-receipt"></i><span>Invoice</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/pages-subscribers.html">
										<i class="las la-sort"></i><span>Subscribers</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/pages-faq.html">
										<i class="las la-drafting-compass"></i><span>Faq</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/pages-blank-page.html">
										<i class="las la-pager"></i><span>Blank Page</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/pages-maintenance.html">
										<i class="las la-cubes"></i><span>Maintenance</span>
									</a>
								</li>
								<li class=" ">
									<a href="../backend/pages-comingsoon.html">
										<i class="las la-assistive-listening-systems"></i><span>Coming Soon</span>
									</a>
								</li>
							</ul>
						</li>-->
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
							<input type="text" class="text search-input" placeholder="Search here...">
						</form>
					</div>
					<div class="d-flex align-items-center">
						<div class="change-mode">
							<div class="custom-control custom-switch custom-switch-icon custom-control-inline">
								<div class="custom-switch-inner">
									<p class="mb-0"> </p>
									<input type="checkbox" class="custom-control-input" id="dark-mode"
										data-active="true">
									<label class="custom-control-label" for="dark-mode" data-mode="toggle">
										<span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
										<span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
									</label>
								</div>
							</div>
						</div>
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
								<li class="nav-item nav-icon dropdown">
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
											class="ri-fullscreen-line"></i></a></li>
								<li class="caption-content">
									<a href="#" class="iq-user-toggle">
										<img src="<?= base_url(); ?>assets/images/user/1.jpg" class="img-fluid rounded"
											alt="user">
									</a>
									<div class="iq-user-dropdown">
										<div class="card">
											<div
												class="card-header d-flex justify-content-between align-items-center mb-0">
												<div class="header-title">
													<h4 class="card-title mb-0">Profile</h4>
												</div>
												<div class="close-data text-right badge badge-primary cursor-pointer"><i
														class="ri-close-fill"></i></div>
											</div>
											<div class="data-scrollbar" data-scroll="2">
												<div class="card-body">
													<div class="profile-header">
														<div class="cover-container ">
															<div class="media align-items-center mb-4">
																<img src="<?= base_url(); ?>assets/images/user/1.jpg"
																	alt="profile-bg"
																	class="rounded img-fluid avatar-80">
																<div
																	class="media-body profile-detail ml-3 rtl-mr-3 rtl-ml-0">
																	<h3>Bill Yerds</h3>
																	<div class="d-flex flex-wrap">
																		<p class="mb-1">Web designer</p><a
																			href="auth-sign-in.html"
																			class=" ml-3 rtl-mr-3 rtl-ml-0">Sign Out</a>
																	</div>
																</div>
															</div>

														</div>
														<div class="row">
															<div class="col-lg-6 col-md-6  col-6 pr-0">
																<div class="profile-details text-center">
																	<a href="../app/user-profile.html"
																		class="iq-sub-card bg-primary-light rounded-small p-2">
																		<div class="rounded iq-card-icon-small">
																			<i class="ri-file-user-line"></i>
																		</div>
																		<h6 class="mb-0 ">My Profile</h6>
																	</a>
																</div>
															</div>
															<div class="col-lg-6  col-md-6 col-6">
																<div class="profile-details text-center">
																	<a href="../app/user-profile-edit.html"
																		class="iq-sub-card bg-danger-light rounded-small p-2">
																		<div class="rounded iq-card-icon-small">
																			<i class="ri-profile-line"></i>
																		</div>
																		<h6 class="mb-0 ">Edit Profile</h6>
																	</a>
																</div>
															</div>
															<div class="col-lg-6 col-md-6  col-6 pr-0">
																<div class="profile-details text-center">
																	<a href="../app/user-account-setting.html"
																		class="iq-sub-card bg-success-light rounded-small p-2">
																		<div class="rounded iq-card-icon-small">
																			<i class="ri-account-box-line"></i>
																		</div>
																		<h6 class="mb-0 ">Account</h6>
																	</a>
																</div>
															</div>
															<div class="col-lg-6 col-md-6  col-6">
																<div class="profile-details text-center">
																	<a href="../app/user-privacy-setting.html"
																		class="iq-sub-card bg-info-light rounded-small p-2">
																		<div class="rounded iq-card-icon-small">
																			<i class="ri-lock-line"></i>
																		</div>
																		<h6 class="mb-0 ">Settings</h6>
																	</a>
																</div>
															</div>
														</div>
														<div class="personal-details">
															<h5 class="card-title mb-3 mt-3">Personal Details</h5>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Birthday</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">3rd March</p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Address</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">Landon</p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Phone</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">(010)987 543 201</p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Email</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">Barry@example.com</p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Twitter</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">@Barry</p>
																</div>
															</div>
															<div class="row align-items-center mb-2">
																<div class="col-sm-6">
																	<h6>Facebook</h6>
																</div>
																<div class="col-sm-6">
																	<p class="mb-0">@Barry_Tech</p>
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
