<x-layout pageTitle="{{ __('passwords.forgot_title') }}">

    <style>
        .auth-wrapper { min-height: 80vh; display: flex; align-items: center; justify-content: center; }
        .auth-card { width: 100%; max-width: 450px; border: none; animation: fadeUp 0.5s ease-out; }
        .icon-header { width: 70px; height: 70px; background: rgba(63, 109, 247, 0.1); color: var(--pastel-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 20px; }
        .btn-auth { background: var(--pastel-blue); border: none; padding: 12px; border-radius: 50px; font-weight: 700; font-size: 16px; color: white; transition: all 0.3s; }
        .btn-auth:hover { background: #2b56d6; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(63, 109, 247, 0.3); color: white; }
        .form-floating > .form-control:focus ~ label, .form-floating > .form-control:not(:placeholder-shown) ~ label { color: var(--pastel-blue); font-weight: 600; }
        .link-back { color: var(--muted); text-decoration: none; font-size: 14px; font-weight: 500; transition: 0.2s; display: inline-flex; align-items: center; gap: 5px; }
        .link-back:hover { color: var(--pastel-blue); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="container auth-wrapper">
        <div class="soft-card auth-card p-4 p-md-5">
            
            <div class="text-center mb-4">
                <div class="icon-header">
                    <i class="bi bi-envelope-exclamation-fill"></i>
                </div>
                <h3 class="fw-bold mb-2">{{ __('passwords.forgot_title') }}</h3>
                
                {{-- MENGGUNAKAN TRANSLATION UNTUK INSTRUKSI PANJANG --}}
                <p class="text-muted small mb-0">
                    {{ __('passwords.forgot_instruction') }}
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center small py-2 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ __(session('status')) }}</div>
                 </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-floating mb-4">
                    <input type="email" name="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="floatingEmail" 
                           placeholder="name@example.com" 
                           value="{{ old('email') }}" 
                           required autofocus>
                    <label for="floatingEmail">
                        <i class="bi bi-envelope me-1"></i> {{ __('passwords.email') }}
                    </label>
                    
                    @error('email')
                        <div class="invalid-feedback text-start ms-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button class="btn btn-auth w-100 mb-4">
                    {{ __('passwords.send_link') }}
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="link-back">
                        <i class="bi bi-arrow-left"></i> {{ __('passwords.back_login') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layout>