@extends('layout.app')

@section('title')
    <h3>Relatório óbitos por mês</h3>
    <p class="text-subtitle text-muted">Filtre e mostre informações referentes ao relatório de óbitos por mês.</p>
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

        .loading-grafico {
            position: absolute;
            z-index: 999;
            width: 100%;
            height: 90%;
            align-items: center;
            justify-content: center;
            display: flex;
            background: white;
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
            <form action="{{ route('relatorios.obitosmes') }}" method="post" id="filtros-faixa-etaria-form">
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

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR MÊS</h4>
                    <a type="button" href="" id="grafico-mes-line-btn-download" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartMesesLine()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 525px;">
                    <div class="loading-grafico" id="loading-grafico-line">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div" style="width: 100%; height: 500px;margin-top: -50px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">COMPARATIVO COM ANO ANTERIOR</h4>
                    <a type="button" href="" id="grafico-mes-area-btn-download" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartMesesArea()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 525px;">
                    <div class="loading-grafico" id="loading-grafico-area">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div2" style="width: 100%; height: 500px;margin-top: -50px;"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Relatório detalhado({{ $totalObitos }})</h4>
            @if ($totalObitos > 0)
                <form action="{{ route('relatorios.obitos_mes_pdf') }}" method="post" target="_BLANK"
                    id="form-gerar-relatorio">
                    @csrf
                    <input type="hidden" name="grafico_obitos_mes_line" id="grafico_obitos_mes_line" value="">
                    <input type="hidden" name="grafico_obitos_mes_area" id="grafico_obitos_mes_area" value="">
                    <input type="hidden" name="total_obitos" id="total_obitos" value="{{ $totalObitos }}">
                    <input type="hidden" name="obitos_mes" value="{{ base64_encode(json_encode($relatorioMeses)) }}">
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
                        <th>Mês</th>
                        <th>Número de óbitos</th>
                        <th>% em relação ao total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($relatorioMeses['data'] as $key => $obito)
                        @if ($obito != 0)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $obito }}</td>
                                <td>{{ $obito == 0 ? 0 : number_format(($obito / $totalObitos) * 100, 2, '.', '') }}%
                                </td>
                            </tr>
                        @endif
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
    <script>
        let form = document.getElementById('filtros-faixa-etaria-form');
        let formData = new FormData(form);
        let totalObitos = "{{ $totalObitos }}";
    </script>
    <script type="text/javascript">
        let apiUrlTotalMeses = '{{ URL::temporarySignedRoute('graficos.totalmeses', now()->addMinutes(60)) }}'.replace(
            '&amp;', '&');
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChartMesesLine);

        function drawChartMesesLine() {
            $.ajax({
                url: apiUrlTotalMeses,
                type: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
                },
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    var dataTable = new google.visualization.DataTable();
                    dataTable.addColumn('string', 'Mês');
                    dataTable.addColumn('number', 'Óbitos');
                    dataTable.addRows(data);

                    var options = {
                        title: 'Óbitos por Mês',
                        // width: 900,
                        // height: 500,
                        legend: {
                            position: 'none'
                        },
                        hAxis: {
                            slantedText: true,
                            slantedTextAngle: 45,
                            textStyle: {
                                fontSize: 14,
                                bold: true
                            }
                        },
                        vAxis: {
                            title: 'Óbitos',
                            minValue: 0,
                            viewWindowMode: 'explicit',
                            viewWindow: {
                                min: 0
                            }
                        },
                        series: {
                            0: {
                                color: '#4285F4',
                                lineWidth: 3
                            }
                        },
                        annotations: {
                            textStyle: {
                                fontName: 'Arial',
                                fontSize: 14,
                                color: '#000',
                                bold: true,
                                italic: true
                            }
                        },
                        is3D: true
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    google.visualization.events.addListener(chart, 'ready', function() {
                        if(totalObitos != 0){
                            document.getElementById('grafico_obitos_mes_line').value = chart.getImageURI()
                        } 
                        document.getElementById('grafico-mes-line-btn-download').href = chart
                            .getImageURI()
                        document.getElementById('loading-grafico-line').style.display = "none";
                    })
                    chart.draw(dataTable, options);
                }
            });


        }
    </script>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChartMesesArea);
        let apiUrlTotalMesesArea = '{{ URL::temporarySignedRoute('graficos.totalmesesarea', now()->addMinutes(60)) }}'
            .replace(
                '&amp;', '&');

        function drawChartMesesArea() {
            $.ajax({
                url: apiUrlTotalMesesArea,
                type: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
                },
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    var dataTable = new google.visualization.DataTable();
                    dataTable.addColumn('string', 'Mês');
                    dataTable.addColumn('number', 'Óbitos - {{ \Carbon\Carbon::now()->year }}');
                    dataTable.addColumn('number', 'Óbitos - {{ \Carbon\Carbon::now()->subYear()->year }}');
                    dataTable.addRows(data);

                    var options = {
                        title: 'Óbitos por mês - Ano atual e ano anterior',
                        hAxis: {
                            title: 'Mês'
                        },
                        vAxis: {
                            title: 'Número de óbitos'
                        },
                        series: {
                            0: {
                                color: '#FF7F50'
                            },
                            1: {
                                color: '#4169E1'
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    };

                    var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
                    google.visualization.events.addListener(chart, 'ready', function() {
                        if(totalObitos != 0){
                            document.getElementById('grafico_obitos_mes_area').value = chart.getImageURI()
                        }
                        document.getElementById('grafico-mes-area-btn-download').href = chart
                            .getImageURI()
                        document.getElementById('loading-grafico-area').style.display = "none";
                    })
                    chart.draw(dataTable, options);
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
            order: [],
            language: {
                url: '{{ url('assets/js/datatable/lang/pt-BR.json') }}'

            }
        });
    </script>
@endsection
