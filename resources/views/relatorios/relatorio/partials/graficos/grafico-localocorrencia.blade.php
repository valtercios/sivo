<script type="text/javascript">
    let apiUrlLocalOcorrencia = '{{ URL::temporarySignedRoute('graficos.localocorrencia', now()->addMinutes(60)) }}'
        .replace(
            '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartLocalOcorrencia);

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
                    chartArea: {
                        // leave room for y-axis labels
                        width: '85%',
                        height: '75%',
                        top: 20
                    },
                    bars: 'horizontal', // exibe as barras na horizontal
                    vAxis: {
                        title: 'Local de ocorrência', // ajusta o título do eixo vertical
                    },
                    hAxis: {
                        title: 'Óbitos', // ajusta o título do eixo horizontal
                    },
                };

                var chart = new google.visualization.ColumnChart(document.getElementById(
                    'chart_div_local_ocorrencia'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    document.getElementById('grafico-obitos-local-ocorrencia-download-btn').href =
                        chart
                        .getImageURI()
                    if (totalObitos != 0) {
                        document.getElementById('grafico_local_ocorrencia').value = chart
                            .getImageURI()
                    }
                    document.getElementById('loading-obitos-local-ocorrencia').style.display =
                        "none";
                })
                chart.draw(view, options);
                $(window).smartresize(function() {
                    chart.draw(view, options);
                });
            }
        });



    }
</script>