@extends('layouts.main')

@php
    $num = 1;
@endphp

@section('tambah-ruangan')
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="addRuanganWrapper px-4 py-2">
                    @if ( $param == 'add' )
                    <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Penambahan Ruangan</h1>
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
                    <form action="" method="" class="formAddRuangan" id="submitRuangan">
                        @csrf
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="nama" id="nama" placeholder="Nama Ruangan"
                                class="form-control" required>
                            <label for="nama">Nama Ruangan</label>
                        </div>
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="fasilitas" id="fasilitas"
                                placeholder="Fasilitas" class="form-control" required>
                            <label for="fasilitas">Fasilitas Ruangan</label>
                        </div>
                        <div class="mb-3 me-3 px-5 text-end">
                            <button type="submit" class="btn text-white me-5  add-room-button fw-bold">Tambah
                                Ruangan</button>
                        </div>
                    </form>                  
                    @else
                    <h1 class="fw-bold pt-4 border-bottom border-2 border-dark">Edit Data Ruangan</h1>
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
                    <form action="/truangan/update/{{ $ruanganedt->id }}" method="post" class="formAddRuangan">
                        @csrf
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="nama" id="nama" placeholder="Nama Ruangan"
                                class="form-control" value="{{ $ruanganedt->nama }}" required>
                            <label for="nama">Nama Ruangan</label>
                        </div>
                        <div class="col-sm-9 form-floating mb-3">
                            <input type="text" name="fasilitas" id="fasilitas"
                                placeholder="Fasilitas" class="form-control" value="{{ $ruanganedt->fasilitas }}" required>
                            <label for="fasilitas">Fasilitas Ruangan</label>
                        </div>
                        <div class="mb-3 me-3 px-5 text-end">
                            <button type="submit" class="btn text-white me-5  add-room-button fw-bold">Update
                                Ruangan</button>
                        </div>
                    </form>            
                    @endif

                    <div class="table-responsive">
                        <h2 class="fw-bold border-bottom border-2 border-dark mb-3">List Ruangan </h2>
                        <table class="table table-striped table-list-pesen">
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
                                        <form action="/truangan/{{ $rn->id }}"method="post" class="d-block">
                                            @csrf
                                            <button class="badge bg-primary border-0"
                                                onclick="return confirm('Apakah anda yakin untuk mengubah?')">Edit</button>
                                        </form>
                                        <form action="/truangan/{{ $rn->id }}"method="post" class="d-block">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0"
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
            $("#submitRuangan").submit(function(e){
                e.preventDefault();
                var url = '{{ url('truangan') }}';
                var nama = $("#nama").val();
                var fasilitas = $("#jam_masuk").val();
                swal({
                        title: "Peringatan!",
                        text: "Apakah form tambah ruangan sudah sesuai?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                            method:'POST',
                            url:url,
                            data:{
                                    nama:nama, 
                                    fasilitas:fasilitas,
                                    },
                            success:function(response){
                                if(response.success){
                                    swal("Pemesanan berhasil!", {
                                    icon: "success",
                                    }).then(function(){
                                        location.reload();
                                        // window.location = window.location.href;
                                    })
                                    ;
                                }else{
                                    swal("Pemesanan gagal!", {
                                    icon: "error",
                                    });
                                }
                            },
                            error:function(error){
                                console.log(error)
                            }
                            });
                        }
                    });
            });
        });
    </script>
@endpush