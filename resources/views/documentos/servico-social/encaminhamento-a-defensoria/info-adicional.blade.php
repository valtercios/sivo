@extends('layout.app')

@section('title')
    <h3>Documentos do Serviço Social</h3>
    <p class="text-subtitle text-muted">Documentos referente ao Serviço Social</p>
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
        <h4 class="card-title" style="display:inline-block;">Encaminhamento á defensoria</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas informações adicionais para gerar o encaminhamento.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('documentos_servico_social.gerarEncaminhamentoDefensoria') }}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="row">
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="informacoes_adicionais" class="form-label">Informações complementares</label>
                        <textarea class="form-control" id="informacoes_adicionais" name="informacoes_adicionais" rows="5"></textarea>
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


