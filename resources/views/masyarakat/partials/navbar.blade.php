@php
$user = auth()->user();
@endphp
<header class="navbar">

    <div class="navbar-left">

        <a href="{{ url('/masyarakat/dashboard') }}" class="logo-link">

            <div class="logo-icon">
                ⚡
            </div>

            <div class="logo-text">
                LAPOR<span>INFRA</span>
            </div>

        </a>

    </div>


    <nav class="navbar-menu">

        <a
            href="{{ url('/masyarakat/dashboard') }}"
            class="{{ request()->is('masyarakat/dashboard') ? 'active' : '' }}">
            Beranda
        </a>

        <a
            href="{{ url('/masyarakat/laporan-saya') }}"
            class="{{ request()->is('masyarakat/laporan*') ? 'active' : '' }}">
            Laporan Saya
        </a>

    </nav>


    <div class="user-menu-wrapper">

        <button
            type="button"
            class="user-menu"
            id="userMenuButton"
            aria-expanded="false">

            <div class="user-avatar">
                {{ strtoupper(substr($user->nama_user, 0, 1)) }}
            </div>

            <span class="user-name">
                {{ $user->nama_user }}
            </span>

            <span class="arrow" id="userMenuArrow">
                ⌄
            </span>

        </button>


        <div
            class="user-dropdown"
            id="userDropdown">

            <div class="user-dropdown-header">

                <span class="dropdown-label">
                    Masuk sebagai
                </span>

                <strong>
                    {{$user->nama_user}}
                </strong>

                <span>
                    {{$user->email}}
                </span>

            </div>


            <a href="{{ route('profil') }}" class="dropdown-item">

                <span class="dropdown-icon">
                    ♙
                </span>

                <span>
                    Profil Saya
                </span>

            </a>


            <div class="dropdown-divider"></div>


            <form action="{{ route('logout.masyarakat') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item logout">
                    <span class="dropdown-icon">
                        ↪
                    </span>

                    <span>
                        Keluar
                    </span>
                </button>
            </form>

        </div>

    </div>

</header>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const button = document.getElementById('userMenuButton');
        const dropdown = document.getElementById('userDropdown');
        const arrow = document.getElementById('userMenuArrow');

        if (!button || !dropdown) {
            return;
        }

        button.addEventListener('click', function(event) {

            event.stopPropagation();

            const isOpen =
                dropdown.classList.toggle('show');

            button.setAttribute(
                'aria-expanded',
                isOpen
            );

            if (arrow) {
                arrow.classList.toggle('rotate', isOpen);
            }

        });


        document.addEventListener('click', function() {

            dropdown.classList.remove('show');

            button.setAttribute(
                'aria-expanded',
                'false'
            );

            if (arrow) {
                arrow.classList.remove('rotate');
            }

        });

    });
</script>