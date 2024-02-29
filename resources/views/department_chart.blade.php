<style>
    .chart-container {
        width: 40%; /* Adjust this as per your requirement */
        margin: 0 auto; /* This centers the chart */
    }

    #myChart {
        display: block;
        max-width: 100%;
        height: auto;
    }
</style>


<div class="chart-container">
    <canvas id="myChart" width="200" height="200"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($departments->pluck('department')),
            datasets: [{
                label: 'Number of Employees',
                data: @json($departments->pluck('total')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            legend: {
                display: true,
                position: 'right'
            }
        }
    });
</script>
