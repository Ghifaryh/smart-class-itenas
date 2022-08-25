@extends('layouts.main')

@php
$num = 1;
@endphp

@section('tambah-ruangan')
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="addRuanganWrapper px-3 py-2">
                    @if ($param == 'add')
                        <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Penambahan Ruangan</h1>
                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <form action="/truangan" method="post" class="formAddRuangan" id="submitRuangan">
                            @csrf
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="nama" id="nama" placeholder="Nama Ruangan"
                                    class="form-control" required>
                                <label for="nama">Nama Ruangan</label>
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="fasilitas" id="fasilitas" placeholder="Fasilitas"
                                    class="form-control" required>
                                <label for="fasilitas">Fasilitas Ruangan</label>
                                <span class="text-danger error-text fasilitas_error"></span>
                            </div>
                            <div class="mb-3 me-3 px-5 text-end">
                                <button type="submit" class="btn text-white me-5 btn-truangan fw-bold text-nowrap">Tambah
                                    Ruangan</button>
                            </div>
                        </form>
                    @else
                        <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Edit Data Ruangan</h1>
                        {{-- @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif --}}
                        <form action="/truangan/update/{{ $ruanganedt->id }}" method="post" class="formAddRuangan"
                            id="updateRuangan">
                            @csrf
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="nama" id="nama" placeholder="Nama Ruangan"
                                    class="form-control" value="{{ $ruanganedt->nama }}" required>
                                <label for="nama">Nama Ruangan</label>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="fasilitas" id="fasilitas" placeholder="Fasilitas"
                                    class="form-control" value="{{ $ruanganedt->fasilitas }}" required>
                                <label for="fasilitas">Fasilitas Ruangan</label>
                            </div>
                            <div class="mb-3 me-3 px-5 text-end">
                                <a href="/truangan" class="btn text-white me-5  add-room-button fw-bold">Cancel</a>
                                <button type="submit" class="btn text-white me-5  add-room-button fw-bold"
                                    onclick="return confirm('Apakah anda yakin untuk mengupdate ruangan?')">Update
                                    Ruangan</button>
                            </div>
                        </form>
                    @endif

                    <div class="table-responsive truangan">
                        <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Ruangan </h2>
                        <table class="table table-striped table-list-pesan" id="truangan">
                            <thead class="bg-light text-center">
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Ruangan</th>
                                    <th scope="col">Fasilitas</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                                @foreach ($ruangan as $rn)
                                    <tr>
                                        <th scope="row">{{ $num++ }}</th>
                                        <td>{{ $rn->nama }}</td>
                                        <td>{{ $rn->fasilitas }}</td>
                                        <td>
                                            <form action="/truangan/{{ $rn->id }}" method="post" class="d-block">
                                                @csrf
                                                <button class="badge truanganBadge bg-primary border-0">Edit</button>
                                            </form>
                                            <form action="/truangan/{{ $rn->id }}" method="post" class="d-block"
                                                id="hapusRuangan">
                                                @method('delete')
                                                @csrf
                                                <button class="badge truanganBadge bg-danger border-0"
                                                    onclick="return confirm('Apakah anda yakin untuk menghapus ruangan?')">Hapus</button>
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
    </div>
@endsection

@push('scriptsTruangan')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#truangan').DataTable();

            $("#submitRuangan").submit(function(e) {
                e.preventDefault();
                swal({
                        title: "Peringatan!",
                        text: "Apakah form tambah ruangan sudah sesuai?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: $(this).attr('action'),
                                method: $(this).attr('method'),
                                data: new FormData(this),
                                processData: false,
                                dataType: 'json',
                                // async: false,
                                // cache: false,
                                contentType: false,
                                // enctype: $(this).attr('enctype'),
                                beforeSend: function() {
                                    $(document).find('span.error-text').text('');
                                },
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
                                        $.each(response.error, function(prefix, val) {
                                            $('span.' + prefix + '_error').text(val[
                                                0]);
                                        });
                                    }
                                }
                            });
                        };
                    });
            });

        });
    </script>
@endpush
