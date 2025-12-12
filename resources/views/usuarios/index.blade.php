@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Usuários
    </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de usuários</h4>
            <a href="{{ route('usuarios.create') }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-plus"></i> Novo usuário</a>
            @canany(['papeis_view', 'permissoes_view'])
                <div class="dropdown" style="float:right;">
                    <button class="btn btn-sm icon btn-secondary dropdown-toggle me-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-people-fill"></i> Gerência
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                        @can('papeis_view')
                            <a class="dropdown-item" href="{{ route('papeisPermissoes.index') }}">Papéis</a>
                        @endcan
                        @can('permissoes_view')
                            <a class="dropdown-item" href="{{ route('permissoes.index') }}">Lista de permissões</a>
                        @endcan
                    </div>
                </div>
            @endcanany
            

            <a href="{{ route('usuarios.desativados') }}" class="btn btn-sm icon btn-danger mx-2" style="float:right;"><i class="bi bi-archive"></i> Usuarios desativados</a>
        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align:center">ID</th>
                        <th style="width: 15%; text-align:center">Nome</th>
                        <th style="width: 15%; text-align:center">CPF</th>
                        <th style="width: 25%; text-align:center">Email</th>
                        <th style="width: 15%; text-align:center">Permissões</th>
                        <th style="width: 5%; text-align:center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex ">
                                    @if ($user->image != null)
                                    <div class="avatar me-3">
                                        <img src="{{baseImage64('storage/' . $user->image)}}" alt="" srcset="">
                                    </div>
                                    @else
                                    <div class="avatar me-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="" srcset="">
                                    </div>
                                    @endif

                                    <div style="display:inline-flex" >{{ ucfirst($user->name) ?? $user->username }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <h6 class="cpf-field">
                                    {{ $user->cpf }}
                                </h6>
                            </td>
                            <td class="text-center">
                                <div>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if (!empty($user->roles))
                                    @foreach ($user->roles as $role)
                                        <span class="badge bg-success">{{ $role->name }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="project-actions text-center">

                                <div class="buttons" style="display:inline-flex;">
                                    @if($user->id == Auth::user()->id)
                                        <a href="{{ route('perfil.index', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-pencil"></i></a>
                                    @else
                                        <a href="{{ route('usuarios.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-pencil"></i></a>
                                    @endif
                                    @if($user->id != Auth::user()->id)
                                        <form method="POST" action="{{ route('usuarios.destroy') }}">
                                            @csrf
                                            <input name="id" type="hidden" value="{{ $user->id }}">
                                        <button  class="btn btn-sm icon icon-left btn-danger show_confirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Desativar" type="button" onclick="desativarUsuario(this)"><i class="bi bi-trash"></i></button>
                                    @endif
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection

@section('js')

<script>
    function desativarUsuario(e) {
            var form = $(e).closest("form");
            var name = $(e).data("name");

            swal.fire({
                title: "Excluir?",
                text: "Tem certeza que deseja desativar este usuário?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, desativar!',
                cancelButtonText: 'Cancelar',
            }).then(function(value) {
                if (value.isConfirmed) {
                    form.submit(); // Success! 
                } else {

                }
            });
        }
        var tbody = document.querySelector('tbody');
        var previousContent = tbody.children[0].children[0].innerText;
        $('.cpf-field').mask('000.000.000-00', {reverse: true});
        setInterval(function() {
        if (tbody.children[0].children[0].innerText !== previousContent) {
            $('.cpf-field').mask('000.000.000-00', {reverse: true});
            previousContent = tbody.children[0].children[0].innerText;
        }
        }, 1);
</script>

@endsection






