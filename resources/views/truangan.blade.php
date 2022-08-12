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
                </div>
            </div>
        </div>
    </div>
@endsection
