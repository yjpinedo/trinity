<x-layouts.guest>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')"/>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control {{ $errors->get('email') ? 'is-invalid' : '' }}"
                   {{ $errors->get('email') ? 'aria-invalid="true" aria-describedby="email-error"' : '' }} placeholder="{{ __('Email') }}"
                   name="email" value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input id="password" name="password" type="password"
                   class="form-control {{ $errors->get('password') ? 'is-invalid' : '' }}"
                   {{ $errors->get('password') ? 'aria-invalid="true" aria-describedby="email-error"' : '' }} placeholder="{{ __('Password') }}"
                   required autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    {{--<div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
    </div>--}}
    <!-- /.social-auth-links -->

    <p class="mb-1">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">{{ __('I forgot my password') }}</a>
        @endif
    </p>
    <p class="mb-0">
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-center">{{ __('Register a new membership') }}</a>
        @endif
    </p>
</x-layouts.guest>

