@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                        {{-- {{ __('Login') }} --}}
                        Khu vực dành cho bác sĩ

                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">

                                Đã có lỗi xảy ra
                            </div>
                        @endif
                        @if (session('msg'))
                            <div class="alert alert-danger text-center">

                                {{ session('msg') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('doctor.postLogin') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    {{-- {{ __('Email Address') }} --}}
                                    Email
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    Mật Khẩu
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{-- {{ __('Remember Me') }} --}}
                                            Ghi nhớ
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{-- {{ __('Login') }} --}}
                                        Đăng Nhập
                                    </button>

                                    @if (Route::has('doctor.getForgot'))
                                        <a class="btn btn-link" href="{{ route('doctor.getForgot') }}">
                                            {{-- {{ __('Forgot Your Password?') }} --}}
                                            Quên Mật Khẩu
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
