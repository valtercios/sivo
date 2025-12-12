 @props(['active', 'icon', 'route', 'name'])

@php
$classes = ($active ?? false)
            ? 'sidebar-item  active'
            : 'sidebar-item';
$rotas = explode('.', $route);
$rotas = $rotas[0];
@endphp
<li class="sidebar-item {{ preg_match('/\b('. $rotas . ')\b/',\Request::route()->getName()) ? 'active' : '' }}">
    <a href="{{ route($route ?? '/') }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
</li>
