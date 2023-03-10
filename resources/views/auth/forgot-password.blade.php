<x-layouts.guest title="{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
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

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Email Password Reset Link') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
    </p>
</x-layouts.guest>
