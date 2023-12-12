@extends('layouts.main')

@php
    $num = 1;
@endphp

@section('tambah-ruangan')
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="addRuanganWrapper px-3 py-2 mb-3">
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
                                <input type="number" name="no_ruangan" id="no_ruangan" placeholder="Nama Ruangan"
                                    class="form-control" required>
                                <label for="no_ruangan">Nomor Ruangan</label>
                                <span class="text-danger error-text no_ruangan_error"></span>
                            </div>
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
                        <form action="/truangan/update/{{ $ruanganedt->id }}" method="post" class="formAddRuangan"
                            id="updateRuangan">
                            @csrf
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="no_ruangan" id="no_ruangan" placeholder="Nama Ruangan"
                                    class="form-control" value="{{ $ruanganedt->no_ruangan }}" required readonly>
                                <label for="no_ruangan">No Ruangan</label>
                                <span class="text-danger error-text no_ruangan_error"></span>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="nama" id="nama" placeholder="Nama Ruangan"
                                    class="form-control" value="{{ $ruanganedt->nama }}" required>
                                <label for="nama">Nama Ruangan</label>
                                <span class="text-danger error-text nama_error"></span>
                            </div>
                            <div class="col-sm-9 form-floating mb-3">
                                <input type="text" name="fasilitas" id="fasilitas" placeholder="Fasilitas"
                                    class="form-control" value="{{ $ruanganedt->fasilitas }}" required>
                                <label for="fasilitas">Fasilitas Ruangan</label>
                                <span class="text-danger error-text fasilitas_error"></span>
                            </div>
                            <div class="mb-3 me-3 px-5 text-end">
                                <a href="/truangan" class="btn text-white me-5  add-room-button fw-bold">Cancel</a>
                                <button type="submit" class="btn text-white me-5  add-room-button fw-bold">Update
                                    Ruangan</button>
                            </div>
                        </form>
                    @endif

                    @if ($param == 'add')
                        <div class="table-responsive truangan">
                            <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Ruangan </h2>
                            <table class="table table-striped table-list-pesan" id="tabelRuangan">
                                <thead class="bg-light text-center">
                                    <tr class="text-nowrap">
                                        <th scope="col">No</th>
                                        <th scope="col">Nomor Ruangan</th>
                                        <th scope="col">Nama Ruangan</th>
                                        <th scope="col">Fasilitas</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                </tbody>
                            </table>
                        </div>
                    @endif
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
            let table = $('#tabelRuangan').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    pageLength: 10,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('scr.truangan.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                        },
                        {
                            data: 'no_ruangan',
                            name: 'no_ruangan'
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                            class: "text-wrap"
                        },
                        {
                            data: 'fasilitas',
                            name: 'fasilitas',
                            class: "text-wrap"
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                })
                .columns.adjust()
                .responsive.recalc();


            function reload_table(callback, resetPage = false) {
                table.ajax.reload(callback, resetPage); //reload datatable ajax
            }

            $('#tabelRuangan').on('click', '.hapus_ruangan', function(e) {
                var id = $(this).data('id');
                let name = $(this).data('name');
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus ruangan dengan nama : ${name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('truangan/') }}/" + id,
                            type: 'POST',
                            data: {
                                _token: CSRF_TOKEN,
                                _method: "delete",
                            },
                            dataType: 'JSON',
                            success: function(response) {
                                if (response.error) {
                                    Swal.fire(
                                        'Error!',
                                        response.error,
                                        'error'
                                    )
                                } else {
                                    Swal.fire(
                                        'Berhasil',
                                        `Data ruangan dengan nama : ${name} berhasil terhapus.`,
                                        'success'
                                    )
                                }
                                reload_table(null, true)
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    type: 'error',
                                    title: 'Error saat delete data',
                                    showConfirmButton: true
                                })
                            }
                        })
                    }
                })
            })

            $('#tabelRuangan').on('click', '.edit_ruangan', function(e) {
                let id = $(this).data('id');
                let name = $(this).data('name');
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin mengedit ruangan dengan nama : ${name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Edit'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "{{ url('truangan/') }}/" + id;
                    }
                })
            })
        });

        $(document).ready(function() {
            // $('#truangan').DataTable();

            $("#submitRuangan").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah form tambah ruangan sudah sesuai?`,
                    icon: 'warning',
                    cancelButtonColor: '#d33',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: new FormData(this),
                            processData: false,
                            dataType: 'json',
                            contentType: false,
                            beforeSend: function() {
                                $(document).find('span.error-text').text('');
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data ruangan berhasil ditambahkan.',
                                        icon: 'success',
                                        button: 'Tutup'
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data ruangan gagal ditambahkan!',
                                        icon: 'error',
                                        button: 'Tutup',
                                        timer: 2000,
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

            $("#updateRuangan").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah yakin untuk memperbarui data ruangan?`,
                    icon: 'warning',
                    cancelButtonColor: '#d33',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(this).attr('action'),
                            method: $(this).attr('method'),
                            data: new FormData(this),
                            processData: false,
                            dataType: 'json',
                            contentType: false,
                            beforeSend: function() {
                                $(document).find('span.error-text').text('');
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data ruangan berhasil diperbarui.',
                                        icon: 'success',
                                        button: 'Tutup'
                                    }).then(function() {
                                        location.href =
                                            "{{ url('truangan/') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data ruangan gagal diperbarui!',
                                        icon: 'error',
                                        button: 'Tutup',
                                        timer: 2000,
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
