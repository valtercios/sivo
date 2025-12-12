@extends('layout.app')

@section('title')
    <h3 class="d-inline-block">Dashboard</h3>
    <div id="reportrange"
        style="display:inline-block; cursor: pointer; padding: 5px 10px; width: 237px; position: relative; bottom: 5px;">
        <i class="bi bi-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
    </div>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Dashboard
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .chart {
            width: 100%;
            height: 400px;
        }

        #obitos-faixa-etaria-chart {}

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
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi-person-rolodex"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Corpos recebidos</h6>
                                        <h6 class="font-extrabold mb-0" id="contagem-corpos-text">{{ $contagemCorpos }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="bi-grid-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Funerárias</h6>
                                        <h6 class="font-extrabold mb-0">{{ $contagemFunerarias }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="bi-person"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Usuários</h6>
                                        <h6 class="font-extrabold mb-0">{{ $contagemUsuarios }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-auto d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="bi-file-person-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Responsáveis</h6>
                                        <h6 class="font-extrabold mb-0">{{ $contagemResponsaveis }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="display:inline-block;">ÓBITOS POR FAIXA ETÁRIA</h4>
                                <a type="button" href="" id="grafico-faixa-etaria-download-btn" download
                                    class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                                    <i class="bi bi-download"></i>
                                    Baixar gráfico
                                </a>
                                <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                                    onclick="drawChartFaixaEtaria()"><i class="bi bi-arrow-clockwise"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Atualizar gráfico"></i></button>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                                <div class="loading-grafico" id="loading-obitos-faixa-etaria">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </div>
                                <div id="obitos-faixa-etaria-chart" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" style="display:inline-block;">ÓBITOS POR MÊS</h4>
                                <a type="button" href="" id="grafico-obitos-mes-download-btn" download
                                    class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                                    <i class="bi bi-download"></i>
                                    Baixar gráfico
                                </a>
                                <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                                    onclick="drawChartObitosMes()"><i class="bi bi-arrow-clockwise"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Atualizar gráfico"></i></button>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center"
                                style="height: 425px;">
                                <div class="loading-grafico" id="loading-obitos-mes">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Carregando...</span>
                                    </div>
                                </div>
                                <div id="obitos-mes-chart" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                @php
                                    $totalObitosMunicipio = array_sum(array_column($obitosMunicipio, 'obitos'));
                                @endphp
                                <h4>ÓBITOS POR MUNICIPIO ( {{ $totalObitosMunicipio }} )</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="obitosMunicipio_table">
                                    <thead>
                                        <tr>
                                            <th>
                                                MUNICIPIO
                                            </th>
                                            <th>
                                                ÓBITOS
                                            </th>
                                            <th>
                                                % total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($obitosMunicipio as $key => $obitos)
                                            <tr>
                                                <td>
                                                    {{ mb_strtoupper($obitos['nome']) }}
                                                </td>
                                                <td>
                                                    {{ $obitos['obitos'] }}
                                                </td>
                                                <td>
                                                    {{ number_format((float) ($obitos['obitos'] / $totalObitosMunicipio) * 100, 2, '.', '') }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                @php
                                    $totalObitosBairro = array_sum(array_column($obitosBairro, 'obitos'));
                                @endphp
                                <h4>ÓBITOS POR BAIRRO ( {{ $totalObitosBairro }} )</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" id="obitosBairro_table">
                                    <thead>
                                        <tr>
                                            <th>
                                                BAIRRO
                                            </th>
                                            <th>
                                                ÓBITOS
                                            </th>
                                            <th>
                                                % total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($obitosBairro as $key => $obitos)
                                            <tr>
                                                <td>
                                                    {{ mb_strtoupper($obitos['nome']) }}
                                                </td>
                                                <td>
                                                    {{ $obitos['obitos'] }}
                                                </td>
                                                <td>
                                                    {{ number_format((float) ($obitos['obitos'] / $totalObitosBairro) * 100, 2, '.', '') }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
@endsection

@section('js')
    <!-- Resources -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var periodo = '';
    </script>

    @include('dashboard.graficos.obitos-mes')
    @include('dashboard.graficos.obitos-faixa-etaria')

    {{-- Inicializar o date range time picker --}}
    <script>
        $(document).ready(function() {
            $('#reportrange').daterangepicker({
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
                    'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf(
                        'month')],
                    'Este ano': [moment().startOf('year'), moment().endOf('year')],
                    'Último ano': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1,
                        'year').endOf(
                        'year')]
                }
            }, cb);


            function cb(start, end) {
                $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            }

            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
                let filtroValue = $(this).val();
                if (filtroValue != periodo) {
                    periodo = filtroValue;
                    let apiUrlGetDashboard =
                        '{{ URL::temporarySignedRoute('api.getdashboard', now()->addMinutes(60)) }}'
                        .replace(
                            '&amp;', '&');
                    $.ajax({
                        url: apiUrlGetDashboard,
                        type: 'POST',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]')
                                .attr('content'));
                        },
                        data: {
                            data_recebimento: periodo
                        },
                        success: function(data) {
                            $('#contagem-corpos-text').text(data.contagem_corpos);

                            console.log(data);
                            drawChartFaixaEtaria();
                            drawChartObitosMes();
                        }
                    });
                }
            });
            $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                $('#reportrange span').html('');
            });

            var tableMunicipio = dataTableObitos('#obitosMunicipio_table')
            var tableBairro = dataTableObitos('#obitosBairro_table')
        });
        
        function dataTableObitos(id) {
            return $(id).DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.1.4/i18n/pt-BR.json'
                },
                order: [
                    [1, 'desc']
                ],
                layout: {
                    bottom: 'paging',
                    bottomEnd: null
                },
                columnDefs: [{
                    targets: 0,
                    width: '60%',
                }]
            });
        }
    </script>
@endsection
