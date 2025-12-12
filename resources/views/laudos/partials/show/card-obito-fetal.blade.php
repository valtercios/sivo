<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do óbito fetal</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Detalhes referentes ao óbito fetal</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Idade da mãe</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->idade_mae }} anos
                                </div>
                                {{-- Fim do bloco --}}
                                
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Ocupação da mãe</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->ocupacao_mae }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Escolaridade</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->escolaridade_mae }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Tipo de parto</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->tipo_de_parto }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                {{-- <div class="col-md-4">
                                    <label>Endereço</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->corpo->enderecoCorpo->logradouro }}, {{ $laudo->corpo->enderecoCorpo->numero }} - {{ $laudo->corpo->enderecoCorpo->bairro }} - {{ $laudo->corpo->enderecoCorpo->cidade }}/{{ $laudo->corpo->enderecoCorpo->estado }}
                                </div> --}}
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                  <div class="col-md-4">
                                    <label>NM</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->nm }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>NV</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->nv }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Tempo de gestação</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->tempo_gestacao }} semanas
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