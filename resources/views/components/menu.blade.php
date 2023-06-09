<nav class="navbar navbar-expand-lg navbar-light position-fixed w-100">
    <div class="container-fluid">
        <a class="navbar-brand align-middle d-flex logo-container">
                <button onclick="window.location.href = '{{ route('index') }}'" formaction='index.php' class="btn-inicio" title="Inicio"></button>
                <p class="mt-auto">Jildam</p>
        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse flex-grow-0 w-100 justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex justify-content-end w-100">
                @if (Auth::user())
                    <li class="nav-item mx-auto">
                        <a class="nav-link active px-5" aria-current="page" href="/main" style="color: var(--text-primary-color)">Inicio</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link active px-5" href="/passwords" style="color: var(--text-primary-color)">Gestionar contraseñas</a>
                    </li>
                    <li class="nav-item mx-auto mx-auto">
                        <a class="nav-link active px-5" href="/profile" style="color: var(--text-primary-color)">Perfil</a>
                    </li>
                @endif
                <li class="nav-item">
                    <div class="LogInAccount d-flex justify-content-end" id="LogInSession">
                        <button id="switchTheme" class="darkMode" title="Cambiar a tema claro/oscuro"></button>
                        @if (Auth::user())
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <input type="submit" class="btn-logout me-2" value="">
                            </form>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
