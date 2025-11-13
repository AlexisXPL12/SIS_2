<!-- start page title -->
<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="card-icon-wrapper">
                    <div class="card-icon usuarios-icon">
                        <i class="mdi mdi-account-multiple"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-description">Gestión de usuarios del sistema</p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL ?>usuarios" class="btn btn-primary btn-block">
                        <i class="mdi mdi-eye-outline"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="card-icon-wrapper">
                    <div class="card-icon token-icon">
                        <i class="mdi mdi-key-variant"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Token API</h5>
                    <p class="card-description">Token de autenticación</p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL ?>tokens" class="btn btn-primary btn-block">
                        <i class="mdi mdi-eye-outline"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="card-icon-wrapper">
                    <div class="card-icon token-icon">
                        <i class="mdi mdi-package-variant"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Inventario</h5>
                    <p class="card-description">Bienes institucionales</p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL ?>api-request" class="btn btn-primary btn-block">
                        <i class="mdi mdi-eye-outline"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="card-icon-wrapper">
                    <div class="card-icon docentes-icon">
                        <i class="mdi mdi-school"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Docentes</h5>
                    <p class="card-description">Docentes registrados</p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL ?>docentes" class="btn btn-primary btn-block">
                        <i class="mdi mdi-eye-outline"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card dashboard-card">
            <div class="card-body">
                <div class="card-icon-wrapper">
                    <div class="card-icon reportes-icon">
                        <i class="mdi mdi-chart-bar"></i>
                    </div>
                </div>
                <div class="card-content">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-description">Reportes generados este mes</p>
                </div>
                <div class="card-footer">
                    <a href="<?php echo BASE_URL ?>reportes" class="btn btn-primary btn-block">
                        <i class="mdi mdi-eye-outline"></i> Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sección de estadísticas adicionales -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card stats-card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-chart-line"></i> Estadísticas del Sistema
                </h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="mdi mdi-account-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3>18</h3>
                                <p>Usuarios Activos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="mdi mdi-calendar-check"></i>
                            </div>
                            <div class="stat-content">
                                <h3>32</h3>
                                <p>Asistencias Hoy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="mdi mdi-book-open-variant"></i>
                            </div>
                            <div class="stat-content">
                                <h3>12</h3>
                                <p>Cursos Activos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="mdi mdi-clock-alert-outline"></i>
                            </div>
                            <div class="stat-content">
                                <h3>5</h3>
                                <p>Pendientes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sección de actividad reciente -->
<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card activity-card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-history"></i> Actividad Reciente
                </h4>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon usuarios-bg">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Nuevo usuario registrado</h6>
                            <p>Juan Pérez fue añadido al sistema</p>
                            <span class="activity-time">Hace 2 horas</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon docentes-bg">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Actualización de docente</h6>
                            <p>María García actualizó su perfil</p>
                            <span class="activity-time">Hace 5 horas</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon reportes-bg">
                            <i class="mdi mdi-file-chart"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Reporte generado</h6>
                            <p>Reporte mensual de asistencias</p>
                            <span class="activity-time">Hace 1 día</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card quick-actions-card">
            <div class="card-body">
                <h4 class="card-title mb-4">
                    <i class="mdi mdi-lightning-bolt"></i> Acciones Rápidas
                </h4>
                <div class="quick-actions">
                    <a href="<?php echo BASE_URL ?>usuarios/nuevo" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <span>Nuevo Usuario</span>
                    </a>
                    <a href="<?php echo BASE_URL ?>docentes/nuevo" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <span>Registrar Docente</span>
                    </a>
                    <a href="<?php echo BASE_URL ?>reportes/generar" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="mdi mdi-file-chart"></i>
                        </div>
                        <span>Generar Reporte</span>
                    </a>
                    <a href="<?php echo BASE_URL ?>configuracion" class="quick-action-item">
                        <div class="quick-action-icon">
                            <i class="mdi mdi-cog"></i>
                        </div>
                        <span>Configuración</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

<style>
    /* ============================================
   ESTILOS PARA DASHBOARD - SISTEMA DE GESTIÓN DE DOCENTES
============================================ */

    /* Cards del Dashboard */
    .dashboard-card {
        position: relative;
        overflow: hidden;
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(63, 81, 181, 0.1) !important;
        transition: all 0.4s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(63, 81, 181, 0.2) !important;
    }

    .dashboard-card:hover::before {
        opacity: 1;
    }

    .card-icon-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .card-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(63, 81, 181, 0.2);
        transition: all 0.3s ease;
    }

    .card-icon i {
        font-size: 2.5rem;
        color: #ffffff;
    }

    .dashboard-card:hover .card-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .usuarios-icon {
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
    }

    .token-icon {
        background: linear-gradient(135deg, #00897b 0%, #26a69a 100%);
    }

    .docentes-icon {
        background: linear-gradient(135deg, #ff6f00 0%, #ffa726 100%);
    }

    .reportes-icon {
        background: linear-gradient(135deg, #7b1fa2 0%, #9c27b0 100%);
    }

    .card-content {
        text-align: center;
        padding: 0 15px;
    }

    .card-content .card-title {
        color: #1a237e;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #3f51b5 0%, #00897b 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        line-height: 1;
    }

    .card-description {
        color: #455a64;
        font-size: 0.9rem;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .card-footer {
        margin-top: 20px;
    }

    .dashboard-card .btn-primary {
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 12px 20px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(63, 81, 181, 0.3);
    }

    .dashboard-card .btn-primary:hover {
        background: linear-gradient(135deg, #5c6bc0 0%, #7986cb 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(63, 81, 181, 0.4);
    }

    .dashboard-card .btn-primary i {
        margin-right: 8px;
    }

    /* Card de Estadísticas */
    .stats-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(63, 81, 181, 0.1) !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .stats-card .card-title {
        color: #1a237e;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .stats-card .card-title i {
        margin-right: 10px;
        color: #3f51b5;
    }

    .stat-item {
        display: flex;
        align-items: center;
        padding: 20px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        border: 2px solid rgba(63, 81, 181, 0.1);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        border-color: #3f51b5;
        background: rgba(255, 255, 255, 1);
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(63, 81, 181, 0.15);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .stat-icon i {
        font-size: 1.8rem;
        color: #ffffff;
    }

    .stat-content h3 {
        font-size: 2rem;
        font-weight: 800;
        color: #1a237e;
        margin-bottom: 5px;
    }

    .stat-content p {
        color: #455a64;
        font-size: 0.9rem;
        margin: 0;
        font-weight: 600;
    }

    /* Card de Actividad Reciente */
    .activity-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(63, 81, 181, 0.1) !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .activity-card .card-title {
        color: #1a237e;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .activity-card .card-title i {
        margin-right: 10px;
        color: #3f51b5;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        border-left: 4px solid #3f51b5;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(63, 81, 181, 0.15);
    }

    .activity-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .activity-icon i {
        font-size: 1.5rem;
        color: #ffffff;
    }

    .usuarios-bg {
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
    }

    .docentes-bg {
        background: linear-gradient(135deg, #ff6f00 0%, #ffa726 100%);
    }

    .reportes-bg {
        background: linear-gradient(135deg, #00897b 0%, #26a69a 100%);
    }

    .activity-content h6 {
        color: #1a237e;
        font-weight: 700;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .activity-content p {
        color: #455a64;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .activity-time {
        color: #7986cb;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Card de Acciones Rápidas */
    .quick-actions-card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(63, 81, 181, 0.1) !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .quick-actions-card .card-title {
        color: #1a237e;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .quick-actions-card .card-title i {
        margin-right: 10px;
        color: #3f51b5;
    }

    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .quick-action-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        border: 2px solid rgba(63, 81, 181, 0.1);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .quick-action-item:hover {
        background: rgba(255, 255, 255, 1);
        border-color: #3f51b5;
        transform: translateX(8px);
        box-shadow: 0 4px 12px rgba(63, 81, 181, 0.2);
        text-decoration: none;
    }

    .quick-action-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .quick-action-icon i {
        font-size: 1.5rem;
        color: #ffffff;
    }

    .quick-action-item span {
        color: #1a237e;
        font-weight: 700;
        font-size: 0.95rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-number {
            font-size: 2.5rem;
        }

        .stat-item {
            margin-bottom: 15px;
        }

        .activity-item {
            flex-direction: column;
        }

        .activity-icon {
            margin-bottom: 10px;
        }
    }
</style>