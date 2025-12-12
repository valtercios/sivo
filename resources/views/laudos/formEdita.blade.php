@include('laudos.partials.edit.card-corpo')

@if($laudo?->digitador_id && (auth()->user()->hasRole('digitador') || auth()->user()->hasRole('Administrador')) )
    
    @include('components.select-escrivao')

@endif

@include('laudos.partials.edit.card-historico')

@include('laudos.partials.edit.card-exame')

@include('laudos.partials.edit.card-atestado-medico')