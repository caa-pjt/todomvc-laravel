<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'Mon super site')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha38§§§4-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
</head>
<body>

    <!-- https://todomvc.com/examples/vanillajs/ -->
    @if ($message = Session::get('success'))
        <div class="" style="display: block; width: 100%; display:flex; justify-content:center; padding-top: 20px;">
            <strong>{{ $message }}HELLO</strong>
        </div>
    @endif

    <section class="todoapp">
        <!-- Section qui va recevoir le code (ob_start())-->
        @yield('content')
        </section>
</body>
</html>