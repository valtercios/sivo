<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do corpo</h4>
                <a href="{{ route('documentos_recepcao.gerarDocumentoRecebimentoDeCorpo', $corpo->id) }}" target="_blank"
                    class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-printer-fill"></i>
                    Imprimir documento</a>
                @if ($user->can('corpos_edit'))
                @if ($corpo->num_vo == null && ($corpo->medico_externo == 0 || $corpo->medico_externo == null))
                <a href="{{ route('corpos.medicoexterno', $corpo->id) }}"
                    class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i
                        class="bi bi-clipboard2-pulse"></i> Médico externo</a>
                @endif
                @if (!$corpo->responsavel_corpo_id)
                <a href="{{ route('corpos.responsavelcorpo', $corpo->id) }}"
                    class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-person"></i>
                    Informar responsável pelo corpo</a>
                @endif
                @if ($corpo->num_vo == null)
                @can('corpos_atribuirvo')
                <a href="#" data-bs-toggle="modal" data-bs-target="#atribuirvo"
                    class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-tag"></i>
                    Atribuir
                    VO</a>
                @endcan
                @endif
                @if ($corpo->encaminhar_liga == null && $corpo->encaminhar_liga == 0)
                <form action="{{ route('corpos.encaminharliga') }}" method="post" id="encaminhar-liga-form"
                    class="d-none">
                    @csrf
                    <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
                </form>
                <button onclick="encaminharLiga()" class="btn btn-sm icon btn-primary mx-1"
                    style="float:right;"><i class="bi bi-box-arrow-left"></i> Encaminhar para a LIGA</button>
                @endif
                @if ($corpo->encaminhar_itep == null && $corpo->encaminhar_itep == 0)
                <form action="{{ route('corpos.encaminharitep') }}" method="post" id="encaminhar-itep-form"
                    class="d-none">
                    @csrf
                    <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
                </form>
                <button onclick="encaminharItep()" class="btn btn-sm icon btn-primary mx-1"
                    style="float:right;"><i class="bi bi-box-arrow-left"></i> Encaminhar para o ITEP</button>
                @endif

                @if ($corpo->devolver_corpo == null && $corpo->devolver_corpo == 0)
                <form action="{{ route('corpos.devolvercorpo') }}" method="post" id="devolver-corpo-form"
                    class="d-none">
                    @csrf
                    <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">

                </form>
                <button onclick="devolverCorpo()" class="btn btn-sm icon btn-primary mx-1" style="float: right;">
                    <i class="bi bi-backspace"></i> Devolver corpo
                </button>
                @endif
                @endif
                <a href="{{ route('corpos.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i
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
                                <label>Documento</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->tipo_documento == 'RG')
                                {{ $corpo->orgaoEmissor->sigla ?? '' }}{{ $corpo->estado_rg ? '/' . $corpo->estado_rg . ' - ' : '' }}
                                {{ $corpo->rg }}
                                @elseif($corpo->tipo_documento == 'Nao Possui')
                                {{ 'Não possui' }}
                                @else
                                {{ $corpo->tipo_documento }}: {{ $corpo->numero_documento }}
                                @endif
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
                                {{ $corpo->enderecoCorpo->logradouro }}, {{ $corpo->enderecoCorpo->numero }} -
                                {{ $corpo->enderecoCorpo->bairro }} -
                                {{ $corpo->enderecoCorpo->cidade }}/{{ $corpo->enderecoCorpo->estado }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Nacionalidade</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($corpo->nacionalidade != null)
                                {{ $corpo->nacionalidade }}
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