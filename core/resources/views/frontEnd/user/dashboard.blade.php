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
        .c-dashboard-group .c-dashboardInfo:nth-child(2) .wrap:after {
            background: linear-gradient(82.59deg, #ffda00 0%, #00a173 100%) !important;
        }
        }
    </style>
    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
                @include('frontEnd.user.usermenu')
                <div class="col-lg-10 col-sm-12">

                    <div class="row align-items-stretch c-dashboard-group m-3">
                        <div class="col-lg-12">
                            <h2 class="widget_title">Welcome back <span class="text-theme">{{ auth()->user()->name }}</span>
                                !</h2>
                        </div>
                        @php
                            $hasPaid = auth()->user()->register_pay ?? false; // Replace with your actual payment check
                        @endphp
                        {{-- @if (!$hasPaid) --}}
                        @if (auth()->user()->payment_status == 0)
                            <div class="col-lg-12 col-sm-12 mb-5">
                                <div class="text-center tournament-card d-grid pt-4 pb-4">
                                    <h5 class="text-white text-center">Get ready to trade and Earn! Activate your
                                        ProFxLeague account with $25 and start referring.</h5>
                                    <div class="tournament-card-meta d-flex justify-content-center">
                                        <a type="button" href="{{ route('user.choosepayment', 'register') }}"
                                            class="th-btn th_btn style2" style="min-width:100px">Pay Now $25</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- @endif --}}
                    </div>
                    <div class="row align-items-stretch c-dashboard-group m-3 mb-5">
                        <div class="c-dashboardInfo col-lg-3 col-md-6 ">
                            <div class="wrap" style="background-color: #45F882; color:#fff;">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title text-white">
                                    Overall Rank
                                    <svg class="MuiSvgIcon-root-19 text-white" focusable="false" data-tippy-placement="top"
                                        data-tippy-arrow="true" data-tippy-content="Once League" viewBox="0 0 24 24"
                                        aria-hidden="true" role="presentation">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                        </path>
                                    </svg>
                                </h4><span class="hind-font caption-12 c-dashboardInfo__count">{{ $overallRank }}</span>
                            </div>
                        </div>
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                    Reward Balance
                                    <svg class="MuiSvgIcon-root-19" focusable="false" data-tippy-placement="top"
                                        data-tippy-arrow="true" data-tippy-content="ProFX Wallet Transactions"
                                        viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                        </path>
                                    </svg>
                                </h4><span
                                    class="hind-font caption-12 c-dashboardInfo__count">${{ $availableWallet['reward_balance'] }}</span>
                            </div>
                        </div>

                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                    Referral Bonus<svg class="MuiSvgIcon-root-19" data-tippy-placement="bottom"
                                        data-tippy-arrow="true"
                                        data-tippy-content="From Referral Registration & transactions upto now"
                                        focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                        </path>
                                    </svg></h4><span
                                    class="hind-font caption-12 c-dashboardInfo__count">${{ $availableWallet['referral_balance'] }}</span>
                            </div>
                        </div>
                        <div class="c-dashboardInfo col-lg-3 col-md-6">
                            <div class="wrap">
                                <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">
                                    Wallet Balance<svg class="MuiSvgIcon-root-19" focusable="false"
                                        data-tippy-placement="bottom" data-tippy-arrow="true"
                                        data-tippy-content="Current Wallet Balance" viewBox="0 0 24 24" aria-hidden="true"
                                        role="presentation">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                        </path>
                                    </svg></h4><span
                                    class="hind-font caption-12 c-dashboardInfo__count">${{ $availableWallet['balance'] }}</span>
                            </div>
                        </div>
                    </div>


                    <section class="row mt-lg-4 mt-3 mb-5">
                        <div class="col-lg-6">
                            <div id="chartContainer" style="min-height: 370px; height: 100%; width: 100%;"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="swiper th-slider game-slider-1" id="gameSlider1"
                                data-slider-options='{"autoplay":{"delay": 2500,"disableOnInteraction": false},"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <!--<a href="/paynow" class="pay_now_classes"><img src="{{ URL::to('uploads/announcement/profx_club.png') }}" alt="ProFx Club"></a>-->
                                            <a href="/paynow" class="pay_now_classes"><img
                                                    src="{{ URL::to('uploads/announcement/12.png') }}" alt="ProFx Club"></a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <a href="/paynow" class="pay_now_classes"><img
                                                    src="{{ URL::to('uploads/announcement/13.png') }}"
                                                    alt="Referral Program"></a>
                                        </div>
                                    </div>
                                    <!--<div class="swiper-slide">-->
                                    <!--	<div class="item">-->
                                    <!--		<a href="/paynow" class="pay_now_classes"><img src="{{ URL::to('uploads/announcement/start.png') }}" alt="First slide"></a>-->
                                    <!--	</div>-->
                                    <!--</div>-->
                                </div>
                                <div class="slider-pagination"></div>
                            </div>
                        </div>
                    </section>

                    <section class="row mt-lg-4 mt-3 mb-5">
                        <div class="col-lg-12">
                            <div class="bg-dark gradient-border">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Latest Announcements / Notifications</h5>
                                    <div class="card-text announcement-content">


                                        <ul class="list-unstyled">
                                            <li class="alert alert-success">Upcoming league: Bull VS Bear starts on
                                                Sep 10th, 2025.
                                            </li>
                                            <li class="alert alert-info">Join the PROFXSPORTSCLUB today and get free
                                                subscriptions included with membership of PROFX Club.
                                            </li>
                                            <li class="alert alert-warning">Registration for online PROFXSPORTSCLUB Started
                                                from 26 Aug 2025.
                                            </li>
                                            <!--<li class="alert alert-warning">Become the next millionaire by leveling-->
                                            <!--	up your hustle and dominating the league.-->
                                            <!--</li>-->
                                            <li class="alert alert-warning">Stay updated with our latest blog posts
                                                on forex trading and more.</li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('user.dashboard') }}"
                                        class="tab-btn th-btn float-end pt-3 pb-3 mt-5">View More</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
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
    <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
    <script>
        //Create Chart
        var chart = new CanvasJS.Chart("chartContainer", {
            //Chart Options - Check https://canvasjs.com/docs/charts/chart-options/
            backgroundColor: "transparent",
            color: "white",
            title: {
                text: "ProFx - League Leader Score",
                fontColor: "#fff",
                fontSize: 25,
            },
            axisX: {
                title: "Rounds",
                fontColor: "#fff",
                // valueFormatString: "MMM"
                titleFontColor: "#fff",
                labelFontColor: "#fff"
            },
            axisY: {
                title: "Rank",
                prefix: "#",
                reversed: true,
                fontColor: "#fff",
                titleFontColor: "#fff",
                labelFontColor: "#fff"
            },
            data: [{
                type: "spline",
                color: "#45F882",
                dataPoints: [{
                        label: "1",
                        legendMarkerColor: "#fff",
                        y: 10,
                        color: "#fff"
                    },
                    {
                        label: "2",
                        legendMarkerColor: "#fff",
                        y: 15,
                        color: "#fff"
                    },
                    {
                        label: "3",
                        legendMarkerColor: "#fff",
                        y: 25,
                        color: "#fff"
                    },
                    {
                        label: "4",
                        legendMarkerColor: "#fff",
                        y: 30,
                        color: "#fff"
                    },
                    {
                        label: "5",
                        legendMarkerColor: "#fff",
                        y: 28,
                        color: "#fff"
                    }
                ]
            }]
        });
        //Render Chart
        chart.render();
        // var chart = new CanvasJS.Chart("chartContainer", options);
        // new CanvasJS.Chart("#chartContainer", options);
    </script>
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
