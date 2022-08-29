@extends('layouts.main')

@php
$num1 = 1;
$num2 = 1;
@endphp

@section('dashboard-main')
    @if (session()->has('Login Berhasil'))
        <div class="login-berhasil" data-flashdata="{{ session('Login Berhasil') }}"></div>
    @endif
    @if (session()->has('Pemesanan Sukses'))
        <div class="pemesanan-sukses" data-flashdata="{{ session('Pemesanan Sukses') }}"></div>
    @endif
    @if (session()->has('Jadwal Sukses'))
        <div class="jadwal-sukses" data-flashdata="{{ session('Jadwal Sukses') }}"></div>
    @endif

    <div class="container-fluid dashboard-dosen">
        <div class="row">
            <div class="col-sm-3" id="formPemesanan">
                <div class="reg-room-wrapper ms-5 px-4 py-2 mb-3" id="regWrapper">
                    <div class="reg-room">
                        <h3 class="fw-bold pt-2 text-nowrap">Pemesanan Ruangan</h3>
                        <h6 class="reg-room-title border-bottom border-2 border-dark mb-3">Data</h6>
                        <form action="/dashboard" method="post" class="reg-room-form" id="postPemesanan"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col mb-3">
                                <label for="tanggal_input">Tanggal Peminjaman</label>
                                <input type="text" name="tanggal_input" id="tanggal_input"
                                    class="form-control @error('tanggal_input') is-invalid @enderror" required
                                    value="{{ old('tanggal_input') }}" readonly>
                                <span class="text-danger error-text tanggal_input_error"></span>
                                {{-- @error('tanggal_input')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
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
                                <span class="text-danger error-text jam_masuk_error"></span>
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
                                <span class="text-danger error-text jam_keluar_error"></span>
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
                                <span class="text-danger error-text id_ruangan_error"></span>
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
                                <span class="text-danger error-text prodi_error"></span>
                            </div>
                            <div class="col mb-3">
                                <label for="matakuliah">Mata Kuliah</label>
                                <select name="matakuliah" id="matakuliah"
                                    class="form-select @error('matakuliah') is-invalid @enderror" data-width=100% required>
                                    {{-- <option value="" selected disabled hidden>Pilih Matakuliah</option> --}}
                                </select>
                                <span class="text-danger error-text matakuliah_error"></span>
                            </div>
                            <div class="col mb-3">
                                <label for="fileRPS" class="form-label @error('fileRPS') is-invalid @enderror">Input
                                    RPS <span class="text-end textPeringatan"> <br>*File harus pdf dan berukuran
                                        &#8804;
                                        5MB</span></label>
                                <input class="form-control" type="file" id="fileRPS" name="fileRPS">
                                <span class="text-danger error-text fileRPS_error"></span>
                            </div>
                            <div class="col mb-3">
                                <label for="fileSertif" class="form-label @error('fileSertif') is-invalid @enderror">Input
                                    Sertifikat<span class="text-end textPeringatan"> <br>*File harus pdf dan berukuran
                                        &#8804;
                                        5MB</span></label>
                                <input class="form-control" type="file" id="fileSertif" name="fileSertif">
                                <span class="text-danger error-text fileSertif_error"></span>
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
                                @if (auth()->user()->level == 'admin')
                                    <table class="table table-striped table-list-pesan" id="tabelPemesananAdmin">
                                    @else
                                        <table class="table table-striped table-list-pesan" id="tabelPemesananDosen">
                                @endif
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
                                        <th scope="col">Pemesan</th>
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

        $(document).ready(function() {
            let LoginBerhasil = $('.login-berhasil').data('flashdata');
            let PemesananSukses = $('.pemesanan-sukses').data('flashdata');
            let JadwalSukses = $('.jadwal-sukses').data('flashdata');
            if (LoginBerhasil) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: LoginBerhasil,
                    type: 'success',
                    timer: 3000,
                }).then(function() {
                    location.reload();
                });
            }
            if (PemesananSukses) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: PemesananSukses,
                    type: 'success',
                    timer: 6000,
                }).then(function() {
                    location.reload();
                });
            }
            if (JadwalSuksess) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: JadwalSukses,
                    type: 'success',
                    timer: 6000,
                }).then(function() {
                    location.reload();
                });
            }
        });

        $(document).ready(function() {
            let table = $('#tabelPemesananDosen').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pemesanan-dosen.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                        },
                        {
                            data: 'id_ruangan',
                            name: 'id_ruangan'
                        },
                        {
                            data: 'waktu_pakai',
                            name: 'waktu_pakai',
                            class: "text-nowrap"
                        },
                        {
                            data: 'prodi',
                            name: 'prodi',
                            class: "text-nowrap"
                        },
                        {
                            data: 'matakuliah',
                            name: 'matakuliah',
                            class: "text-wrap"
                        },
                        {
                            data: 'kelas',
                            name: 'kelas',
                            class: "text-wrap"
                        },
                        {
                            data: 'dosen_matkul',
                            name: 'dosen_matkul',
                            class: "text-wrap"
                        },
                        {
                            data: 'pemesan',
                            name: 'pemesan',
                            class: "text-wrap"
                        },
                        {
                            data: 'fileRPS',
                            name: 'fileRPS',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'fileSertif',
                            name: 'fileSertif',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            name: 'status',
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
        });

        $(document).ready(function() {
            let table = $('#tabelPemesananAdmin').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    pageLength: 25,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('pemesanan-admin.list') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                        },
                        {
                            data: 'id_ruangan',
                            name: 'id_ruangan'
                        },
                        {
                            data: 'waktu_pakai',
                            name: 'waktu_pakai',
                            class: "text-nowrap"
                        },
                        {
                            data: 'prodi',
                            name: 'prodi',
                            class: "text-nowrap"
                        },
                        {
                            data: 'matakuliah',
                            name: 'matakuliah',
                            class: "text-wrap"
                        },
                        {
                            data: 'kelas',
                            name: 'kelas',
                            class: "text-wrap"
                        },
                        {
                            data: 'dosen_matkul',
                            name: 'dosen_matkul',
                            class: "text-wrap"
                        },
                        {
                            data: 'pemesan',
                            name: 'pemesan',
                            class: "text-wrap"
                        },
                        {
                            data: 'fileRPS',
                            name: 'fileRPS',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'fileSertif',
                            name: 'fileSertif',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            name: 'status',
                            class: "text-wrap"
                        },
                        {
                            data: 'waktu_pesan',
                            name: 'waktu_pesan',
                            class: "text-nowrap"
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
        });


        $(document).ready(function() {
            $("#matakuliah").prop('disabled', true);

            // $('#btnFileRPS').click(function () {
            //     $('#iframeModal').attr('src', null);
            //     var fileRPS = $(this).val();
            //     var $iframe = $('#iframeModal').attr('src', fileRPS);
            // })

            // $('#btnFileSertif').click(function () {
            //     $('#iframeModal').attr('src', null);
            //     var fileSertif = $(this).val();
            //     var $iframe = $('#iframeModal').attr('src', fileSertif);
            // })

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
                // console.log(tahunPesan);

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
                // console.log(kelas);
                $.ajax({
                    type: 'GET',
                    url: '/dosen-matkul/' + fixSemester + '/' + prodi + '/' + kode_matkul + '/' +
                        kelas,
                    success: function(response) {
                        var response = JSON.parse(response);
                        // console.log(response);
                        $('#dosen_matkul').val(`${response["data1"]}`);
                        $('#kelas').val(`${response["data2"]}`);
                        // console.log($('#dosen_matkul').val());
                    }
                });
            });
            // $("#submitPesan").submit(function(e){
            $("#postPemesanan").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `Jika sudah sesuai maka akan segera diproses oleh admin.`,
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
                            // async: false,
                            // cache: false,
                            contentType: false,
                            enctype: $(this).attr('enctype'),
                            beforeSend: function() {
                                $(document).find('span.error-text').text('');
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: 'Data pemesanan berhasil disimpan.',
                                        icon: 'succes',
                                        button: 'Tutup'
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: 'Data pemesanan gagal disimpan!',
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
                    // Swal.fire({
                    //     title: 'Error!',
                    //     text: 'Do you want to continue',
                    //     icon: 'error',
                    //     confirmButtonText: 'Cool'
                    // })
                    $('#jam_keluar').append(
                        `<option value="" selected disabled hidden>Pilih Jam Keluar</option>`
                    );
                }
            });
        });

        $(document).ready(function() {
            $('#table1').DataTable({
                dom: 'Bfrtip',
                // button: [{
                //         extend: 'pdf',
                //         oriented: 'potrait',
                //         // title: 'Data Pasien',
                //         download: 'open'
                //     },
                //     'excel', 'print'
                // ]
                buttons: [
                    'pdf', 'copy'
                ]
            });
            // $('#table1').css("text-align", "center");
            // $('#table1').css("color", "orange");
            // $('#table2').DataTable({
            //     dom: 'Brftip',
            //     buttons: [
            //         'pdf', 'copy'
            //     ]
            // });

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
