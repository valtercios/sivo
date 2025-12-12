@extends('layout.app')

@section('title')
    <h3>Documentos da recepção</h3>
    <p class="text-subtitle text-muted">Documentos referente a recepção</p>
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
        <h4 class="card-title" style="display:inline-block;">Encaminhamento</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas informações adicionais para gerar o encaminhamento.</p>
    </div>
    <div class="card-body">
        <form action="{{ route('documentos_recepcao.gerarEncaminhamento') }}" method="post" target="_blank">
            @csrf
            <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
            <div class="row">
                <div class="col-12">
                    <div class="form-group has-icon-left">
                        <label for="encaminharquem">Encaminhar a quem?</label>
                        <div class="position-relative">
                            <input type="text" id="encaminharquem" class="form-control" placeholder="A quem está sendo encaminhado?" name="encaminharquem">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @if($corpo->data_nascimento == null)
                <div class=" col-12">
                    <div class="form-group has-icon-left">
                        <label for="data_nascimento_corpo">Data de nascimento do corpo</label>
                        <div class="position-relative">
                            <input type="date" id="data_nascimento_corpo" class="form-control" name="data_nascimento_corpo">
                            <div class="form-control-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="motivo_encaminhamento" class="form-label">Motivo do encaminhamento</label>
                        <textarea class="form-control" id="motivo_encaminhamento" name="motivo_encaminhamento" rows="5"></textarea>
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

<script>
    function selecionarCorpo(){
        let corpoId = $('.choices').val();
        if(corpoId){
            window.location.href = "{{ route('documentos_servico_social.list') }}/"+corpoId;
        }
    }
</script>

@endsection


