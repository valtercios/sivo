@extends('layout.app')

@section('title')
    <h3>Corpos</h3>
    <p class="text-subtitle text-muted">Gerenciamento dos corpos do SVO</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Corpos
        </li>
    </ol>
@endsection

@section('conteudo')
    @php
        $canEditCorpses = auth()->user()->can('corpos_edit');
        $canViewDocuments = auth()->user()->can('documentos_recepcao_view');
    @endphp
    {{-- <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}"> --}}

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de corpos</h4>
            <a data-bs-toggle="modal"data-bs-target="#filtro-corpos" class="btn btn-sm icon btn-primary mx-1"
                style="float:right;"><i class="bi bi-filter"></i> Filtro</a>
            @can('corpos_create')
            <a href="{{ route('corpos.create') }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i
                    class="bi bi-plus"></i> Novo corpo</a>
            @endcan
            @if ( (request()->get('nome') != null) || (request()->get('dataInicial') != null) || (request()->get('filtroStatus') != null) ) 
                <a href="{{ route('corpos.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
                        class="bi bi-x"></i> Remover filtros</a>
            @endif
            <br>
            <p class="text-subtitle text-muted" style="display: inline-block;">
                @if ( (request()->get('dataInicial') != null) || (request()->get('filtroStatus') != null))
                    <strong>
                        Filtrando
                        @if (request()->get('dataFinal') != null)
                            de {{ \Carbon\Carbon::parse(request()->get('dataInicial'))->format('d/m/Y') }} a
                            {{ \Carbon\Carbon::parse(request()->get('dataFinal'))->format('d/m/Y') }}
                        @elseif (request()->get('dataInicial') != null)
                            a partir de {{ \Carbon\Carbon::parse(request()->get('dataInicial'))->format('d/m/Y') }}
                        @endif
                        @if (request()->get('filtroStatus'))
                            Status: {{ $status->find(request()->get('filtroStatus'))->descricao }}
                        @endif
                    </strong>
                @endif
            </p>
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('corpos.index') }}">
                <div class="col-md-8">
                    <input 
                        type="text" 
                        name="nome"
                        class="flex-grow border border-gray-300 rounded-l-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 w-100"
                        placeholder="Pesquisar por nome"
                        value="{{ request()->get('nome') ?? '' }}">
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
                        <th class="text-nowrap">{!! sortLink('Número VO', 'num_vo') !!}</th>
                        <th>{!! sortLink('Nome', 'nome') !!}</th>
                        <th>{!! sortLink('Sexo', 'sexo') !!}</th>
                        <th>{!! sortLink('Cadastrado às', 'created_at') !!}</th>
                        <th>
                            Status
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($corpos as $corpo)
                        <tr style="font-size:16px">
                            <td>
                                {{ $corpo->id }}
                            </td>
                            <td>
                                @if ($corpo->num_vo != null)
                                    {{ $corpo->num_vo . '/' . ($corpo->ano_vo ?? \Carbon\Carbon::parse($corpo->created_at)->format('Y')) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{ $corpo->nome }}
                            </td>
                            <td>
                                {{ $corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}
                            </td>
                            <td class="text-nowrap">
                                {{ \Carbon\Carbon::parse($corpo->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                @if(isset($corpo->status))
                                    <span class="badge bg-{{ $corpo->corpoStatus->tipo }}" style="{{ $corpo->corpoStatus->tipo == "warning" ? "color: black;" : "" }}">{{ $corpo->corpoStatus->descricao }}</span>
                                @else
                                    <span class="badge bg-success">Finalizado</span>
                                @endif
                                @if($corpo->devolver_corpo == 1)
                                    <span class="badge bg-danger" style="margin-top:10px;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $corpo->justificativa }}">Devolvido</span>
                                @else
                                    <span class="badge bg-secondary" style="margin-top:10px;">No SVO</span>
                                @endif
                            </td>
                            <td>
                                <div class="buttons" style="display:inline-flex;">
                                    <a href="{{ route('corpos.show', $corpo->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Detalhes do corpo"
                                        class="btn btn-sm icon icon-left btn-secondary"><i class="bi bi-search"></i></a>
                                    @if($canEditCorpses)
                                    <a href="{{ route('corpos.edit', $corpo->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Editar corpo"
                                        class="btn btn-sm icon icon-left btn-secondary"><i class="bi bi-pencil"></i></a>
                                    @endif
                                    @if($canViewDocuments)
                                    <a href="{{ route('documentos_recepcao.list', $corpo->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Documentos"
                                        class="btn btn-sm icon icon-left btn-primary"><i class="bi bi-archive-fill"></i></a>
                                    @endif
                                    @if ($corpo->necrotomista_id == null && !$corpo->num_vo && $corpo->status != 7 && $corpo->status != 8)
                                        @if (Auth::user()->roles->pluck('name')[0] == 'Necrotomista' || Auth::user()->roles->pluck('name')[0] == 'Administrador')
                                            <a data-bs-toggle="modal" data-bs-target="#recebercorpo"
                                                data-url="{{ route('corpos.recebercorpo', $corpo->id) }}"
                                                class="btn btn-sm icon icon-left btn-primary text-nowrap"><i class="bi bi-person"></i>
                                                Receber
                                                corpo</a>
                                        @endif
                                    @endif
                                    {{-- excluir corpo se diretor --}}
                                    @if (Auth::user()->roles->pluck('name')[0] == "Direção" || Auth::user()->roles->pluck('name')[0] == "Administrador")
                                        <a data-bs-toggle="modal" data-bs-target="#excluircorpo" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir corpo" 
                                            data-url="{{ route('corpos.destroy', $corpo->id) }}"
                                            class="btn btn-sm icon icon-left btn-danger"><i class="bi bi-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $corpos->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $corpos->total() }}</strong> {{ $corpos->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @include('corpos.partials.modal.receber-corpo')
    @include('corpos.partials.modal.filtro')
    @include('corpos.partials.modal.excluir-corpo')
@endsection

@section('js')
    <script>
        $('#table1').DataTable({
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
            }, 
            "pageLength":10,
            "lengthMenu":[[10,30,50,-1], [10,30,50,"Todos"]],
            "order": [],
        });
    </script>

    <script>
        function verificarIdentidade() {
            let url = '{{ URL::to('/api/verificaridentidade') }}';
            let data = {
                cpf: document.querySelector('#cpf').value,
                senha: document.querySelector('#senha').value
            }
            axios.post(url, data)
                .then(function(response) {
                    if (response.data.code == 0) {
                        document.getElementById('logarform').style = "display:none;"
                        document.getElementById('necrotomistaform').style = "display:block;"
                        document.getElementById('verificarbutton').style = "display:none;"
                        document.getElementById('confirmarbutton').style = "display:block;"



                    } else {
                        flasher.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
        $('#recebercorpo').on('shown.bs.modal', function(e) {
            let url = $(e.relatedTarget).attr('data-url');
            $('#form').prop('action', url)
        })
    </script>

    <script>
        function confirmar_exclusao() {
            let url = '{{ URL::to('/api/verificaridentidade') }}';
            let data = {
                cpf: document.querySelector('#cpf_excluir').value,
                senha: document.querySelector('#senha_excluir').value
            }
            axios.post(url, data)
                .then(function(response) {
                    if (response.data.code == 0) {
                        document.getElementById('logarform-ex').style = "display:none;"
                        document.getElementById('confirmarexclusao').style = "display:none;"
                    } else {
                        flasher.error(response.data.message);
                    }
                })
                .catch(function(error) {
                    console.error(error);
                });
        }
        $('#excluircorpo').on('shown.bs.modal', function(e) {
            let url = $(e.relatedTarget).attr('data-url');
            $('#form-ex').prop('action', url)
        })
    </script>
@endsection
