@extends('frontEnd.layouts.master')

@section('content')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: var(--bg);
            margin: 0;
            font-family: "DM Sans", sans-serif;
            color: var(--text)
        }

        .container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 20px
        }

        .section {
            max-width: 1250px;
            margin: 80px auto;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        .section h2 {
            font-family: "Marcellus", serif;
            font-size: 36px;
            text-align: center;
            margin-bottom: 35px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background: url('{{ asset('assets/frontend/images/banner/physicalsports.png') }}') center/cover no-repeat fixed;
        }

        /* .hero::after{content:"";position:absolute;inset:0;background:rgba(0,0,0,.55)} */
        .hero-inner {
            padding: 130px 20px;
            min-height: 420px;
            background: url('{{ asset('assets/frontend/images/banner/physicalsports.png') }}') center/cover no-repeat fixed;
            color: white;
            position: relative;
            text-align: left;
        }

        .hero h1 {
            font-family: "Marcellus", serif;
            font-size: 48px;
            margin-bottom: 10px;
            color: #fff;
        }

        .hero h3 {
            font-size: 22px;
            margin-bottom: 15px;
            font-weight: 400;
            color: #fff;
        }

        .hero p {
            max-width: 720px;
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 25px;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 12px 26px;
            color: white;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
            display: inline-block
        }

        .accordion {
            max-width: 900px;
            margin: 0 auto
        }

        .acc-item {
            background: white;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .05);
            margin-bottom: 15px;
            overflow: hidden
        }

        .acc-header {
            padding: 18px 22px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 700
        }

        .acc-body {
            display: none;
            padding: 0 22px 20px;
            color: var(--muted)
        }

        .acc-body a {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 10px 18px;
            color: white;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none
        }

        /* Modern Table Styles */
        .modern-table {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .modern-table table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table th,
        .modern-table td {
            padding: 18px 20px;
            text-align: left;
            transition: all 0.3s ease;
        }

        .modern-table th {
            background: linear-gradient(90deg, #ef7e35, #ce3a38);
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modern-table tbody tr {
            background: #fff;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
        }

        .modern-table tbody tr:hover {
            background: #fff5f0;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(239, 126, 53, 0.15);
        }

        .modern-table tbody tr td {
            color: #333;
        }

        @media (max-width: 768px) {

            .modern-table th,
            .modern-table td {
                padding: 14px 12px;
                font-size: 14px;
            }
        }

        /* Testimonial Cards Modern Style */
        .quote-card {
            position: relative;
            background: linear-gradient(145deg, #fff, #fffaf0);
            border-radius: 16px;
            padding: 30px 25px 25px 40px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .quote-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 32px rgba(0, 0, 0, 0.12);
        }

        .quote-card .quote-icon {
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 48px;
            color: #ef7e35;
            font-family: "Marcellus", serif;
            opacity: 0.2;
            pointer-events: none;
        }

        .quote-card p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #333;
        }

        .quote-card strong {
            display: block;
            font-size: 15px;
            color: #ef7e35;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .quote-card {
                padding: 25px 20px 20px 30px;
            }

            .quote-card .quote-icon {
                font-size: 36px;
                top: -8px;
                left: 15px;
            }
        }



        .test-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 22px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center
        }

        .test-card {
            background: white;
            padding: 22px;
            border-radius: 14px;
            box-shadow: 0 8px 22px rgba(0, 0, 0, .06);
            font-size: 15px;
            line-height: 1.6
        }

        .carousel-item img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 12px
        }

        .banner-rotator {
            margin-top: 80px;
            height: 320px;
            position: relative;
            overflow: hidden
        }

        .banner-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: 1s ease
        }

        .banner-slide.active {
            opacity: 1
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            max-width: 1000px;
            margin: 0 auto
        }

        .video-grid iframe {
            width: 100%;
            height: 300px;
            border-radius: 12px;
            border: none
        }

        .player-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center
        }

        .player-card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px
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

        .form-row {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .form-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .submit-btn {
            background: linear-gradient(90deg, var(--accent1), var(--accent2));
            padding: 12px 26px;
            color: white;
            border-radius: 40px;
            font-weight: 700;
            border: none;
            cursor: pointer;
        }

        @media(max-width:900px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-inner container reveal">
            <h1>Physical: Sweat & Strategy</h1>
            <h3>Sponsored Fields for Forex Elites.</h3>
            <p>Cricket • FIFA • Fitness — UAE | Gulf | India.</p>
            <a href="{{ url('/membership') }}" class="btn btn-primary">Squad Up</a>
        </div>
    </section>

    <!-- DISCIPLINES -->
    <section class="section">
        <h2 class="reveal">Key Disciplines</h2>
        <div class="accordion reveal">
            <div class="acc-item">
                <div class="acc-header">Cricket <span style="color:#011C32">+</span></div>
                <div class="acc-body">
                    <p> Inter-firm; logo jerseys. Past: 150-run thriller</p><br>
                    <a class="mt-4" href="{{ url('/booking') }}">Book Now</a>
                </div>
            </div>
            <div class="acc-item">
                <div class="acc-header">FIFA <span style="color:#011C32">+</span></div>
                <div class="acc-body">
                    <p>Team matches; scouts watch</p><br><a href="{{ url('/booking') }}">Book Now</a>
                </div>
            </div>
            <div class="acc-item">
                <div class="acc-header">Fitness <span style="color:#011C32">+</span></div>
                <div class="acc-body">
                    <p>HIIT sessions for traders.</p><br><a href="{{ url('/booking') }}">Book Now</a>
                </div>
            </div>
            <div class="acc-item">
                <div class="acc-header">Emerging <span style="color:#011C32">+</span></div>
                <div class="acc-body">
                    <p> Badminton volleys.</p><br><a href="{{ url('/booking') }}">Book Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== SPONSORSHIP TABLE ===== -->
    <section class="section">
        <h2 class="reveal">What We Cover</h2>

        <div class="table-wrap reveal modern-table">
            <table class="s-table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Logistics</td>
                        <td>Ground booking, event coordination, transportation.</td>
                    </tr>
                    <tr>
                        <td>Gear</td>
                        <td>Jerseys (custom printed), match kits, training equipment.</td>
                    </tr>
                    <tr>
                        <td>Trials</td>
                        <td>Coach sessions, tournament entry fees.</td>
                    </tr>
                    <tr>
                        <td>Rewards</td>
                        <td>Trophies, medals, media coverage, highlight reels.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>



    <!-- ===== MEMBER VOICES / TESTIMONIALS ===== -->
    <section class="section">
        <h2 class="reveal">Member Voices</h2>

        <div class="test-grid reveal">

            <div class="test-card quote-card">
                <div class="quote-icon">“</div>
                <p>The cricket league helped my firm push team spirit to new heights.</p>
                <strong>– Apurva R.</strong>
            </div>

            <div class="test-card quote-card">
                <div class="quote-icon">“</div>
                <p>FIFA tournaments boosted our trader engagement. Amazing energy!</p>
                <strong>– Kareem A.</strong>
            </div>

            <div class="test-card quote-card">
                <div class="quote-icon">“</div>
                <p>Fitness sessions improved focus and reduced burnout among our members.</p>
                <strong>– Linda T.</strong>
            </div>

        </div>
    </section>

    <!-- PLAYERS -->
    <section class="section">
        <h2>Star Players</h2>

        <div class="player-grid">
            <div class="player-card">
                <img src="{{ URL::asset('assets/frontend/images/players/physical/1.png') }}">
                <h4>Player One</h4>
                <p>Cricket All-Rounder</p>
            </div>

            <div class="player-card">
                <img src="{{ URL::asset('assets/frontend/images//players/physical/2.png') }}">
                <h4>Player Two</h4>
                <p>FIFA Striker</p>
            </div>

            <div class="player-card">
                <img src="{{ URL::asset('assets/frontend/images//players/physical/3.png') }}">
                <h4>Player Three</h4>
                <p>Fitness Coach</p>
            </div>
        </div>
    </section>

    <!-- FORMS ROW -->
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
    <!-- FORMS ROW -->
    <section class="section">
        <h2>Join the Action</h2>

        <div class="form-row">

            <!-- REGISTER TEAM -->
            <form method="POST" action="/register-team" class="form-card reveal">
                @csrf
                <h3>Team Registration</h3>

                <label>Team Name</label>
                <input type="text" class="form-control" name="team_name" required>

                <label>Sport</label>
                <div class="select-wrap">
                    <select name="sport" required class="form-control form-control-lg form-control-select">
                        <option>Seclect Sports</option>
                        <option>Cricket</option>
                        <option>FIFA</option>
                        <option>Fitness</option>
                    </select>
                </div>
                <label>Players List</label>
                <textarea class="form-control" name="players"></textarea>

                <button type="submit" class="submit-btn">Register Team</button>
            </form>

            <!-- VOTE -->
            <form method="POST" action="/poll" class="form-card">
                @csrf
                <h3>Vote Your Favorite Sport</h3>

                <label>Select Sport</label>
                <select name="poll_sport" required class="form-control form-control-lg form-control-select">
                    <option>Seclect Sports</option>
                    <option>Cricket</option>
                    <option>FIFA</option>
                    <option>Fitness</option>
                </select>

                <button type="submit" class="submit-btn mt-5">Vote Now</button>
            </form>

        </div>
    </section>

    <script>
        // Accordion
        document.querySelectorAll('.acc-header').forEach(h => {
            h.addEventListener('click', () => {
                const body = h.nextElementSibling;
                const open = body.style.display === 'block';
                document.querySelectorAll('.acc-body').forEach(b => b.style.display = 'none');
                document.querySelectorAll('.acc-header span').forEach(i => i.textContent = '+');
                if (!open) {
                    body.style.display = 'block';
                    h.querySelector('span').textContent = '-';
                }
            });
        });

        // Carousel
        const track = document.querySelector('.carousel-track');
        let idx = 0;
        setInterval(() => {
            idx = (idx + 1) % track.children.length;
            track.style.transform = `translateX(-${idx*100}%)`;
        }, 3500);

        // Banners
        let b = 0;
        setInterval(() => {
            const slides = document.querySelectorAll('.banner-slide');
            slides.forEach(s => s.classList.remove('active'));
            slides[b].classList.add('active');
            b = (b + 1) % slides.length;
        }, 4000);
    </script>
@endsection
