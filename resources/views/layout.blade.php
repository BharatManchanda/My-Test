<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .minimum-height-500 {
            min-height: 500px;
        }
    </style>
</head>
<body>
    <div class="mx-5">
        <main class="minimum-height-500">
            @yield('content') <!-- Placeholder for specific page content -->
        </main>
        
        <footer>
            <div class="d-flex justify-content-center">
                <p>&copy; {{ date('Y') }} Your Company</p>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-OERcA2F5Pb3eH5yEu4jz3cJ11e6lG7SkvrAkj85PKoUj8iIwf3xgKBR1+Q2BXhD9" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4o7MUtdh8SxOUbO2d7HUtSTN2lLRiC9T6h6f82Ho5P5pFu2eP6Hc73Wj7K2uQvf" crossorigin="anonymous"></script>
</body>
</html>
