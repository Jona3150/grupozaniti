<!DOCTYPE html>
<html lang="es" ng-app="zanitiApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaniti - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard-style.css') }}">
    <style>
        /* Estilo del Toast de Bienvenida (Superior Derecho) */
        .welcome-msg {
            position: fixed; top: 20px; right: 20px;
            background: #06261b; color: #4ade80;
            padding: 12px 20px; border-radius: 8px;
            display: flex; align-items: center; gap: 10px;
            font-size: 0.9rem; font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000; animation: fadeInRight 0.5s ease;
        }
        @keyframes fadeInRight { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        /* Contenedores de Resumen */
        .dashboard-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #f1f5f9; }
        .stat-card h2 { font-size: 1.8rem; margin: 5px 0; color: #1e293b; }
        .stat-card span { font-size: 0.85rem; color: #64748b; }
        
        .icon-circle { width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .bg-blue { background: #eff6ff; color: #3b82f6; }
        .bg-green { background: #f0fdf4; color: #22c55e; }
        .bg-purple { background: #faf5ff; color: #a855f7; }
        .bg-orange { background: #fff7ed; color: #f97316; }

        .content-split { display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px; }
        .section-card { background: white; padding: 25px; border-radius: 16px; border: 1px solid #f1f5f9; }
        .item-row { display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #f8fafc; }
        .status-pill { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; background: #fffbeb; color: #b45309; }
        .btn-reabastecer { color: #ef4444; font-size: 0.8rem; font-weight: 700; text-decoration: none; cursor: pointer; }
    </style>
</head>
<body ng-controller="DashboardController">

    @include('layouts.sidebar')

    <div class="welcome-msg" ng-if="mostrarBienvenida">
        <i class="fas fa-check-circle"></i>
        <span>¡Bienvenido {{ Auth::user()->name ?? 'Administrador Zaniti' }}!</span>
    </div>

    <main class="main-content">
        <header style="margin-bottom: 30px;">
            <p style="color: #64748b; margin-bottom: 5px;">Bienvenido, {{ Auth::user()->name ?? 'Administrador Zaniti' }}</p>
            <h1 style="color: #0f172a; font-size: 1.8rem;">Dashboard</h1>
            <p style="color: #64748b;">Resumen general de tu empresa de fumigación</p>
        </header>

        <section class="dashboard-grid">
            <div class="stat-card">
                <div><span>Servicios del Mes</span><h2>@{{stats.servicios_mes}}</h2></div>
                <div class="icon-circle bg-blue"><i class="far fa-calendar-check"></i></div>
            </div>
            <div class="stat-card">
                <div><span>Productos en Stock</span><h2>@{{stats.productos_stock}}</h2><span>@{{stats.productos_bajos}} bajos</span></div>
                <div class="icon-circle bg-green"><i class="fas fa-box"></i></div>
            </div>
            <div class="stat-card">
                <div><span>Clientes Activos</span><h2>@{{stats.clientes_activos}}</h2><span>@{{stats.clientes_totales}} totales</span></div>
                <div class="icon-circle bg-purple"><i class="fas fa-users"></i></div>
            </div>
            <div class="stat-card">
                <div><span>Valor Inventario</span><h2>$@{{stats.valor_inventario | number:0}}</h2><span>@{{stats.total_productos}} productos</span></div>
                <div class="icon-circle bg-orange"><i class="fas fa-chart-line"></i></div>
            </div>
        </section>

        <section class="content-split">
            <div class="section-card">
                <h3 style="margin-bottom: 20px;">Servicios Recientes</h3>
                <div ng-repeat="s in stats.servicios_recientes" class="item-row">
                    <div>
                        <strong style="display: block; color: #1e293b;">@{{s.cliente}}</strong>
                        <span style="font-size: 0.85rem; color: #64748b;">@{{s.tipo_servicio}}</span>
                        <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 4px;">@{{s.fecha}}</div>
                    </div>
                    <span class="status-pill">@{{s.estado}}</span>
                </div>
            </div>

            <div class="section-card">
                <h3 style="margin-bottom: 20px;">Productos con Stock Bajo</h3>
                <div ng-repeat="p in stats.stock_critico" class="item-row">
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <div style="background: #fef2f2; padding: 10px; border-radius: 8px; color: #ef4444;"><i class="fas fa-box"></i></div>
                        <div>
                            <strong style="display: block; font-size: 0.9rem;">@{{p.nombre}}</strong>
                            <span style="font-size: 0.8rem; color: #64748b;">Stock: @{{p.cantidad}} @{{p.unidad_medida}}</span>
                        </div>
                    </div>
                    <a href="/inventario" class="btn-reabastecer">Reabastecer</a>
                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/lib/angular.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/controllers/DashboardController.js') }}"></script>
</body>
</html>