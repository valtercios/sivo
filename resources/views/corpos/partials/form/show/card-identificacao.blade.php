<div class="row">
    <div class="col-md-4">
        <label>Nome:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->nome }}
    </div>
    <div class="col-md-4">
        <label>Sexo:</label>
    </div>
    <div class="col-md-8 form-group">
        @if($corpo->sexo == 'M')
            Masculino
        @endif
        @if($corpo->sexo == 'F')
            Feminino
        @endif
    </div>
    <div class="col-md-4">
        <label>Estado Civil:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->estado_civil }}
    </div>
    <div class="col-md-4">
        <label>cor</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->cor }}
    </div>
    <div class="col-md-4">
        <label>Documento:</label>
    </div>
    <div class="col-md-8 form-group">
        @if($corpo->rg == null)
            Não Possui
        @else
        {{ $corpo->rg }}
        @endif
    </div>
    <div class="col-md-4">
        <label>Endereço de Óbito:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->enderecoObito->logradouro }}, {{ $corpo->enderecoObito->numero }}, {{ $corpo->enderecoObito->bairro }},
        {{ $corpo->enderecoObito->cidade }}/{{ $corpo->enderecoObito->estado }}
    </div>
    <div class="col-md-4">
        <label>Local:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->local_obito }}
    </div>
    <div class="col-md-4">
        <label>Data de Óbito:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y') }}
    </div>
    <div class="col-md-4">
        <label>Hora:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ \Carbon\Carbon::parse($corpo->data_obito)->format('H:i') }}
    </div>
    <div class="col-md-4">
        <label>Pai:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->pai }}
    </div>
    <div class="col-md-4">
        <label>Mãe:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->mae }}
    </div>
    <div class="col-md-4">
        <label>Data de Nascimento:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('d/m/Y') }}
    </div>
    <div class="col-md-4">
        <label>Idade:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}
    </div>
    <div class="col-md-4">
        <label>Naturalidade:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->naturalidade }}
    </div>
    <div class="col-md-4">
        <label>Telefone:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->entrevistaInfo->telefone ?? '' }}
    </div>
    <div class="col-md-4">
        <label>Ocupação:</label>
    </div>
    <div class="col-md-8 form-group">
        @if(empty($corpo->entrevistaInfo->ocupacao->ds_ocupacao))
            Não possui
        @else
        {{ $corpo->entrevistaInfo->ocupacao->ds_ocupacao }}
        @endif
    </div>
    <div class="col-md-4">
        <label>Endereço:</label>
    </div>
    <div class="col-md-8 form-group">
        {{ $corpo->enderecoObito->logradouro }}, {{ $corpo->enderecoObito->numero }}, {{ $corpo->enderecoObito->bairro }},
        {{ $corpo->enderecoObito->cidade }}/{{ $corpo->enderecoObito->estado }}
    </div>
    {{-- Inicio do bloco --}}
    <div class="col-md-4">
        <label>Número VO:</label>
    </div>
    <div class="col-md-8 form-group">
        @if($corpo->num_vo)
            <a>
                {{ $corpo->num_vo . "/" . ($corpo->ano_vo ?? \Carbon\Carbon::parse($corpo->created_at)->format('Y')) }}
            </a>
        @else
            <span>Não possui</span>
        @endif
    </div>
    {{-- Fim do bloco --}}

</div>