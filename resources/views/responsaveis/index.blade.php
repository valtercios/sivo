@extends('layout.app')

@section('title')
    <h3>Responsáveis</h3>
    <p class="text-subtitle text-muted">Gerenciamento de responsáveis do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Responsáveis
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de responsáveis</h4>
            <a data-bs-toggle="modal"data-bs-target="#filtro-responsaveis" class="btn btn-sm icon btn-primary mx-1"
                style="float:right;"><i class="bi bi-filter"></i> Filtro</a>
            @if (request()->all() != null)
                <a href="{{ route('responsaveis.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
                        class="bi bi-x"></i> Remover filtros</a>
            @endif
            <br>
            <p class="text-subtitle text-muted" style="display: inline-block;">
                @if (request()->all() != null)
                    <strong>
                        Filtrando
                        @if (request()->get('filtroCorpo') != null)
                           corpo de {{ $corpos->find(request()->get('filtroCorpo'))->nome }}
                        @endif
                    </strong>
                @endif
            </p>
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('responsaveis.index') }}">
                <div class="col-md-8">
                    <input 
                        type="text" 
                        name="nome"
                        class="flex-grow border border-gray-300 rounded-l-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-100"
                        placeholder="Pesquisar por nome do responsável"
                        value="{{ request()->get('nome') ?? '' }}">
                </div>
                <div class="col-md-2 p-0 m-0">
                    <button type="submit" class="btn btn-sm icon btn-primary mx-1">Buscar</button>
                </div>
            </form>
        </div> 
        <div class="card-body">
            <table class="table table" id="table1-no-pagination">
                <thead>
                    <tr>
                        <th>{!! sortLink('ID', 'id') !!}</th>
                        <th>{!! sortLink('Nome', 'nome') !!}</th>
                        <th>{!! sortLink('RG', 'rg') !!}</th>
                        <th>{!! sortLink('CPF', 'cpf') !!}</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsaveis as $responsavel)
                        <tr>
                            <td>
                                <span>{{ $responsavel->id }} </span>
                            </td>
                            <td>
                                <span>{{ $responsavel->nome }} </span>
                            </td>
                            <td style="text-align: center">
                                @if($responsavel->rg != null)
                                <span> {{ $responsavel->orgaoEmissor->sigla ?? '' }}{{ $responsavel->estado_rg ? '/' . $responsavel->estado_rg . ' -' : '' }} {{ $responsavel->rg }} </span>
                                @else
                                <span> {{ $responsavel->tipo_documento }}: {{ $responsavel->numero_documento }} </span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                <span> {{ $responsavel->cpf }} </span>
                            </td>
                            <td style="text-align: center">
                                <a href="{{ route('responsaveis.show', ['id' => $responsavel->id]) }}"
                                    class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-search"></i> Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $responsaveis->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $responsaveis->total() }}</strong> {{ $responsaveis->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    @include('responsaveis.partials.modals.filtro-responsaveis')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection
