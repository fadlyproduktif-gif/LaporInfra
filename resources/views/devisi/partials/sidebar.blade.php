<aside class="devisi-sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">

        <a href="{{ url('/devisi/dashboard') }}" class="sidebar-logo-link">

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
            ADMIN DEVİSI
        </span>

        <strong>
            Dinas Pekerjaan Umum dan
            Penataan Ruang (PUPR)
        </strong>

    </div>


    <!-- Navigation -->
    <nav class="sidebar-navigation">

        <a
            href="{{ url('/devisi/dashboard') }}"
            class="sidebar-nav-item {{ request()->is('devisi/dashboard') ? 'active' : '' }}"
        >

            <span class="sidebar-nav-icon">
                ⌂
            </span>

            <span>
                Dashboard
            </span>

        </a>


        <a
            href="{{ url('/devisi/laporan') }}"
            class="sidebar-nav-item {{ request()->is('devisi/laporan*') ? 'active' : '' }}"
        >

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

        <a href="#" class="sidebar-bottom-item portal">

            <span>
                ↗
            </span>

            <span>
                Portal Masyarakat
            </span>

        </a>


        <a href="#" class="sidebar-bottom-item logout">

            <span>
                ↪
            </span>

            <span>
                Logout
            </span>

        </a>

    </div>

</aside>