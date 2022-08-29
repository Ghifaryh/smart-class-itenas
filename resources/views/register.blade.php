@extends('layouts.main')

@section('container')
    @if (session()->has('Regis Peringatan'))
        <div class="regis-peringatan" data-flashdata="{{ session('Regis Peringatan') }}"></div>
    @endif
    <div class="row justify-content-center vh-100 ">
        {{-- <div class="col-lg-5"> --}}
        <div class="col-sm-5">
            <main class="form-registration px-3 py-2">
                <h1 class="h3 mb-3 fw-normal text-center fw-bold pt-3" style="color: orange">Form Registrasi</h1>
                <form action="/register" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="name"
                            class="form-control rounded-top @error('name') is-invalid @enderror" id="name"
                            placeholder="Name" required value="{{ old('name') }}">
                        <label for="name">Nama</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="email" name="email"
                            class="form-control rounded-top @error('email') is-invalid @enderror" id="email"
                            placeholder="name@example.com" required value="{{ old('email') }}">
                        <label for="email">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" name="id_status" class="form-control" id="id_status" placeholder="Id Status"
                        required value="6">
                    <input type="hidden" name="level" class="form-control" id="level" placeholder="Level" required
                        value="dosen">
                    {{-- <div class="form-floating">
                    <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" id="level" placeholder="Level" required value="{{ old('level') }}">
                    <label for="level">Level</label>
                    @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}
                    <div class="form-floating">
                        <input type="text" name="kode_dosen"
                            class="form-control @error('kode_dosen') is-invalid @enderror" id="kode_dosen"
                            placeholder="Kode Dosen" required value="{{ old('kode_dosen') }}">
                        <label for="kode_dosen">Kode Dosen</label>
                        @error('kode_dosen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control form-control-lg" id="password"
                            placeholder="Kode Pin" required>
                        <span class="input-group-text seepas" onclick="shwpass()"><i class="fa-solid fa-eye"
                                aria-hidden="true" id="eye"></i></span>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-lg mt-3 d-block mx-auto" style="background-color:orange; color:white "
                        type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3">Sudah Mendaftar? <a href="/login">Login</a></small>
            </main>
        </div>
    </div>
@endsection

@push('loginJs')
    <script>
        $(document).ready(function() {
            let regisPeringatan = $('.regis-peringatan').data('flashdata');
            if (regisPeringatan) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Registrasi Bermasalah',
                    text: regisPeringatan,
                    type: 'warning',
                    time: 6000
                }).then(function() {
                    location.reload();
                })
            }
        });
    </script>
@endpush
