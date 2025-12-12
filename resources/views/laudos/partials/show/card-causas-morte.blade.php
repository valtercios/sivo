<!-- Inicio card detalhes dos exames -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Causas da morte</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações
                    referentes as causas da morte</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        
                        <h5>PARTE I - Doença ou estado mórbido que causou diretamente a morte</h5>
                        @if ($laudo->causa_a_id != null)
                            <div class="row">
                                <h6>a)</h6>
                                <p>
                                    {{ isset($laudo->causa_a->cid) ? $laudo->causa_a->cid . ' - ' : '' }}
                                    {{ $laudo->causa_a->descricao }} - {{ $laudo->causa_a->tempo }}
                                    {{ $laudo->causa_a->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                        @if ($laudo->causa_b_id != null)
                            <div class="row">
                                <h6>b)</h6>
                                <p>
                                    {{ isset($laudo->causa_b->cid) ? $laudo->causa_b->cid . ' - ' : '' }}
                                    {{ $laudo->causa_b->descricao }} - {{ $laudo->causa_b->tempo }}
                                    {{ $laudo->causa_b->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                        @if ($laudo->causa_c_id != null)
                            <div class="row">
                                <h6>c)</h6>
                                <p>
                                    {{ isset($laudo->causa_c->cid) ? $laudo->causa_c->cid . ' - ' : '' }}
                                    {{ $laudo->causa_c->descricao }} - {{ $laudo->causa_c->tempo }}
                                    {{ $laudo->causa_c->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                        @if ($laudo->causa_d_id != null)
                            <div class="row">
                                <h6>d)</h6>
                                <p>
                                    {{ isset($laudo->causa_d->cid) ? $laudo->causa_d->cid . ' - ' : '' }}
                                    {{ $laudo->causa_d->descricao }} - {{ $laudo->causa_d->tempo }}
                                    {{ $laudo->causa_d->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                        @if ($laudo->causa_outras1_id != null || $laudo->causa_outras2_id != null)
                            <h5>PARTE II - Outras condições significativas que contribuiram para a morte e que não
                                entraram,
                                porém, na cadeia acima.</h5>
                        @endif
                        @if ($laudo->causa_outras1_id != null)
                            <div class="row">
                                <h6>Causa 1</h6>
                                <p>
                                    {{ isset($laudo->causa_outras1->cid) ? $laudo->causa_outras1->cid . ' - ' : '' }}
                                    {{ $laudo->causa_outras1->descricao }} - {{ $laudo->causa_outras1->tempo }}
                                    {{ $laudo->causa_outras1->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                        @if ($laudo->causa_outras2_id != null)
                            <div class="row">
                                <h6>Causa 2</h6>
                                <p>
                                    {{ isset($laudo->causa_outras2->cid) ? $laudo->causa_outras2->cid . ' - ' : '' }}
                                    {{ $laudo->causa_outras2->descricao }} - {{ $laudo->causa_outras2->tempo }}
                                    {{ $laudo->causa_outras2->tipo_tempo }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}
