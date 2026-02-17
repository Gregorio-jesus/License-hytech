<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('img/sidebar.png') }}" alt="Logo" class="sidebar-logo">
        <div class="sidebar-info">
            <h2 class="sidebar-title">HyTech SaaS</h2>
            <p class="sidebar-subtitle">Servidor</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-btn">
                <img src="{{ asset('img/inicio.png') }}" alt="Inicio" class="nav-icon">
                <span class="nav-text">Inicio</span>
            </a>
        </div>

<!--Icono de Gym-->
<div class="nav-item has-submenu {{ request()->routeIs('gym.*') ? 'open active' : '' }}">
    <div class="nav-item-wrapper">
        <a href="#" class="nav-btn">
            <img src="{{ asset('img/gym.png') }}" alt="gym" class="nav-icon">
            <span class="nav-text">Gym Syfit</span>
        </a>
        <button class="submenu-toggle">
            <img src="{{ asset('img/abajo.png') }}" class="nav-arrow">
        </button>
    </div>
    <div class="nav-submenu">
        <a href="{{ route('gym.create') }}" 
           class="{{ request()->routeIs('gym.create') ? 'active' : '' }}">
           Generar licencia
        </a>
        
        <a href="{{ route('gym.index') }}" 
           class="{{ request()->routeIs('gym.index') ? 'active' : '' }}">
           Listado de licencia
        </a>
    </div>
</div>
        
        <!--Icono de DelishOps-->
        <div class="nav-item has-submenu {{ request()->routeIs('licenses.*') ? 'open active' : '' }}">
            <div class="nav-item-wrapper">
                <a href="#" class="nav-btn">
                    <img src="{{ asset('img/delis.png') }}" alt="Licencias" class="nav-icon">
                    <span class="nav-text">DelishOps</span>
                </a>
            </div>
        </div>

        <div class="nav-item has-submenu {{ request()->routeIs('licenses.*') ? 'open active' : '' }}">
            <div class="nav-item-wrapper">
                <a href="#" class="nav-btn">
                    <img src="{{ asset('img/lavanda.png') }}" alt="Licencias" class="nav-icon">
                    <span class="nav-text">Auto lavado</span>
                </a>
            </div>
        </div>

        <div class="nav-item has-submenu {{ request()->routeIs('licenses.*') ? 'open active' : '' }}">
            <div class="nav-item-wrapper">
                <a href="#" class="nav-btn">
                    <img src="{{ asset('img/reporte.png') }}" alt="Licencias" class="nav-icon">
                    <span class="nav-text">Reportes</span>
                </a>
            </div>
        </div>


    </nav>
</aside>
