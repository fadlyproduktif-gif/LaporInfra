<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Devisi') - LAPORINFRA</title>

    @vite('resources/css/app.css')

    @stack('styles')
</head>

<body>

    @include('devisi.partials.sidebar')

    <div class="devisi-main">

        @include('devisi.partials.navbar')

        <main class="devisi-content">
            @yield('content')
        </main>

        @include('devisi.partials.footer')

    </div>

    @stack('scripts')

</body>
</html>