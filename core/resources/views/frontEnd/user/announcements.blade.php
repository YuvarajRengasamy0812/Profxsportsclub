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

    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">

        <div class="container">
            <div class="row">
                <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
                @include('frontEnd.user.usermenu')
                <div class="col-lg-10 col-sm-12">
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
                                    <!--<a href="{{ route('user.dashboard') }}" class="tab-btn th-btn float-end pt-3 pb-3">View More</a>-->
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
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
