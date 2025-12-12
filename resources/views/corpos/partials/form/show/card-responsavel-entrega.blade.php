<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do responsável pela entrega</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Informações referentes ao responsável pela entrega do corpo.</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Nome</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelEntrega->nome }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>RG</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if($corpo->responsavelEntrega->tipo_documento == 'RG' ||$corpo->responsavelEntrega->tipo_documento == null )
                                @if($corpo->responsavelEntrega->orgaoEmissor == null || $corpo->responsavelEntrega->estado_rg == null)
                                <span> {{ $corpo->responsavelEntrega->rg }} </span>
                                @else
                                {{ $corpo->responsavelEntrega->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelEntrega->estado_rg ? '/' . $corpo->responsavelEntrega->estado_rg : '' }} - {{ $corpo->responsavelEntrega->rg }}
                                @endif @else
                                {{ $corpo->responsavelEntrega->tipo_documento }}: {{ $corpo->responsavelEntrega->numero_documento }}
                                @endif
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>CPF</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelEntrega->cpf }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Endereço</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelEntrega->endereco->logradouro }}, {{ $corpo->responsavelEntrega->endereco->numero }} - {{ $corpo->responsavelEntrega->endereco->bairro }} - {{ $corpo->responsavelEntrega->endereco->cidade }}/{{ $corpo->responsavelEntrega->endereco->estado }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Telefone</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelEntrega->telefone ?? '-' }}
                            </div>
                            {{-- Fim do bloco --}}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}