<x-layout :pageTitle="__('auth.register_title')">

    <style>
        .auth-wrapper {
            min-height: 85vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .auth-card {
            width: 100%;
            max-width: 500px; 
            border: none;
            animation: fadeUp 0.5s ease-out;
        }

        .icon-header {
            width: 70px;
            height: 70px;
            background: rgba(63, 109, 247, 0.1);
            color: var(--pastel-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 20px;
        }

        .btn-register-modern {
            background: var(--pastel-blue);
            border: none;
            padding: 12px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s;
            color: white;
        }

        .btn-register-modern:hover {
            background: #2b56d6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(63, 109, 247, 0.3);
            color: white;
        }

        /* Floating Label Styles */
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--pastel-blue);
            font-weight: 600;
        }

        .link-accent {
            color: var(--pastel-blue);
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }
        .link-accent:hover {
            color: #2b56d6;
            text-decoration: underline;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="container auth-wrapper">
        <div class="soft-card auth-card p-4 p-md-5">
            
            {{-- Header --}}
            <div class="text-center mb-4">
                <div class="icon-header">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ __('auth.register_title') }}</h3>
                <p class="text-muted small">{{ __('auth.register_subtitle') }}</p>
            </div>

            {{-- Form Register --}}
            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="form-floating mb-3">
                    <input type="text" name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="floatingName" 
                           placeholder="John Doe" 
                           value="{{ old('name') }}" required autofocus>
                    <label for="floatingName">
                        <i class="bi bi-person me-1"></i> {{ __('auth.label_name') }}
                    </label>
                    @error('name')
                        <div class="invalid-feedback ms-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-floating mb-3">
                    <input type="email" name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="floatingEmail" 
                           placeholder="name@example.com" 
                           value="{{ old('email') }}" required>
                    <label for="floatingEmail">
                        <i class="bi bi-envelope me-1"></i> {{ __('auth.label_email') }}
                    </label>
                    @error('email')
                        <div class="invalid-feedback ms-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-floating mb-3">
                    <input type="password" name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="floatingPassword" 
                           placeholder="Password" required>
                    {{-- PERBAIKAN DI SINI: Menggunakan 'auth.label_password' --}}
                    <label for="floatingPassword">
                        <i class="bi bi-lock me-1"></i> {{ __('auth.label_password') }}
                    </label>
                    @error('password')
                        <div class="invalid-feedback ms-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-floating mb-4">
                    <input type="password" name="password_confirmation" 
                           class="form-control" 
                           id="floatingConfirm" 
                           placeholder="Confirm Password" required>
                    <label for="floatingConfirm">
                        <i class="bi bi-lock-fill me-1"></i> {{ __('auth.label_confirm_pass') }}
                    </label>
                </div>

                {{-- Tombol Daftar --}}
                <button type="submit" class="btn btn-register-modern w-100">
                    {{ __('auth.register_button') }}
                </button>

                {{-- Link Login --}}
                <div class="text-center mt-4">
                    <span class="text-muted small">{{ __('auth.have_account') }}</span>
                    <a href="{{ route('login') }}" class="link-accent ms-1">
                        {{ __('auth.login_here') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layout>