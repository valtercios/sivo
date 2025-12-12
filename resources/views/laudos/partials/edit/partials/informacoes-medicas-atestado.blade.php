<h6>PARTE I - Doença ou estado mórbido que causou diretamente a morte</h6>
{{-- INICIO CAUSA BLOCO --}}
<div class="row">
    a)
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="causa_a_descricao" class="form-label">Descrição</label>
            <input type="text" name="causa_a_descricao" class="form-control"
                value="{{ $laudo->causa_a->descricao ?? '' }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_a_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_a_tempo" class="form-control" aria-label="Tempo"
                    value="{{ $laudo->causa_a->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_a_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas</option>
                    <option value="dias" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias</option>
                    <option value="semanas" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses</option>
                    <option value="anos" @if (isset($laudo->causa_a) && $laudo->causa_a->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_a_cid" class="form-control" value="{{ $laudo->causa_a->cid ?? '' }}">
        </div>
    </div>
</div>
{{-- FIM CAUSA BLOCO --}}

{{-- INICIO CAUSA BLOCO --}}
<div class="row">
    b)
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="causa_b_descricao" class="form-label">Descrição</label>
            <input type="text" name="causa_b_descricao" class="form-control"
                value="{{ $laudo->causa_b->descricao ?? '' }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_b_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_b_tempo" class="form-control" aria-label="Tempo"
                    value="{{ $laudo->causa_b->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_b_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas</option>
                    <option value="dias" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias</option>
                    <option value="semanas" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses
                    </option>
                    <option value="anos" @if (isset($laudo->causa_b) && $laudo->causa_b->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_b_cid" class="form-control" value="{{ $laudo->causa_b->cid ?? '' }}">
        </div>
    </div>
</div>
{{-- FIM CAUSA BLOCO --}}

{{-- INICIO CAUSA BLOCO --}}
<div class="row">
    c)
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="causa_c_descricao" class="form-label">Descrição</label>
            <input type="text" name="causa_c_descricao" class="form-control"
                value="{{ $laudo->causa_c->descricao ?? '' }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_c_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_c_tempo" class="form-control" aria-label="Tempo"
                    value="{{ $laudo->causa_c->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_c_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas
                    </option>
                    <option value="dias" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias
                    </option>
                    <option value="semanas" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses
                    </option>
                    <option value="anos" @if (isset($laudo->causa_c) && $laudo->causa_c->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_c_cid" class="form-control" value="{{ $laudo->causa_c->cid ?? '' }}">
        </div>
    </div>
</div>
{{-- FIM CAUSA BLOCO --}}

{{-- INICIO CAUSA BLOCO --}}
<div class="row">
    d)
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="causa_d_descricao" class="form-label">Descrição</label>
            <input type="text" name="causa_d_descricao" class="form-control"
                value="{{ $laudo->causa_d->descricao ?? '' }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_d_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_d_tempo" class="form-control" aria-label="Tempo"
                    value="{{ $laudo->causa_d->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_d_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas
                    </option>
                    <option value="dias" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias
                    </option>
                    <option value="semanas" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses
                    </option>
                    <option value="anos" @if (isset($laudo->causa_d) && $laudo->causa_d->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_d_cid" class="form-control" value="{{ $laudo->causa_d->cid ?? '' }}">
        </div>
    </div>
</div>
{{-- FIM CAUSA BLOCO --}}
<h6>PARTE II - Outras condições significativas que contribuiram para a morte e que não entraram, porém, na
    cadeia acima.</h6>
<div class="row">
    1
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">Descrição</label>
            <input type="text" name="causa_extra1_descricao" class="form-control"
                value="{{ $laudo->causa_outras1->descricao ?? '' }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_extra1_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_extra1_tempo" class="form-control"
                    aria-label="Tempo" value="{{ $laudo->causa_outras1->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_extra1_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas
                    </option>
                    <option value="dias" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias
                    </option>
                    <option value="semanas" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses
                    </option>
                    <option value="anos" @if (isset($laudo->causa_outras1) && $laudo->causa_outras1->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class=" col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_extra1_cid" class="form-control"
                value="{{ $laudo->causa_outras1->cid ?? '' }}">
        </div>
    </div>
</div>

<div class="row">
    2
    <div class=" col-6">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">Descrição</label>
            <input type="text" name="causa_extra2_descricao" class="form-control" value="{{ $laudo->causa_outras2->descricao ?? "" }}">
        </div>
    </div>
    <div class=" col-3">
        <div class="form-group mb-3">
            <label for="causa_extra2_tempo" class="form-label">Tempo</label>

            <div class="input-group">
                <input type="number" min="0" name="causa_extra2_tempo" class="form-control"
                    aria-label="Tempo" value="{{ $laudo->causa_outras2->tempo ?? '' }}">
                <span class="input-group-text"><i class="bi-clock-history"></i></span>
                <select name="causa_extra2_tipo_tempo" id="" class="form-control">
                    <option value="" disabled selected>Tempo</option>
                    <option value="minutos" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'minutos') {{ 'selected' }} @endif>Minutos
                    </option>
                    <option value="horas" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'horas') {{ 'selected' }} @endif>Horas
                    </option>
                    <option value="dias" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'dias') {{ 'selected' }} @endif>Dias
                    </option>
                    <option value="semanas" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'semanas') {{ 'selected' }} @endif>Semanas
                    </option>
                    <option value="meses" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'meses') {{ 'selected' }} @endif>Meses
                    </option>
                    <option value="anos" @if (isset($laudo->causa_outras2) && $laudo->causa_outras2->tipo_tempo == 'anos') {{ 'selected' }} @endif>Anos
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class=" col-2">
        <div class="form-group mb-3">
            <label for="exame_macroscopia" class="form-label">CID</label>
            <input type="text" name="causa_extra2_cid" class="form-control" value="{{ $laudo->causa_outras2->cid ?? "" }}">
        </div>
    </div>
</div>