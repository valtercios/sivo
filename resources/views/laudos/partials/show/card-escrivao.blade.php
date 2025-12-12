<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Detalhes do responsável pelo preenchimento dos
                    dados do laudo</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Informações referentes ao responsável
                    pelo preenchimento dos dados do laudo.</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Medico</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $medico->name ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}
                        </div>
                        <div class="row"></div>

                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Digitador</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $laudo->digitador->name ?? '' }}
                            </div>
                            {{-- Fim do bloco --}}
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Anexo Laudo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                @if ($laudo->file_path)
                                <a href="{{ route('laudos.download', $laudo->id) }}" class="btn btn-primary"
                                    target="_blank">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Abrir anexo
                                </a>
                                @else
                                <span class="text-muted
                                        {{ $laudo->file_name ? 'text-success' : 'text-danger' }}">
                                    <i class="bi bi-x-circle"></i> Sem anexo
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>