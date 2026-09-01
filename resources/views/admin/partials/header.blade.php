<header class="admin-header">

    <div class="header-left">

        <p class="header-eyebrow">
            Admin System
        </p>

        <h1>
            @yield('page-title', 'Dashboard Admin')
        </h1>

        <p class="header-description">
            @yield(
                'page-description',
                'Kelola data dan pantau sistem pelaporan LAPORINFRA.'
            )
        </p>

    </div>


    <div class="admin-user">

        <div class="admin-user-info">

            <strong>
                {{ auth()->user()->name ?? 'Admin System' }}
            </strong>

            <span>
                {{ auth()->user()->email ?? 'admin@laporinfra.go.id' }}
            </span>

        </div>


        <div class="admin-avatar">

            {{ strtoupper(
                substr(
                    auth()->user()->name ?? 'A',
                    0,
                    1
                )
            ) }}

        </div>

    </div>

</header>