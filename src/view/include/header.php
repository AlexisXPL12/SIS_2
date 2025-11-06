<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SIS 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Sistema de Gestión de Docentes" name="description" />
    <meta content="AnibalYucraC" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo BASE_URL ?>src/view/pp/assets/images/ies.ico">

    <!-- Plugins css -->
    <script src="<?php echo BASE_URL ?>src/view/js/principal.js"></script>
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alerts css -->
    <link href="<?php echo BASE_URL ?>src/view/pp/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/pp/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>src/view/include/styles.css" rel="stylesheet" type="text/css" />
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
        const session_usuario = '<?php echo $_SESSION["sesion_usuario"]; ?>';
        const session_session = '<?php echo $_SESSION['sesion_id']; ?>';
        const token_token = '<?php echo $_SESSION['sesion_token']; ?>';
    </script>
    <?php date_default_timezone_set('America/Lima');  ?>
    <style>
        /* ============================================
            SISTEMA DE GESTIÓN DE DOCENTES (Estilo Académico Profesional)
        ============================================ */

        /* Variables principales - Paleta Educativa */
        :root {
            --bg-primary: #f5f7fa;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #e3f2fd;
            --text-primary: #1a237e;
            --text-secondary: #455a64;
            --accent-primary: #3f51b5;
            --accent-primary-hover: #303f9f;
            --accent-secondary: #00897b;
            --accent-secondary-hover: #00695c;
            --accent-tertiary: #ff6f00;
            --accent-tertiary-hover: #e65100;
            --border-color: #cfd8dc;
            --shadow: 0 2px 8px rgba(63, 81, 181, 0.1);
            --shadow-hover: 0 4px 16px rgba(63, 81, 181, 0.2);
            --gradient-primary: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
            --gradient-secondary: linear-gradient(135deg, #00897b 0%, #26a69a 100%);
            --gradient-academic: linear-gradient(135deg, #1a237e 0%, #3f51b5 50%, #00897b 100%);
        }

        /* Base styles */
        body {
            background: var(--bg-primary) !important;
            color: var(--text-primary) !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
        }

        /* Header */
        #page-topbar {
            background: var(--bg-secondary) !important;
            border-bottom: 4px solid transparent !important;
            border-image: var(--gradient-academic) 1 !important;
            box-shadow: var(--shadow);
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1200 !important;
        }

        /* Logo */
        #page-topbar .navbar-brand-box .logo {
            color: var(--text-primary) !important;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            font-size: 1.1rem;
        }

        #page-topbar .navbar-brand-box .logo:hover {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        #page-topbar .navbar-brand-box .logo i {
            font-size: 1.7rem;
            margin-right: 12px;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Header buttons */
        #page-topbar .btn.header-item {
            background: var(--bg-primary) !important;
            border: 2px solid var(--border-color) !important;
            color: var(--text-primary) !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        #page-topbar .btn.header-item:hover {
            background: var(--bg-hover) !important;
            border-color: var(--accent-primary) !important;
            color: var(--accent-primary) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(63, 81, 181, 0.15);
        }

        .header-profile-user {
            border: 3px solid var(--accent-primary);
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(63, 81, 181, 0.2);
        }

        #page-topbar .btn.header-item:hover .header-profile-user {
            border-color: var(--accent-secondary);
            box-shadow: 0 0 0 4px rgba(0, 137, 123, 0.15);
            transform: scale(1.05);
        }

        /* Navigation */
        .topnav {
            background: var(--bg-secondary) !important;
            border-bottom: 3px solid transparent !important;
            border-image: var(--gradient-secondary) 1 !important;
            box-shadow: var(--shadow);
            position: fixed !important;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 1100 !important;
        }

        .topnav .navbar-nav .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 600;
            padding: 14px 22px;
            border-radius: 10px;
            margin: 0 6px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .topnav .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 4px;
            background: var(--gradient-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px 2px 0 0;
        }

        .topnav .navbar-nav .nav-link:hover {
            color: var(--accent-primary) !important;
            background: var(--bg-hover) !important;
            transform: translateY(-2px);
        }

        .topnav .navbar-nav .nav-link:hover::before {
            width: 85%;
        }

        .topnav .navbar-nav .nav-link i {
            margin-right: 8px;
            font-size: 1.05rem;
        }

        /* Dropdowns */
        .dropdown-menu {
            background: var(--bg-secondary) !important;
            border: 2px solid var(--accent-primary) !important;
            border-radius: 12px !important;
            box-shadow: var(--shadow-hover) !important;
            padding: 10px 0 !important;
            margin-top: 12px !important;
            min-width: 220px;
            z-index: 1300 !important;
        }

        /* Header dropdown positioning */
        #page-topbar .dropdown-menu {
            right: 0 !important;
            left: auto !important;
            z-index: 1400 !important;
        }

        .dropdown-item {
            padding: 12px 24px !important;
            color: var(--text-primary) !important;
            transition: all 0.3s ease !important;
            font-weight: 600;
            border-radius: 8px;
            margin: 4px 10px;
            font-size: 0.95rem;
            position: relative;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 70%;
            background: var(--gradient-primary);
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--bg-hover) !important;
            color: var(--accent-primary) !important;
            padding-left: 32px !important;
        }

        .dropdown-item:hover::before {
            width: 5px;
        }

        /* Cards */
        .card {
            background: var(--bg-card) !important;
            border: 2px solid var(--border-color) !important;
            border-radius: 14px !important;
            box-shadow: var(--shadow) !important;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-academic);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-hover) !important;
            transform: translateY(-4px);
            border-color: var(--accent-primary);
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-title {
            color: var(--text-primary) !important;
            font-weight: 700;
        }

        .card h2,
        .card h3,
        .card h4 {
            color: var(--text-primary) !important;
            font-weight: 700;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card .btn-primary {
            background: var(--gradient-primary) !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 11px 26px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(63, 81, 181, 0.25);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .card .btn-primary:hover {
            background: var(--gradient-secondary) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(63, 81, 181, 0.35);
        }

        /* Main content */
        .page-content {
            background: transparent;
            min-height: calc(100vh - 140px);
            padding-top: 140px !important;
        }

        /* Loading popup */
        #popup-carga {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(245, 247, 250, 0.96);
            backdrop-filter: blur(8px);
            z-index: 10000 !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #popup-carga .popup-content {
            background: var(--bg-secondary);
            padding: 45px;
            border-radius: 14px;
            text-align: center;
            box-shadow: var(--shadow-hover);
            border: 3px solid var(--accent-primary);
        }

        #popup-carga .spinner {
            width: 55px;
            height: 55px;
            border: 5px solid var(--border-color);
            border-top: 5px solid var(--accent-primary);
            border-right: 5px solid var(--accent-secondary);
            border-bottom: 5px solid var(--accent-tertiary);
            border-radius: 50%;
            animation: spin 0.9s linear infinite;
            margin: 0 auto 22px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #popup-carga p {
            margin: 0;
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
        }

        /* Footer */
        .footer {
            background: var(--bg-secondary) !important;
            border-top: 4px solid transparent !important;
            border-image: var(--gradient-academic) 1 !important;
            margin-top: 4rem;
            padding: 2rem 0;
        }

        .footer .text-center,
        .footer .text-right {
            color: var(--text-secondary) !important;
            font-weight: 600;
        }

        /* Badges y elementos adicionales */
        .badge-primary {
            background: var(--gradient-primary) !important;
            padding: 7px 14px;
            border-radius: 8px;
            font-weight: 700;
        }

        .badge-success {
            background: var(--gradient-secondary) !important;
            padding: 7px 14px;
            border-radius: 8px;
            font-weight: 700;
        }

        .badge-warning {
            background: linear-gradient(135deg, var(--accent-tertiary) 0%, var(--accent-tertiary-hover) 100%) !important;
            padding: 7px 14px;
            border-radius: 8px;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #page-topbar .navbar-brand-box .logo span {
                font-size: 0.9rem;
            }

            .topnav .navbar-nav .nav-link {
                padding: 12px 18px;
                margin: 3px 0;
            }

            .dropdown-menu {
                min-width: 200px;
            }

            .page-content {
                padding-top: 135px !important;
            }

            #page-topbar .dropdown-menu {
                right: 10px !important;
                min-width: 200px;
            }
        }

        /* Focus states for accessibility */
        .btn:focus,
        .dropdown-item:focus,
        .nav-link:focus {
            outline: 3px solid var(--accent-primary);
            outline-offset: 3px;
        }

        /* Ensure dropdown visibility */
        .dropdown.show .dropdown-menu {
            display: block !important;
            opacity: 1;
            visibility: visible;
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gradient-primary);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gradient-secondary);
        }
    </style>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <div class="main-content">

            <header id="page-topbar">
                <div class="navbar-header">
                    <!-- LOGO -->
                    <div class="navbar-brand-box d-flex align-items-left">
                        <a href="<?php echo BASE_URL ?>" class="logo">
                            <i class="mdi mdi-package-variant"></i>
                            <span>
                                SISTEMA DE GESTION DE DOCENTES
                            </span>
                        </a>

                        <button type="button" class="btn btn-sm mr-2 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="dropdown d-inline-block ml-2">
                            <button type="button" class="btn header-item waves-effect waves-light"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png">
                                <span class="d-none d-sm-inline-block ml-1"><?php /* echo $_SESSION['sesion_sigi_usuario_nom']; */ ?></span>
                                <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                    Mi perfil
                                </a>
                                <button class="dropdown-item d-flex align-items-center justify-content-between" onclick="sent_email_password();">
                                    <span>Cambiar mi Contraseña</span>
                                </button>
                                <button class="dropdown-item d-flex align-items-center justify-content-between" onclick="cerrar_sesion();">
                                    <span>Cerrar Sesión</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </header>

            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <!-- ---------------------------------------------- INICIO MENU SIGI ------------------------------------------------------------ -->
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo BASE_URL ?>">
                                        <i class="mdi mdi-home"></i>Inicio
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-diamond-stone"></i>Gestión <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-components">
                                        <a href="<?php echo BASE_URL ?>usuarios" class="dropdown-item">Usuarios</a>
                                        <a href="<?php echo BASE_URL ?>tokens" class="dropdown-item">Tokens</a>
                                        <a href="<?php echo BASE_URL ?>reportes" class="dropdown-item">Reportes</a>
                                    </div>
                                </li>

                                <!-- ---------------------------------------------- FIN MENU SIGI ------------------------------------------------------------ -->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->

                    <!-- Popup de carga -->
                    <div id="popup-carga" style="display: none;">
                        <div class="popup-overlay">
                            <div class="popup-content">
                                <div class="spinner"></div>
                                <p>Cargando, por favor espere...</p>
                            </div>
                        </div>
                    </div>