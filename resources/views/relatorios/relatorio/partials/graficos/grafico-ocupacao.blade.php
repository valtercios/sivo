<script type="text/javascript">
    let apiUrlObitosOcupacao = '{{ URL::temporarySignedRoute('graficos.obitosocupacao', now()->addMinutes(60)) }}'
        .replace(
            '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartOcupacao);

    function drawChartOcupacao() {
        $.ajax({
            url: apiUrlObitosOcupacao,
            type: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            },
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Ocupação');
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
                    title: 'Óbitos por Ocupação',
                    titleTextStyle: {
                        color: "#000",
                        fontName: "sans-serif",
                        fontSize: 14,
                        bold: true
                    },
                    chartArea: {
                        // leave room for y-axis labels
                        width: '70%',
                        height: '75%',
                        top: 20
                    },
                    legend: {
                        position: 'none'
                    },
                    bars: 'horizontal', // exibe as barras na horizontal
                    vAxis: {
                        title: 'Ocupação', // ajusta o título do eixo vertical
                        titleTextStyle: {
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    hAxis: {
                        title: 'Óbitos', // ajusta o título do eixo horizontal
                        titleTextStyle: {
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true,
                        }
                    },
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_obitos_ocupacao'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    document.getElementById('grafico-obitos-ocupacao-download-btn').href = chart
                        .getImageURI();
                    document.getElementById('grafico_obitos_ocupacao').value = chart
                        .getImageURI();

                    document.getElementById('loading-obitos-ocupacao').style.display = "none";
                })
                chart.draw(view, options);
                $(window).smartresize(function() {
                    chart.draw(view, options);
                });
            }
        });



    }
</script>