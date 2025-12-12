<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do corpo</h4>
                @if ($entrevista->corpo->laudo != null)
                    @can('laudos_view')
                        <a href="{{ route('laudos.show', $entrevista->corpo->laudo) }}" target="_BLANK"
                            class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-folder-fill"></i>
                            Detalhes do laudo</a>
                    @endcan
                @endif
                @can('corpos_view')
                    <a href="{{ route('corpos.show', $entrevista->corpo->id) }}" target="_BLANK"
                        class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-search"></i> Detalhes
                        do corpo</a>
                @endcan
                @can('corpos_view')
                    <a href="{{ route('documentos_servico_social.list', $entrevista->corpo->id) }}" target="_BLANK"
                        class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-archive"></i>
                        Documentos</a>
                @endcan

                <a href="{{ route('entrevistas.index') }}" class="btn btn-sm icon btn-secondary mx-1"
                    style="float:right;"><i class="bi bi-arrow-left"></i> Voltar</a>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações
                    referentes ao corpo</p>
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
                                {{ $entrevista->corpo->enderecoCorpo->logradouro }},
                                {{ $entrevista->corpo->enderecoCorpo->numero }} -
                                {{ $entrevista->corpo->enderecoCorpo->bairro }}
                                -
                                {{ $entrevista->corpo->enderecoCorpo->cidade }}/{{ $entrevista->corpo->enderecoCorpo->estado }}
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
