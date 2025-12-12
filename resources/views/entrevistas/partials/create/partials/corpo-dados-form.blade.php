{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Nome</label>
</div>
<div class="col-md-8 form-group">
    {{ $corpo->nome }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Sexo</label>
</div>
<div class="col-md-8 form-group">
    {{ $corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>RG</label>
</div>
<div class="col-md-8 form-group">
    {{ $corpo->rg ?? 'Não possui' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>CPF</label>
</div>
<div class="col-md-8 form-group">
    {{ $corpo->cpf ?? 'Não possui' }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Endereço</label>
</div>
<div class="col-md-8 form-group">
    {{ $corpo->enderecoCorpo->logradouro }}, {{ $corpo->enderecoCorpo->numero }} - {{ $corpo->enderecoCorpo->bairro }} - {{ $corpo->enderecoCorpo->cidade }}/{{ $corpo->enderecoCorpo->estado }}
</div>
{{-- Fim do bloco --}}

{{-- Inicio do bloco --}}
<div class="col-md-4">
    <label>Data e hora do óbito</label>
</div>
<div class="col-md-8 form-group">
    {{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y H:i:s') }}
</div>
{{-- Fim do bloco --}}