<div class="card">
    <div class="card-header">
        <h4 class="card-title" style="display:inline-block;">Resposta do exame</h4>
        <br>
        <p class="text-subtitle text-muted" style="margin-bottom: -15px; display:inline-block;">Informações referentes a resposta do exame</p>
    </div>
    <div class="card-body">
        <div class="form-body">
            <label for="data_resposta" class="form-label" style="font-weight: 600;">Data de resposta</label><br>
            <div style="margin-bottom: 10px;">{{ \Carbon\Carbon::parse($exame->updated_at)->format('d/m/Y H:i:s') }}</div>
            <label for="data_resposta" class="form-label" style="font-weight: 600;">Respondido por</label><br>
            <div style="margin-bottom: 10px;">{{ $exame->usuarioResposta->name }}</div>
            <div class="row">
                <div class=" col-12">
                    <div class="form-group mb-3">
                        <label for="resposta" class="form-label">Resposta</label>
                        <textarea class="form-control" id="resposta" name="resposta" rows="5" disabled>{{$exame->resposta}}</textarea>
                    </div>
                </div>
            </div>
            <label for="anexos" class="form-label" style="font-weight: 600;">Anexos</label>
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nome
                        </th>
                        <th>
                            Formato
                        </th>
                        <th>
                            Data de envio
                        </th>
                        <th>
                            Enviado por
                        </th>
                        <th>
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $documento)
                        <tr>
                            <td>
                                {{ $documento->id }}
                            </td>
                            <td>
                                {{ $documento->name }}
                            </td>
                            <td>
                                {{ strtoupper($documento->format) }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>
                                {{ $documento->usuario->name }}
                            </td>
                            <td style="text-align: center">
                                <a href="{{ asset('/storage/' . $documento->path) }}"
                                    class="btn btn-sm icon icon-left btn-primary" target="_BLANK"><i class="bi bi-eye"></i> Visualizar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>