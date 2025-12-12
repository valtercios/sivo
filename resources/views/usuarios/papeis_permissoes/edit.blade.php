@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
        <li class="breadcrumb-item"><a href="{{ route('papeisPermissoes.index') }}">Papéis</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar papél
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">

        
          <form action="{{ route('papeisPermissoes.update') }}" method="POST">
            @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar papél</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="name">Nome do papél</label>
                                <div class="position-relative">
                                    <input type="text" id="name" class="form-control" placeholder="Nome do papél" name="name" value="{{ $info->name ?? '' }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('usuarios.papeis_permissoes.form')

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('papeisPermissoes.index') }}" class="btn btn-light-secondary me-1 mb-1">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Salvar</button>

                </div>
            </form>
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
    </script>
@endsection
