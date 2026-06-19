@extends('frontEnd.layouts.master')

@section('content')
    <style>
        .section {
            max-width: 1250px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .section h2 {
            font-family: "Marcellus", serif;
            font-size: 38px;
            text-align: center;
            margin-bottom: 35px
        }

        /* ================= HERO ================= */
        .hero-esports {
            position: relative;
            padding: 130px 20px;
            min-height: 420px;
            background: url("{{ asset('assets/frontend/images/banner/esports.png') }}") center/cover no-repeat;
            color: white;
        }

        .hero-inner {
            position: relative;
            max-width: 1250px;
            margin: 0 auto;
        }

        .hero-esports h1 {
            font-family: "Marcellus", serif;
            font-size: 50px;
            margin-bottom: 10px;
        }

        .hero-esports h3 {
            font-size: 22px;
            margin-bottom: 18px;
            font-weight: 400;
        }

        .hero-esports p {
            font-size: 17px;
            max-width: 750px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .btn-gradient {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 12px 30px;
            color: white;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
        }

        /* ================= GAME CARDS ================= */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .game-card {
            position: relative;
            height: 320px;
            /* IMAGE SIZE INCREASED */
            border-radius: 18px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
            transition: all .35s ease;
            display: flex;
            align-items: flex-end;
        }

        .game-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, .75),
                    rgba(0, 0, 0, .25));
        }

        .game-card:hover {
            transform: translateY(-10px) scale(1.03);
        }

        .game-card-content {
            position: relative;
            z-index: 2;
            padding: 22px;
            text-align: left;
        }

        .game-card h3 {
            font-family: "Marcellus", serif;
            font-size: 26px;
            color: #fff;
            margin-bottom: 8px;
        }

        .game-card p {
            color: #eaeaea;
            font-size: 15px;
            margin-bottom: 16px;
        }


        /* ================= REEL ================= */
        .reel-carousel {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
        }

        .reel-track {
            display: flex;
            transition: transform .5s ease;
        }

        .reel-card {
            min-width: 100%;
            padding: 0 10px;
        }

        .reel-card iframe {
            width: 100%;
            height: 440px;
            border-radius: 14px;
            border: none;
        }

        .reel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: none;
            font-size: 28px;
            padding: 6px 14px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
            z-index: 10;
        }

        .reel-btn.prev {
            left: 10px;
        }

        .reel-btn.next {
            right: 10px;
        }


        /*  */
        /* Container & Section */
        .spr-section {
            padding: 80px 20px;
            /* background: linear-gradient(135deg, #CE3A38 0%, #EF7E35 100%); */
            /* color: #fff; */
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            /* box-shadow: 0 20px 60px rgba(0,0,0,0.3); */
        }

        .spr-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        /* Title */
        .spr-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
        }

        .spr-title::after {
            content: '';
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #EF7E35 0%, #CE3A38 100%);
            display: block;
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Rules List */
        .spr-rules {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px 30px;
            border-radius: 15px;
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .spr-rules-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: start;
        }

        .spr-rules-list li {
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            padding-left: 35px;
            line-height: 1.6;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        /* Custom bullets */
        .spr-rules-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.3rem;
            color: #Af3336;
            transform: scale(1);
            transition: transform 0.3s ease;
        }

        /* Hover effect */
        .spr-rules-list li:hover {
            transform: translateX(5px);
            color: #Af3336;
        }

        .spr-rules-list li:hover::before {
            transform: scale(1.2);
            color: #EF7E35;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            animation: spr-fadeIn 0.8s forwards;
            animation-delay: 0.3s;
        }

        @keyframes spr-fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .spr-title {
                font-size: 2.2rem;
            }

            .spr-rules {
                padding: 30px 20px;
            }

            .spr-rules-list li {
                font-size: 1rem;
                padding-left: 30px;
            }
        }

        .game-badge {
            display: inline-block;
            padding: 6px 18px;
            font-size: 13px;
            font-weight: 700;
            margin: auto;
            letter-spacing: 0.6px;
            color: #fff;
            border-radius: 999px;
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 100%);
            border: 1px solid rgba(239, 126, 53, 0.7);
            box-shadow:
                0 0 10px rgba(239, 126, 53, 0.45),
                0 0 18px rgba(206, 58, 56, 0.35),
                inset 0 0 4px rgba(255, 255, 255, 0.15);
            text-transform: uppercase;
        }
    </style>

    <!-- ================= HERO ================= -->
    <section class="hero-esports">
        <div class="hero-inner" style="color:#fff">
            <h1 style="color:#fff">Indoor Sports: Pixel Power</h1>
            <h3 style="color:#fff">Private Lobbies for Traders</h3>
            <p style="color:#fff">Snooker: BR wins & prizes. Chess: Blitz & blitz</p>
            <a href="/events" class="btn btn-primary">Queue</a>
        </div>
    </section>

    <!-- ================= GAME GALAXY ================= -->
    <section class="section">
        <h2>Game Galaxy</h2>
        <div class="game-grid">

            <div class="game-card"
                style="background-image:url('https://library.sportingnews.com/styles/crop_style_16_9_desktop_webp/s3/2023-04/Snooker%20table%20GettyImages-835002860.jpg.webp')">
                <div class="game-card-content">
                    <h3>Snooker</h3>
                    <p>BR wins & prizes</p>
                    <a href="{{ url('/booking') }}" class="btn btn-primary">Booking</a>
                </div>
            </div>

            <div class="game-card"
                style="background-image:url('https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04')">
                <div class="game-card-content">
                    <h3>Chess</h3>
                    <p>Strategy & scouts</p>
                    <a href="{{ url('/booking') }}" class="btn btn-primary">Booking</a>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= RULES ================= -->
    <section class="spr-section">
        <div class="spr-container">
            <h2 class="spr-title reveal">Play Fair</h2>
            <div class="spr-rules reveal">
                <ul class="spr-rules-list">
                    <li>Verify forex</li>
                    <li>Min. 4 squad</li>
                    <li>Logo DPs</li>
                    <li>Private only</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ================= REELS ================= -->
    <section class="section">
        <h2>Highlights Reel</h2>
        <div class="reel-carousel">
            <button class="reel-btn prev">&#10094;</button>
            <div class="reel-track">
                <div class="reel-card"><iframe src="https://www.youtube.com/embed/5jg4l1UqFXw"></iframe></div>
                <div class="reel-card"><iframe src="https://www.youtube.com/embed/8duCNWsm5RY"></iframe></div>
                <div class="reel-card"><iframe src="https://www.youtube.com/embed/E7-zDYhdvnE"></iframe></div>
            </div>
            <button class="reel-btn next">&#10095;</button>
        </div>
    </section>

    <script>
        const track = document.querySelector('.reel-track');
        const slides = document.querySelectorAll('.reel-card');
        let idx = 0;

        setInterval(() => {
            idx = (idx + 1) % slides.length;
            track.style.transform = `translateX(-${idx * 100}%)`;
        }, 4000);

        document.querySelector('.prev').onclick = () => {
            idx = (idx - 1 + slides.length) % slides.length;
            track.style.transform = `translateX(-${idx*100}%)`
        }
        document.querySelector('.next').onclick = () => {
            idx = (idx + 1) % slides.length;
            track.style.transform = `translateX(-${idx*100}%)`
        }
    </script>
@endsection
