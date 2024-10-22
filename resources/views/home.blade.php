<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Data Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Population Data for 2023</h1>

        @if($data)
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Population Information</h2>

                    {{-- Accessing the population value --}}
                    @if (isset($data['value']) && is_array($data['value']) && isset($data['value'][0]))
                        <p class="card-text">
                            Population on December 31, 2023: {{ $data['value'][0] }} people
                        </p>
                    @else
                        <p>No population data available.</p>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-danger" role="alert">
                Data could not be retrieved. Please try again later.
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
