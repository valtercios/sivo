<ul class="menu">
    <li class="sidebar-title">Menu</li>
    <x-sidebar.sidebar-item name="Dashboard" route="dashboard.index" icon="bi bi-grid-fill"></x-sidebar.sidebar-item>
</ul>

<ul class="menu">

    <li class="sidebar-title">{{ Auth::user()->roles->pluck('name')[0] }}</li>
    @can('corpos_view')
        <x-sidebar.sidebar-item name="Corpos" route="corpos.index" icon="bi bi-person-rolodex" />
    @endcan
    @can('funerarias_view')
        <x-sidebar.sidebar-item name="Funerárias" route="funerarias.index" icon="bi bi-grid-fill" />
    @endcan
    @can('responsaveis_view')
        <x-sidebar.sidebar-item name="Responsáveis" route="responsaveis.index" icon="bi bi-file-person-fill" />
    @endcan
    @can('entrevistas_view')
        <x-sidebar.sidebar-item name="Entrevistas" route="entrevistas.index" icon="bi bi-clipboard2" />
    @endcan
    @can('laudos_view')
        <x-sidebar.sidebar-item name="Laudos" route="laudos.index" icon="bi bi-folder-fill" />
    @endcan
    @can('exames_view')
        <x-sidebar.sidebar-item name="Exames" route="exames.index" icon="bi bi-clipboard2-pulse" />
    @endcan
    <x-sidebar.sidebar-submenu title="Documentos" icon="bi bi-archive-fill" active="documentos">
        @can('documentos_recepcao_view')
            <x-sidebar.sidebar-submenu-item name="Recepção" route="documentos_recepcao.index" icon="bi bi-folder-fill" />
        @endcan
        @can('documentos_servico_social_view')
            <x-sidebar.sidebar-submenu-item name="Serviço Social" route="documentos_servico_social.index"
                icon="bi bi-folder-fill" />
        @endcan
        @can('documentos_medico_view')
            <x-sidebar.sidebar-submenu-item name="Médico" route="documentos_medico.index" icon="bi bi-folder-fill" />
        @endcan
    </x-sidebar.sidebar-submenu>
</ul>

<ul class="menu">
    @if (Gate::check('usuarios_view') || Gate::check('audits'))
        <li class="sidebar-title">Administração</li>
    @endif
    @can('usuarios_view')
        <x-sidebar.sidebar-item name="Gerenciar usuários" route="usuarios.index" icon="bi bi-people-fill" />
    @endcan
    @can('relatorios_view')
        <x-sidebar.sidebar-submenu title="Relatórios" icon="bi bi-clipboard2-data" active="relatorios">
            @can('relatorios_view')
                <x-sidebar.sidebar-submenu-item name="Relatório Geral" route="relatorios.index"
                    icon="bi bi-file-earmark-bar-graph" />
            @endcan
            @can('relatorios_view')
                <x-sidebar.sidebar-submenu-item name="Relatório Obitos Fetais" route="relatorios.obitos-fetais"
                    icon="bi bi-file-earmark-bar-graph" />
                @endcan @can('relatorios_view')
                <x-sidebar.sidebar-submenu-item name="Relatório Obitos Funerarias" route="relatorios.obitos-funerarias"
                    icon="bi bi-file-earmark-bar-graph" />
            @endcan

        </x-sidebar.sidebar-submenu>
    @endcan
    @can('audits')
        <x-sidebar.sidebar-item name="Auditoria" route="auditoria.logs" icon="bi bi-eye-fill" />
    @endcan
</ul>

<ul class="menu">
    <li class="sidebar-title">Configurações</li>
    <x-sidebar.sidebar-item name="Perfil" route="perfil.index" icon="bi bi-person-fill" />
    <x-sidebar.sidebar-item name="Alterar senha" route="alterarsenha" icon="bi bi-lock-fill " />
    <li class="sidebar-item">
        <form action="{{ route('logout2') }}" method="post" id="sair-form">
            @csrf
            <a href="javascript:document.getElementById('sair-form').submit();" class='sidebar-link'>
                <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                <span>Sair</span>
            </a>
        </form>

    </li>
</ul>
