<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="dark" data-sidebar="gradient-4" data-sidebar-size="lg" data-sidebar-image="img-2" data-preloader="disable" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default"><head>
    <meta charset="utf-8" />
    <title>SIS - VENTAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="storage/per/logo.png">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="assets/ckeditor/ckeditor.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/noty@3.1.4/lib/noty.css">
    <script src="https://cdn.jsdelivr.net/npm/noty@3.1.4/lib/noty.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>
<body>
    <?php if(isset($_SESSION["conticomtc"])):
        $u = UserData::verid($_SESSION['conticomtc']);?>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="storage/per/usuario.png" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= $u->nombre; ?></span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text"><?= $u->apellido; ?></span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Bienvenido <?= $u->nombre; ?>!</h6>
                                <a class="dropdown-item" href="salir.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Salir</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="storage/per/logo.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="storage/per/logo.png" alt="" height="17">
                    </span>
                </a>
                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <p></p>
                        <!-- <img src="storage/per/logo.png" alt="" height="22" width="20px"> -->
                        <h3 style="color: #FFFFFF;">S - V</h3>
                    </span>
                    <span class="logo-lg">
                        <p></p>
                        <!-- <img src="storage/per/logo.png" alt="" height="50" width="50px"> -->
                        <h3 style="color: #FFFFFF;">SIS - VENTAS</h3>
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="index">
                                <i class="ri-home-smile-fill"></i> <span data-key="t-venta">Inicio</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="venta">
                                <i class="ri-shopping-cart-line"></i> <span data-key="t-venta">Vender</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="compra">
                                <i class="ri-shopping-basket-line"></i> <span data-key="t-compra">Compra</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#movimientos" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="movimientos" data-key="t-password-reset">
                               <i class="ri-exchange-fill"></i> <span data-key="t-movimientos">Movimientos</span>
                            </a>
                            <div class="collapse menu-dropdown" id="movimientos">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="mcompra" class="nav-link" data-key="t-basic">
                                        Compras </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="mventa" class="nav-link" data-key="t-basic">
                                        Ventas </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="cotizacion" class="nav-link" data-key="t-basic">
                                        Cotización </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="comprapendiente" class="nav-link" data-key="t-basic">
                                        Compras x pagar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ventapendiente" class="nav-link" data-key="t-basic">
                                        Ventas x cobrar</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="inventario">
                                <i class="ri-shopping-basket-line"></i> <span data-key="t-compra">Inventario</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#elementos" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="elementos" data-key="t-password-reset">
                               <i class="ri-swap-box-line"></i> <span data-key="t-elementos">Elementos</span>
                            </a>
                            <div class="collapse menu-dropdown" id="elementos">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="categoria" class="nav-link" data-key="t-basic">
                                        Categoria </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="articulo" class="nav-link" data-key="t-basic">
                                        Productos </a>
                                    </li>
                                   <!--  <li class="nav-item">
                                        <a href="presentacion" class="nav-link" data-key="t-basic">
                                        Presentación </a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a href="almacen" class="nav-link" data-key="t-basic">
                                        Almacén </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="unidad" class="nav-link" data-key="t-basic">
                                        Unidad </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="cargo" class="nav-link" data-key="t-basic">
                                        Cargos </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#usuarios" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="usuarios" data-key="t-password-reset">
                               <i class="ri-user-follow-fill"></i> <span data-key="t-usuarios">Colaboradores</span>
                            </a>
                            <div class="collapse menu-dropdown" id="usuarios">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="usuario" class="nav-link" data-key="t-basic">
                                        Usuario </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="cliente" class="nav-link" data-key="t-basic">
                                        Clientes / Proveedor</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="proveedor" class="nav-link" data-key="t-basic">
                                        Proveedores </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#reporte" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="reporte" data-key="t-password-reset">
                               <i class="ri-bar-chart-2-fill"></i> <span data-key="t-reporte">Reporte</span>
                            </a>
                            <div class="collapse menu-dropdown" id="reporte">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="reporte1" class="nav-link" data-key="t-basic">
                                        Proveedores / Clientes </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="reporte2" class="nav-link" data-key="t-basic">
                                        Acticulos</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay"></div>
            <?php View::load("index");  ?>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> @ SISTEMA DE VENTAS.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Todos los derechos
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
         </div>
         <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <?php else:?>
           <link href="assets/estilologin.css" rel="stylesheet" type="text/css" />
    <div class="auth-page-wrapper pt-10">
        <div class="auth-one-bg-position" id="auth-particles" style="background-image: url('storage/per/fondillo.png'); background-size: cover; background-position: center; margin-top: 0; padding: 0;">
            <div class="bg-overlay" style="background-color: #67678F;"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="./" class="d-inline-block auth-logo">
                                    <img src="storage/per/logo.png" alt="" height="100">
                                </a>
                            </div>
                            <div class="header-text">
                              SISTEMA DE VENTAS
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-1">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Iniciar sesión</h5>
                                    <p class="text-muted">Por favor ingresa su usuario y contraseña.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <?php if (!isset($_COOKIE['verificationCode'])) { ?>
                                    <form id="loginForm" method="post"  action="index.php?action=access">
                                        <?php if (isset($_SESSION['error_message'])) {
                                                    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                                                    unset($_SESSION['error_message']);
                                                } ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Usuario</label>
                                            <input autofocus type="text" autofocus autocomplete="off" class="form-control" id="username" name="usuario" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" id="password-input" name="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <div class="float-end">
                                                        <a href="javascript:void(0)"  class="text-muted">¿Olvidó su contraseña?</a>
                                                    </div>
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Recordar</label>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Ingresar</button>
                                        </div>
                                    </form>
                                    <?php } else { ?>
                                        <form id="verificationForm" method="post"  action="index.php?action=validar">
                                                <?php if (isset($_SESSION['error_message1'])) {
                                                    echo '<div class="alert alert-danger">' . $_SESSION['error_message1'] . '</div>';
                                                    unset($_SESSION['error_message1']);
                                                } ?>
                                                <div class="counter-container1">
                                                    <span id="counter" data-start-time="<?php echo $_SESSION['verificationStartTime']; ?>"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">validar código</label>
                                                    <input autofocus type="text" class="form-control" name="codigo" required>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Validar Código</button>
                                                </div>
                                            </form>
                                        <?php } ?>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                let startTime = parseInt(document.getElementById("counter").getAttribute("data-start-time"));
                                                let interval = setInterval(function() {
                                                    let currentTime = Math.floor(new Date().getTime() / 1000);  
                                                    let timeElapsed = currentTime - startTime;
                                                    let timeRemaining = 60 - timeElapsed;
                                                    if (timeRemaining <= 0) {
                                                        clearInterval(interval);
                                                        document.getElementById("counter").innerText = "¡Tiempo agotado!";
                                                    } else {
                                                        let minutes = Math.floor(timeRemaining / 60);
                                                        let seconds = timeRemaining % 60;
                                                        document.getElementById("counter").innerText = minutes + ":" + (seconds < 10 ? "0" + seconds : seconds);
                                                    }
                                                }, 1000);
                                            });
                                    </script>
                                    <form id="passwordResetForm" method="post"  action="index.php?action=recuperar" style="display: none;">
                                                <?php if (isset($_SESSION['error_message2'])) {
                                                    echo '<div class="alert alert-danger">' . $_SESSION['error_message2'] . '</div>';
                                                    unset($_SESSION['error_message2']);
                                                } ?>
                                                <?php if (isset($_SESSION['error_message3'])) {
                                                    echo '<div class="alert alert-success">' . $_SESSION['error_message3'] . '</div>';
                                                    unset($_SESSION['error_message3']);
                                                } ?>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Ingresar su correo Electrónico</label>
                                                    <input autofocus type="text" class="form-control" name="correo" required>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Validar correo</button>
                                                </div>
                                                <a href="javascript:void(0)" class="text-muted" onclick="showLoginForm()">Retornar</a>
                                            </form>
                                                <script>
                                                    function showPasswordResetForm() {
                                                        document.getElementById('loginForm').style.display = 'none';
                                                        document.getElementById('passwordResetForm').style.display = 'block';
                                                        localStorage.setItem('showPasswordResetForm', 'true');
                                                        
                                                        // Añade una entrada al historial del navegador
                                                        history.pushState({ form: 'passwordResetForm' }, '');
                                                    }

                                                    function hidePasswordResetForm() {
                                                        document.getElementById('loginForm').style.display = 'block';
                                                        document.getElementById('passwordResetForm').style.display = 'none';
                                                        localStorage.removeItem('showPasswordResetForm');
                                                        
                                                        // Añade una entrada al historial del navegador
                                                        history.pushState({ form: 'loginForm' }, '');
                                                    }

                                                    // Al cargar la página, verificamos cuál formulario mostrar
                                                    if (localStorage.getItem('showPasswordResetForm') === 'true') {
                                                        showPasswordResetForm();
                                                    } else {
                                                        hidePasswordResetForm();
                                                    }

                                                    // Verifica cuál formulario mostrar cuando el estado de carga del documento cambia
                                                    document.onreadystatechange = function() {
                                                        if (document.readyState === "interactive") {
                                                            if (localStorage.getItem('showPasswordResetForm') === 'true') {
                                                                showPasswordResetForm();
                                                            } else {
                                                                hidePasswordResetForm();
                                                            }
                                                        }
                                                    };

                                                    // Detecta el evento popstate para mostrar el formulario correcto cuando el usuario pulsa el botón de retroceso
                                                    window.addEventListener('popstate', function(event) {
                                                        if (event.state && event.state.form === 'passwordResetForm') {
                                                            showPasswordResetForm();
                                                        } else {
                                                            hidePasswordResetForm();
                                                        }
                                                    });
                                                    function showLoginForm() {
                                                    document.getElementById('loginForm').style.display = 'block';
                                                    document.getElementById('passwordResetForm').style.display = 'none';
                                                    localStorage.removeItem('showPasswordResetForm');
                                                    
                                                    // Añade una entrada al historial del navegador
                                                    history.pushState({ form: 'loginForm' }, '');
                                                }
                                                </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="text-center">
          <p>&copy; <script>document.write(new Date().getFullYear())</script> SISTEMA DE VENTAS. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </div>
</footer>

    </div>
    <script src="assets/scriptlogin.js"></script>
    <script src="assets/js/pages/password-addon.init.js"></script>
    <script src="assets/libs/particles.js/particles.js"></script>
    <script src="assets/js/pages/particles.app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>
    <script src="assets/libs/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/pages/dashboard-ecommerce.init.js"></script>
    <script src="assets/libs/prismjs/prism.js"></script>
    <script src="assets/libs/list.pagination.js/list.pagination.min.js"></script>
    <script src="assets/js/pages/listjs.init.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/js/pages/ecommerce-product-details.init.js"></script>
    <script src="assets/js/pages/invoicedetails.js"></script>
    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <script src="assets/js/pages/form-editor.init.js"></script>
    <script src="assets/pers1.js"></script>
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script>
    // $(document).ready(function() {
    //     $('.miSelect1').select2({
    //     });
    // });
    $(".miSelect1").select2();
    $(".miSelect1").on("select2:open", function() {
        $(".select2-search__field").focus();
    });
    </script>
   <script>
       $(document).ready(function() {
    if ($.fn.DataTable.isDataTable('.cambios')) {
        $('.cambios').DataTable().destroy();
    }

    $('.cambios').DataTable({
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ elementos",
            info: "Mostrando desde _START_ al _END_ de _TOTAL_ elementos",
            infoEmpty: "Mostrando ningún elemento.",
            infoFiltered: "(filtrado _MAX_ elementos total)",
            infoPostFix: "",
            loadingRecords: "Cargando registros...",
            zeroRecords: "No se encontraron registros",
            emptyTable: "No hay datos disponibles en la tabla",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Último"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});
    </script> 
</body>
</html>