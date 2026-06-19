@php
use App\Helpers\Helper;
use App\Helpers\SiteMenu;
use Illuminate\Support\Facades\Auth;

$hideAuthButtons = request()->is('login') || request()->is('register');
$MenuLinks = [];

if (Helper::GeneralWebmasterSettings('header_menu_id') > 0) {
    $MenuLinks = SiteMenu::List(Helper::GeneralWebmasterSettings('header_menu_id'));
}
@endphp

<style>
/* ================= BASE ================= */

/* Mobile menu default hidden */
.mobile-menu {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

/* Show menu when active */
body.mobile-menu-visible .mobile-menu {
    opacity: 1;
    visibility: visible;
}

/* Menu box slide */
.mobile-menu .menu-box {
    position: absolute;
    left: -100%;
    top: 0;
    width: 85%;
    max-width: 320px;
    height: 100%;
    background: #111;
    padding: 15px;
    transition: left 0.3s ease;
}

/* Slide in */
body.mobile-menu-visible .mobile-menu .menu-box {
    left: 0;
}

/* Backdrop */
.menu-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
}

/* Mobile close button */
.mobile-menu .close-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    color: #fff;
    cursor: pointer;
}

/* Profile styles */
.up-flex {
    display: flex;
    align-items: center;
}

.up-mr {
    margin-right: 15px;
}

.up-profile {
    position: relative;
}

.up-profile-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.up-profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ce3a38;
}

.up-arrow {
    transition: transform 0.3s ease;
}

.up-profile-menu {
    position: absolute;
    right: 0;
    top: 120%;
    min-width: 160px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: .25s;
    z-index: 1000;
}

.up-profile.active .up-profile-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.up-profile.active .up-arrow {
    transform: rotate(180deg);
}

.up-profile-item {
    padding: 10px 15px;
    display: block;
    font-size: 14px;
    color: #333;
}

.up-profile-item:hover {
    background: #f5f5f5;
}

.up-logout {
    color: #ce3a38;
}

/* ================= SMALL MOBILE (768px) ================= */
@media (max-width: 768px) {
    /* Hide desktop menu */
    .main-menu {
        display: none !important;
    }

    /* Hamburger */
    .mobile-nav-toggler {
        display: block;
        cursor: pointer;
    }

    /* Mobile menu full width */
    .mobile-menu .menu-box {
        width: 100%;
        max-width: 100%;
        padding: 15px;
    }

    /* Menu links */
    .mobile-menu .navigation > li > a {
        font-size: 14px;
        padding: 12px 0;
        color: #fff;
        display: block;
    }

    /* Profile fix */
    .up-profile-img {
        width: 32px;
        height: 32px;
    }

    .menu-right-content .theme-btn {
        font-size: 12px;
        padding: 6px 12px;
    }

    .mobile-auth .theme-btn {
        width: 100%;
        text-align: center;
        margin-bottom: 8px;
    }
}
</style>

<!-- ================= HEADER ================= -->
<div class="header-lower">
    <div class="outer-container p_relative pr_70">
        <div class="outer-box">
            <div class="left-column">

                <!-- Logo -->
                <figure class="mr_50">
                    <a href="{{ Helper::homeURL() }}">
                        <img src="{{ URL::to('uploads/settings/' . Helper::GeneralSiteSettings('style_logo_' . Helper::currentLanguage()->code)) }}"
                             style="max-width:140px">
                    </a>
                </figure>

                <!-- Desktop Menu -->
                <div class="menu-area">
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>

                    <nav class="main-menu navbar-expand-md">
                        <ul class="navigation">
                            @foreach ($MenuLinks as $MenuLink)
                                <li class="{{ !empty($MenuLink->sub) ? 'dropdown' : '' }}">
                                    <a href="{{ $MenuLink->url }}">{{ $MenuLink->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Right -->
            <div class="menu-right-content up-flex">
                <div class="btn-box up-mr">
                    <a href="{{ url('/membership') }}" class="theme-btn btn-one">Membership</a>
                </div>

                @auth
                <div class="up-profile">
                    <div class="up-profile-toggle" id="upProfileToggle">
                        <img src="{{ asset('assets/frontend/images/user.png') }}" class="up-profile-img">
                        <svg class="up-arrow" width="12" height="12"><path d="M7 10l5 5 5-5" /></svg>
                    </div>

                    <div class="up-profile-menu">
                        <a href="{{ route('crmdashboard') }}" class="up-profile-item">{{ Auth::user()->name }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="up-profile-item up-logout">Logout</button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ url('/customer') }}" class="theme-btn btn-one">Login</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- ================= MOBILE MENU ================= -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <nav class="menu-box">
        <!-- Close Button -->
        <div class="close-btn">&times;</div>

        <div class="nav-logo mb-4">
            <img src="{{ asset('assets/frontend/images/logo-white.png') }}">
        </div>

        <ul class="navigation">
            @foreach ($MenuLinks as $MenuLink)
                <li>
                    <a href="{{ $MenuLink->url }}">{{ $MenuLink->title }}</a>
                </li>
            @endforeach
        </ul>

        <!-- Mobile Auth Buttons -->
        <div class="mobile-auth mt-4">
            <div class="btn-box mb-2">
                <a href="{{ url('/membership') }}" class="theme-btn btn-one">Membership</a>
            </div>

            @auth
            <div class="up-profile">
                <div class="up-profile-toggle" id="mobileProfileToggle">
                    <img src="{{ asset('assets/frontend/images/user.png') }}" class="up-profile-img">
                    <svg class="up-arrow" width="12" height="12"><path d="M7 10l5 5 5-5" /></svg>
                </div>

                <div class="up-profile-menu">
                    <a href="{{ route('crmdashboard') }}" class="up-profile-item">{{ Auth::user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="up-profile-item up-logout">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ url('/customer') }}" class="theme-btn btn-one">Login</a>
            @endauth
        </div>
    </nav>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const body = document.body;
    const toggler = document.querySelector(".mobile-nav-toggler");
    const backdrop = document.querySelector(".menu-backdrop");
    const closeBtn = document.querySelector(".mobile-menu .close-btn");

    toggler.onclick = () => body.classList.add("mobile-menu-visible");
    backdrop.onclick = () => body.classList.remove("mobile-menu-visible");
    closeBtn.onclick = () => body.classList.remove("mobile-menu-visible");

    // Desktop profile toggle
    const desktopToggle = document.getElementById("upProfileToggle");
    if (desktopToggle) {
        desktopToggle.onclick = e => {
            e.stopPropagation();
            desktopToggle.closest(".up-profile").classList.toggle("active");
        };
        document.onclick = () =>
            desktopToggle.closest(".up-profile").classList.remove("active");
    }

    // Mobile profile toggle
    const mobileToggle = document.getElementById("mobileProfileToggle");
    if (mobileToggle) {
        mobileToggle.onclick = e => {
            e.stopPropagation();
            mobileToggle.closest(".up-profile").classList.toggle("active");
        };
    }
});
</script>
