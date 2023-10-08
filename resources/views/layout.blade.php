<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'Mon super site')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- https://todomvc.com/examples/vanillajs/ -->
    @if ($message = Session::get('success'))
        <div class="" style="display: block; width: 100%; display:flex; justify-content:center; padding-top: 20px;">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <section class="todoapp">
        <!-- Section qui va recevoir le code (ob_start())-->
        @yield('content')
    </section>
</body>
</html>