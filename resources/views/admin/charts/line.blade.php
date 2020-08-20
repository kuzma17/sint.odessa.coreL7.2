<canvas id="ChartLine" width="400" height="200"></canvas>
<script>
    $(function () {
        var ctx = document.getElementById("ChartLine").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $data['labelArray'] !!},
                datasets: [
                    {
                        label: "Visitors",
                        borderColor: "rgba(220,220,220,1)",
                        borderWidth: 1,
                        backgroundColor: "rgba(0,255,0,0.2)",
                        data: {!! $data['dataArray'] !!}
                    },
                    {
                        label: "Page Views",
                        borderColor: "rgba(220,220,220,1)",
                        borderWidth: 1,
                        backgroundColor: "rgba(255,255,0,0.2)",
                        data: {!! $data['data1Array'] !!}
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    });
</script>