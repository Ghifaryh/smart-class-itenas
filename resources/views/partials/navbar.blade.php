<header class="py-3 mb-3">
    {{-- <header class="py-3 mb-3 border-bottom"> --}}
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        {{-- <div class="logo-header d-flex align-items-center col-lg-4 mb-2 mb-lg-0" aria-expanded="true">
            <a href="https://www.itenas.ac.id/">
                <img src="https://www.itenas.ac.id/wp-content/uploads/2021/01/Varian-Logo-Itenas-FULL-02.png"
                    alt="lah ilang" width="100%">
            </a>
            <span class="titlewb fw-bold text-nowrap fs-2">
                <a href="/" class="text-decoration-none">SMART CLASSROOM</a>
            </span>
        </div> --}}

        <div class="logo-header">
            <a href="{{ route('scr.index') }}"
                class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none"
                aria-expanded="true">
                <img src="https://www.itenas.ac.id/wp-content/uploads/2021/01/Varian-Logo-Itenas-FULL-02.png"
                    alt="" width="80%">
                <span class="titlewb fw-bold text-nowrap">SMART CLASSROOM</span>
            </a>
        </div>

        <div class="d-flex align-items-center">
            <form class="w-100 me-3">
                {{-- Ignore this bb <3 --}}
            </form>

            <div class="dropdown me-3">

                @auth
                    <a href="#" class="d-inline-block link-dark text-decoration-none dropdown-toggle" id=""
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- If have image --}}
                        {{-- <img src="https://avatars.githubusercontent.com/u/93874441?v=4" alt="mdo" width="32"
                        height="32" class="rounded-circle"> --}}

                        {{-- If not --}}
                        {{-- <div class="user-wrapper"> --}}

                        <i class="fa-solid fa-user me-1 logowsidebarnv fs-5"></i>

                        <span class="user-name fw-bold">
                            {{ auth()->user()->name }} | @if (auth()->user()->level == 'admin')
                                {{ str_replace('a', 'A', auth()->user()->level) }}
                            @else
                                {{ str_replace('d', 'D', auth()->user()->level) }}
                            @endif
                        </span>

                        {{-- </div> --}}
                    </a>

                    <ul class="dropdown-menu shadow dropdown-menu-end" aria-labelledby="dropdownUser2" style="">
                        <li><a class="dropdown-item d-block " href="{{ route('scr.index') }}"><i
                                    class="fa-solid fa-house logowsidebarnv me-2"></i>Home</a>
                        </li>
                        <li><a class="dropdown-item d-block " href="{{ route('scr.dashboard') }}"><i
                                    class="fa-solid fa-building-circle-exclamation fs-6 logowsidebarnv me-2"></i>Status
                                Pemesanan</a>
                        </li>
                        @if (auth()->user()->level == 'admin')
                            <li>
                                <a class="dropdown-item d-block text-medium" href="{{ route('scr.truangan') }}"><i
                                        class="fa-solid fa-plus logowsidebarnv me-2 fs-5"></i>Tambah Ruangan</a>
                            </li>
                            <li>
                                <a class="dropdown-item d-block" href="{{ route('scr.verifakun') }}"><i
                                        class="fa-solid fa-user-shield logowsidebarnv me-2"></i>Verifikasi Akun</a>
                            </li>
                            <li>
                                <a class="dropdown-item d-block" href="{{ route('scr.pengaturan') }}"><i
                                        class="fa-solid fa-gear fs-5 logowsidebarnv me-2"></i>Pengaturan</a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('scr.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="d-block dropdown-item logout"><i
                                        class="fa-solid
                                    fa-right-from-bracket logowsidebarnv me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    @if ($title == 'Login' or $title == 'Register')
                        {{-- If else login or not --}}
                    @else
                        <a href="{{ route('scr.login') }}"
                            class="d-block link-dark text-decoration-none text-nowrap align-items-center"><i
                                class="fa-solid fa-right-to-bracket logowsidebarnv pe-1" aria-expanded="false"></i>
                            <span class="login-text fw-bold">
                                Login
                            </span>
                        </a>
                    @endif
                @endauth

            </div>

            <img src="https://www.itenas.ac.id/wp-content/uploads/2020/07/Logo-id-Heebo.png" width="5%"
                alt="" class="img-goodstart">
        </div>
    </div>
</header>
