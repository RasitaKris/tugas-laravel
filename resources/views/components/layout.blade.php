{{-- resources/views/components/layout.blade.php --}}
@props(['pageTitle' => 'PKBM Bread of Life'])

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>{{ $pageTitle }}</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --pastel-blue: #3f6df7;
      --pastel-blue-soft: #6ea9ff;
      --pastel-yellow: #ffe9a8;
      --bg-soft: #f4f9ff;
      --card-white: #ffffff;
      --muted: #56627a;
    }
    body{
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, Arial;
      background: linear-gradient(180deg, #f7fbff 0%, var(--bg-soft) 100%);
      color: #1f2d46;
    }
    .navbar-brand { font-weight:800; letter-spacing:0.2px; color:var(--pastel-blue); }
    .nav-link { color: #334a7a !important; }
    .hero {
      background: linear-gradient(135deg, var(--pastel-blue), #4b7bff);
      color: #fff;
      border-radius: 18px;
      padding: 40px;
      box-shadow: 0 14px 40px rgba(31,59,214,0.12);
    }
    .hero .title { font-size: 30px; font-weight:800; line-height:1.05; }
    .hero .lead { color: rgba(255,255,255,0.92); margin-top:8px; font-weight:500; }

    .soft-card {
      background: var(--card-white);
      border-radius: 14px;
      box-shadow: 0 8px 22px rgba(20,40,90,0.06);
      padding: 18px;
    }

    .btn-primary-accent {
      background: #1f46f0;
      border: none;
      border-radius: 12px;
      padding: .6rem .95rem;
      font-weight:700;
      color: white;
    }
    .btn-yellow {
      background: var(--pastel-yellow);
      color: #3b2b00;
      border: none; border-radius: 12px; padding: .5rem .9rem; font-weight:700;
    }

    .section-title { font-weight:700; color:#143057; }
    .muted-sm { color:#6b7a97; font-size:14px; }

    .gallery-img { width:100%; height:200px; object-fit:cover; border-radius:10px; }

    footer.site-footer {
      background: linear-gradient(90deg, rgba(63,109,247,0.06), rgba(255,233,160,0.04));
      padding: 28px 0;
      margin-top:40px;
      border-top-left-radius:18px;
      border-top-right-radius:18px;
    }
    @media (max-width: 767px) {
      .hero { padding: 22px; }
      .hero .title { font-size:22px; }
      .gallery-img { height:140px; }
    }
  </style>
</head>
<body>

  {{-- NAVBAR --}}
  <nav class="navbar navbar-expand-lg bg-transparent py-3">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">PKBM Bread of Life</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
        <span class="navbar-toggler-icon">☰</span>
      </button>

      <div class="collapse navbar-collapse" id="navCollapse">
        
        {{-- ⭐⭐⭐ NAVIGATION BAR ⭐⭐⭐ --}}
        <ul class="navbar-nav ms-auto align-items-lg-center gap-2">

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('about') }}">About</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('school.rules') }}">School Rules</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('parents.guidelines') }}">Parents</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('tutors.guidelines') }}">Tutors</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('products') }}">Payments & Products</a>
            </li>

            {{-- 🛒 CART ICON + BADGE --}}
            <li class="nav-item position-relative">
              <a class="nav-link" href="{{ route('cart.index') }}" style="font-size:20px;">
                🛒
              </a>

              @if(!empty($cartCount) && $cartCount > 0)
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle"
                      style="font-size: 10px; border-radius: 50%;">
                  {{ $cartCount }}
                </span>
              @endif
            </li>

            {{-- LOGIN / LOGOUT --}}
            @auth
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-danger btn-sm">Logout</button>
                </form>
              </li>

            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
            @endauth

            <li class="nav-item ms-2">
              <a class="btn btn-primary-accent"
                href="https://forms.gle/G6LWLY7nU5UwUpHH7"
                target="_blank"
                rel="noopener">
                New Student Registration
              </a>
            </li>

        </ul>
        {{-- END NAVBAR --}}
      </div>
    </div>
  </nav>

  {{-- Page Slot --}}
  <div class="container py-4">
    {{ $slot }}
  </div>

  {{-- Footer --}}
  <footer class="site-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="fw-bold">PKBM Bread of Life Adventist Homeschooler Community</div>
          <div class="muted-sm">Committed to community-based, holistic online learning for children and families.</div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
          <div class="muted-sm">Contact: hello@pkbm-bolhs.example</div>
          <div class="muted-sm">Jl. Salemba Raya No 47, Jakarta Pusat</div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
