@extends('layout.app')

@section('title')
    <h3>Funerárias</h3>
    <p class="text-subtitle text-muted">Gerenciamento de funerárias do sistema</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Funerárias
        </li>
</ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css')}}">
    
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Lista de funerárias</h4>
            @can('funerarias_create')
                <a href="{{ route('funerarias.create') }}" class="btn btn-sm icon btn-primary mx-1"  style="float:right;"><i class="bi bi-plus"></i> Nova funerária</a>
            @endcan
        </div>
        <div class="card-body">
            <form method="GET" class="flex w-full max-w-sm"  action="{{ route('funerarias.index') }}">
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
            <table class="table table" id="table1-no-pagination">
                <thead>
                    <tr>
                        <th>{!! sortLink('ID', 'id') !!}</th>
                        <th>{!! sortLink('Nome', 'nome') !!}</th>
                        <th>{!! sortLink('Endereço', 'logradouro') !!}</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funerarias as $funeraria)
                            <tr>
                                <td>
                                    {{ $funeraria->id }}
                                </td>
                                <td>
                                    {{ $funeraria->nome }}
                                </td>
                                <td>
                                    {{ $funeraria->enderecoFuneraria->logradouro }}, {{ $funeraria->enderecoFuneraria->numero }} {{ $funeraria->enderecoFuneraria->complemento != null ? ', ' . $funeraria->enderecoFuneraria->complemento  : '' }} - {{ $funeraria->enderecoFuneraria->bairro }} - {{ $funeraria->enderecoFuneraria->cidade }}/{{ $funeraria->enderecoFuneraria->estado }}
                                </td>
                                <td>
                                    <div class="buttons" style="display:inline-flex;">
                                        @can('funerarias_edit')
                                            <a href="{{ route('funerarias.edit', $funeraria->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" class="btn btn-sm icon btn-primary mx-1"><i class="bi bi-pencil"></i></a>
                                        @endcan
                                        @can('funerarias_delete')
                                        <form method="POST" action="{{ route('funerarias.destroy') }}">
                                            @csrf
                                            <input name="id" type="hidden" value="{{ $funeraria->id }}">
                                            <button type="button" onclick="deletarFuneraria(this)" data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar" class="btn btn-sm icon btn-danger mx-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                        @endcan
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            <section class="text-left">
                {{ $funerarias->appends(request()->query())->links() }}
                <div class="p-1">
                    <h6><strong>{{ $funerarias->total() }}</strong> {{ $funerarias->total() == 1 ? 'registro' : 'registros' }} no total</h6>
                </div>
            </section>
        </div>
    </div>
    {{-- @include('usuarios.permissoes.partials.modal-criar-permissao') --}}
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js')}}"></script>
@endsection

@section('js')

<script>
    function deletarFuneraria(e) {
            var form = $(e).closest("form");
            var name = $(e).data("name");

            swal.fire({
                title: "Excluir?",
                text: "Tem certeza que deseja excluir essa funerária?",
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







