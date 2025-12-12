@extends('layout.app')

@section('title')
    <h3>Entrevistas</h3>
    <p class="text-subtitle text-muted">Gerenciamento de entrevistas do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('entrevistas.index') }}">Entrevistas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Entrevista
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <style>
        .choices {
            margin-bottom: 2px !important;
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('entrevistas.update') }}" method="POST" id="meuFormulario">
        @method('post')
        @csrf
        <input type="hidden" name="corpo_id" value="{{ $entrevista->corpo->id }}">
        <input type="hidden" name="entrevista_id" value="{{ $entrevista->id }}">
        <input type="hidden" name="endereco_mae_id" value="{{ $entrevista->endereco_mae_id }}">
        @include('entrevistas.formEdita')


        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('entrevistas.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>

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
    @if (calcularIdade($entrevista->corpo->data_nascimento, $entrevista->corpo->data_obito)->type == 'ano')
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
        // Justificativa agora é um campo visível no formulário
        // Nenhuma lógica de modal necessária
    </script>
@endsection
