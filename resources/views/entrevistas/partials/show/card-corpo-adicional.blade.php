<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes da entrevista</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações referentes a entrevista.</p>
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
                                    {{ $entrevista->pai }}
                                </div>
                                {{-- Fim do bloco --}}
                                
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Mãe</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->mae }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Estado civil</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->estado_civil }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Cor</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->cor }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Data de nascimento</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ \Carbon\Carbon::parse($entrevista->corpo->data_nascimento)->format('d/m/Y') }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>escolaridade</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->escolaridade_corpo }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Idade</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ calcularIdade($entrevista->corpo->data_nascimento, $entrevista->corpo->data_obito)->text }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Naturalidade</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->naturalidade }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Telefone do Responsavel</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $entrevista->telefone ?? '' }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Ocupação</label>
                                </div>
                                @if($entrevista->obito_fetal != 1)
                                <div class="col-md-8 form-group">
                                    <div>{{ $entrevista->ocupacaoCorpoDescricao }}</div>
                                </div>
                                @endif
                                {{-- Fim do bloco --}}

                                


                                
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
{{-- Fim Card --}}