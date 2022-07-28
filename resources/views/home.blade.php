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
                    <span class="text-danger fw-bold">
                        <a href="">
                            arip kontol
                        </a>
                    </span>
                </p>
            </div>
            <div class="row">
                <h2 class="content-title text-center mt-3"> List Ruangan</h2>
                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable1()">Ruangan 1</button> --}}
                    <p class="fw-bold btn btn-shtable" onclick="showTable1()">Ruangan 1</p>
                    <table class="table sh-table" id="table1">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable2()">Ruangan 2</button> --}}
                    <p class="fw-bold btn btn-shtable" onclick="showTable2()">Ruangan 2</p>
                    <table class="table sh-table" id="table2">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="container r-wrapper">
                    {{-- <button href="" class="btn btn-block" id="showr1" onclick="showTable2()">Ruangan 2</button> --}}
                    <p class="fw-bold btn btn-shtable" onclick="showTable3()">Ruangan 3</p>
                    <table class="table sh-table" id="table3">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col">
            <h2 class="content-title text-center"> Lokasi Gedung</h2>
            <img src="http://map.itenas.ac.id/map-itenas.jpg" width="100%" alt="">
        </div>
    </div>
@endsection
