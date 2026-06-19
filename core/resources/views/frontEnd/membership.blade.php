@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <style>
        body {
            margin: 0;
            font-family: "DM Sans", sans-serif;
            background: #f5f7fa;
            color: #011C32;
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), url('{{ asset('assets/frontend/images/banner/membership.png') }}') center/cover no-repeat;
            padding: 120px 20px;
            text-align: center;
            color: white;
        }

        .iti {
            width: 100%;
        }

        .hero h1 {
            font-size: 50px;
            font-family: "Marcellus", serif;
            margin-bottom: 14px;
            color: #fff
        }

        .hero h3 {
            font-size: 22px;
            margin-bottom: 18px;
            font-weight: 400;
            color: #fff
        }

        .hero p {
            max-width: 760px;
            margin: 0 auto 28px;
            font-size: 18px;
            line-height: 1.6;
            color: #fff
        }

        .hero a {
            background: linear-gradient(90deg, #AF3336, #EF7E35);
            padding: 14px 32px;
            border-radius: 40px;
            color: white;
            font-weight: 700;
            text-decoration: none;
        }

        .section {
            max-width: 1250px;
            margin: 70px auto;
            padding: 0 20px;
        }

        .section h2 {
            font-family: "Marcellus", serif;
            font-size: 38px;
            text-align: center;
            margin-bottom: 35px;
        }

        .section {
            max-width: 1100px;
            /* ⬅️ increased width */
            margin: 80px auto;
            padding: 0 20px;
        }

        /* CARD */
        .join-card {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            /* ⬅️ image slightly smaller, form wider */
            background: #fff;
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 35px 80px rgba(0, 0, 0, .15);
            min-height: 420px;
            /* height remains reduced */
        }




        /* IMAGE */
        .card-image {
            position: relative;

        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.04);
            transition: 1s ease;
        }

        .join-card:hover .card-image img {
            transform: scale(1);
        }

        .card-image::after {
            content: '';
            position: absolute;
            inset: 0;
            /*background: linear-gradient(135deg, rgba(239, 126, 53, .45), rgba(0, 0, 0, .25));*/
        }

        /* FORM */
        .card-form {
            padding: 34px 42px;
            /* ⬅️ reduced padding */
        }

        .card-form h2 {
            font-family: "Marcellus", serif;
            font-size: 28px;
            margin-bottom: 4px;
        }

        .card-form p {
            font-size: 14px;
            color: #666;
            margin-bottom: 18px;
        }

        /* GRID */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
            /* ⬅️ tighter */
        }

        /* INPUT */
        .form-group label {
            font-size: 12.5px;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .form-group input,
        .form-group select {
            padding: 12px;
            border-radius: 12px;
            font-size: 13.5px;
            border: 1px solid #ddd;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(239, 126, 53, .15);
            outline: none;
        }

        /* BUTTON */
        .submit-btn {
            margin-top: 22px;
            padding: 12px 40px;
            font-size: 14px;
            border-radius: 46px;
           background-color:  linear-gradient(90deg, #AF3336, #EF7E35) ;
           color: #fff;
            font-weight: 700;
            border: none;
            cursor: pointer;
            box-shadow: 0 14px 40px rgba(175, 51, 54, .38);
            transition: .35s;
        }

        .submit-btn:hover {
            transform: translateY(-3px) scale(1.03);
        }

        /* CHOICES */
        .choices__inner {
            border-radius: 12px
        }

        .choices__list--multiple .choices__item {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border: none;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            .join-card {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .card-image {
                height: 220px;
                /* ⬅️ mobile height */
            }

            .card-form {
                padding: 30px;
            }
        }


        .form-control {
            width: 100%;
            padding: 18px;
            border-radius: 10px;
           
            font-size: 15px;
            background: #fff
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 126, 53, 0.08);
            border-color: #ce3a38;
          
        }


        /* Tiers */
        .tiers {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 28px;
            text-align: center;
            margin-top: 50px;
        }

        .tier-card {
            position: relative;
            background: linear-gradient(180deg, #ffffff, #fafafa);
            padding: 38px 25px 32px;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: all .35s ease;
            overflow: hidden;
        }

        .tier-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ef7e35, #ce3a38);
        }

        .tier-card:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .15);
        }

        .tier-badge {
            position: absolute;
            top: 16px;
            right: 18px;
            background: linear-gradient(90deg, #ef7e35, #f59e0b);
            color: #fff;
            font-size: 11px;
            padding: 6px 12px;
            border-radius: 30px;
            letter-spacing: .5px;
            opacity: .85;
        }

        .tier-card h3 {
            font-family: "Marcellus", serif;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .tier-card p {
            font-size: 15px;
            color: #4d5a6b;
            line-height: 1.5;
        }

        .tier-card.basic::before {
            background: linear-gradient(90deg, #bfc6cf, #8b95a3);
        }

        .tier-card.pro::before {
            background: linear-gradient(90deg, #ef7e35, #f59e0b);
        }

        .tier-card.elite::before {
            background: linear-gradient(90deg, #ce3a38, #ef7e35);
        }

        .tier-card.elite .tier-badge {
            background: linear-gradient(90deg, #ef7e35, #ce3a38);
        }

        .tier-card.basic .tier-badge {
            background: linear-gradient(90deg, #bfc6cf, #8b95a3);
        }

        /* Stats */
        .stats {
            display: flex;
            justify-content: center;
            gap: 60px;
            margin-top: 50px;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
        }

        .stat h3 {
            font-size: 32px;
            margin-bottom: 8px;
            color: #AF3336;
        }

        .stat p {
            font-size: 16px;
            margin: 0;
        }

        /* Premium bullets */
        .premium-bullets {
            max-width: 680px;
            margin: 45px auto;
            background: linear-gradient(180deg, #ffffff, #fafafa);
            padding: 35px 30px;
            border-radius: 22px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .1);
            position: relative;
            overflow: hidden;
        }

        .premium-bullets::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #ef7e35, #ce3a38);
        }

        .premium-bullets ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .premium-bullets li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 18px;
            border-radius: 14px;
            font-size: 16px;
            color: #2f3b4a;
            transition: all .3s ease;
        }

        .premium-bullets li:not(:last-child) {
            margin-bottom: 14px;
        }

        .premium-bullets li:hover {
            background: #fff5f0;
            transform: translateX(6px);
        }

        .premium-bullets .icon {
            font-size: 20px;
            line-height: 1;
            margin-top: 2px;
            color: #ef7e35;
        }

        /* Responsive */
        @media(max-width:768px) {
            .premium-bullets {
                padding: 28px 22px;
            }

            .premium-bullets li {
                font-size: 15px;
            }

            .hero h1 {
                font-size: 34px;
            }

            .hero h3 {
                font-size: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .choices__list--multiple .choices__item {
            background-color: #ce3a38;
            border: 1px solid #ce3a38;
        }

        .choices[data-type*=select-multiple] .choices__button,
        .choices[data-type*=text] .choices__button {
            border-left: 1px solid #1e0909ff;
        }
    </style>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Join Free: Forex Exclusive</h1>
            <h3>Verify & Unlock</h3>
            <p>Free for brokers and prop traders. Tiers: Basic (events), Pro (priority), Elite (VIP). Secure your data and
                start networking instantly.</p>
            <!--<a href="#membership-form">Verify</a>-->
        </div>
    </section>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- REGISTRATION FORM -->
    <section class="section">
          <h2>Join The Membership</h2>
        <div class="join-card" data-aos="zoom-in">

            <!-- IMAGE -->
            <div class="card-image">
                <img src="{{ URL::asset('assets/frontend/images/about/becomemember.png') }}" alt="Membership">
            </div>

            <!-- FORM -->
            <div class="card-form">
                <h2>Become a Member</h2>

                <form method="POST" action="{{ route('membership.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-6 p-3 ">
                            <label>Name*</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="col-6 p-3 ">
                            <label>Email*</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="col-6 p-3 ">
                            <label>Company*</label>
                            <input type="text" name="company" required>
                        </div>

                        <div class="col-6 p-3 ">
                            <label>Designation*</label>
                            <select class="form-control" name="role" required>
                                <option value="">Select</option>
                                <option>CEO</option>
                                <option>HR</option>
                                <option>Manager</option>
                                <option>Digital Marketing</option>
                            </select>
                        </div>

                        <div class="col-6 p-3 ">
                            <label>Phone*</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="col-6 p-3 ">
                            <label>Location*</label>
                            <select class="form-control" name="location" required>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country['title_en'] }}">
                                        {{ $country['title_en'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 p-3">
                            <label>Sports*</label>
                            <select id="sports" name="sports[]" multiple required>
                                <option>Cricket</option>
                                <option>Football</option>
                                <option>Basketball</option>
                                <option>Tennis</option>
                                <option>PUBG</option>
                            </select>
                        </div>
                    </div>

                    <button class="submit-btn pt-3" type="submit">Submit</button>
                </form>
            </div>

        </div>
    </section>

    <!-- TIERS TABLE -->
    <!--<section class="section">-->
    <!--    <h2>Perks</h2>-->
    <!--    <div class="tiers">-->
    <!--        <div class="tier-card basic">-->
    <!--            <span class="tier-badge">Starter</span>-->
    <!--            <h3>Basic</h3>-->
    <!--            <p>Access to Events & Community</p>-->
    <!--        </div>-->
    <!--        <div class="tier-card pro">-->
    <!--            <span class="tier-badge">Popular</span>-->
    <!--            <h3>Pro</h3>-->
    <!--            <p>Priority Bookings & Tournaments</p>-->
    <!--        </div>-->
    <!--        <div class="tier-card elite">-->
    <!--            <span class="tier-badge">Premium</span>-->
    <!--            <h3>Elite</h3>-->
    <!--            <p>Scouts, Media & Exclusive Access</p>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

    <!-- EXCLUSIVE SECTION -->
    <section class="section">
        <h2>Why Gated?</h2>
        <div class="bullets premium-bullets">
            <ul>
                <li>
                    <span class="icon">
                        <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24">
                            <path
                                d="M17,9V7c0-2.8-2.2-5-5-5S7,4.2,7,7v2c-1.7,0-3,1.3-3,3v7c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3v-7C20,10.3,18.7,9,17,9z M9,7c0-1.7,1.3-3,3-3s3,1.3,3,3v2H9V7z" />
                        </svg>
                    </span>
                    <span>Pure network for verified brokers & prop traders</span>
                </li>
                <li>
                    <span class="icon">
                        <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24">
                            <path
                                d="M17,9H9V7c0-0.8,0.3-1.5,0.9-2.1c1.2-1.2,3.1-1.2,4.2,0c0.4,0.4,0.6,0.9,0.8,1.4c0,0,0,0,0,0C15,6.8,15.6,7.1,16.1,7c0.5-0.1,0.9-0.7,0.7-1.2c-0.2-0.9-0.7-1.7-1.3-2.3C14.6,2.5,13.3,2,12,2C9.2,2,7,4.2,7,7v2c-1.7,0-3,1.3-3,3v7c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3v-7C20,10.3,18.7,9,17,9z" />
                        </svg>
                    </span>
                    <span>Early access to upcoming fintech opportunities</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- STATS SECTION -->
    <!--<section class="section">-->
    <!--    <h2>Milestones</h2>-->
    <!--    <div class="stats">-->
    <!--        <div class="stat">-->
    <!--            <h3 class="count" data-target="400" data-suffix="+">0</h3>-->
    <!--            <p>Members</p>-->
    <!--        </div>-->
    <!--        <div class="stat">-->
    <!--            <h3 class="count" data-target="90" data-suffix="%">0</h3>-->
    <!--            <p>Satisfied</p>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


    <script>
        $(document).ready(function () {

            // Fetch country from IP
            $.get("https://ipinfo.io", function (response) {

                if (!response || !response.country) return;

                const countryISO = response.country.toLowerCase(); // in, us, ae

                // =====================
                // LOCATION AUTO SELECT
                // =====================
                const $locationOption = $("#location option[data-flag='" + countryISO + "']");
                if ($locationOption.length) {
                    $("#location").val($locationOption.val());
                }

                // =====================
                // PHONE INPUT INIT
                // =====================
                const phoneInput = document.querySelector("#phone");

                const iti = window.intlTelInput(phoneInput, {
                    initialCountry: countryISO,
                    separateDialCode: true,
                });

                // Send full number to backend
                $("form").on("submit", function () {
                    phoneInput.value = iti.getNumber(); // +919876543210
                });

            }, "jsonp");

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sportsSelect = document.getElementById('sports');
            const choices = new Choices(sportsSelect, {
                removeItemButton: true, // show "x" button to remove selected item
                searchEnabled: true,    // allow search inside dropdown
                placeholder: true,
                placeholderValue: 'Select Sports',
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll(".count");
            let started = false;

            const animateCounts = () => {
                if (started) return;
                started = true;

                counters.forEach(counter => {
                    const target = +counter.dataset.target;
                    const suffix = counter.dataset.suffix || "";
                    let current = 0;
                    const increment = target / 80;

                    const update = () => {
                        current += increment;
                        if (current < target) {
                            counter.textContent = Math.ceil(current) + suffix;
                            requestAnimationFrame(update);
                        } else {
                            counter.textContent = target + suffix;
                        }
                    };
                    update();
                });
            };

            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    animateCounts();
                    observer.disconnect();
                }
            }, { threshold: 0.4 });

            observer.observe(document.querySelector(".stats"));
        });
    </script>
    <script>
        AOS.init({ once: true, duration: 850, easing: 'ease-out-cubic' });

        const iti = intlTelInput(document.querySelector("#phone"), { separateDialCode: true });
        document.querySelector("form").addEventListener("submit", () => {
            document.querySelector("#phone").value = iti.getNumber();
        });

        new Choices('#sports', { removeItemButton: true });
    </script>
@endsection