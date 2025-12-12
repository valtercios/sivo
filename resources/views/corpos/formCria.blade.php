@if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
    @include('components.select-escrivao')
@endif

@include('corpos.partials.form.create.card-corpo')

@include('corpos.partials.form.create.card-obito')

@include('corpos.partials.form.create.card-responsavel-entrega')

@include('corpos.partials.form.create.card-responsavel-corpo')

@include('corpos.partials.form.create.card-responsavel-corpo-adicional')

@include('corpos.partials.form.create.card-outros-detalhes')

