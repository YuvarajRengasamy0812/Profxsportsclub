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

    <!--==============================
        Breadcumb
    ============================== -->
    <div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
        <div class="container">
            <div class="breadcumb-content pb-0">
                <h1 class="breadcumb-title">{{ $pagetitle }}</h1>
                <!--<ul class="breadcumb-menu">-->
                <!--    <li><a href="{{ Helper::homeURL() }}">{{ __('backend.home') }}</a></li>-->
                <!--    <li class="active">{{ $pagetitle }}</li>-->
                <!--</ul>-->
                <h2 class="sec-title mt-3"><span style="color:#45f882!important">Online</span> League</h2>
            </div>
        </div>
    </div>


    <div class="overflow-hidden space position-relative z-index-common">
        <div class="gr-bg1 overlay"></div>
        <div class="container">
            <div class="point-table-area-1 overflow-hidden">
                <div class="container">
                    <div class="row align-items-center m-3">
                        <div
                            class="d-flex flex-wrap gap-3 justify-content-center  justify-content-lg-between align-items-center widget_title ">
                            <!-- Left side -->
                            <h4 class="sec-title m-0 p-0">
                                <!--(${{ $accounttypeval->ac_min_deposit }} Showdown)-->
                                PROFXSPORTSCLUB <span class="text-theme">{{ $latestleague->leagurTitle }} </span>
                            </h4>

                            <!-- Right side dropdown -->
                            <!--<div class="dropdown d-table p-0 m-0">
                                    <button class="btn dropdown-toggle action-button w-100" type="button" id="preLeagueDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pre League Weeks
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="preLeagueDropdown">
                                        @foreach ($leaguecatlist as $leagcat)
    <li><a class="dropdown-item" href="#">{{ $leagcat->leagurTitle }}</a></li>
    @endforeach
                                    </ul>
                                </div>-->
                        </div>


                        <div id="leaderboard-section">
                            @include('frontEnd.user.leaderboard-table', [
                                'liveaccountData' => $liveaccountData,
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('frontEnd.homepage.counter')

    @include('frontEnd.homepage.upcomingevents')

    @include('frontEnd.homepage.aboutsectioncon')

    @include('frontEnd.homepage.partners')
@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    <style>
        @media (max-width: 1000px) {
            .fontSize {
                font-size: 1rem !important;
            }
        }


        /* Base pagination wrapper */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        /* Apply th-btn style to Laravel pagination links */
        .pagination .page-item .page-link {
            position: relative;
            z-index: 2;
            overflow: hidden;
            vertical-align: middle;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            text-align: center;
            background-color: var(--theme-color);
            color: var(--title-color) !important;
            font-family: var(--title-font);
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            padding: 10px 18px;
            /* smaller than your main .th-btn */
            min-width: 50px;
            /* ensures consistency */
            border-radius: 0;
            clip-path: polygon(10px 0%, calc(100% - 10px) 0%, 100% 50%, calc(100% - 10px) 100%, 10px 100%, 0% 50%);
            transition: 0.2s;
            margin: 0 3px;
        }

        /* Before/After pseudo styles */
        .pagination .page-item .page-link:before,
        .pagination .page-item .page-link:after {
            content: "";
            position: absolute;
            background-color: var(--title-color);
            z-index: -1;
            transition: all 0.4s ease-out;
            top: 3px;
            left: 3px;
            width: 10px;
            height: calc(100% - 6px);
            clip-path: polygon(85% 0, 100% 0, 15% 50%, 100% 100%, 85% 100%, 0% 50%);
        }

        .pagination .page-item .page-link:after {
            right: 3px;
            left: auto;
            transform: rotate(180deg);
        }

        /* Hover & active */
        .pagination .page-item .page-link:hover,
        .pagination .page-item.active .page-link {
            background: var(--white-color) !important;
            clip-path: polygon(0px 0%, 100% 0%, 100% 50%, 100% 100%, 0 100%, 0% 50%) !important;
            color: var(--title-color) !important;
        }

        .pagination .page-item .page-link:hover:before,
        .pagination .page-item .page-link:hover:after,
        .pagination .page-item.active .page-link:before,
        .pagination .page-item.active .page-link:after {
            clip-path: polygon(2px 60%, 2px calc(100% - 2px), 100% calc(100% - 0px), 100% 100%, 0 100%, 0 100%);
        }

        /* Disable state */
        .pagination .page-item.disabled .page-link {
            background-color: #e5e5e5;
            color: #999 !important;
            cursor: not-allowed;
        }

        .action-button {
            background: none;
            border: 1px solid #45f882;
            color: #fff;
            border-radius: 8px;
            padding: 8px 14px;
            font-weight: 500;
        }

        /* Hover and focus effect for button */
        .action-button:hover,
        .action-button:focus {
            background-color: rgba(69, 248, 130, 0.15);
            color: #fff;
            outline: none;
            box-shadow: none;
        }

        .dropdown-menu {
            border-radius: 10px;
            overflow: hidden;
            min-width: 180px;
            background-color: #0c0a0b;
        }

        /* Dropdown item hover and focus */
        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item:active {
            background-color: #45f882 !important;
            color: #ffffff !important;
            outline: none !important;
            box-shadow: none !important;
        }


        /* Remove active/focus background on click */
        .dropdown-item:active {
            background-color: #45f882;
            color: #fff !important;
        }
    </style>
    <style>
        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
    <script>
        function refreshLeaderboard() {
            $.get("{{ route('user.leaderboard') }}", function(data) {
                $("#leaderboard-section").html(data);
            });
        }

        <?php if ($showLeague->price_distribute == 0) { ?>
        // Refresh every 5 seconds
        setInterval(refreshLeaderboard, 2000);
        <?php } ?>
    </script>
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
