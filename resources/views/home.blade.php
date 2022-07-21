@extends('layouts.main')

@section('container')
    <div class="row contents-wrapper">
        <div class="col">
            <div class="row">
                <h2 class="content-title text-center"> About</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat harum autem, quia veniam aliquid fugit
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
                    pariatur.</p>
            </div>
            <div class="row">
                <h2 class="content-title text-center mt-3"> List Ruangan</h2>
                <button href="" class="btn" id="showr1">Ruangan 1</button>

                <table class="table">
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

        <div class="col">
            <h2 class="content-title text-center"> Lokasi Gedung</h2>
            <img src="http://map.itenas.ac.id/map-itenas.jpg" width="100%" alt="">
        </div>
    </div>
@endsection
