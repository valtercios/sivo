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
        <h4 class="card-title" style="display:inline-block;">Selecione um corpo</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Escolha um corpo abaixo para trazer os documentos referentes a ele.</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group ">
                    <label for="corpo">Corpo</label>
                    <div class="position-relative">
                        <select name="corpo" id="select_corpo" class="choices form-control">
                            <option value="" selected disabled>Selecione um corpo</option>
                            @foreach ($corpos as $corpo)
                                <option value="{{ $corpo->id }}">{{ $corpo->id }} - {{ $corpo->nome }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <button type="button" onclick="selecionarCorpo()" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
        </div>
    </div>
</div>
    
@endsection

@section('js')
@include('utils.choices')
<script>
    function selecionarCorpo(){
        let corpoId = $('#select_corpo').val();
        if(corpoId){
            window.location.href = "{{ route('documentos_servico_social.list') }}/"+corpoId;
        }
    }
</script>

@endsection


