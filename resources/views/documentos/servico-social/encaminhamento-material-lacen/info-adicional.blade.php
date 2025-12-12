@extends('layout.app')

@section('title')
    <h3>Documentos do Médico</h3>
    <p class="text-subtitle text-muted">Documentos referente ao Médico</p>
@endsection

@section('breadcrumbs')
<ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Documentos
    </li>
</ol>
@endsection

@section('conteudo')
   
<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">ENCAMINHAMENTO DE MATERIAL PARA PESQUISA DE MICROORGANISMOS PELO LACEN</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas informações adicionais para gerar o encaminhamento.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('documentos_servico_social.gerarEncaminhamentoMaterialLacen') }}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="row">
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="pesquisapara" class="form-label">Solicito pesquisa para</label>
                        <textarea class="form-control" id="pesquisapara" name="pesquisapara" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="materiais_coleta" class="form-label">Insira os materiais para coleta</label>
                        <textarea class="form-control" id="materiais_coleta" name="materiais_coleta" rows="5"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <a href="{{ URL::previous() }}" class="btn btn-secondary me-1 mb-1 ">Voltar</a>
                <button type="submit" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
            </div>
        </form>
    </div>
</div>
    
@endsection

@section('js')


@endsection


