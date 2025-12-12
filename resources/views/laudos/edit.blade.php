@extends('layout.app')

@section('title')
    <h3>Laudos</h3>
    <p class="text-subtitle text-muted">Gerenciamento de laudos do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('laudos.index') }}">Laudos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Laudo
        </li>
    </ol>
@endsection

@section('conteudo')
<link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <form action="{{ route('laudos.update') }}" method="POST" id="form-informacoes-medicas">
        @method('post')
        @csrf
        @include('laudos.formEdita')
        <input type="hidden" name="id_corpo" value="{{ $corpo->id }}">
        <input type="hidden" name="laudo_id" value="{{ $laudo->id }}">
        
        <input type="hidden" name="status_corpo" id="status_corpo" value="5">
        <input type="hidden" name="status_laudo" id="status_laudo" value="1">

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('laudos.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="button" id="edsalvarsemfinalizar" class="btn btn-primary me-1 mb-1 ">Salvar</button>
            <button type="button" id="edsalvarfinalizar" class="btn btn-success me-1 mb-1">Salvar e Finalizar</button>

        </div>
    </form>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    @include('laudos.partials.modals.modal-pesquisa-cid10')
    @endsection

@section('js')
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>

    <script>
        $('#edsalvarfinalizar').on('click', function(e) {
        swal.fire({
            title: "Finalizar laudo",
            text: "Tem certeza que deseja finalizar o laudo? Não tem como voltar atrás.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, finalizar!',
            cancelButtonText: 'Cancelar',
        }).then(function(value) {
            if (value.isConfirmed) {
                let formElement = document.querySelector('#form-informacoes-medicas');                    
                var status_laudo = $('#status_laudo');
                var status_corpo = $('#status_corpo');
                status_corpo.val(6);
                status_laudo.val(2);
                formElement.submit();
                
            }
        });
        });
            $('#edsalvarsemfinalizar').on('click', function(e) {
        swal.fire({
            title: "Salvar laudo sem finalizar",
            text: "Tem certeza que deseja salvar sem finalizar o laudo? .",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim!',
            cancelButtonText: 'Cancelar',
        }).then(function(value) {
            if (value.isConfirmed) {
                var status_corpo = $('#status_corpo');
                var status_laudo = $('#status_laudo');
                let formElement = document.querySelector('#form-informacoes-medicas');
                status_corpo.val(5);
                status_laudo.val(1);
                formElement.submit();
            }
        });
        });
    </script>
@endsection