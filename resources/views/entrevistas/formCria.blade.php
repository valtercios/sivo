@include('entrevistas.partials.create.card-corpo')

@if(Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
    @include('components.select-escrivao')
@endif

@include('entrevistas.partials.create.card-corpo-adicionais')

@if(calcularIdade($corpo->data_nascimento, $corpo->data_obito)->type != 'ano' || $corpo->natimorto == 1)
    @include('entrevistas.partials.create.card-obito-fetal')
@endif