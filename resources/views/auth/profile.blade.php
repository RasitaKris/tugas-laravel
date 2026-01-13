<x-layout :pageTitle="__('profile.title')">

    <style>
   
        .photo-container {
            position: relative;
            width: 130px;
            height: 130px;
            margin-bottom: 25px; 
        }
        
     
        .photo-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid white; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.1); 
            background-color: #f1f5f9;
        }
        
        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Agar foto tidak gepeng */
        }

      
        .photo-upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: var(--pastel-blue);
            color: white;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        }

        .photo-upload-btn:hover {
            background-color: #2b56d6;
            transform: scale(1.1);
        }
    </style>

    <div class="row g-4 justify-content-center">

        {{-- KARTU 1: FOTO & DATA DIRI --}}
        <div class="col-lg-6">
            <div class="soft-card h-100">
                
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <h4 class="fw-bold mb-0">👤 {{ __('profile.info_title') }}</h4>
                </div>

                {{-- Form Update Profil --}}
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    {{-- Bagian Upload Foto (Ditaruh di tengah tapi rapi) --}}
                    <div class="d-flex justify-content-center">
                        <div class="photo-container">
                            <div class="photo-preview">
                                @if($user->photo)
                                    {{-- Tampilkan foto dari storage --}}
                                    <img src="{{ asset('storage/' . $user->photo) }}" id="imgPreview" alt="Foto Profil">
                                @else
                                    {{-- Tampilkan inisial jika belum ada foto --}}
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=EBF4FF&color=3f6df7&bold=true&size=256" id="imgPreview" alt="Default Avatar">
                                @endif
                            </div>
                            
                            {{-- Tombol Kamera --}}
                            <label for="fileInput" class="photo-upload-btn" title="Ubah Foto">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" name="photo" id="fileInput" accept="image/*" style="display:none;" onchange="previewImage(event)">
                        </div>
                    </div>

                    {{-- Pesan Sukses --}}
                    @if (session('profile_status'))
                        <div class="alert alert-success small py-2 mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('profile_status') }}
                        </div>
                    @endif

                    {{-- Input Form --}}
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" 
                               value="{{ old('name', $user->name) }}" required placeholder="Nama Lengkap">
                        <label for="name">{{ __('auth.label_name') }}</label>
                        @error('name') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" 
                               value="{{ old('email', $user->email) }}" required placeholder="Email">
                        <label for="email">{{ __('auth.label_email') }}</label>
                        @error('email') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" name="phone" class="form-control" id="phone" 
                               value="{{ old('phone', $user->phone) }}" placeholder="Nomor Telepon">
                        <label for="phone">Nomor Telepon / WhatsApp</label>
                        @error('phone') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    {{-- Input Alamat --}}
                    <div class="form-floating mb-4">
                        <textarea name="address" class="form-control" id="address" placeholder="Alamat" style="height: 100px">{{ old('address', $user->address) }}</textarea>
                        <label for="address">{{ __('profile.label_address') }}</label>
                        @error('address') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm" style="border-radius:50px;">
                            {{ __('profile.btn_save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KARTU 2: KEAMANAN (PASSWORD) --}}
        <div class="col-lg-6">
            <div class="soft-card h-100">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <h4 class="fw-bold mb-0">🔒 {{ __('profile.pass_title') }}</h4>
                </div>

                @if (session('password_status'))
                    <div class="alert alert-success small py-2 mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('password_status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('put')

                    <div class="form-floating mb-3">
                        <input type="password" name="current_password" class="form-control" id="current_password" required placeholder="Password Lama">
                        <label for="current_password">{{ __('profile.label_current_pass') }}</label>
                        @error('current_password') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="new_password" required placeholder="Password Baru">
                        <label for="new_password">{{ __('profile.label_new_pass') }}</label>
                        @error('password') <div class="text-danger small mt-1 ms-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password_confirmation" class="form-control" id="confirm_password" required placeholder="Konfirmasi Password">
                        <label for="confirm_password">{{ __('auth.label_confirm_pass') }}</label>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark px-4 fw-bold shadow-sm" style="border-radius:50px;">
                            {{ __('profile.btn_pass') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Script JavaScript untuk Preview Gambar --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('imgPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layout>