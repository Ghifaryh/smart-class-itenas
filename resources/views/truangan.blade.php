@extends('layouts.main')

@section('tambah-ruangan')
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="addRuanganWrapper px-4 py-2">
                    <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Penambahan Ruangan</h1>

                    <form action="" method="" class="formAddRuangan">
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="namaRuangan" id="namaRuangan" placeholder="Nama Ruangan"
                                class="form-control">
                            <label for="namaRuangan">Nama Ruangan</label>
                        </div>
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="fasilitasRuangan" id="fasilitasRuangan"
                                placeholder="Fasilitas"class="form-control">
                            <label for="fasilitasRuangan">Fasilitas Ruangan</label>
                        </div>
                        <div class="mb-3 me-3 px-5 text-end">
                            <button type="submit" class="btn text-white me-5  add-room-button fw-bold">Tambah
                                Ruangan</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Ruangan </h2>
                        <table class="table table-striped table-list-pesen">
                            <thead class="bg-light text-center">
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Ruangan</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                                <tr>
                                    <th scope="row">1</th>
                                    <th scope="row">Ruangan 1</th>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <th scope="row">Ruangan 1</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
