<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="w-100 d-flex align-items-end justify-content-end mx-2">
                    <a href="{{ route('sistema.manual') }}" target="_BLANK" class="btn btn-primary"><i class="bi bi-file-earmark-pdf"></i> MANUAL DO SISTEMA</a>
                </div>
                <ul class="navbar-nav ms-auto mb-lg-0">
                    
                    <li class="nav-item dropdown me-3">
                        
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4'></i>
                            <span class="badge rounded-pill badge-notification bg-danger" id="notificationsCountBadge" style="position: absolute; top: 7px; left: 20.5px; font-size: 10px; display:none;"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notificações</h6>
                            </li>
                            <div id="notifications-list">

                            </div>
                            <li>
                                <p class="text-center py-2 mb-0"><a href="{{ route('notificacoes.index') }}">Ver todas as notificações</a></p>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->roles->pluck('name')[0] }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    @if(Auth::user()->image && file_exists(storage_path('app/public/'.Auth::user()->image)))
                                        <img src="{{ baseImage64('storage/'.Auth::user()->image) }}">
                                @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Ola, {{ Auth::user()->name }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('perfil.index') }}"><i class="icon-mid bi bi-person me-2"></i> Meu
                                Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                        <form action="{{ route('logout2') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item" href="#"><i
                                class="icon-mid bi bi-box-arrow-left me-2"></i> Sair</button></li>
                        </form>
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>