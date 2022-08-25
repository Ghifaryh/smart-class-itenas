@extends('layouts.main')

@section('container')
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
                        <label for="email">Nama</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="hidden" name="id_status" class="form-control" id="id_status" placeholder="Level" required
                        value="6">
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
                    <div class="form-floating">
                        <input type="password" name="password"
                            class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
                            placeholder="Kode Pin" required>
                        <label for="password">Kode Pin</label>
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
