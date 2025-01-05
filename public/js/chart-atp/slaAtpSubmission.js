function initializeAgingChart(chartData) {
    var ctx = document.getElementById('slaAtpSubmissionChart').getContext('2d');
    
    var exceededData = chartData.exceeded || [];
    var notExceededData = chartData.notExceeded || [];
    
    var regions = [...new Set([...exceededData.map(item => item.regional), ...notExceededData.map(item => item.regional)])];
    
    if (regions.length === 0) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['No Data'],
                datasets: [{
                    label: 'No Data Available',
                    data: [0],
                    backgroundColor: 'rgba(200, 200, 200, 0.8)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'No Data Available'
                    }
                }
            }
        });
        return;
    }
    
    var exceededCounts = regions.map(region => {
        var item = exceededData.find(d => d.regional === region);
        return item ? item.count : 0;
    });
    
    var notExceededCounts = regions.map(region => {
        var item = notExceededData.find(d => d.regional === region);
        return item ? item.count : 0;
    });

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: regions,
            datasets: [
                {
                    label: 'Over SLA',
                    data: exceededCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Under SLA',
                    data: notExceededCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: false,
                },
                y: {
                    stacked: false,
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'SLA ATP Submission (Limit 7 Days)'
                },
                datalabels: {  // Tambahkan ini
                    anchor: 'end',
                    align: 'top',
                    formatter: Math.round,
                    font: {
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var chartData = JSON.parse(document.getElementById('chartData').textContent);
    initializeAgingChart(chartData);
});