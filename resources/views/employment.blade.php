<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Population Data Dashboard</title>
        <!-- Include Chart.js from a CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite('resources/js/employment.js')
    </head>
</html>
<body>
    <h1>Total employment</h1>

    @if($employmentData)
        <div id="employment-data"
            data-years="{{ implode(',', array_keys($employmentData)) }}"
            data-values="{{ implode(',', array_values($employmentData)) }}">
        </div>

        <canvas id="employmentChart"></canvas>

    @else
        <div class="alert alert-danger" role="alert">
                Data could not be retrieved. Please try again later.
        </div>
    @endif
</body>
