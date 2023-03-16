<?php
// NO PERMITIR ACCESO NO LOGUEADO
if (!isset($_GET['acc'])) {
    header('location:../controlador/ControlLogin.php?acc=1');
}
if (!isset($_SESSION['vsCodigo'])) {
    header('location:../controlador/ControlLogin.php?acc=1');
}
// NO PERMITIR ACCESO OTRO ROL DIFERENTE DE USUARIO AL ACCEDIDO
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
    <link rel="icon" type="image/png" sizes="192x192" href="../vistas/dist/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../vistas/dist/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../vistas/dist/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../vistas/dist/img/favicon-16x16.png">
    <link rel="manifest" href="../vistas/dist/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../vistas/dist/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Bootstrap Dropzone CSS -->
    <link href="../vistas/vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Dropzone CSS -->
    <link href="../vistas/vendors/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
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
    <!--/Preloader -->
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar shadow-lg shadow-hover-xl">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span
                    class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand font-weight-700" href="../vistas/usuarios/PrincipalUsuarios.php?acc=1">
                <img src="../vistas/dist/img/logoUCEM1.png" width="80" height="60" class="d-inline-block align-top" alt="">
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <!-- BUSCADOR 
                <li class="nav-item">
                    <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
                </li> -->
                <!-- SESION ACTIVA -->
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="../vistas/dist/fotosperfiles/<?php echo $_SESSION['vsFotosPerfilesUs'] ?>"
                                        alt="FotoPerfil" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span>
                                    <?php echo $_SESSION['vsNombre'];
                                    echo " ";
                                    echo $_SESSION['vsApellidos']; ?><i class="zmdi zmdi-chevron-down"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                    <!-- AJUSTES PERFIL -->
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX"
                        data-dropdown-out="flipOutX">
                        <div class="sub-dropdown-menu show-on-hover">
                            <a href="#" class="dropdown-toggle dropdown-item no-caret"><i
                                    class="zmdi zmdi-check text-success"></i>Activo Ahora</a>
                        </div>
                        <a class="dropdown-item" href="../controlador/cUsuariosAdministradores.php?acc=7"><i
                                class="dropdown-icon zmdi zmdi-account"></i><span>Mi Perfil</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../controlador/cUsuariosAdministradores.php?acc=8"><i
                                class="dropdown-icon zmdi zmdi-power"></i><span>Cerrar sesión</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <form role="search" class="navbar-search">
            <div class="position-relative">
                <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i
                            data-feather="search"></i></span></a>
                <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
                <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i
                            data-feather="x"></i></span></a>
            </div>
        </form>
        <!-- /Top Navbar -->

        <!-- MENU DE NAVEGACION -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                        data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">


                        <!-- INICIO -->
                        <li class="nav-item active">
                            <a class="nav-link" href="../vistas/usuarios/PrincipalUsuarios.php?acc=1"
                                data-target="#Home">
                                <span class="feather-icon"><i data-feather="home"></i></span>
                                <span class="nav-link-text">Inicio</span>
                            </a>
                        </li>

                        <!-- MATERIAS -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#Consultas">
                                <span class="feather-icon"><i data-feather="search"></i></span>
                                <span class="nav-link-text">Consultas</span>
                            </a>
                            <ul id="Consultas" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="../controlador/cMateriasEstudiantes.php?acc=1">Materias
                                                Matriculadas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="../controlador/cMateriasEstudiantes.php?acc=2">Materias
                                                Ganadas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="../controlador/cMateriasEstudiantes.php?acc=3">Materias
                                                Pendientes</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <!-- Reportes -->
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse"
                                data-target="#Reportes">
                                <span class="feather-icon"><i data-feather="file"></i></span>
                                <span class="nav-link-text">Reportes</span>
                            </a>
                            <ul id="Reportes" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" target="_blank"
                                                href="../../controlador/cGestionarReportesClientes.php?acc=reportecartaestudiante">Carta
                                                Estudiante Activo</a>
                                        </li>
                                        <!--
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="../../controlador/cGestionarReportesClientes.php?acc=4">Gestionar
                                            Casos Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="../../controlador/cGestionarReportesClientes.php?acc=1">Consultar
                                            Casos Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="../../controlador/cGestionarReportesClientes.php?acc=5">Exportar Casos
                                            Clientes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="../../controlador/cGestionarReportesClientes.php?acc=10">Ver Historial
                                            de Casos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="../../controlador/cGestionarReportesClientes.php?acc=reportecasosclientes">Generar
                                            Documento PDF</a>
                                    </li>
                                    -->
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- CLIENTES -->
                        <!-- CIUDADES -->
                        <!-- PRODUCTOS -->
                        <!-- MARCAS PRODUCTOS -->
                        <!-- SUCURSALES -->
                        <!-- VENTAS -->
                        <!-- EMPRESA -->
                        <!-- LINEAS -->
                        <!-- REPORTES PROBLEMAS PLATAFORMA -->
                </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Setting Panel -->
        <div class="hk-settings-panel">
            <div class="nicescroll-bar position-relative">
                <div class="settings-panel-wrap">
                    <div class="settings-panel-head">
                        <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span
                                class="feather-icon"><i data-feather="x"></i></span></a>
                    </div>
                    <hr>

                    <h6 class="mb-5">Ajustes de Preferencias</h6>
                    <p class="font-14">Men&uacute; de Navegaci&oacute;n</p>
                    <div class="button-list hk-nav-select mb-10">
                        <button type="button" id="nav_light_select"
                            class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                    class="fa fa-sun-o"></i> </span><span class="btn-text">Modo
                                D&iacute;a</span></button>
                        <button type="button" id="nav_dark_select"
                            class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span
                                class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo
                                Noche</span></button>
                    </div>
                    <hr>
                    <h6 class="mb-5">Seleccione modo de header / contenido superior</h6>
                    <p class="font-14">Seleccione su preferencia</p>
                    <div class="button-list hk-navbar-select mb-10">
                        <button type="button" id="navtop_light_select"
                            class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i
                                    class="fa fa-sun-o"></i> </span><span class="btn-text">Modo
                                D&iacute;a</span></button>
                        <button type="button" id="navtop_dark_select"
                            class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span
                                class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Modo
                                Noche</span></button>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Agregar Scroll Men&uacute; de Navegaci&oacute;n</h6>
                        <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch">
                        </div>
                    </div>
                    <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reiniciar
                        Ajustes</button>
                </div>
            </div>
            <img class="d-none" src="../vistas/dist/img/logo-light.png" alt="brand" />
            <img class="d-none" src="../vistas/dist/img/logo-dark.png" alt="brand" />
        </div>
        <!-- /Setting Panel -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Container -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 pa-0">
                        <div class="profile-cover-wrap overlay-wrap">
                            <div class="profile-cover-img"
                                style="background-image:url('../vistas/dist/img/trans-bg.jpg');"></div>
                            <div class="bg-overlay bg-trans-dark-60"></div>
                            <div class="container profile-cover-content py-50">
                                <div class="hk-row">
                                    <div class="col-lg-6">
                                        <div class="media align-items-center">
                                            <div class="media-img-wrap  d-flex">
                                                <div class="avatar">
                                                    <img src="../vistas/dist/fotosperfiles/<?php echo $_SESSION['vsFotosPerfilesUs'] ?>"
                                                        alt="FotoPerfil" class="avatar-img rounded-circle">
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="text-white text-capitalize display-6 mb-5 font-weight-400">
                                                    ¡Hola
                                                    <?php echo $_SESSION['vsNombre'];
                                                    echo " ";
                                                    echo $_SESSION['vsApellidos']; ?>!
                                                </div>
                                                <div class="font-14 text-white"><span class="mr-5"><span
                                                            class="font-weight-500 pr-5">Tipo de Usuario:</span><span
                                                            class="mr-5"> <span class="badge badge-danger">
                                                                <?php echo $_SESSION['vsTipo'] ?>
                                                            </span></span></span>Codigo de usuario: <span
                                                        class="badge badge-pink">
                                                        <?php echo $_SESSION['vsCodigoUser'] ?>
                                                    </span><span><span
                                                            class="font-weight-500 pr-5"></span><span></span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container -->
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <section class="hk-sec-wrapper">
                                    <div class="row">
                                        <div class="col-sm">
                                            <h3 style="text-align: center; margin: .5rem 0 2.5rem 0;">Modificar Perfil
                                                de Usuario</h3>
                                            <!-- MENSAJE DE ALERTA USUARIOS -->
                                            <div class="alert alert-secondary alert-wth-icon alert-dismissible fade show"
                                                role="alert">
                                                <span class="alert-icon-wrap"><i
                                                        class="zmdi zmdi-notifications-active"></i></span>Tome en
                                                Consideraci&oacute;n: Todos los campos marcados con <span
                                                    style="color :#F00; font-weight: 800;">(*)</span> son obligatorios
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- FIN MENSAJE DE ALERTA USUARIOS -->
                                            <form class="needs-validation" novalidate method="POST"
                                                action="../controlador/cUsuariosAdministradores.php?acc=9"
                                                enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <!-- ID -->
                                                    <div class="col-md-12 mb-10">
                                                        <input type="hidden" class="form-control custom-select"
                                                            name="IdUser" value="<?php echo $_SESSION['vsCodigo'] ?>"
                                                            required>

                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese el ID...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- CODIGO -->
                                                    <div class="col-md-12 mb-10">
                                                        <input type="hidden" class="form-control custom-select"
                                                            name="CodigoUser"
                                                            value="<?php echo $_SESSION['vsCodigoUser'] ?>" required>

                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese el ID...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- CORREO USER -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Correo Electronico <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="email" name="CorreoUser" class="form-control "
                                                            id="validationCustom01" placeholder=""
                                                            value="<?php echo $_SESSION['vsCorreoElectronico'] ?>"
                                                            required>
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese el c&oacute;digo...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- CEDULA -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Cedula del Usuario <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="text" name="CedulaUser"
                                                            class="form-control prohibido" id="validationCustom01"
                                                            placeholder="" value="<?php echo $_SESSION['vsCedula'] ?>"
                                                            disabled>
                                                        <!--option value="Inactivo">Inactivo</option-->
                                                        </select>
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor seleccione una opci&oacute;n...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- NOMBRE USUARIO -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Nombre de Usuario <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="text" name="NombreUser"
                                                            class="form-control prohibido" id="validationCustom01"
                                                            placeholder="" value="<?php echo $_SESSION['vsNombre']; ?>"
                                                            disabled>
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese el nombre de usuario...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- APELLIDOS -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Apellidos del Usuario <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="text" name="ApellidosUser"
                                                            class="form-control prohibido" id="validationCustom01"
                                                            placeholder=""
                                                            value="<?php echo $_SESSION['vsApellidos'] ?>" disabled>
                                                        <!--option value="Inactivo">Inactivo</option-->
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor seleccione una opci&oacute;n...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- ESTADO -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Estado de Usuario <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="text" name="EstadoUser"
                                                            class="form-control prohibido" id="validationCustom01"
                                                            placeholder="" value="<?php echo $_SESSION['vsEstado'] ?>"
                                                            disabled>
                                                        <!--option value="Inactivo">Inactivo</option-->
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor seleccione una opci&oacute;n...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- TIPO USUARIO -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Tipo de Usuario Registrado <span
                                                                class="CampoObligatorio">(*)</span></label>
                                                        <input type="text" name="TipoUser"
                                                            class="form-control prohibido" id="validationCustom01"
                                                            placeholder="" value="<?php echo $_SESSION['vsTipo'] ?>"
                                                            disabled>
                                                        </select>
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor seleccione una opci&oacute;n...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- CONTRASEÑA NUEVA -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Contraseña nueva de
                                                            Usuario</label>
                                                        <input type="password" name="PassUser" class="form-control"
                                                            id="validationCustom01"
                                                            placeholder="Por favor Ingrese Contrase&ntilde;a Usuario..."
                                                            minlength="8" maxlength="12" data-toggle="tooltip-pink"
                                                            data-placement="top"
                                                            title="Minimo 8 caracteres, 1 mayuscula, 1 miniscula y un numero."
                                                            value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}">
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese una contrase&ntilde;a...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- CONTRASEÑA CONFIRMAR -->
                                                    <div class="col-md-6 mb-10">
                                                        <label for="validationCustom01">Confirmar contraseña</label>
                                                        <input type="password" name="ConfirPassUser"
                                                            class="form-control" id="validationCustom01"
                                                            placeholder="Por favor Ingrese Contrase&ntilde;a Usuario..."
                                                            minlength="8" maxlength="12" data-toggle="tooltip-pink"
                                                            data-placement="top"
                                                            title="Minimo 8 caracteres, 1 mayuscula, 1 miniscula y un numero."
                                                            value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}">
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese una contrase&ntilde;a...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <!-- FOTO PERFIL USUARIO -->
                                                    <div class="col-md-12 mb-10">
                                                        <label for="validationCustom01">Ingrese su foto de
                                                            perfil</label>
                                                        <input type="file" id="input-file-now" name="FotoPerfilUsuarios"
                                                            class="dropify" data-max-file-size="2M"
                                                            accept="image/x-png,image/jpeg" data-toggle="tooltip-pink"
                                                            data-placement="top" title="Campo No Obligatorio">
                                                        <p>Formatos Validos: jpg,png | MAX: 2MB</p>
                                                        <!-- INVALIDO -->
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese una foto de perfil...
                                                        </div>
                                                        <!-- VALIDO -->
                                                        <div class="valid-feedback">
                                                            Campo Completado Exitosamente!...
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-10">
                                                        <input type="hidden" name="ValidarFotoExistente"
                                                            value="<?php echo $_SESSION['vsFotosPerfilesUs'] ?>">
                                                    </div>

                                                </div>
                                                <button class="btn btn-gradient-primary" type="submit"><i
                                                        class="fa fa-check"></i> Modificar Usuario</button>
                                                <button class="btn btn-gradient-secondary" type="reset"><i
                                                        class="fa fa-check"></i> Limpiar formulario</button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                            <!-- /Container -->
                            <!-- /Row -->
                        </div>
                        <!-- /Container -->

                        <!-- Footer -->
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
                <!-- Dropzone JavaScript -->
                <script src="../vistas/vendors/dropzone/dist/dropzone.js"></script>
                <!-- Dropify JavaScript -->
                <script src="../vistas/vendors/dropify/dist/js/dropify.min.js"></script>
                <!-- Form Flie Upload Data JavaScript -->
                <script src="../vistas/dist/js/form-file-upload-data.js"></script>
                <!-- FeatherIcons JavaScript -->
                <script src="../vistas/dist/js/feather.min.js"></script>
                <!-- Toggles JavaScript -->
                <script src="../vistas/vendors/jquery-toggles/toggles.min.js"></script>
                <script src="../vistas/dist/js/toggle-data.js"></script>
                <!-- Init JavaScript -->
                <script src="../vistas/dist/js/init.js"></script>
                <script src="../vistas/dist/js/validation-data.js"></script>
                <!-- tooltip custom -->
                <script src="../vistas/dist/js/tooltip-data.js"></script>
</body>

</html>