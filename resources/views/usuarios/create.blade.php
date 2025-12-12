@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo usuário
        </li>
    </ol>
@endsection

@section('conteudo')
    <style>
    .choices{
        height: 38px !important;
    }
    .choices__inner{
        height: 38px !important;
        min-height: 30px !important;
    }
    .choices__item--selectable {
        margin-top: -5px;
    }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar usuário</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @method('post')
                @csrf
                @include('usuarios.formCria')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Cadastrar</button>

                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endsection

@section('js')
    <script>
        let choices = document.querySelectorAll('.choices');
        let initChoice;
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ',',
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                });
            } else {
                initChoice = new Choices(choices[i]);
            }
        }
        $('input[name="cpf"]').mask('000.000.000-00', {reverse: true});

        $('#roles').on('change', function() {
             $("#roles option").each(function(key, item) {
                //regex para remover acentos e espaços

                var regex = /[^0-9a-zA-Z]+/;
                var label = $(item).text().replace(regex, '').toLowerCase();

                if(label == 'medico' || label == 'médico'){

                    $('#crm-field').removeClass('d-none');
                    $('#crm-field').addClass('d-block');
                    $('#crm').prop('disabled', false);
                    return false;
                }else{
                    $('#crm-field').removeClass('d-block');
                    $('#crm-field').addClass('d-none');
                    $('#crm').prop('disabled', true);
                }
            });

        });
    </script>
@endsection
