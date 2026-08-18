<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'LAPORINFRA')
    </title>

    @vite([
        'resources/css/masyarakat/app.css',
        'resources/css/masyarakat/navbar.css',
        'resources/css/masyarakat/footer.css',
    ])

    @stack('styles')

</head>

<body>

    @include('masyarakat.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('masyarakat.partials.footer')

    @stack('scripts')

</body>

</html>