<x-layout pageTitle="{{ __('passwords.reset_title') }}">

<div class="container py-4">
    <div class="soft-card mx-auto" style="max-width:420px;">
        <h3 class="mb-3">{{ __('passwords.reset_title') }}</h3>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">{{ __('passwords.email') }}</label>
                <input type="email" name="email"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('passwords.new_password') }}</label>
                <input type="password" name="password"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('passwords.confirm_password') }}</label>
                <input type="password" name="password_confirmation"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-primary-accent w-100 mt-2">
                {{ __('passwords.reset_button') }}
            </button>
        </form>
    </div>
</div>

</x-layout>
