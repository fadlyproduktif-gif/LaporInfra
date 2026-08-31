<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Dashboard Admin') - LAPORINFRA
    </title>

    @vite('resources/css/admin/app.css')

    @stack('styles')
</head>

<body>

    <div class="admin-shell">

        {{-- Sidebar / Navbar --}}
        @include('admin.partial.navbar')

        <div class="admin-main">

            {{-- Header --}}
            @include('admin.partial.header')

            {{-- Content halaman --}}
            <main class="admin-content">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('admin.partial.footer')

        </div>

    </div>

    @stack('scripts')

</body>
</html>