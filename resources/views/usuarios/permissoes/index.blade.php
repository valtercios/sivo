@extends('layout.app')

@section('title')
    <h3>Usuários</h3>
    <p class="text-subtitle text-muted">Gerenciamento de usuários</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Permissões
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de permissões</h4>
            {{-- <a class="btn btn-sm icon btn-primary mx-1" data-bs-toggle="modal"data-bs-target="#inlineForm" style="float:right;"><i class="bi bi-plus"></i> Nova permissão</a> --}}
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-arrow-left-short"></i> Voltar</a>
            <a href="{{ route('papeisPermissoes.index') }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-folder"></i> Papéis</a>

        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr >
                        <th style="width: 1%;">
                            #
                        </th>
                        <th>
                            Descrição
                        </th>
                        <th>
                            Permissão
                        </th>
                        

                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissoes as $permissao)
                            <tr >
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $permissao->descricao }}
                                </td>
                                <td>
                                    {{ $permissao->name }}
                                </td>
                                
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- @include('usuarios.permissoes.partials.modal-criar-permissao') --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection






