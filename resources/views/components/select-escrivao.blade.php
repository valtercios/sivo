<div class="col-12">
    <div class="card">
        <div class="header" style="margin-top: 20px; margin-left: 30px;">
        <div class="row">
            <h4 class="card-title">Dados do escrivão</h4>
            <p class="text-subtitle text-muted" style="margin-left: 5px;">Selecione o escrivão</p>
        </div>

        <div class="row" style="margin-left: 30px;">
            <!-- Select do escrivão -->
            <div class="col-md-5 col-12">
                <div class="form-group has-icon-left">
                    <div class="position-relative">
                        <select class="form-control select2" id="escrivao_id" name="escrivao_id">
                            <option value="">Selecione o escrivão</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{
                                        (isset($corpo) && $corpo?->cadastradoPor == $usuario->id ) || 
                                        (isset($entrevista) && $entrevista?->entrevistado_por == $usuario->id) ||
                                        (isset($laudo) && $laudo?->medico == $usuario->id)
                                        ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Campo de anexo de documento -->
            @if (isset($flag_laudo))
            <div class="col-md-6 col-12">
                <input type="file" placeholder="Anexar documento" class="form-control" id="anexo" name="anexo"  accept="application/pdf">

            </div>
            @endif
        </div>
    </div>
</div>
