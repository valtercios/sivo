<script type="text/javascript">
    let apiUrlporFuneraria = '{{ URL::temporarySignedRoute('graficos.obitosfuneraria', now()->addMinutes(60)) }}'
        .replace(
            '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartPorFuneraria);



    function drawChartPorFuneraria() {
        $.ajax({
            url: apiUrlporFuneraria,
            type: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            },
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Funeraria');
                dataTable.addColumn('number', 'Total');

                console.log(data);
                dataTable.addRows(data);


                var options = {
                    title: 'Óbitos Vinculados a Funerarias',
                    vAxis: {
                        title: 'Número de Óbitos'
                    },
                    hAxis: {
                        title: 'Funeraria'
                    },
                    seriesType: 'bars',
                    chartArea: {
                        // leave room for y-axis labels
                        width: '75%',
                        height: '75%',
                        top: 20,
                        left: 20
                    },
                    series: {
                        0: {
                            color: '#4285F4',
                            visibleInLegend: true
                        },
                        1: {
                            color: '#F472B6',
                            visibleInLegend: true
                        },
                    },
                    bar: {
                        groupWidth: '70%'
                    },
                    isStacked: true,
                    annotations: {
                        textStyle: {
                            fontSize: 12,
                            color: '#000',
                            bold: true,
                        },
                    },
                };

                var view = new google.visualization.DataView(dataTable);
                view.setColumns([0, 1, {
                        calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation"
                    },

                ]);

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    if (totalObitos != 0) {
                        document.getElementById('grafico_obitos_funerarias').value = chart.getImageURI()
                        }
                    document.getElementById('grafico-obitos-funeraria-download-btn').href = chart
                        .getImageURI()
                    document.querySelector('#loading-obitos-funeraria').style.display = "none";
                })
                chart.draw(view, options);
                $(window).smartresize(function() {
                    chart.draw(view, options);
                });
            }
        });
    }
</script>
