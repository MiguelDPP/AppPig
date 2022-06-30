       <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="<?php echo URL ?>" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                        <!-- <ul aria-expanded="false">
							<li><a href="index.html">Dashboard</a></li>
							<li><a href="page-analytics.html">Analytics</a></li>
							<li><a href="page-review.html">Review</a></li>
							<li><a href="page-order.html">Order</a></li>
							<li><a href="page-order-list.html">Order List</a></li>
							<li><a href="page-general-customers.html">General Customers</a></li>
						</ul> -->
                    </li>
                    <?php
                    if($rol["Nombre"] == "Administrador"){
                        ?>
                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-users"></i>
							<span class="nav-text">Usuarios</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="<?php echo URL ?>sheet/listUsers">Lista de usuarios</a></li>
                                <li><a href="<?php echo URL ?>sheet/create-farm-manager">Crear Jefe de Granja</a></li>
                                <!-- <li><a href="./chart-morris.html">Morris</a></li>
                                <li><a href="./chart-chartjs.html">Chartjs</a></li>
                                <li><a href="./chart-chartist.html">Chartist</a></li>
                                <li><a href="./chart-sparkline.html">Sparkline</a></li>
                                <li><a href="./chart-peity.html">Peity</a></li> -->
                            </ul>
                        </li>
                        <?php } ?>
                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="mdi mdi-pig"></i>
							<span class="nav-text">Cerdos</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="<?php echo URL ?>sheet/Race">Razas</a></li>
                                <li><a href="<?php echo URL ?>sheet/lot">Lotes</a></li>
                                <!-- <li><a href="./chart-morris.html">Morris</a></li>
                                <li><a href="./chart-chartjs.html">Chartjs</a></li>
                                <li><a href="./chart-chartist.html">Chartist</a></li>
                                <li><a href="./chart-sparkline.html">Sparkline</a></li>
                                <li><a href="./chart-peity.html">Peity</a></li> -->
                            </ul>
                        </li>
                        <?php
                    if($rol["Nombre"] == "Administrador"){
                        ?>
                        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="mdi mdi-shopping"></i>
							<span class="nav-text">Compras</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="<?php echo URL ?>sheet/animalRegistry">Animales</a></li>
                                <li><a href="<?php echo URL ?>sheet/food">Alimentos</a></li>
                                <!-- <li><a href="./chart-morris.html">Morris</a></li>
                                <li><a href="./chart-chartjs.html">Chartjs</a></li>
                                <li><a href="./chart-chartist.html">Chartist</a></li>
                                <li><a href="./chart-sparkline.html">Sparkline</a></li>
                                <li><a href="./chart-peity.html">Peity</a></li> -->
                            </ul>
                        </li>
                    <?php } ?>
                    
                    <!-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-internet"></i>
							<span class="nav-text">Bootstrap</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./ui-accordion.html">Accordion</a></li>
                            <li><a href="./ui-alert.html">Alert</a></li>
                            <li><a href="./ui-badge.html">Badge</a></li>
                            <li><a href="./ui-button.html">Button</a></li>
                            <li><a href="./ui-modal.html">Modal</a></li>
                            <li><a href="./ui-button-group.html">Button Group</a></li>
                            <li><a href="./ui-list-group.html">List Group</a></li>
                            <li><a href="./ui-media-object.html">Media Object</a></li>
                            <li><a href="./ui-card.html">Cards</a></li>
                            <li><a href="./ui-carousel.html">Carousel</a></li>
                            <li><a href="./ui-dropdown.html">Dropdown</a></li>
                            <li><a href="./ui-popover.html">Popover</a></li>
                            <li><a href="./ui-progressbar.html">Progressbar</a></li>
                            <li><a href="./ui-tab.html">Tab</a></li>
                            <li><a href="./ui-typography.html">Typography</a></li>
                            <li><a href="./ui-pagination.html">Pagination</a></li>
                            <li><a href="./ui-grid.html">Grid</a></li>

                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-heart"></i>
							<span class="nav-text">Plugins</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./uc-select2.html">Select 2</a></li>
                            <li><a href="./uc-nestable.html">Nestedable</a></li>
                            <li><a href="./uc-noui-slider.html">Noui Slider</a></li>
                            <li><a href="./uc-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="./uc-toastr.html">Toastr</a></li>
                            <li><a href="./map-jqvmap.html">Jqv Map</a></li>
                        </ul>
                    </li>
                    <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-settings-2"></i>
							<span class="nav-text">Widget</span>
						</a>
					</li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notepad"></i>
							<span class="nav-text">Forms</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./form-element.html">Form Elements</a></li>
                            <li><a href="./form-wizard.html">Wizard</a></li>
                            <li><a href="./form-editor-summernote.html">Summernote</a></li>
                            <li><a href="form-pickers.html">Pickers</a></li>
                            <li><a href="form-validation-jquery.html">Jquery Validate</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Table</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                            <li><a href="table-datatable-basic.html">Datatable</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-layer-1"></i>
							<span class="nav-text">Pages</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="./page-register.html">Register</a></li>
                            <li><a href="./page-login.html">Login</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                                <ul aria-expanded="false">
                                    <li><a href="./page-error-400.html">Error 400</a></li>
                                    <li><a href="./page-error-403.html">Error 403</a></li>
                                    <li><a href="./page-error-404.html">Error 404</a></li>
                                    <li><a href="./page-error-500.html">Error 500</a></li>
                                    <li><a href="./page-error-503.html">Error 503</a></li>
                                </ul>
                            </li>
                            <li><a href="./page-lock-screen.html">Lock Screen</a></li>
                        </ul>
                    </li> -->
                </ul>
            
				<!-- <div class="copyright">
					<p><strong>AppPig - Criadero de puercos</strong> © 2022 todos los derechos reservados</p>
					
				</div> -->
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->