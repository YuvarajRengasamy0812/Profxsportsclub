@extends('frontEnd.layouts.master')

@section('content')
    <style>
        /* Section Styling */
        .referral-section {
            background: #0b0e13;
        }

        /* Titles */
        .section-title {
            color: #45F882;
            font-weight: 700;
            font-size: 2rem;
        }

        .section-sub {
            color: #bbb;
            font-size: 1.1rem;
        }

        /* Intro Box */
        .intro-box {
            background: rgba(17, 20, 24, 0.9);
            border-left: 4px solid #45F882;
            padding: 20px;
            border-radius: 8px;
            color: #ddd;
        }

        /* Step Cards */
        .step-card {
            background: #1a1f25;
            border: 1px solid rgba(69, 248, 130, 0.3);
            padding: 15px 20px;
            border-radius: 8px;
            color: #ccc;
            transition: all 0.3s ease;
        }

        .step-card h6 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .step-card:hover {
            border-color: #45F882;
            box-shadow: 0 0 15px rgba(69, 248, 130, 0.4);
        }

        /* Why Join */
        .why-join {
            list-style: disc;
            padding-left: 20px;
            color: #ccc;
        }

        .why-join li {
            margin-bottom: 8px;
            transition: color 0.3s;
        }

        .why-join li:hover {
            color: #45F882;
        }

        /* Theme Text */
        .theme-text {
            color: #45F882;
            font-weight: 600;
        }

        /* Scrolling Images */
        .scrolling-images {
            height: 100%;
            /* adjust to match text height */
            overflow: hidden;
            position: relative;
            border: 2px solid rgba(69, 248, 130, 0.3);
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(69, 248, 130, 0.2);
        }

        .scroll-track {
            display: flex;
            flex-direction: column;
            animation: scroll-vertical 15s linear infinite;
        }

        .scroll-track img {
            max-width: 100%;
            max-height: 450px;
            border-bottom: 1px solid rgba(69, 248, 130, 0.2);
            padding: 10px;
            background: #111418;
        }

        @keyframes scroll-vertical {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }

            /* scrolls half, then loops */
        }
    </style>
    <div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Referral Program</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ Helper::homeURL() }}">Home</a></li>
                    <li class="active">Referral Program</li>
                </ul>
            </div>
        </div>
    </div>



    <!-- Referral Program Section -->
    <div class="referral-section position-relative py-5">
        <div class="container">
            <div class="text-center">

                <h2 class="sec-title mb-3" data-aos="fade-up">PROFXSPORTSCLUB Referral Program</h2>
                <p class="section-sub mb-4" data-aos="fade-up">Share. Earn. Grow with the League.</p>
            </div>
            <div class="d-flex flex-column justify-content-center">
                <!-- Heading -->


                <!-- Intro -->
                <div class="intro-box mb-4">
                    <p>
                        At <strong class="theme-text">PROFXSPORTSCLUB</strong>, we believe success is better when
                        shared.
                        That's why we've created a <strong>multi-level referral system</strong> that rewards you
                        every time you bring new traders into the League.
                    </p>
                </div>

                <!-- How it Works -->
                <h5 class="theme-text mb-3">How It Works</h5>
                <div class="step-card mb-3">
                    <h6>1. Get Your Referral Code</h6>
                    <p>Find your unique referral code in your dashboard after logging in.</p>
                </div>
                <div class="step-card mb-3">
                    <h6>2. Share With Friends & Traders</h6>
                    <p>Invite your network using your referral link or code.</p>
                </div>
                <div class="step-card mb-4">
                    <h6>3. Earn From Every Deposit</h6>
                    <ul>
                        <li><span class="theme-text">Level 1:</span> 10% from direct referrals</li>
                        <li><span class="theme-text">Level 2:</span> 5% from their referrals</li>
                        <li><span class="theme-text">Level 3:</span> 2.5% from extended network</li>
                    </ul>
                </div>

                <!-- Why Join -->
                <h5 class="theme-text mb-3">Why Join the Referral Program?</h5>
                <ul class="why-join mb-4">
                    <li>Unlimited earning potential � the more you share, the more you earn.</li>
                    <li>Passive income from your growing trading network.</li>
                    <li>Simple & transparent system, tracked directly in your account.</li>
                    <li>Instant access to your referral code inside your dashboard.</li>
                </ul>

                <!-- Start Earning -->
                <h5 class="theme-text mb-2">Start Earning Today!</h5>
                <p class="text-light mb-4">
                    Log in to your account, copy your referral code, and start inviting.
                    Every trader you bring not only strengthens the <strong class="theme-text">PROFXSPORTSCLUB
                        community</strong>
                    but also grows your income.
                </p>

                <!-- CTA -->
                <!--<a href="{{ url('/login') }}" class="th-btn th_btn">-->
                <!--    Login Now & Get Your Referral Code-->
                <!--</a>-->
            </div>

        </div>
    </div>
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        document.addEventListener("DOMContentLoaded", function() {
            const left = document.querySelector(".col-lg-6:first-child");
            const right = document.querySelector(".scrolling-images");
            right.style.height = left.offsetHeight + "px";
        });
    </script>
@endsection
