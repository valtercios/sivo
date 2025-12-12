@extends('layout.app')

@section('title')
    <h3>Laudos</h3>
    <p class="text-subtitle text-muted">Gerenciamento de laudos do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Laudos
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de laudos</h4>
            @can('laudos_create')
            <a href="{{ route('laudos.selecionar-corpo') }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-plus"></i> Novo laudo</a>
            @endcan
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('laudos.index') }}">
                <div class="col-md-8">
                    <input 
                        type="text" 
                        name="nomeCorpo"
                        class="flex-grow border border-gray-300 rounded-l-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-100"
                        placeholder="Pesquisar por nome do corpo"
                        value="{{ request()->get('nomeCorpo') ?? '' }}">
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
                        <th>{!! sortLink('Nome do corpo', 'corpo_nome') !!}</th>
                        <th>{!! sortLink('RG', 'corpo_rg') !!}</th>
                        <th>{!! sortLink('CPF', 'corpo_cpf') !!}</th>
                        <th>{!! sortLink('Inserido às', 'created_at') !!}</th>
                        <th>{!! sortLink('Status', 'status') !!}</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laudos as $laudo)
                        <tr>
                            <td>
                                {{ $laudo->id ?? ' - '}}
                            </td>
                            <td>
                                <span>{{ $laudo->corpo->nome ?? ' - ' }} </span>
                            </td>
                            <td>
                                <span>{{ $laudo->corpo->rg ?? 'Não possui' }} </span>
                            </td>
                            <td class="text-nowrap">
                                <span> {{ $laudo->corpo->cpf ?? 'Não possui' }} </span>
                            </td>
                            <td class="text-center text-nowrap">
                                <span> {{ \Carbon\Carbon::parse($laudo->created_at)->format('d/m/Y H:i:s') }} </span>
                            </td>
                            <td>
                                @if($laudo->corpo->status == 7)
                                    <span class="badge bg-{{ $laudo->corpo->corpoStatus->tipo }}" style="{{ $laudo->corpo->corpoStatus->tipo }}">{{ $laudo->corpo->corpoStatus->descricao }}</span>
                                @elseif($laudo->corpo->status == 9)
                                    <span class="badge bg-{{ $laudo->corpo->corpoStatus->tipo }}" style="{{ $laudo->corpo->corpoStatus->tipo }}">{{ $laudo->corpo->corpoStatus->descricao }}</span>
                                    
                                @elseif(isset($laudo->status))
                                    <span class="badge bg-{{ $laudo->laudoStatus->tipo }}" style="{{ $laudo->laudoStatus->tipo == "warning" ? "color: black;" : "" }}">{{ $laudo->laudoStatus->descricao }}</span>
                                @else
                                    <span class="badge bg-success">Informações preenchidas</span>
                                @endif
                            </td>
                            <td class="text-center text-nowrap">
                                @if($laudo->medico != null)
                                    <a href="{{ route('laudos.edit', $laudo->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Editar laudo"
                                        class="btn btn-sm icon icon-left btn-secondary"><i class="bi bi-pencil"></i></a>
                                @endif
                                <a href="{{ route('laudos.show', ['id' => $laudo->id]) }}"
                                    class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-search"></i> Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $laudos->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $laudos->total() }}</strong> {{ $laudos->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection
