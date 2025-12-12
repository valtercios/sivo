{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Nome</label>
</div>
<div class="col-md-8 form-group">
    {{ $entrevista->corpo->nome }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Sexo</label>
</div>
<div class="col-md-8 form-group">
    {{ $entrevista->corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>RG</label>
</div>
<div class="col-md-8 form-group">
    {{ $entrevista->corpo->rg ?? 'Não possui' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>CPF</label>
</div>
<div class="col-md-8 form-group">
    {{ $entrevista->corpo->cpf ?? 'Não possui' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Endereço</label>
</div>
<div class="col-md-8 form-group">
    {{ $entrevista->corpo->enderecoCorpo->logradouro }}, {{ $entrevista->corpo->enderecoCorpo->numero }} - {{ $entrevista->corpo->enderecoCorpo->bairro }} - {{ $entrevista->corpo->enderecoCorpo->cidade }}/{{ $entrevista->corpo->enderecoCorpo->estado }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Data e hora do óbito</label>
</div>
<div class="col-md-8 form-group">
    {{ \Carbon\Carbon::parse($entrevista->corpo->data_obito)->format('d/m/Y H:i:s') }}
</div>
{{-- Fim do bloco --}}