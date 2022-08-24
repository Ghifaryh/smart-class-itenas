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
            <div class="col-sm-3" id="formPemesanan">
                <div class="reg-room-wrapper ms-5 px-4 py-2 mb-3" id="regWrapper">
                    <div class="reg-room">
                        {{-- @if ($param == 'add') --}}
                        <h3 class="fw-bold pt-2 text-nowrap">Pemesanan Ruangan</h3>
                        <h6 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h6>
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

                        {{-- <form action="/dashboard" method="post" class="reg-room-form" enctype="multipart/form-data"> --}}
                        <form action="" class="reg-room-form" id="submitPesan" enctype="multipart/form-data">
                            @csrf
                            <div class="col mb-3">
                                <label for="tanggal_input">Tanggal Peminjaman</label>
                                <input type="text" name="tanggal_input" id="tanggal_input"
                                    class="form-control @error('tanggal_input') is-invalid @enderror" required
                                    value="{{ old('tanggal_input') }}" readonly>

                                @error('tanggal_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3 ">
                                <label for="jam_masuk">Jam Masuk</label>
                                <select class="form-select @error('jam_masuk') is-invalid @enderror w-auto" name="jam_masuk"
                                    id="jam_masuk" data-width=100% required>
                                    <option value="" selected disabled hidden>Pilih Jam Masuk</option>
                                    @foreach ($jam as $jam_masuk)
                                        <option value="{{ $jam_masuk->jam_pakai }}"
                                            {{ old('jam_masuk') == $jam_masuk->jam_pakai ? 'selected' : '' }}>
                                            {{ date('H:i', strtotime($jam_masuk->jam_pakai)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jam_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="jam_keluar">Jam Keluar</label>
                                <select class="form-select @error('jam_keluar') is-invalid @enderror w-auto"
                                    name="jam_keluar" id="jam_keluar" data-width=100% required>
                                    <option value="" selected disabled hidden>Pilih Jam Keluar</option>
                                    @foreach ($jam as $jam_keluar)
                                        <option value="{{ $jam_keluar->jam_pakai }}"
                                            {{ old('jam_keluar') == $jam_keluar->jam_pakai ? 'selected' : '' }}>
                                            {{ date('H:i', strtotime($jam_keluar->jam_pakai)) }}</option>
                                    @endforeach
                                </select>
                                @error('jam_keluar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="id_ruangan">Ruangan yang dipilih</label>
                                <select class="form-select @error('id_ruangan') is-invalid @enderror" name="id_ruangan"
                                    id="id_ruangan" data-width=100% required>
                                    <option value="" selected disabled hidden>Pilih Ruangan</option>
                                    @foreach ($ruangan as $rn)
                                        <option value="{{ $rn->id }}"
                                            {{ old('id_ruangan') == $rn->id ? 'selected' : '' }}>
                                            {{ $rn->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_ruangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="prodi">Prodi</label>
                                <select name="prodi" id="prodi"
                                    class="form-select @error('prodi') is-invalid @enderror" data-width=100% required>
                                    <option value="" selected disabled hidden>Pilih Prodi</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->kode }}">{{ $prodi->nama }}</option>
                                    @endforeach
                                    </option>
                                </select>

                                @error('prodi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="matakuliah">Mata Kuliah</label>
                                <select name="matakuliah" id="matakuliah"
                                    class="form-select @error('matakuliah') is-invalid @enderror" data-width=100% required>
                                    {{-- <option value="" selected disabled hidden>Pilih Matakuliah</option> --}}
                                </select>
                                @error('matakuliah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="fileRPS" class="form-label @error('fileRPS') is-invalid @enderror">Input
                                    RPS</label>
                                <input class="form-control" type="file" id="fileRPS" name="fileRPS">
                                @error('fileRPS')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label for="fileSertif" class="form-label @error('fileSertif') is-invalid @enderror">Input
                                    Sertifikat</label>
                                <input class="form-control" type="file" id="fileSertif" name="fileSertif">
                                @error('fileSertif')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <input type="hidden" name="tanggal_pinjam" id="tanggal_pinjam">
                            <input type="hidden" name="dosen_matkul" id="dosen_matkul">
                            <input type="hidden" name="kelas" id="kelas">
                            <input type="hidden" name="id_pemesan" id="id_pemesan" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="id_status" id="id_status" value="1">
                            <div class="col">
                                <p class="reg-room-info">*Pemesanan ruangan akan diproses paling lama 1x24 Jam</p>
                            </div>
                            <div class="mb-3 me-3 text-center">
                                <button type="submit" class="btn text-white reg-room-button fw-bold text-uppercase"
                                    id="submitPesan">Daftar</button>
                            </div>
                        </form>
                        {{-- @else --}}
                        {{-- <h3 class="fw-bold pt-2 text-wrap">Edit Data Pemesanan Ruangan</h3>
                            <h6 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h6>
                            <form action="/dashboard/update/{{ $pesananedt->id }}" method="post" class="reg-room-form">
                                @csrf
                                <div class="col form-floating mb-3">
                                    <input type="text" name="tanggal_input"
                                        class="form-control @error('tanggal_input') is-invalid @enderror"
                                        id="tanggal_input" required value="{{ date('d/m/Y', strtotime($pesananedt->tanggal_pinjam)) }}" readonly>
                                    <label for="tanggal_input">Tanggal Peminjaman</label>
                                    @error('tanggal_input')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3 ">
                                    <label for="jam_masuk">Jam Masuk</label>
                                    <select class="form-select @error('jam_masuk') is-invalid @enderror w-auto"
                                        name="jam_masuk" id="jam_masuk" data-width=100% required>
                                        <option value="" selected disabled hidden>Pilih Jam Masuk</option>
                                        @foreach ($jam as $jam_masuk)
                                            <option value="{{ $jam_masuk->jam_pakai }}"
                                                {{ $pesananedt->jam_masuk == $jam_masuk->jam_pakai ? 'selected' : '' }}>
                                                {{ date('H:i', strtotime($jam_masuk->jam_pakai)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jam_masuk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="jam_keluar">Jam Keluar</label>
                                    <select class="form-select @error('jam_keluar') is-invalid @enderror w-auto"
                                        name="jam_keluar" id="jam_keluar" data-width=100% required>
                                        <option value="" selected disabled hidden>Pilih Jam Keluar</option>
                                        @foreach ($jam as $jam_keluar)
                                            <option value="{{ $jam_keluar->jam_pakai }}"
                                                {{ $pesananedt->jam_keluar == $jam_keluar->jam_pakai ? 'selected' : '' }}>
                                                {{ date('H:i', strtotime($jam_keluar->jam_pakai)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('jam_keluar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="id_ruangan">Ruangan yang dipilih</label>
                                    <select class="form-select @error('id_ruangan') is-invalid @enderror"
                                        name="id_ruangan" id="id_ruangan" data-width=100% required>
                                        <option value="" selected disabled hidden>Pilih Ruangan</option>
                                        @foreach ($ruangan as $rn)
                                            <option value="{{ $rn->id }}"
                                                {{ $pesananedt->id_ruangan == $rn->id ? 'selected' : '' }}>
                                                {{ $rn->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_ruangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="prodi">Prodi</label>
                                    <select name="prodi" id="prodi"
                                        class="form-select @error('prodi') is-invalid @enderror" data-width=100% required>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->kode }}"
                                                {{ $pesananedt->prodi == $prodi->kode ? 'selected' : '' }}>
                                                {{ $prodi->nama }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                    @error('prodi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col mb-3">
                                    <label for="matakuliah">Mata Kuliah</label>
                                    <select name="matakuliah" id="matakuliah"
                                        class="form-select @error('matakuliah') is-invalid @enderror" data-width=100%
                                        required>

                                        <option value="{{ $pesananedt->matakuliah }}" selected>{{ $pesananedt->matakuliah }}</option>
                                    </select>
                                    @error('matakuliah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ $pesananedt->tanggal_pinjam }}">
                                <input type="hidden" name="dosen_matkul" id="dosen_matkul"
                                    value="{{ $pesananedt->dosen_matkul }}">
                                <input type="hidden" name="kelas" id="kelas" value="{{ $pesananedt->kelas }}">
                                <input type="hidden" name="id_pemesan" id="id_pemesan"
                                    value="{{ $pesananedt->id_pemesan }}">
                                <input type="hidden" name="id_status" id="id_status" value="1">
                                <div class="col-sm-9">
                                    <p class="reg-room-info">*Pembookingan ruangan akan diproses paling lama 1*24 Jam</p>
                                </div>
                                <div class="text-center mb-3">
                                    <a href="/dashboard" class="btn text-white reg-room-button fw-bold me-3">Batal</a>
                                    <button type="submit"
                                        class="btn text-white reg-room-button-update fw-bold text-nowrap">Update</button>
                                </div>
                            </form>
                        @endif --}}

                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row-sm-9 mb-3">
                    <div class="reg-room-wrapper px-4 py-2">
                        <div class="reg-room">
                            <div class="table-responsive table-process">
                                <h2 class="fw-bold border-bottom border-2 border-dark mb-3 pt-2">List Proses Pemesanan
                                    Ruangan
                                </h2>
                                <table class="table table-striped table-list-pesan" id="table2">
                                    {{-- <thead class="bg-light text-center"> --}}
                                    <thead class="bg-light">
                                        <tr class="text-nowrap">
                                            <th scope="col">No</th>
                                            <th scope="col">Ruangan</th>
                                            <th scope="col">Waktu Pakai</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Dosen</th>
                                            <th scope="col">File RPS</th>
                                            <th scope="col">File Sertifikat</th>
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
                                                    ({{ date('H:i', strtotime($pesanan->jam_masuk)) }} -
                                                    {{ date('H:i', strtotime($pesanan->jam_keluar)) }})
                                                </td>
                                                <td class="text-nowrap">{{ $pesanan->Prodi->nama }}</td>
                                                <td class="text-wrap">{{ $pesanan->matakuliah }}</td>
                                                <td class="text-wrap">{{ $pesanan->kelas }}</td>
                                                <td class="text-wrap">{{ $pesanan->dosen_matkul }}</td>
                                                <td class="text-wrap">
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="badge bg-info border-0"
                                                        data-bs-toggle="modal" data-bs-target="#rpsModal">
                                                        View
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="rpsModal">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">File RPS</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <embed
                                                                        src="{{ asset('storage/' . $pesanan->fileRPS) }}"
                                                                        frameborder="0" width="100%" height="800px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form method="get"
                                                        action="{{ asset('storage/' . $pesanan->fileRPS) }}">
                                                        <button class="badge bg-primary border-0"
                                                            type="submit">Download</button>
                                                    </form>
                                                </td>
                                                <td class="text-wrap">
                                                    <button type="button" class="badge bg-info border-0"
                                                        data-bs-toggle="modal" data-bs-target="#sertifModal">
                                                        View
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="sertifModal">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">File Sertifikat</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <embed
                                                                        src="{{ asset('storage/' . $pesanan->fileSertif) }}"
                                                                        frameborder="0" width="100%" height="800px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <button class="badge bg-primary border-0" type="submit" onclick="window.location.href='{{ asset('storage/' . $pesanan->fileSertif) }}'">Download!</button> --}}
                                                    <form method="get"
                                                        action="{{ asset('storage/' . $pesanan->fileSertif) }}">
                                                        <button class="badge bg-primary border-0"
                                                            type="submit">Download</button>
                                                    </form>
                                                </td>
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
                                                        {{ date('d/m/y h:i:s', strtotime($pesanan->updated_at)) }}</td>
                                                @endif

                                                @if (auth()->user()->level == 'dosen')
                                                    <td class="text-nowrap">
                                                        {{-- @if ($pesanan->Status->keterangan == 'Menunggu Konfirmasi' or $pesanan->Status->keterangan == 'dibatalkan')
                                                            <form
                                                                action="/dashboard/edit/{{ $pesanan->id }}"method="post"
                                                                class="d-block">
                                                                @csrf
                                                                <button class="badge bg-primary border-0"
                                                                    onclick="return confirm('Apakah anda yakin untuk mengubah?')">Edit</button>
                                                            </form>
                                                        @endif --}}
                                                        <form action="/dashboard/hapusketpemesanan/{{ $pesanan->id }}"
                                                            method="post">
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

                                                        {{-- @if ($pesanan->Status->keterangan == 'Menunggu Konfirmasi' or $pesanan->Status->keterangan == 'dibatalkan')
                                                            <form
                                                                action="/dashboard/edit/{{ $pesanan->id }}"method="post"
                                                                class="d-block">
                                                                @csrf
                                                                <button class="badge bg-primary border-0"
                                                                    onclick="return confirm('Apakah anda yakin untuk mengubah?')">Edit</button>
                                                            </form>
                                                        @endif --}}

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
                                                        @if (auth()->user()->level == 'admin')
                                                            <form
                                                                action="/dashboard/hapuspemesanan/{{ $pesanan->id }}/{{ $pesanan->fileRPS }}/{{ $pesanan->fileSertif }}"
                                                                method="post">
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
                        </div>
                    </div>
                </div>

                @if (auth()->user()->level == 'admin')
                    <div class="row-sm-9 mb-3">
                        <div class="reg-room-wrapper px-4 py-2">
                            <div class="reg-room">
                                <div class="table-responsive">
                                    <h2 class="fw-bold border-bottom border-2 border-dark mb-3 pt-2">Jadwal Ruangan Yang
                                        Disetujui
                                    </h2>
                                    {{-- <table class="table sh-table" id="table1"> --}}
                                    <table class="table table-striped table-list-pesan" id="table1"
                                        style="width:100%">
                                        <thead class="bg-light text-center">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Ruangan</th>
                                                <th scope="col">Waktu Pakai</th>
                                                <th scope="col">Prodi</th>
                                                <th scope="col">Mata Kuliah</th>
                                                <th scope="col">kelas</th>
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
                                                        ({{ date('H:i', strtotime($jadwal->jam_masuk)) }} -
                                                        {{ date('H:i', strtotime($jadwal->jam_keluar)) }})
                                                    </td>
                                                    <td class="text-nowrap">{{ $jadwal->Prodi->nama }}</td>
                                                    <td class="text-wrap">{{ $jadwal->matakuliah }}</td>
                                                    <td class="text-wrap">{{ $jadwal->kelas }}</td>
                                                    <td class="text-wrap">{{ $jadwal->dosen_matkul }}</td>
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

                                                    <td class="text-nowrap">
                                                        <form action="/dashboard/hapusjadwal/{{ $jadwal->id }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger"
                                                                onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scriptsDashboard')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // DatePicker
        $(document).ready(function() {
            $("#matakuliah").prop('disabled', true);

            $('#tanggal_input').datepicker({
                dateFormat: 'dd/mm/yy'
            });
            $('#tanggal_input').datepicker('setDate', 'today');
            var tanggalSekarangFull = $('#tanggal_input').val();
            var splitTanggalSekarang = $('#tanggal_input').val().split("/");
            let tanggalSekarang = parseInt(splitTanggalSekarang[0]);
            let bulanSekarang = parseInt(splitTanggalSekarang[1]);
            let tahunSekarang = parseInt(splitTanggalSekarang[2]);

            $('#tanggal_input').on('change', function() {
                $('#prodi').append(
                    `<option value="" selected disabled hidden>Pilih Prodi</option>`
                );

                $("#matakuliah").prop('disabled', true);
                $('#matakuliah').empty();
                $('#matakuliah').append(
                    `<option value="" selected disabled hidden>Pilih Matakuliah</option>`
                );

                let tanggalPinjam = $('#tanggal_input').val();
                let splitTanggal = $('#tanggal_input').val().split("/");
                let tanggal = parseInt(splitTanggal[0]);
                let bulan = parseInt(splitTanggal[1]);
                let tahun = parseInt(splitTanggal[2]);
                if (tahun < tahunSekarang) {
                    swal({
                        title: "Error",
                        text: "Tidak bisa memesan tahun kurang dari tahun ini!",
                        icon: "error",
                        button: "Tutup",
                        timer: 2000,
                    });
                    $('#tanggal_input').val(tanggalSekarangFull);
                } else if (tahun == tahunSekarang) {
                    if (bulan < bulanSekarang) {
                        swal({
                            title: "Error",
                            text: "Tidak bisa memesan bulan kurang dari bulan ini!",
                            icon: "error",
                            button: "Tutup",
                            timer: 2000,
                        });
                        $('#tanggal_input').val(tanggalSekarangFull);
                    } else if (bulan == bulanSekarang) {
                        if (tanggal < tanggalSekarang) {
                            swal({
                                title: "Error",
                                text: "Tidak bisa memesan tanggal kurang dari hari ini!",
                                icon: "error",
                                button: "Tutup",
                                timer: 2000,
                            });
                            $('#tanggal_input').val(tanggalSekarangFull);
                        }
                    } else {
                        $('#tanggal_input').val(tanggalPinjam);
                    }
                }
            });

            $('#prodi').on('change', function() {
                // alert( this.value );
                $('#matakuliah').empty();
                $('#matakuliah').append(
                    `<option value="" selected disabled hidden>Pilih Matakuliah</option>`
                );
                if (!$('#prodi').val()) {
                    $("#matakuliah").prop('disabled', true);
                } else {
                    $("#matakuliah").prop('disabled', false);
                    let tanggalPesan = $('#tanggal_input').val().split("/");
                    var tahunPesan = parseInt(tanggalPesan[2]);
                    var bulanPesan = parseInt(tanggalPesan[1]);

                    var fixSemester;
                    let rumusSemester;
                    let nowSemester;

                    if (bulanPesan >= 9) {
                        //semester ganjil
                        nowSemester = tahunPesan.toString();
                        fixSemester = nowSemester + "1";
                    } else if (bulanPesan < 2) {
                        //semester ganjil
                        rumusSemester = tahunPesan - 1;
                        nowSemester = rumusSemester.toString();
                        fixSemester = nowSemester + "1";
                    } else if (bulanPesan >= 2 && bulanPesan <= 6) {
                        //semester genap
                        rumusSemester = tahunPesan - 1;
                        nowSemester = rumusSemester.toString();
                        fixSemester = nowSemester + "2";

                    } else if (bulanPesan >= 7 && bulanPesan < 9) {
                        // semester pendek
                        rumusSemester = tahunPesan - 1;
                        nowSemester = rumusSemester.toString();
                        fixSemester = nowSemester + "3";
                    } else {
                        alert("Semester tidak diketahui, silahkan perbaiki isinya");
                    }

                    let prodi = $('#prodi').val();
                    $.ajax({
                        type: 'GET',
                        url: '/get-matkul/' + fixSemester + '/' + prodi,
                        success: function(response) {
                            var response = JSON.parse(response);
                            response.forEach(element => {
                                $('#matakuliah').append(
                                    `<option value="${element['Disp_Kode']} ${element['Disp_Matakuliah']} ${element['Disp_Kelas']}">${element['Disp_Kode']} ${element['Disp_Matakuliah']} ${element['Disp_Kelas']}</option>`
                                );
                            });
                        }
                    });
                }
            });

            $('#matakuliah').on("change", function() {
                var tanggalmasuk = $('#tanggal_input').val().split("/").reverse().join("-");
                $('#tanggal_pinjam').val(tanggalmasuk);
                let tanggalPesan = $('#tanggal_input').val().split("/");
                var tahunPesan = parseInt(tanggalPesan[2]);
                var bulanPesan = parseInt(tanggalPesan[1]);
                console.log(tahunPesan);

                var fixSemester;
                let rumusSemester;
                let nowSemester;

                if (bulanPesan >= 9) {
                    //semester ganjil
                    nowSemester = tahunPesan.toString();
                    fixSemester = nowSemester + "1";
                } else if (bulanPesan < 2) {
                    //semester ganjil
                    rumusSemester = tahunPesan - 1;
                    nowSemester = rumusSemester.toString();
                    fixSemester = nowSemester + "1";
                } else if (bulanPesan >= 2 && bulanPesan <= 6) {
                    //semester genap
                    rumusSemester = tahunPesan - 1;
                    nowSemester = rumusSemester.toString();
                    fixSemester = nowSemester + "2";

                } else if (bulanPesan >= 7 && bulanPesan < 9) {
                    // semester pendek
                    rumusSemester = tahunPesan - 1;
                    nowSemester = rumusSemester.toString();
                    fixSemester = nowSemester + "3";
                } else {
                    alert("Semester tidak diketahui, silahkan perbaiki isinya");
                }
                var semester = parseInt(fixSemester);
                let prodi = $('#prodi').val();

                let matkul = $('#matakuliah').val();
                var kalimat = matkul.split(" ");
                var kalimatkebalik = matkul.split(" ").reverse();
                var kelas = kalimatkebalik[0];
                var kode_matkul = kalimat[0];
                console.log(kelas);
                $.ajax({
                    type: 'GET',
                    url: '/dosen-matkul/' + fixSemester + '/' + prodi + '/' + kode_matkul + '/' +
                        kelas,
                    success: function(response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#dosen_matkul').val(`${response["data1"]}`);
                        $('#kelas').val(`${response["data2"]}`);
                        console.log($('#dosen_matkul').val());
                    }
                });
            });

            $("#submitPesan").submit(function(e) {
                e.preventDefault();
                var url = '{{ url('dashboard') }}';
                var tanggal_pinjam = $("#tanggal_pinjam").val();
                var jam_masuk = $("#jam_masuk").val();
                var jam_keluar = $("#jam_keluar").val();
                var prodi = $("#prodi").val();
                var kelas = $("#kelas").val();
                var matakuliah = $("#matakuliah").val();
                var dosen_matkul = $("#dosen_matkul").val();
                var id_ruangan = $("#id_ruangan").val();
                var id_pemesan = $("#id_pemesan").val();
                var id_status = $("#id_status").val();
                // var fileRPS = new FormData ($("#fileRPS"));
                // var fileSertif = new FormData ($("#fileSertif"));
                var fileRPS = new FormData();
                fileRPS.append('file', $('#fileRPS')[0].files[0]);
                var fileSertif = new FormData();
                fileSertif.append('file', $('#fileSertif')[0].files[0]);
                swal({
                        title: "Apakah form pemesanan sudah sesuai?",
                        text: "Jika sudah sesuai maka akan segera diproses oleh admin.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                method: 'POST',
                                url: url,
                                data: {
                                    tanggal_pinjam: tanggal_pinjam,
                                    jam_masuk: jam_masuk,
                                    jam_keluar: jam_keluar,
                                    prodi: prodi,
                                    kelas: kelas,
                                    matakuliah: matakuliah,
                                    dosen_matkul: dosen_matkul,
                                    id_ruangan: id_ruangan,
                                    id_pemesan: id_pemesan,
                                    id_status: id_status,
                                    fileRPS: fileRPS,
                                    fileSertif: fileSertif,
                                },
                                async: false,
                                cache: false,
                                contentType: false,
                                enctype: 'multipart/form-data',
                                processData: false,
                                success: function(response) {
                                    if (response.success) {
                                        swal("Pemesanan berhasil!", {
                                            icon: "success",
                                        }).then(function() {
                                            location.reload();
                                            // window.location = window.location.href;
                                        });
                                    } else {
                                        swal("Pemesanan gagal!", {
                                            icon: "error",
                                        });
                                    }
                                },
                                error: function(error) {
                                    console.log(error)
                                }
                            });
                        }
                    });
            });

        });

        $(document).ready(function() {
            $("#jam_keluar").prop('disabled', true);
            $('#jam_masuk').on("change", function() {
                $('#jam_keluar').append(
                    `<option value="" selected disabled hidden>Pilih Jam Masuk</option>`
                );
                $("#jam_keluar").prop('disabled', false);
                if (!$('#jam_masuk').val()) {
                    $("#jam_keluar").prop('disabled', true);
                    $('#jam_keluar').append(
                        `<option value="" selected disabled hidden>Pilih Jam Keluar</option>`
                    );

                }
            });
            $('#jam_keluar').on("change", function() {
                let jamMasuk = $('#jam_masuk').val();
                let jamKeluar = $('#jam_keluar').val();

                if (jamKeluar <= jamMasuk) {
                    // alert('Jam Keluar harus lebih dari Jam Masuk!');
                    // swal("Hello world!");
                    swal({
                        title: "Error",
                        text: "Jam Keluar harus lebih dari Jam Masuk!",
                        icon: "error",
                        button: "Tutup",
                        timer: 2000,
                    });
                    $('#jam_keluar').append(
                        `<option value="" selected disabled hidden>Pilih Jam Keluar</option>`
                    );
                }
            });
        });

        $(document).ready(function() {
            $('#table1').DataTable();
            $('#table2').DataTable();
            $('#jam_masuk').select2({
                placeholder: "Pilih Jam Masuk",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve'
            });
            $('#jam_keluar').select2({
                placeholder: "Pilih Jam Keluar",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve'
            });
            $('#id_ruangan').select2({
                placeholder: "Pilih Ruangan",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve'
            });
            $('#semester').select2({
                placeholder: "Pilih Semester",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve'
            });
            $('#prodi').select2({
                placeholder: "Pilih Prodi",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve'
            });
            $('#matakuliah').select2({
                placeholder: "Pilih Matakuliah",
                theme: "bootstrap-5",
                allowClear: true,
                width: 'resolve',
            });
        });

        // Aesthetic
        $(document).ready(function() {
            if (window.matchMedia("(max-width: 767px)").matches) {
                $("#regWrapper").removeClass("ms-5");
                $("#formPemesanan").addClass("mx-auto");
            }
        });
    </script>
@endpush
