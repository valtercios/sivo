@extends('layout.app')

@section('title')
    <h3>Adicionar responsável pelo corpo</h3>
    <p class="text-subtitle text-muted">Informe os dados do reponsável pelo corpo.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('corpos.index') }}">Corpos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Responsável pelo corpo
        </li>
    </ol>
@endsection

@section('conteudo')

    <form action="{{ route('corpos.responsavelcorpostore') }}" novalidate method="POST" class="needs-validation">
        @method('post')
        @csrf
        <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
        <div class="col-12" id="cadastro-corpo">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dados do responsável pelo corpo</h4>
                    <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Preencha as informações referentes ao médico externo.</p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            @include('corpos.partials.form.create.partials.responsavel-corpo-dados-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <a href="{{ route('corpos.show',  $corpo->id) }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
            <button type="submit" id="cadastrar-responsavel" class="btn btn-primary me-1 mb-1 ">Salvar</button>
        </div>
    </form>
    @include('utils.modals.modal-pesquisa-cep-endereco')
@endsection

@section('js')
    <script src="{{ asset('js/corpos/cadastro.js') }}"></script>
    @include('utils.choices')

    <script>
        $('input').keyup(function(){
            $(this).val($(this).val().toUpperCase());
        });
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                flasher.error("Preencha todos os campos obrigatórios!");
                $('html, body').animate({
                    scrollTop: 0
                }, 200);
                }else{
                    $('#cadastrar-responsavel').prop('disabled', 'true');
                }
                
                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
    
@endsection