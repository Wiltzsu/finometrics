document.addEventListener('DOMContentLoaded', function () {
    // get data from the hidden div (population-data)
    const dataElement = document.getElementById('population-data');

    // convert the years and values into arrays
    const labels = dataElement.getAttribute('data-years').split(',').reverse();
    const populationValues = dataElement.getAttribute('data-values').split(',').map(Number).reverse(); // convert strings to numbers

    const data = {
        labels: labels,
        datasets: [{
            label: 'Population',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: populationValues,
            fill: false,
            tension: 0.1
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Year'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Population'
                    },
                    beginAtZero: false
                }
            }
        }
    };

    // Render the chart
    const populationChart = new Chart(
        document.getElementById('populationChart'),
        config
    );
})
