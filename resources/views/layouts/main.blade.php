<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Smart Class - Itenas | {{ $title }}</title>

    {{-- Boostrap stuff --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    {{-- Custom css --}}
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/stylesidebar.css">
    <script src="scripts/script.js"></script>


    {{-- icon --}}
    <script src="https://kit.fontawesome.com/57a5f9b5e4.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        {{-- navbar --}}
        @include('partials.navbar')
        @include('partials.sidebardosen')
    </header>

    <div class="container-fluid my-3 contents-all px-5">
        @yield('container')
    </div>

    <footer>

    </footer>

</body>

</html>
