<x-layout :pageTitle="__('auth.login_title')">

    <style>
        .login-wrapper { min-height: 85vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 420px; border: none; animation: fadeUp 0.5s ease-out; }
        .icon-header { width: 70px; height: 70px; background: rgba(63, 109, 247, 0.1); color: var(--pastel-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 20px; }
        .btn-login-modern { background: var(--pastel-blue); border: none; padding: 12px; border-radius: 50px; font-weight: 700; font-size: 16px; transition: all 0.3s; color: white; }
        .btn-login-modern:hover { background: #2b56d6; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(63, 109, 247, 0.3); color: white; }
        .form-floating > .form-control:focus ~ label, .form-floating > .form-control:not(:placeholder-shown) ~ label { color: var(--pastel-blue); font-weight: 600; }
        .link-accent { color: var(--pastel-blue); text-decoration: none; font-weight: 600; transition: 0.2s; }
        .link-accent:hover { color: #2b56d6; text-decoration: underline; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="container login-wrapper">
        <div class="soft-card login-card p-4 p-md-5">
            
            <div class="text-center mb-4">
                <div class="icon-header">
                    <i class="bi bi-person-fill-lock"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ __('auth.login_title') }}</h3>
                <p class="text-muted small">{{ __('auth.login_subtitle') }}</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center small py-2 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email Input --}}
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                    {{-- MENGGUNAKAN LABEL KHUSUS --}}
                    <label for="floatingEmail">
                        <i class="bi bi-envelope me-1"></i> {{ __('auth.label_email') }}
                    </label>
                </div>

                {{-- Password Input --}}
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    {{-- PERBAIKAN: Menggunakan 'auth.label_password' agar tulisannya benar --}}
                    <label for="floatingPassword">
                        <i class="bi bi-key me-1"></i> {{ __('auth.label_password') }}
                    </label>
                </div>

                <div class="d-flex justify-content-end mb-4">
    <a href="{{ route('password.request') }}" class="small link-accent">
        {{ __('auth.forgot_password') }}  </a>
</div>

                <button class="btn btn-login-modern w-100">
                    {{ __('auth.login_button') }} <i class="bi bi-arrow-right ms-1"></i>
                </button>

                <div class="text-center mt-4">
    <span class="text-muted small">{{ __('auth.no_account_prompt') }}</span> <a href="{{ route('register') }}" class="link-accent ms-1">
        {{ __('auth.no_account') }} </a>
</div>
                </div>
            </form>
        </div>
    </div>

</x-layout>