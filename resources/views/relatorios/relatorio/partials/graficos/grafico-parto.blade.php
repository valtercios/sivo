<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartPartos);

    function drawChartPartos() {
        var data = google.visualization.arrayToDataTable([
            ['Parto', 'Antes', 'Durante', 'Depois'],
            ['Janeiro', 5, 8, 3],
            ['Fevereiro', 10, 6, 2],
            ['Março', 7, 4, 5],
            ['Abril', 9, 3, 4],
            ['Maio', 4, 7, 6]
        ]);

        var options = {
            title: 'Óbitos antes, durante e após o parto',
            vAxis: {
                title: 'Quantidade'
            },
            hAxis: {
                title: 'Mês'
            },
            seriesType: 'bars',
            chartArea: {
                // leave room for y-axis labels
                width: '85%',
                height: '75%',
                top: 20
            },
            series: {
                0: {
                    color: '#5DA5DA',
                    visibleInLegend: true
                },
                1: {
                    color: '#60BD68',
                    visibleInLegend: true
                },
                2: {
                    color: '#FAA43A',
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

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));

        var view = new google.visualization.DataView(data);
        view.setColumns([
            0,
            1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2,
            {
                calc: "stringify",
                sourceColumn: 2,
                type: "string",
                role: "annotation"
            },
            3,
            {
                calc: "stringify",
                sourceColumn: 3,
                type: "string",
                role: "annotation"
            }
        ]);

        google.visualization.events.addListener(chart, 'ready', function() {
            if (totalObitos != 0) {
                document.getElementById('grafico_parto_bar').value = chart.getImageURI()
            }
            document.getElementById('grafico-obitos-parto-download-btn').href = chart.getImageURI()
            document.getElementById('loading-obitos-parto').style.display = "none";
        })

        chart.draw(view, options);
        $(window).smartresize(function() {
            chart.draw(view, options);
        });
    }
</script>