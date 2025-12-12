<script type="text/javascript">
    let apiUrlTotalMeses = '{{ URL::temporarySignedRoute('graficos.totalmeses', now()->addMinutes(60)) }}'.replace(
        '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartObitosMeses);

    function drawChartObitosMeses() {
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
                    chartArea: {
                        // leave room for y-axis labels
                        width: '85%',
                        height: '75%',
                        top: 20
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

                var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    if (totalObitos != 0) {
                        document.getElementById('grafico_obitos_mes_line').value = chart
                            .getImageURI()
                    }
                    document.getElementById('grafico-obitos-mes-download-btn').href = chart
                        .getImageURI()
                    document.getElementById('loading-obitos-mes').style.display = "none";
                })
                chart.draw(dataTable, options);
                $(window).smartresize(function() {
                    chart.draw(dataTable, options);
                });
            }
        });


    }
</script>