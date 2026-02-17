<header class="header">
    <div class="header-left">
        <button class="menu-toggle" id="menuToggle">
            <img src="{{ asset('img/opciones.png') }}" class="nav-icon">
        </button>
        <h1 class="page-title">
            @if(View::hasSection('page_title'))
                @yield('page_title')
            @else
                @yield('title', 'Inicio')
            @endif
        </h1>
    </div>

    <div class="header-right">
        <div class="profile-wrapper">
            <button class="profile-btn" id="profileBtn">
                <img src="{{ asset('img/colibri.png') }}" alt="Perfil" class="profile-img">
            </button>

            <div class="profile-dropdown" id="profileDropdown">
                <div class="dropdown-header">
                    <div class="header-user-info">
                        <img src="{{ asset('img/colibri.png') }}" class="dropdown-avatar-main">
                        <div class="user-details">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <div class="theme-section">
                    <div class="section-header">
                        <span class="section-title">Tema</span>
                    </div>
                    <div class="theme-buttons">
                        <button class="theme-option" data-theme="light">
                            <span>Light</span>
                        </button>
                        <button class="theme-option" data-theme="dark">
                            <span>Dark</span>
                        </button>
                    </div>
                </div>

                <div class="dropdown-divider"></div>
                
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <img src="{{ asset('img/salir.png') }}" class="logout-icon">
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>