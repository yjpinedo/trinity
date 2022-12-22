<x-layouts.guest title="{{ __('You are only one step a way from your new password, recover your password now.') }}">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="input-group mb-3">
            <input id="email"
                   type="email"
                   class="form-control {{ $errors->get('email') ? 'is-invalid' : '' }}"
                   {{ $errors->get('email') ? 'aria-invalid="true" aria-describedby="email-error"' : '' }}
                   placeholder="{{ __('Email') }}"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   required
                   autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
            <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
            <input id="password"
                   name="password"
                   type="password"
                   class="form-control {{ $errors->get('password') ? 'is-invalid' : '' }}"
                   {{ $errors->get('password') ? 'aria-invalid="true" aria-describedby="password-error"' : '' }}
                   placeholder="{{ __('Password') }}"
                   required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
            <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="input-group mb-3">
            <input id="password_confirmation"
                   name="password_confirmation"
                   type="password"
                   class="form-control {{ $errors->get('password_confirmation') ? 'is-invalid' : '' }}"
                   {{ $errors->get('password_confirmation') ? 'aria-invalid="true" aria-describedby="password_confirmation-error"' : '' }}
                   placeholder="{{ __('Confirm Password') }}"
                   required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password_confirmation')
            <span id="password_confirmation-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
    </p>
</x-layouts.guest>
