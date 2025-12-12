{{-- modal --}}
<div class="modal fade" id="justificativaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">justificativa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="justificativa">Escreva o motivo da alteração: <span style="color: red;">(Campo obrigatório)</span> </label>
                <textarea name="justificativa" id="justificativa" cols="30" rows="10"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary me-1 mb-1" id="confirmarEnvio">Salvar</button>
                
            </div>
        </div>
    </div>
</div>
