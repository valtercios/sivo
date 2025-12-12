<script type="text/javascript">
    let apiUrlFaixaEtaria = '{{ URL::temporarySignedRoute('graficos.faixaetaria', now()->addMinutes(60)) }}'.replace(
        '&amp;', '&');
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartFaixaEtaria);



    function drawChartFaixaEtaria() {
        $.ajax({
            url: apiUrlFaixaEtaria,
            type: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-Token", $('meta[name="csrf-token"]').attr('content'));
            },
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Faixa Etária');
                dataTable.addColumn('number', 'Masculino');
                dataTable.addColumn('number', 'Feminino');
                dataTable.addRows(data);


                var options = {
                    title: 'Óbitos por Faixa Etária e Sexo',
                    vAxis: {
                        title: 'Número de Óbitos'
                    },
                    hAxis: {
                        title: 'Faixa Etária'
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
                    2, {
                        calc: "stringify",
                        sourceColumn: 2,
                        type: "string",
                        role: "annotation"
                    }
                ]);

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    if (totalObitos != 0) {
                        document.getElementById('grafico_faixa_etaria_sexo_barra').value = chart
                            .getImageURI()
                    }
                    document.getElementById('grafico-obitos-faixa-etaria-download-btn').href = chart
                        .getImageURI()
                    document.querySelector('#loading-faixa-etaria').style.display = "none";
                })
                chart.draw(view, options);
                $(window).smartresize(function() {
                    chart.draw(view, options);
                });
            }
        });
    }
</script>