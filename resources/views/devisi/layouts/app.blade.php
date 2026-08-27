<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard Devisi')
    </title>

    @vite([
        'resources/css/devisi/app.css',
        'resources/css/devisi/sidebar.css',
        'resources/css/devisi/topbar.css',
        'resources/css/devisi/dashboard.css',
        'resources/css/devisi/footer.css'
    ])

    @stack('styles')
</head>

<body>

    <div class="devisi-layout">

        @include('devisi.partials.sidebar')

        <div class="devisi-main">

            @include('devisi.partials.topbar')

            <main class="devisi-content">
                @yield('content')
            </main>

            @include('devisi.partials.footer')

        </div>

    </div>

    @stack('scripts')

</body>

</html>