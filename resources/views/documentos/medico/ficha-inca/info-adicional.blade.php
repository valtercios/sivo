@extends('layout.app')

@section('title')
    <h3>Documentos do Médico</h3>
    <p class="text-subtitle text-muted">Documentos referente ao Médico</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Documentos
        </li>
    </ol>
@endsection
{{-- {{dd($corpo->entrevistaInfo)}} --}}
@section('conteudo')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">FICHA DE NOTIFICAÇÃO DE CÂNCER</h4>
            <br>
            <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Preencha algumas
                informações adicionais para gerar o documento.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('documentos_medico.gerarFichaInca') }}" method="post" target="_blank">
                @csrf
                <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group has-icon-left">
                            <label for="ano">Ano</label>
                            <div class="position-relative">
                                <input type="text" id="ano" class="form-control" placeholder="Ano" name="ano"
                                    value="{{ \Carbon\Carbon::today()->format('Y') }}" data-mask="0000">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-12">
                        <div class="form-group has-icon-left">
                            <label for="fontenotificadora">Fonte notificadora</label>
                            <div class="position-relative">
                                <input type="text" id="fontenotificadora" class="form-control"
                                    placeholder="Fonte notificadora" name="fontenotificadora">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group has-icon-left">
                            <label for="prontuario">Prontuário</label>
                            <div class="position-relative">
                                <input type="text" id="prontuario" class="form-control" placeholder="Prontuário"
                                    name="prontuario">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cartaosus">Cartão SUS</label>
                            <div class="position-relative">
                                <input type="text" id="cartaosus" class="form-control" data-mask="000 0000 0000 0000"
                                    placeholder="Cartão SUS" name="cartaosus">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cpf">CPF</label>
                            <div class="position-relative">
                                <input type="text" id="cpf" class="form-control" data-mask="000.000.000-00"
                                    placeholder="CPF" value="{{ $corpo->cpf ?? 'Não possui' }}" name="cpf">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="rg">RG</label>
                            <div class="position-relative">
                                <input type="text" id="rg" class="form-control" maxlength="15" placeholder="RG"
                                    value="{{ $corpo->rg ?? 'Não possui' }}" name="rg">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="pai">Nome do pai</label>
                            <div class="position-relative">
                                <input type="text" id="pai" class="form-control" placeholder="Nome do pai"
                                    value="{{ $corpo->entrevistaInfo->pai }}" name="pai">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="mae">Nome da mãe</label>
                            <div class="position-relative">
                                <input type="text" id="mae" class="form-control" placeholder="Nome da mãe"
                                    value="{{ $corpo->entrevistaInfo->mae }}" name="mae">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="sexo">Sexo</label>
                            <div class="position-relative">
                                <input type="text" id="sexo" class="form-control"
                                    value="{{ $corpo->sexo == 'M' ? 'Masculino' : 'Feminino' }}" placeholder="Sexo"
                                    name="sexo">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="data_nascimento">Data de nascimento</label>
                            <div class="position-relative">
                                <input type="date" id="data_nascimento" class="form-control"
                                    placeholder="Data de nascimento"
                                    value="{{ \Carbon\Carbon::parse($corpo->data_nascimento)->format('Y-m-d') }}"
                                    max="9999-12-31" name="data_nascimento">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cor">Raça/Cor</label>
                            <div class="position-relative">
                                <input type="text" id="cor" class="form-control"
                                    value="{{ $corpo->entrevistaInfo->cor }}" placeholder="Cor" name="cor">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="nacionalidade">Nacionalidade</label>
                            <div class="position-relative">
                                <input type="text" id="nacionalidade" class="form-control"
                                    placeholder="Nacionalidade" name="nacionalidade" value="{{$corpo->nacionalidade ?? 'Brasileiro'}}">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="naturalidade">Naturalidade</label>
                            <div class="position-relative">
                                <input type="text" id="naturalidade" class="form-control"
                                    value="{{ $corpo->entrevistaInfo->naturalidade }}" placeholder="Naturalidade"
                                    name="naturalidade">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="estado_civil">Estado Civil</label>
                            <div class="position-relative">
                                <input type="text" id="estado_civil" class="form-control" placeholder="Estado Civil"
                                    value="{{ $corpo->entrevistaInfo->estado_civil }}" name="estado_civil">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="escolaridade">Escolaridade</label>
                            <div class="position-relative">
                                <select name="escolaridade" id="escolaridade" class="form-control">
                                    <option value="" disabled>Selecione uma opção</option>
                                    <option value="Sem escolaridade" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Sem escolaridade' ? 'selected' : '' }}>Sem escolaridade</option>
                                    <option value="Fundamental I (1ª a 4ª Série)" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Fundamental I (1ª a 4ª Série)' ? 'selected' : '' }}>Fundamental I (1ª a 4ª Série)</option>
                                    <option value="Fundamental II (5ª a 8ª Série)" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Fundamental II (5ª a 8ª Série)' ? 'selected' : '' }}>Fundamental II (5ª a 8ª Série)</option>
                                    <option value="Médio (antigo 2º grau)" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Médio (antigo 2º grau)' ? 'selected' : '' }}>Médio (antigo 2º grau)</option>
                                    <option value="Superior incompleto" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Superior incompleto' ? 'selected' : '' }}>Superior incompleto</option>
                                    <option value="Superior completo" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Superior completo' ? 'selected' : '' }}>Superior completo</option>
                                    <option value="Ignorado" {{ $corpo->entrevistaInfo->escolaridade_corpo === 'Ignorado' ? 'selected' : '' }}>Ignorado</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="ocupacao">Ocupação/Profissão</label>
                            <div class="position-relative">
                                <input type="text" id="ocupacao" class="form-control" placeholder="Ocupação"
                                    value="{{ $corpo->entrevistaInfo->ocupacao->ds_ocupacao ?? '' }}" name="ocupacao">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cep">CEP</label>

                            <div class="position-relative">
                                <input type="text" id="cep" class="form-control"
                                    value="{{ $corpo->enderecoCorpo->cep }}" placeholder="CEP" name="cep"
                                    onblur="pesquisacep(this.value);">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="logradouro">Logradouro</label>

                            <div class="position-relative">
                                <input type="text" id="logradouro" class="form-control"
                                    value="{{ $corpo->enderecoCorpo->logradouro }}" placeholder="Logradouro"
                                    name="logradouro">
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="numero">Número</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="numero" class="form-control"
                                        value="{{ $corpo->enderecoCorpo->numero }}" placeholder="Numero da residência"
                                        name="numero">
                                    <div class="form-control-icon">
                                        <i class="bi bi-list-ol"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="bairro">Bairro</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="bairro" class="form-control"
                                        value="{{ $corpo->enderecoCorpo->bairro }}" placeholder="Bairro" name="bairro">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="cidade">Cidade</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="cidade" class="form-control"
                                        value="{{ $corpo->enderecoCorpo->cidade }}" placeholder="Cidade" name="cidade">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="estado">Estado</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="estado" class="form-control"
                                        value="{{ $corpo->enderecoCorpo->estado }}" placeholder="Estado" name="estado">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="procedencia">Procedência</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="procedencia" class="form-control"
                                        placeholder="Procedência" name="procedencia">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="numexame">Nº Exame</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="numexame" class="form-control"
                                        placeholder="Número do exame" name="numexame">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="topografia">Topografia</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="topografia" class="form-control" placeholder="Topografia"
                                        name="topografia">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="morfologia">Morfologia</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="text" id="morfologia" class="form-control" placeholder="Morfologia"
                                        name="morfologia">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group has-icon-left">
                        <label for="meio_diagnostico">Meio de Diagnóstico</label>
                        <div class="form-group">
                            <div class="position-relative">
                                <select name="meio_diagnostico" id="meio_diagnostico" class="form-control">
                                    <option value="" disabled selected>Selecione uma opção</option>
                                    <option value="Necropsia">Necropsia</option>
                                    <option value="SDO">SDO</option>
                                    <option value="Clínico">Clínico</option>
                                    <option value="Pesquisa">Pesquisa</option>
                                    <option value="Marcadores Tumorais">Marcadores Tumorais</option>
                                    <option value="Citologia">Citologia</option>
                                    <option value="Histologia da Metástase">Histologia da Metástase</option>
                                    <option value="Histologia do Tumor Primário">Histologia do Tumor Primário</option>
                                    <option value="Sem Informação">Sem Informação</option>
                                </select>
                                <div class="form-control-icon">
                                    <i class="bi bi-card-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group has-icon-left">
                            <label for="extensao_doenca">Extensão da Doença</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <select name="extensao_doenca" id="extensao_doenca" class="form-control">
                                        <option value="" disabled selected>Selecione uma opção</option>
                                        <option value="Localizado">Localizado</option>
                                        <option value="Metástase">Metástase</option>
                                        <option value="In Situ">"In Situ"</option>
                                        <option value="Não se Aplica">Não se Aplica</option>
                                        <option value="Sem Informação">Sem Informação</option>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="data_diagnostico">Data do Diagnóstico</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="date" id="data_diagnostico" class="form-control"
                                        name="data_diagnostico">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="data_obito">Data do Óbito</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="date" id="data_obito" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($corpo->data_obito)->format('Y-m-d') }}"
                                        name="data_obito">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="form-group has-icon-left">
                            <label for="data_coleta">Data da Coleta</label>
                            <div class="form-group">
                                <div class="position-relative">
                                    <input type="date" id="data_coleta" class="form-control" name="data_coleta">
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ URL::previous() }}" class="btn btn-secondary me-1 mb-1 ">Voltar</a>
                    <button type="submit" class="btn btn-primary me-1 mb-1 ">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
