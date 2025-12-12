<div class="col-12" id="cadastro-corpo">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display: inline-block;">Dados do corpo</h4>
            <a href="{{ route('corpos.show', $corpo->id) }}" target="_blank" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-search"></i> Ver mais detalhes</a>
            <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Dados referentes ao corpo</p>
        
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    @include('laudos.partials.edit.partials.corpo-dados-form')
                </div>
            </div>
        </div>
    </div>
</div>