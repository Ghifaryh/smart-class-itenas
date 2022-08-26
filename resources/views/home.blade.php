@extends('layouts.main')

@php
$numton = 1;
$num1 = 1;
$num2 = 1;
$num3 = 1;
$num4 = 1;
$num5 = 1;
$num6 = 1;
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
@php
$directory = 'img/ruangan/';
$filecount = count(glob($directory . '*'));

$fileSystemIterator = new FilesystemIterator('img/ruangan/');
$entries = [];
foreach ($fileSystemIterator as $fileInfo) {
    $entries[] = $fileInfo->getFilename();
}

@endphp

@php
$dir = 'img/ruangan/';
$images = glob($dir . '/*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
$jumlah = count($images);
@endphp

@section('container')
    <div class="container-fluid mb-4" id="">
        <div id="carouselFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselFade" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                @for ($i = 1; $i <= $jumlah; $i++)
                    <button type="button" data-bs-target="#carouselFade" data-bs-slide-to="{{ $i }}"
                        aria-label="Slide {{ $i }}"></button>
                @endfor
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/ruangan/trigger/1.jpeg') }}" class="d-block w-100 h-50 mx-auto" alt="...">
                </div>
                {{-- Harus nambah style widht and height --}}
                @foreach ($images as $img)
                    <div class="carousel-item">
                        <img src="{{ asset($img) }}" class="d-block w-100 h-50 mx-auto"
                            alt="Foto-foto fasilitas dan ruangan Smart Classsroom">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row contents-wrapper">
        <div class="col-sm-6">
            <div class="row">
                <h2 class="content-title text-center"> About</h2>
                <p class="text-about" style="text-align: justify">
                    Smart Classroom adalah sebuah kelas yang memiliki fasilitas teknologi untuk melakukan kegiatan
                    pembelajaran secara hybrid yang memiliki fasilitas seperti Iceboard, AC, Webcam dengan kualitas HD,
                    Speaker, dan fasilitas Internet yang cepat.
                </p>
                <p>
                    Smart Classroom memiliki 5 ruangan dengan kapasitas masing-masing 20 orang dan disetiap
                    ruangannya terdapat peredam suara.
                </p>
            </div>
            <div class="row ruangan">
                <h2 class="content-title text-center mt-3"> List Ruangan</h2>
                <input type="text" id="searchHome" placeholder="Cari Matakuliah/Dosen/prodi" class="my-3 py-2">

                <input type="hidden" name="banyakRuangan" id="banyakRuangan" value="{{ $ruangan }}">

                <div class="container r-wrapper">
                    <i class="fa-solid fa-minus" id="icon-btn-shtable1"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable1()">
                        Ruangan 1
                    </span>
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable1">
                                @foreach ($jdwlrgn1 as $rg1)
                                    <tr>
                                        <th scope="row">{{ $num1++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg1->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg1->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg1->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg1->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg1->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg1->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg1->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg1->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    <i class="fa-solid fa-list" id="icon-btn-shtable2"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable2()">
                        Ruangan 2
                    </span>
                    <div class="table-responsive">
                        <table class="table sh-table" id="table2">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable2">
                                @foreach ($jdwlrgn2 as $rg2)
                                    <tr>
                                        <th scope="row">{{ $num2++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg2->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg2->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg2->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg2->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg2->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg2->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg2->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg2->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    <i class="fa-solid fa-list" id="icon-btn-shtable3"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable3()">
                        Ruangan 3
                    </span>
                    <div class="table-responsive">
                        <table class="table sh-table" id="table3">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable3">
                                @foreach ($jdwlrgn3 as $rg3)
                                    <tr>
                                        <th scope="row">{{ $num3++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg3->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg3->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg3->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg3->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg3->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg3->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg3->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg3->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    <i class="fa-solid fa-list" id="icon-btn-shtable4"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable4()">
                        Ruangan 4
                    </span>
                    <div class="table-responsive">
                        <table class="table sh-table" id="table4">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable4">
                                @foreach ($jdwlrgn4 as $rg4)
                                    <tr>
                                        <th scope="row">{{ $num4++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg4->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg4->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg4->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg4->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg4->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg4->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg4->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg4->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    <i class="fa-solid fa-list" id="icon-btn-shtable5"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable5()">
                        Ruangan 5
                    </span>
                    <div class="table-responsive">
                        <table class="table sh-table" id="table5">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable5">
                                @foreach ($jdwlrgn5 as $rg5)
                                    <tr>
                                        <th scope="row">{{ $num5++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg5->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg5->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg5->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg5->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg5->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg5->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg5->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg5->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    <i class="fa-solid fa-list" id="icon-btn-shtable6"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable6()">
                        Ruangan 6
                    </span>
                    <div class="table-responsive">
                        <table class="table sh-table" id="table6">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col" class="text-nowrap">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle" id="myTable6">
                                @foreach ($jdwlrgn6 as $rg6)
                                    <tr>
                                        <th scope="row">{{ $num6++ }}</th>
                                        <td class="text-nowrap">
                                            {{ hariIndo(date('l', strtotime($rg6->tanggal_pinjam))) }},
                                            {{ date('d', strtotime($rg6->tanggal_pinjam)) }}
                                            {{ bulanIndo(date('M', strtotime($rg6->tanggal_pinjam))) }} <br>
                                            ({{ date('H:i', strtotime($rg6->jam_masuk)) }} -
                                            {{ date('H:i', strtotime($rg6->jam_keluar)) }})
                                        </td>
                                        <td class="text-wrap">{{ $rg6->Prodi->nama }}</td>
                                        <td class="text-wrap">{{ $rg6->matakuliah }}</td>
                                        <td class="text-wrap">{{ $rg6->dosen_matkul }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container-fluid text-center mt-3 pb-4">
                    <a href="/dashboard" class="btn btn-book">+ Booking Ruangan</a>
                </div>
            </div>
        </div>


        <div class="col-sm-6">
            <h2 class="content-title text-center"> Lokasi Gedung</h2>
            <div class="interactive-map">
                <img src={{ asset('img/map-smartclassroom.jpg') }} width="100%" alt=""
                    class="rounded-3 shadow-lg">
                <a href="" class="map-marker text-center" id="markLokasi">
                    <span aria-hidden="true">
                        <i class="fa-solid fa-circle"></i>
                    </span>
                </a>
            </div>

        </div>
    </div>
    <input type="hidden" name="fotos" value="{{ $filecount }}" id="fotos">
    <input type="hidden" name="fotoName" id="fotoName" value="{{ implode(',', $entries) }}">
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var fotos = parseInt($('#fotos').val());

            var fotoName = $('#fotoName').val().split(",");
            var imgs = [];
            for (var i = 0; i < fotoName.length; i++) {
                imgs.push("img/ruangan/" + fotoName[i]);
            }

            $("#carouselStretch").backstretch(
                imgs, {
                    duration: 3000,
                    fade: 750
                }
            );
        });


        $(document).ready(function() {
            if (window.matchMedia("(max-width: 767px)").matches) {

                $("#icon-btn-shtable2").removeClass("fa-list");
                $("#icon-btn-shtable2").addClass("fa-minus");

                $("#icon-btn-shtable3").removeClass("fa-list");
                $("#icon-btn-shtable3").addClass("fa-minus");

                $("#icon-btn-shtable4").removeClass("fa-list");
                $("#icon-btn-shtable4").addClass("fa-minus");

                $("#icon-btn-shtable5").removeClass("fa-list");
                $("#icon-btn-shtable5").addClass("fa-minus");

                $("#icon-btn-shtable6").removeClass("fa-list");
                $("#icon-btn-shtable6").addClass("fa-minus");

                $(".btn-shtable").prop("onclick", null);
            }
        });


        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                $("#table1").show();
                $("#icon-btn-shtable1").removeClass("fa-list");
                $("#icon-btn-shtable1").addClass("fa-minus");

                $("#table2").show();
                $("#icon-btn-shtable2").removeClass("fa-list");
                $("#icon-btn-shtable2").addClass("fa-minus");

                $("#table3").show();
                $("#icon-btn-shtable3").removeClass("fa-list");
                $("#icon-btn-shtable3").addClass("fa-minus");

                $("#table4").show();
                $("#icon-btn-shtable4").removeClass("fa-list");
                $("#icon-btn-shtable4").addClass("fa-minus");

                $("#table5").show();
                $("#icon-btn-shtable5").removeClass("fa-list");
                $("#icon-btn-shtable5").addClass("fa-minus");

                $("#table6").show();
                $("#icon-btn-shtable6").removeClass("fa-list");
                $("#icon-btn-shtable6").addClass("fa-minus");

                $(".btn-shtable").prop("onclick", null);
            });

        });

        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable3 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable4 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable5 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
        $(document).ready(function() {
            $("#searchHome").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable6 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endpush
