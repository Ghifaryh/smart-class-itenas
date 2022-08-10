@extends('layouts.main')

@php
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

@section('container')
    <div class="row contents-wrapper">
        <div class="col">
            <div class="row">
                <h2 class="content-title text-center"> About</h2>
                <p class="text-about" style="text-align: justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Quaerat harum autem,
                    quia veniam aliquid fugit
                    qui
                    non, iure rerum sed minus amet, temporibus tempora necessitatibus. Praesentium, quam ducimus
                    necessitatibus
                    voluptatem nulla, accusamus itaque corporis esse ratione magni eum suscipit debitis laboriosam
                    repellendus
                    alias. Nesciunt reiciendis quis cupiditate sed consequatur quod nostrum repudiandae obcaecati quaerat
                    qui
                    aliquam, eos consequuntur sunt quas esse magni? Eaque, sed ad, porro modi id, laboriosam nobis
                    praesentium
                    mollitia quis repudiandae sint! Illum, quasi deserunt corporis aliquam nulla reprehenderit
                    necessitatibus,
                    sequi quam porro dicta, deleniti officia voluptates aut nemo et! Sunt, fuga amet placeat at perferendis
                    pariatur.
                    {{-- <span class="text-danger fw-bold">
                        <a href="">
                            arip kontol
                        </a>
                    </span> --}}
                </p>
            </div>
            <div class="row">
                <h2 class="content-title text-center mt-3"> List Ruangan</h2>
                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable1()">Ruangan 1</button> --}}
                    <i class="fa-solid fa-minus" id="icon-btn-shtable1"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable1()">
                        Ruangan 1
                    </span>
                    {{-- <p class="fw-bold btn-shtable" onclick="showTable1()">Ruangan 1</p> --}}
                    <div class="table-responsive">
                        {{-- <table class="table sh-table" id="table1"> --}}
                        <table class="table" id="table1">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                    {{-- <th scope="col">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($jdwlrgn1 as $rg1)
                                <tr>
                                    <th scope="row">{{ $num1++ }}</th>
                                    <td class="text-nowrap">
                                        {{ hariIndo(date('l', strtotime($rg1->jadwal_masuk))) }},
                                        {{ date('d', strtotime($rg1->jadwal_masuk)) }}
                                        {{ bulanIndo(date('M', strtotime($rg1->jadwal_masuk))) }} <br>
                                        ({{ date('h:i', strtotime($rg1->jadwal_masuk)) }} -
                                        {{ date('h:i', strtotime($rg1->jadwal_keluar)) }})
                                    </td>
                                    <td class="text-nowrap">{{ $rg1->jurusan }}</td>
                                    <td class="text-nowrap">{{ $rg1->matakuliah }}</td>
                                    <td class="text-nowrap">{{ $rg1->User->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable2()">Ruangan 2</button> --}}
                    <i class="fa-solid fa-list" id="icon-btn-shtable2"></i> <span class="fw-bold btn-shtable"
                        onclick="showTable2()">
                        Ruangan 2
                    </span>
                    {{-- <p class="fw-bold btn-shtable" onclick="showTable2()">Ruangan 2</p> --}}
                    <div class="table-responsive">
                        <table class="table sh-table" id="table2">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jam Pakai</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                    {{-- <th scope="col">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($jdwlrgn2 as $rg2)
                                <tr>
                                    <th scope="row">{{ $num2++ }}</th>
                                    <td class="text-nowrap">
                                        {{ hariIndo(date('l', strtotime($rg2->jadwal_masuk))) }},
                                        {{ date('d', strtotime($rg2->jadwal_masuk)) }}
                                        {{ bulanIndo(date('M', strtotime($rg2->jadwal_masuk))) }} <br>
                                        ({{ date('h:i', strtotime($rg2->jadwal_masuk)) }} -
                                        {{ date('h:i', strtotime($rg2->jadwal_keluar)) }})
                                    </td>
                                    <td class="text-nowrap">{{ $rg2->jurusan }}</td>
                                    <td class="text-nowrap">{{ $rg2->matakuliah }}</td>
                                    <td class="text-nowrap">{{ $rg2->User->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable2()">Ruangan 2</button> --}}
                    {{-- <p class="fw-bold btn-shtable" onclick="showTable3()">Ruangan 3</p> --}}
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
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($jdwlrgn3 as $rg3)
                                <tr>
                                    <th scope="row">{{ $num3++ }}</th>
                                    <td class="text-nowrap">
                                        {{ hariIndo(date('l', strtotime($rg3->jadwal_masuk))) }},
                                        {{ date('d', strtotime($rg3->jadwal_masuk)) }}
                                        {{ bulanIndo(date('M', strtotime($rg3->jadwal_masuk))) }} <br>
                                        ({{ date('h:i', strtotime($rg3->jadwal_masuk)) }} -
                                        {{ date('h:i', strtotime($rg3->jadwal_keluar)) }})
                                    </td>
                                    <td class="text-nowrap">{{ $rg3->jurusan }}</td>
                                    <td class="text-nowrap">{{ $rg3->matakuliah }}</td>
                                    <td class="text-nowrap">{{ $rg3->User->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container-fluid text-center mt-3 pb-4">
                    {{-- <button class="btn btn-dark text-center" >+ Booking Ruangan</button> --}}
                    <a href="/dashboard" class="btn btn-book">+ Booking Ruangan</a>
                </div>
            </div>
        </div>


        <div class="col">
            <h2 class="content-title text-center"> Lokasi Gedung</h2>
            {{-- <img src="https://map.itenas.ac.id/map-itenas.jpg" width="100%" alt=""> --}}
            <img src={{ asset('img/map-itenas.jpg') }} width="100%" alt="" class="rounded-3 shadow-lg">
        </div>
    </div>
@endsection
