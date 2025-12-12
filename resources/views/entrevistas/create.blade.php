@extends('layout.app')

@section('title')
    <h3>Entrevistas</h3>
    <p class="text-subtitle text-muted">Gerenciamento de entrevistas do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('entrevistas.index') }}">Entrevistas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nova entrevista
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <style>
        .choices{
            margin-bottom: 2px !important;
        }
    </style>
    <form action="{{ route('entrevistas.store') }}" class="validar-form" novalidate method="POST">
        @method('post')
        @csrf
        @include('entrevistas.formCria')

        <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
        <input type="hidden" name="entrevistado_por" value="{{ auth()->user()->id }}">
        <input type="hidden" name="obito_fetal"
            value="{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->type != 'ano' ? '1' : '0' }}">
        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('entrevistas.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" class="btn btn-primary me-1 mb-1 ">Confirmar</button>

        </div>
    </form>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    @include('entrevistas.partials.modal.modal-pesquisa-ocupacao')
@endsection

@section('js')
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>
    <script src="{{ asset('js/entrevistas/main.js') }}"></script>
    <script>
        let initChoice = [];
    </script>
    @if(calcularIdade($corpo->data_nascimento, $corpo->data_obito)->type == 'ano' && $corpo->natimorto == 0)
        <script>
            initChoice['ocupacao_corpo'] = new Choices(document.getElementById('ocupacao_corpo'), {
                removeItemButton: true
            });
        </script>
    @else
        <script>
            initChoice['ocupacao_mae_id'] = new Choices(document.getElementById('ocupacao_mae_id'), {
                removeItemButton: true
            });
        </script>
    @endif
    <script>
        let rgNumero = "{{ $corpo->rg ?? '0' }}";
        let selectDocumento = document.querySelector('#documento_identificacao');
        let numeroDocumento = document.querySelector('#num_documento');
        if(rgNumero != '0'){
            selectDocumento.value = 'RG';
            numeroDocumento.disabled = true;
            numeroDocumento.value = rgNumero;
        }
        $('#documento_identificacao').on('change', function(){
            let valorSelect = $(this).val();
            if(rgNumero != '0' && valorSelect == "RG"){
                numeroDocumento.disabled = true;
                selectDocumento.value = 'RG';
                numeroDocumento.value = rgNumero;
            }else{
                numeroDocumento.disabled = false;
                numeroDocumento.value = "";
            }
        });

        
    </script>
@endsection
