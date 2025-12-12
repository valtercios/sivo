<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_civil">Estado Civil</label>
        <div class="position-relative">
            <select name="estado_civil" class="form-control slct2" id="">
                <option value="Solteiro" @if ($entrevista->estado_civil == 'Solteiro') {{ 'selected' }} @endif>Solteiro</option>
                <option value="Casado" @if ($entrevista->estado_civil == 'Casado') {{ 'selected' }} @endif>Casado</option>
                <option value="Viúvo" @if ($entrevista->estado_civil == 'Viúvo') {{ 'selected' }} @endif>Viúvo</option>
                <option value="Separado judicialmente/divorciado"
                    @if ($entrevista->estado_civil == 'Separado judicialmente/divorciado') {{ 'selected' }} @endif>Separado judicialmente/divorciado
                </option>
                <option value="União estável" @if ($entrevista->estado_civil == 'União estável') {{ 'selected' }} @endif>União estável
                </option>
                <option value="Ignorada" @if ($entrevista->estado_civil == 'Ignorada') {{ 'selected' }} @endif>Ignorada</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="cor">Cor</label>
        <div class="position-relative">
            <select name="cor" class="form-control" id="">
                <option value="Branca" @if ($entrevista->cor == 'Branca') {{ 'selected' }} @endif>Branca</option>
                <option value="Preta" @if ($entrevista->cor == 'Preta') {{ 'selected' }} @endif>Preta</option>
                <option value="Parda" @if ($entrevista->cor == 'Parda') {{ 'selected' }} @endif>Parda</option>
                <option value="Indígena" @if ($entrevista->cor == 'Indígena') {{ 'selected' }} @endif>Indígena
                </option>
                <option value="Amarela" @if ($entrevista->cor == 'Amarela') {{ 'selected' }} @endif>Amarela</option>
                <option value="Sem informação" @if ($entrevista->cor == 'Sem informação') {{ 'selected' }} @endif>Sem
                    informação</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="escolaridade_corpo">Escolaridade</label>
        <div class="position-relative">
            <select name="escolaridade_corpo" id="escolaridade_corpo" class="form-control">
                <option value="" disabled>Selecione uma opção</option>
                <option value="Sem escolaridade" @if ($entrevista->escolaridade_corpo == 'Sem escolaridade') {{ 'selected' }} @endif>Sem
                    escolaridade</option>
                <option value="Fundamental I (1ª a 4ª Série)"
                    @if ($entrevista->escolaridade_corpo == 'Fundamental I (1ª a 4ª Série)') {{ 'selected' }} @endif>Fundamental I (1ª a 4ª Série)
                </option>
                <option value="Fundamental II (5ª a 8ª Série)"
                    @if ($entrevista->escolaridade_corpo == 'Fundamental II (5ª a 8ª Série)') {{ 'selected' }} @endif>Fundamental II (5ª a 8ª Série)
                </option>
                <option
                    value="Médio incompleto (antigo 2º grau)"{{ $entrevista->escolaridade_corpo == 'Médio incompleto (antigo 2º grau)' ? 'selected' : '' }}>
                    Médio incompleto (antigo 2º grau)
                </option>
                <option value="Médio completo (antigo 2º grau)"
                    {{ $entrevista->escolaridade_corpo == 'Médio (antigo 2º grau)' || $entrevista->escolaridade_corpo == 'Médio completo (antigo 2º grau)' ? 'selected' : '' }}>
                    Médio completo (antigo 2º grau)
                </option>
                <option value="Superior incompleto" @if ($entrevista->escolaridade_corpo == 'Superior incompleto') {{ 'selected' }} @endif>
                    Superior incompleto</option>
                <option value="Superior completo" @if ($entrevista->escolaridade_corpo == 'Superior completo') {{ 'selected' }} @endif>
                    Superior completo</option>
                <option value="Ignorado" @if ($entrevista->escolaridade_corpo == 'Ignorado') {{ 'selected' }} @endif>Ignorado
                </option>


            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="escolaridade_corpo_serie">Série</label>
        <div class="position-relative">
            <select name="escolaridade_corpo_serie" @if (
                $entrevista->escolaridade_corpo !== 'Fundamental I (1ª a 4ª Série)' &&
                    $entrevista->escolaridade_corpo !== 'Fundamental II (5ª a 8ª Série)') disabled="true" @endif
                class="form-control" id="escolaridade_corpo_serie" required>
                @if ($entrevista->escolaridade_corpo == 'Fundamental I (1ª a 4ª Série)')
                    <option value="1ª Série" @if ($entrevista->escolaridade_corpo_serie == '1ª Série') {{ 'selected' }} @endif>1ª Série
                    </option>
                    <option value="2ª Série" @if ($entrevista->escolaridade_corpo_serie == '2ª Série') {{ 'selected' }} @endif>2ª Série
                    </option>
                    <option value="3ª Série" @if ($entrevista->escolaridade_corpo_serie == '3ª Série') {{ 'selected' }} @endif>3ª Série
                    </option>
                    <option value="4ª Série" @if ($entrevista->escolaridade_corpo_serie == '4ª Série') {{ 'selected' }} @endif>4ª Série
                    </option>
                @endif
                @if ($entrevista->escolaridade_corpo == 'Fundamental II (5ª a 8ª Série)')
                    <option value="5ª Série" @if ($entrevista->escolaridade_corpo_serie == '5ª Série') {{ 'selected' }} @endif>5ª Série
                    </option>
                    <option value="6ª Série" @if ($entrevista->escolaridade_corpo_serie == '6ª Série') {{ 'selected' }} @endif>6ª Série
                    </option>
                    <option value="7ª Série" @if ($entrevista->escolaridade_corpo_serie == '7ª Série') {{ 'selected' }} @endif>7ª Série
                    </option>
                    <option value="8ª Série" @if ($entrevista->escolaridade_corpo_serie == '8ª Série') {{ 'selected' }} @endif>8ª Série
                    </option>
                @endif
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="pai">Pai</label>
        <div class="position-relative">
            <input type="text" id="pai" class="form-control" value="{{ $entrevista->pai ?? '' }}"
                placeholder="Nome do pai" name="pai">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="mae">Mãe</label>
        <div class="position-relative">
            <input type="text" id="mae" class="form-control" value="{{ $entrevista->mae ?? '' }}"
                placeholder="Nome da mãe" name="mae">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="data_nascimento">Data de nascimento</label>
        <div class="position-relative">
            <input type="date" id="data_nascimento" max="9999-12-31" disabled
                value="{{ $entrevista->corpo->data_nascimento ?? '' }}" onchange="verificarDataNascimento()"
                class="form-control" name="data_nascimento">
            <div class="form-control-icon">
                <i class="bi bi-calendar"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="idade">Idade</label>
        <div class="position-relative">
            <input type="text" id="idade" class="form-control" disabled
                value="{{ calcularIdade($entrevista->corpo->data_nascimento, $entrevista->corpo->data_obito)->text }}"
                name="idade">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="documento_identificacao">Documento de identificação</label>
        <div class="position-relative">
            <select name="documento_identificacao" class="form-control" id="documento_identificacao">
                <option value="" disabled>Selecione um documento</option>
                <option value="RG" @if ($entrevista->documento_identificacao == 'RG') {{ 'selected' }} @endif>RG</option>
                <option value="Certidão de nascimento" @if ($entrevista->documento_identificacao == 'Certidão de nascimento') {{ 'selected' }} @endif>
                    Certidão de nascimento</option>
                <option value="Certidão de casamento" @if ($entrevista->documento_identificacao == 'Certidão de casamento') {{ 'selected' }} @endif>
                    Certidão de casamento</option>
                <option value="Carteira Nacional de Habilitação"
                    @if ($entrevista->documento_identificacao == 'Carteira Nacional de Habilitação') {{ 'selected' }} @endif>Carteira Nacional de Habilitação
                </option>
                <option value="Carteira de trabalho" @if ($entrevista->documento_identificacao == 'Carteira de trabalho') {{ 'selected' }} @endif>
                    Carteira de trabalho</option>
                <option value="Passaporte" @if ($entrevista->documento_identificacao == 'Passaporte') {{ 'selected' }} @endif>Passaporte
                </option>
                <option value="Outros" @if ($entrevista->documento_identificacao == 'Outros') {{ 'selected' }} @endif>Outros</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="num_documento">Número do documento</label>
        <div class="position-relative">
            <input type="text" id="num_documento" class="form-control"
                value="{{ $entrevista->num_documento ?? '' }}" placeholder="Número do documento"
                name="num_documento">
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
                value="{{ $entrevista->naturalidade ?? '' }}" placeholder="Naturalidade do corpo"
                name="naturalidade">
            <p><small class="text-muted">Municipio / UF (se estrangeiro informar Pais)</small></p>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="telefone">Telefone Responsavel</label>
        <div class="position-relative">
            <input type="text" id="telefone" required class="form-control" maxlength="100"
                placeholder="telefone do responsavel" name="telefone" value="{{ $entrevista->telefone }} ? '' ">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
@if (calcularIdade($entrevista->corpo->data_nascimento, $entrevista->corpo->data_obito)->type == 'ano')

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="telefone">Aposentado</label>
            <div class="position-relative">
                <select name="aposentado" class="form-control" id="aposentado" required>
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="0" @if ($entrevista->aposentado == '0') selected @endif>Não</option>
                    <option value="1" @if ($entrevista->aposentado == '1') selected @endif>Sim</option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="ocupacao_corpo_title">Ocupação </label>
            <a href="javascript:void(0)" style="float:right;" onclick="exibirModalOcupacao('ocupacao_corpo')">Procurar ocupação</a>
            <div class="position-relative">
                <select name="ocupacao_id" id="ocupacao_corpo" class="form-control choices">
                    <option value="" disabled @if (empty($entrevista->ocupacao_id) && empty($ocup)) selected @endif>Selecione uma
                        ocupação</option>
                    @php
                        // Normalize $ocup to a scalar value to avoid "Object of class stdClass could not be converted to int"
                        $ocupVal = null;
                        if (isset($ocup)) {
                            if (is_object($ocup)) {
                                // try common properties in order
                                $ocupVal = $ocup->id ?? ($ocup->co_cbo ?? ($ocup->co_cbo ?? null));
                            } else {
                                $ocupVal = $ocup;
                            }
                        }
                    @endphp
                    @foreach ($ocupacoes as $ocupacao)
                        <option value="{{ $ocupacao->id }}"
                            @if (
                                (isset($ocupacao->co_cbo) && $ocupacao->co_cbo == $ocupVal) ||
                                    (isset($ocupVal) && $ocupVal == $ocupacao->id) ||
                                    (isset($entrevista->ocupacao_id) && $entrevista->ocupacao_id == $ocupacao->id)) {{ 'selected' }} @endif>
                            {{ $ocupacao->co_cbo ? $ocupacao->co_cbo : 'CBO Não Informado' }} -
                            {{ $ocupacao->ds_ocupacao }}</option>
                    @endforeach
                </select>
            </div>
            <input id="outro_cbo_corpo_id" type="checkbox" class="form-check-input form-check-primary"
                style="align-items: flex-end" name="outro_cbo_corpo">
            <label class="form-check-label" for="">Outra ocupação</label>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <label for="ocupacao_title">Outra Ocupação do corpo</label>
        <div class="position-relative">
            <div class="position-relative">
                <input type="text" id="novo_cbo_corpo" class="form-control"
                    placeholder="Digite a ocupação do corpo" name="novo_cbo_corpo" disabled="true">
            </div>
            <small class="text-muted">Caso a ocupação não esteja na lista, marque a opção
                "Outra ocupação" e informe o nome da ocupação desejada.</small>
        </div>
    </div>

    {{-- outros beneficios --}}
    <div class="col-md-4 col-12">
        <div class="form-group
            has-icon-left">
            <label for="outros_beneficios">Outros benefícios</label>
            <div class="position-relative">
                <input type="text" id="outros_beneficios" class="form-control" placeholder="Outros benefícios"
                    name="outros_beneficios"
                    value="{{ $entrevista->outros_beneficios != null ? $entrevista->outros_beneficios : ' ' }}">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>

        </div>
    </div>

@endif
@section('js')
    <script>
        const ocupacaoChoices = new Choices('#ocupacao_corpo', {
            searchEnabled: true,
            itemSelectText: '',
        });

        var outro_cbo_corpo_checkbox = document.getElementById('outro_cbo_corpo_id');
        let cbo_padrao_corpo_select = document.getElementById('ocupacao_corpo');
        let cbo_outro_corpo_input_text = document.getElementById('novo_cbo_corpo');

        outro_cbo_corpo_checkbox.addEventListener('change', function() {
            if (this.checked) {
                cbo_padrao_corpo_select.disabled = true;
                ocupacaoChoices.disable();
                cbo_padrao_corpo_select.required = false;
                cbo_outro_corpo_input_text.disabled = false;
                cbo_outro_corpo_input_text.required = true;
            } else {
                cbo_padrao_corpo_select.disabled = false;
                ocupacaoChoices.enable();
                cbo_padrao_corpo_select.required = true;
                cbo_outro_corpo_input_text.disabled = true;
                cbo_outro_corpo_input_text.required = false;
            }
        });
    </script>
@endsection
