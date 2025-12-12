<input type="hidden" name="obito_fetal" value="1">
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="data_nascimento_mae">Data de nascimento da mãe</label><span class="text-danger"> *</span>
        <div class="position-relative">
            <input type="date" id="data_nascimento_mae" required class="form-control" name="data_nascimento_mae">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12" id="divOcupacaoSelect" style="display: block;" >
    <div class="form-group has-icon-left">
        <label for="ocupacao_mae_title">Ocupação da mãe</label>
        <a href="javascript:void(0)" style="float:right;" onclick="exibirModalOcupacao('ocupacao_mae_id')">Procurar
            ocupação</a>
        <div class="position-relative">
            <select name="ocupacao_mae_id" id="ocupacao_mae_id" class="form-control choices" >
                <option value="" disabled selected>Selecione uma ocupação</option>
                @foreach ($ocupacoes as $ocupacao)
                @if(isset($ocupacao->TIPO) && $ocupacao->TIPO == "Ocupação")
                    <option value="{{$ocupacao->id}}">{{$ocupacao->co_cbo ?? $ocupacao->co_cbo ??' '}}  {{$ocupacao->ds_ocupacao ?? $ocupacao->ds_ocupacao ?? ' '}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <input type="checkbox" class="form-check-input form-check-primary" name="aposentado_mae">
        <label class="form-check-label" for="">Aposentado</label>

        <input id="outro_cbo_mae" type="checkbox" class="form-check-input form-check-primary"
        style="align-items: flex-end" name="outro_cbo_mae">
        <label class="form-check-label" for="">Outra ocupação</label>
    </div>
</div>

<div class="col-md-4 col-12" id="divCampoText" style="display: none;">
    <div class="form-group has-icon-left">
        <label for="ocupacao_mae_id">Ocupação da mãe</label>
        <div class="position-relative">
            <input type="text" id="novo_cbo_mae" class="form-control" placeholder="Digite a ocupação da mãe"
                name="novo_cbo_mae" >
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>

        <input type="checkbox" class="form-check-input form-check-primary" name="aposentado_mae2">
        <label class="form-check-label" for="">Aposentado</label>

        <input id="outro_cbo_mae_2" type="checkbox" class="form-check-input form-check-primary"
        style="align-items: flex-end" name="outro_cbo_mae_2">
        <label class="form-check-label" for="">Outra ocupação</label>
        
    </div>
</div>
<div class="col-md-3 col-12">
    <div class="form-group has-icon-left">
        <label for="escolaridade_mae">Escolaridade</label>
        <div class="position-relative">
            <select name="escolaridade_mae" id="escolaridade_mae" required class="form-control">
                <option value="Sem escolaridade">Sem escolaridade</option>
                <option value="Fundamental I (1ª a 4ª Série)">Fundamental I (1ª a 4ª Série)</option>
                <option value="Fundamental II (5ª a 8ª Série)">Fundamental II (5ª a 8ª Série)</option>
                <option value="Médio incompleto (antigo 2º grau)">Médio incompleto (antigo 2º grau)</option>
                <option value="Médio completo (antigo 2º grau)">Médio completo (antigo 2º grau)</option>
                <option value="Superior incompleto">Superior incompleto</option>
                <option value="Superior completo">Superior completo</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="tipo_de_parto">Tipo de parto</label>
        <div class="position-relative">
            <select name="tipo_de_parto" required id="" class="form-control">
                <option value="Cesaria">Cesaria</option>
                <option value="Vaginal">Vaginal</option>
                <option value="NaoInformado">Nao Informado</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-12">
    <div class="form-group has-icon-left">
        <label for="morte_relacao_parto">Morte em relação ao parto</label>
        <div class="position-relative">
            <select name="morte_relacao_parto" required id="" class="form-control">
                <option value="Antes">Antes</option>
                <option value="Durante">Durante</option>
                <option value="Depois">Depois</option>
                <option value="Ignorado">Ignorado</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="nm">NM</label>
        <div class="position-relative">
            <input type="number" id="nm" class="form-control" placeholder="" name="nm">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-12">
    <div class="form-group has-icon-left">
        <label for="nv">NV</label>
        <div class="position-relative">
            <input type="number" id="nv" class="form-control" placeholder="" name="nv">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-12">
    <div class="form-group has-icon-left">
        <label for="tempo_gestacao">Tempo de gestação (semanas)</label>
        <div class="position-relative">
            <input type="number" id="tempo_gestacao" class="form-control" placeholder=""
                name="tempo_gestacao">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cep">CEP</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="cep_mae" required class="form-control" placeholder="CEP" name="cep_mae"
                onblur="pesquisacep(this.value, '_mae');">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="logradouro">Logradouro</label><span class="text-danger"> *</span>

        <div class="position-relative">
            <input type="text" id="logradouro_mae" required class="form-control" placeholder="Logradouro"
                name="logradouro_mae">
            <div class="form-control-icon">
                <i class="bi bi-card-list"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="numero">Número</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="number" id="numero_mae" required class="form-control"
                    placeholder="Numero da residência" name="numero_mae">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-2 col-6">
    <div class="form-group has-icon-left">
        <label for="complemento">Complemento</label>
        <div class="form-group">
            <div class="position-relative">
                <input type="number" id="complemento_mae" class="form-control" placeholder="Complemento"
                    name="complemento_mae">
                <div class="form-control-icon">
                    <i class="bi bi-list-ol"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="bairro">Bairro</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="bairro_mae" required   class="form-control" placeholder="Bairro"
                    name="bairro_mae">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="cidade">Cidade</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="cidade_mae" class="form-control" placeholder="Cidade"
                    name="cidade_mae">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="estado">Estado</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" id="estado_mae" required class="form-control" placeholder="Estado"
                    name="estado_mae">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div> 
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
</div>


<script>
    // Obtém uma referência ao checkbox e aos campos
    var checkbox = document.getElementById('outro_cbo_mae');
    var checkbox2 = document.getElementById('outro_cbo_mae_2');
    var selectCampo = document.getElementById('divOcupacaoSelect');
    var inputCampo = document.getElementById('divCampoText');
    // Adiciona um ouvinte de evento para o evento 'change' do checkbox
    checkbox.addEventListener('change', function() {
        // Verifica se o checkbox está selecionado
        if (checkbox.checked) {
            // Se estiver selecionado, habilita o campo de seleção e desabilita o campo de texto
            selectCampo.style.display = 'none';
            inputCampo.style.display = 'block';
            checkbox2.checked = true;
        } else {
            // Se não estiver selecionado, desabilita o campo de seleção e exibe o campo de texto
            selectCampo.style.display= 'block';
            inputCampo.style.display = 'none';
            checkbox2.checked = false;
        }
    });
    checkbox2.addEventListener('change', function() {
        // Verifica se o checkbox está selecionado
        if (checkbox2.checked) {
            // Se estiver selecionado, habilita o campo de seleção e desabilita o campo de texto
            selectCampo.style.display = 'none';
            inputCampo.style.display = 'block';
            checkbox.checked = true;
        } else {
            // Se não estiver selecionado, desabilita o campo de seleção e exibe o campo de texto
            selectCampo.style.display = 'block';
            inputCampo.style.display = 'none';
            checkbox.checked = false;
        }
    });
</script>