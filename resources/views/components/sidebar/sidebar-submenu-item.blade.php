@props(['active', 'icon', 'route', 'name'])

@php
$classes = ($active ?? false)
            ? 'sidebar-item  active'
            : 'sidebar-item';

@endphp
<li class="submenu-item {{ Request::route()->getName() == $route ? 'active' : '' }}">
    <a href="{{ route($route ?? '/') }}" >
        <i class="{{ $icon }}"></i>
        <span>{{ $name }}</span>
    </a>
</li>
