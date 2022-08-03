<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Smart Classroom Itenas | {{ $title }}</title>

    {{-- Boostrap stuff --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    {{-- Custom css --}}
    <link rel="stylesheet" href={{ asset('style/style.css') }}>
    <link rel="stylesheet" href={{ asset('style/stylesidebar.css') }}>
    <link rel="stylesheet" href={{ asset('style/styleujicoba.css') }}>
    @if ($title === 'Dashboard')
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

</head>

<body>
    <header>
        {{-- navbar --}}
        @include('partials.navbar')
        @if ($title === 'Dashboard' or $title === 'Home')
            @auth
                @include('partials.sidebardosen')
            @else
            @endauth
        @else
        @endif
    </header>

    <div class="container-fluid my-3 contents-all px-5">
        @yield('container')
    </div>

    <footer>

    </footer>

</body>

</html>
