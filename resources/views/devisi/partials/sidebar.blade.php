@php
    $user = Auth::user();
@endphp
<aside class="devisi-sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">

        <a href="{{ route('devisi.dashboard') }}" class="sidebar-logo-link">

            <div class="sidebar-logo-icon">
                ⚡
            </div>

            <div class="sidebar-logo-text">
                LAPOR<span>INFRA</span>
            </div>

        </a>

    </div>


    <!-- Admin Info -->
    <div class="sidebar-admin-card">

        <span class="sidebar-admin-label">
            ADMIN OPD
        </span>

        <strong>
            {{ $user->devisi->nama_devisi }}
        </strong>

    </div>


    <!-- Navigation -->
    <nav class="sidebar-navigation">

        <a href="{{ route('devisi.dashboard') }}"
            class="sidebar-nav-item {{ request()->is('devisi/dashboard') ? 'active' : '' }}">

            <span class="sidebar-nav-icon">
                ⌂
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <a href="{{ route('devisi.laporan') }}"
            class="sidebar-nav-item {{ request()->is('devisi/laporan*') ? 'active' : '' }}">

            <span class="sidebar-nav-icon">
                ▣
            </span>

            <span>
                Laporan
            </span>

        </a>

    </nav>


    <!-- Bottom Navigation -->
    <div class="sidebar-bottom">

        <a href="{{route('home')}}" class="sidebar-bottom-item portal">

            <span>
                ↗
            </span>

            <span>
                Portal Masyarakat
            </span>

        </a>

        <form method="POST" action="{{ route('logout.devisi') }}">
            <button class="sidebar-bottom-item logout" style="border: none" type="submit">

                    <span>
                        ↪
                    </span>

                    <span>
                        Logout
                    </span>

            </button>
        </form>

    </div>

</aside>
