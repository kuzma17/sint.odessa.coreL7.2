<canvas id="ChartPie" width="400" height="200"></canvas>
<script>
    $(function () {
        var ctx = document.getElementById("ChartPie").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! $data['labelArray'] !!},
                datasets: [
                    {
                        label: "Visitors",
                        borderColor: "rgba(220,220,220,1)",
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        data: {!! $data['dataArray'] !!}
                    }
                ]
            },
            options: {
                legend: {
                    display: true,
                    position: 'left'
                    }
            }
        });
    });
</script>