<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChartObitosSexo);

    function drawChartObitosSexo() {
        document.querySelector('#loading-obitos-sexo').style.display = "block";
        var data = google.visualization.arrayToDataTable(@json($dadosObitosSexo));

        var options = {
            title: 'Óbitos por Sexo',
            is3D: false,
            colors: ['#4285F4', '#F472B6'],
            footer: 'Fonte de dados: SIVO',
            titlePosition: 'out',
            chartArea: {
                // leave room for y-axis labels
                width: '85%',
                height: '75%',
                top: 20
            },
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'ready', function() {
            if (totalObitos != 0) {
                document.getElementById('grafico_sexo_pie').value = chart.getImageURI()
            }
            document.getElementById('grafico-obitos-sexo-download-btn').href = chart.getImageURI()
            document.querySelector('#loading-obitos-sexo').style.display = "none";

        })
        chart.draw(data, options);
        $(window).smartresize(function() {
            chart.draw(data, options);
        });
    }
</script>