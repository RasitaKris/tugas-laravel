{{-- resources/views/components/layout.blade.php --}}
@props(['pageTitle' => 'PKBM Bread of Life'])

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>{{ $pageTitle }}</title>

{{-- Bootstrap CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
{{-- Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* BASE */
:root{
    --pastel-blue:#3f6df7;
    --bg-soft:#f4f9ff;
    --text-main:#1f2d46;
    --nav-text:#475569;
    --muted:#6c757d;
    --bg-main:linear-gradient(180deg,#fbf8c5ff 0%,var(--bg-soft) 100%);
}

body{
    font-family:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,Arial;
    background:var(--bg-main);
    color:var(--text-main);
    transition:.25s;
    padding-top: 85px;
}

/* DARK MODE LOGIC */

/* 1. GLOBAL */
body.dark-mode {
    --bg-main: #0f172a;
    --text-main: #ffffff;
    --nav-text: #cbd5e1;
    color: white !important;
}

/* Teks global agar putih (di luar kotak) */
body.dark-mode h1, body.dark-mode h2, body.dark-mode h3, 
body.dark-mode h4, body.dark-mode h5, body.dark-mode h6,
body.dark-mode p, body.dark-mode span, body.dark-mode div, 
body.dark-mode label, body.dark-mode .nav-link, 
body.dark-mode small, body.dark-mode .text-muted, body.dark-mode li {
    color: white !important;
}

/* 2. PROTEKSI BACKGROUND PUTIH */
body.dark-mode .soft-card,
body.dark-mode .card,
body.dark-mode .bg-white,
body.dark-mode .bg-light,
body.dark-mode .about-card,
body.dark-mode .rules-card,
body.dark-mode .parents-card,
body.dark-mode .tutors-card,
body.dark-mode .checkout-card,
body.dark-mode .content-card {
    background-color: white !important;
    color: #1f2d46 !important; 
}

/* 2. PROTEKSI BACKGROUND PUTIH */
body.dark-mode .soft-card,
body.dark-mode .card,
body.dark-mode .bg-white,
body.dark-mode .bg-light {
    background-color: white !important;
    color: black !important;
}
/* 3. TEKS HITAM */
body.dark-mode .soft-card *,
body.dark-mode .card *,
body.dark-mode .bg-white *,
body.dark-mode .bg-light *,
body.dark-mode .about-card *,
body.dark-mode .rules-card *,
body.dark-mode .parents-card *,
body.dark-mode .tutors-card *,
body.dark-mode .checkout-card *,
body.dark-mode .content-card * {
    color: #1f2d46 !important;
}

/* 4. FORM INPUT */
body.dark-mode .form-control, 
body.dark-mode .form-select, 
body.dark-mode .input-group-text,
body.dark-mode input[type="text"],
body.dark-mode input[type="search"] {
    background-color: #ffffff !important;
    color: #000000 !important;
    border-color: #ced4da !important;
    font-weight: 500 !important;
}

/* Placeholder Input */
body.dark-mode .form-control::placeholder {
    color: #6c757d !important;
    opacity: 1;
}

/* Dropdown Option */
body.dark-mode option {
    color: #000000 !important;
    background: #ffffff !important;
}

/* 5. PENGECUALIAN TOMBOL & BADGE */
body.dark-mode .btn-primary, body.dark-mode .btn-primary *,
body.dark-mode .btn-danger, body.dark-mode .btn-danger *,
body.dark-mode .btn-success, body.dark-mode .btn-success *,
body.dark-mode .btn-dark, body.dark-mode .btn-dark *,
body.dark-mode .badge,
body.dark-mode .btn-outline-primary {
    color: white !important;
}
/* Tombol Outline */
body.dark-mode .btn-outline-primary:hover {
    background-color: var(--pastel-blue) !important;
    color: white !important;
}
body.dark-mode .btn-outline-primary {
    color: var(--pastel-blue) !important;
    border-color: var(--pastel-blue) !important;
}

/* NAVBAR */
.navbar-glass {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.6);
    transition: all 0.3s ease;
    padding: 10px 0;
}

body.dark-mode .navbar-glass {
    background: rgba(15, 23, 42, 0.9);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.navbar-brand{
    font-weight:800;
    font-size: 1.25rem;
    color:var(--pastel-blue);
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Menu Links */
.nav-main .nav-link{
    font-weight:600;
    font-size:14px;
    color:var(--nav-text);
    padding: 8px 16px;
    border-radius: 50px;
    transition: all 0.2s;
}
.nav-main .nav-link:hover {
    color: var(--pastel-blue)!important;
    background: rgba(63, 109, 247, 0.08);
}

/* User Links */
.nav-user-link {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--nav-text);
    text-decoration: none;
    padding: 6px 10px;
    border-radius: 8px;
    transition: 0.2s;
}
.nav-user-link:hover { color: var(--pastel-blue) !important; background: rgba(0,0,0,0.03); }
body.dark-mode .nav-user-link { color: #cbd5e1; }
body.dark-mode .nav-user-link:hover { color: white !important; background: rgba(255,255,255,0.1); }

/* Icons */
.icon-btn {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: var(--nav-text);
    text-decoration: none;
    font-size: 17px;
    border: none;
    background: transparent;
    transition: 0.2s;
    position: relative;
}
.icon-btn:hover { background: rgba(0,0,0,0.05); color: var(--pastel-blue); }
body.dark-mode .icon-btn { color: #cbd5e1; }
body.dark-mode .icon-btn:hover { background: rgba(255,255,255,0.15); color: white; }

/* Tombol Profil & Logout */
.btn-profile {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    background: rgba(63, 109, 247, 0.1);
    color: var(--pastel-blue);
    border-radius: 50px;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    transition: 0.2s;
    border: 1px solid transparent;
}
.btn-profile:hover { background: var(--pastel-blue); color: white; }
body.dark-mode .btn-profile { background: rgba(63, 109, 247, 0.2); color: #60a5fa; }
body.dark-mode .btn-profile:hover { background: var(--pastel-blue); color: white; }

.btn-logout {
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    color: var(--muted);
    background: transparent;
    border: 1px solid var(--muted);
    border-radius: 50px;
    transition: 0.2s;
}
.btn-logout:hover { border-color: #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.05); }
body.dark-mode .btn-logout { color: #94a3b8; border-color: #475569; }
body.dark-mode .btn-logout:hover { border-color: #ef4444; color: white; background: #ef4444; }

/* Separator & Badge */
.vr-sep { width: 1px; height: 20px; background: #cbd5e1; margin: 0 10px; }
body.dark-mode .vr-sep { background: #334155; }
.cart-badge { font-size: 9px; padding: 3px 5px; position: absolute; top: -2px; right: -2px; }

/* Footer & Card Base */
.soft-card{ background:white; color:black; border-radius:14px; box-shadow:0 8px 22px rgba(0,0,0,.15); padding:20px; }
footer.site-footer{ margin-top:60px; padding:40px 0; border-top: 1px solid rgba(0,0,0,0.05); }
body.dark-mode footer.site-footer{ border-top: 1px solid rgba(255,255,255,0.05); }

/* Dropdown */
.dropdown-menu{ border-radius:12px; border:none; box-shadow:0 10px 30px rgba(0,0,0,0.1); margin-top:10px; }
.dropdown-item:hover { background:var(--bg-soft); color:var(--pastel-blue); }
.nav-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 4px; }
</style>
</head>

<body>

<nav class="navbar navbar-expand-xl navbar-glass fixed-top">
<div class="container">
    <a class="navbar-brand me-4" href="{{ url('/') }}">
        <i class="bi bi-book-half"></i> PKBM Bread of Life
    </a>

    <button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
        <span class="bi bi-list fs-1 text-primary"></span>
    </button>

    <div class="collapse navbar-collapse" id="navCollapse">
        
        <ul class="navbar-nav me-auto nav-main align-items-xl-center mb-3 mb-xl-0">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ __('app.menu.home') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">{{ __('app.menu.about') }}</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ __('app.menu.school_rules') }}</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('school.rules') }}">{{ __('app.menu.school_rules') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('parents.guidelines') }}">{{ __('app.menu.parents') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('tutors.guidelines') }}">{{ __('app.menu.tutors') }}</a></li>
                </ul>
            </li>
        </ul>

        <div class="nav-actions justify-content-xl-end">
            
            @auth
                <div class="d-flex align-items-center gap-1 me-2">
                    <a class="nav-user-link" href="{{ route('products') }}">{{ __('app.menu.products') }}</a>
                    <a class="nav-user-link" href="{{ route('orders.index') }}">{{ __('app.menu.orders') }}</a>
                </div>

                <div class="d-flex align-items-center gap-1">
                    <a class="icon-btn" href="{{ route('wishlist.index') }}"><i class="bi bi-heart"></i></a>
                    <a class="icon-btn position-relative" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3"></i>
                        @if(!empty($cartCount) && $cartCount > 0)
                            <span class="badge bg-danger rounded-pill cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>

                <div class="vr-sep d-none d-xl-block"></div>

                <div class="d-flex align-items-center gap-2 mt-3 mt-xl-0">
                    <a href="{{ route('profile.edit') }}" class="btn-profile">
                        <i class="bi bi-person-circle"></i> Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 d-flex">
                        @csrf
                        <button class="btn-logout" title="{{ __('app.menu.logout') }}">
                           {{ __('app.menu.logout') }} <i class="bi bi-box-arrow-right ms-1"></i>
                        </button>
                    </form>
                </div>

            @else
                <div class="vr-sep d-none d-xl-block"></div>
                <a class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" href="{{ route('login') }}" style="font-size:14px;">
                    {{ __('app.menu.login') }}
                </a>
            @endauth

            <div class="d-flex align-items-center ms-2 gap-1 border-start ps-2 border-secondary-subtle">
                <button id="darkToggle" class="icon-btn"><i class="bi bi-moon-stars"></i></button>
                <div class="dropdown">
                    <button class="icon-btn" data-bs-toggle="dropdown"><i class="bi bi-globe"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('lang/id') }}">🇮🇩 ID</a></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="{{ url('lang/en') }}">🇬🇧 EN</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
</nav>

<div class="container py-4">
    {{ $slot }}
</div>

<footer class="site-footer">
    <div class="container text-center">
        <div class="fw-bold mb-1">PKBM Bread of Life Adventist Homeschooler Community</div>
        <div class="text-muted small fst-italic">"Nurture Together, Grow Together"</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggle = document.getElementById('darkToggle');
const icon = toggle.querySelector('i');
if(localStorage.getItem('darkMode') === 'on'){
    document.body.classList.add('dark-mode');
    icon.classList.remove('bi-moon-stars'); icon.classList.add('bi-sun-fill');
}
toggle.onclick = () => {
    document.body.classList.toggle('dark-mode');
    const on = document.body.classList.contains('dark-mode');
    if(on){ icon.classList.remove('bi-moon-stars'); icon.classList.add('bi-sun-fill'); } 
    else { icon.classList.remove('bi-sun-fill'); icon.classList.add('bi-moon-stars'); }
    localStorage.setItem('darkMode', on ? 'on' : 'off');
};
</script>

</body>
</html>