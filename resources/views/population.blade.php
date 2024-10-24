<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Data Dashboard</title>
    <!-- Include Chart.js from a CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/population.js')
</head>
<body>
    <div class="container mt-5">
        <h1>Total population data</h1>

        @if($populationData)
            <!-- prepare the data outside the script by fetching array keys and values -->
            <div id="population-data"
                 data-years="{{ implode(',', array_keys($populationData)) }}"
                 data-values="{{ implode(',', array_values($populationData)) }}">
            </div>

            <!-- canvas for the chart -->
            <canvas id="populationChart"></canvas>

        @else
            <div class="alert alert-danger" role="alert">
                Data could not be retrieved. Please try again later.
            </div>
        @endif
    </div>
</body>
</html>
