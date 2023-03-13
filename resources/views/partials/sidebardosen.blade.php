<div id="mySidenav" class="sidenav">
    <a href="/" id="side1" class="asettext"><i class="fa-solid fa-house logowsidebaro"></i>Home</a>
    <a href="/dashboard" id="side2" class="asettext"><i class="fa-solid fa-pen-to-square logowsidebarw"></i>Pemesanan
        Ruangan</a>
    @if (auth()->user()->level == 'admin')
        <a href="/truangan" id="side3" class="asettext"><i class="fa-solid fa-plus logowsidebaro"></i>Tambah
            Ruangan</a>
        <a href="/verifakun" id="side4" class="asettext"><i class="fa-solid fa-user-shield logowsidebarw"></i>Verifikasi Akun</a>
        <a href="/pengaturan" id="side5" class="asettext"><i class="fa-solid fa-gear logowsidebaro"></i>Pengaturan</a>
    @endif
</div>

