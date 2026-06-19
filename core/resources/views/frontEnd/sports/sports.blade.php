@extends('frontEnd.layouts.master')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: "DM Sans", sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 20px
        }

        /* HERO */
        .hero {
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            background: url('{{ asset('assets/frontend/images/banner/sports.png') }}') center/cover no-repeat fixed;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(1, 28, 50, 0.35), rgba(1, 28, 50, 0.55));
            pointer-events: none
        }

        .hero-inner {
            display: flex;
            align-items: center;
            gap: 40px;
            padding: 80px 20px;
            min-height: 420px;
            background: url('{{ asset('assets/frontend/images/banner/sports.png') }}') center/cover no-repeat fixed;
        }

        .hero-copy {
            flex: 1;
            color: white;
            z-index: 2
        }

        .kicker {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            font-weight: 700;
            margin-bottom: 18px
        }

        .hero h1 {
            font-family: "Marcellus", serif;
            font-size: 44px;
            margin: 0 0 12px;
            line-height: 1.02;
            color: #fff
        }

        .hero h3 {
            font-size: 20px;
            margin: 0 0 18px;
            font-weight: 500;
            color: #fff
        }

        .hero p {
            max-width: 720px;
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 22px;
            opacity: 0.95;
            color: #fff
        }

        .cta-row {
            display: flex;
            gap: 14px;
            align-items: center
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border-radius: 40px;
            border: none;
            cursor: pointer;
            font-weight: 800;
            text-decoration: none
        }

        .btn-primary {
            background: linear-gradient(90deg, #EF7E35 0%, #CE3A38 100%);
            color: white;
            box-shadow: 0 8px 30px rgba(175, 51, 54, 0.18);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.12)
        }

        .btn-primary:hover,
        .btn-outline:hover {
            border: 1px solid #EF7E35;
            opacity: 0.9;
            transform: translateY(-2px);
            transition: all .3s ease-in-out
        }

        .hero-meta {
            margin-top: 18px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px
        }

        .hero-side {
            width: 360px;
            max-width: 40%;
            z-index: 2
        }

        .side-card {
            background: rgba(255, 255, 255, 0.06);
            padding: 20px;
            border-radius: 16px;
            backdrop-filter: blur(6px);
        }

        .side-card h4 {
            margin: 0 0 6px;
            font-size: 18px
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.08);
            font-weight: 700
        }

        .small {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.85)
        }

        /* SECTION */
        .section {
            max-width: 1250px;
            margin: 50px auto;
            padding: 0 20px
        }

        .section h2 {
            font-family: "Marcellus", serif;
            font-size: 34px;
            text-align: center;
            margin-bottom: 28px
        }

        .tabs {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap
        }

        .tab-btn {
            padding: 10px 20px;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            background: #e9eef6;
            color: var(--text)
        }

        .tab-btn.active {
            background: linear-gradient(90deg, #EF7E35 0%, #CE3A38 100%);
            color: white
        }

        .tab-content {
            display: none
        }

        .tab-content.active {
            display: block
        }

        .tourneys {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 22px
        }

        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(2, 6, 23, 0.06);
            overflow: hidden;
            transition: transform .35s, box-shadow .35s
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(2, 6, 23, 0.09)
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover
        }

        .card .body {
            padding: 16px
        }

        .card h4 {
            font-size: 18px;
            margin: 0 0 8px
        }

        .card p {
            margin: 0 0 12px;
            color: var(--muted)
        }

        .card a {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-weight: 800
        }

        /* Next Battles Carousel */
        /* .carousel-wrap{position:relative}
                            .carousel{display:flex;gap:18px;overflow:auto;padding:12px 6px;scroll-behavior:smooth}
                            .carousel::-webkit-scrollbar{height:8px}
                            .carousel::-webkit-scrollbar-thumb{background:#ccd3df;border-radius:999px}
                            .carousel-card{flex:0 0 320px}
                            .carousel-controls{position:absolute;right:10px;top:10px;display:flex;gap:8px}
                            .icon-btn{background:white;padding:8px;border-radius:10px;box-shadow:0 6px 18px rgba(2,6,23,0.06);border:none;cursor:pointer} */

        .carousel-wrap {
            position: relative;
        }

        .carousel {
            display: flex;
            gap: 18px;
            overflow-x: scroll;
            scroll-behavior: smooth;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            padding: 16px 40px;
        }

        .carousel::-webkit-scrollbar {
            display: none;
        }

        .carousel-card {
            scroll-snap-align: center;
            flex: 0 0 320px;
        }

        /* 📱 Mobile: show ONE card */
        @media (max-width: 768px) {
            .carousel {
                padding: 16px;
            }

            .carousel-card {
                flex: 0 0 100%;
            }
        }



        .carousel.no-transition {
            scroll-behavior: auto;
        }


        /* Icon Buttons */
        .icon-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            color: #fff;
            font-size: 18px;
            background: linear-gradient(90deg, #ef7e35 0%, #ce3a38 100%);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            z-index: 5;
        }

        .icon-btn.prev {
            left: 0;
        }

        .icon-btn.next {
            right: 0;
        }

        .icon-btn:hover {
            opacity: 0.9;
        }


        /* Rules */
        .rules {
            max-width: 900px;
            margin: 30px auto;
            background: linear-gradient(180deg, white, white);
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(2, 6, 23, 0.04)
        }

        .rules ul {
            padding-left: 20px
        }

        .rules li {
            margin-bottom: 10px
        }

        /* Success Stories */
        .success-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px
        }

        .success-card {
            background: linear-gradient(180deg, white, #fff);
            padding: 18px;
            border-radius: 12px;
            box-shadow: 0 8px 26px rgba(2, 6, 23, 0.06)
        }

        .success-card h4 {
            margin: 0 0 6px
        }

        /* Form */
        .form-card {
            background: white;
            padding: 26px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(2, 6, 23, 0.06);
            max-width: 720px;
            margin: 30px auto
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 700
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #e6e9f2
        }

        .submit-btn {
            display: inline-block;
            margin-top: 16px;
            padding: 12px 20px;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            color: white;
            font-weight: 800
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .6s ease, transform .6s ease
        }

        .reveal.show {
            opacity: 1;
            transform: none
        }

        .select-wrap {
            position: relative
        }

        .select-wrap::after {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #66788a;
            font-weight: 700
        }

        .form-card {
            background: #fff;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 8px 26px rgba(0, 0, 0, .06)
        }

        .form-card label {
            display: block;
            font-weight: 700;
            margin: 12px 0 6px
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #d6e0ec;
            font-size: 15px;
            background: #fff
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(239, 126, 53, 0.08);
            border-color: var(--accent2)
        }

        /* Responsive */
        @media(max-width:960px) {
            .hero-inner {
                flex-direction: column;
                min-height: 520px;
                padding: 60px 20px
            }

            .hero-side {
                width: 100%;
                max-width: 100%
            }
        }

        @media(max-width:520px) {
            .hero h1 {
                font-size: 28px
            }

            .hero h3 {
                font-size: 15px
            }
        }



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


        /* Win Section */
        .win-section {
            padding: 80px 20px;
            /* background: #111; */
            color: #fff;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .win-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        /* Title */
        .win-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 50px;
            position: relative;
        }

        .win-title::after {
            content: '';
            width: 70px;
            height: 4px;
            background: linear-gradient(90deg, #EF7E35 0%, #CE3A38 100%);
            display: block;
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* Grid */
        .win-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        /* Card */
        .win-card {
            position: relative;
            height: 350px;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            background-size: cover;
            background-position: center;
        }

        .win-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        /* Overlay */
        .win-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2));
            transition: background 0.5s ease;
        }

        .win-card:hover .win-overlay {
            background: linear-gradient(to top, rgba(206, 58, 56, 0.7), rgba(239, 126, 53, 0.3));
        }

        /* Content */
        .win-content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            color: #fff;
            z-index: 2;
            text-align: left;
        }

        .win-content h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .win-content p {
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            animation: win-fadeIn 0.8s forwards;
            animation-delay: 0.3s;
        }

        @keyframes win-fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .win-title {
                font-size: 2.2rem;
            }

            .win-card {
                height: 280px;
            }

            .win-content h4 {
                font-size: 1.3rem;
            }

            .win-content p {
                font-size: 0.95rem;
            }
        }
    </style>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-inner container">
            <div class="hero-copy">
                <span class="kicker">Sponsored Arenas</span>
                <h1>Sports for Forex Pros</h1>
                <h3>Physical or E‑Sports — Sponsored Arenas Await</h3>
                <p>Tailored for brokers: verify to access. Physical: Cricket derbies, FIFA. E‑Sports: PUBG squads, Tekken.
                    Min. 4 (E‑Sports) / 11 (Physical) players; logos required. Surveys pick formats; Profx sponsors. UAE /
                    India / Gulf focus.</p>
                <div class="cta-row">
                    <a href="{{ url('/physicalsports') }}" class="btn btn-primary">Physical</a>
                    <a href="{{ url('/esports') }}" class="btn btn-outline">E‑Sports</a>
                    <a href="{{ url('/indoorsports') }}" class="btn btn-outline">Indoor</a>
                </div>
                <div class="hero-meta reveal" style="margin-top:12px">Verified brokers receive priority invites & sponsored
                    venue access.</div>
            </div>

            <aside class="hero-side reveal">
                <div class="side-card">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
                        <div>
                            <h4 style="margin:0" class="text-white">Profx Sponsorship</h4>
                            <div class="small">National paths: UAE · India · Gulf</div>
                        </div>
                        <div class="badge">Verify</div>
                    </div>
                    <div style="display:flex;gap:10px;margin-top:12px">
                        <div style="flex:1" class="text-white"><strong>Min</strong>
                            <div class="small">4 / 11 players</div>
                        </div>
                        <div style="flex:1" class="text-white"><strong>Logos</strong>
                            <div class="small">Company logos required</div>
                        </div>
                    </div>
                    <div style="margin-top:14px"><a href="{{ url('/upcomeingEvent') }}" class="btn btn-primary"
                            style="width:100%;justify-content:center">Upcoming Events</a></div>
                </div>
            </aside>
        </div>
    </section>

    <!-- CATEGORIES (TABS) -->
    <section class="section">
        <h2 class="reveal"> Categories</h2>
        <div class="tabs reveal" role="tablist" aria-label="Tournament categories">
            <button class="tab-btn active" data-tab="physical">Physical</button>
            <button class="tab-btn" data-tab="esports">E‑Sports</button>
            <button class="tab-btn" data-tab="indoor">INDOOR</button>
        </div>

        <div id="physical" class="tab-content active reveal">
            <p style="text-align:center;margin-bottom:20px">Cricket clashes; FIFA fields. Sponsored venues for brokers and
                prop firms.</p>
            <div class="tourneys">
                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/cricket.png') }}" alt="Cricket" />
                    <div class="body">
                        <h4>Cricket</h4>
                        <p>T20 derbies across UAE & Gulf.</p>
                        <a class="btn btn-primary" href="{{ url('/physicalsports') }}">Explore</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/2.png') }}" alt="FIFA" />
                    <div class="body">
                        <h4>FIFA</h4>
                        <p>Stadium matches, sponsored fixtures.</p>
                        <a class="btn btn-primary" href="{{ url('/physicalsports') }}">Explore</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/fitness.png') }}" alt="Fitness" />
                    <div class="body">
                        <h4>Fitness</h4>
                        <p>Corporate wellness & esports conditioning.</p>
                        <a class="btn btn-primary" href="{{ url('/physicalsports') }}">Explore</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="esports" class="tab-content reveal">
            <p style="text-align:center;margin-bottom:20px">PUBG drops; Warzone wars. Private lobbies and sponsored prize
                pools.</p>
            <div class="tourneys">
                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/5.png') }}" alt="PUBG" />
                    <div class="body">
                        <h4>PUBG</h4>
                        <p>Battle Royale squads.</p>
                        <a class="btn btn-primary" href="{{ url('/esports') }}">Enter</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/7.png') }}" alt="COD" />
                    <div class="body">
                        <h4>Warzone / COD</h4>
                        <p>Private lobbies & squad leagues.</p>
                        <a class="btn btn-primary" href="{{ url('/esports') }}">Enter</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/8.png') }}" alt="Tekken" />
                    <div class="body">
                        <h4>Tekken</h4>
                        <p>Fighter tournaments — 1v1 showdowns.</p>
                        <a class="btn btn-primary" href="{{ url('/esports') }}">Enter</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="indoor" class="tab-content reveal">
            <p style="text-align:center;margin-bottom:20px">
                Snooker frames, chess minds & indoor showdowns. Private matches with prizes.
            </p>

            <div class="tourneys">

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/snooker.png') }}" alt="Snooker" />
                    <div class="body">
                        <h4>Snooker</h4>
                        <p>Professional frames & break challenges.</p>
                        <a class="btn btn-primary" href="{{ url('/indoor-games') }}">Enter</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/chess.png') }}" alt="Chess" />
                    <div class="body">
                        <h4>Chess</h4>
                        <p>Rapid, Blitz & classical formats.</p>
                        <a class="btn btn-primary" href="{{ url('/indoor-games') }}">Enter</a>
                    </div>
                </div>

                <div class="card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/carom.png') }}" alt="Carrom" />
                    <div class="body">
                        <h4>Carrom</h4>
                        <p>Singles & doubles board battles.</p>
                        <a class="btn btn-primary" href="{{ url('/indoor-games') }}">Enter</a>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- NEXT BATTLES (Carousel) -->
    {{-- <section class="section">
      <h2 class="reveal">UPCOMEING BATTLES</h2>
      <div class="carousel-wrap reveal">
        <div class="carousel-controls">
          <button class="icon-btn" id="prev">◀</button>
          <button class="icon-btn" id="next">▶</button>
        </div>
        <div class="carousel" id="carousel">
          <div class="card carousel-card">
            <img src="{{URL::asset('assets/frontend/images/sports/cricket tournmnt.png') }}" alt="Cricket Tourney"/>
            <div class="body">
              <h4>Cricket Tourney</h4>
              <p>Date: Nov 20 | UAE | Min. 11 squad</p>
              <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
            </div>
          </div>

          <div class="card carousel-card">
            <img src="{{URL::asset('assets/frontend/images/sports/5.png')}}" alt="PUBG Clash"/>
            <div class="body">
              <h4>PUBG Clash</h4>
              <p>Date: Sat | Virtual | Min. 4</p>
              <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
            </div>
          </div>

          <div class="card carousel-card">
            <img src="{{URL::asset('assets/frontend/images/sports/2.png') }}" alt="FIFA Final"/>
            <div class="body">
              <h4>FIFA Final</h4>
              <p>Date: Nov 25 | Gulf | Sponsored</p>
              <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
            </div>
          </div>

          <div class="card carousel-card">
            <img src="{{URL::asset('assets/frontend/images/sports/7.png') }}" alt="Warzone"/>
            <div class="body">
              <h4>Warzone League</h4>
              <p>Qualifier | Virtual | Squads</p>
              <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    {{-- upcoming matches --}}
    <section class="section">
        <h2 class="reveal">UPCOMING BATTLES</h2>

        <div class="carousel-wrap reveal">
            <button class="icon-btn prev" id="prev">◀</button>

            <div class="carousel" id="carousel">
                <div class="card carousel-card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/cricket tournmnt.png') }}" />
                    <div class="body">
                        <h4>Cricket Tourney</h4>
                        <p>Date: Jan 20 | UAE | Min. 11 squad</p>
                        <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
                    </div>
                </div>

                <div class="card carousel-card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/5.png') }}" />
                    <div class="body">
                        <h4>PUBG Clash</h4>
                        <p>Date: Every week Sat | Virtual | Squads</p>
                        <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
                    </div>
                </div>

                <div class="card carousel-card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/2.png') }}" />
                    <div class="body">
                        <h4>FIFA Final</h4>
                        <p>Date: JAN 25 | Gulf | Sponsored</p>
                        <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
                    </div>
                </div>

                <div class="card carousel-card">
                    <img src="{{ URL::asset('assets/frontend/images/sports/7.png') }}" />
                    <div class="body">
                        <h4>Warzone League</h4>
                        <p>Date: Every week Sat | Virtual | Squads</p>
                        <a class="btn btn-primary" href="{{ url('/booking') }}">Register</a>
                    </div>
                </div>
            </div>

            <button class="icon-btn next" id="next">▶</button>
        </div>
    </section>


    <!-- RULES & REWARDS -->
    <section class="spr-section">
        <div class="spr-container">
            <h2 class="spr-title reveal">Play Rules</h2>
            <div class="spr-rules reveal">
                <ul class="spr-rules-list">
                    <li>Verify forex role (broker / prop trader / affiliate) to participate.</li>
                    <li>Company logos required for team registration; no anonymous entries.</li>
                    <li>Min. players: 11 (physical) / 4 (e‑sports). Cheating leads to immediate disqualification.</li>
                    <li>Rewards: Sponsored prizes, media spotlights, and national pathway opportunities.</li>
                </ul>
            </div>
        </div>
    </section>



    <!-- SUCCESS STORIES -->
    <section class="win-section">
        <div class="win-container">
            <h2 class="win-title reveal">Wins Spotlight</h2>
            <div class="win-grid reveal">
                <div class="win-card" style="background-image: url('assets/frontend/images/3.png');">
                    <div class="win-overlay"></div>
                    <div class="win-content">
                        <h4 class="text-white">Cricket — XYZ vs. ABC</h4>
                        <p class="text-white">Epic win, bonds sealed. Local leagues elevated to national stage after the
                            fixture.</p>
                        <a href="{{ url('/contact') }}" class="btn btn-primary">Share</a>
                    </div>
                </div>

                <div class="win-card" style="background-image: url('assets/frontend/images/tournaments/14.png');">
                    <div class="win-overlay"></div>
                    <div class="win-content">
                        <h4 class="text-white">Warzone — Squad Top</h4>
                        <p class="text-white">Top squad performance went viral on socials and unlocked sponsored invites.
                        </p>
                        <a href="{{ url('/contact') }}" class="btn btn-primary">Share</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('success'))
        <?php echo '1';
        ?>
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
        <?php echo '3';
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <!-- GET INVOLVED -->
    <section class="section">
        <h2 class="reveal">Your Move</h2>
        <form class="form-card reveal" method="POST"action="{{ route('sports.sports') }}">
            @csrf
            <label for="sport">Sport</label>
            <div class="select-wrap">
                <select id="sport" name="sport" required class="form-control form-control-lg form-control-select">
                    <option value="">Select a sport</option>
                    <option>FIFA</option>
                    <option>Fortnite</option>
                    <option>PUBG</option>
                    <option>Cricket</option>
                    <option>Warzone</option>
                </select>
            </div>
            <label for="date">Availability (Date)</label>
            <input type="date" id="date" name="date" required />

            <label for="comments">Comments</label>
            <textarea id="comments" name="comments" placeholder="Share thoughts or suggestions..."></textarea>

            <button type="submit" class="submit-btn">Vote</button>
        </form>
    </section>

    <script>
        // Tabs
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(btn => btn.addEventListener('click', () => {
            tabButtons.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(btn.dataset.tab).classList.add('active');
        }));

        // Simple reveal on scroll (Intersection Observer)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Carousel controls
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const nextBtn = document.getElementById('next');
            const prevBtn = document.getElementById('prev');
            const gap = 18;

            let cards = Array.from(carousel.children);
            const cardCount = cards.length;

            // Clone all cards for seamless loop
            cards.forEach(card => {
                const clone = card.cloneNode(true);
                clone.classList.add('clone');
                carousel.appendChild(clone);
            });

            let cardWidth = cards[0].offsetWidth + gap;
            let scrollPos = 0;
            let isDragging = false;
            let startX = 0;
            let scrollStart = 0;

            const updateCardWidth = () => {
                cardWidth = cards[0].offsetWidth + gap;
            };

            window.addEventListener('resize', updateCardWidth);

            // Arrow navigation
            nextBtn.addEventListener('click', () => scrollNext());
            prevBtn.addEventListener('click', () => scrollPrev());

            function scrollNext() {
                scrollPos += cardWidth;
                smoothScroll(scrollPos);
            }

            function scrollPrev() {
                scrollPos -= cardWidth;
                smoothScroll(scrollPos);
            }

            function smoothScroll(pos) {
                carousel.scrollTo({
                    left: pos,
                    behavior: 'smooth'
                });
            }

            // Infinite loop check
            carousel.addEventListener('scroll', () => {
                if (scrollPos >= cardWidth * cardCount) {
                    scrollPos = 0;
                    carousel.scrollLeft = 0;
                }
                if (scrollPos < 0) {
                    scrollPos = cardWidth * (cardCount - 1);
                    carousel.scrollLeft = scrollPos;
                }
            });

            // Touch / Drag
            carousel.addEventListener('mousedown', e => {
                isDragging = true;
                startX = e.pageX;
                scrollStart = scrollPos;
            });
            carousel.addEventListener('mouseup', () => {
                isDragging = false;
            });
            carousel.addEventListener('mouseleave', () => {
                isDragging = false;
            });
            carousel.addEventListener('mousemove', e => {
                if (!isDragging) return;
                const dx = e.pageX - startX;
                scrollPos = scrollStart - dx;
                carousel.scrollLeft = scrollPos;
            });

            // Mobile touch
            carousel.addEventListener('touchstart', e => {
                startX = e.touches[0].pageX;
                scrollStart = scrollPos;
            });
            carousel.addEventListener('touchmove', e => {
                const dx = e.touches[0].pageX - startX;
                scrollPos = scrollStart - dx;
                carousel.scrollLeft = scrollPos;
            });

            // Auto scroll
            let autoScroll = setInterval(scrollNext, 3000);
            carousel.addEventListener('mouseenter', () => clearInterval(autoScroll));
            carousel.addEventListener('mouseleave', () => autoScroll = setInterval(scrollNext, 3000));
        });


        // Form: basic client-side email confirm simulation (server should send real confirmation)
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            // allow default POST, but show a quick client feedback
            // If you want AJAX, replace with fetch to endpoint and handle responses
            const btn = form.querySelector('.submit-btn');
            btn.disabled = true;
            btn.textContent = 'Submitting...';
        });
    </script>
@endsection
