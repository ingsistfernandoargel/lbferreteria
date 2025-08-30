<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagrama de Componentes - LB Ferretería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .diagram-container {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        .component-section {
            margin-bottom: 40px;
        }
        .component-card {
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        .component-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .admin {
            background-color: #d1e7ff;
            border-left: 5px solid #0d6efd;
        }
        .client {
            background-color: #d4edda;
            border-left: 5px solid #198754;
        }
        .bodega {
            background-color: #f8d7da;
            border-left: 5px solid #dc3545;
        }
        .shared {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
        }
        .component-title {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 15px;
            color: #2c3e50;
            display: flex;
            align-items: center;
        }
        .component-title i {
            margin-right: 10px;
            font-size: 1.4em;
        }
        .component-list {
            list-style-type: none;
            padding-left: 0;
        }
        .component-list li {
            padding: 8px 0;
            border-bottom: 1px dashed rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
        }
        .component-list li:last-child {
            border-bottom: none;
        }
        .component-list i {
            margin-right: 10px;
            color: #6c757d;
        }
        .user-role {
            font-size: 1.5em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d6efd;
            display: flex;
            align-items: center;
        }
        .user-role i {
            margin-right: 15px;
            font-size: 1.8rem;
        }
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            justify-content: center;
        }
        .legend-item {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 10px;
        }
        h3 {
            color: #0a58ca;
            margin-bottom: 25px;
            text-align: center;
        }
        .interaction-arrow {
            text-align: center;
            font-size: 24px;
            color: #6c757d;
            margin: 10px 0;
        }
        .database {
            text-align: center;
            padding: 20px;
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border-radius: 8px;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-project-diagram me-2"></i>Diagrama de Componentes</h1>
            <h2>Sistema de Tienda Virtual - LB Ferretería</h2>
            <p class="mb-0">Proyecto ADSO SENA - Componentes del sistema por tipo de usuario</p>
        </div>

        <div class="diagram-container">
            <h3><i class="fas fa-users-cog me-2"></i>Componentes por Rol de Usuario</h3>
            
            <div class="row">
                <!-- Administrador -->
                <div class="col-md-4">
                    <div class="user-role"><i class="fas fa-user-cog"></i> Administrador</div>
                    <div class="component-card admin">
                        <div class="component-title"><i class="fas fa-tasks"></i> Módulos Principales</div>
                        <ul class="component-list">
                            <li><i class="fas fa-user-friends"></i> Gestionar Usuarios</li>
                            <li><i class="fas fa-boxes"></i> Inventario General</li>
                            <li><i class="fas fa-chart-bar"></i> Reportes de Ventas</li>
                            <li><i class="fas fa-cog"></i> Configuración del Sistema</li>
                        </ul>
                    </div>
                    <div class="component-card admin">
                        <div class="component-title"><i class="fas fa-toolbox"></i> Funcionalidades</div>
                        <ul class="component-list">
                            <li><i class="fas fa-plus-circle"></i> Crear usuarios</li>
                            <li><i class="fas fa-edit"></i> Editar permisos</li>
                            <li><i class="fas fa-trash-alt"></i> Eliminar usuarios</li>
                            <li><i class="fas fa-eye"></i> Ver todos los productos</li>
                            <li><i class="fas fa-file-pdf"></i> Generar reportes PDF</li>
                            <li><i class="fas fa-chart-line"></i> Estadísticas de ventas</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Cliente -->
                <div class="col-md-4">
                    <div class="user-role"><i class="fas fa-user"></i> Cliente</div>
                    <div class="component-card client">
                        <div class="component-title"><i class="fas fa-tasks"></i> Módulos Principales</div>
                        <ul class="component-list">
                            <li><i class="fas fa-shopping-cart"></i> Realizar Compras</li>
                            <li><i class="fas fa-history"></i> Historial de Ventas</li>
                            <li><i class="fas fa-user-circle"></i> Perfil de Usuario</li>
                            <li><i class="fas fa-search"></i> Búsqueda de Productos</li>
                        </ul>
                    </div>
                    <div class="component-card client">
                        <div class="component-title"><i class="fas fa-toolbox"></i> Funcionalidades</div>
                        <ul class="component-list">
                            <li><i class="fas fa-cart-plus"></i> Agregar al carrito</li>
                            <li><i class="fas fa-credit-card"></i> Proceso de pago</li>
                            <li><i class="fas fa-list-alt"></i> Ver pedidos anteriores</li>
                            <li><i class="fas fa-star"></i> Dejar reseñas</li>
                            <li><i class="fas fa-heart"></i> Lista de deseos</li>
                            <li><i class="fas fa-truck"></i> Seguimiento de envíos</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Administrador de Bodega -->
                <div class="col-md-4">
                    <div class="user-role"><i class="fas fa-warehouse"></i> Administrador de Bodega</div>
                    <div class="component-card bodega">
                        <div class="component-title"><i class="fas fa-tasks"></i> Módulos Principales</div>
                        <ul class="component-list">
                            <li><i class="fas fa-box"></i> Gestión de Productos</li>
                            <li><i class="fas fa-warehouse"></i> Control de Inventario</li>
                            <li><i class="fas fa-exchange-alt"></i> Movimientos de Stock</li>
                            <li><i class="fas fa-clipboard-list"></i> Reportes de Bodega</li>
                        </ul>
                    </div>
                    <div class="component-card bodega">
                        <div class="component-title"><i class="fas fa-toolbox"></i> Funcionalidades</div>
                        <ul class="component-list">
                            <li><i class="fas fa-plus-square"></i> Agregar nuevos productos</li>
                            <li><i class="fas fa-edit"></i> Actualizar existencias</li>
                            <li><i class="fas fa-arrow-down"></i> Registrar entradas</li>
                            <li><i class="fas fa-arrow-up"></i> Registrar salidas</li>
                            <li><i class="fas fa-exclamation-triangle"></i> Alertas de stock bajo</li>
                            <li><i class="fas fa-file-excel"></i> Exportar inventario</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="interaction-arrow">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- Componentes Compartidos -->
            <div class="row">
                <div class="col-md-12">
                    <div class="user-role"><i class="fas fa-share-alt"></i> Componentes Compartidos</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="component-card shared">
                                <div class="component-title"><i class="fas fa-sign-in-alt"></i> Autenticación</div>
                                <ul class="component-list">
                                    <li><i class="fas fa-user-plus"></i> Registro</li>
                                    <li><i class="fas fa-key"></i> Inicio de sesión</li>
                                    <li><i class="fas fa-unlock-alt"></i> Recuperar contraseña</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="component-card shared">
                                <div class="component-title"><i class="fas fa-database"></i> Gestión de Datos</div>
                                <ul class="component-list">
                                    <li><i class="fas fa-table"></i> Conexión DB</li>
                                    <li><i class="fas fa-server"></i> Servicios API</li>
                                    <li><i class="fas fa-sync-alt"></i> Sincronización</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="component-card shared">
                                <div class="component-title"><i class="fas fa-bell"></i> Notificaciones</div>
                                <ul class="component-list">
                                    <li><i class="fas fa-envelope"></i> Email</li>
                                    <li><i class="fas fa-bell"></i> Alertas del sistema</li>
                                    <li><i class="fas fa-comment-dots"></i> Mensajes</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="component-card shared">
                                <div class="component-title"><i class="fas fa-shield-alt"></i> Seguridad</div>
                                <ul class="component-list">
                                    <li><i class="fas fa-lock"></i> Control de acceso</li>
                                    <li><i class="fas fa-user-shield"></i> Roles y permisos</li>
                                    <li><i class="fas fa-history"></i> Auditoría</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="interaction-arrow">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- Base de datos -->
            <div class="database">
                <h4><i class="fas fa-database"></i> Base de Datos</h4>
                <div class="row">
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-user fa-2x mb-2"></i>
                            <p>Usuarios</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-box fa-2x mb-2"></i>
                            <p>Productos</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                            <p>Ventas</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-list-alt fa-2x mb-2"></i>
                            <p>Detalles_Venta</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-exchange-alt fa-2x mb-2"></i>
                            <p>Movimiento_Inventario</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-file-invoice fa-2x mb-2"></i>
                            <p>Reportes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Leyenda -->
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #d1e7ff; border-left: 5px solid #0d6efd;"></div>
                    <span>Administrador</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #d4edda; border-left: 5px solid #198754;"></div>
                    <span>Cliente</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #f8d7da; border-left: 5px solid #dc3545;"></div>
                    <span>Administrador de Bodega</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background-color: #fff3cd; border-left: 5px solid #ffc107;"></div>
                    <span>Componentes Compartidos</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>