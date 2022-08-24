@extends('layouts.main')

@section('container')
    <section class="wrapper">
        <div class="container-fluid vh-100 d-inline-block" id="containerLogin">
            {{-- <div class="row d-flex justify-content-center align-items-center h-100"> --}}
            <div class="row">
                {{-- <div class="col-md-9 col-lg-6 col-xl-5">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid" alt="Sample image">
                    </div> --}}
                {{-- <div class="col"></div> --}}
                {{-- <div class="col-md-9 col-lg-6 col-xl-4 offset-xl-1" id="colLoginWrapper"> --}}
                {{-- <div class="col-md-9 col-xl-4 offset-xl-8" id="colLoginWrapper"> --}}
                <div class="col offset-xl-8" id="colLoginWrapper">
                    {{-- <div class="col h-100 px-6"> --}}
                    <div class="login-wrapper">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-center">
                            {{-- <p class="lead fw-normal mb-0 text-center">Sign in</p> --}}
                            <h1 class="text-center pt-5 fw-bold mb-0 text-uppercase" style="color: #ACACAC">Login
                            </h1>
                        </div>

                        <form action="/login" method="post" class="px-4 pb-5">
                            @csrf

                            <div class="divider d-flex align-items-center my-4"></div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="kode_dosen">Kode Dosen</label>
                                <input type="kode_dosen" name="kode_dosen"
                                    class="form-control form-control-lg @error('kode_dosen') is-invalid @enderror"
                                    id="kode_dosen" placeholder="Kode Dosen" autofocus required
                                    value="{{ old('kode_dosen') }}" />
                                @error('kode_dosen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password input -->
                            <div class="form-outline form-group ">
                                <label class="form-label" for="password">Kode Pin</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="password" placeholder="Kode Pin" required>
                                    <span class="input-group-text seepas" onclick="shwpass()"><i class="fa-solid fa-eye"
                                            aria-hidden="true" id="eye"></i></span>
                                </div>

                            </div>
                            <p class="small fw-bold mt-3 text-end">Don't have an account? <a href="/register"
                                    class="link-danger">Register</a></p>

                            {{-- <div class="d-flex justify-content-between align-items-center"> --}}
                            <!-- Checkbox -->
                            {{-- <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                            Remember me
                                </label>
                            </div>
                                <a href="#!" class="text-body">Forgot password?</a>
                            </div> --}}
                            <div class="text-end mt-4 pt-2 ">
                                {{-- <div class="text-center text-lg-start mt-4 pt-2 "> --}}
                                <button type="submit" class="btn btn-md btn-login fw-bold text-white text-center me-auto"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('loginJs')
    <script>
        $(document).ready(function() {
            if (window.matchMedia("(max-width: 767px)").matches) {
                $("#containerLogin").removeClass("vh-100");
                $("#containerLogin").addClass("mb-4");
                // $("#colLoginWrapper").removeClass("col-md-9 col-lg-6 col-xl-4 offset-xl-1");
                $("#colLoginWrapper").removeClass("col-md-9 col-xl-4 offset-xl-8");
                $("#colLoginWrapper").addClass("col");
                // $("#colLoginWrapper").addClass("mx-auto");

            }
        });
    </script>
@endpush
