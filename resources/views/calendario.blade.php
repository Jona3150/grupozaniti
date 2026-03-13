<!DOCTYPE html>
<html lang="es" ng-app="zanitiApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zaniti - Calendario de Servicios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard-style.css') }}">
    <style>
        :root { --zaniti-cyan: #00bcd4; --text-dark: #1e293b; --text-gray: #64748b; }
        
        .calendar-container { display: grid; grid-template-columns: 350px 1fr; gap: 25px; margin-top: 25px; }
        .calendar-box, .services-box { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }

        .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; color: var(--text-dark); }
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; text-align: center; }
        .day-name { font-weight: 700; font-size: 0.75rem; color: var(--text-gray); text-transform: uppercase; padding-bottom: 10px; }
        
        .calendar-day { 
            aspect-ratio: 1/1; display: flex; align-items: center; justify-content: center; 
            border-radius: 12px; cursor: pointer; font-size: 1rem; transition: all 0.2s; 
            border: 1px solid #f1f5f9; color: var(--text-dark) !important; font-weight: 600;
            background: #ffffff; position: relative; z-index: 1;
        }
        
        .calendar-day.active { 
            background: var(--zaniti-cyan) !important; 
            color: #ffffff !important; 
            font-weight: 800; 
            box-shadow: 0 4px 10px rgba(0, 188, 212, 0.4); 
            border-color: var(--zaniti-cyan);
        }

        .calendar-day.today { border: 2px solid var(--zaniti-cyan); }

        .service-card { border: 1px solid #f1f5f9; border-radius: 16px; padding: 20px; margin-bottom: 15px; position: relative; }
        .status-badge { position: absolute; top: 20px; right: 20px; padding: 6px 14px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        
        .info-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px; margin-top: 15px; font-size: 0.85rem; color: var(--text-gray); }
        .info-item i { color: var(--zaniti-cyan); margin-right: 8px; }

        /* Modal Responsivo */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); display: flex; justify-content: center; align-items: center; z-index: 2000; padding: 15px; }
        .modal-content { background: white; padding: 30px; border-radius: 24px; width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; position: relative; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; }
        .form-control { padding: 12px; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; outline: none; font-size: 16px; transition: 0.3s; }
        .form-control:focus { border-color: var(--zaniti-cyan); background: white; }
        
        .input-otro { margin-top: 8px; border-left: 3px solid var(--zaniti-cyan) !important; animation: slideDown 0.3s ease; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        .modal-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 25px; }
        .btn-save { background: var(--zaniti-cyan); color: white; border: none; padding: 12px 25px; border-radius: 12px; cursor: pointer; font-weight: 600; }
        .btn-cancel { background: #f1f5f9; color: #64748b; border: none; padding: 12px 25px; border-radius: 12px; cursor: pointer; }

        @media (max-width: 1024px) {
            .calendar-container { grid-template-columns: 1fr; }
            .metrics-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 600px) {
            .metrics-grid { grid-template-columns: 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .modal-actions { flex-direction: column-reverse; }
            .modal-actions button { width: 100%; }
            .status-badge { position: static; display: inline-block; margin-bottom: 10px; }
        }
    </style>
</head>
<body ng-controller="ServicioController">

    @include('layouts.sidebar')

    <main class="main-content">
        <button class="menu-toggle open-menu" ng-click="menuAbierto = true">
            <i class="fas fa-bars"></i>
        </button>

        <header class="header">
            <div>
                <h1>Calendario de Servicios</h1>
                <p>Agenda y gestiona los servicios de fumigación</p>
            </div>
            <button class="btn-save" ng-click="abrirModal()">
                <i class="fas fa-plus"></i> Agendar Servicio
            </button>
        </header>

        <section class="metrics-grid">
            <div class="metric-card">
                <div class="metric-info"><span>Total del Mes</span><h2>@{{ servicios.length }}</h2></div>
                <div class="icon-box cyan"><i class="fas fa-calendar-alt"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Programados</span><h2 style="color: #ecc94b;">@{{ (servicios | filter:{estado:'Programado'}).length }}</h2></div>
                <div class="icon-box orange"><i class="fas fa-clock"></i></div>
            </div>
            <div class="metric-card">
                <div class="metric-info"><span>Completados</span><h2 style="color: #48bb78;">@{{ (servicios | filter:{estado:'Completado'}).length }}</h2></div>
                <div class="icon-box green"><i class="fas fa-check-circle"></i></div>
            </div>
        </section>

        <div class="calendar-container">
            <div class="calendar-box">
                <div class="calendar-header"><h3>Marzo 2026</h3></div>
                <div class="calendar-grid">
                    <div class="day-name" ng-repeat="label in ['Do','Lu','Ma','Mi','Ju','Vi','Sá']">@{{label}}</div>
                    <div class="calendar-day" 
                         ng-repeat="d in [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]"
                         ng-class="{'active': diaSeleccionado == d, 'today': d == diaActual}"
                         ng-click="seleccionarDia(d)">
                        @{{d}}
                    </div>
                </div>
            </div>

            <div class="services-box">
                <h3 style="margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
                    Servicios del @{{diaSeleccionado}} de Marzo
                </h3>
                
                <div ng-repeat="s in serviciosDelDia" class="service-card">
                    <span class="status-badge" ng-style="{
                        'background': s.estado == 'Programado' ? '#fefcbf' : (s.estado == 'En Proceso' ? '#e0f2fe' : (s.estado == 'Completado' ? '#c6f6d5' : '#fed7d7')), 
                        'color': s.estado == 'Programado' ? '#b7791f' : (s.estado == 'En Proceso' ? '#0369a1' : (s.estado == 'Completado' ? '#2f855a' : '#c53030'))
                    }">@{{s.estado}}</span>
                    
                    <h4 style="margin:0 0 5px 0; color: var(--text-dark);">@{{s.cliente}}</h4>
                    <p style="color: var(--zaniti-cyan); font-weight: 700; margin-bottom: 10px; font-size: 0.9rem;">@{{s.tipo_servicio}}</p>
                    
                    <div class="info-row">
                        <div class="info-item"><i class="far fa-clock"></i> @{{s.hora}}</div>
                        <div class="info-item"><i class="fas fa-map-marker-alt"></i> @{{s.direccion}}</div>
                        <div class="info-item"><i class="far fa-user"></i> @{{s.tecnico}}</div>
                    </div>
                    
                    <div style="margin-top: 20px; display: flex; gap: 20px; border-top: 1px solid #f8fafc; padding-top: 15px;">
                        <button ng-click="editarServicio(s)" style="background:none; border:none; color:var(--text-gray); cursor:pointer; font-weight:600;"><i class="fas fa-edit"></i> Editar</button>
                        <button ng-click="eliminarServicio(s.id)" style="background:none; border:none; color:#e53e3e; cursor:pointer; font-weight:600;"><i class="fas fa-trash"></i> Cancelar</button>
                    </div>
                </div>

                <div ng-if="serviciosDelDia.length == 0" style="text-align:center; padding: 60px; color: #94a3b8;">
                    <i class="fas fa-mug-hot" style="font-size: 2rem; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                    Día libre de servicios.
                </div>
            </div>
        </div>
    </main>

    <div class="modal-overlay" ng-if="mostrarModal" ng-click="cerrarModal()">
        <div class="modal-content" ng-click="$event.stopPropagation()">
            <h2 style="margin-top:0; color:var(--text-dark);">@{{ editando ? 'Editar Servicio' : 'Nueva Fumigación' }}</h2>
            
            <div class="form-grid">
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" ng-model="nuevoServicio.fecha" class="form-control">
                </div>
                <div class="form-group">
                    <label>Hora</label>
                    <input type="time" ng-model="nuevoServicio.hora" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label>Nombre del Cliente</label>
                <select ng-model="nuevoServicio.cliente" class="form-control"
                        ng-options="c.nombre as c.nombre for c in clientes">
                    <option value="">-- Seleccionar Cliente --</option>
                </select>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Tipo de Fumigación</label>
                    <select ng-model="nuevoServicio.tipo_servicio" class="form-control">
                        <option value="Fumigación Residencial">Fumigación Residencial</option>
                        <option value="Fumigación Comercial">Fumigación Comercial</option>
                        <option value="Control de Roedores">Control de Roedores</option>
                        <option value="Otro">-- Otro (Especificar) --</option>
                    </select>
                    <input type="text" ng-if="nuevoServicio.tipo_servicio === 'Otro'" 
                           ng-model="nuevoServicio.tipo_otro" 
                           class="form-control input-otro" 
                           placeholder="Escriba el tipo de servicio">
                </div>
                <div class="form-group">
    <label>Técnico Encargado</label>
    <select ng-model="nuevoServicio.tecnico" class="form-control" 
            ng-options="t.name as t.name for t in tecnicos">
        <option value="">-- Seleccionar Técnico --</option>
    </select>
</div>
            </div>

            <div class="form-group">
                <label>Ubicación / Dirección</label>
                <input type="text" ng-model="nuevoServicio.direccion" class="form-control">
            </div>

            <div class="form-group" ng-if="editando">
                <label>Estado del Servicio</label>
                <select ng-model="nuevoServicio.estado" class="form-control">
                    <option value="Programado">Programado</option>
                    <option value="En Proceso">En Proceso</option>
                    <option value="Completado">Completado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>

            <div class="form-group">
                <label>Observaciones</label>
                <textarea ng-model="nuevoServicio.notas" class="form-control" rows="3"></textarea>
            </div>

            <div class="modal-actions">
                <button class="btn-cancel" ng-click="cerrarModal()">Descartar</button>
                <button class="btn-save" ng-click="guardarServicio()">
                    <i class="fas fa-save"></i> @{{ editando ? 'Guardar Cambios' : 'Agendar' }}
                </button>
            </div>
        </div>
    </div>

    

    <script src="{{ asset('js/lib/angular.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/controllers/ServicioController.js') }}"></script>
</body>
</html>