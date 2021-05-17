<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devices API</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </head>
    <body>
        <header>
            <h1 class="text-center p-3">Devices API</h1>
        </header>

        <section>
            <div class="container fluid">
                <p>Models list:</p>
                <ul>
                    <li>Country</li>
                    <li>City</li>
                    <li>Brand</li>
                    <li>Model</li>
                    <li>Device</li>
                    <li>Order</li>
                    <li>Item</li>
                </ul>
            </div>
        </section>

        <footer>
            <div class="container fluid text-center">
                <p>Devices API © Alina Hinzhul</p>
                <p>Course work</p>
                <p>2021</p>
            </div>
        </footer>
    </body>
</html>
