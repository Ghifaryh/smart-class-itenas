<div id="mySidenav" class="sidenav">
    {{-- <a href="/" id="side1" class="asettext"><i class="fa-solid fa-house logowsidebaro"></i>Home</a> --}}
    <a href="/" id="side1" class="asettext text-end">Home<i
            class="fa-solid fa-house logowsidebaro ps-5 fs-3"></i></a>
    {{-- <a href="/dashboard" id="side2" class="asettext"><i class="fa-solid fa-pen-to-square logowsidebarw"></i>Pemesanan
        Ruangan</a> --}}
    <a href="/dashboard" id="side2" class="asettext text-end">Pemesanan
        Ruangan <i class="fa-solid fa-pen-to-square logowsidebarw ps-4 fs-3"></i></a>
    {{-- <a href="/statuspesan" id="side3" class="textw">
        <i class="fa-solid fa-building-circle-exclamation logowsidebaro"></i>
        Status Pemesanan
    </a> --}}
    @if (auth()->user()->level == 'admin')
        {{-- <a href="/truangan" id="side3" class="asettext"><i class="fa-solid fa-plus logowsidebaro"></i>Tambah
            Ruangan</a> --}}
        <a href="/truangan" id="side3" class="asettext text-end">Tambah
            Ruangan<i class="fa-solid fa-plus logowsidebaro ps-5"></i></a>
        {{-- <a href="/verifakun" id="side4" class="asettext"><i
                class="fa-solid fa-user-shield logowsidebarw"></i>Verifikasi Akun</a> --}}
        <a href="/verifakun" id="side4" class="asettext text-end">Verifikasi Akun <i
                class="fa-solid fa-user-shield logowsidebarw ps-5 fs-4"></i></a>
        {{-- <a href="/pengaturan" id="side5" class="asettext"><i
                class="fa-solid fa-gear logowsidebaro"></i>Pengaturan</a> --}}
        <a href="/pengaturan" id="side5" class="asettext text-end">Pengaturan<i
                class="fa-solid fa-gear logowsidebaro ps-5 fs-3"></i></a>
    @endif
</div>

