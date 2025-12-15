{{-- resources/views/welcome.blade.php --}}
<x-layout :pageTitle="'PKBM Bread of Life - Home'">

  {{-- HERO --}}
  <div class="hero row align-items-center gx-4">
    <div class="col-md-7 text-white">
      <div class="title">PKBM Bread of Life Adventist Homeschooler Community</div>
      <div class="lead">
        Empowering community-based education through online learning, personalized tutoring, and character development.
      </div>

      <p class="mt-3" style="max-width:520px;">
        PKBM Bread of Life provides accessible, faith-based non-formal education for children who learn best in a caring community environment.
        Our programs include Paket A (equivalent to elementary), Paket B (equivalent to junior high), and Paket C (equivalent to senior high), delivered via online classes, guided practice, and community activities.
      </p>

      <div class="mt-3 d-flex gap-2">
        <a class="btn btn-primary-accent" href="https://forms.gle/G6LWLY7nU5UwUpHH7" target="_blank" rel="noopener">
          New Student Registration
        </a>
        <a class="btn btn-yellow" href="{{ url('/about') }}">
          Learn More About PKBM
        </a>
      </div>
    </div>

    <div class="col-md-5 text-end">
      <img src="{{ asset('images/hero/online-teaching.jpg') }}"
           alt="Online teaching"
           class="img-fluid rounded-3 shadow"
           style="max-height:320px; object-fit:cover;">
    </div>
  </div>

  {{-- ABOUT + QUICK CARDS --}}
  <div class="row mt-4 g-3">
    <div class="col-md-8">
      <div class="soft-card">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="section-title">About PKBM Bread of Life</div>
            <div class="muted-sm mt-1">
              PKBM Bread of Life was established to provide community-centered education that supports the government's nine-year compulsory education through alternative learning.
              We serve families seeking a character-driven, faith-based education with flexible online delivery.
            </div>
          </div>
          <div class="text-end">
            <a href="{{ url('/about') }}" class="btn btn-outline-primary">Read More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="soft-card">
        <div class="fw-bold">Quick Links</div>
        <ul class="list-unstyled mt-2 mb-0">
          <li class="my-2"><a href="{{ url('/school-rules') }}">School Rules</a></li>
          <li class="my-2"><a href="{{ url('/parents-guidelines') }}">Parents' Guidelines</a></li>
          <li class="my-2"><a href="{{ url('/tutors-guidelines') }}">Tutor Guidelines</a></li>
          <li class="my-2"><a href="{{ route('products') }}">Payments & Product Management</a></li>
        </ul>
      </div>
    </div>
  </div>

  {{-- RULES / GUIDELINES SUMMARY --}}
  <div class="row mt-4 g-3">
    <div class="col-md-4">
      <div class="soft-card text-center">
        <div class="fw-bold">School Rules</div>
        <div class="muted-sm mt-2">Attend on time, open camera, dress appropriately, and respect others.</div>
        <div class="mt-3">
          <a class="btn btn-sm btn-primary-accent" href="{{ url('/school-rules') }}">Read Rules</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="soft-card text-center">
        <div class="fw-bold">Parents' Guidelines</div>
        <div class="muted-sm mt-2">Support learning at home, attend activities, submit assignments on time.</div>
        <div class="mt-3">
          <a class="btn btn-sm btn-primary-accent" href="{{ url('/parents-guidelines') }}">Read More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="soft-card text-center">
        <div class="fw-bold">Tutors' Guidelines</div>
        <div class="muted-sm mt-2">Prepare lessons, start on time, create a Christ-centered learning environment.</div>
        <div class="mt-3">
          <a class="btn btn-sm btn-primary-accent" href="{{ url('/tutors-guidelines') }}">Read More</a>
        </div>
      </div>
    </div>
  </div>

  {{-- ✅ GALLERY (CLICK TO ZOOM) --}}
  <div class="mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div class="section-title">Gallery — Recent Activities</div>
      <div class="muted-sm">Snapshots from our activities</div>
    </div>

    <div class="row g-3">

      @php
        $gallery = [
          ['img' => 'images/gallery/cooking.jpg', 'title' => 'Cooking Class', 'desc' => 'Hands-on practical activity'],
          ['img' => 'images/gallery/students-worship.jpg', 'title' => 'Student Worship', 'desc' => 'Weekly online worship'],
          ['img' => 'images/gallery/group-activities.jpg', 'title' => 'Group Activities', 'desc' => 'Community events'],
        ];
      @endphp

      @foreach($gallery as $g)
      <div class="col-md-4">
        <div class="soft-card">
          <img src="{{ asset($g['img']) }}"
               alt="{{ $g['title'] }}"
               class="w-100 rounded shadow-sm gallery-img"
               style="height:200px; object-fit:cover; cursor:pointer;"
               data-bs-toggle="modal"
               data-bs-target="#imageModal"
               onclick="showImage('{{ asset($g['img']) }}')">

          <div class="mt-2 fw-bold">{{ $g['title'] }}</div>
          <div class="muted-sm">{{ $g['desc'] }}</div>
        </div>
      </div>
      @endforeach

    </div>
  </div>

  {{-- ✅ IMAGE PREVIEW MODAL --}}
  <div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body p-0 text-center">
          <img id="previewImage" src="" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </div>

  {{-- ✅ SCRIPT --}}
  <script>
    function showImage(src) {
      document.getElementById('previewImage').src = src;
    }
  </script>

</x-layout>
