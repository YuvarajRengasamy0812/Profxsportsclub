@extends('frontEnd.layouts.master')

@section('content')

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
/* ======================================
   LOGIN WRAPPER WITH VIDEO
====================================== */

.corp-login-wrapper {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Background Video */
.bg-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Dark Overlay */
/* .corp-login-wrapper::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(1, 28, 50, 0.82);
    z-index: 1;
} */

/* Animated Blobs */
/* .gradient-blob {
    position: absolute;
    width: 420px;
    height: 420px;
    background: linear-gradient(135deg, #ef7e35, #ce3a38);
    border-radius: 50%;
    filter: blur(130px);
    animation: float 10s infinite alternate ease-in-out;
    z-index: 1;
} */

.blob-1 { top: -140px; left: -140px; }
.blob-2 { bottom: -160px; right: -140px; animation-delay: 2s; }

@keyframes float {
    from { transform: translateY(0); }
    to { transform: translateY(40px); }
}

/* ======================================
   LOGIN CARD
====================================== */

.corp-login-card {
    background: linear-gradient(180deg, #ffffff 0%, #fff6f0 100%);
    border-radius: 26px;
    padding: 50px 44px;
    width: 100%;
    max-width: 440px;
    box-shadow: 0 45px 100px rgba(0,0,0,.4);
    position: relative;
    z-index: 2;
    animation: cardFloat 6s ease-in-out infinite;
}

@keyframes cardFloat {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* Titles */
.corp-title {
    font-size: 30px;
    font-weight: 800;
    color: #011c32;
}

.corp-subtitle {
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #ef7e35;
}

/* Badges */
.corp-badges {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin: 18px 0 28px;
}

.corp-badge {
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #f12711, #f5af19);
}

/* Form */
.corp-form-group label {
    font-weight: 600;
    color: #011c32;
}

.corp-form-group input {
    background: #fff;
    height: 52px;
    border-radius: 14px;
    border: 1px solid #e1e6ef;
    padding: 12px 44px 12px 18px;
}

/* Password Toggle */
.toggle-password {
    position: absolute;
    right: 16px;
    top: 70%;
    transform: translateY(-50%);
    cursor: pointer;
}

/* Button */
.corp-login-btn {
    width: 100%;
    padding: 15px;
    border-radius: 50px;
    background: linear-gradient(135deg, #ce3a38, #ef7e35);
    border: none;
    color: #fff;
    font-weight: 700;
}

.corp-links {
    text-align: right;
    margin-top: 8px;
}

.corp-links a {
    color: #ce3a38;
    font-weight: 600;
}

.corp-footer {
    text-align: center;
    margin-top: 20px;
}

.corp-footer a {
    color: #ce3a38;
    font-weight: 600;
}
</style>

<div class="corp-login-wrapper p-2 p-lg-0">

    <!-- VIDEO BACKGROUND -->
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/frontend/images/banner/registervideo.mp4') }}" type="video/mp4">
    </video>

    <div class="gradient-blob blob-1"></div>
    <div class="gradient-blob blob-2"></div>

    <div class="corp-login-card" data-aos="zoom-in">

        <div class="text-center mb-3">
            <h2 class="corp-title">Member Login</h2>
            <p class="corp-subtitle">Exclusive Community</p>
        </div>

        <div class="corp-badges">
            <div class="corp-badge"><i class="fas fa-plane"></i> Travel</div>
            <div class="corp-badge"><i class="fas fa-football-ball"></i> Sports</div>
            <div class="corp-badge"><i class="fas fa-handshake"></i> Network</div>
        </div>

        <form method="POST" action="{{ route('customerlogin') }}">
            @csrf

            <div class="mb-3 corp-form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter Email" required>
            </div>

            <div class="mb-2 corp-form-group position-relative">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <span class="toggle-password" onclick="togglePassword()">👁️</span>
            </div>

            <div class="corp-links">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            </div>

            <button class="corp-login-btn mt-4">
                Login to Dashboard
            </button>

            <div class="corp-footer">
                Don’t have an account?
                <a href="{{ url('/customerdashboard') }}">Register</a>
            </div>
        </form>

    </div>
</div>

<script>
AOS.init({ duration: 900, once: true });

function togglePassword() {
    const pwd = document.getElementById("password");
    pwd.type = pwd.type === "password" ? "text" : "password";
}
</script>

@endsection
