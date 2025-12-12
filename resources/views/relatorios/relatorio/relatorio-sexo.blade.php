@extends('layout.app')

@section('title')
    <h3>Relatório por sexo</h3>
    <p class="text-subtitle text-muted">Filtre e mostre informações referentes ao relatório por sexo.</p>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relatórios
        </li>
    </ol>
@endsection

@section('conteudo')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title" style="display:inline-block;">Filtros</h4>

        </div>
        <div class="card-body">
            @include('relatorios.relatorio.partials.form-filtro')
        </div>
    </div>
    <script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('input[name*="data"]').daterangepicker({
            maxDate: moment(),
            locale: {
                format: 'DD/MM/YYYY',
                customRangeLabel: 'Intervalo personalizado',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
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
                    'month')]
            }
        });
    </script>
@endsection
