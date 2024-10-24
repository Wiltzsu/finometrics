document.addEventListener('DOMContentLoaded', function () {
    // get data from the hidden div (employment-data)
    const dataElement = document.getElementById('employment-data');

    // convert the years and values into arrays
    const labels = dataElement.getAttribute('data-years').split(',').reverse();
    const employmentValues = dataElement.getAttribute('data-values').split(',').map(Number).reverse();

    const data = {
        labels: labels,
        datasets: [{
            label: 'Employment',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: employmentValues,
            fill: false,
            tension: 0.1
        }]
    };

    const config = {
        type: 'bar',
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
                        text: 'Employment'
                    },
                    beginAtZero: false
                }
            }
        }
    };

    // render the chart
    const employmentChart = new Chart(
        document.getElementById('employmentChart'),
        config
    );
});
