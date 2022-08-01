@extends('layouts.main')
<style>
    body {
        background-image: url('https://www.itenas.ac.id/wp-content/uploads/2020/10/Tentang-Itenas-scaled.jpg');

        background-position: center;
        background-size: cover;

    }



    .reg-room-wrapper {
        /* background-color: white; */
        background: rgba(255, 255, 255, 0.9);
        /* height: 173%; */
        /* display: block; */
    }


    .reg-room-button {
        background-color: orange !important;
    }

    .reg-room-info {
        font-size: 0.85rem !important;
        color: orange;
        /* font-weight: 300; */
    }

    .reg-room-button {
        width: 20%;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.25);
        border-radius: 20px !important;
    }

    input,
    select {
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.2);
    }
</style>
@section('container')
    <div class="background-image"></div>
    <div class="container-fluid dashboard-dosen ms-5">
        <div class="row">
            <div class="col"></div>
            <div class="col ms-5">
                <div class="reg-room-wrapper px-5">
                    <h1 class="fw-bold pt-4">Pendaftaran Ruangan</h1>
                    <div class="reg-room">
                        <h5 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h5>
                        <form action="" class="reg-room-form">
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="date" class="form-control" id="floatingInput">
                                <label for="floatingInput">Tanggal Pemakaian</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="time" class="form-control" id="InputJamPemakaian" required>
                                <label for="floatingInput">Jam Pemakaian</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                    required>
                                    <option value="1">Ruang 1</option>
                                    <option value="2">Ruang 2</option>
                                    <option value="3">Ruang Guru</option>
                                    <option value="3">Ruang 4</option>
                                    <option value="3">Ruang 5</option>
                                    <option value="3">Ruang 6</option>
                                </select>
                                <label for="floatingSelect">Ruangan yang dipilih</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Mata Kuliah"
                                    required>
                                <label for="floatingInput">Mata Kuliah</label>
                            </div>
                            <div class="col-sm-9">
                                <p class="reg-room-info">*Pembookingan ruangan akan diproses paling lama 1*24 Jam</p>
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn text-white me-5 reg-room-button fw-bold">Daftar</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Ruangan</h2>
                            {{-- <table class="table sh-table" id="table1"> --}}
                            <table class="table table-striped mb-3" id="table1">
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
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                        <td>Cinta Lingkungan</td>
                                        <td>Bomb Nuclear</td>
                                        <td>Arip kon</td>
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
                </div>
            </div>
        </div>
    </div>
@endsection
