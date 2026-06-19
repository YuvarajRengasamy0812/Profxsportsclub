@extends('frontEnd.layouts.master')

@section('content')
    <style>
        body {
            background: var(--bg);
            margin: 0;
            font-family: "DM Sans", sans-serif;
            color: var(--text)
        }

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

        /* HERO */
        .hero-esports {
            position: relative;
            padding: 130px 20px;
            min-height: 420px;
            background: url("{{ asset('assets/frontend/images/banner/esports.png') }}") center/cover no-repeat;
            color: white;
        }

        /*.hero-esports::after{*/
        /*  content:"";position:absolute;inset:0;background:rgba(0,0,0,.55);*/
        /*}*/
        .hero-inner {
            position: relative;
            max-width: 1250px;
            margin: 0 auto;
        }

        .hero-esports h1 {
            font-family: "Marcellus", serif;
            font-size: 50px;
            margin-bottom: 10px;
            color: #fff;
        }

        .hero-esports h3 {
            font-size: 22px;
            margin-bottom: 18px;
            font-weight: 400;
            color: #fff;
        }

        .hero-esports p {
            font-size: 17px;
            max-width: 750px;
            line-height: 1.6;
            margin-bottom: 25px;
            color: #fff;
        }

        .btn-gradient {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 12px 30px;
            color: white;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
        }

        /* GAME GALAXY MODERN CARDS */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            max-width: 1000px;
            margin: 0 auto;
        }

        .game-card {
            position: relative;
            background-size: cover;
            background-position: center;
            border-radius: 16px;
            overflow: hidden;
            padding: 25px;
            text-align: center;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: translateY(0);
            height: 320px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .game-card .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.1));
            z-index: 1;
            transition: all 0.3s ease;
        }

        .game-card h3,
        .game-card p,
        .game-card a {
            position: relative;
            z-index: 2;
        }

        .game-card h3 {
            font-family: "Marcellus", serif;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .game-card p {
            color: #e0e0e0;
            margin-bottom: 15px;
            font-size: 15px;
        }

        .game-card a {
            background: linear-gradient(90deg, #ef7e35, #ce3a38);
            padding: 10px 22px;
            border-radius: 30px;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .game-card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.25);
        }

        .game-card:hover .card-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.05));
        }

        .game-card a:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(239, 126, 53, 0.4);
        }

        /* Responsive */
        @media(max-width:768px) {
            .game-card {
                height: 280px;
            }

            .game-card h3 {
                font-size: 20px;
            }
        }

        .badge {
            background: transparent;
            border: 1px solid currentColor;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 13px;
            display: inline-block;
            margin: 0 auto 12px;
            width: fit-content;
        }

        /* HIGHLIGHTS / REEL CAROUSEL */
        .reel-carousel {
            max-width: 1000px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            border-radius: 14px;
        }

        .reel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .reel-card {
            min-width: 100%;
            flex-shrink: 0;
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

        .upload-btn {
            text-align: center;
            margin-top: 25px;
        }

        .upload-btn a {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 12px 30px;
            color: white;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
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

    <!-- ========================= HERO ========================= -->
    <section class="hero-esports">
        <div class="hero-inner">
            <h1>E-Sports: Pixel Power</h1>
            <h3>Private Lobbies for Traders.</h3>
            <p>PUBG: Squad drops (min. 4). Warzone: Multi-modes. Fortnite/Tekken: Builds & tilts. Logos on DPs. Sponsored
                servers; nationals scouted.</p>
            <a href="/events" class="btn btn-primary">Queue</a>
        </div>
    </section>

    <!-- ========================= GAME GALAXY ========================= -->
    <section class="section">
        <h2>Game Galaxy</h2>
        <div class="game-grid">
            <div class="game-card" style="background-image: url('{{ asset('assets/frontend/images/pubg.png') }}')">
                <div class="card-overlay"></div>
                <h3 class="text-white">PUBG</h3>
                <p class="badge">BR wins; prizes.</p>
                <a href="{{ url('/booking') }}" class="btn btn-primary text-center">Enlist</a>
            </div>
            <div class="game-card" style="background-image: url('{{ asset('assets/frontend/images/cod.png') }}')">
                <div class="card-overlay"></div>
                <h3 class="text-white">Warzone</h3>
                <p class="badge">Resurgence; scouts.</p>
                <a href="{{ url('/booking') }}" class="btn btn-primary text-center">Load</a>
            </div>
            <div class="game-card" style="background-image: url('{{ asset('assets/frontend/images/fortnite.png') }}')">
                <div class="card-overlay"></div>
                <h3 class="text-white">Fortnite</h3>
                <p class="badge">Zero-build mode.</p>
                <a href="{{ url('/booking') }}" class="btn btn-primary text-center">Build</a>
            </div>
            <div class="game-card" style="background-image: url('{{ asset('assets/frontend/images/tekken.png') }}')">
                <div class="card-overlay"></div>
                <h3 class="text-white">Tekken</h3>
                <p class="badge">1v1 brackets.</p>
                <a href="{{ url('/booking') }}" class="btn btn-primary text-center">Challenge</a>
            </div>
        </div>
    </section>

    <!-- ========================= RULES ========================= -->
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

    <!-- ========================= HIGHLIGHTS / REEL CAROUSEL ========================= -->
    <section class="section">
        <h2>Highlights Reel</h2>
        <div class="reel-carousel">
            <button class="reel-btn prev">&#10094;</button>
            <div class="reel-track">
                <div class="reel-card text-center">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/uCd6tbUAy6o?si=55FpXn5tfN2FZ-Hb" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                    <p class="mt-3 fw-bold game-badge">PUBG Clutch</p>
                </div>
                <div class="reel-card text-center">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/2hPuRQz6IlM?si=jXGOR6oc294uSNBN" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                    <p class="mt-3 fw-bold game-badge">Tekken KO</p>
                </div>
                <div class="reel-card text-center">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/0E44DClsX5Q?si=g-9UFdvUI8nrmeQ6" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                    <p class="mt-3 fw-bold game-badge">Warzone Highlights</p>
                </div>
            </div>
            <button class="reel-btn next">&#10095;</button>
        </div>
        {{-- <div class="upload-btn"><a href="#">Upload</a></div> --}}
    </section>

    <script>
        // Game Galaxy hover handled by CSS

        // Reel Carousel
        const track = document.querySelector('.reel-track');
        const slides = document.querySelectorAll('.reel-card');
        let idx = 0;

        function moveSlide(index) {
            track.style.transform = `translateX(-${index * 100}%)`;
        }

        // Auto-play carousel
        setInterval(() => {
            idx = (idx + 1) % slides.length;
            moveSlide(idx);
        }, 4000);

        // Prev / Next buttons
        document.querySelector('.reel-btn.prev').addEventListener('click', () => {
            idx = (idx - 1 + slides.length) % slides.length;
            moveSlide(idx);
        });
        document.querySelector('.reel-btn.next').addEventListener('click', () => {
            idx = (idx + 1) % slides.length;
            moveSlide(idx);
        });
    </script>
@endsection
