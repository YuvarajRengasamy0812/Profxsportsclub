@extends('frontEnd.layouts.master')

@section('title', __('Verify Your Email Address'))

@section('content')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<style>
/* ======================================
   WRAPPER WITH VIDEO BACKGROUND
====================================== */
.verify-wrapper {
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 15px;
}

/* Background Video */
.bg-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Dark Overlay */
.verify-wrapper::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: 1;
}

/* ======================================
   VERIFY CARD
====================================== */
.verify-card {
    background: #ffffff;
    max-width: 520px;
    width: 100%;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
    text-align: center;
    position: relative;
    z-index: 2;
    transition: all 0.4s ease;
}

.verify-card:hover {
    transform: translateY(-8px) scale(1.01);
    box-shadow: 0 35px 80px rgba(0,0,0,0.35);
}

.verify-banner {
    background: url('{{ asset("assets/frontend/img/bg_auth.png") }}') center/cover no-repeat;
    padding: 50px 20px;
    color: #fff;
}

.verify-banner h2 {
    font-size: 28px;
    font-weight: 700;
}

.verify-banner p {
    font-size: 15px;
    opacity: 0.9;
}

.verify-content {
    padding: 35px 30px 40px;
}

.verify-content p {
    font-size: 15px;
    color: #444;
    line-height: 1.6;
    margin-bottom: 15px;
}

.verify-alert {
    background: #e8fff1;
    color: #15803d;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 20px;
}

.verify-link {
    display: inline-block;
    margin-top: 10px;
    color: #ce3a38;
    font-weight: 600;
}

.verify-link:hover {
    text-decoration: underline;
}

@media (max-width: 480px) {
    .verify-banner h2 {
        font-size: 24px;
    }
}
</style>

<div class="verify-wrapper">

    <!-- BACKGROUND VIDEO -->
    <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/frontend/images/banner/registervideo.mp4') }}" type="video/mp4">
    </video>

    <!-- CARD -->
    <div class="verify-card"
         data-aos="zoom-in"
         data-aos-duration="900"
         data-aos-easing="ease-out-cubic">

        <!-- BANNER -->
        <div class="verify-banner" data-aos="fade-down" data-aos-delay="200">
            <h2>Email Verification Required</h2>
            <p>Secure your Profx SportsClub account</p>
        </div>

        <!-- CONTENT -->
        <div class="verify-content">

            <!-- ICON -->
            <div class="flex justify-center mb-6"
                 data-aos="zoom-in"
                 data-aos-delay="350">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-20 w-20 text-orange-500 animate-pulse"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
            </div>

            @if (session('resent'))
                <div class="verify-alert" data-aos="fade-up">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p data-aos="fade-up" data-aos-delay="200">
                {{ __('Before proceeding, please check your email inbox and click on the verification link we sent you.') }}
            </p>

            <!--<p data-aos="fade-up" data-aos-delay="300">-->
            <!--    {{ __('Didn’t receive the email?') }}-->
            <!--</p>-->

            <a href="{{ route('verification.resend') }}"
               class="verify-link"
               data-aos="fade-up"
               data-aos-delay="400">
                {{ __('Click here to resend verification email') }}
            </a>

        </div>
    </div>
</div>

<script>
    AOS.init({
        once: true
    });
</script>

@endsection
