@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $title_var = 'title_' . @Helper::currentLanguage()->code;
    $title_var2 = 'title_' . config('smartend.default_language');
    $details_var = 'details_' . @Helper::currentLanguage()->code;
    $details_var2 = 'details_' . config('smartend.default_language');
    $aboutsection1 = Helper::Topic(155);
    $aboutsecupcoming = Helper::Topic(156);
    $aboutseconemid = Helper::Topic(158);
    $aboutsectwomid = Helper::Topic(159);
    $aboutjoinleague = Helper::Topic(160);
    ?>

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
    </style>

    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">

        <div class="container">
            <div class="row">
                <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
                @include('frontEnd.user.usermenu')
                @if (auth()->user()->payment_status == 1)
                    <div class="col-lg-10 col-sm-12">
                        <div class="text-center tournament-card d-grid pt-4 pb-4 mt-5">
                            <h5 class="text-white text-center">Refer Your Friends and Win up to 17.5% of their payments</h5>
                            <div class="tournament-card-meta d-flex justify-content-center">
                                <div class="referral">
                                    Referral Code <br /><span class="gradient-border pb-1 pt-1 tournament-card-score"
                                        style="font-size: 1.4rem;letter-spacing: 5px;">{{ auth()->user()->referral_code }}</span>
                                </div>
                                <button class="btn p-0 no-decoration clipbtn" data-tippy-theme="white"
                                    data-tippy-placement="bottom" data-tippy-arrow="true" data-tippy-content="Click to Copy"
                                    data-clipboard-text="{{ url('register/?ref=' . auth()->user()->referral_code) }}"><span
                                        class="tournament-card-tag">Referral Form Link</span></button>
                            </div>
                        </div>
                        <!-- Referral Program Section -->
                        <div class="referral-section position-relative py-5 col-lg-10 col-sm-12">
                            <div class="container">
                                <div class="text-center">

                                    <h2 class="sec-title mb-3" data-aos="fade-up">PROFXSPORTSCLUB Referral Program</h2>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <!-- Heading -->


                                    <!-- Intro -->
                                    <div class="intro-box mb-4">
                                        <p>
                                            Turn your network into an opportunity! Invite friends, fellow traders, or your
                                            community to join the PROFXSPORTSCLUB using your unique referral link and earn
                                            commissions at three levels:

                                        </p>
                                    </div>

                                    <!-- How it Works -->
                                    <h5 class="theme-text mb-3">How It Works</h5>
                                    <div class="step-card mb-4">
                                        <ul>
                                            <li><span class="theme-text">Level 1:</span> 10% from direct referrals</li>
                                            <li><span class="theme-text">Level 2:</span> 5% from their referrals</li>
                                            <li><span class="theme-text">Level 3:</span> 2.5% from extended network</li>
                                        </ul>
                                    </div>

                                    <ul class="why-join mb-4">
                                        <li> No limits - the more you refer, the more you earn
                                        </li>
                                        <li>Rewards are credited directly to your account
                                        </li>
                                        <li>Simple, transparent, and effective
                                        </li>
                                    </ul>

                                    <!-- Start Earning -->
                                    <h5 class="theme-text mb-2">Start Earning Today!</h5>
                                    <p class="text-light mb-4">
                                        Start sharing your referral link today and grow with the PROFXSPORTSCLUB community
                                    </p>
                                </div>

                            </div>
                        </div>

                    </div>
                @else
                    <div class="col-lg-10 col-sm-12">
                        <div class="text-center tournament-card d-grid pt-4 pb-4">
                            <h5 class="text-white text-center">Get ready to trade and earn! Activate your ProFxLeague
                                account with $25 and start referring.</h5>
                            <div class="tournament-card-meta d-flex justify-content-center">
                                <a type="button" href="{{ route('user.choosepayment', 'register') }}"
                                    class="th-btn th_btn style2" style="min-width:100px">Pay Now $25</a>
                            </div>
                        </div>
                        <!-- Referral Program Section -->
                        <div class="referral-section position-relative py-5 col-lg-10 col-sm-12">
                            <div class="container">
                                <div class="text-center">

                                    <h2 class="sec-title mb-3" data-aos="fade-up">PROFXSPORTSCLUB Referral Program</h2>
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <!-- Heading -->


                                    <!-- Intro -->
                                    <div class="intro-box mb-4">
                                        <p>
                                            Turn your network into an opportunity! Invite friends, fellow traders, or your
                                            community to join the PROFXSPORTSCLUB using your unique referral link and earn
                                            commissions at three levels:

                                        </p>
                                    </div>

                                    <!-- How it Works -->
                                    <h5 class="theme-text mb-3">How It Works</h5>
                                    <div class="step-card mb-4">
                                        <ul>
                                            <li><span class="theme-text">Level 1:</span> 10% from direct referrals</li>
                                            <li><span class="theme-text">Level 2:</span> 5% from their referrals</li>
                                            <li><span class="theme-text">Level 3:</span> 2.5% from extended network</li>
                                        </ul>
                                    </div>

                                    <ul class="why-join mb-4">
                                        <li> No limits - the more you refer, the more you earn
                                        </li>
                                        <li>Rewards are credited directly to your account
                                        </li>
                                        <li>Simple, transparent, and effective
                                        </li>
                                    </ul>

                                    <!-- Start Earning -->
                                    <h5 class="theme-text mb-2">Start Earning Today!</h5>
                                    <p class="text-light mb-4">
                                        Start sharing your referral link today and grow with the PROFXSPORTSCLUB community
                                    </p>

                                    <!--<a href="{{ url('/login') }}" class="th-btn th_btn">-->
                                    <!--    Login Now & Get Your Referral Code-->
                                    <!--</a>-->
                                </div>

                            </div>
                        </div>

                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
    <script>
        //     const tippyInst = tippy(document.querySelector('.clipbtn'));
        //     var clipbtn = new ClipboardJS(".clipbtn");
        //     clipbtn.on('success', function(e) {
        // 		alert('Test');
        //         tippyInst.setContent("Copied");
        //         tippyInst.show();
        //         e.clearSelection();
        //     });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script>
        // Initialize Tippy with manual trigger
        tippy('.clipbtn', {
            trigger: 'manual',
            placement: 'bottom',
        });

        // ClipboardJS
        var clipbtn = new ClipboardJS(".clipbtn");

        clipbtn.on('success', function(e) {
            let instance = e.trigger._tippy; // get Tippy instance for that button

            // Set tooltip text & show
            instance.setContent("Copied!");
            instance.show();

            // Reset after 1.5s
            setTimeout(() => {
                instance.setContent("Click to Copy");
                instance.hide();
            }, 1500);

            e.clearSelection();
        });

        clipbtn.on('error', function(e) {
            let instance = e.trigger._tippy;
            instance.setContent("Failed!");
            instance.show();
            setTimeout(() => {
                instance.setContent("Click to Copy");
                instance.hide();
            }, 1500);
        });
    </script>
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
