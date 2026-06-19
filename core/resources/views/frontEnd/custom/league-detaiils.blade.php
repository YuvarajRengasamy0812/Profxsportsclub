@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $startdate = date('M d Y', strtotime($resluague->leagurStartdate));
    $startTime = date('H:i A', strtotime($resluague->leagurStartdate));
    $enddate = date('M d', strtotime($resluague->leagurEnddate));
    ?>
    <div class="th-hero-wrapper hero-4" id="hero">
        <div class="container th-container5">
            <div class="text-center">
                <h1 class="hero-title custom-anim-top wow" data-wow-duration="1.2s" data-wow-delay="0.2s"></h1>
                <div class="hero-thumb4-1 custom-anim-top wow" data-wow-duration="1.2s" data-wow-delay="0.2s">
                    <div class="character"><img style="width:100%;opacity:0.3" decoding="async"
                            src="{{ URL::asset('assets/frontend/img/bull-bear.jpg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="lg-slider-area slider-area hero-game-slider4-1">
                        <div class="swiper th-slider" id="heroGameSlider4-1"
                            data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="tournament-card style5">
                                        <div class="tournament-card-shape"
                                            data-bg-src="{{ URL::asset('assets/frontend/img/hero-slider-bg-shape4-1.png') }}">
                                        </div>
                                        <div class="tournament-player-wrap">
                                            <div class="tournament-card-img"
                                                data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
                                                <img decoding="async" src="{{ URL::asset('assets/frontend/img/bull.png') }}"
                                                    alt="tournament image">
                                            </div>
                                            <div class="card-title-wrap">
                                                <h3 class="tournament-card-title title"><a>Bull</a></h3>
                                            </div>
                                        </div>
                                        <div class="tournament-card-versus"><img decoding="async"
                                                src="{{ URL::asset('assets/frontend/img/game-vs2.svg') }}" alt="game vs2" />
                                        </div>
                                        <div class="tournament-player-wrap style2">
                                            <div class="tournament-card-img"
                                                data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
                                                <img decoding="async" src="{{ URL::asset('assets/frontend/img/bear.png') }}"
                                                    alt="tournament image">
                                            </div>
                                            <div class="card-title-wrap">
                                                <h3 class="tournament-card-title title"><a>Bear</a></h3>
                                            </div>
                                        </div>
                                        <div class="tournament-card-content">
                                            <div class="tournament-card-details">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @auth
                        @php
                            $today = \Carbon\Carbon::today()->format('Y-m-d');
                            $startDateFormatted = \Carbon\Carbon::parse($startdate)->format('Y-m-d');
                        @endphp

                        @if ($startDateFormatted === $today)
                            <div class="btn-wrap mt-40 justify-content-center"><a href="" class="th-btn th_btn">Enroll
                                    Now</a></div>
                        @else
                            <div class="btn-wrap mt-40 justify-content-center"><a href="javascript:void(0);"
                                    class="th-btn th_btn disabled" style="pointer-events: none; opacity: 0.6;">Enrollment
                                    Locked</a></div>
                        @endif
                    @else
                        <div class="btn-wrap mt-40 justify-content-center"><a href="{{ url('/login') }}"
                                class="th-btn th_btn">Login to Join</a></div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <section class="tournament-details-page space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">

                <div class="col-lg-12">
                    <div class="page-single tournament-details-wrap">
                        <div class="page-content">
                            <h2 class="sec-title page-title h3">{{ $resluague->leagurTitle }}</h2>
                            <div class="tournament-meta">All matches, latest results /
                                <?php echo $startdate . ' - ' . $enddate; ?></div>
                            <p class="">{!! @$resluague->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tournament-details-page space-top space-extra2-bottom mt-0 pt-0">
        <div class="container">
            <div class="row gx-40">
                {{-- <div class="col-12">
                    <div class="tournament-card style2 active mb-60">
                        <div class="tournament-card-img"><img src="assets/frontend/img/bull2.png"
                                alt="tournament image"></div>
                        <div class="tournament-card-versus"><img src="assets/frontend/img/tournament/game-vs1.svg"
                                alt="tournament image"></div>
                        <div class="tournament-card-content">
                            <div class="tournament-card-details" data-mask-src="assets/frontend/img/bg/tournament-card2-bg.png">
                                <div class="card-title-wrap text-md-end">
                                    <h6 class="tournament-card-subtitle">Live League</h6>
                                    <h3 class="tournament-card-title"><a href="tournament-details.html">Pro Player</a>
                                    </h3>
                                </div>
                                <div class="tournament-card-date-wrap">
                                    <h2 class="tournament-card-time">07:30</h2>
                                    <p class="tournament-card-date">23 Dec, 2024</p>
                                </div>
                                <div class="card-title-wrap">
                                    <h6 class="tournament-card-subtitle">Live League</h6>
                                    <h3 class="tournament-card-title"><a href="tournament-details.html">Lion King</a>
                                    </h3>
                                </div>
                            </div>
                            <div class="tournament-card-meta"><span
                                    class="tournament-card-tag gradient-border">Upcoming</span> <span
                                    class="tournament-card-score gradient-border">0 / 0</span></div>
                        </div>
                        <div class="tournament-card-img"><img src="assets/frontend/img/bear2.png"
                                alt="tournament image"></div>
                    </div>
                </div> --}}

                <!--<div class="col-lg-12 col-md-12 filter-item demo tour-all">-->
                <!--    <div class="tournament-card style5 style5-2">-->
                <!--        <div class="tournament-card-shape" data-bg-src="assets/frontend/img/tournament-card6-bg.png">-->
                <!--        </div>-->
                <!--        <div class="tournament-card-shape2" data-bg-src="assets/frontend/img/tournament-card6-2-bg.png">-->
                <!--        </div>-->

                <!--        <div class="lg-tournament-wrapper gap-4 d-flex align-items-center justify-content-center mx-auto">-->
                <!-- Player 1 -->
                <!--            <div class="tournament-player-wrap">-->
                <!--                <div class="tournament-card-img" data-bg-src="assets/frontend/img/logo-bg4.png">-->
                <!--                    <img decoding="async" src="assets/frontend/img/team-bull.png" alt="tournament image">-->
                <!--                </div>-->
                <!--                <div class="card-title-wrap">-->
                <!--                    <h3 class="tournament-card-title title"><a>Bull</a></h3>-->
                <!--                </div>-->
                <!--            </div>-->

                <!-- VS Icon -->
                <!--            <div class="tournament-card-versus">-->
                <!--                <img decoding="async" src="assets/frontend/img/game-vs2.svg" alt="game vs2" />-->
                <!--            </div>-->

                <!-- Player 2 -->
                <!--            <div class="tournament-player-wrap style2">-->
                <!--                <div class="tournament-card-img" data-bg-src="assets/frontend/img/logo-bg4.png">-->
                <!--                    <img decoding="async" src="assets/frontend/img/team-bear.png" alt="tournament image">-->
                <!--                </div>-->
                <!--                <div class="card-title-wrap">-->
                <!--                    <h3 class="tournament-card-title title"><a>Bear</a></h3>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->

                <!-- Card Content -->
                <!--        <div-->
                <!--            class="tournament-card-content  d-flex flex-column mt-0 p-0 align-items-center justify-content-center mx-auto">-->
                <!--            <div class="tournament-card-details mt-0">-->
                <!--                <h6 class="tournament-card-time">Main League</h6>-->
                <!--                <p class="tournament-card-date">Oct 08 2025</p>-->
                <!--            </div>-->

                <!--            <div class="tournament-card-date-wrap mb-2">-->
                <!--                <div class="countdown">-->
                <!--                    <div class="time-box"><span id="days">00</span><small>Days</small></div>-->
                <!--                    <div class="time-box"><span id="hours">00</span><small>Hours</small></div>-->
                <!--                    <div class="time-box"><span id="minutes">00</span><small>Minutes</small></div>-->
                <!--                    <div class="time-box"><span id="seconds">00</span><small>Seconds</small></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="btn-wrap">-->
                <!--                <a href="javascript:void(0);" class="th-btn th_btn">-->
                <!--                    <span class="btn-border">Enroll Now</span>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                <div class="col-lg-8 mt-2">
                    <div class="page-single tournament-details-wrap">
                        <div class="page-content">
                            <h2 class="sec-title page-title h3">Main League Event (Mega Round) Details</h2>
                            <div class="tournament-meta">Event: PROFXSPORTSCLUB - Main League Event (Mega Round) Date:
                                Wednesday, October 8,
                                2025 Duration: 24 hours (UAE Time, UTC+4) – Starts at 00:00 and ends at 23:59
                                Platform: Trading Platform (online via MT5) Format: Top 20 traders compete for the
                                highest profit percentage in 24 hours. Prize pool for the Main Event: $6,000, distributed
                            </div>
                            <p class=""><b>Description</b>: The grand finale of PROFXSPORTSCLUB – a 24-hour epic
                                showdown! As
                                the
                                Guinness World Record holder for "Most participants in a trading competition" (1,449
                                participants on April 10, 2025, in Dubai, UAE –
                                <a class="tournament-meta"
                                    href="https://www.guinnessworldrecords.com/world-records/774828-most-participants-in-a-trading-competition">
                                    most-participants-in-a-trading-competition
                                </a>),
                                this Mega Round brings together the best from the Pre-League to battle
                                with virtual funds. Generate the highest profit on selected assets and currencies to claim
                                top honors and substantial rewards in this ultimate test of trading mastery.
                            </p>
                            <p class="mb-30"><b>Disclaimer</b>: This event is not an investment opportunity or a platform
                                for
                                financial advice.
                                Participation involves virtual trading with no real money at risk, except for the
                                non-refundable $25 registration fee and potential prize rewards. PROFXSPORTSCLUB is not
                                liable
                                for any financial losses or outcomes resulting from participation.
                            </p>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="page-img"><img class="w-100"
                                            src="assets/frontend/img/tournament/tournament-s-1-1.png" alt="img">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="page-img"><img class="w-100"
                                            src="assets/frontend/img/tournament/tournament-s-1-2.png" alt="img">
                                    </div>
                                </div>
                            </div>
                            <p class="mb-n2 mt-35"><b>Note</b>: Registration ($25 non-refundable) and account verification
                                are
                                required to
                                participate. All participants receive a free ProFX Club membership (valued at $50) for
                                trading signals, webinars, and more. Earn extra through our referral program: 10% from
                                direct referrals, 5% from their referrals, and 2.5% from their network. Participation in
                                Pre-League Contests is encouraged to build momentum.</p>
                            <p class="mb-n2 mt-35"><b>Join Now</b>: Claim your spot in the Mega Round – register today!</p>
                            <!--{{-- <div class="tournament-team-list">-->
                            <!--    <ul class="tournament-single-team-list">-->
                            <!--        <li>-->
                            <!--            <h3 class="page-subtitle h5 text-white fw-semibold mb-20">Team 1 Players:</h3>-->
                            <!--        </li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-1.png" alt="img"> Avishek</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-2.png" alt="img"> Elius</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-3.png" alt="img"> Alex</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-4.png" alt="img"> Eshika</li>-->
                            <!--    </ul>-->
                            <!--    <ul class="tournament-single-team-list">-->
                            <!--        <li>-->
                            <!--            <h3 class="page-subtitle h5 text-white fw-semibold mb-20">Team 2 Players:</h3>-->
                            <!--        </li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-5.png" alt="img"> Michel</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-6.png" alt="img"> Rachid</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-7.png" alt="img"> Kamily</li>-->
                            <!--        <li class="tournament-single-team"><img-->
                            <!--                src="assets/frontend/img/tournament/tournament-s-team1-8.png" alt="img"> Henry</li>-->
                            <!--    </ul>-->
                            <!--</div> --}}-->
                        </div>
                    </div>
                    <!--{{-- <div class="th-comments-wrap">-->
                    <!--    <h3 class="blog-inner-title"><i class="far fa-comments"></i> Comments (03)</h3>-->
                    <!--    <ul class="comment-list">-->
                    <!--        <li class="th-comment-item">-->
                    <!--            <div class="th-post-comment">-->
                    <!--                <div class="comment-avater"><img src="assets/img/blog/comment-author-1.jpg"-->
                    <!--                        alt="Comment Author"></div>-->
                    <!--                <div class="comment-content">-->
                    <!--                    <h3 class="name">Adam Jhon</h3><span class="commented-on">25Aug, 2024-->
                    <!--                        08:56pm</span>-->
                    <!--                    <p class="text">Your health and well-being are our top priorities. We take the-->
                    <!--                        time to listen to your concerns, answer your questions.</p>-->
                    <!--                    <div class="reply_and_edit"><a href="blog-details.html" class="reply-btn"><i-->
                    <!--                                class="fas fa-reply"></i>Reply</a></div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <ul class="children">-->
                    <!--                <li class="th-comment-item">-->
                    <!--                    <div class="th-post-comment">-->
                    <!--                        <div class="comment-avater"><img src="assets/img/blog/comment-author-2.jpg"-->
                    <!--                                alt="Comment Author"></div>-->
                    <!--                        <div class="comment-content">-->
                    <!--                            <h3 class="name">Jhon Abraham</h3><span class="commented-on">25July,-->
                    <!--                                2024 10:56pm</span>-->
                    <!--                            <p class="text">We understand that every patient is unique, and their-->
                    <!--                                healthcare needs may vary. That's why we create individualized.</p>-->
                    <!--                            <div class="reply_and_edit"><a href="blog-details.html"-->
                    <!--                                    class="reply-btn"><i class="fas fa-reply"></i>Reply</a></div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                </li>-->
                    <!--            </ul>-->
                    <!--        </li>-->
                    <!--        <li class="th-comment-item">-->
                    <!--            <div class="th-post-comment">-->
                    <!--                <div class="comment-avater"><img src="assets/img/blog/comment-author-3.jpg"-->
                    <!--                        alt="Comment Author"></div>-->
                    <!--                <div class="comment-content">-->
                    <!--                    <h3 class="name">Anadi Juila</h3><span class="commented-on">15 Jan, 2024-->
                    <!--                        08:56pm</span>-->
                    <!--                    <p class="text">Our clinic is strategically located for easy access, ensuring-->
                    <!--                        that you can reach us conveniently from various parts of the community.</p>-->
                    <!--                    <div class="reply_and_edit"><a href="blog-details.html" class="reply-btn"><i-->
                    <!--                                class="fas fa-reply"></i>Reply</a></div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</div>-->
                    <!--<div class="th-comment-form">-->
                    <!--    <div class="form-title">-->
                    <!--        <h3 class="blog-inner-title mb-2"><i class="fa-solid fa-reply"></i> Leave a Comment</h3>-->
                    <!--        <p class="form-text">Your email address will not be published. Required fields are marked *-->
                    <!--        </p>-->
                    <!--    </div>-->
                    <!--    <div class="row">-->
                    <!--        <div class="col-md-6 form-group style-border"><input type="text" placeholder="Your Name*"-->
                    <!--                class="form-control"> <i class="far fa-user"></i></div>-->
                    <!--        <div class="col-md-6 form-group style-border"><input type="text" placeholder="Your Email*"-->
                    <!--                class="form-control"> <i class="far fa-envelope"></i></div>-->
                    <!--        <div class="col-12 form-group style-border"><input type="text" placeholder="Website"-->
                    <!--                class="form-control"> <i class="far fa-globe"></i></div>-->
                    <!--        <div class="col-12 form-group style-border"><textarea placeholder="Write a Comment*"-->
                    <!--                class="form-control"></textarea> <i class="far fa-pencil"></i></div>-->
                    <!--        <div class="col-12 form-group mb-0"><button class="th-btn">SEND MESSAGE <i-->
                    <!--                    class="far fa-arrow-right ms-2"></i></button></div>-->
                    <!--    </div>-->
                    <!--</div> --}}-->
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        <!--{{-- <div class="widget">-->
                        <!--    <h3 class="widget_title">Next Match</h3>-->
                        <!--    <div class="widget-tournament-info">-->
                        <!--        <div class="next-match-list">-->
                        <!--            <div class="player-info">-->
                        <!--                <div class="player-logo"><img style="max-height: 108px" src="assets/frontend/img/bull.png" alt="img">-->
                        <!--                </div>-->
                        <!--                <h4 class="player-title"><a href="team-details.html">Assassin</a></h4>-->
                        <!--                <div class="player-social"><span>Watch</span> <a-->
                        <!--                        href="https://www.twitch.tv/"><i class="fa-brands fa-twitch"></i></a> <a-->
                        <!--                        href="https://www.youtube/"><i class="fa-brands fa-youtube"></i></a>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <h5 class="verses-tag">VS</h5>-->
                        <!--            <div class="player-info">-->
                        <!--                <div class="player-logo"><img style="max-height: 110px" src="assets/frontend/img/bear.png" alt="img">-->
                        <!--                </div>-->
                        <!--                <h4 class="player-title"><a href="team-details.html">Badgamer</a></h4>-->
                        <!--                <div class="player-social"><span>Watch</span> <a-->
                        <!--                        href="https://www.twitch.tv/"><i class="fa-brands fa-twitch"></i></a> <a-->
                        <!--                        href="https://www.youtube/"><i class="fa-brands fa-youtube"></i></a>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div> --}}-->
                        <div class="widget">
                            <h3 class="widget_title">Advertisement</h3><a href="tournament.html"
                                class="widget-advertise text-center"><img src="assets/frontend/img/widget/widget-ad.png"
                                    alt="img"></a>
                        </div>
                        <!--{{-- <div class="widget">-->
                        <!--    <h3 class="widget_title">Winner of Last Session</h3>-->
                        <!--    <div class="widget-banner text-center">-->
                        <!--        <div class="logo"><img src="assets/frontend/img/jiji-bg.png" alt="img"></div>-->
                        <!--        <h4 class="title text-white mb-n2 mt-20">Score: 16000</h4>-->
                        <!--    </div>-->
                        <!--</div> --}}-->
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
    <style>
        .tournament-card {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            /* allow wrapping on small screens */
            text-align: center;
            gap: 15px;
            /* space between players and vs */
        }

        .tournament-player-wrap {
            flex: 1 1 120px;
            /* shrink properly on small devices */
            min-width: 100px;
        }

        .tournament-card-versus {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tournament-card-versus img {
            max-width: 60px;
            /* size for large screens */
            height: auto;
        }

        @media (max-width: 576px) {
            .tournament-card {
                flex-direction: column;
                /* stack vertically */
            }

            .tournament-card-versus img {
                max-width: 40px;
                /* smaller vs image */
                margin: 10px 0;
            }
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .countdown .time-box {
            text-align: center;
        }

        .countdown .time-box span {
            display: block;
            padding: 6px 10px;
            color: #45F882;
            border: 2px solid #45F882;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            /* numbers bold */
            background: transparent;
        }

        .countdown .time-box small {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            color: #45F882;
            /* label color */
            font-weight: normal;
            /* labels normal */
        }
    </style>
@endpush
@push('after-scripts')
    {{-- integrate your custom js code/files here --}}
    <script>
        function startCountdown(targetDate) {
            const countDownDate = new Date(targetDate).getTime();

            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                if (distance <= 0) {
                    clearInterval(timer);
                    document.getElementById("days").textContent = "00";
                    document.getElementById("hours").textContent = "00";
                    document.getElementById("minutes").textContent = "00";
                    document.getElementById("seconds").textContent = "00";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor(
                    (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );
                const minutes = Math.floor(
                    (distance % (1000 * 60 * 60)) / (1000 * 60)
                );
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("days").textContent = String(days).padStart(2, '0');
                document.getElementById("hours").textContent = String(hours).padStart(2, '0');
                document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
                document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');
            }, 1000);
        }

        // Run countdown to Oct 08 2025 00:00:00
        startCountdown("Oct 08, 2025 00:00:00");
    </script>
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
