@extends('layouts.main')

@php
$num1 = 1;
$num2 = 1;
@endphp

@section('verif-akun')
    @if (session()->has('Verif'))
        <script>
            $(document).ready(function() {
                swal({
                    title: 'Berhasil',
                    text: `{{ session('Verif') }}`,
                    icon: "success",
                    button: "Tutup",
                    timer: 3000,
                });
            });
        </script>
    @endif
    {{-- <div class="container-fluid dashboard-dosen ms-5"> --}}
    <div class="container-fluid dashboard-verif mb-5">
        <div class="row">
            {{-- <div class="col-sm-9 ms-5"> --}}
            {{-- <div class="col"></div> --}}
            <div class="col col-sm-11 mx-auto">
                {{-- <div class="row-sm-9 mb-3"> --}}
                <div class="reg-room-wrapper px-3 py-2">
                    <div class="reg-room">
                        {{-- <div class="table-responsive table-process"> --}}
                        <div class="table-process">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3 pt-2">List Akun Yang Belum
                                Diverifikasi
                            </h2>
                            <table class="table table-striped table-list-pesan" id="tableVerif">
                                {{-- <thead class="bg-light text-center"> --}}
                                <thead class="bg-light">
                                    <tr class="text-nowrap">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kode Dosen</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Mendaftar</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                    @foreach ($akuns as $akun)
                                        <tr>
                                            <th scope="row">{{ $num1++ }}</th>
                                            <td class="text-nowrap">{{ $akun->name }}</td>
                                            <td class="text-wrap">{{ $akun->kode_dosen }}</td>
                                            <td class="text-wrap">{{ $akun->level }}</td>
                                            @if ($akun->id_status == 6)
                                                <td class="fw-bold text-warning text-nowrap">
                                                    {{ $akun->Status->keterangan }}</td>
                                            @elseif ($akun->id_status == 7)
                                                <td class="fw-bold text-success text-nowrap">
                                                    {{ $akun->Status->keterangan }}</td>
                                            @else
                                                <td class="fw-bold text-danger text-nowrap">
                                                    {{ $akun->Status->keterangan }}</td>
                                            @endif
                                            <td class="text-nowrap">
                                                {{ date('d/m/y h:i:s', strtotime($akun->updated_at)) }}</td>
                                            <td>
                                                <form action="/verifakun/verifikasi/{{ $akun->kode_dosen }}" method="post"
                                                    class="d-block">
                                                    @csrf
                                                    <button class="badge verifBadge bg-success border-0 btn-verif"
                                                        onclick="return confirm('Apakah anda yakin untuk memverifikasi akun ini?')">Verifikasi</button>
                                                </form>
                                                <form action="/verifakun/tolak/{{ $akun->kode_dosen }}" method="post"
                                                    class="d-block">
                                                    @csrf
                                                    <button class="badge verifBadge bg-danger border-0 btn-verif"
                                                        onclick="return confirm('Apakah anda yakin untuk menolak akun ini?')">Tolak</button>
                                                </form>
                                                <form action="/verifakun/hapus/{{ $akun->kode_dosen }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge verifBadge bg-danger border-0 btn-verif"
                                                        onclick="return myFunction();">Hapus</button>
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
            <div class="col mt-4 col-sm-11 mx-auto">
                {{-- <div class="row-sm-9 mb-3"> --}}
                <div class="reg-room-wrapper px-3 py-2">
                    <div class="reg-room">
                        {{-- <div class="table-responsive table-process"> --}}
                        <div class="table-process">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3 pt-2">List Akun Aktif
                            </h2>
                            <table class="table table-striped table-list-pesan" id="tableAkun">
                                {{-- <thead class="bg-light text-center"> --}}
                                <thead class="bg-light">
                                    <tr class="text-nowrap">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kode Dosen</th>
                                        <th scope="col">Email</th>
                                        {{-- <th scope="col">Status</th> --}}
                                        <th scope="col">Tanggal Mendaftar</th>
                                        {{-- <th scope="col">Opsi</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $num2++ }}</th>
                                            <td class="text-nowrap">{{ $user->name }}</td>
                                            <td class="text-wrap">{{ $user->kode_dosen }}</td>
                                            <td class="text-wrap">{{ $user->email }}</td>
                                            {{-- @if ($user->id_status == 6)
                                                <td class="fw-bold text-warning text-nowrap">
                                                    {{ $user->Status->keterangan }}</td>
                                            @elseif ($user->id_status == 7)
                                                <td class="fw-bold text-success text-nowrap">
                                                    {{ $user->Status->keterangan }}</td>
                                            @else
                                                <td class="fw-bold text-danger text-nowrap">
                                                    {{ $user->Status->keterangan }}</td>
                                            @endif --}}
                                            <td class="text-nowrap">
                                                {{ date('d/m/y h:i:s', strtotime($user->updated_at)) }}</td>
                                            {{-- <td>
                                                <form action="/verifakun/verifikasi/{{ $akun->kode_dosen }}" method="post"
                                                    class="d-block">
                                                    @csrf
                                                    <button class="badge verifBadge bg-success border-0 btn-verif"
                                                        onclick="return confirm('Apakah anda yakin untuk memverifikasi akun ini?')">Verifikasi</button>
                                                </form>
                                                <form action="/verifakun/tolak/{{ $akun->kode_dosen }}" method="post"
                                                    class="d-block">
                                                    @csrf
                                                    <button class="badge verifBadge bg-danger border-0 btn-verif"
                                                        onclick="return confirm('Apakah anda yakin untuk menolak akun ini?')">Tolak</button>
                                                </form>
                                                <form action="/verifakun/hapus/{{ $akun->kode_dosen }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge verifBadge bg-danger border-0 btn-verif"
                                                        onclick="return myFunction();">Hapus</button>
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scriptsVerification')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#tableVerif').DataTable();
            $('#tableAkun').DataTable();
        });

        function myFunction() {
            if (!confirm("Are You Sure to delete this"))
                event.preventDefault();
        }
    </script>
@endpush
