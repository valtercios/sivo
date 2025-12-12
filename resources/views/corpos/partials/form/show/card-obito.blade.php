<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do óbito</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Informações referentes ao óbito</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Data do óbito</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ \Carbon\Carbon::parse($corpo->data_obito)->format('d/m/Y') }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Horário do óbito</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ \Carbon\Carbon::parse($corpo->data_obito)->format('H\h:i\m\i\n') }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Local do óbito</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->local_obito }}
                            </div>
                            {{-- Fim do bloco --}}
                            
                           {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Situação do óbito</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->situacao ? $corpo->situacao : '-' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Endereço</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->enderecoObito->logradouro }}, {{ $corpo->enderecoObito->numero }} - {{ $corpo->enderecoObito->bairro }} - {{ $corpo->enderecoObito->cidade }}/{{ $corpo->enderecoObito->estado }}
                            </div>
                            {{-- Fim do bloco --}}

                            @if($corpo->funeraria)

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Funerária que trouxe o corpo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->funeraria->nome }}
                            </div>
                            {{-- Fim do bloco --}}

                            @else

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Meio de transporte do corpo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->meio_transporte ?? '' }} {{ $corpo->meio_transporte_outro ? '- ' . $corpo->meio_transporte_outro : '' }}
                            </div>
                            {{-- Fim do bloco --}}

                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}