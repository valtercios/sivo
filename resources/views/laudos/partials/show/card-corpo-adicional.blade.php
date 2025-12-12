<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Informações adicionais do corpo</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações adicionais do corpo que foram adicionadas com o laudo.</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Pai</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->pai }}
                                </div>
                                {{-- Fim do bloco --}}
                                
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Mãe</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->mae }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Estado civil</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->estado_civil }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Cor</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->cor }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Data de nascimento</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ \Carbon\Carbon::parse($laudo->data_nascimento)->format('d/m/Y') }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Naturalidade</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->naturalidade }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Telefone</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->telefone }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Ocupação</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->ocupacao }}
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