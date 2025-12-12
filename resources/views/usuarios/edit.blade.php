@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar usuário
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">Editar usuário</h4>
            @if($info->id != Auth::user()->id)
                <form action="{{ route('usuarios.resetarsenha') }}" class="d-inline" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $info->id }}">
                    <button type="button" class="btn btn-sm icon btn-primary mx-1" onclick="resetarSenha(this)" style="float:right;"><i class="bi bi-lock-fill"></i> Resetar senha</button>
                </form>
                @else
                <a class="btn btn-sm icon btn-primary mx-1" href="{{ route('alterarsenha') }}" style="float:right;"><i class="bi bi-lock-fill"></i> Alterar senha</a>
            @endif
        </div>
        <div class="card-body">
          <form action="{{ route('usuarios.update', ['id'=>$info->id]) }}" method="POST">
                @method('PUT')
                @csrf
                @include('usuarios.formEdita')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>

                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
@endsection

@section('js')
    <script>
        let choices = document.querySelectorAll('#roles');
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

        function resetarSenha(e) {
            var form = $(e).closest("form");
            var name = $(e).data("name");

            swal.fire({
                title: "Resetar senha?",
                text: "Tem certeza que deseja resetar a senha? A senha será resetada para o padrão de 1 a 8.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, resetar!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    form.submit(); // Success! 
                } else {

                }
            });
        }

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
