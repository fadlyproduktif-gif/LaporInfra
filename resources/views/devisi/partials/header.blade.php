@php
    $user = Auth::user();
@endphp
<header class="devisi-header">

    <div class="header-title">

        <h1>
            Dashboard Divisi
        </h1>

        <p>
            Kelola dan pantau laporan infrastruktur untuk divisi {{ $user->devisi->nama_devisi }}.
        </p>

    </div>

    <div class="header-user">

        <div class="division-badge">
            🏢
            <span>{{ $user->devisi->nama_devisi }}</span>
        </div>

        <div class="user-info">
            <strong>Admin Divisi</strong>
            <span>{{ $user->email }}</span>
        </div>

        <div class="user-avatar">
            {{ strtoupper(substr($user->nama_user, 0, 1)) }}

        </div>

    </div>

</header>
