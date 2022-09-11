@php
function hariIndo($hariInggris)
{
    switch ($hariInggris) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}
function bulanIndo($hariInggris)
{
    switch ($hariInggris) {
        case 'Jan':
            return 'Januari';
        case 'Feb':
            return 'Februari';
        case 'Mar':
            return 'Maret';
        case 'Apr':
            return 'April';
        case 'May':
            return 'Mei';
        case 'Jun':
            return 'Juni';
        case 'Jul':
            return 'Juli';
        case 'Aug':
            return 'Agustus';
        case 'Sep':
            return 'September';
        case 'Oct':
            return 'Oktober';
        case 'Nov':
            return 'November';
        case 'Dec':
            return 'Desember';
        default:
            return 'bulan tidak valid';
    }
}
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Classroom Itenas | {{ $title }}</title>
    <!-- Trying Tailwind -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    {{-- Bs5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</head>

<body>
    {{-- <div class="container wrapper bg-body py-2 mt-3 shadow-lg"> --}}
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-auto wrapper bg-body py-2 mt-5 shadow-lg rounded-3">
                <div class="text-center mt-2">
                    <h1 class="border-bottom border-3 border-dark d-inline text-uppercase fs-2">Tiket Penggunaan Smart
                        Classroom</h1>
                </div>
                <div class="container main-wrapper mt-4">
                    <div class="data-pemesan">
                        <p class="border-bottom border-1 border-dark d-inline fs-3">Data Pemesan</p>
                        {{-- <p>
                            Ticket No : {{ $buktis->id }} <br>
                            Nama Pemesan : {{ $buktis->User->name }} <br>
                            Tanggal Pemesanan : {{ date('d-m-Y', strtotime($buktis->updated_at)) }}
                        </p> --}}
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ticket No</td>
                                    <td>:</td>
                                    <td>{{ $buktis->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pemesan</td>
                                    <td>:</td>
                                    <td>{{ $buktis->User->name }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pemesanan</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($buktis->updated_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="data-pesanan mt-3 pb-3">
                        <p class="border-bottom border-1 border-dark d-inline fs-3">Data Pesanan</p>
                        {{-- <p>
                            Tanggal Pemakaian: {{ date('d-m-Y', strtotime($buktis->tanggal_pinjam)) }} <br>
                            Ruangan: {{ $buktis->id_ruangan }} <br>
                            Jam Pemakaian:
                            {{ date('H:i', strtotime($buktis->jam_masuk)) . '-' . date('H:i', strtotime($buktis->jam_keluar)) }}
                            <br>
                            Dosen: {{ $buktis->dosen_matkul }} <br>
                            Mata Kuliah: {{ $buktis->matakuliah }}
                        </p> --}}

                        <table>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap">Tanggal Pemakaian</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y', strtotime($buktis->tanggal_pinjam)) }}</td>
                                </tr>
                                <tr>
                                    <td>Ruangan</td>
                                    <td>:</td>
                                    <td>{{ $buktis->id_ruangan }} </td>
                                </tr>
                                <tr>
                                    <td>Jam Pemakaian</td>
                                    <td>:</td>
                                    <td>{{ date('H:i', strtotime($buktis->jam_masuk)) . '-' . date('H:i', strtotime($buktis->jam_keluar)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dosen</td>
                                    <td>:</td>
                                    <td>{{ $buktis->dosen_matkul }}</td>
                                </tr>
                                <tr>
                                    <td>Mata Kuliah</td>
                                    <td>:</td>
                                    <td>{{ $buktis->matakuliah }}</td>
                                </tr>

                            </tbody>
                        </table>

                        {{-- <p>Tanggal Pemakaian: {{ date('d-m-Y', strtotime($buktis->tanggal_pinjam)) }}</p>
                        <p>Ruangan: {{ $buktis->id_ruangan }}</p>
                        <p>Jam Pemakaian:
                            {{ date('H:i', strtotime($buktis->jam_masuk)) . '-' . date('H:i', strtotime($buktis->jam_keluar)) }}
                        </p>
                        <p>Dosen: {{ $buktis->dosen_matkul }}</p>
                        <p>Mata Kuliah: {{ $buktis->matakuliah }}</p> --}}
                    </div>
                </div>

            </div>
            <div class="col"></div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        window.print();
    </script> --}}

</body>

</html>
