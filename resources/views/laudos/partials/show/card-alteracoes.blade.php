<div class="card">
    <div class="accordion" id="cardAccordion">
        @foreach ($new as $index => $newValues)
            <div class="accordion-item">
                <h2 class="accordion-header" id="header-{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ $index }}" aria-expanded="false"
                        aria-controls="collapse-{{ $index }}">
                        {{ $index + 1 }} - Alterado em {{ $data[$index] }} por {{$user[$index]}}
                    </button>
                </h2>
                <div id="collapse-{{ $index }}" class="accordion-collapse collapse"
                    aria-labelledby="header-{{ $index }}" data-bs-parent="#cardAccordion">

                        
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Campo</th>
                                    <th>Valor Antigo</th>
                                    <th>Novo Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newValues as $key => $newValue)
                                    @unless ($key === 'updated_at')
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $old[$index][$key] ?? 'EM BRANCO' }}</td>
                                            <td>{{ $newValue ?? 'EM BRANCO' }}</td>
                                        </tr>
                                    @endunless
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        @endforeach
    </div>
</div>