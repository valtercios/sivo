<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do responsável pelo corpo</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Informações referentes ao responsável
                    pelo corpo.</p>
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
                                {{ $corpo->responsavelCorpo->nome ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Documento</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->responsavelCorpo)
                                @if ($corpo->responsavelCorpo->tipo_documento == 'RG')
                                @if (
                                $corpo->responsavelCorpo->orgaoEmissor == null ||
                                $corpo->responsavelCorpo->estado_rg == null )
                                <span> {{ $corpo->responsavelCorpo->rg  }} </span>
                                @else
                                {{ $corpo->responsavelCorpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->responsavelCorpo->estado_rg ? '/' . $corpo->responsavelCorpo->estado_rg : '' }}
                                - {{ $corpo->responsavelCorpo->rg }}
                                @endif
                                @else
                                {{ $corpo->responsavelCorpo->tipo_documento }}:
                                {{ $corpo->responsavelCorpo->numero_documento }}
                                @endif
                                @endif
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>CPF</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelCorpo->cpf ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Grau de parentesco</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->responsavelCorpo->grau_parentesco ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Endereço</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->responsavelCorpo)
                                {{ $corpo->responsavelCorpo->endereco->logradouro }},
                                {{ $corpo->responsavelCorpo->endereco->numero }} -
                                {{ $corpo->responsavelCorpo->endereco->bairro }} -
                                {{ $corpo->responsavelCorpo->endereco->cidade }}/{{ $corpo->responsavelCorpo->endereco->estado }}
                                @endif
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Telefone</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->responsavelCorpo->telefone != null)
                                {{ $corpo->responsavelCorpo->telefone ?? '' }}
                                @else
                                <span> - </span>
                                @endif
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Nacionalidade</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->responsavelCorpo->nacionalidade != null)
                                {{ $corpo->responsavelCorpo->nacionalidade }}
                                @else
                                <span> - </span>
                                @endif
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