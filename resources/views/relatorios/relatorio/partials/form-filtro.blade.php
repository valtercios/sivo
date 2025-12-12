<div class="row" id="filtros">
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="data_recebimento">Data de recebimento</label>
            <div class="position-relative">
                <input type="text" id="data_recebimento" readonly value="{{ request()->get('data_recebimento') ?? '' }}" class="form-control" name="data_recebimento">
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="data_nascimento">Data de nascimento</label>
            <div class="position-relative">
                <input type="text" id="data_nascimento" readonly value="{{ request()->get('data_nascimento') ?? '' }}" class="form-control" name="data_nascimento">
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="data_obito">Data de óbito</label>
            <div class="position-relative">
                <input type="text" id="data_obito" readonly value="{{ request()->get('data_obito') ?? '' }}" class="form-control" name="data_obito">
                <div class="form-control-icon">
                    <i class="bi bi-calendar"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="local_obito">Local do óbito</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="local_obito" class="form-control">
                        <option value="" @if(request()->get('local_obito') == null || empty(request()->get('local_obito'))) {{ 'selected' }} @endif>IGNORAR</option>
                        <option value="Hospital" @if(request()->get('local_obito') == "Hospital") {{ 'selected' }} @endif>Hospital</option>
                        <option value="Outros estab. saúde" @if(request()->get('local_obito') == "Outros estab. saúde") {{ 'selected' }} @endif>Outros estab. saúde</option>
                        <option value="Domicílio" @if(request()->get('local_obito') == "Domicílio") {{ 'selected' }} @endif>Domicílio</option>
                        <option value="Via pública" @if(request()->get('local_obito') == "Via pública") {{ 'selected' }} @endif>Via pública</option>
                        <option value="Outros" @if(request()->get('local_obito') == "Outros") {{ 'selected' }} @endif>Outros</option>
                        <option value="Aldeia Indígena" @if(request()->get('local_obito') == "Aldeia Indígena") {{ 'selected' }} @endif>Aldeia Indígena</option>
                        <option value="Ignorado" @if(request()->get('local_obito') == "Ignorado") {{ 'selected' }} @endif>Ignorado</option>
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="natimorto">Natimorto</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="natimorto" class="form-control">

                        <option value="" @if(request()->get('natimorto') == null || empty(request()->get('natimorto'))) {{ 'selected' }} @endif>IGNORAR</option>
                        <option value="0" @if(request()->get('natimorto') == "0") {{ 'selected' }} @endif>NÃO</option>
                        <option value="1" @if(request()->get('natimorto') == "1") {{ 'selected' }} @endif>SIM</option>
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="sexo">Sexo</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="sexo" class="form-control">
                        <option value="" @if(request()->get('sexo') == null || empty(request()->get('sexo'))) {{ 'selected' }} @endif>IGNORAR</option>
                        <option value="M" @if(request()->get('sexo') == "M") {{ 'selected' }} @endif>Masculino</option>
                        <option value="F" @if(request()->get('sexo') == "F") {{ 'selected' }} @endif>Feminino</option>
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-gender-ambiguous"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="funeraria">Funerária</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="funeraria" class="form-control">
                        <option value="" @if(request()->get('funeraria') == null || empty(request()->get('funeraria'))) {{ 'selected' }} @endif>IGNORAR</option>
                        @foreach ($funerarias as $funeraria)
                            <option value="{{ $funeraria->id }}" @if(request()->get('funeraria') == $funeraria->id) {{ 'selected' }} @endif>{{ $funeraria->nome }}</option>
                        @endforeach
                        
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="estado">Estado</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="estado" class="form-control">
                        <option value="" selected>IGNORAR</option>
                        @foreach ($estados as $key => $estado)
                            
                            <option value="{{ $estado->estado }}" @if(request()->get('estado') == $estado->estado) {{ 'selected' }} @endif>{{ buscarEstado($estado->estado) }}</option>
                        @endforeach
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="form-group has-icon-left">
            <label for="cidade">Cidade</label>
            <div class="position-relative">
                <div class="position-relative">
                    <select name="cidade" class="form-control">
                        <option value="" selected>IGNORAR</option>
                        @foreach ($cidades as $key => $cidade)
                            
                            <option value="{{ $cidade->cidade }}" @if(request()->get('cidade') == $cidade->cidade) {{ 'selected' }} @endif>{{ $cidade->cidade }}</option>
                        @endforeach
                    </select>

                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>



