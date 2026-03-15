<!DOCTYPE html>
<html lang="es" ng-app="zanitiApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zaniti - Gestión de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard-style.css') }}">
    <style>
        /* --- DISEÑO DE GRID Y CARDS --- */
        .client-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); 
            gap: 20px; 
            margin-top: 20px; 
        }

        .client-card { 
            background: white; 
            border-radius: 20px; 
            padding: 25px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.02); 
            border: 1px solid #f1f5f9; 
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .client-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }

        .client-header { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        
        .client-icon { 
            width: 50px; height: 50px; border-radius: 12px; 
            background: #e0f7fa; color: var(--zaniti-cyan); 
            display: flex; align-items: center; justify-content: center; font-size: 1.2rem; 
        }

        .client-info p { 
            font-size: 0.9rem; color: var(--text-gray); 
            margin: 10px 0; display: flex; align-items: center; gap: 10px; 
        }

        .client-info i { color: var(--zaniti-cyan); width: 18px; text-align: center; }

        .client-stats { 
            display: flex; justify-content: space-between; 
            margin-top: 20px; padding-top: 15px; 
            border-top: 1px solid #f8fafc; font-size: 0.8rem; 
        }

        .client-stats span { display: block; color: var(--text-gray); margin-bottom: 3px; }
        .client-stats strong { color: var(--text-dark); font-size: 0.95rem; }

        /* --- BUSCADOR Y TABS --- */
        .search-box-container { margin: 20px 0; width: 100%; }
        .search-input-group { position: relative; display: flex; align-items: center; }
        .search-input-group i { position: absolute; left: 15px; color: #94a3b8; }
        .search-input { 
            width: 100%; padding: 12px 15px 12px 45px; border: 1px solid #e2e8f0; 
            border-radius: 12px; background: #f8fafc; outline: none; font-size: 0.95rem; 
            transition: 0.3s;
        }
        .search-input:focus { border-color: var(--zaniti-cyan); background: white; box-shadow: 0 4px 6px -1px rgba(0, 188, 212, 0.1); }

        .filter-tabs { display: flex; gap: 12px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px; }
        .tab { 
            padding: 10px 20px; border-radius: 25px; background: white; 
            cursor: pointer; font-size: 0.85rem; font-weight: 600; 
            color: var(--text-gray); border: 1px solid #e2e8f0; transition: 0.3s; 
            white-space: nowrap; 
        }
        .tab.active { background: var(--zaniti-cyan); color: white; border-color: var(--zaniti-cyan); }

        /* --- MODAL CENTRADO --- */
        .modal-overlay { 
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); 
            display: flex !important; justify-content: center !important; align-items: center !important; 
            z-index: 3000; padding: 20px; 
        }

        .modal-content { 
            background: white; padding: 35px; border-radius: 24px; 
            width: 100%; max-width: 550px; 
            max-height: 90vh; overflow-y: auto; 
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
            margin: 0 !important; position: relative; left: auto !important; right: auto !important;
        }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { margin-bottom: 18px; display: flex; flex-direction: column; }
        .form-group label { font-size: 0.85rem; color: #64748b; margin-bottom: 8px; font-weight: 600; text-align: left; }
        .form-control { 
            padding: 12px; border: 1px solid #e2e8f0; border-radius: 12px; 
            background: #f8fafc; outline: none; transition: 0.3s; font-size: 0.95rem;
        }
        .form-control:focus { border-color: var(--zaniti-cyan); background: white; box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.1); }
        .input-otro { margin-top: 10px; border-left: 3px solid var(--zaniti-cyan) !important; }

        .modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; }
        .btn-save { background: var(--zaniti-cyan); color: white; border: none; padding: 12px 28px; border-radius: 12px; cursor: pointer; font-weight: 700; }
        .btn-cancel { background: #f1f5f9; color: #64748b; border: none; padding: 12px 28px; border-radius: 12px; cursor: pointer; font-weight: 600; }

        /* --- BADGES --- */
        .badge-completado { background: #c6f6d5; color: #2f855a; padding: 5px 12px; border-radius: 15px; font-size: 0.75rem; font-weight: 700; }
        .badge-pendiente { background: #fed7d7; color: #c53030; padding: 5px 12px; border-radius: 15px; font-size: 0.75rem; font-weight: 700; }

        @media (max-width: 600px) {
            .client-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .modal-actions { flex-direction: column-reverse; }
            .modal-actions button { width: 100%; }
            .header { flex-direction: column; align-items: flex-start; gap: 15px; }
        }
    </style>
</head>
<body ng-controller="ClientesController">

    @include('layouts.sidebar')

    <main class="main-content">
        <button class="menu-toggle open-menu" ng-click="menuAbierto = true">
            <i class="fas fa-bars"></i>
        </button>

        <header class="header">
            <div>
                <h1>Directorio de Clientes</h1>
                <p>Gestión centralizada de contactos Zaniti</p>
            </div>
            <button class="nav-item active" ng-click="abrirModal()" style="border:none; cursor:pointer; padding: 12px 25px; border-radius:12px; font-weight: 600;">
                <i class="fas fa-plus-circle"></i> Agregar Cliente
            </button>
        </header>

        <section class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info"><span>Total General</span><h2>@{{ clientes.length }}</h2></div>
                <div class="icon-box cyan"><i class="fas fa-users"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Clientes Activos</span><h2 style="color: #48bb78;">@{{ (clientes | filter:{estado:'Activo'}).length }}</h2></div>
                <div class="icon-box green"><i class="fas fa-user-check"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Segmento Residencial</span><h2>@{{ (clientes | filter:{tipo:'Residencial'}).length }}</h2></div>
                <div class="icon-box orange"><i class="fas fa-home"></i></div>
            </div>
        </section>

        <div class="search-box-container">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" ng-model="busqueda" placeholder="Buscar por nombre, correo, teléfono o dirección..." class="search-input">
            </div>
        </div>

        <div class="filter-tabs">
            <button class="tab" ng-class="{'active': filtroTipo == ''}" ng-click="filtroTipo = ''">Todos (@{{clientes.length}})</button>
            <button class="tab" ng-class="{'active': filtroTipo == 'Activo'}" ng-click="filtroTipo = 'Activo'">Activos</button>
            <button class="tab" ng-class="{'active': filtroTipo == 'Residencial'}" ng-click="filtroTipo = 'Residencial'">Residencial</button>
            <button class="tab" ng-class="{'active': filtroTipo == 'Comercial'}" ng-click="filtroTipo = 'Comercial'">Comercial</button>
        </div>

        <div class="client-grid">
            <div class="client-card" ng-repeat="c in clientes | filter:busqueda | filter:filtroTipo">
                <span class="badge" ng-class="c.estado == 'Activo' ? 'badge-completado' : 'badge-pendiente'" style="position:absolute; right:20px; top:20px;">
                    @{{c.estado}}
                </span>
                <div class="client-header">
                    <div class="client-icon">
                        <i class="fas" ng-class="c.tipo == 'Comercial' ? 'fa-building' : 'fa-home'"></i>
                    </div>
                    <div>
                        <h3 style="margin:0; font-size: 1.15rem; color: var(--text-dark);">@{{c.nombre}}</h3>
                        <span style="font-size: 0.75rem; color: var(--text-gray); font-weight: 700; text-transform: uppercase;">@{{c.tipo}}</span>
                    </div>
                </div>
                
                <div class="client-info">
                    <p><i class="fas fa-envelope"></i> @{{c.email || 'No registrado'}}</p>
                    <p><i class="fas fa-phone"></i> @{{c.telefono}}</p>
                    <p><i class="fas fa-map-marker-alt"></i> @{{c.direccion}}</p>
                </div>

                <div class="client-stats">
                    <div><span>Servicios</span><strong>@{{c.servicios_realizados || 0}}</strong></div>
                    <div style="text-align:right;"><span>Última Visita</span><strong>@{{c.ultimo_servicio || 'Nunca'}}</strong></div>
                </div>

                <div style="margin-top: 20px; display: flex; gap: 15px; border-top: 1px solid #f8fafc; padding-top: 15px;">
                    <button ng-click="editarCliente(c)" style="background:none; border:none; color:var(--text-gray); cursor:pointer; font-weight:600; font-size: 0.85rem;"><i class="fas fa-edit"></i> Editar</button>
                    <button ng-click="eliminarCliente(c.id)" style="background:none; border:none; color:#e53e3e; cursor:pointer; font-weight:600; font-size: 0.85rem;"><i class="fas fa-trash"></i> Eliminar</button>
                </div>
            </div>
        </div>

        <div ng-if="(clientes | filter:busqueda | filter:filtroTipo).length == 0" style="text-align:center; padding: 80px; color: var(--text-gray);">
            <i class="fas fa-user-slash" style="font-size: 3rem; opacity: 0.3; margin-bottom: 15px;"></i>
            <p>No se encontraron clientes con esos criterios.</p>
        </div>
    </main>

    <div class="modal-overlay" ng-if="mostrarModal" ng-click="cerrarModal()">
        <div class="modal-content" ng-click="$event.stopPropagation()">
            <div class="modal-header">
                <h2 style="margin:0;">@{{ editando ? 'Actualizar Cliente' : 'Nuevo Registro' }}</h2>
                <button ng-click="cerrarModal()" style="background:none; border:none; font-size:1.8rem; color:#94a3b8; cursor:pointer;">&times;</button>
            </div>
            
            <div style="margin-top: 25px;">
                <div class="form-group">
                    <label>Nombre Completo / Razón Social</label>
                    <input type="text" ng-model="nuevoCliente.nombre" class="form-control" placeholder="Ej. Juan Pérez o Empresa S.A.">
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label>Tipo de Cliente</label>
                        <select ng-model="nuevoCliente.tipo" class="form-control">
                            <option value="Residencial">Residencial</option>
                            <option value="Comercial">Comercial</option>
                            <option value="Otro">Otro (Especificar)</option>
                        </select>
                        <input type="text" ng-if="nuevoCliente.tipo === 'Otro'" ng-model="nuevoCliente.tipo_otro" class="form-control input-otro" placeholder="¿Qué tipo es?">
                    </div>
                    <div class="form-group">
                            <label>Teléfono (10 dígitos):</label>
                            <input type="tel" 
                                class="form-control" 
                                ng-model="nuevoCliente.telefono" 
                                maxlength="10" 
                                minlength="10" 
                                placeholder="Ej: 5512345678"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                </div>

                <div class="form-group">
    <label>Correo Electrónico (Opcional):</label>
    <input type="email" 
           name="correo"
           class="form-control" 
           ng-model="nuevoCliente.email" 
           placeholder="ejemplo@correo.com">
    
    <small class="text-danger" ng-show="clienteForm.correo.$invalid && clienteForm.correo.$dirty">
        Por favor, ingresa un correo válido.
    </small>
</div>

                <div class="form-group">
                    <label>Dirección de Servicio</label>
                    <input type="text" ng-model="nuevoCliente.direccion" class="form-control" placeholder="Calle, Número, Colonia...">
                </div>

                <div class="form-group" ng-if="editando">
                    <label>Estado del Cliente</label>
                    <select ng-model="nuevoCliente.estado" class="form-control">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn-cancel" ng-click="cerrarModal()">Descartar</button>
<button class="btn-save" ng-click="guardarCliente()" ng-disabled="guardando">
    <i class="fas" ng-class="guardando ? 'fa-spinner fa-spin' : 'fa-save'"></i> 
    @{{ guardando ? 'Guardando...' : (editando ? 'Guardar Cambios' : 'Registrar Cliente') }}
</button>            </div>
        </div>
    </div>

    <script src="{{ asset('js/lib/angular.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/controllers/ClientesController.js') }}"></script>
</body>
</html>