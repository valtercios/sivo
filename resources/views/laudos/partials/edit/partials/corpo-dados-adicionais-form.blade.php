<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_civil">Estado Civil</label>
        <div class="position-relative">
            <select name="estado_civil" class="form-control slct2" id="">
                <option value="Solteiro" @if ($laudo->estado_civil == 'Solteiro') {{ 'selected' }} @endif>Solteiro</option>
                <option value="Casado" @if ($laudo->estado_civil == 'Casado') {{ 'selected' }} @endif>Casado</option>
                <option value="Viúvo" @if ($laudo->estado_civil == 'Viúvo') {{ 'selected' }} @endif>Viúvo</option>
                <option value="Separado judicialmente/divorciado" @if ($laudo->estado_civil == 'Separado judicialmente/divorciado') {{ 'selected' }} @endif>Separado judicialmente/divorciado</option>
                <option value="União estável" @if ($laudo->estado_civil == 'União estável') {{ 'selected' }} @endif>União estável</option>
                <option value="Ignorada" @if ($laudo->estado_civil == 'Ignorada') {{ 'selected' }} @endif>Ignorada</option>
            </select>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="cor">Cor</label>
        <div class="position-relative">
            <select name="cor" class="form-control" id="">
                <option value="Branca" @if ($laudo->cor == 'Branca') {{ 'selected' }} @endif>Branca</option>
                <option value="Preta" @if ($laudo->cor == 'Preta') {{ 'selected' }} @endif>Preta</option>
                <option value="Parda" @if ($laudo->cor == 'Parda') {{ 'selected' }} @endif>Parda</option>
                <option value="Indígena" @if ($laudo->cor == 'Indígena') {{ 'selected' }} @endif>Indígena</option>
                <option value="Amarela" @if ($laudo->cor == 'Amarela') {{ 'selected' }} @endif>Amarela</option>
                <option value="Sem informação" @if ($laudo->cor == 'Sem informação') {{ 'selected' }} @endif>Sem
                    informação</option>
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
            <input type="text" id="pai" class="form-control" placeholder="Nome do pai" name="pai"
                value="{{ $laudo->pai ?? '' }}">
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
            <input type="text" id="mae" class="form-control" placeholder="Nome da mãe" name="mae"
                value="{{ $laudo->mae ?? '' }}">
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
            <input type="date" id="data_nascimento" max="9999-12-31" value="{{ $laudo->data_nascimento }}"
                onchange="verificarDataNascimento()" class="form-control" name="data_nascimento">
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
            <input type="text" id="idade" class="form-control" disabled value="0" name="idade">
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
            <input type="text" id="naturalidade" class="form-control" placeholder="Naturalidade do corpo"
                name="naturalidade" value="{{ $laudo->naturalidade ?? "" }}">
            <p><small class="text-muted">Municipio / UF (se estrangeiro informar Pais)</small></p>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group has-icon-left">
        <label for="telefone">Telefone</label>
        <div class="position-relative">
            <input type="text" id="telefone" class="form-control" placeholder="Telefone do corpo" name="telefone" value="{{ $laudo->telefone ?? "" }}">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-12">
    <div class="form-group ">
        <label for="ocupacao">Ocupação</label>
        {{-- <input type="text" name="ocupacao" class="form-control" id=""> --}}
        <div class="position-relative">
            <select name="ocupacao" class="form-control choices" id="">
                <option value="" disabled selected>Selecione uma ocupação</option>
                @foreach ($ocupacoes as $ocupacao)
                    <option value="{{ $ocupacao->id }}" @if($laudo->ocupacao == $ocupacao->id) {{ "selected" }} @endif>{{ $ocupacao->ds_ocupacao }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@section('js')
    <script>
        let choices = document.querySelectorAll('.choices');
        let initChoice;
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ',',
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                });
            } else {
                initChoice = new Choices(choices[i]);
            }
        }
        window.onload = (event) => {

            verificarDataNascimento();

        };

        function verificarDataNascimento() {
            let date1 = new Date('{{ $corpo->data_obito }}');
            let date2 = new Date(document.querySelector('[name=data_nascimento]').value);

            let timeDiff = Math.abs(date2.getTime() - date1.getTime());
            if (date2 > date1) {
                document.querySelector('[name=idade]').value = "Data inválida!";
                return false;
            }
            let diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            let idade = Math.floor(Math.ceil(Math.abs(diffDays)) / 365);
            let idadeMeses = Math.floor(Math.ceil(Math.abs(diffDays)) / 30);
            let anosEmMeses = idade * 12;
            let mesesRestantes = idadeMeses - anosEmMeses;
            if (idade <= 1) {
                document.getElementById('info_obito_fetal').classList.remove('d-none')
                document.getElementById('info_obito_fetal').classList.add('d-block')
            } else {
                document.getElementById('info_obito_fetal').classList.remove('d-block')
                document.getElementById('info_obito_fetal').classList.add('d-none')
            }
            if (idadeMeses === 0) {
                document.querySelector('[name=idade]').value = diffDays === 1 ? diffDays + ' dia' : diffDays + ' dias';

            } else if (diffDays < 365) {
                document.querySelector('[name=idade]').value = idadeMeses === 1 ? idadeMeses + ' mês' : idadeMeses +
                    ' meses';
            } else {
                if (mesesRestantes == 0) {
                    document.querySelector('[name=idade]').value =
                        (idade <= 1 ? idade + ' ano' : idade + ' anos');
                } else {
                    document.querySelector('[name=idade]').value =
                        (idade <= 1 ? idade + ' ano e ' : idade + ' anos e ') + (mesesRestantes === 1 ? mesesRestantes +
                            ' mês' : mesesRestantes + ' meses');
                }

            }
        }
    </script>
@endsection
