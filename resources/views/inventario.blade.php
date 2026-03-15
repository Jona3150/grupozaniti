<!DOCTYPE html>
<html lang="es" ng-app="zanitiApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zaniti - Control de Inventario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard-style.css') }}">
    <style>
        /* Búsqueda responsiva */
        .search-container { margin-bottom: 25px; position: relative; }
        .search-container input {
            width: 100%; padding: 12px 15px 12px 40px; border-radius: 12px;
            border: 1px solid #e2e8f0; background: #f8fafc; font-size: 0.95rem;
        }
        .search-container i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        
        /* Tabla con scroll horizontal en móviles */
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: 12px; }
        .zaniti-table { width: 100%; min-width: 850px; border-collapse: collapse; }
        .zaniti-table th { background: #fdfdfd; padding: 18px 15px; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #edf2f7; }
        .zaniti-table td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #f7fafc; }

        /* Modal Mejorado */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);
            display: flex; justify-content: center; align-items: center; z-index: 2000; padding: 20px;
        }
        .modal-content {
            background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 600px;
            max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); position: relative;
        }
        .modal-header { display: flex; justify-content: space-between; margin-bottom: 25px; align-items: center; }
        .modal-header h2 { font-size: 1.4rem; color: #1e293b; margin: 0; font-weight: 700; }
        
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; position: relative; }
        .form-group label { font-size: 0.85rem; color: #64748b; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group select { padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; outline: none; font-size: 0.95rem; background: #f8fafc; transition: 0.3s; }
        .form-group input:focus { border-color: var(--zaniti-cyan); background: white; }

        /* Pistas de autocompletado */
        .autocomplete-hint { font-size: 0.7rem; color: var(--zaniti-cyan); margin-top: 4px; font-style: italic; }

        /* Animación para el campo "Otro" */
        .input-otro { margin-top: 10px; border-left: 3px solid var(--zaniti-cyan) !important; animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 650px) {
            .form-grid { grid-template-columns: 1fr; }
            .modal-actions { flex-direction: column-reverse; }
            .modal-actions button { width: 100%; }
            .header { flex-direction: column; align-items: flex-start; gap: 15px; }
        }

        .modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 25px; }
        .btn-save { background: var(--zaniti-cyan); color: white; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-cancel { background: #f1f5f9; color: #64748b; border: none; padding: 12px 25px; border-radius: 10px; cursor: pointer; font-weight: 600; }
        .btn-action { background: none; border: none; cursor: pointer; font-size: 1.1rem; transition: transform 0.2s; padding: 5px; }
        .btn-action:hover { transform: scale(1.2); }
    </style>
</head>
<body ng-controller="InventarioController">

    @include('layouts.sidebar')

    <main class="main-content">
        <button class="menu-toggle open-menu" ng-click="menuAbierto = true">
            <i class="fas fa-bars"></i>
        </button>

        <header class="header">
            <div>
                <h1>Control de Inventario</h1>
                <p>Gestiona productos y químicos de Zaniti</p>
            </div>
            <button class="nav-item active" ng-click="abrirModal()" style="border:none; cursor:pointer; padding: 12px 25px; display: flex; align-items: center; gap: 10px; border-radius: 12px; font-weight: 600;">
                <i class="fas fa-plus"></i> <span>Nuevo Producto</span>
            </button>
        </header>

        <section class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info"><span>Total Productos</span><h2>@{{ productos.length }}</h2></div>
                <div class="icon-box cyan"><i class="fas fa-box"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Stock Bajo</span><h2 style="color: #e53e3e;">@{{ (productos | filter:esStockBajo).length }}</h2></div>
                <div class="icon-box orange" style="background: #fff5f5; color: #e53e3e;"><i class="fas fa-exclamation-triangle"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Valor de Almacén</span><h2>$@{{ calcularValorTotal() | number:2 }}</h2></div>
                <div class="icon-box green"><i class="fas fa-chart-line"></i></div>
            </div>
        </section>

        <section class="card-panel">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" ng-model="busqueda" placeholder="Filtrar por nombre, categoría o proveedor...">
            </div>

            <div class="table-responsive">
                <table class="zaniti-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Precio Unit.</th>
                            <th>Proveedor</th>
                            <th style="text-align: right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="p in productos | filter:busqueda">
                            <td><strong>@{{ p.nombre }}</strong></td>
                            <td style="color: var(--text-gray);">@{{ p.categoria }}</td>
                            <td>@{{ p.cantidad }} @{{ p.unidad_medida }}</td>
                            <td>
                                <span class="badge" ng-class="p.cantidad <= p.stock_minimo ? 'badge-pendiente' : 'badge-completado'">
                                    @{{ p.cantidad <= p.stock_minimo ? 'Reabastecer' : 'Disponible' }}
                                </span>
                            </td>
                            <td>$@{{ p.precio | number:2 }}</td>
                            <td style="color: var(--text-gray);">@{{ p.proveedor }}</td>
                            <td style="text-align: right;">
                                <button class="btn-action" ng-click="editarProducto(p)" title="Editar" style="color: var(--zaniti-cyan); margin-right: 15px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-action" ng-click="eliminarProducto(p.id)" title="Eliminar" style="color: #e53e3e;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <div class="modal-overlay" ng-if="mostrarModal" ng-click="cerrarModal()">
        <div class="modal-content" ng-click="$event.stopPropagation()">
            <div class="modal-header">
                <h2>@{{ editando ? 'Modificar Producto' : 'Registrar Producto' }}</h2>
                <button ng-click="cerrarModal()" style="background:none; border:none; cursor:pointer; font-size:1.5rem; color: #94a3b8;">&times;</button>
            </div>
            
            <div class="form-group">
                <label>Nombre del Producto</label>
                <input type="text" ng-model="nuevoProducto.nombre" placeholder="Ej. Gel Cucarachicida">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Categoría</label>
                    <select ng-model="nuevoProducto.categoria">
                        <option value="Insecticidas">Insecticidas</option>
                        <option value="Raticidas">Raticidas</option>
                        <option value="Desinfectantes">Desinfectantes</option>
                        <option value="Equipos">Equipos/Accesorios</option>
                        <option value="Otro">-- Nueva Categoría --</option>
                    </select>
                    <input type="text" ng-if="nuevoProducto.categoria === 'Otro'" 
                           ng-model="nuevoProducto.categoria_otra" 
                           class="form-control input-otro" 
                           placeholder="Escriba la nueva categoría">
                </div>
                
                <div class="form-group">
                    <label>Proveedor</label>
                    <input type="text" 
                           ng-model="nuevoProducto.proveedor" 
                           ng-dblclick="autocompletarProveedor()" 
                           ng-keydown="$event.keyCode === 9 && autocompletarProveedor()"
                           placeholder="TAB para autocompletar">
                    <span class="autocomplete-hint" ng-if="nuevoProducto.proveedor && !datosLlenos">
                        Pistas disponibles (TAB)
                    </span>
                </div>

                <div class="form-group">
                    <label>Stock Actual</label>
                    <input type="number" ng-model="nuevoProducto.cantidad">
                </div>
                <div class="form-group">
                    <label>Unidad de Medida</label>
                    <input type="text" ng-model="nuevoProducto.unidad_medida" placeholder="Litros, Kg, etc.">
                </div>
                <div class="form-group">
                    <label>Stock Mínimo (Alerta)</label>
                    <input type="number" ng-model="nuevoProducto.stock_minimo">
                </div>
                <div class="form-group">
                    <label>Precio de Compra ($)</label>
                    <input type="number" step="0.01" ng-model="nuevoProducto.precio">
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-cancel" ng-click="cerrarModal()">Cerrar</button>
                <button class="btn-save" ng-click="guardarProducto()" ng-disabled="guardando">
    <i class="fas" ng-class="guardando ? 'fa-spinner fa-spin' : 'fa-save'"></i> 
    @{{ guardando ? 'Guardando...' : (editando ? 'Actualizar Producto' : 'Guardar en Inventario') }}
</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/lib/angular.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/controllers/InventarioController.js') }}"></script>
</body>
</html>