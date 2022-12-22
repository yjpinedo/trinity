<x-layouts.guest title="{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}">

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
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
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm') }}</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</x-layouts.guest>
