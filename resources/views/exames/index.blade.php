@extends('layout.app')

@section('title')
    <h3>Exames</h3>
    <p class="text-subtitle text-muted">Gerenciamento de exames do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Exames
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de exames</h4>
            <a data-bs-toggle="modal"data-bs-target="#filtro-exames" class="btn btn-sm icon btn-primary mx-1"
                style="float:right;"><i class="bi bi-filter"></i> Filtro</a>
            @can('exames_create')
                <a href="{{ route('exames.create') }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i
                        class="bi bi-plus"></i> Solicitar exame</a>
            @endcan
            @if (request()->all() != null)
                <a href="{{ route('exames.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
                        class="bi bi-x"></i> Remover filtros</a>
            @endif
            <br>
            <p class="text-subtitle text-muted" style="display: inline-block;">
                @if (request()->all() != null)
                    <strong>
                        Filtrando
                        @if (request()->get('dataFinal') != null)
                            de {{ \Carbon\Carbon::parse(request()->get('dataInicial'))->format('d/m/Y') }} a
                            {{ \Carbon\Carbon::parse(request()->get('dataFinal'))->format('d/m/Y') }}
                        @elseif (request()->get('dataInicial') != null)
                            a partir de {{ \Carbon\Carbon::parse(request()->get('dataInicial'))->format('d/m/Y') }}
                        @endif
                        @if (request()->get('filtroStatus'))
                            Status: {{ \App\Models\ExameStatus::find(request()->get('filtroStatus'))->descricao }}
                        @endif
                        @if (request()->get('solicitadosPorMim'))
                            Apenas solicitados por {{ auth()->user()->name }}
                        @endif
                    </strong>
                @endif
            </p>
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('exames.index') }}">
                <div class="col-md-5 mx-1">
                    <input 
                        type="text" 
                        name="nomeCorpo"
                        class="flex-grow border border-gray-300 rounded-l-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-100"
                        placeholder="Pesquisar por nome do corpo"
                        value="{{ request()->get('nomeCorpo') }}">
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
                        <th>{!! sortLink('Tipo do exame', 'tipo_exame') !!}</th>
                        <th>{!! sortLink('Corpo referente', 'corpo_nome') !!}</th>
                        <th>{!! sortLink('Status', 'status') !!}</th>
                        <th>{!! sortLink('Data de solicitação', 'created_at') !!}</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exames as $exame)
                        <tr>
                            <td>
                                {{ $exame->id }}
                            </td>
                            <td>
                                {{ $exame->tipo_exame }}
                            </td>
                            <td>
                                {{ $exame->corpo->nome }}
                            </td>
                            <td>
                                
                                @if($exame->status_id)
                                    @if($exame->status!=null)
                                        <span class="badge bg-{{ $exame->status->tipo }}" style="{{ $exame->status->tipo == "warning" ? "color: black;" : "" }}">{{ $exame->status->descricao }}</span>
                                    @endif                               
                                @else
                                    <span class="badge bg-warning" style="color:black;">Aguardando resposta</span>
                                @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($exame->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                <a href="{{ route('exames.show', $exame->id) }}"
                                    class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-search"></i> Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $exames->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $exames->total() }}</strong> {{ $exames->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    @include('exames.partials.modal.filtro')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection

@section('js')
    <script></script>
@endsection
