@extends('layouts.main')

@section('container')
<div class="row justify-content-center ">
    <div class="col-lg-5" >
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Form Registrasi</h1>
            <form action="/register" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" id="level" placeholder="Level" required value="{{ old('level') }}">
                    <label for="level">Level</label>
                    @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="kode_dosen" class="form-control @error('kode_dosen') is-invalid @enderror" id="kode_dosen" placeholder="Kode Dosen" required value="{{ old('kode_dosen') }}">
                    <label for="kode_dosen">Kode Dosen</label>
                    @error('kode_dosen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Kode Pin" required>
                    <label for="password">Kode Pin</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
            </form>
            <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login</a></small>
        </main>
    </div>
</div>
@endsection
