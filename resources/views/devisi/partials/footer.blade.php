@php
    $user = Auth::User();
@endphp
<footer class="devisi-footer">

    <span>
        © {{ date('Y') }} LAPORINFRA — Sistem Pengaduan Infrastruktur Publik
    </span>

    <span>
        Admin Devisi · {{$user->devisi->nama_devisi}}
    </span>

</footer>