@extends('layouts.main')

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
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="">Senin, 18 Juli <br>(07.00 - 10.00)</td>
                                    <td>Sastra Mesin</td>
                                    <td>Engineering enjoy teuing</td>
                                    <td>Asep Komrudin</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Senin, 18 Juli <br>(10.00 - 12.00)</td>
                                    <td>Sastra Informatika</td>
                                    <td>Menjadi Si paling IT </td>
                                    <td>Hasby uwu</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                    <td>Cinta Lingkungan</td>
                                    <td>Bomb Nuclear</td>
                                    <td>Arip kon</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="">Senin, 18 Juli <br>(07.00 - 10.00)</td>
                                    <td>Sastra Mesin</td>
                                    <td>Engineering enjoy teuing</td>
                                    <td>Asep Komrudin</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Senin, 18 Juli <br>(10.00 - 12.00)</td>
                                    <td>Sastra Informatika</td>
                                    <td>Menjadi Si paling IT </td>
                                    <td>Hasby uwu</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                    <td>Cinta Lingkungan</td>
                                    <td>Bomb Nuclear</td>
                                    <td>Arip kon</td>
                                    {{-- <td>Booked</td> --}}
                                </tr>
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td class="">Senin, 18 Juli <br>(07.00 - 10.00)</td>
                                    <td>Sastra Mesin</td>
                                    <td>Engineering enjoy teuing</td>
                                    <td>Asep Komrudin</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Senin, 18 Juli <br>(10.00 - 12.00)</td>
                                    <td>Sastra Informatika</td>
                                    <td>Menjadi Si paling IT </td>
                                    <td>Hasby uwu</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                    <td>Cinta Lingkungan</td>
                                    <td>Bomb Nuclear</td>
                                    <td>Arip kon</td>
                                </tr>
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
            <img src="https://map.itenas.ac.id/map-itenas.jpg" width="100%" alt="">
        </div>
    </div>
@endsection
