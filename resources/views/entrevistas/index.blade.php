@extends('layout.app')

@section('title')
    <h3>Entrevistas</h3>
    <p class="text-subtitle text-muted">Gerenciamento de entrevistas do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Entrevistas
        </li>
    </ol>
@endsection

@section('conteudo')
    @php
        $canViewDocuments = auth()->user()->can('documentos_servico_social_view');
        $canEditInterview = auth()->user()->can('entrevistas_edit');
        $canViewInterview = auth()->user()->can('entrevistas_view');
    @endphp
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de entrevistas</h4>
            <a data-bs-toggle="modal"data-bs-target="#filtro-entrevistas" class="btn btn-sm icon btn-primary mx-1"
                style="float:right;"><i class="bi bi-filter"></i> Filtro</a>
            @can('entrevistas_create')
                <a href="{{ route('entrevistas.selecionar-corpo') }}" class="btn btn-sm icon btn-primary mx-1"
                    style="float:right;"><i class="bi bi-plus"></i> Nova entrevista</a>
            @endcan
            @if ( (request()->get('dataFinal')) || (request()->get('dataInicial') != null) 
            || (request()->get('filtroStatus')) || (request()->get('filtroResponsavel')) 
            || (request()->get('nomeResponsavel')) || (request()->get('nomeCorpo')) )
                <a href="{{ route('entrevistas.index') }}" class="btn btn-sm icon btn-secondary mx-1"
                    style="float:right;"><i class="bi bi-x"></i> Remover filtros</a>
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
                            Status: {{ $exameStatus->find(request()->get('filtroStatus'))->descricao }}
                        @endif
                        @if (request()->get('filtroCorpo'))
                            Corpo: {{ $corpos->find(request()->get('filtroCorpo'))->nome }}
                        @endif
                        @if (request()->get('filtroResponsavel'))
                            Responsável: {{ $entrevistas->find(request()->get('filtroResponsavel'))->nome }}
                        @endif
                    </strong>
                @endif
            </p>
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('entrevistas.index') }}">
                <div class="col-md-5 mx-1">
                    <input 
                        type="text" 
                        name="nomeResponsavel"
                        class="flex-grow border border-gray-300 rounded-l-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-100"
                        placeholder="Pesquisar por nome do responsável"
                        value="{{ request()->get('nomeResponsavel') }}">
                </div>
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
            <table class="table" id="table1-no-pagination">
                <thead>
                    <tr>
                        <th>{!! sortLink('ID', 'id') !!}</th>
                        <th>{!! sortLink('Nome do responsável', 'responsavel_nome') !!}</th>
                        <th>{!! sortLink('Corpo referente', 'corpo_nome') !!}</th>
                        {{-- <th>Status</th> --}}
                        <th>{!! sortLink('Data da entrevista', 'created_at') !!}</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrevistas as $entrevista)
                        <tr>
                            <td>
                                {{ $entrevista->id }}
                            </td>
                            <td>
                                {{ $entrevista->corpo->responsavelCorpo->nome ?? '' }}
                            </td>
                            <td>
                                {{ $entrevista->corpo->nome }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($entrevista->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td style="text-align: center;">
                                @if($canViewDocuments)
                                    <a href="{{ route('documentos_servico_social.list', $entrevista->corpo->id) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Documentos"
                                        class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-archive-fill"></i></a>
                                @endif
                                @if($canEditInterview)
                                    <a href="{{ route('entrevistas.edit', $entrevista->id) }}"
                                        class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-pencil"></i> Editar</a>
                                @endif
                                @if($canViewInterview)
                                    <a href="{{ route('entrevistas.show', $entrevista->id) }}"
                                        class="btn btn-sm icon icon-left btn-secondary"><i class="bi bi-search"></i>
                                        Detalhes</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $entrevistas->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $entrevistas->total() }}</strong> {{ $entrevistas->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    @include('entrevistas.partials.modal.filtro')
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection

@section('js')
    <script></script>
@endsection
