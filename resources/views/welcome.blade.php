@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3 title">
                {{ config('app.name') }}
            </h1>
            <p class="col-lg-10 fs-4">
                Quickly design and customize Rest API with Laravel RESTful API
            </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form
                class="p-4 p-md-5 border rounded-3 bg-light"
                method="POST"
                action="{{ route('login') }}"
            >
                <div class="form-floating mb-3">
                    <input
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                    <label for="floatingInput">{{ __('Email address') }}</label>
                </div>
                <div class="form-floating mb-3">
                    <input
                        id="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="current-password"
                    >
                    <label for="floatingPassword">{{ __('Password') }}</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Rembmer me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
