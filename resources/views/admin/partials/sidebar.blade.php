<aside class="admin-sidebar">

    {{-- Logo --}}
    <div class="sidebar-brand">
        <div class="brand-mark">
            ⚡
        </div>

        <div class="brand-text">
            LAPOR<span>INFRA</span>
        </div>
    </div>


    {{-- Role --}}
    <div class="sidebar-role">
        <span class="role-dot"></span>
        ADMIN SYSTEM
    </div>


    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <a
            href="{{ route('admin.dashboard') }}"
            class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}"
        >
            <span>⌂</span>
            Dashboard
        </a>


        <a
            href="{{ route('admin.laporan.index') }}"
            class="nav-item {{ request()->is('admin/laporan*') ? 'active' : '' }}"
        >
            <span>▣</span>
            Laporan
        </a>


        <a
            href="{{ route('admin.kategori.index') }}"
            class="nav-item {{ request()->is('admin/kategori*') ? 'active' : '' }}"
        >
            <span>◇</span>
            Kategori
        </a>


        <a
            href="{{ route('admin.devisi.index') }}"
            class="nav-item {{ request()->is('admin/devisi*') ? 'active' : '' }}"
        >
            <span>▥</span>
            Devisi  
        </a>


        <a
            href="{{ route('admin.akun.index') }}"
            class="nav-item {{ request()->is('admin/akun*') ? 'active' : '' }}"
        >
            <span>♙</span>
            Akun
        </a>

    </nav>


    {{-- Bottom Menu --}}
    <div class="sidebar-bottom">

        <a
            href="{{ route('masyarakat.login') }}"
            class="portal-link"
        >
            ↗ &nbsp; Portal Masyarakat
        </a>


        <form
            method="POST"
            action="{{ url('/logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="logout-link"
            >
                ⇥ &nbsp; Logout
            </button>

        </form>

    </div>

</aside>