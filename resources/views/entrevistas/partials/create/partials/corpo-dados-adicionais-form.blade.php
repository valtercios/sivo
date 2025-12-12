<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_civil">Estado Civil</label>
        <div class="position-relative">
            <select name="estado_civil" class="form-control slct2" id="" required>
                <option value="Solteiro">Solteiro</option>
                <option value="Casado">Casado</option>
                <option value="Viúvo">Viúvo</option>
                <option value="Separado judicialmente/divorciado">Separado judicialmente/divorciado</option>
                <option value="União estável">União estável</option>
                <option value="Ignorada">Ignorada</option>
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
            <select name="cor" class="form-control" id="" required>
                <option value="Branca">Branca</option>
                <option value="Preta">Preta</option>
                <option value="Parda">Parda</option>
                <option value="Indígena">Indígena</option>
                <option value="Amarela">Amarela</option>
                <option value="Sem informação">Sem informação</option>
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
            <select name="escolaridade_corpo" id="escolaridade_corpo" class="form-control" required>
                <option value="" disabled selected>Selecione uma opção</option>
                <option value="Sem escolaridade">Sem escolaridade</option>
                <option value="Fundamental I (1ª a 4ª Série)">Fundamental I (1ª a 4ª Série)</option>
                <option value="Fundamental II (5ª a 8ª Série)">Fundamental II (5ª a 8ª Série)</option>
                <option value="Médio incompleto (antigo 2º grau)">Médio incompleto (antigo 2º grau)</option>
                <option value="Médio completo (antigo 2º grau)">Médio completo (antigo 2º grau)</option>
                <option value="Superior incompleto">Superior incompleto</option>
                <option value="Superior completo">Superior completo</option>
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
            <select name="escolaridade_corpo_serie" disabled="true" class="form-control" id="escolaridade_corpo_serie"
                required>
                <option value="Ignorado">Ignorado</option>
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
            <input type="text" id="pai" class="form-control" placeholder="Nome do pai" name="pai" required>
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
            <input type="text" id="mae" class="form-control" placeholder="Nome da mãe" name="mae" required>
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
                value="{{ $corpo->data_nascimento ?? '' }}" onchange="verificarDataNascimento()" class="form-control"
                name="data_nascimento">
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
                value="{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}" name="idade">
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
            <select name="documento_identificacao" class="form-control" id="documento_identificacao" required>
                <option value="RG" @if ($corpo->tipo_documento === 'RG') selected @endif>RG</option>
                <option value="Certidão de nascimento" @if ($corpo->tipo_documento === 'Certidão de nascimento') selected @endif>Certidão de
                    nascimento</option>
                <option value="Certidão de casamento" @if ($corpo->tipo_documento === 'Certidão de casamento') selected @endif>Certidão de
                    casamento</option>
                <option value="Carteira Nacional de Habilitação" @if ($corpo->tipo_documento === 'Carteira Nacional de Habilitação') selected @endif>
                    Carteira Nacional de Habilitação</option>
                <option value="Carteira de trabalho" @if ($corpo->tipo_documento === 'Carteira de trabalho') selected @endif>Carteira de
                    trabalho</option>
                <option value="Passaporte" @if ($corpo->tipo_documento === 'Passaporte') selected @endif>Passaporte</option>
                <option value="Outros" @if ($corpo->tipo_documento === 'Outros') selected @endif>Outros</option>
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
            <input type="text" id="num_documento" value="{{ $corpo->numero_documento }}" class="form-control"
                placeholder="Número do documento" name="num_documento" required>
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
            <input type="text" id="naturalidade" required class="form-control" maxlength="100"
                placeholder="Naturalidade do corpo" name="naturalidade">
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
                placeholder="Telefone do responsavel" name="telefone">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>


<!-- Verifica se é natimorto -->
@if (calcularIdade($corpo->data_nascimento, $corpo->data_obito)->type == 'ano')

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="telefone">Aposentado</label>
            <div class="position-relative">
                <select name="aposentado" class="form-control" id="aposentado" required>
                    <option value="" disabled selected>Selecione uma opção</option>
                    <option value="0" @if ($corpo->aposentado === '0') selected @endif>Não</option>
                    <option value="1" @if ($corpo->aposentado === '1') selected @endif>Sim</option>
                </select>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <label for="ocupacao_title">Ocupação do corpo</label>
        <a href="javascript:void(0)" style="float:right;" onclick="exibirModalOcupacao('ocupacao_corpo')">Procurar
            ocupação</a>
        <div class="position-relative">
            <select name="ocupacao_id" id="ocupacao_corpo" class="form-control choices" required>
                <option id="ocupacao_corpo" value="" disabled selected>Selecione uma ocupação</option>
                @foreach ($ocupacoes as $ocupacao)
                    <option value="{{ $ocupacao->id }}">{{ $ocupacao->co_cbo ?? ($ocupacao->co_cbo ?? ' ') }}
                        {{ $ocupacao->ds_ocupacao ?? ($ocupacao->ds_ocupacao ?? ' ') }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-2 form-check">
            <input class="form-check-input form-check-primary" type="checkbox" name="outro_cbo_corpo"
                id="outro_cbo_corpo_id">
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
                    name="outros_beneficios">
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>

        </div>
    </div>

@endif
<!-- Fim da verifica se é natimorto -->

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
