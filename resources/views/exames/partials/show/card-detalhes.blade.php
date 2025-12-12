<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">Detalhes</h4>
        @can('exames_reply')
            @if(!$exame->respondido_por)
                <a href="{{ route('exames.responder', $exame->id) }}" class="btn btn-sm icon btn-primary mx-1" style="float:right;"><i class="bi bi-clipboard2-check"></i> Responder exame</a>
            @endif
        @endcan
        <a href="{{ route('exames.index') }}" class="btn btn-sm icon btn-secondary mx-1" style="float:right;"><i class="bi bi-arrow-left"></i> Voltar</a>
        <br>
        <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações referentes ao exame</p>
    </div>
    <div class="card-body">
        <div class="form-body">
            <div class="row">
                 {{-- Inicio do bloco --}}
                 <div class="col-md-4">
                    <label>Tipo do exame</label>
                </div>
                <div class="col-md-8 form-group">
                    {{ $exame->tipo_exame }}
                </div>
                {{-- Fim do bloco --}}
                {{-- Inicio do bloco --}}
                <div class="col-md-4">
                    <label>Referente ao corpo de</label>
                </div>
                <div class="col-md-8 form-group">
                    {{ $exame->corpo->nome }} <a href="{{ route('corpos.show', $exame->corpo->id) }}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="right" title="Ver informações do corpo"><i class="bi bi-info-circle-fill"></i></a>
                </div>
                {{-- Fim do bloco --}}
                {{-- Inicio do bloco --}}
                <div class="col-md-4">
                    <label>Solicitado por</label>
                </div>
                <div class="col-md-8 form-group">
                    {{ $exame->solicitante->name }}
                </div>
                {{-- Fim do bloco --}}
                {{-- Inicio do bloco --}}
                <div class="col-md-4">
                    <label>Data de solicitação</label>
                </div>
                <div class="col-md-8 form-group">
                    {{ \Carbon\Carbon::parse($exame->created_at)->format('d/m/Y H:i:s') }}
                </div>
                {{-- Fim do bloco --}}
                {{-- Inicio do bloco --}}
                <div class="col-md-4">
                    <label>Observações</label>
                </div>
                <div class="col-md-8 form-group">
                    {{ $exame->observacao }}
                </div>
                {{-- Fim do bloco --}}
            </div>
        </div>
    </div>
</div>