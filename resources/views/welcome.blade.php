<x-layout :pageTitle="__('home.title')">

{{-- HERO SECTION --}}
<div class="row align-items-center mb-5 gx-5">
    <div class="col-lg-7 mb-4 mb-lg-0">
        <div style="background: linear-gradient(135deg, #1e3c72 0%, #2a6fdb 100%); border-radius: 24px; padding: 40px; box-shadow: 0 10px 30px rgba(30, 60, 114, 0.3); color: white; position: relative; overflow: hidden;">
            {{-- Dekorasi Latar Belakang --}}
            <div style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            
            <h1 class="fw-bold mb-3 display-5" style="letter-spacing: -1px;">
                {{ __('home.title') }}
            </h1>
            <p class="lead mb-4" style="opacity: 0.9; font-weight: 300;">
                {{ __('home.lead') }}
            </p>
            <p class="mb-4 small text-white-50">
                {{ __('home.about') }}
            </p>

            <div class="d-flex gap-3">
                <a class="btn btn-light text-primary fw-bold px-4 py-2 shadow-sm" href="{{ url('/about') }}" style="border-radius: 50px;">
                    {{ __('home.learn_more') }}
                </a>
                <a class="btn btn-outline-light fw-bold px-4 py-2" href="https://forms.gle/G6LWLY7nU5UwUpHH7" target="_blank" style="border-radius: 50px;">
                    {{ __('home.register') }}
                </a>
            </div>
        </div>
    </div>

    {{-- HERO IMAGE --}}
    <div class="col-lg-5">
        <div class="position-relative">
            <div style="position: absolute; inset: 0; background: var(--pastel-blue); transform: rotate(3deg); border-radius: 24px; z-index: -1; opacity: 0.2;"></div>
            <img src="{{ asset('images/hero/online-teaching.jpg') }}" 
                 alt="Online teaching" 
                 class="img-fluid rounded-4 shadow-lg w-100"
                 style="object-fit: cover; height: 320px;">
        </div>
    </div>
</div>

{{-- GALLERY SECTION --}}
<div class="py-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--text-main);">{{ __('home.gallery_title') }}</h3>
            <p class="text-muted mb-0 small">{{ __('home.gallery_sub') }}</p>
        </div>
        <div style="height: 4px; width: 60px; background: var(--pastel-blue); border-radius: 2px;"></div>
    </div>

    <div class="row g-4">
        @php
          $gallery = [
            ['img' => 'images/gallery/cooking.jpg', 'title' => __('home.gallery.cooking'), 'desc' => __('home.gallery.cooking_desc')],
            ['img' => 'images/gallery/students-worship.jpg', 'title' => __('home.gallery.worship'), 'desc' => __('home.gallery.worship_desc')],
            ['img' => 'images/gallery/group-activities.jpg', 'title' => __('home.gallery.group'), 'desc' => __('home.gallery.group_desc')],
          ];
        @endphp
    
        @foreach($gallery as $g)
        <div class="col-md-4">
            <div class="bg-white p-3 h-100 shadow-sm" style="border-radius: 16px; transition: transform 0.2s; border: 1px solid rgba(0,0,0,0.03);">
                <div style="overflow: hidden; border-radius: 12px; height: 200px; margin-bottom: 15px;">
                    <img src="{{ asset($g['img']) }}" 
                         alt="{{ $g['title'] }}" 
                         class="w-100 h-100" 
                         style="object-fit: cover; cursor: pointer; transition: 0.5s;"
                         onmouseover="this.style.transform='scale(1.1)'"
                         onmouseout="this.style.transform='scale(1)'"
                         data-bs-toggle="modal" 
                         data-bs-target="#imageModal"
                         onclick="showImage('{{ asset($g['img']) }}')">
                </div>
                <h5 class="fw-bold mb-1" style="font-size: 16px;">{{ $g['title'] }}</h5>
                <p class="text-muted small mb-0">{{ $g['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="imageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0 shadow-none">
      <div class="modal-body p-0 text-center">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
        <img id="previewImage" src="" class="img-fluid rounded-3 shadow-lg">
      </div>
    </div>
  </div>
</div>

<script>
  function showImage(src) {
    document.getElementById('previewImage').src = src;
  }
</script>

</x-layout>