<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="idade_mae">Idade da mãe (anos)</label>
        <div class="position-relative">
            <input type="number" id="idade_mae" max="99" min="0" class="form-control" placeholder="Idade da mãe" name="idade_mae">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="ocupacao_mae">Ocupação da mãe</label>
        <div class="position-relative">
            <input type="text" id="ocupacao_mae" class="form-control" placeholder="Ocupação da mãe" name="ocupacao_mae">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="escolaridade_mae">Escolaridade</label>
        <div class="position-relative">
            <select name="escolaridade_mae" id="escolaridade_mae" class="form-control">
                <option value="" disabled selected>Selecione uma opção</option>
                <option value="Sem escolaridade">Sem escolaridade</option>
                <option value="Fundamental I (1ª a 4ª Série)">Fundamental I (1ª a 4ª Série)</option>
                <option value="Fundamental II (5ª a 8ª Série)">Fundamental II (5ª a 8ª Série)</option>
                <option value="Médio (antigo 2º grau)">Médio (antigo 2º grau)</option>
                <option value="Superior incompleto">Superior incompleto</option>
                <option value="Superior completo">Superior completo</option>
                <option value="Ignorado">Ignorado</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-12">
    <div class="form-group has-icon-left">
        <label for="tipo_de_parto">Tipo de parto</label>
        <div class="position-relative">
            <select name="tipo_de_parto" id="" class="form-control">
                <option value="Cesaria">Cesaria</option>
                <option value="Vaginal">Vaginal</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 col-12">
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
<div class="col-md-3 col-12">
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
            <input type="number" id="tempo_gestacao" class="form-control" placeholder="" name="tempo_gestacao">
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
            <input type="text" id="cep" class="form-control" placeholder="CEP" name="cep"
            onblur="pesquisacep(this.value);" >
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
            <input type="text" id="logradouro" class="form-control" placeholder="Logradouro" name="logradouro">
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
                <input type="number" id="numero" class="form-control" placeholder="Numero da residência" name="numero">
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
                <input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro">
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
                <input type="text" id="cidade" class="form-control" placeholder="Cidade" name="cidade">
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
                <input type="text" id="estado" class="form-control" placeholder="Estado" name="estado">
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>