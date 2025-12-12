@if($corpo->digitador_id != null && Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
    @include('components.select-escrivao')
@endif

@include('corpos.partials.form.edit.card-corpo')

@include('corpos.partials.form.edit.card-obito')

@include('corpos.partials.form.edit.card-responsavel-entrega')

@if($corpo->responsavel_corpo_id != null)

    @include('corpos.partials.form.edit.card-responsavel-corpo')

@endif

@include('corpos.partials.form.edit.card-outros-detalhes')

