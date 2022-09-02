@extends('layouts.main')

@php
$num = 1;
@endphp

@section('pengaturan-home')
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="addRuanganWrapper px-3 py-2 mb-3">
                    <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Pengaturan</h1>
                    {{-- @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}

                    <form action="/pengaturan/update/{{ $homeabout->id }}" method="post" class="formAddRuangan" id="updateAbout">
                        @csrf
                        <div class="col mb-3">
                            <label class="col-form-label" for="deskripsi"><b>About</b></label>
                            <textarea class="form-control summernote" name="deskripsi" id="deskripsi" rows="4">{{ $homeabout->deskripsi }}</textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>
                        <div class="mb-3 me-3 px-5 text-end">
                            <button type="submit" class="btn text-white me-5 btn-truangan fw-bold text-nowrap">Update</button>
                        </div>
                    </form>

                    <form action="/pengaturan/image" method="post" class="formAddRuangan" id="tambahImage">
                        @csrf
                        <div class="col mb-3">
                            <label for="image" class="form-label @error('image') is-invalid @enderror"><b>File
                                Gambar</b><span class="text-end textPeringatan"> <br>*File harus berupa image dan berukuran
                                    &#8804;
                                    5MB</span></label>
                            <input class="form-control" type="file" id="image" name="image" required>
                            <span class="text-danger error-text image_error"></span>
                        </div>
                        <input type="hidden" name="kategori" id="kategori" value="gambar">
                        <div class="mb-3 me-3 px-5 text-end">
                            <button type="submit" class="btn text-white me-5 btn-truangan fw-bold text-nowrap">Tambah
                                Gambar</button>
                        </div>
                    </form>

                    <div class="table-responsive truangan">
                        <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Foto </h2>
                        <table class="table table-striped table-list-pesan" id="tabelImage">
                            <thead class="bg-light text-center">
                                <tr class="text-nowrap">
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Judul gambar</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('stylePengaturan')
<style>
    /* Style summernote */
    .note-editor .dropdown-toggle::after{
    all: unset;
    }

    .note-editor .note-dropdown-menu {
        box-sizing: content-box;
    }

    .note-editor .note-modal-footer {
        box-sizing: content-box;
    }
</style>
@endpush

@push('scriptsPengaturan')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
            placeholder: 'Isi kolom about home',
            tabsize: 2,
            height: 120,
            width: 900,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview', 'help']]
            ]
            });
        });

        $(document).ready(function() {
            let table = $('#tabelImage').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    pageLength: 10,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('image.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                        },
                        {
                            data: 'shwImage',
                            name: 'shwImage',
                            class: "text-nowrap"
                        },
                        {
                            data: 'deskripsi',
                            name: 'deskripsi',
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

            $('#tabelImage').on('click', '.hapus_image', function(e) {
                var id = $(this).data('id');
                let name = $(this).data('name');
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Apakah Anda yakin ingin menghapus gambar dengan nama : ${name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "{{ url('pengaturan/image/') }}/" + id,
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
                                        `Gambar dengan nama : ${name} berhasil terhapus.`,
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
            $("#updateAbout").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `untuk melakukan update`,
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
                                        text: 'Data about berhasil diperbarui.',
                                        icon: 'success',
                                        button: 'Tutup',
                                        timer: 2000,
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data about gagal diperbarui!',
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

            $("#tambahImage").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Untuk menyimpan gambar`,
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
                                        text: 'Gambar berhasil ditambahkan.',
                                        icon: 'success',
                                        button: 'Tutup',
                                        timer: 2000,
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Gambar gagal ditambahkan!',
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
