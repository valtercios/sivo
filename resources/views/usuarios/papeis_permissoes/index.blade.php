@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Papéis
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de papéis</h4>
            @can('papeis_create')
            <a class="btn btn-sm icon btn-primary mx-1" data-bs-toggle="modal"data-bs-target="#cadastrar-papel" style="float:right;"><i class="bi bi-plus"></i> Novo papél</a>
            @endcan
            @can('permissoes_view')
                <a href="{{ route('permissoes.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-person"></i> Permissões</a>
            @endcan
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-arrow-left-short"></i> Voltar</a>

        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Pápeis
                        </th>
                        <th >
                            Permissões
                        </th>
                        <th >
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                            <tr style="font-size:16px">
                                <td >
                                    <span>{{ $role->id }} </span>
                                </td>
                                <td >
                                    <span>{{ $role->name }} </span>
                                </td>
                                <td>
                                    @foreach ($role->permissions as $permissao)
                                        <label class="badge bg-success">{{ $permissao['name'] }} </label>
                                    @endforeach

                                </td>
                                <td>
                                    @can('papeis_edit')
                                        <a href="{{route('papeisPermissoes.edit', ['id'=>$role->id])}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-pencil"></i></a>
                                    @endcan
                                    @can('papeis_delete')
                                    <form method="POST" action="{{ route('papeisPermissoes.destroy') }}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{ $role->id }}">
                                    <button  class="btn btn-sm icon icon-left btn-danger show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir" type="button" onclick="excluirPapel(this)"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
    @can('papeis_create')
        @include('usuarios.papeis_permissoes.partials.modal-criar-papel')
    @endcan
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
        function excluirPapel(e) {
            var form = $(e).closest("form");
            var name = $(e).data("name");

            swal.fire({
                title: "Excluir?",
                text: "Tem certeza que deseja excluir este papel?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    form.submit(); // Success! 
                } else {

                }
            });
        }
    </script>
@endsection






