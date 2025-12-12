<div class="col-12" id="cadastro-corpo">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display: inline-block;">Dados adicionais do corpo</h4>
            {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#pesquisa-ocupacao"
                    class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-search"></i>
                    Pesquisar Ocupacao</a> --}}
            <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Dados adicionais referentes ao corpo</p>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    @include('entrevistas.partials.edit.partials.corpo-dados-adicionais-form')
                </div>
            </div>
        </div>
    </div>
</div>