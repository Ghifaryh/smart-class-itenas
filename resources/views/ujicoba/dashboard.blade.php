@extends('layouts.main')
@section('container')
    <div class="container-fluid dashboard-dosen ms-5">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="reg-room-wrapper px-5 py-2">
                    <h1 class="fw-bold pt-4">Pendaftaran Ruangan</h1>
                    <div class="reg-room">
                        <h5 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h5>
                        <form action="" class="reg-room-form">
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="floatingInput">
                                <label for="floatingInput">Tanggal Pemakaian</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="time" class="form-control" id="InputJamPemakaian" required>
                                <label for="floatingInput">Jam Pemakaian</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                    required>
                                    @php
                                        $num = 1;
                                    @endphp
                                    @foreach ($ruangan as $rn)
                                        <tr>
                                            <option value="{{ $num++ }}">{{ $rn->keterangan }}</option>
                                        </tr>
                                    @endforeach
                                    {{-- <option value="2">Ruang 2</option>
                                    <option value="3">Ruang Guru</option>
                                    <option value="3">Ruang 4</option>
                                    <option value="3">Ruang 5</option>
                                    <option value="3">Ruang 6</option> --}}
                                </select>
                                <label for="floatingSelect">Ruangan yang dipilih</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Jurusan"
                                    required>
                                <label for="floatingInput">Jurusan</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Mata Kuliah"
                                    required>
                                <label for="floatingInput">Mata Kuliah</label>
                            </div>
                            <div class="col-sm-9">
                                <p class="reg-room-info">*Pembookingan ruangan akan diproses paling lama 1*24 Jam</p>
                            </div>
                            <div class="mb-3 me-3 px-5 text-end">
                                <button type="submit" class="btn text-white me-5  reg-room-button fw-bold">Daftar</button>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Proses Pemesanan Ruangan</h2>
                            {{-- <table class="table sh-table" id="table1"> --}}
                            <table class="table table-striped" id="table1">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Jam Pakai</th>
                                        <th scope="col">Jurusan</th>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Dosen</th>
                                        <th scope="col">Status</th>
                                        @if (auth()->user()->level == 'admin')
                                            <th scope="col">Opsi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>1</td>
                                        <td>Senin, 18 Juli <br>(07.00 - 10.00)</td>
                                        <td>Sastra Mesin</td>
                                        <td>Engineering enjoy teuing</td>
                                        <td>Asep Komrudin</td>
                                        <td class="fw-bold text-success">Booked</td>
                                        @if (auth()->user()->level == 'admin')
                                            <td>
                                                <a href="" class="btn btn-success">Ubah</a>
                                                <a href="" class="btn btn-danger">Hapus</a>
                                            </td>
                                        @endif
                                    </tr>
                                    {{-- <tr>
                                        <th scope="row">2</th>
                                        <td>2</td>
                                        <td>Senin, 18 Juli <br>(10.00 - 12.00)</td>
                                        <td>Sastra Informatika</td>
                                        <td>Menjadi Si paling IT </td>
                                        <td>Hasby uwu</td>
                                        <td class="fw-bold text-success">Booked</td>
                                        <td>
                                            <a href="" class="btn btn-success">Ubah</a>
                                            <a href="" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>2</td>
                                        <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                        <td>Cinta Lingkungan</td>
                                        <td>Bomb Nuclear</td>
                                        <td>Arip kon</td>
                                        <td class="fw-bold text-primary">Process</td>
                                        <td>
                                            <a href="" class="btn btn-success">Ubah</a>
                                            <a href="" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>3</td>
                                        <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                        <td>Cinta Lingkungan</td>
                                        <td>Bomb Nuclear</td>
                                        <td>Arip kon</td>
                                        <td class="text-danger fw-bold">Bentrok</td>
                                        <td>
                                            <a href="" class="btn btn-success">Ubah</a>
                                            <a href="" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>4</td>
                                        <td>Senin, 18 Juli <br> (12.00 - 15.00)</td>
                                        <td>Cinta Lingkungan</td>
                                        <td>Bomb Nuclear</td>
                                        <td>Arip kon</td>
                                        <td class="text-danger fw-bold">Bentrok</td>
                                        <td>
                                            <a href="" class="btn btn-success">Ubah</a>
                                            <a href="" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
