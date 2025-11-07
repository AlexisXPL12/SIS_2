<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
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

        body {
            background: var(--bg-primary) !important;
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
        }

        .page-header .subtitle {
            color: var(--text-secondary);
            margin: 0.5rem 0 0 0;
            font-weight: 500;
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
        }

        .form-control:focus {
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.15);
        }

        .codigo-patrimonial-group {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        /* Botones */
        .btn-primary {
            background: var(--gradient-primary) !important;
            border: none !important;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 136, 229, 0.2);
        }

        .btn-primary:hover {
            background: var(--gradient-secondary) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 136, 229, 0.3);
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
        .bien-card {
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
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
            transform: translateX(5px);
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

        .bien-codigo {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-primary);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bien-estado {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .estado-bueno {
            background: linear-gradient(135deg, #00897b 0%, #00695c 100%);
            color: white;
        }

        .estado-regular {
            background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
            color: white;
        }

        .estado-malo {
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            color: white;
        }

        .bien-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        /* Alertas */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1.25rem;
            box-shadow: var(--shadow);
            animation: slideIn 0.4s ease;
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .codigo-patrimonial-group {
                grid-template-columns: 1fr;
            }

            .bien-info {
                grid-template-columns: 1fr;
            }

            .results-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
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

        .bien-card {
            animation: fadeInUp 0.4s ease;
        }
    </style>
</head>

<body>
    <input type="hidden" id="ruta_api" value="https://sibi.404brothers.com.pe">
    <div class="container">
        <!-- Header Principal -->
        <div class="page-header">
            <h1><i class="fas fa-database"></i> API de Bienes - SIBI</h1>
            <p class="subtitle">Sistema Integral de Bienes Institucionales</p>
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
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="stat-value" id="bienes-buenos">0</p>
                <p class="stat-label">En Buen Estado</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="stat-value" id="bienes-regulares">0</p>
                <p class="stat-label">Estado Regular</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-search"></i>
                </div>
                <p class="stat-value" id="ultima-busqueda">-</p>
                <p class="stat-label">Última Búsqueda</p>
            </div>
        </div>
    <form action="" id="frmApi">
        <input type="text" value="cffc7a66ee673b812e6d51b45d6dd2a0-20251023-1" name="token" id="token">
        <input type="text" name="data" id="data">
        <br>
    </form>
    <button id="btn_buscar" onclick="llamar_api();">Buscar</button>
    <br>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Nro</th>
                <td>Codigo Patrimonial</td>
                <td>Denominacion</td>
                <td>Ambiente</td>
            </tr>
        </thead>
        <tbody id="contenido">

        </tbody>
    </table>
</body>
<script src="<?php echo BASE_URL; ?>src/view/js/api.js"></script>

</html>