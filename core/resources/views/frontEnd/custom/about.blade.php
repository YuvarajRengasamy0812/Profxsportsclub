@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
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
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $pagetitle }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
                    <li class="active">{{ $pagetitle }}</li>
                </ul>
            </div>
        </div>
    </div>

	<div class="overflow-hidden space position-relative z-index-common whole-area">
        <div class="gr-bg1 overlay"></div>
        <div class="container ">
            {!! @$aboutsection1->$details_var !!}

            <div class="row about-sticky-wrap">
                {{-- left content --}}
                <div class="col-xl-7 mb-50 mb-xl-0 about-sticky-left">
                    <div class="img-box2">
                        <div class="img1">
                            <img fetchpriority="high" decoding="async" width="641" height="537"
                                src="{{ URL::to('uploads/topics/' . $aboutsection1->photo_file) }}"
                                class="attachment-full size-full wp-image-615" alt=""
                                sizes="(max-width: 641px) 100vw, 641px" style="border-radius: 2%;"/>
                        </div>
                    </div>
                </div>

                {{-- right content --}}
                <div class="col-xl-5 about-sticky-right">
                    <div class="about-feature-wrap">
                        <div class="slider-area">
                            <div class="about-feature-slider1" id="aboutfeature1">
                                <div class="swiper-wrapper d-grid">
                                    @foreach ($aboutSlidercon as $aboutcon)
                                        <?php
                                        if ($aboutcon->$title_var != '') {
                                            $titlecon = $aboutcon->$title_var;
                                        } else {
                                            $titlecon = $aboutcon->$title_var2;
                                        }
                                        if ($aboutcon->$details_var != '') {
                                            $detailscon = $details_var;
                                        } else {
                                            $detailscon = $details_var2;
                                        }
                                        ?>
                                        <div class="swiper-slide mb-3">
                                            <div class="about-feature">
                                                <div class="about-feature-icon icon-masking">
                                                    <span class="mask-icon"
                                                        data-mask-src="{{ URL::to('uploads/topics/' . $aboutcon->photo_file) }}"></span>
                                                    <img decoding="async"
                                                        src="{{ URL::to('uploads/topics/' . $aboutcon->photo_file) }}"
                                                        alt="Icon">
                                                </div>
                                                <div class="about-feature-content">
                                                    <h3 class="about-feature-title title">{{ $titlecon }}</h3>
                                                    <p class="about-feature-text desc">{!! @$aboutcon->$details_var !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
    {{-- integrate your custom css code/files here --}}
    <style>
        /* ===== Allow sticky to work: prevent parent clipping ===== */
        .whole-area {
            position: relative;
            padding: 80px 0 120px;
            overflow: clip !important;
            /* new spec: same as hidden, but doesn't block sticky */
        }


        /* ensure page content sits above overlay */
        .whole-area>.container {
            position: relative;
            z-index: 2;
        }

        /* row so sticky has space */
        .about-sticky-wrap {
            align-items: flex-start;
            min-height: 100vh;
        }

        /* LEFT: sticky image */
        .about-sticky-left {
            position: -webkit-sticky;
            position: sticky;
            top: 50%;
            transform: translateY(-10%) translateX(0);
            z-index: 3;
        }

        /* RIGHT: content box */
        .about-sticky-right {
            padding: 30px;
            z-index: 2;
            background: transparent!important;
            background-color: none !important;
        }

        /* -------- Responsive adjustments -------- */

        /* Below 1200px: disable sticky and stack naturally */
        @media (max-width: 1199.98px) {
            .about-sticky-wrap {
                display: block;
                min-height: auto;
            }

            .about-sticky-left {
                position: relative;
                top: auto;
                transform: none;
                margin-bottom: 10px;
            }

            .about-sticky-right {
                max-height: 70vh;
                overflow-y: auto;
            }
        }
    </style>
@endpush
@push('after-scripts')
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
