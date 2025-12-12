@extends('layout.app')
@section('title')
    <h3>Relatório Obitos Vindo de Funerarias</h3>
    <p class="text-subtitle text-muted">Filtre e mostre informações referentes ao relatório.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relatorios Obitos Vindo de Funerarias
        </li>
    </ol>
@endsection

@section('conteudo')
    <style>
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
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Filtros</h4>

            @if ($totalObitos != 0)
                <form action="{{ route('relatorios.gerar-obitosfunerarias') }}" class="float-end" method="post"
                    target="_blank">
                    @csrf
                    <input type="hidden" name="obitos_fetais" value="{{ $obitosfetais }}">
                    <input type="hidden" name="total_obitos_funerarias" value="{{ $totalObitosVinculadosFunerarias }}">
                    <input type="hidden" name="total_obitos" value="{{ $totalObitos }}">
                    <input type="hidden" name="obitos" value="{{ $obitosFunerarias }}">
                    <input type="hidden" name="obitosPorTransporte" value="{{ $obitosPorTransporte }}">
                    <input type="hidden" name="dadosObitosSexo" value="{{ $dadosObitosSexoRelatorio }}">
                    <input type="hidden" name="quantidade_obitos_feminino" value="{{ $obitosFeminino }}">
                    <input type="hidden" name="quantidade_obitos_masculino" value="{{ $obitosMasculino }}">
                    <input type="hidden" name="grafico_obitos_funerarias" id="grafico_obitos_funerarias" valeu="">
                    <input type="hidden" name="grafico_tipo_transporte" id="grafico_tipo_transporte" value="">
                    <input type="hidden" name="periodo" value="{{ $periodo }}">
                    <input type="hidden" name="configuracoes-relatorio-input" id="configuracoes-relatorio-input">
                    <button type="button" data-bs-toggle="modal"data-bs-target="#opcoes-relatorio"
                        class="btn btn-primary"><i class="bi bi-gear"></i> Configurações</button>
                    <button class="btn btn-secondary"><i class="bi bi-file-earmark-pdf"></i> Gerar
                        Relatório</button>

                </form>
            @endif
            <br>

        </div>
        <div class="card-body">
            <form action="{{ route('relatorios.obitos-funerariasFiltrado') }}" method="post"
                id="filtros-obitos-funerarias-form">
                @csrf
                @include('relatorios.relatorio.partials.form-filtro')
                <div class="row">
                    <div class="col-9">
                        <p class="text-subtitle text-muted d-inline-block" style="">Esta seção apresenta os filtros
                            que podem ser
                            utilizados nos relatórios. No botão de <strong>"Configurações"</strong> é possível personalizar
                            o que será
                            exibido no relatório.</p>
                    </div>
                    <div class="col-3" style="text-align: right;">

                        <a href="{{ route('relatorios.obitos-funerarias') }}" class="btn btn-secondary me-1 mb-1 "><i
                                class="bi bi-eraser"></i> Limpar filtros</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1 "><i class="bi bi-search"></i>
                            Filtrar</button>

                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="row">
        <!--OBITOS VINDO DE FUNERARIAS-->
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS VINDO DE FUNERARIAS</h4>
                    <a type="button" href="" id="grafico-obitos-funeraria-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartPorFuneraria()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-obitos-funeraria">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div" style="width: 100%; height: 400px;background-color:transparent;"></div>
                </div>
            </div>
        </div>

        <!--OBITOS POR MEIO DE TRANSPORTE-->

        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR TIPO DE TRANSPORTE</h4>
                    <a type="button" href="" id="grafico-tipo-transporte-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartTipoTransporte()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-tipo-transporte">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div2" style="width: 100%; height: 400px;background-color:transparent;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection



<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@include('relatorios.relatorio.partials.modal.opcoes-relatorio-geral')



@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        const form = document.getElementById('filtros-obitos-funerarias-form');
        const formData = new FormData(form);
        const totalObitos = "{{ $totalObitos }}";
    </script>

    @include('relatorios.relatorio.partials.graficos.grafico-obitosfunerarias')
    @include('relatorios.relatorio.partials.graficos.grafico-tipotransporte')


    <script>
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
    </script>
@endsection
