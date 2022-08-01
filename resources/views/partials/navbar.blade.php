<header class="py-3 mb-3 border-bottom">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        <div class="logo-header">
            <a href="" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none"
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
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- If have image --}}
                        {{-- <img src="https://avatars.githubusercontent.com/u/93874441?v=4" alt="mdo" width="32"
                        height="32" class="rounded-circle"> --}}

                        {{-- If not --}}
                        <i class="fa-solid fa-user me-1 logowsidebarnv fs-5"></i>

                        <span class="user-name fw-bold">
                            {{ auth()->user()->name }}
                        </span>

                    </a>

                    <ul class="dropdown-menu text-small shadow dropdown-menu-end" aria-labelledby="dropdownUser2"
                        style="">
                        <li><a class="dropdown-item" href="#"><i
                                    class="fa-solid fa-building-circle-exclamation logowsidebarnv me-2"></i>Status
                                Pemesanan</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item"><i
                                        class="fa-solid fa-right-from-bracket logowsidebarnv me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                @else
                    {{-- If else login or not --}}
                    <a href="/login" class="d-block link-dark text-decoration-none text-nowrap align-items-center"
                        href="#"><i class="fa-solid fa-right-to-bracket logowsidebarnv pe-1"
                            aria-expanded="false"></i>
                        <span class="login-text fw-bold">
                            Login
                        </span>
                    </a>
                @endauth

            </div>

            <img src="https://www.itenas.ac.id/wp-content/uploads/2020/07/Logo-id-Heebo.png" width="5%"
                alt="">
        </div>
    </div>
</header>
