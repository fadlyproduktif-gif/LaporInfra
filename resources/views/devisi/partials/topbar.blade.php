@php
    $user = Auth::user();
@endphp
<header class="devisi-topbar">

    <div class="topbar-title">

        <h1>
            Dashboard Devisi
        </h1>

        <p>
            Kelola dan pantau laporan infrastruktur untuk divisi {{ $user->devisi->nama_devisi }}.
        </p>

    </div>


    <div class="topbar-user">

        <div class="topbar-division">
            <span class="division-icon">
                ▦
            </span>

            <span>
                {{ $user->devisi->nama_devisi }}
            </span>
        </div>


        <div class="topbar-user-info">

            <strong>
                {{ $user->nama_user }}
            </strong>

            <span>
                {{ $user->email }}
            </span>

        </div>


        <div class="topbar-avatar">
            {{ strtoupper(substr($user->nama_user, 0, 1)) }}

        </div>

    </div>

</header>
