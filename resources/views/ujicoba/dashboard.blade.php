@extends('layouts.main')

@php
$num1 = 1;
$num2 = 1;
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
{{-- @section('container') --}}
@section('dashboard-main')
    <div class="container-fluid dashboard-dosen">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="reg-room-wrapper px-5 py-2">
                    <div class="reg-room">

                        @if ($param == 'add')
                            <h1 class="fw-bold pt-4">Pemesanan Ruangan</h1>
                            <h5 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h5>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session()->has('failed'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('failed') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="/dashboard" method="post" class="reg-room-form">
                                @csrf
                                <div class="col-sm-9 form-floating mb-3">
                                    <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" required value="{{ old('tanggal_pinjam') }}">
                                    <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                                    @error('tanggal_pinjam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3 ">
                                    <label for="jam_masuk">Jam Masuk
                                        <select class="form-select @error('jam_masuk') is-invalid @enderror"
                                            name="jam_masuk" id="jam_masuk" data-width=100% required>
                                            <option value="" selected disabled hidden>Pilih Jam</option>
                                            @foreach ($jam as $jam_masuk)
                                                <option value="{{ $jam_masuk->jam_pakai }}"
                                                    {{ old('jam_masuk') == $jam_masuk->jam_pakai ? 'selected' : '' }}>
                                                    {{ date('H:i', strtotime($jam_masuk->jam_pakai)) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <label for="jam_keluar">Jam Keluar
                                        <select class="form-select @error('jam_keluar') is-invalid @enderror"
                                            name="jam_keluar" id="jam_keluar" data-width=100% required>
                                            <option value="" selected disabled hidden>Pilih Jam Keluar</option>
                                            @foreach ($jam as $jam_keluar)
                                                <option value="{{ $jam_keluar->jam_pakai }}"
                                                    {{ old('jam_keluar') == $jam_keluar->jam_pakai ? 'selected' : '' }}>
                                                    {{ date('H:i', strtotime($jam_keluar->jam_pakai)) }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <label for="id_ruangan">Ruangan yang dipilih
                                        <select class="form-select @error('id_ruangan') is-invalid @enderror" name="id_ruangan" id="id_ruangan" required>
                                            <option value="" selected disabled hidden>Pilih Ruangan</option>
                                            @foreach ($ruangan as $rn)
                                                <option value="{{ $rn->id }}"
                                                    {{ old('id_ruangan') == $rn->id ? 'selected' : '' }}>
                                                    {{ $rn->nama }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('id_ruangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <label for="semester">Semester
                                        <select name="semester" id="semester"
                                            class="form-select @error('semester') is-invalid @enderror" data-width="300%" required>
                                            <option value="" selected disabled hidden>Pilih Semester</option>
                                            <option value="20221">Ganjil</option>
                                            <option value="20212">Genap</option>
                                        </select>
                                    </label>
                                    @error('semester')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <label for="prodi">Prodi
                                        <select name="prodi" id="prodi"
                                            class="form-select @error('prodi') is-invalid @enderror" required>
                                            <option value="" selected disabled hidden>Pilih Prodi</option>
                                            <option value="">
                                            </option>
                                        </select>
                                    </label>
                                    @error('prodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 mb-3">
                                    <label for="matakuliah">Mata Kuliah
                                        <select name="matakuliah" id="matakuliah"
                                            class="form-select @error('matakuliah') is-invalid @enderror" required>
                                            <option value="" selected disabled hidden>Pilih Matakuliah</option>
                                            <option value=""></option>
                                        </select>
                                    </label>
                                    @error('matakuliah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="id_dosen" id="id_dosen" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="id_status" id="id_status" value="1">
                                <div class="col-sm-9">
                                    <p class="reg-room-info">*Pemesanan ruangan akan diproses paling lama 1x24 Jam</p>
                                </div>
                                <div class="mb-3 me-3 px-5 text-end">
                                    <button type="submit"
                                        class="btn text-white me-5  reg-room-button fw-bold">Daftar</button>
                                </div>
                            </form>
                        @else
                            <h1 class="fw-bold pt-4">Edit Data Pemesanan Ruangan</h1>
                            <h5 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h5>
                            <form action="/dashboard/update/{{ $pesananedt->id }}" method="post" class="reg-room-form">
                                @csrf
                                <div class="col-sm-9 form-floating mb-3">
                                    <input type="date" name="tanggal_pinjam"
                                        class="form-control @error('tanggal_pinjam') is-invalid @enderror"
                                        id="tanggal_pinjam" required value="{{ $pesananedt->tanggal_pinjam }}">
                                    <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                                    @error('tanggal_pinjam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 form-floating mb-3">
                                    <select class="form-select @error('jam_masuk') is-invalid @enderror" name="jam_masuk"
                                        id="jam_masuk" required>
                                        @foreach ($jam as $jam_masuk)
                                        <option value="{{ $jam_masuk->jam_pakai }}"
                                            {{ $pesananedt->jam_masuk == $jam_masuk->jam_pakai ? 'selected' : '' }}>
                                            {{ date('H:i', strtotime($jam_masuk->jam_pakai)) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="jam_masuk">Jam Masuk</label>
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 form-floating mb-3">
                                    <select class="form-select @error('jam_keluar') is-invalid @enderror"
                                        name="jam_keluar" id="jam_keluar" required>
                                        @foreach ($jam as $jam_keluar)
                                        <option value="{{ $jam_keluar->jam_pakai }}"
                                            {{ $pesananedt->jam_keluar == $jam_keluar->jam_pakai ? 'selected' : '' }}>
                                            {{ date('H:i', strtotime($jam_keluar->jam_pakai)) }}</option>
                                        @endforeach
                                    </select>
                                    <label for="jam_keluar">Jam Keluar</label>
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 form-floating mb-3">
                                    <select class="form-select @error('id_ruangan') is-invalid @enderror"
                                        name="id_ruangan" id="id_ruangan" required>
                                        @foreach ($ruangan as $rn)
                                            <option value="{{ $rn->id }}"
                                                {{ $pesananedt->id_ruangan == $rn->id ? 'selected' : '' }}>
                                                {{ $rn->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="id_ruangan">Ruangan yang dipilih</label>
                                    @error('id_ruangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 form-floating mb-3">
                                    <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                        name="prodi" id="prodi" placeholder="Prodi" required
                                        value="{{ $pesananedt->prodi }}">
                                    <label for="prodi">Prodi</label>

                                    <option value="" selected disabled hidden>Pilih Jam</option>
                                    @error('prodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-9 form-floating mb-3">
                                    <input type="text" class="form-control @error('matakuliah') is-invalid @enderror"
                                        name="matakuliah" id="matakuliah" placeholder="Mata Kuliah" required
                                        value="{{ $pesananedt->matakuliah }}">
                                    <label for="matakuliah">Mata Kuliah</label>
                                    @error('matakuliah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="id_dosen" id="id_dosen"
                                    value="{{ $pesananedt->id_dosen }}">
                                <input type="hidden" name="id_status" id="id_status" value="1">
                                <div class="col-sm-9">
                                    <p class="reg-room-info">*Pembookingan ruangan akan diproses paling lama 1*24 Jam</p>
                                </div>
                                <div class="mb-3 me-3 px-5 text-end">
                                    <button type="submit" class="btn text-white me-5  reg-room-button fw-bold">Update
                                        Data</button>
                                </div>
                            </form>
                        @endif

                        <div class="table-responsive">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Proses Pemesanan Ruangan</h2>
                            <table class="table table-striped table-list-pesan" id="table2">
                                <thead class="bg-light text-center">
                                    <tr class="text-nowrap">
                                        <th scope="col">No</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Waktu Pakai</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Dosen</th>
                                        <th scope="col">Status</th>
                                        @if (auth()->user()->level == 'admin')
                                            <th scope="col">Waktu Pemesanan</th>
                                        @endif
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                    @foreach ($pesanans as $pesanan)
                                        <tr>
                                            <th scope="row">{{ $num1++ }}</th>
                                            <td>{{ $pesanan->id_ruangan }}</td>
                                            <td class="text-nowrap">
                                                {{ hariIndo(date('l', strtotime($pesanan->tanggal_pinjam))) }},
                                                {{ date('d', strtotime($pesanan->tanggal_pinjam)) }}
                                                {{ bulanIndo(date('M', strtotime($pesanan->tanggal_pinjam))) }} <br>
                                                ({{ date('h:i', strtotime($pesanan->jam_masuk)) }} -
                                                {{ date('h:i', strtotime($pesanan->jam_keluar)) }})
                                            </td>
                                            <td class="text-nowrap">{{ $pesanan->prodi }}</td>
                                            <td class="text-wrap">{{ $pesanan->matakuliah }}</td>
                                            <td class="text-nowrap">{{ $pesanan->User->name }}</td>
                                            @if ($pesanan->Status->keterangan == 'Menunggu Konfirmasi')
                                                <td class="fw-bold text-warning text-nowrap">
                                                    {{ $pesanan->Status->keterangan }}</td>
                                            @elseif ($pesanan->Status->keterangan == 'Diterima')
                                                <td class="fw-bold text-success text-nowrap">
                                                    {{ $pesanan->Status->keterangan }}</td>
                                            @elseif ($pesanan->Status->keterangan == 'Dijadwalkan')
                                                <td class="fw-bold text-primary text-nowrap">
                                                    {{ $pesanan->Status->keterangan }}</td>
                                            @else
                                                <td class="fw-bold text-danger text-nowrap">
                                                    {{ $pesanan->Status->keterangan }}</td>
                                            @endif

                                            @if (auth()->user()->level == 'admin')
                                                <td class="text-nowrap">
                                                    {{ date('d/m/y h:i:s', strtotime($pesanan->created_at)) }}</td>
                                            @endif

                                            @if (auth()->user()->level == 'dosen')
                                                <td class="text-nowrap">
                                                    @if ($pesanan->Status->keterangan == 'Menunggu Konfirmasi' or $pesanan->Status->keterangan == 'dibatalkan')
                                                        <form action="/dashboard/edit/{{ $pesanan->id }}"method="post"
                                                            class="d-block">
                                                            @csrf
                                                            <button class="badge bg-primary border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk mengubah?')">Edit</button>
                                                        </form>
                                                    @endif
                                                    <form action="/dashboard/hapus/{{ $pesanan->id }}" method="post">
                                                        @csrf
                                                        <button class="badge bg-danger border-0"
                                                            onclick="return confirm('Apakah anda yakin menghapus jadwal?')">Hapus</button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>
                                                    @if ($pesanan->Status->keterangan == 'Dihapus' or $pesanan->Status->keterangan == 'Ditolak (Dihapus)')
                                                    @else
                                                        <form action="/dashboard/terima/{{ $pesanan->id }}"
                                                            method="post" class="d-block">
                                                            @csrf
                                                            <button class="badge bg-success border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk menerima jadwal?')">Terima</button>
                                                        </form>
                                                    @endif

                                                    @if ($pesanan->Status->keterangan == 'Menunggu Konfirmasi' or $pesanan->Status->keterangan == 'dibatalkan')
                                                        <form action="/dashboard/edit/{{ $pesanan->id }}"method="post"
                                                            class="d-block">
                                                            @csrf
                                                            <button class="badge bg-primary border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk mengubah?')">Edit</button>
                                                        </form>
                                                    @endif

                                                    @if ($pesanan->Status->keterangan == 'Dihapus' or $pesanan->Status->keterangan == 'Ditolak (Dihapus)')
                                                        <form action="/dashboard/batalhapus/{{ $pesanan->id }}"
                                                            method="post" class="d-block">
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk menolak jadwal?')">Batalkan</button>
                                                        </form>
                                                    @else
                                                        <form action="/dashboard/batal/{{ $pesanan->id }}"
                                                            method="post" class="d-block">
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk membatalkan jadwal?')">Batalkan</button>
                                                        </form>
                                                    @endif
                                                    @if ($pesanan->Status->keterangan == 'Dihapus' or
                                                        $pesanan->Status->keterangan == 'Ditolak (Dihapus)' or
                                                        auth()->user()->level == 'admin')
                                                        <form action="/dashboard/{{ $pesanan->id }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Apakah anda yakin untuk menghapus jadwal?')">Hapus</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (auth()->user()->level == 'admin')
                            <div class="table-responsive">
                                <h2 class="fw-bold border-bottom border-2 border-dark mb-3">Jadwal Ruangan Yang Disetujui
                                </h2>
                                {{-- <table class="table sh-table" id="table1"> --}}
                                <table class="table table-striped table-list-pesan" id="table1">
                                    <thead class="bg-light text-center">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Ruangan</th>
                                            <th scope="col">Waktu Pakai</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">Dosen</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center align-middle">
                                        @foreach ($jadwals as $jadwal)
                                            <tr>
                                                <th scope="row">{{ $num2++ }}</th>
                                                <td>{{ $jadwal->id_ruangan }}</td>
                                                <td class="text-nowrap">
                                                    {{ hariIndo(date('l', strtotime($jadwal->tanggal_pinjam))) }},
                                                    {{ date('d', strtotime($jadwal->tanggal_pinjam)) }}
                                                    {{ bulanIndo(date('M', strtotime($jadwal->tanggal_pinjam))) }} <br>
                                                    ({{ date('h:i', strtotime($jadwal->jam_masuk)) }} -
                                                    {{ date('h:i', strtotime($jadwal->jam_keluar)) }})
                                                </td>
                                                <td class="text-nowrap">{{ $jadwal->prodi }}</td>
                                                <td class="text-wrap">{{ $jadwal->matakuliah }}</td>
                                                <td class="text-nowrap">{{ $jadwal->User->name }}</td>
                                                @if ($jadwal->Status->keterangan == 'Menunggu Konfirmasi')
                                                    <td class="fw-bold text-warning text-nowrap">
                                                        {{ $jadwal->Status->keterangan }}</td>
                                                @elseif ($jadwal->Status->keterangan == 'Diterima')
                                                    <td class="fw-bold text-success text-nowrap">
                                                        {{ $jadwal->Status->keterangan }}</td>
                                                @elseif ($jadwal->Status->keterangan == 'Dijadwalkan')
                                                    <td class="fw-bold text-primary text-nowrap">
                                                        {{ $jadwal->Status->keterangan }}</td>
                                                @else
                                                    <td class="fw-bold text-danger text-nowrap">
                                                        {{ $jadwal->Status->keterangan }}</td>
                                                @endif

                                                @if (auth()->user()->level == 'dosen')
                                                    <td class="text-nowrap">
                                                        <form action="/dashboard/{{ $jadwal->id }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td>
                                                        <form action="/dashboard/hapus/{{ $jadwal->id }}"
                                                            method="post" class="d-block">
                                                            @csrf
                                                            <button class="badge bg-danger border-0"
                                                                onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
            $('#table2').DataTable();
            $('#jam_masuk').select2({
                placeholder: "Pilih Jam Masuk",
                theme : "bootstrap-5",
                allowClear: true,
            });
            $('#jam_keluar').select2({
                placeholder: "Pilih Jam Keluar",
                theme : "bootstrap-5",
                allowClear: true
            });
            $('#id_ruangan').select2({
                placeholder: "Pilih Ruangan",
                theme : "bootstrap-5",
                allowClear: true
            });
            $('#semester').select2({
                placeholder: "Pilih Semester",
                theme : "bootstrap-5",
                allowClear: true
            });
            $('#prodi').select2({
                placeholder: "Pilih Prodi",
                theme : "bootstrap-5",
                allowClear: true
            });
            $('#matakuliah').select2({
                placeholder: "Pilih Matakuliah",
                theme : "bootstrap-5",
                allowClear: true
            });
        });
    </script>
@endsection
