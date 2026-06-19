
@extends('frontEnd.layouts.master')

@section('content')
@php
    $title = request('title') ?? 'Event Details';
    $subheading = request('subheading') ?? 'Event';
    $author = request('author') ?? '';
    $readTime = request('readTime') ?? '';
    $date = request('date') ?? '';
    $introduction = request('introduction') ?? '';
    $section1title = request('section1title') ?? '';
    $section1content = request('section1content') ?? '';
  $section2title = request('section2title') ?? '';
    $section2content = request('section2content') ?? '';
      $section3title = request('section3title') ?? '';
    $section3content = request('section3content') ?? '';
    $image = request('image') ?? asset('assets/images/resource/event-12.jpg');
    $bg = request('bg') ?? asset('assets/images/resource/event-12.jpg');
  $tags = request('tags') ? explode(',', request('tags')) : [];
@endphp
<!-- page wrapper -->
<body>

    <div class="boxed_wrapper ltr">
        <!-- page-title -->
        <section class="page-title centred pt_190 pb_190">
            <div class="bg-layer" style="background-image: url('{{ asset('assets/frontend/images/players/all article page.png') }}');background-position:inherit;"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1>{{ $title }}</h1>
                    
                </div>
            </div>
        </section>
        <!-- page-title end -->
        <!-- sidebar-page-container -->
        <section class="sidebar-page-container pt_150 pb_150">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="blog-sidebar mr_30">
                            
                           
                            <div class="sidebar-widget post-widget mb_40">
                                <div class="widget-title mb_20">
                                    <h3>Latest News</h3>
                                </div>
                                <!--<div class="post-widget">-->
                                <!--    <div class="post">-->
                                <!--        <figure class="image-box"><a href="blog-details.html"><img src="{{ URL::asset('assets/frontend/images/author-2.png') }}" alt=""></a></figure>-->
                                <!--        <h4><a href="blog-details.html">Key Golf Gadgets for the Determined</a></h4>-->
                                <!--        <span class="post-date"><i class="icon-17"></i>20 Aug, 2024</span>-->
                                <!--    </div>-->
                                <!--    <div class="post">-->
                                <!--        <figure class="image-box"><a href="blog-details.html"><img src="{{ URL::asset('assets/frontend/images/author-2.png') }}" alt=""></a></figure>-->
                                <!--        <h4><a href="blog-details.html">Join our Club & Stay Updated</a></h4>-->
                                <!--        <span class="post-date"><i class="icon-17"></i>19 Aug, 2024</span>-->
                                <!--    </div>-->
                                <!--    <div class="post">-->
                                <!--        <figure class="image-box"><a href="blog-details.html"><img src="{{ URL::asset('assets/frontend/images/author-2.png') }}" alt=""></a></figure>-->
                                <!--        <h4><a href="blog-details.html">Golfing on a Budget Best Public Courses</a></h4>-->
                                <!--        <span class="post-date"><i class="icon-17"></i>18 Aug, 2024</span>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="post-widget">
    <div class="post">
        <figure class="image-box">
            <a href="#"><img src="{{ URL::asset('assets/frontend/images/players/event/smallbox/1.png') }}" alt="Call of Duty Warzone"></a>
        </figure>
        <h4><a href="#">{{ 'Call of Duty Warzone' }}</a></h4>
        <span class="post-date"><i class="icon-17"></i>14 Jan, 2026</span>
    </div>

    <div class="post">
        <figure class="image-box">
            <a href="#"><img src="{{ URL::asset('assets/frontend/images/players/event/smallbox/3.png') }}" alt="Call of Duty Warzone Dubai"></a>
        </figure>
        <h4><a href="#">{{ 'Call of Duty Warzone' }}</a></h4>
        <span class="post-date"><i class="icon-17"></i>03 Feb, 2026</span>
    </div>

    <div class="post">
        <figure class="image-box">
            <a href="#"><img src="{{ URL::asset('assets/frontend/images/players/event/smallbox/9.png') }}" alt="Cricket Derby"></a>
        </figure>
        <h4><a href="#">{{ 'Cricket Derby' }}</a></h4>
        <span class="post-date"><i class="icon-17"></i>25 Mar, 2026</span>
    </div>
</div>

                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="blog-details-content">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><img src="{{ $bg }}" alt="{{ $title }}"></figure>
                                        <span class="post-date">{{ $date }}</span>
                                    </div>
                                    <div class="lower-content">
                                        <span class="category">{{$subheading}}</span>
                                        <h2>{{$title}}</h2>
                                        <ul class="post-info">
                                            <li class="author">
                                                <div class="image"><img src="{{ URL::asset('assets/frontend/images/author-1.png') }}" alt=""></div>
                                                <a href="blog-details.html">{{$author}}</a>
                                            </li>
                                            <li><i class="icon-26"></i>{{$readTime}}</li>
                                        </ul>
                                       
                                        <div class="text-box">
                                            <!--<p class="mb_30">Delving into the minds of golf's greatest champions reveals a fascinating blend of skill, strategy, and mental fortitude that sets them apart on the fairways. Legends like Jack Nicklaus, Tiger Woods, and Arnold Palmer have demonstrated that mastering the game goes beyond physical prowess; it's about mental resilience and strategic thinking.</p>-->
                                            <!--<p class="mb_60">These icons have taught us that focus, patience, and a relentless drive for improvement are crucial for success. Their ability to visualize shots, maintain composure under pressure, and continuously adapt their strategies offers invaluable lessons for golfers of all levels.</p>-->
                                            <blockquote>
                                                <div class="icon-box"><img src="{{ URL::asset('assets/frontend/images/icon-6.png') }}" alt=""></div>
                                                <h4>{{$introduction}}</h4>
                                                <h3>{{$author}}</h3>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="content-one mb_55">
                                <h3 class="mb_25">{{$section1title}}</h3>
                                <p class="mb_25">{{$section1content}}</p>
                              
                            </div>
                            <div class="content-one mb_55">
                                <h3 class="mb_25">{{$section2title}}</h3>
                                <p class="mb_25">{{$section2content}}</p>
                               
                            </div>
                            <div class="content-two mb_60">
                                <h3 class="mb_25">{{$section3title}}</h3>
                                <p class="mb_25">{{$section3title}}</p>
                            </div>
                            <div class="post-share-option">
                                <ul class="post-tag clearfix">
    <li><h4>Tags:</h4></li>
    @foreach($tags as $tag)
        <li><a href="blog-details.html">{{ $tag }}</a></li>
    @endforeach
</ul>


                                <ul class="social-links clearfix">
                                    <li><h4>Share This:</h4></li>
                                    <li><a href="blog-details.html"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="blog-details.html"><i class="fab fa-pinterest-p"></i></a></li>
                                    <li><a href="blog-details.html"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection