<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do corpo</h4>
                @can('laudos_view')
                    <a href="{{ route('documentos_servico_social.gerarLaudo', $laudo->corpo->id) }}" target="_BLANK"
                        class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-printer"></i> Imprimir laudo</a>
                @endcan
                @can('corpos_view')
                    <a href="{{ route('corpos.show', $laudo->corpo->id) }}" target="_BLANK"
                        class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-search"></i> Detalhes do
                        corpo</a>
                @endcan
                @if($laudo->entrevista_id)
                    @can('entrevistas_view')
                    <a href="{{ route('entrevistas.show', $laudo->entrevista_id) }}" target="_BLANK"
                        class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-person-rolodex"></i> Detalhes
                        da entrevista</a>
                    @endcan
                @endif
                
                <a href="{{ route('laudos.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
                        class="bi bi-arrow-left"></i> Voltar</a>
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
                                {{ $laudo->corpo->nome }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Sexo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $laudo->corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Idade</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ calcularIdade($laudo->corpo->data_nascimento,$laudo->corpo->data_obito)->text }}
                            </div>

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>RG</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $laudo->corpo->rg ?? 'Não possui' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>CPF</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $laudo->corpo->cpf ?? 'Não possui' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Endereço</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $laudo->corpo->enderecoCorpo->logradouro }},
                                {{ $laudo->corpo->enderecoCorpo->numero }} - {{ $laudo->corpo->enderecoCorpo->bairro }}
                                -
                                {{ $laudo->corpo->enderecoCorpo->cidade }}/{{ $laudo->corpo->enderecoCorpo->estado }}
                            </div>
                            {{-- Fim do bloco --}}

                            @if ($laudo->entrevista_id != null)
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Data da entrevista</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ \Carbon\Carbon::parse($laudo->entrevistaInfo->created_at)->format('d/m/Y H:i:s') }}
                                </div>
                                {{-- Fim do bloco --}}
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Entrevistado por</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $laudo->entrevistaInfo->entrevistador->name }}
                                </div>
                                {{-- Fim do bloco --}}
                            @endif
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Número VO</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if($laudo->corpo->num_vo)
                                    <a>
                                        {{ $laudo->corpo->num_vo . "/" . ($laudo->corpo->ano_vo ?? \Carbon\Carbon::parse($laudo->corpo->created_at)->format('Y')) }}
                                    </a>
                                @else
                                    <span>Não possui</span>
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
