@extends('layout.app')

@section('title')
    <h3>Relatório por local de ocorrência</h3>
    <p class="text-subtitle text-muted">Filtre e mostre informações referentes ao relatório por local de ocorrência.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relatórios
        </li>
    </ol>
@endsection

@section('conteudo')
    <style>
        .buttons-pdf {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Filtros</h4>
            <p class="text-subtitle text-muted mb-0">Selecione algum filtro abaixo e tenha resultados mais precisos.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('relatorios.localocorrencia') }}" method="post" id="filtros-faixa-etaria-form">
                @csrf
                @include('relatorios.relatorio.partials.form-filtro')
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" id="btn-limpar-filtros" class="btn btn-secondary me-1 mb-1 "><i
                            class="bi bi-eraser"></i> Limpar filtros</button>
                    <button type="submit" class="btn btn-primary me-1 mb-1 "><i class="bi bi-search"></i> Filtrar</button>

                </div>
            </form>
        </div>
    </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Gráfico óbitos por local de ocorrência</h4>
            <a type="button" href="" id="grafico-download-btn" download
                class="btn btn-secondary me-1 mb-1 float-end">
                <i class="bi bi-download"></i>
                Baixar gráfico
            </a>
        </div>
        <div class="card-body">
            <div id="chart_div" style="width: 100%; height: 500px;"></div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Relatório detalhado({{ $totalObitos }})</h4>
            @if ($totalObitos > 0)
                <form action="{{ route('relatorios.local_ocorrencia_pdf') }}" method="post" target="_BLANK"
                    id="form-gerar-relatorio">
                    @csrf
                    <input type="hidden" name="grafico_local_ocorrencia" id="grafico_local_ocorrencia"
                        value="">
                    <input type="hidden" name="total_obitos" id="total_obitos" value="{{ $totalObitos }}">
                    <input type="hidden" name="obitos_local_ocorrencia" value="{{ $dadosLocalOcorrencia64 }}">
                    <input type="hidden" name="periodo_relatorio" id="periodo_relatorio" value="">
                    <button type="button" onclick="gerarRelatorio()" class="btn btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-file-earmark-pdf" id="gerarRelatorioIcon"></i>
                        <span class="spinner-border spinner-border-sm" id="loadingGerar" style="display:none;"
                            role="status" aria-hidden="true"></span>
                        Gerar PDF</button>
                </form>
            @endif
            <br>
            <p class="text-subtitle text-muted mb-0">Tabela com as informações do relatório.</p>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Local de ocorrência</th>
                        <th>Número de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dadosLocalOcorrencia['data'] as $obito)
                        <tr>
                            <td>{{ $obito[0] }}</td>
                            <td>{{ $obito[1] }}</td>
                            <td>{{ $obito[1] == 0 ? 0 : number_format(($obito[1] / $totalObitos) * 100, 2, '.', '') }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Resources -->

    <script type="text/javascript">
        let apiUrlLocalOcorrencia = '{{ URL::temporarySignedRoute('graficos.localocorrencia', now()->addMinutes(60)) }}'.replace(
            '&amp;', '&');
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChartLocalOcorrencia);

        const form = document.getElementById('filtros-faixa-etaria-form');
        const formData = new FormData(form);

        function drawChartLocalOcorrencia() {
            $.ajax({
                url: apiUrlLocalOcorrencia,
                type: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
                },
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    var dataTable = new google.visualization.DataTable();
                    dataTable.addColumn('string', 'Local de ocorrência');
                    dataTable.addColumn('number', 'Óbitos');
                    dataTable.addRows(data);
                    var view = new google.visualization.DataView(dataTable);
                    view.setColumns([
                        0,
                        1,
                        {
                            calc: function(dt, row) {
                                return dt.getValue(row, 1).toString();
                            },
                            type: 'string',
                            role: 'annotation',
                        },
                    ]);

                    var options = {
                        title: 'Óbitos por Local de Ocorrência',
                        legend: {
                            position: 'none'
                        },
                        bars: 'horizontal', // exibe as barras na horizontal
                        vAxis: {
                            title: 'Local de ocorrência', // ajusta o título do eixo vertical
                        },
                        hAxis: {
                            title: 'Óbitos', // ajusta o título do eixo horizontal
                        },
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                    google.visualization.events.addListener(chart, 'ready', function() {
                        document.getElementById('grafico-download-btn').href = chart
                            .getImageURI()
                        document.getElementById('grafico_local_ocorrencia').value = chart
                            .getImageURI()
                    })
                    chart.draw(view, options);
                }
            });



        }
    </script>



    <script>
        function gerarRelatorio() {
            const periodoFiltro = document.getElementById('data_recebimento');
            const periodoRelatorio = document.getElementById('periodo_relatorio');
            const formGerarRelatorio = document.getElementById('form-gerar-relatorio');
            periodoRelatorio.value = periodoFiltro.value;
            formGerarRelatorio.submit();

        }
        $('input[name*="data"]').daterangepicker({
            maxDate: moment(),
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                customRangeLabel: 'Intervalo personalizado',
                applyLabel: 'Aplicar',
                cancelLabel: 'Limpar',
                daysOfWeek: [
                    'D', 'S', 'T', 'Q', 'Q', 'S', 'S'
                ],
                monthNames: [
                    'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
                    'Agosto', 'Setembro', 'Outrubro', 'Novembro', 'Dezembro'
                ]
            },
            ranges: {
                'Hoje': [moment(), moment()],
                'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Este mês': [moment().startOf('month'), moment().endOf('month')],
                'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')],
                'Este ano': [moment().startOf('year'), moment().endOf('year')],
                'Último ano': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf(
                    'year')]
            }
        });

        $('input[name*="data"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('input[name*="data"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#btn-limpar-filtros').on('click', function() {
            $('#filtros input').val('');
            $('#filtros select').val('');
        });

        $('#table1').DataTable({
            language: {
                url: '{{ url('assets/js/datatable/lang/pt-BR.json') }}'

            }
        });
    </script>
@endsection
