@extends('layout.app')

@section('title')
    <h3>Corpos</h3>
    <p class="text-subtitle text-muted">Gerenciamento dos corpos do SVO</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('corpos.index') }}">Corpos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
    </ol>
@endsection

@section('conteudo')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                aria-controls="home" aria-selected="true">Informações</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Histórico de ações</a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" id="alteracoes-tab" data-bs-toggle="tab" href="#alteracoes" role="tab" aria-controls="alteracoes"
                aria-selected="false">Histórico de alterações</a>
        </li>
        
    </ul>
    <div class="tab-content my-4" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            @if($corpo->digitador_id != null && Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Digitador'))
                @include('corpos.partials.form.show.card-escrivao')
            @endif

            @include('corpos.partials.form.show.card-corpo')

            @include('corpos.partials.form.show.card-obito')

            @if ($corpo->responsavel_entrega_id != null)
                @include('corpos.partials.form.show.card-responsavel-entrega')
            @endif

            @if ($corpo->responsavel_corpo_id != null)
                @include('corpos.partials.form.show.card-responsavel-corpo')
            @endif

            @include('corpos.partials.form.show.card-outros-detalhes')

            @if ($corpo->devolver_corpo !== null)
                @include('corpos.partials.form.show.card-devolver-corpo-info')
            @endif

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('corpos.partials.form.show.card-historico')
        </div>
        <div class="tab-pane fade" id="alteracoes" role="tabpanel" aria-labelledby="alteracoes-tab">
            @include('corpos.partials.form.show.card-historico-alteracoes')
        </div>
    </div>

    @can('corpos_atribuirvo')
        @include('corpos.partials.modal.atribuir-vo')
    @endcan
    @include('corpos.partials.modal.devolver-corpo')
@endsection


@section('js')
    <script>
        function encaminharLiga() {

            let nomeCorpo = "{{ $corpo->nome }}";
            let form = $('#encaminhar-liga-form');

            swal.fire({
                title: "Encaminhar para a LIGA?",
                html: "Tem certeza que deseja encaminhar o corpo de <strong>" + nomeCorpo +
                    "</strong> para a LIGA? Ao confirmar o fluxo do corpo será finalizado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, encaminhar!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    form.submit(); // Success! 
                } else {

                }
            });
        }


        function encaminharItep() {

            let nomeCorpo = "{{ $corpo->nome }}";
            let form = $('#encaminhar-itep-form');

            swal.fire({
                title: "Encaminhar para a ITEP?",
                html: "Tem certeza que deseja encaminhar o corpo de <strong>" + nomeCorpo +
                    "</strong> para a ITEP? Ao confirmar o fluxo do corpo será finalizado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, encaminhar!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    form.submit(); // Success! 
                } else {

                }
            });
        }
    </script>

    <script>
        function devolverCorpo() {
            let nomeCorpo = "{{ $corpo->nome }}";
            let form = $('#devolver-corpo-form');

            swal.fire({
                title: "Devolver corpo?",
                html: "Tem certeza que deseja devolver o corpo de <strong>" + nomeCorpo +
                    "</strong>? Ao confirmar o corpo será devolvido para o responsável!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, devolver!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    $('#modalChoices').modal('show');
                }
            });
        }
    </script>

    <script>
        new Choices('#destino-devolucao', {
            removeItems: true,
            removeItemButton: true,
            searchPlaceholderValue: 'Buscar',
            noResultsText: 'Não encontrado',
            itemSelectText: 'Clique para selecionar',
        });
    </script>
@endsection
