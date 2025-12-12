<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">Dados do parente</h4>
        <br>
        <p class="text-subtitle text-muted" style="display: inline-block; margin-bottom: -10px;">Informações do parente.</p>

    </div>
    <div class="card-body">
        
        <div class="row">
            <div class=" col-6">
                <div class="form-group">
                    <label for="nome_parente">Nome</label>
                    <input type="text" id="nome_parente" value=" {{$corpo->responsavelCorpo->nome}}" class="form-control" placeholder="Nome do parente"
                        name="nome_parente">
                </div>
            </div>
            <div class=" col-6">
                <div class="form-group">
                    <label for="documento_parente">RG</label>
                    <input type="text" id="documento_parente" class="form-control"
                        placeholder="CPF ou RG da testemunha" name="documento_parente"
                        @if($corpo->responsavelCorpo->tipo_documento == "CPF") value="{{$corpo->responsavelCorpo->cpf}}" @else value="{{$corpo->responsavelCorpo->rg}}" @endif>
                        
                </div>
            </div>

            {{-- data nascimento da testemunha --}}
            <div class=" col-6">
                <div class="form-group" >
                    <label for="data_nascimento_parente">Data de nascimento</label>
                    <input type="date" id="data_nascimento_parente" class="form-control"
                        placeholder="Data de nascimento do parente" name="data_nascimento_parente">
                </div>
            </div>
                
                {{-- grau de parentesco --}}

                <div class="col-md-6 col-12">
                    <div class="form-group has-icon-left">
                        <label for="grau_parentesco_responsavel">Grau de parentesco</label>
                        <div class="position-relative">
                            <select class="form-control" id="grau_parentesco_responsavel" name="grau_parentesco_responsavel" onchange="verificaParentescosEdit()" required >
                                <option value="" disabled selected>Selecione o grau de parentesco</option>
                                <optgroup label="Grau por afinidade">
                                    <option value="Cônjuge" @if($corpo->responsavelCorpo->grau_parentesco == "Cônjuge") {{'selected'}} @endif>Cônjuge</option>
                                    <option value="Companheiro(a) com comprovante de união estável" @if($corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) com comprovante de união estável") {{'selected'}} @endif>Companheiro(a) com comprovante de união estável</option>
                                    <option value="Companheiro(a) sem comprovante de união estável" @if($corpo->responsavelCorpo->grau_parentesco == "Companheiro(a) sem comprovante de união estável") {{'selected'}} @endif>Companheiro(a) sem comprovante de união estável</option>
                            
                                </optgroup>
                                <optgroup label="1° Grau">
                                    <option value="Filho" @if($corpo->responsavelCorpo->grau_parentesco == "Filho") {{'selected'}} @endif>Filho</option>
                                    <option value="Pai" @if($corpo->responsavelCorpo->grau_parentesco == "Pai") {{'selected'}} @endif>Pai</option>
                                    <option value="Mãe" @if($corpo->responsavelCorpo->grau_parentesco == "Mãe") {{'selected'}} @endif>Mãe</option>
                                    <option value="Pai/Mãe" @if($corpo->responsavelCorpo->grau_parentesco == "Pai/Mãe") {{'selected'}} @endif>Pai/Mãe</option>
                                </optgroup>
                                <optgroup label="2° Grau">
                                    <option value="Neto" @if($corpo->responsavelCorpo->grau_parentesco == "Neto") {{'selected'}} @endif>Neto</option>
                                    <option value="Avós" @if($corpo->responsavelCorpo->grau_parentesco == "Avós") {{'selected'}} @endif>Avós</option>
                                    <option value="Irmãos" @if($corpo->responsavelCorpo->grau_parentesco == "Irmãos") {{'selected'}} @endif>Irmãos</option>
                                </optgroup>
                                <optgroup label="3° Grau">
                                    <option value="Bisneto" @if($corpo->responsavelCorpo->grau_parentesco == "Bisneto") {{'selected'}} @endif>Bisneto</option>
                                    <option value="Bisavós" @if($corpo->responsavelCorpo->grau_parentesco == "Bisavós") {{'selected'}} @endif>Bisavós</option>
                                    <option value="Tios" @if($corpo->responsavelCorpo->grau_parentesco == "Tios") {{'selected'}} @endif>Tios</option>
                                    <option value="Sobrinhos" @if($corpo->responsavelCorpo->grau_parentesco == "Sobrinhos") {{'selected'}} @endif>Sobrinhos</option>
                                </optgroup>
                                <optgroup label="4° Grau">
                                    <option value="Trineto" @if($corpo->responsavelCorpo->grau_parentesco == "Trineto") {{'selected'}} @endif>Trineto</option>
                                    <option value="Trisavós" @if($corpo->responsavelCorpo->grau_parentesco == "Trisavós") {{'selected'}} @endif>Trisavós</option>
                                    <option value="Sobrinho-neto" @if($corpo->responsavelCorpo->grau_parentesco == "Sobrinho-neto") {{'selected'}} @endif>Sobrinho-neto</option>
                                    <option value="Tio-avô" @if($corpo->responsavelCorpo->grau_parentesco == "Tio-avô") {{'selected'}} @endif>Tio-avô</option>
                                    <option value="Primo" @if($corpo->responsavelCorpo->grau_parentesco == "Primo") {{'selected'}} @endif>Primo</option>
                                </optgroup>
                                <optgroup label="Outras opções">
                                    <option value="Outros" @if($corpo->responsavelCorpo->grau_parentesco == "Outros") {{'selected'}} @endif>Outros</option>
                                </optgroup>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-6 col-12" id='grau_parentesco_responsavel_outroDiv' style="display: none;" >
                    <div class="form-group has-icon-left">
                        <label for="grau-parentesco">Outro grau de parentesco</label><span class="text-danger"> *</span>
                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" class="form-control" id="grau_parentesco_responsavel_outro" value="{{$corpo->responsavelCorpo->outro_parentesco}}" name="grau_parentesco_responsavel_outro" value="{{ old('grau_parentesco_responsavel_outros') }}" placeholder="Digite o grau de parentesco" >
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- nome do pai --}}
                <div class=" col-6">
                    <div class="form-group
                        ">
                        <label for="nome_pai">Nome do pai</label>
                        <input type="text" id="nome_pai" class="form-control" placeholder="Nome do pai" name="nome_pai">
                        
                    </div>
                </div>
                
                {{-- nome da mae --}}
                <div class=" col-6">
                    <div class="form-group
                        ">
                        <label for="nome_mae">Nome da Mãe</label>
                        <input type="text" id="nome_mae" class="form-control" placeholder="Nome do mae" name="nome_mae">
                        
                    </div>
                </div>

        </div>

    </div>
</div>



<script>
    function verificaParentescosEdit() {
        var grau_parentesco = $("#grau_parentesco_responsavel option:selected" ).val();
        var outro_parentescoEdit = document.getElementById('grau_parentesco_responsavel_outroDiv');
        console.log(grau_parentesco);
        if (grau_parentesco === "Outros") {
            outro_parentescoEdit.style.display = 'block';
        } else {
            outro_parentescoEdit.style.display = 'none';
        }
    }
</script>