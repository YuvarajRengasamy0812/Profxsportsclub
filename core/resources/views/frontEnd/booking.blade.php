@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .hero-wrap {
            position: relative;
            margin: 32px auto;
            border-radius: 10px;
            overflow: hidden;
            padding: 0;
        }

        .hero-bg {
            background-image: linear-gradient(120deg, rgba(51, 48, 48, 0.15), rgba(45, 27, 27, 0.15)), url('{{ asset('assets/frontend/images/players/events/past events.png') }}');
            background-size: cover;
            background-position: inherit;
            min-height: 550px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-glass {
            padding: 28px;
            border-radius: 10px;
            color: #fff;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 28px;
            align-items: center;
        }

        .hero-left h1 {
            font-size: 40px;
            margin: 0 0 12px;
            font-family: "Marcellus", serif;
        }

        .hero-left h3 {
            font-size: 18px;
            margin-bottom: 12px;
            color: #fff
        }

        .hero-left p {
            font-size: 16px;
            line-height: 1.6;
            color: #fff;
        }

        .hero-ctas {
            display: flex;
            gap: 12px;
            margin-top: 14px;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            padding: 10px 18px;
            border-radius: 999px;
            cursor: pointer;
            border: none;
            transition: 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ef7e35, #ef3b3b);
            color: #fff;
        }

        .btn-secondar {
            background: #011C32;
            border: 0px solid #fff;
            color: #fff;
        }

        .booking-wrapper {
            padding: 60px 0;
        }

        .booking-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .booking-image {
            background: url('{{ asset('assets/frontend/images/resource/faq-1.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100%;
        }

        .booking-form {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #EF7E35;
        }

        /* Tabs */
        .tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }

        .tab {
            padding: 8px 16px;
            background: #EF7E35;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .tab.active {
            background: linear-gradient(90deg, #AF3336 0%, #EF7E35 100%);
        }
    </style>
    <section class="container-fluid hero-wrap" data-aos="fade-up">
        <div class="hero-bg">
            <div class="hero-glass">
                <div class="hero-left">
                    <h1>Book Your Sports Club Visit</h1>
                    <h3>Choose Your Game. Pick Your Passion.</h3>
                    <p>
                        Register your visit to Profx Sports Club and experience world-class physical, e-sports,
                        and indoor facilities. Select your preferred sport, choose a game, and our team will
                        get in touch to confirm your booking.
                    </p>
                    <div class="hero-ctas">
                        <a href="#visitForm" class="btn btn-primary">Book Now</a>
                        <a href="{{ url('/upcomeingEvent') }}" class="btn btn-secondar">View Events</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section>
        <div class="container booking-wrapper">
            <div class="row booking-box">

                <!-- LEFT IMAGE -->
                <div class="col-md-6 d-none d-md-block p-0">
                    <div class="booking-image"></div>
                </div>

                <!-- RIGHT FORM -->
                <div class="col-md-6 booking-form">
                    <h2 class="text-center mb-4">Book Now</h2>

                    @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}'
                            });
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ session('error') }}'
                            });
                        </script>
                    @endif

                    <form method="POST" action="{{ route('booking.booking') }}">
                        @csrf

                        <!-- Category -->
                        <div class="form-group">
                            <label>Sport Category</label>
                            <div class="tabs" id="categoryTabs">
                                <div class="tab" data-category="physical">Physical</div>
                                <div class="tab" data-category="esports">E-Sports</div>
                                <div class="tab" data-category="indoor">Indoor</div>
                            </div>
                        </div>

                        <!-- Games -->
                        <div class="form-group" id="gamesSection" style="display:none;">
                            <label>Games</label>
                            <div class="tabs" id="gamesTabs"></div>
                        </div>

                        <input type="hidden" name="game" id="selectedCategory">
                        <input type="hidden" name="subGame" id="selectedGame">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone">
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" rows="4"></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const categories = {
                indoor: ['Chess', 'Carrom', 'Table Tennis', 'Badminton'],
                physical: ['Cricket', 'Football', 'Basketball'],
                esports: ['BGMI', 'Free Fire', 'Valorant']
            };

            const categoryTabs = document.querySelectorAll('#categoryTabs .tab');
            const gamesTabs = document.getElementById('gamesTabs');
            const gamesSection = document.getElementById('gamesSection');
            const selectedCategory = document.getElementById('selectedCategory');
            const selectedGame = document.getElementById('selectedGame');

            categoryTabs.forEach(tab => {
                tab.onclick = () => {
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    let category = tab.dataset.category;
                    selectedCategory.value = category;
                    gamesSection.style.display = 'block';
                    gamesTabs.innerHTML = '';
                    selectedGame.value = '';

                    categories[category].forEach(game => {
                        let g = document.createElement('div');
                        g.className = 'tab';
                        g.innerText = game;

                        g.onclick = () => {
                            document.querySelectorAll('#gamesTabs .tab').forEach(t => t.classList.remove('active'));
                            g.classList.add('active');
                            selectedGame.value = game;
                        };

                        gamesTabs.appendChild(g);
                    });
                };
            });
        });
    </script>

@endsection