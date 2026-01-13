<x-layout :pageTitle="__('tutors.title')">

    <style>
        .tutors-card {
            background: #fff; border-radius: 16px; padding: 40px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.03); border: 1px solid #f3f4f6;
        }
        .list-group-custom .list-item {
            display: flex; align-items: start; margin-bottom: 16px;
            color: #4a5568; font-size: 1.05rem; line-height: 1.6;
        }
        .list-icon {
            color: #fd7e14; font-size: 1.2rem; margin-right: 12px; margin-top: 2px;
        }
    </style>

    <div class="container py-4">
        <div class="tutors-card col-lg-10 mx-auto">
            
        // Header
            <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                <i class="bi bi-person-video3 text-warning me-3" style="font-size: 2.5rem;"></i>
                <div>
                    <h2 class="fw-bold mb-1 text-dark">{{ __('tutors.title') }}</h2>
                    <p class="text-muted mb-0">{{ __('tutors.intro') }}</p>
                </div>
            </div>

            // List Points 
            <div class="list-group-custom">
                @foreach(__('tutors.points') as $point)
                    <div class="list-item">
                        <i class="bi bi-check-circle-fill list-icon"></i>
                        <span>{{ $point }}</span>
                    </div>
                @endforeach
            </div>

            // Button Back
            <div class="mt-4 pt-3 border-top text-center">
                <a href="{{ url('/') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                    <i class="bi bi-arrow-left me-2"></i> {{ __('tutors.back') }}
                </a>
            </div>
        </div>
    </div>

</x-layout>