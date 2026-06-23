@extends('frontEnd.layouts.master')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
.corp-login-wrapper {
    min-height: 100vh; position: relative; overflow: hidden;
    display: flex; align-items: center; justify-content: center;
}
.bg-video { position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0; }
.gradient-blob {
    position: absolute; width:420px; height:420px;
    background: linear-gradient(135deg, #ef7e35, #ce3a38);
    border-radius:50%; filter:blur(130px);
    animation: float 10s infinite alternate ease-in-out; z-index:1;
}
.blob-1 { top:-140px; left:-140px; }
.blob-2 { bottom:-160px; right:-140px; animation-delay:2s; }
@keyframes float { from { transform:translateY(0); } to { transform:translateY(40px); } }

.corp-login-card {
    background: linear-gradient(180deg,#ffffff 0%,#fff6f0 100%);
    border-radius:26px; padding:50px 44px; width:100%; max-width:440px;
    box-shadow:0 45px 100px rgba(0,0,0,.4); position:relative; z-index:2;
    animation: cardFloat 6s ease-in-out infinite;
}
@keyframes cardFloat { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }

.corp-title { font-size:30px; font-weight:800; color:#011c32; }
.corp-subtitle { font-size:13px; font-weight:600; letter-spacing:1px; text-transform:uppercase; color:#ef7e35; }
.corp-form-group label { font-weight:600; color:#011c32; display:block; margin-bottom:6px; }
.corp-form-group { position:relative; margin-bottom:16px; }
.corp-form-group input {
    background:#fff; height:52px; border-radius:14px;
    border:1px solid #e1e6ef; padding:12px 44px 12px 18px;
    width:100%; font-size:15px;
}
.corp-form-group input:focus { outline:none; border-color:#ef7e35; box-shadow:0 0 0 3px rgba(239,126,53,.15); }
.toggle-password { position:absolute; right:16px; top:70%; transform:translateY(-50%); cursor:pointer; font-size:18px; }
.corp-login-btn {
    width:100%; padding:15px; border-radius:50px;
    background:linear-gradient(135deg,#ce3a38,#ef7e35);
    border:none; color:#fff; font-weight:700; font-size:16px; cursor:pointer;
}
.corp-login-btn:hover { opacity:0.9; }
.corp-links { text-align:center; margin-top:20px; }
.corp-links a { color:#ce3a38; font-weight:600; text-decoration:none; }
.corp-links a:hover { text-decoration:underline; }
.alert-danger-custom {
    background:#f8d7da; color:#721c24; border-radius:12px;
    padding:12px 16px; margin-bottom:16px; font-weight:600;
}
</style>

<div class="corp-login-wrapper p-2 p-lg-0">
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/frontend/images/banner/registervideo.mp4') }}" type="video/mp4">
    </video>
    <div class="gradient-blob blob-1"></div>
    <div class="gradient-blob blob-2"></div>

    <div class="corp-login-card" data-aos="zoom-in">

        <div class="text-center mb-4">
            <h2 class="corp-title">Reset Password</h2>
            <p class="corp-subtitle">Create a new password</p>
        </div>

        @if ($errors->any())
            <div class="alert-danger-custom">
                @foreach ($errors->all() as $error)
                    <div><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="corp-form-group">
                <label>Email Address</label>
                <input type="email" name="email"
                       value="{{ old('email', request()->query('email')) }}"
                       placeholder="Your email" required>
            </div>

            <div class="corp-form-group">
                <label>New Password</label>
                <input type="password" id="new_password" name="password"
                       placeholder="Enter new password" required>
                <span class="toggle-password" onclick="togglePass('new_password', this)">👁️</span>
            </div>

            <div class="corp-form-group">
                <label>Confirm Password</label>
                <input type="password" id="confirm_password" name="password_confirmation"
                       placeholder="Confirm new password" required>
                <span class="toggle-password" onclick="togglePass('confirm_password', this)">👁️</span>
            </div>

            <button type="submit" class="corp-login-btn mt-2">
                <i class="fas fa-lock me-2"></i> Reset Password
            </button>
        </form>

        <div class="corp-links">
            <a href="{{ route('customer') }}">
                <i class="fas fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </div>
</div>

<script>
AOS.init({ duration: 900, once: true });
function togglePass(id, btn) {
    const el = document.getElementById(id);
    el.type = el.type === 'password' ? 'text' : 'password';
}
</script>

@endsection
