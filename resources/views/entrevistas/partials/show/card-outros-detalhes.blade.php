<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Outros detalhes</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Outros detalhes referentes ao corpo</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Identificador</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $entrevista->id }}
                            </div>
                            {{-- Fim do bloco --}}
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Data/Hora da entrevista</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ \Carbon\Carbon::parse($entrevista->created_at)->format('d/m/Y H:i:s') }}
                            </div>
                            {{-- Fim do bloco --}}
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Entrevistado por</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $entrevista->entrevistador->name }}
                            </div>
                            {{-- Fim do bloco --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}
