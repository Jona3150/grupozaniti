<button class="menu-toggle open-menu" ng-click="menuAbierto = true">
    <i class="fas fa-bars"></i>
</button>

<aside class="sidebar" ng-class="{'active': menuAbierto}">
    <button class="menu-toggle close-menu" ng-click="menuAbierto = false">
        <i class="fas fa-times"></i>
    </button>

    <div class="sidebar-logo">
        <img src="{{ asset('img/logobg.png') }}" alt="Logo Zaniti">
    </div>
    
    <div class="sidebar-title">PANEL DE ADMINISTRACIÓN</div>

    <nav class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="/inventario" class="nav-item {{ Request::is('inventario') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Inventario
        </a>
        <a href="/calendario" class="nav-item {{ Request::is('calendario') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Calendario
        </a>
        <a href="/clientes" class="nav-item {{ Request::is('clientes') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Clientes
        </a>
        <!-- <a href="{{ route('perfil') }}" class="nav-item {{ Request::is('perfil') ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i> Perfil
        </a> -->
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit" class="logout-link">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </button>
        </form>
    </div>
</aside>

<div class="sidebar-overlay" ng-if="menuAbierto" ng-click="menuAbierto = false"></div>