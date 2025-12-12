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
        <h4 class="card-title" style="display:inline-block;">Selecione um médico</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Selecione um médico para continuar.</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group ">
                    <label for="medico">Médico</label>
                    <div class="position-relative">
                        <select name="medico" id="select_medico" class="choices form-control">
                            <option value="" selected disabled>Selecione um médico</option>
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico['id'] }}">CRM/RN {{ $medico['crm']}} - {{ $medico['name'] }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <button type="button" onclick="selecionarMedico()" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
        </div>
    </div>
</div>
    
@endsection

@section('js')
@include('utils.choices')
<script>
    function selecionarMedico(){
        let medicoId = $('#select_medico').val();
        let corpoId = '{{ $corpo_id }}';
        if(medicoId){
            window.location.href = "{{ route('documentos_servico_social.gerarDocumentoTCLE') }}/" + corpoId + '/' + medicoId;
        }
    }
</script>

@endsection


