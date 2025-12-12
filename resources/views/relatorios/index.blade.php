@extends('layout.app')

@section('title')
    <h3>Relatório Geral</h3>
    <p class="text-subtitle text-muted">Filtre e mostre informações referentes ao relatório.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relatórios
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
                <form action="{{ route('relatorios.geral') }}" class="float-end" method="post" target="_blank">
                    @csrf
                    <input type="hidden" name="grafico_sexo_pie" id="grafico_sexo_pie">
                    <input type="hidden" name="grafico_faixa_etaria_sexo_barra" id="grafico_faixa_etaria_sexo_barra">
                    <input type="hidden" name="grafico_obitos_mes_line" id="grafico_obitos_mes_line">
                    <input type="hidden" name="grafico_obitos_ocupacao" id="grafico_obitos_ocupacao">
                    <input type="hidden" name="obitos_municipio" id="obitos_municipio" value="{{ $obitosMunicipio }}">
                    <input type="hidden" name="obitos_bairro" id="obitos_bairro" value="{{ $obitosBairro }}">
                    <input type="hidden" name="total_obitos" id="total_obitos" value="{{ $totalObitos }}">
                    <input type="hidden" name="obitos_mes" id="obitos_mes" value="{{ $relatorioMeses }}">
                    <input type="hidden" name="obitos_local_ocorrencia" id="obitos_local_ocorrencia"
                        value="{{ $dadosLocalOcorrencia }}">
                    <input type="hidden" name="grafico_local_ocorrencia" id="grafico_local_ocorrencia" value="">
                    <input type="hidden" name="encaminhados_itep" id="encaminhados_itep"
                        value="{{ $dadosEncaminhadosITEP }}">
                    <input type="hidden" name="encaminhados_liga" id="encaminhados_liga"
                        value="{{ $dadosEncaminhadosLIGA }}">
                    <input type="hidden" name="medico_externo_interno" id="medico_externo_interno"
                        value="{{ $dadosMedicoExternoInterno }}">
                    <input type="hidden" name="obitos_sexo_dados" id="obitos_sexo_dados"
                        value="{{ $dadosObitosSexoRelatorio }}">
                    <input type="hidden" name="obitos_ocupacao" value="{{ $obitosOcupacaoBase64 }}">
                    <input type="hidden" name="obitos_parto" value="{{ $obitosFaseParto }}">
                    <input type="hidden" name="dados_faixa_etaria" value="{{ $obitosFaixaEtaria }}">
                    <input type="hidden" name="periodo" value="{{ $periodo }}">
                    <input type="hidden" name="maior_faixa_etaria" id="maior_faixa_etaria"
                        value="{{ $maiorFaixaEtaria }}">
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
            <form action="{{ route('relatorios.indexFiltrado') }}" method="post" id="filtros-faixa-etaria-form">
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
                        <a href="{{ route('relatorios.index') }}" class="btn btn-secondary me-1 mb-1 "><i
                                class="bi bi-eraser"></i> Limpar filtros</a>
                        <button type="submit" class="btn btn-primary me-1 mb-1 "><i class="bi bi-search"></i>
                            Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR SEXO</h4>
                    <a type="button" href="" id="grafico-obitos-sexo-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartObitosSexo()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-obitos-sexo">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div" style="width: 100%; height: 400px;background-color:transparent;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR FAIXA ETÁRIA</h4>
                    <a type="button" href="" id="grafico-obitos-faixa-etaria-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartFaixaEtaria()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-faixa-etaria">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div2" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
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
                        onclick="drawChartObitosMeses()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-obitos-mes">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div3" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR OCUPAÇÃO</h4>
                    <a type="button" href="" id="grafico-obitos-ocupacao-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartOcupacao()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-obitos-ocupacao">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_obitos_ocupacao" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="display:inline-block;">ÓBITOS POR LOCAL DE OCORRÊNCIA</h4>
                    <a type="button" href="" id="grafico-obitos-local-ocorrencia-download-btn" download
                        class="btn btn-sm btn-secondary me-1 mb-1 float-end">
                        <i class="bi bi-download"></i>
                        Baixar gráfico
                    </a>
                    <button type="button" class="btn btn-sm btn-primary me-1 mb-1 float-end"
                        onclick="drawChartLocalOcorrencia()"><i class="bi bi-arrow-clockwise" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Atualizar gráfico"></i></button>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 425px;">
                    <div class="loading-grafico" id="loading-obitos-local-ocorrencia">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                    </div>
                    <div id="chart_div_local_ocorrencia" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
    @include('relatorios.relatorio.partials.modal.opcoes-relatorio-geral')
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        const form = document.getElementById('filtros-faixa-etaria-form');
        const formData = new FormData(form);
        const totalObitos = "{{ $totalObitos }}";
    </script>


    @include('relatorios.relatorio.partials.graficos.grafico-sexo')

    @include('relatorios.relatorio.partials.graficos.grafico-faixaetaria')

    @include('relatorios.relatorio.partials.graficos.grafico-obitosmes')

    @include('relatorios.relatorio.partials.graficos.grafico-ocupacao')

    @include('relatorios.relatorio.partials.graficos.grafico-localocorrencia')


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
