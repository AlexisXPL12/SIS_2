<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API de Bienes - SIBI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
        const session_usuario = '<?php echo $_SESSION["sesion_usuario"]; ?>';
        const session_session = '<?php echo $_SESSION['sesion_id']; ?>';
        const token_token = '<?php echo $_SESSION['sesion_token']; ?>';
    </script>
    <style>
        /* Variables principales - Estilo Institucional SIBI */
        :root {
            --bg-primary: #f0f4f8;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-hover: #e8f4f8;
            --text-primary: #1e3a5f;
            --text-secondary: #546e7a;
            --accent-blue: #1e88e5;
            --accent-blue-hover: #1565c0;
            --accent-green: #00897b;
            --accent-yellow: #ffa726;
            --border-color: #cfd8dc;
            --shadow: 0 2px 8px rgba(30, 136, 229, 0.08);
            --shadow-hover: 0 4px 16px rgba(30, 136, 229, 0.15);
            --gradient-primary: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            --gradient-secondary: linear-gradient(135deg, #00897b 0%, #ffa726 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-primary);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        /* Header principal */
        .page-header {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .page-header h1 {
            color: var(--text-primary);
            font-weight: 700;
            margin: 0;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            margin: 0.5rem 0 0 0;
            font-weight: 500;
            font-size: 1rem;
        }

        /* Estadísticas superiores */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--accent-blue);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            color: white;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Sección de filtros */
        .filter-section {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .filter-section h4 {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-section h4 i {
            font-size: 1.3rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.15);
            outline: none;
        }

        /* Botones */
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2);
            color: white;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--gradient-secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 136, 229, 0.3);
            color: white;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Sección de resultados */
        .results-section {
            background: var(--bg-secondary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            display: none;
        }

        .results-section.active {
            display: block;
        }

        .results-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .results-header h4 {
            color: var(--text-primary);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .results-count {
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2);
        }

        /* Cards de bienes */
        .bienes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .bien-card {
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .bien-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--gradient-primary);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .bien-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
            border-color: var(--accent-blue);
        }

        .bien-card:hover::before {
            opacity: 1;
        }

        .bien-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .bien-numero {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .bien-codigo {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-primary);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .bien-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-item {
            display: flex;
            align-items: start;
            gap: 0.75rem;
        }

        .info-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-hover);
            color: var(--accent-blue);
            flex-shrink: 0;
            font-size: 0.9rem;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.95rem;
            word-break: break-word;
        }

        /* Alertas */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1.25rem;
            box-shadow: var(--shadow);
            animation: slideIn 0.4s ease;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border-left: 4px solid var(--accent-green);
            color: #2e7d32;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border-left: 4px solid #e53935;
            color: #c62828;
        }

        .alert-info {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid var(--accent-blue);
            color: #1565c0;
        }

        /* Spinner de carga */
        .loading-spinner {
            text-align: center;
            padding: 3rem;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--accent-blue);
            border-right: 4px solid var(--accent-green);
            border-bottom: 4px solid var(--accent-yellow);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .bienes-grid {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }
        }

        /* Animaciones de entrada */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.4s ease;
        }
    </style>
</head>

<body>
    <!-- Botón de Regreso -->
        <div class="mb-3">
            <a type="button" class="btn btn-primary" href="<?php echo BASE_URL ?>inicio">
                <i class="fas fa-arrow-left"></i> Regresar a Inicio
            </a>
        </div>
    <input type="hidden" id="ruta_api" value="https://sibi.404brothers.com.pe">
    <div class="container">
        <!-- Header Principal -->
        <div class="page-header">
            <h1>
                <i class="fas fa-database"></i>
                API de Bienes - SIBI
            </h1>
            <p class="subtitle">Sistema Integral de Bienes Institucionales</p>
        </div>

        <!-- Sección de Filtros -->
        <div class="filter-section">
            <h4><i class="fas fa-filter"></i> Criterios de Búsqueda</h4>
            <form id="frmApi">
                <input type="hidden" value="" name="token" id="token">
                <div class="mb-3">
                    <label for="data" class="form-label">Buscar por Denominación</label>
                    <input class="form-control" type="text" name="data" id="data"
                        placeholder="Ingrese el nombre del bien a buscar...">
                </div>

                <button type="button" id="btn_buscar" class="btn btn-primary">
                    <i class="fas fa-search"></i> Buscar Bienes
                </button>
            </form>
        </div>

        <!-- Estadísticas -->
        <div class="stats-container" id="stats-container" style="display: none;">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <p class="stat-value" id="total-bienes">0</p>
                <p class="stat-label">Total de Bienes</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-search"></i>
                </div>
                <p class="stat-value" id="ultima-busqueda">-</p>
                <p class="stat-label">Última Búsqueda</p>
            </div>
        </div>

        <!-- Sección de Resultados -->
        <div class="results-section" id="results-section">
            <div class="results-header">
                <h4><i class="fas fa-list"></i> Resultados de la Búsqueda</h4>
                <span class="results-count" id="results-count">0 resultados</span>
            </div>

            <div class="bienes-grid" id="contenido">
                <!-- Los resultados se cargarán aquí dinámicamente -->
            </div>
        </div>
    </div>
</body>
<script src="<?php echo BASE_URL; ?>src/view/js/api.js"></script>
<script>
    // Llamar a la función para cargar el token
    obtenerToken();
</script>

</html>