<script type="text/javascript">
    let apiUrlObitosMes = '{{ URL::temporarySignedRoute('graficos.totalmeses', now()->addMinutes(60)) }}'.replace(
        '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartObitosMes);

    function drawChartObitosMes() {
        $.ajax({
            url: apiUrlObitosMes,
            type: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            },
            data: {
                data_recebimento: periodo
            },
            success: function(data) {
                var dataTable = new google.visualization.DataTable();
                let titleGraficoHAxis = "Óbitos";
                if(periodo != ''){
                    titleGraficoHAxis += `\nPeriodo(${periodo})`
                }
                dataTable.addColumn('string', 'Mês');
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
                    title: 'Óbitos por mês',
                    chartArea: {
                        // leave room for y-axis labels
                        width: '80%',
                        height: '75%',
                        top: 20
                    },
                    titleTextStyle:{
                        color: "#000",
                        fontName: "sans-serif",
                        fontSize: 14,
                        bold: true
                    },
                    legend: {
                        position: 'none'
                    },
                    bars: 'horizontal', // exibe as barras na horizontal
                    vAxis: {
                        title: 'Mês', // ajusta o título do eixo vertical
                        titleTextStyle:{
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true
                        },
                    },
                    hAxis: {
                        title: titleGraficoHAxis, // ajusta o título do eixo horizontal
                        titleTextStyle:{
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true
                        },
                    },
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('obitos-mes-chart'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    document.querySelector('#loading-obitos-mes').style.display = "none";
                    document.querySelector('#obitos-mes-chart').style.display = "block";
                    document.getElementById('grafico-obitos-mes-download-btn').href = chart
                        .getImageURI();
                })
                chart.draw(view, options);
                $(window).smartresize(function () {
                    chart.draw(view, options);
                });
            }
        });



    }
</script>