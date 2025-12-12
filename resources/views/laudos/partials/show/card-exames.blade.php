<!-- Inicio card detalhes dos exames -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Exames</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Breve resumo dos exames</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <h6>Geral</h6>
                                <p>
                                    {{ $laudo->exame_geral }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Cabeça</h6>
                                <p>
                                    {{ $laudo->exame_cabeca }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Tórax</h6>
                                <p>
                                    {{ $laudo->exame_torax ?? '' }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Abdome</h6>
                                <p>
                                    {{ $laudo->exame_abdome }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Genitália</h6>
                                <p>
                                    {{ $laudo->exame_genitalia }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Membros</h6>
                                <p>
                                    {{ $laudo->exame_membros }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Macroscopia</h6>
                                <p>
                                    {{ $laudo->exame_macroscopia }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Microscopia</h6>
                                <p>
                                    {{ $laudo->exame_microscopia }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Conclusões Diagonósticas</h6>
                                <p>
                                    {{ $laudo->exame_conclusoes }}
                                </p>
                            </div>
                            <div class="row">
                                <h6>Data e Hora do exame</h6>
                                <p>
                                    @if(!empty($laudo->data_exame))
                                    {{ \Carbon\Carbon::parse($laudo->data_exame)->format('d-m-Y à\s H:i') }}
                                    @elseif(!empty($laudo->created_at))
                                    {{ \Carbon\Carbon::parse($laudo->created_at)->format('d-m-Y à\s H:i') }}
                                    @else
                                        SEM EXAMES
                                    @endif
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
{{-- Fim Card --}}