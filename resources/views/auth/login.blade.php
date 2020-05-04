@extends('layouts.authorization')

@section('content')
    <div class="auth-popup popup">
        <div class="popup_title">
            <span>Sign In</span>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="popup-content">
                @error('active') <div class="form-item error-form-item">Your account isn't activated</div> @enderror
                <div class="form-item left-label">
                    <label for="login">Log in:</label>
                    <input id="email" type="email" class="input-field form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class="form-item left-label">
                    <label for="password">Password:</label>
                    <input id="password" type="password" class="input-field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </div>
            </div>
            <div class="popup-footer">
                @if (Route::has('password.request'))
                    <a class="a-link" href="{{ route('password.request') }}">
                        {{ __('Password recovery') }}
                    </a>
                @endif
                <button type="submit" class="btn btn-blue">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div><!--/.auth-popup-->
@endsection