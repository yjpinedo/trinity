<x-layouts.guest body="register-page" box="register-box" title="{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}">

    @if (session('status') == 'verification-link-sent')
        <div class="callout callout-info">
            <h5>{{ __('Information') }}</h5>
            <p>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
        </div>
    @endif

    <div class="mt-4 d-flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="btn btn-primary">
                    {{ __('Resend Verification Email') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn btn-outline-secondary">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-layouts.guest>
