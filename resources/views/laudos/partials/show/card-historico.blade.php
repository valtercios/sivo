<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Histórico</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Breve descrição do histórico do falecido</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <p>
                                    {{ $laudo->historico }}
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
{{-- Fim Card --}}