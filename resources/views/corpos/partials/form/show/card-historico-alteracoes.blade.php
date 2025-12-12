<div class="row match-height">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="display:inline-block;">Histórico de Alterações</h4>
                <br>
                <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">
                    Histórico de alterações referentes ao corpo
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    
                    <div class="accordion" id="historicoAccordion">
                        @foreach ($justificativa as $index => $item)
                            @php
                                $alteracoes = json_decode($item->alteracoes, true);
                            @endphp

                            @if ($alteracoes)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $index }}">

                                        <button class="accordion-button collapsed" type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse-{{ $index }}" 
                                            aria-expanded="false" 
                                            aria-controls="collapse-{{ $index }}"> 
                                            Registro: {{ $item->tabela}}
                                            <br>
                                            alterado em {{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y H:i:s') : 'Data desconhecida' }}
                                            <br>
                                            por {{ $nome[$item->user_id] ?? 'Usuário desconhecido' }}
                                        </button>
                                        
                                    </h2>
                                    <div id="collapse-{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading-{{ $index }}" data-bs-parent="#historicoAccordion">
                                        <div class="accordion-body">
                                            <strong class="badge text-bg-primary">Justificativa:</strong>
                                            <span class="form-text">
                                                {!! $item->justificativa !!}
                                            </span>

                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-dark">
                                                    <tr>                                                        
                                                        <th>Campo</th>
                                                        <th>Valor Antigo</th>
                                                        <th>Novo Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alteracoes as $alteracao)
                                                        <tr>                                                            
                                                            <td>{{ $alteracao['campo'] }}</td>
                                                            <td style="color: red;">
                                                                {{ $alteracao['antigo'] !== null ? $alteracao['antigo'] : 'N/A' }}
                                                            </td>
                                                            <td style="color: green;">
                                                                {{ $alteracao['novo'] !== null ? $alteracao['novo'] : 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>Nenhuma alteração encontrada.</p>
                            @endif
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>