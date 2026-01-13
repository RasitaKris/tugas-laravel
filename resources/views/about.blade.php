{{-- resources/views/about.blade.php --}}
<x-layout :pageTitle="__('about.title')">

    <style>
        .about-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.03);
            border: 1px solid #f3f4f6;
            height: 100%;
        }
        .section-icon { font-size: 2rem; color: #0d6efd; margin-bottom: 15px; }
        .section-heading { font-weight: 800; color: #2d3748; margin-bottom: 15px; }
        .text-content { line-height: 1.7; color: #4a5568; font-size: 1.05rem; }
    </style>

    <div class="container py-4">
        
    // INTRO UTAMA 
        <div class="about-card mb-4">
            <i class="bi bi-building-check section-icon"></i>
            <h2 class="section-heading">{{ __('about.heading') }}</h2>
            <p class="text-content mb-0">
                {{ __('about.description') }}
            </p>
        </div>

        <div class="row g-4">
            
        // MISI
            <div class="col-lg-6">
                <div class="about-card">
                    <i class="bi bi-bullseye section-icon text-danger"></i>
                    <h4 class="section-heading">{{ __('about.mission_title') }}</h4>
                    <p class="text-content">
                        {{ __('about.mission_text') }}
                    </p>
                </div>
            </div>

            // DELIVERY MODEL 
            <div class="col-lg-6">
                <div class="about-card">
                    <i class="bi bi-laptop section-icon text-success"></i>
                    <h4 class="section-heading">{{ __('about.delivery_title') }}</h4>
                    <p class="text-content">
                        {{ __('about.delivery_text') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                <i class="bi bi-arrow-left me-2"></i> {{ __('about.back_home') }}
            </a>
        </div>
    </div>

</x-layout>