
@extends('layouts.authorization')

@section('content')
    <div class="auth-popup recovery-popup popup">
        <div class="popup_title">
            <span>Password recovery</span>
        </div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="popup-content">
                <div class="text">
                    <p>Fusce dapibus, tellus ac cursus commodo, tortor mauris  condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                </div>
{{--                @error('email')--}}
{{--                <span class="invalid-feedback" role="alert">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </span>--}}
{{--                @enderror--}}
                <div class="form-item left-label">
                    <label for="username">Username:</label>
                    <input type="text" class="input-field" name="email" id="username" value="{{ $email ?? old('email') }}" placeholder="Your username / email address…">
                </div>
                <div class="form-item left-label">
                    <label for="username">{{ __('Password') }}:</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
                <div class="form-item left-label">
                    <label for="username">{{ __('Confirm Password') }}:</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="popup-footer">
                <a href="/" class="btn btn-bordered btn-cancel">Cancel</a>
                <button name="submit" type="submit" class="btn btn-blue">Update password</button>
            </div>
        </form>
    </div><!--/.auth-popup-->
@endsection
