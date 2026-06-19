@extends('frontEnd.layouts.master')

@section('content')

@php
    $title = request('title') ?? 'Event Details';
    $name = request('name') ?? 'Event';
    $type = request('type') ?? '';
    $location = request('location') ?? '';
    $date = request('date') ?? '';
    $slots = request('slots') ?? '';
    $cap = request('cap') ?? '';
    $image = request('image') ?? asset('assets/images/resource/event-12.jpg');
    $bg = request('bg') ?? asset('assets/images/resource/event-12.jpg');

@endphp

<div class="boxed_wrapper ltr">

    <!-- page-title -->
    <section class="page-title centred pt_190 pb_190">
        <div class="bg-layer" style="background-image: url('{{ asset('assets/frontend/images/players/all article page.png') }}');background-position:inherit;"></div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $title }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">{{ $name }}</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- event-details -->
    <section class="event-details pt_150 pb_150">
        <div class="auto-container">
            <figure class="big-image mb_70">
                <img src="{{ $bg }}" alt="{{ $title }}" style="width:100%; max-height:500px; object-fit:inherit;">
            </figure>

            <div class="row clearfix">
                <!-- Main Content -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="event-details-content mr_20">
                        <div class="content-one">
                            <ul class="post-info">
                                <li><i class="icon-17"></i>{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</li>
                                <li><i class="icon-3"></i>{{ $location }}</li>
                                <li><i class="icon-3"></i>{{ $type }}</li>
                            </ul>

                            <h2>{{ $title }}</h2>

                            <div class="text-box mb_60">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac vestibulum arcu. Morbi vitae dui ac leo bibendum pretium.</p>
                                <p>Proin sit amet massa nec nulla bibendum luctus. Vivamus a luctus justo. Fusce feugiat velit sit amet libero ullamcorper, at tincidunt lorem gravida.</p>
                            </div>

                            <div class="image-box">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                        <figure class="image mb_60"><img src="{{ $image }}" alt="" style="width:100%;"></figure>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                        <figure class="image mb_60"><img src="assets/images/resource/event-14.jpg" alt="" style="width:100%;"></figure>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-two">
                            <div class="text-box mb_60">
                                <h3>Activities and Features:</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel leo sit amet sapien gravida pharetra vel non sapien. Etiam nec tincidunt purus.</p>
                                <p>Praesent sit amet mauris vel metus lacinia malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec commodo metus a leo malesuada, non fermentum sapien scelerisque.</p>
                            </div>

                            <div class="map-inner">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14369.811367795328!2d55.9762389!3d25.7886304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ef677493230cdbf%3A0x7ec0eb41aebcca90!2sRAKEZ!5e0!3m2!1sen!2sae!4v1720102380640!5m2!1sen!2sae" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="event-sidebar">

                        <!-- Event Details -->
                        <div class="event-info sidebar-widget">
                            <div class="widget-title">
                                <h3>Event Details</h3>
                            </div>
                            <ul class="info-list clearfix">
                                <li><span>Organizer :</span> Devid Rock</li>
                                <li><span>Date :</span> {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</li>
                                <li><span>Slots :</span> {{ $slots }}/{{ $cap }}</li>
                                <li><span>Type :</span> {{ $type }}</li>
                                <li><span>Location :</span> {{ $location }}</li>
                            </ul>
                        </div>

                        <!-- Event Venue -->
                        <div class="event-venue sidebar-widget">
                            <div class="widget-title">
                                <h3>Event Venue</h3>
                            </div>
                            <ul class="info-list clearfix">
                                <li><span>Venue :</span> {{ $location }}</li>
                                <li><span>Address :</span>Business Center 03</li>
                                <li><span>E-mail :</span> <a href="mailto: info@profxsportsclub.com">info@profxsports.com</a></li>
                                <li><span>Phone :</span> <a href="tel:+971588845033">971 58 884 5033</a></li>
                                <li><span>Website :</span> <a href="#">www.profxsports.com</a></li>
                            </ul>
                        </div>

                        <!-- Contact Form -->
                        <div class="form-inner">
                            <div class="widget-title">
                                <h3>Contact</h3>
                            </div>
                            <form method="post" action="#">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <div class="select-box">
                                        <select class="wide">
                                            <option data-display="Select Event">Select Event</option>
                                            <option value="1">{{ $title }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group message-btn pt_20">
                                    <button type="submit" class="theme-btn btn-one">Send now</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event-details end -->

    <!-- cta-section -->
    <!--<section class="cta-section alternat-2 centred bg-color-2 pt_140 pb_150">-->
    <!--    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-14.png);"></div>-->
    <!--    <div class="auto-container">-->
    <!--        <div class="content-box">-->
    <!--            <div class="sec-title light mb_40">-->
    <!--                <span class="sub-title">Our Facilities</span>-->
    <!--                <h2>Take Your Game To The <br />Next Level.</h2>-->
    <!--            </div>-->
    <!--            <div class="btn-box">-->
    <!--                <a href="signup.html" class="theme-btn btn-one">Become a Member</a>-->
    <!--                <a href="contact.html" class="theme-btn btn-two">Contact Us</a>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- cta-section end -->

</div>

@endsection
