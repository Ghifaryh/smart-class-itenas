<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Smart Classroom Itenas | {{ $title }}</title>

    {{-- Boostrap stuff --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    {{-- Custom css --}}
    <link rel="stylesheet" href={{ asset('style/style.css') }}>
    <link rel="stylesheet" href={{ asset('style/stylesidebar.css') }}>
    <link rel="stylesheet" href={{ asset('style/styleujicoba.css') }}>
    @if ($title === 'Dashboard' or $title == 'Tambah Ruangan' or $title == 'Verifikasi Akun')
        <link rel="stylesheet" href={{ asset('style/styledashboard.css') }}>
    @endif

    @if ($title === 'Login')
        <link rel="stylesheet" href={{ asset('style/stylelogin.css') }}>
    @endif


    {{-- <link rel="stylesheet" href="style/styledashboard.css"> --}}
    <script src={{ asset('scripts/script.js') }}></script>

    {{-- JQ --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- icon --}}
    <script src="https://kit.fontawesome.com/57a5f9b5e4.js" crossorigin="anonymous"></script>

    <link href="https://tik.itenas.ac.id/front/assets/img/logo-tik-favicon.png" rel="icon">

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    {{-- JqueryUI --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js">
    </script>
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> --}}

    {{-- select2.org --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Swal --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- bactsretch / wallpaper --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.1.18/jquery.backstretch.min.js"></script>

    {{-- Main Aestehtic --}}
    @stack('scripts')
    {{-- Dashboard Aestehtic --}}
    @stack('scriptsDashboard')
    @stack('scriptsVerification')

    @stack('scriptsTruangan')

    {{-- Login Aestehtic --}}
    @stack('loginJs')

</head>

<body>
    <header>
        {{-- navbar --}}
        @include('partials.navbar')
        @if ($title === 'Dashboard' or $title === 'Home' or $title === 'Tambah Ruangan' or $title === 'Verifikasi Akun')
            @auth
                @include('partials.sidebardosen')
            @else
            @endauth
        @else
        @endif
    </header>

    @if ($title === 'Home' or $title === 'Login' or $title === 'Register')
        <div class="container-fluid my-3 contents-all px-5">
            @yield('container')
            @include('sweetalert::alert')
        </div>
    @elseif ($title === 'Dashboard')
        {{-- @elseif ($title === 'Dashboard' or $title == 'Tambah Ruangan') --}}
        <div class="dashboard-wrapper-main">
            @yield('dashboard-main')
            @include('sweetalert::alert')
        </div>
    @elseif ($title === 'Tambah Ruangan')
        <div class="truangan-wrapper-main">
            @yield('tambah-ruangan')
            @include('sweetalert::alert')
        </div>
    @elseif ($title === 'Verifikasi Akun')
        <div class="truangan-wrapper-main">
            @yield('verif-akun')
            @include('sweetalert::alert')
        </div>
    @endif

    <footer class="footer">
        <div class="container top-item">
            <div class="row mx-1">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <aside>
                        <p class="text-uppercase title-foot">Sumber Informasi Akademik</p>
                        <ul class="list-group">
                            <li class="list-group list-item">
                                <a href="https://cdc.itenas.ac.id/">Carrier Development Center</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="https://www.itenas.ac.id/mahasiswa-2/kalender-akademik/">Kalender Akademik
                                    Sarjana</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="https://www.itenas.ac.id/mahasiswa-2/kalender-akademik-magister/">Kalender
                                    Akademik
                                    Magister</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="#">SISFO SKK</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://bka.itenas.ac.id/">Kemahasiswaan Itenas</a>
                            </li>
                        </ul>
                    </aside>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <aside>
                        <p class="text-uppercase title-foot">Sumber Informasi Institut</h4>
                        <ul class="list-group">
                            <li class="list-group list-item">
                                <a href="http://lp2m.itenas.ac.id">Lembaga Penelitian & Pengabdian kepada Masyarakat</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://tik.itenas.ac.id">UPT Teknologi Informasi &amp; Komunikasi</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://lib.itenas.ac.id">UPT Perpustakaan</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://spp.itenas.ac.id" target="_blank" rel="noopener noreferrer">Satuan
                                    Pengembangan
                                    Pembelajaran</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://spm.itenas.ac.id">Satuan Penjaminan Mutu</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="https://spi.itenas.ac.id/">Satuan Pengawas Internal</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="#">Biro Akademik</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="#">Biro Keuangan &amp; Umum</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://bka.itenas.ac.id/">Biro Kemahasiswaan &amp; Alumni</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://bsdm.itenas.ac.id">Biro Sumber Daya Manusia</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://bkhp.itenas.ac.id">Biro Kerja Sama, Hubungan Masyarakat &amp;
                                    Pemasaran</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="https://international-office.itenas.ac.id">Kantor Urusan Internasional</a>
                            </li>
                        </ul>

                    </aside>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <aside>
                        <p class="text-uppercase title-foot">Link</h4>
                        <ul class="list-group">
                            <li class="list-group list-item">
                                <a href="https://www.itenas.ac.id/e-magazine/">Itenas e-Magazine</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://eprints.itenas.ac.id" target="_blank"
                                    rel="noopener noreferrer">Repository</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="http://ebook.itenas.ac.id" target="_blank" rel="noopener noreferrer">e-Book</a>
                            </li>
                            <li class="list-group list-item">
                                <a href="https://www.itenas.ac.id/download/">Download</a>
                            </li>
                        </ul>
                    </aside>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <aside>
                        <p class="text-uppercase title-foot">Follow US</p>
                        <ul class="list-group list-group-horizontal">
                            <li class="list-group list-item of-icon">
                                <a href="https://www.facebook.com/itenas.official/">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            </li>
                            <li class="list-group list-item of-icon">
                                <a href="https://twitter.com/@itenas_official">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li class="list-group list-item of-icon">
                                <a href="https://www.instagram.com/itenas.official/">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <li class="list-group list-item of-icon">
                                <a href="https://www.youtube.com/channel/UCXNl5jOSO9os1nOr40oizXg">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </aside>
                    <aside id="text-29" class="widget widget_text">
                        <div class="textwidget">
                            <p>&nbsp;</p>
                            <p><img class="alignnone size-medium wp-image-20322"
                                    src="https://www.itenas.ac.id/wp-content/uploads/2021/11/Ranked-2022-300x211.jpg"
                                    alt="" width="300" height="211"></p>
                        </div>
                    </aside>
                    <aside id="" class="widget widget_text">
                        <div class="textwidget">
                            <p>&nbsp;</p>
                            <p><span style="color: #fbf7f7;">KAMPUS INSTITUT TEKNOLOGI NASIONAL</span><br>
                                Jl. PH.H. Mustofa No.23 Bandung 40124<br>
                                Phone: +62 22 7272215, Fax +62 22 7202892<br>
                                humas[at]itenas.ac.id, http://www.itenas.ac.id</p>
                        </div>
                    </aside>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
        <div class="container bottom-item text-center mb-5">
            <a href="" class="text-decoration-none cr-text text-white">© Itenas | Institut Teknologi Nasional -
                Bandung</a>
            <p>Created by: 152019081 - 152019082 </p>
        </div>
    </footer>

</body>

</html>
