
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
            data: {
                data_recebimento: periodo
            },
            success: function(data) {
                var dataTable = new google.visualization.DataTable();
                let titleGraficoHAxis = "Faixa Etária";
                if(periodo != ''){
                    titleGraficoHAxis += `\nPeriodo(${periodo})`
                }
                dataTable.addColumn('string', 'Faixa Etária');
                dataTable.addColumn('number', 'Masculino');
                dataTable.addColumn('number', 'Feminino');
                dataTable.addRows(data);


                var options = {
                    title: 'Óbitos por Faixa Etária e Sexo',
                    width: '100%',
                    height: '425px',
                    
                    titleTextStyle:{
                        color: "#000",
                        fontName: "sans-serif",
                        fontSize: 14,
                        bold: true
                    },
                    chartArea: {
                        // leave room for y-axis labels
                        width: '85%',
                        height: '80%',
                        top: 20
                    },
                    vAxis: {
                        title: 'Número de Óbitos',
                        titleTextStyle: {
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    hAxis: {
                        title: titleGraficoHAxis,
                        titleTextStyle: {
                            color: "#000",
                            fontName: "sans-serif",
                            fontSize: 14,
                            bold: true,
                        }
                    },
                    seriesType: 'bars',
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

                var chart = new google.visualization.ComboChart(document.getElementById('obitos-faixa-etaria-chart'));
                google.visualization.events.addListener(chart, 'ready', function() {
                    document.getElementById('obitos-faixa-etaria-chart').style.display = "block";
                    document.getElementById('loading-obitos-faixa-etaria').style.display = "none";
                    document.getElementById('grafico-faixa-etaria-download-btn').href = chart
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