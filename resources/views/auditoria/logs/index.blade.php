@extends('layout.app')

@section('title')
    <h3>Auditoria</h3>
    <p class="text-subtitle text-muted">Gerenciamento de logs do sistema</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Auditoria
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de auditoria</h4>
            <a data-bs-toggle="modal"data-bs-target="#filtro-auditoria" class="btn btn-sm icon btn-primary mx-1"
                style="float:right;"><i class="bi bi-filter"></i> Filtro</a>
            @if (request()->all() != null)
                <a href="{{ route('auditoria.logs') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
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
                        @if (request()->get('filtroUsuario'))
                            Usuário: {{ \App\Models\User::find(request()->get('filtroUsuario'))->name }}
                        @endif
                    </strong>
                @endif
            </p>

        </div>
        <div class="card-body">
            <table class="table table" id="table1">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Data
                        </th>
                        <th>
                            Usuário
                        </th>
                        <th>
                            Evento
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td>
                                <span>{{ $log->id }} </span>
                            </td>
                            <td >
                                <span> {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }} </span>
                            </td>
                            <td >
                                <span> {{ strtoupper($log->usuario->username ?? '') }} </span>
                            </td>

                            <td >
                                <span> {{ strtoupper($log->event) . ' - ' . $log->auditable_type }} </span>
                            </td>
                            <td >
                                <a href="{{ route('autoria.logs.detalhes', ['id' => $log->id]) }}"
                                    class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-search"></i> Detalhes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    @include('auditoria.logs.partials.modal-filtro')
@endsection
