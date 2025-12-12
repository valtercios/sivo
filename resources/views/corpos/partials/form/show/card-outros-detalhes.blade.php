<!-- Inicio card detalhes de auditoria -->
<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Outros detalhes</h4>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px;">Detalhes adicionais referentes ao corpo
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Data de recebimento do corpo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ \Carbon\Carbon::parse($corpo->data_recebimento)->format('d/m/Y') }}
                            </div>
                            {{-- Fim do bloco --}}
                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Data de cadastro do corpo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ \Carbon\Carbon::parse($corpo->data_entrada)->format('d/m/Y H\h:i\m\i\n:s\s') }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Responsavel pelo preenchimento</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->user->name ?? '-' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Pendências</label>
                            </div>
                            @php
                                $arrayPendencias = [
                                    0 => 'Sem pendências',
                                    1 => 'Aguardando documento',
                                    2 => 'Grau de parentesco',
                                    3 => 'Outro',
                                ];

                            @endphp
                            <div class="col-md-8 form-group">
                                {{ $arrayPendencias[$corpo->pendencias] ?? '-' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Observações</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->observacoes ?? '-' }}
                            </div>
                            {{-- Fim do bloco --}}

                            {{-- Inicio do bloco --}}
                            <div class="col-md-4">
                                <label>Necrotomista que recebeu o corpo</label>
                            </div>
                            <div class="col-md-8 form-group">
                                {{ $corpo->necrotomista->name ?? 'Ainda não foi recebido' }}
                            </div>
                            {{-- Fim do bloco --}}

                            @if ($corpo->pertences != null)
                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Horário que o corpo foi recebido pelo necrotomista</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ \Carbon\Carbon::parse($corpo->updated_at)->format('d/m/Y H\h:i\m\i\n:s\s') }}
                                </div>
                                {{-- Fim do bloco --}}

                                {{-- Inicio do bloco --}}
                                <div class="col-md-4">
                                    <label>Pertences</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{ $corpo->pertences }}
                                </div>
                                {{-- Fim do bloco --}}
                            @endif




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Fim Card --}}
