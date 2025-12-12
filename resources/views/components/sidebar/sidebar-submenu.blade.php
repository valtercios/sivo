@props(['title', 'icon', 'active']) 
@php

$pattern = '/'. $active . '/';

@endphp


<li class="sidebar-item  has-sub {{ preg_match($pattern,\Request::route()->getName()) ? 'active' : '' }}">
    <a href="#" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <ul class="submenu {{ preg_match($pattern,\Request::route()->getName()) ? 'active' : '' }}">
        {{ $slot }}
    </ul>
</li>