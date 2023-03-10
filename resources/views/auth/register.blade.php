<x-layouts.guest body="register-page" box="register-box" title="{{ __('Register a new membership') }}">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group mb-3">
            <input id="name"
                   type="text"
                   name="name"
                   class="form-control {{ $errors->get('name') ? 'is-invalid' : '' }}"
                   {{ $errors->get('name') ? 'aria-invalid="true" aria-describedby="name-error"' : '' }}
                   placeholder="{{ __('Name') }}" value="{{ old('name') }}"
                   required
                   autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('name')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="input-group mb-3">
            <input id="email"
                   type="email"
                   class="form-control {{ $errors->get('email') ? 'is-invalid' : '' }}"
                   {{ $errors->get('email') ? 'aria-invalid="true" aria-describedby="email-error"' : '' }}
                   placeholder="{{ __('Email') }}"
                   name="email"
                   value="{{ old('email') }}"
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
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                        {{ __('I agree to the') }} <a href="#">{{ __('terms') }}</a>
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-sm">{{ __('Register') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <a href="{{ route('login') }}" class="text-center">{{ __('I already have a membership') }}</a>
</x-layouts.guest>
