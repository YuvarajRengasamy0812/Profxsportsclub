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
            background: linear-gradient(180deg, #ffffff 0%, #fff6f0 100%);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 35px 80px rgba(0, 0, 0, .15);
            min-height: 420px;
             z-index: 2;
    animation: cardFloat 6s ease-in-out infinite;
     box-shadow: 0 45px 100px rgba(0,0,0,.4);
    position: relative;
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
        .up-register-header {
    position: relative;
    z-index: 1;
    margin-bottom: 30px;
}

.up-register-header h3 {
    font-size: 28px;
    font-weight: 800;
    color: #011c32;
}

.up-register-header p {
    color: #ef7e35;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.up-register-footer {
    margin-top: 25px;
}

.up-register-footer p {
    color: #011c32;
}

.up-register-footer a {
    color: #ce3a38;
    font-weight: 600;
}

.up-register-footer a:hover {
    text-decoration: underline;
}



.corp-login-wrapper {
    min-height: 100vh;
    position: relative;
    background:
        linear-gradient(rgba(1,28,50,.82), rgba(1,28,50,.82)),
        url('{{ asset("assets/frontend/images/banner/loginbg.jpg") }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
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
    cursor: default;
    transition: transform .3s;
}

.badge-travel { background: linear-gradient(135deg, #f12711, #f5af19); }
.badge-sports { background: linear-gradient(135deg, #f12711, #f5af19); }
.badge-network { background: linear-gradient(135deg, #f12711, #f5af19); }

.corp-badge:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 35px rgba(255,255,255,.25);
}


.toggle-password {
    position: absolute;
    right: 16px;
    top: 60%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #888;
}

.toggle-password:hover {
    color: #ce3a38;
}

/* Mobile: stack form labels and inputs one by one */
@media (max-width: 768px) {
    .row .col-6 {
        width: 100%;
        padding-left: 0;
        padding-right: 0;
        margin-bottom: 16px;
    }

    .card-form label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .card-form input,
    .card-form select {
        width: 100%;
    }
}
@media (max-width: 768px) {
    .toggle-password {
        right: 12px;
        font-size: 16px;
    }
}

    </style>

    <!-- HERO -->


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
<div class="corp-login-wrapper p-3 p-lg-0">
        <video class="bg-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/frontend/images/banner/registervideo.mp4') }}" type="video/mp4">
    </video>
    <!-- REGISTRATION FORM -->
    <section class="section">
       <div class="up-register-header text-center">
                <h3 class="text-white">Create Your Account</h3>
<div class="corp-badges p-1 p-lg-0">
            <div class="corp-badge badge-travel"><i class="fas fa-plane"></i> Travel</div>
            <div class="corp-badge badge-sports"><i class="fas fa-football-ball"></i> Sports</div>
            <div class="corp-badge badge-network"><i class="fas fa-handshake"></i> Network</div>
        </div>
            </div>
        <div class="join-card" data-aos="zoom-in">

            <!-- IMAGE -->
            <div class="card-image">
                <img src="{{ URL::asset('assets/frontend/images/about/becomemember.png') }}" alt="Membership">
            </div>

            <!-- FORM -->
            <div class="card-form">
                
                <form method="POST" action="{{  route('sportsRegister') }}">
                    @csrf

                    <div class="row">
                        
                        <div class="col-6 p-1 ">
                            <label>Name*</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="col-6 p-1 ">
                            <label>Email*</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="col-6 p-1 ">
                            <label>Company*</label>
                            <input type="text" name="company" required>
                        </div>

                        <div class="col-6 p-1 ">
                            <label>Designation*</label>
                            <input type="text" name="designation" required>
                            <!--<select class="form-control" name="designation" required>-->
                            <!--    <option value="">Select</option>-->
                            <!--    <option>CEO</option>-->
                            <!--    <option>HR</option>-->
                            <!--    <option>Manager</option>-->
                            <!--    <option>Digital Marketing</option>-->
                            <!--</select>-->
                        </div>

                        <div class="col-6 p-1 ">
                            <label>Phone*</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="col-6 p-1 ">
                            <label>Location*</label>
                            <select class="form-control" name="nationalities" required>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country['title_en'] }}">
                                        {{ $country['title_en'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
<div class="col-6 p-1 position-relative">
    <label>Password*</label>
    <input type="password" id="password" name="password" required>
    <span class="toggle-password" data-target="password">👁️</span>
</div>

<div class="col-6 p-1 position-relative">
    <label>Confirm Password*</label>
    <input type="password" id="real_password" name="real_password" required>
    <span class="toggle-password" data-target="real_password">👁️</span>
</div>

                         <div class="col-12 p-1 ">
                          <label>Interest *</label>
                           
                            <select class="form-control" name="interest" required>
                                <option value="">Select</option>
                                <option>Travel</option>
                                <option>Network</option>
                                <option>Sports</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>

                    <button class="submit-btn pt-3" type="submit">Submit</button>
                </form>
                <div class="up-register-footer text-center">
                <p>Already a member?
                    <a href="{{ route('customer') }}">Login here</a>
                </p>
            </div>
            </div>

        </div>
    </section>

</div>

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

        AOS.init({
    duration: 900,
    easing: 'ease-in-out',
    once: true
});


    </script>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('.toggle-password');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const targetId = toggle.dataset.target;
            const input = document.getElementById(targetId);

            if (input.type === 'password') {
                input.type = 'text';
                toggle.textContent = '🙈'; // change icon when visible
            } else {
                input.type = 'password';
                toggle.textContent = '👁️'; // change back when hidden
            }
        });
    });
});
</script>

@endsection