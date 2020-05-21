var ctx = $('#news_chart');
if (ctx) {
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: ctx.attr('data-info'),
                    data: JSON.parse(ctx.attr('data-news')),
                    borderColor: "rgba(0, 123, 255, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 123, 255, 0.5)"
                }
            ]
        },
        options: {
            legend: {
                position: 'top',
                labels: {
                    fontFamily: 'Poppins'
                }
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontFamily: "Poppins"
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontFamily: "Poppins"
                    }
                }]
            }
        }
    });
}
