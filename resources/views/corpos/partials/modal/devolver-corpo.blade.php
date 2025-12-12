<div class="modal fade" tabindex="-1" id="modalChoices" aria-labelledby="modalChoicesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informe o motivo e o destino da devolução</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('corpos.devolvercorpo') }}" method="post" id="devolver-corpo-form">
                    @csrf
                    <input type="hidden" name="corpo_id" value="{{ $corpo->id }}">

                    <label for="destino-devolucao" class="form-label">Destino</label>
                    <select id="destino-devolucao" class="form-select" name="estabelecimento_destino" required>
                        <option value="" disabled selected>Selecione o destino</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}" na>{{ $unidade->nome }}</option>
                        @endforeach
                    </select>

                    <label for="justificativa" class="form-label">Justificativa</label>
                    <textarea id="justificativa" class="form-control" placeholder="Digite o motivo da devolução"
                        name="justificativa" required></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Concluir</button>
            </div>
            </form>
        </div>
    </div>
</div>