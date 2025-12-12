@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuários inativos
    </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de usuários</h4>
            <a href="{{ route('usuarios.create') }}" class="btn btn-sm icon btn-primary" style="float:right;"><i class="bi bi-plus"></i> Novo usuário</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm icon btn-success mx-2" style="float:right;"><i class="bi bi-person"></i> Usuarios ativos</a>
        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr>
                        <th style="width: 10%; text-align:center">ID</th>
                        <th style="width: 15%; text-align:center">Name</th>
                        <th style="width: 15%; text-align:center">Login</th>
                        <th style="width: 25%; text-align:center">Email</th>
                        <th style="width: 15%; text-align:center">Permissões</th>
                        <th style="width: 5%; text-align:center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($desativados as $user)
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
                                <h6>{{ $user->username }}</h6>

                            </td>
                            <td class="text-center">
                                <div>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $papeis)
                                        <span class="badge bg-success">{{ $papeis }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="project-actions text-center">

                                <div class="buttons" style="display:inline-flex;">
                                    
                                    <form method="POST" action="{{ route('usuarios.ativar') }}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{ $user->id }}">
                                    <button  class="btn btn-sm icon icon-left btn-success" type="submit"><i class="bi bi-check"></i> Ativar</button>
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

</script>

@endsection







