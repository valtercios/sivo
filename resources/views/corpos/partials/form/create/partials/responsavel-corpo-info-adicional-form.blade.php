<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="grau_parentesco">Grau de parentesco</label><span class="text-danger"> *</span>
        <div class="position-relative">
           
            <select class="form-control" id="grau_parentesco_responsavel_id" required name="grau_parentesco_responsavel"  onchange="verificaParentesco()">
                <option value="" disabled {{ !old('grau_parentesco_responsavel') ? 'selected' : '' }}>Selecione o grau de parentesco</option>
                <optgroup label="Grau por afinidade">
                    <option value="Cônjuge" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Cônjuge") {{'selected'}} @endif>Cônjuge</option>
                    <option value="Companheiro(a) com comprovante de união estável" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Companheiro(a) com comprovante de união estável") {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
                    <option value="Companheiro(a) sem comprovante de união estável" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Companheiro(a) sem comprovante de união estável") {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
                </optgroup>
                <optgroup label="1° Grau">
                    <option value="Filho(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Filho(a)") {{'selected'}} @endif>Filho(a)</option>
                    <option value="Pai/Mãe" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Pai/Mãe") {{'selected'}} @endif>Pai/Mãe</option>
                </optgroup>
                <optgroup label="2° Grau">
                    <option value="Neto(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Neto(a)") {{'selected'}} @endif>Neto(a)</option>
                    <option value="Avô/Avó" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Avô/Avó") {{'selected'}} @endif>Avô/Avó</option>
                    <option value="Irmão(ã)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Irmão(ã)") {{'selected'}} @endif>Irmão(ã)</option>
                </optgroup>
                <optgroup label="3° Grau">
                    <option value="Bisneto(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Bisneto(a)") {{'selected'}} @endif>Bisneto(a)</option>
                    <option value="Bisavô/Bisavó" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Bisavô/Bisavó") {{'selected'}} @endif>Bisavô/Bisavó</option>
                    <option value="Tio(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Tio(a)") {{'selected'}} @endif>Tio(a)</option>
                    <option value="Sobrinho(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Sobrinho(a)") {{'selected'}} @endif>Sobrinho(a)</option>
                </optgroup>
                <optgroup label="4° Grau">
                    <option value="Trineto(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Trineto(a)") {{'selected'}} @endif>Trineto(a)</option>
                    <option value="Trisavô/Trisavó" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Trisavô/Trisavó") {{'selected'}} @endif>Trisavô/Trisavó</option>
                    <option value="Sobrinho(a)-neto(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Sobrinho(a)-neto(a)") {{'selected'}} @endif>Sobrinho(a)-neto(a)</option>
                    <option value="Tio(a)-avô(ó)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Tio(a)-avô(ó)") {{'selected'}} @endif>Tio(a)-avô(ó)</option>
                    <option value="Primo(a)" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Primo(a)") {{'selected'}} @endif>Primo(a)</option>
                </optgroup>
                <optgroup label="Outras opções">
                    <option value="Outros" @if(old('grau_parentesco_responsavel') !== null && old('grau_parentesco_responsavel') == "Outros") {{'selected'}} @endif>Outros</option>
                </optgroup>
                </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12" id='grau_parentesco_outro' style="display: none;" >
    <div class="form-group has-icon-left">
        <label for="grau-parentesco">Outro grau de parentesco</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <input type="text" class="form-control" id="grau_parentesco_responsavel_outro" name="grau_parentesco_responsavel_outros" value="{{ old('grau_parentesco_responsavel_outros') }}" placeholder="Digite o grau de parentesco" >
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="corpoSera">Familia informa que o corpo será</label><span class="text-danger"> *</span>
        <div class="form-group">
            <div class="position-relative">
                <select name="corpoSera" class="form-control" required id="corpoSera">
                    <option value="" disabled {{ !old('corpoSera') ? 'selected' : '' }}>Selecione uma opção</option>
                    <option value="sepultado" @if(old('corpoSera') !== null && old('corpoSera') == "sepultado") {{'selected'}} @endif>Sepultado</option>
                    <option value="cremado" @if(old('corpoSera') !== null && old('corpoSera') == "cremado") {{'selected'}} @endif>Cremado</option>
                    <option value="doado" @if(old('corpoSera') !== null && old('corpoSera') == "doado") {{'selected'}} @endif>Doado</option>
                    <option value="outros" @if(old('corpoSera') !== null && old('corpoSera') == "outros") {{'selected'}} @endif>Outros</option>

                </select>
                <div class="form-control-icon">
                    <i class="bi bi-card-list"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="destino_do_corpo">Destino do corpo</label>
        <div class="position-relative">
            <input type="text" class="form-control" id="destino_do_corpo" name="destino_do_corpo" placeholder="Destino do corpo">
            <div class="form-control-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
        </div>
    </div>
</div>

<script>

    function verificaParentesco() {
        var parentesco = $("#grau_parentesco_responsavel_id option:selected" ).val();
        var campo_outro_parentesco = document.getElementById('grau_parentesco_outro');

        console.log(parentesco);
        if (parentesco == "Outros") {
            campo_outro_parentesco.style.display = 'block';
        } else {
            campo_outro_parentesco.style.display = 'none';
            //limpa o campo
            $('#grau_parentesco_responsavel_outro').val(' ');
        }
    }

</script>
