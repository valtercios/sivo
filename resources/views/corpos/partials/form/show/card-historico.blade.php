<style>
    .timeline-with-icons {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
    }

    .timeline-with-icons .timeline-item {
        position: relative;
    }

    .timeline-with-icons .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-with-icons .timeline-icon {
        position: absolute;
        left: -48px;
        background-color: hsl(217, 88.2%, 90%);
        color: hsl(217, 88.8%, 35.1%);
        border-radius: 50%;
        height: 31px;
        width: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Histórico de ações</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Histórico de ações referentes ao corpo</p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <!-- Section: Timeline -->
                    <section class="py-2 px-3">
                        <ul class="timeline-with-icons">
                            @forelse ($historico as $item)
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="{{ $item->icon }}"></i>
                                    </span>

                                    <h5 class="fw-bold">{{ $item->titulo }}</h5>
                                    <p class="text-muted mb-2 fw-bold">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d \d\e F \d\e Y') }}</p>
                                    <p class="text-muted">
                                        {{ $item->conteudo }}
                                    </p>
                                </li>
                            @empty
                                <h5>Não houve nenhuma movimentação</h5>
                            @endforelse
                            {{-- <li class="timeline-item mb-5">
                                <span class="timeline-icon">
                                    <i class="bi-person"></i>
                                </span>

                                <h5 class="fw-bold">Entrada do corpo</h5>
                                <p class="text-muted mb-2 fw-bold">10 de Novembro de 2022</p>
                                <p class="text-muted">
                                    Foi dado entrada no corpo de Joao Aldemar da Silva e foi preenchido por Admin às 16:35.
                                </p>
                            </li>

                            <li class="timeline-item mb-5">

                                <span class="timeline-icon">
                                    <i class="bi-person-rolodex"></i>
                                </span>
                                <h5 class="fw-bold">Corpo recebido</h5>
                                <p class="text-muted mb-2 fw-bold">10 de Novembro de 2022</p>
                                <p class="text-muted">
                                    Corpo recebido pelo necrotomista Admin às 16:44.
                                </p>
                            </li>

                            <li class="timeline-item mb-5">

                                <span class="timeline-icon">
                                    <i class="bi-file-person-fill"></i>
                                </span>
                                <h5 class="fw-bold">Responsável atribuído</h5>
                                <p class="text-muted mb-2 fw-bold">10 de Novembro de 2022</p>
                                <p class="text-muted">
                                    O responsável do corpo Joaozin foi atribuído ao corpo às 16:51.
                                </p>
                            </li>
                            <li class="timeline-item mb-5">

                                <span class="timeline-icon">
                                    <i class="bi-file-earmark-fill"></i>
                                </span>
                                <h5 class="fw-bold">Upload de documento</h5>
                                <p class="text-muted mb-2 fw-bold">10 de Novembro de 2022</p>
                                <p class="text-muted">
                                    Foi feito o upload do documento de entrada por Admin às 16:56.
                                </p>
                            </li> --}}
                        </ul>
                    </section>
                    <!-- Section: Timeline -->
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}
