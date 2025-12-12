<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="estado_civil">Estado Civil</label>
        <div class="position-relative">
            <select name="estado_civil" class="form-control slct2" id="">
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
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="cor">Cor</label>
        <div class="position-relative">
            <select name="cor" class="form-control" id="">
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
<div class="col-md-6 col-12">
    <div class="form-group has-icon-left">
        <label for="pai">Pai</label>
        <div class="position-relative">
            <input type="text" id="pai" class="form-control" placeholder="Nome do pai" name="pai">
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
            <input type="text" id="mae" class="form-control" placeholder="Nome da mãe" name="mae">
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
            <input type="date" id="data_nascimento" max="9999-12-31" disabled value="{{ $corpo->data_nascimento ?? '' }}" onchange="verificarDataNascimento()" class="form-control"  name="data_nascimento">
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
            <input type="text" id="idade" class="form-control" disabled value="{{ calcularIdade($corpo->data_nascimento, $corpo->data_obito)->text }}"  name="idade">
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
            <input type="text" id="naturalidade" class="form-control" placeholder="Naturalidade do corpo"  name="naturalidade">
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
            <input type="text" id="telefone" class="form-control" placeholder="Telefone do corpo"  name="telefone">
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
                    <option value="{{$ocupacao->id}}">{{$ocupacao->ds_ocupacao}}</option>
                    
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
</script>
@endsection