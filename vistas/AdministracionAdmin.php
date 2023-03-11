<?php
session_start();
// IMPORTANDO MODELO CONTROLADOR DE CONTEOS 
require '../modelos/mConteosInterfaces.php';
// NO PERMITIR ACCESO NO LOGUEADO
if(!isset($_GET['acc']))
{
    header('location:../controlador/ControlLogin.php?acc=1');
}
if(!isset($_SESSION['vsCodigo']))
{
    header('location:../controlador/ControlLogin.php?acc=1');    
}
// NO PERMITIR ACCESO OTRO ROL DIFERENTE DE USUARIO AL ACCEDIDO
if($_SESSION['vsTipo']== 'Estudiante'){
    header('location:../vistas/usuarios/PrincipalUsuarios.php?acc=1');
}
// SESION CADUCA DESPUES DE 5 MINUTOS
$tiempo_inactividad = 300; // 5 minutos de inactividad

if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad'] > $tiempo_inactividad)) {
    // Si ha pasado el tiempo de inactividad, destruir la sesión y redirigir al usuario
    header("Location: Logout.php");
}

// Registrar la hora actual como última actividad
$_SESSION['ultima_actividad'] = time();
?>
<!DOCTYPE html>
<html lang="ES-SV">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sistema de Gestion UCEM</title>
    <meta name="description" content="Sistema Gesti&oacute;n de Casos vtiger CRM Espa&ntilde;ol" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../vistas/dist/img/favicon.ico">
    <link rel="icon" href="../vistas/dist/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="../vistas/dist/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../vistas/dist/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../vistas/dist/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../vistas/dist/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../vistas/dist/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../vistas/dist/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../vistas/dist/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../vistas/dist/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../vistas/dist/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../vistas/dist/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vistas/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../vistas/dist/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vistas/dist/img/favicon-16x16.png">
    <link rel="manifest" href="../vistas/dist/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../vistas/dist/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
	<!-- vector map CSS -->
    <link href="../vistas/vendors/vectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" type="text/css" />
	<link href="../vistas/vendors/apexcharts/dist/apexcharts.css" rel="stylesheet" type="text/css" />
    <!-- Toggles CSS -->
    <link href="../vistas/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../vistas/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
	<!-- Toastr CSS -->
    <link href="../vistas/vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="../vistas/dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar shadow-lg shadow-hover-xl">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand font-weight-700" href="../vistas/AdministracionAdmin.php?acc=1">
                UCEM
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <!-- BUSCADOR 
                <li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li> -->
                <!-- SESION ACTIVA -->
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="../vistas/dist/fotosperfiles/<?php echo $_SESSION['vsFotosPerfilesUs'] ?>" alt="FotoPerfil" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span><?php echo $_SESSION['vsNombre']; echo " "; echo $_SESSION['vsApellidos']; ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <!-- AJUSTES PERFIL -->
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Activo Ahora</a>
                        </div>
                        <a class="dropdown-item" href="../controlador/cUsuariosAdministradores.php?acc=7"><i class="dropdown-icon zmdi zmdi-account"></i><span>Mi Perfil</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../controlador/cUsuariosAdministradores.php?acc=8"><i class="dropdown-icon zmdi zmdi-power"></i><span>Cerrar sesión</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- MENU DE NAVEGACION -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">


                        <!-- INICIO -->
                        <li class="nav-item active">
                            <a class="nav-link" href="../vistas/AdministracionAdmin.php?acc=1" data-target="#Home">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Inicio</span>
                            </a>
                        </li>


                        <!-- USUARIOS ADMINISTRADORES -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#UsuariosAdministradores">
                                <span class="feather-icon"><i data-feather="user-plus"></i></span>
                                <span class="nav-link-text">Administradores</span>
                            </a>
                            <ul id="UsuariosAdministradores" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministradores.php?acc=2">Registrar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministradores.php?acc=4">Gestionar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministradores.php?acc=1">Consultar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministradores.php?acc=5">Exportar Usuarios</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- USUARIOS PLATAFORMA -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#UsuariosClientes">
                                <span class="feather-icon"><i data-feather="user-check"></i></span>
                                <span class="nav-link-text">Usuarios</span>
                            </a>
                            <ul id="UsuariosClientes" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministrativos.php?acc=2">Registrar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministrativos.php?acc=4">Gestionar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministrativos.php?acc=1">Consultar Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../controlador/cUsuariosAdministrativos.php?acc=5">Exportar Usuarios</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- CASOS CLIENTES -->
                        


                        <!-- CLIENTES -->
                        

                        <!-- CIUDADES -->
                        

                        <!-- PRODUCTOS -->
                        

                        <!-- MARCAS PRODUCTOS -->
                        

                        <!-- SUCURSALES -->
                        


                        <!-- VENDEDORES -->
                        
                        
                        <!-- VENTAS -->
                        

                        <!-- EMPLEADOS -->
                        

                        <!-- EMPRESA -->
                        


                        <!-- LINEAS -->
                        



                        <!-- REPORTES PROBLEMAS PLATAFORMA -->
                        

                    </ul>
                    
                    
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    <hr>
                    
                    <h6 class="mb-5">Ajustes de Preferencias</h6>
                    <p class="font-14">Men&uacute; de Navegaci&oacute;n</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Modo D&iacute;a</span></button>
                        <button type="button" id="nav_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo Noche</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Seleccione modo de header / contenido superior</h6>
                    <p class="font-14">Seleccione su preferencia</p>
                    <div class="button-list hk-navbar-select mb-10">
                        <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Modo D&iacute;a</span></button>
                        <button type="button" id="navtop_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo Noche</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Agregar Scroll Men&uacute; de Navegaci&oacute;n</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                    </div>
                    <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reiniciar Ajustes</button>
                </div>
            </div>
            <img class="d-none" src="../vistas/dist/img/logo-light.png" alt="brand" />
            <img class="d-none" src="../vistas/dist/img/logo-dark.png" alt="brand" />
        </div>
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
						<div class="hk-row">
							<div class="col-lg-12">
								
								<div class="hk-row">							
									<div class="col-sm-6">
										<div class="card card-sm">
											<div class="card-body">
												<div class="d-flex justify-content-between mb-5">
													<div>
														<span class="d-block font-15 text-dark font-weight-500">Numero de Usuarios Registrados UCEM</span>
													</div>
													<div>
                                                        <!-- PORCENTAJE -->
														<span class="badge badge-primary  badge-sm"></span>
													</div>
												</div>
												<div>
													<span class="d-block display-5 text-dark mb-5"><?php echo NumeroUsuariosRegistrados($cnn1); ?></span>
													<small class="d-block">Usuarios Registrados</small>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card card-sm">
											<div class="card-body">
												<div class="d-flex justify-content-between mb-5">
													<div>
														<span class="d-block font-15 text-dark font-weight-500">N&uacute;mero de Empleados</span>
													</div>
													<div>
                                                        <!-- PORCENTAJE -->
														<span class="badge badge-danger   badge-sm"></span>
													</div>
												</div>
												<div>
													<span class="d-block display-5 text-dark mb-5"><?php echo NumeroEmpleadosRegistrados($cnn2); ?></span>
													<small class="d-block">Empleados Registrados</small>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card card-sm">
											<div class="card-body">
												<div class="d-flex justify-content-between mb-5">
													<div>
														<span class="d-block font-15 text-dark font-weight-500">Casos Clientes</span>
													</div>
													<div>
                                                        <!-- PORCENTAJE -->
														<span class="badge badge-info  badge-sm">Sin Excepci&oacute;n</span>
													</div>
												</div>
												<div>
													<span class="d-block display-5 text-dark mb-5"><?php echo NumeroCasosClientesRegistrados($cnn4); ?></span>
													<small class="d-block">Casos Registrados / Procesados / Cerrados</small>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card card-sm">
											<div class="card-body">
												<div class="d-flex justify-content-between mb-5">
													<div>
														<span class="d-block font-15 text-dark font-weight-500">Reportes Plataforma</span>
													</div>
													<div>
                                                        <!-- PORCENTAJE -->
														<span class="badge badge-danger  badge-sm">Sin Excepci&oacute;n</span>
													</div>
												</div>
												<div>
													<span class="d-block display-5 text-dark mb-5"><?php echo NumeroReportesPlataformaRegistrados($cnn3); ?></span>
													<small class="d-block">Reportes Registrados / Procesados / Cerrados</small>
												</div>
											</div>
										</div>
									</div>	

								</div>
							</div>

                            <!-- GRAFICOS -->

                            <!-- CASOS CLIENTES POR MES -->
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header card-header-action">
										<h6>Casos de Clientes Procesados Por Mes</h6>
									</div>
									<div class="card-body">
										<div id="e_chart_3" style="height:270px;"></div>
									</div>
								</div>

                                <!-- CASOS CLIENTES POR AÑO -->
                                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h6 class="hk-sec-title">TOTAL DE CASOS POR A&Ntilde;O</h6>
                            <div class="row">
                                <div class="col-sm">
                                    <div id="m_chart_4" class="" style="height:294px;"></div>
                                    <br><br>
                                </div>
                            </div>
                        </section>

								<div class="card">
									<div class="card-body">
                                        <h6 class="hk-sec-title">CASOS REGISTRADOS - 3 MESES</h6>
										<div class="hk-legend-wrap mb-10">
											<div class="hk-legend">
												<span class="d-10 bg-info rounded-circle d-inline-block"></span><span>Abril</span>
											</div>
											<div class="hk-legend">
												<span class="d-10 bg-grey-light-1  rounded-circle d-inline-block"></span><span>Mayo</span>
											</div>
										</div>
										<div id="e_chart_1" class="echart" style="height:200px;"></div>
										<div class="row mt-20">
											<div class="col-4">
												<span class="d-block text-capitalize mb-5">Marzo:</span>
												<span class="d-block font-weight-600 font-13">65,565 Casos Registrados</span>
											</div>
											<div class="col-4">
												<span class="d-block text-capitalize mb-5">Tendencia Casos (%)</span>
												<span class="d-block font-weight-600 font-13">+ <?php
                                                    // MES ANTERIOR
                                                    define('PorcentajeAnterior',45048);
                                                    // MES ACTUAL
                                                    define('PorcentajeActual', 86780);
                                                    // SUMATORIA DE CASOS REGISTRADOS
                                                    $Total=PorcentajeAnterior+PorcentajeActual;
                                                    // CALCULO DE PORCENTAJE FINAL
                                                    $CalculoPorcentajes=(PorcentajeActual*100)/$Total;
                                                    echo round($CalculoPorcentajes,2) ?>  %</span>
											</div>
											<div class="col-4">
												<span class="d-block text-capitalize mb-5">Estado</span>
												<span class="block">
													<i class="zmdi zmdi-trending-up text-green font-20"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
            <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>&copy; Copyright 2020 | CRM VTiger S.A de C.V</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="../vistas/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vistas/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vistas/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../vistas/dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../vistas/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../vistas/dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="../vistas/vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../vistas/dist/js/toggle-data.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="../vistas/vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vistas/vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../vistas/vendors/raphael/raphael.min.js"></script>
    <script src="../vistas/vendors/morris.js/morris.min.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="../vistas/vendors/echarts/dist/echarts-en.min.js"></script>
    
	<!-- Sparkline JavaScript -->
    <script src="../vistas/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="../vistas/vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../vistas/vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../vistas/dist/js/vectormap-data.js"></script>


	<!-- Owl JavaScript -->
    <script src="../vistas/vendors/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Toastr JS -->
    <script src="../vistas/vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="../vistas/dist/js/init.js"></script>
	<script src="../vistas/dist/js/dashboard-data.js"></script>
	
</body>

</html>