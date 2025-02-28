<aside id="sidebar">
    <div class="toggle-area">
        <button class="toggle-btn" type="button">
            <i class="lni lni-menu"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#">
                <img src="{{ asset('images/uniciwhite.png') }}" alt="Logo" class="logo-img">
            </a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenuFacturas">
                <i class="lni lni-home"></i>
                <span>Facturas</span>
            </a>
            <ul id="submenuFacturas" class="sidebar-dropdown collapse">
                <li><a href="{{ route('facturas.index') }}" class="sidebar-link">Registrar factura</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu2">
                <i class="bi bi-cash"></i>
                <span>Conceptos de pago</span>
            </a>
            <ul id="submenu2" class="sidebar-dropdown collapse">
                <li><a href="{{ route('conceptos.index') }}" class="sidebar-link">Registrar concepto de pago</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu3">
                <i class="lni lni-wallet"></i>
                <span>Cuentas Bancarias</span>
            </a>
            <ul id="submenu3" class="sidebar-dropdown collapse">
                <li><a href="{{ route('bancos.index') }}" class="sidebar-link">Registrar cuenta bancaria</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('docentes.index') }}" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu4">
                <i class="lni lni-user"></i>
                <span>Docentes</span>
            </a>
            <ul id="submenu4" class="sidebar-dropdown collapse">
                <li><a href="{{ route('docentes.index') }}" class="sidebar-link">Registrar docente</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu5">
                <i class="lni lni-bar-chart"></i>
                <span>Reportes con filtro</span>
            </a>
            <ul id="submenu5" class="sidebar-dropdown collapse">
                <li><a href="{{ route('filtered-factures.index')}}" class="sidebar-link">Generar reporte</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu6">
                <i class="lni lni-calendar"></i>
                <span>Calendario de egresos</span>
            </a>
            <ul id="submenu6" class="sidebar-dropdown collapse">
                <li><a href="#" class="sidebar-link">Ver calendario</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="{{ route('periodos.index') }}" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu7">
                <i class="bi bi-calendar"></i>
                <span>Periodos de Pago</span>
            </a>
            <ul id="submenu7" class="sidebar-dropdown collapse">
                <li><a href="{{ route('periodos.index') }}" class="sidebar-link">Registrar periodo de pago</a></li>
            </ul>
        </li>

        @if(auth()->user()->rol->rol == 'admin')
        <li class="sidebar-item">
            <a href="{{ route('usuarios.index') }}" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#submenu8">
                <i class="lni lni-users"></i>
                    <span>Usuarios</span>
            </a>
        <ul id="submenu8" class="sidebar-dropdown collapse">
        <li><a href="{{ route('usuarios.index') }}" class="sidebar-link">Usuarios registrados</a></li>
        </ul>
        </li>
        @endif

        <li class="sidebar-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-link logout w-100">
                    <i class="lni lni-exit"></i>
                    <span>Salir</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
