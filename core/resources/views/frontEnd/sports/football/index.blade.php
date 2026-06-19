@extends('frontEnd.sports.football.layouts.master')

@section('content')
    <!--slider wrapper start-->
    <div class="slider-area">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="carousel-captions caption-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper">

                                        <h3 data-animation="animated fadeInUp">intro</h3>
                                        <h2 data-animation="animated fadeInUp"> <span class="e1"
                                                data-animation="animated fadeInUp">f</span> <span class="e2"
                                                data-animation="animated fadeInUp">o </span><span class="e3"
                                                data-animation="animated fadeInUp">o </span> <span class="e4"
                                                data-animation="animated fadeInUp">t</span><span class="e5"
                                                data-animation="animated fadeInUp">b</span><span class="e6"
                                                data-animation="animated fadeInUp">a</span><span class="e7"
                                                data-animation="animated fadeInUp">l</span><span class="e8"
                                                data-animation="animated fadeInUp">l</span></h2>

                                        <h4 data-animation="animated fadeInUp">Now Your Are<br>
                                            Challange</h4>
                                        <div class="slider_ring">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/ring.png') }}" alt="img">
                                        </div>
                                        <div class="slider_ring1">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/ring1.png') }}" alt="img">
                                        </div>
                                        <div class="slider_ball_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/slider_img.png') }}" alt="img">
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class=" carousel-captions caption-2">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper">

                                        <h3 data-animation="animated fadeInUp">intro</h3>
                                        <h2 data-animation="animated fadeInUp"> <span class="e1"
                                                data-animation="animated fadeInUp">f</span> <span class="e2"
                                                data-animation="animated fadeInUp">o </span><span class="e3"
                                                data-animation="animated fadeInUp">o </span> <span class="e4"
                                                data-animation="animated fadeInUp">t</span><span class="e5"
                                                data-animation="animated fadeInUp">b</span><span class="e6"
                                                data-animation="animated fadeInUp">a</span><span class="e7"
                                                data-animation="animated fadeInUp">l</span><span class="e8"
                                                data-animation="animated fadeInUp">l</span></h2>

                                        <h4 data-animation="animated fadeInUp">Now Your Are<br>
                                            Challange</h4>
                                        <div class="slider_ring">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/ring.png') }}" alt="img">
                                        </div>
                                        <div class="slider_ring1">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/ring1.png') }}" alt="img">
                                        </div>
                                        <div class="slider_ball_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/slider_img1.png') }}" alt="img">
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"><span
                            class="number"></span>
                    </li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""><span class="number"></span>
                    </li>

                </ol>
                <div class="carousel-nevigation">
                    <a class="prev" href="#carousel-example-generic" role="button" data-slide="prev"> <i
                            class="flaticon-up-arrow"></i>
                        <br> <span>01</span>
                    </a>
                    <a class="next" href="#carousel-example-generic" role="button" data-slide="next"> <i
                            class="flaticon-download-arrow"></i>
                        <br> <span>02</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
	
	
	<!-- Next Match wrapper start-->

    <div class="ticket_slider float_left">
        <div class="container">
            <div class="next_match_wrapper float_left">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                        <div class="next_match_count float_left hvr-wobble-horizontal">
                            <h2>Next Match</h2>
                            <div id="clockdiv">
                                <div><span class="days"></span>
                                    <div class="smalltext">Days</div>
                                </div>
                                <div><span class="hours"></span>
                                    <div class="smalltext">Hours</div>
                                </div>
                                <div><span class="minutes"></span>
                                    <div class="smalltext">Minutes</div>
                                </div>
                                <div><span class="seconds"></span>
                                    <div class="smalltext">Seconds</div>
                                </div>
                            </div>
                            <div class="next_match_venue float_left">
                                <p>Mon, Oct 21, Youth League</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="upcoming_matches_wrapper float_left hvr-wobble-horizontal">
                            <div class="row">

                                <div class="col-md-4 col-sm-4 col-4">
                                    <div class="match_list_wrapper as">
                                        <div class="match_list_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/team1.png') }}" class="img-responsive" alt="logo">
                                            <h4>LEYON germain</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4">

                                    <div class="new">
                                        <a href="#">
                                            <span>VS</span>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-4 col-4">
                                    <div class="match_list_wrapper ac">
                                        <div class="match_list_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/football/images/team2.png') }}" class="img-responsive" alt="logo">
                                            <h4>BAYERN GEORGE </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="hs_btn_wrapper match_btn">
                                    <ul>
                                        <li><a href="#">buy ticket</a></li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Next Match wrapper end-->
    <!--upcoming games wrapper start-->
    <div class="upcoming_games_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ft_left_heading_wraper head1">
                        <h1>upcoming games</h1>

                    </div>
                </div>

                <!-- slider start -->
                <div class="col-md-12">
                    <div class="upcoming_slider_wrapper">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="game1_slider_wrapper float_left hvr-wobble-horizontal">
                                    <div class="game_slider_wrapper">
                                        <div class="game_1">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm1.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>LEYON</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="game_2">

                                            <div class="new new_2">
                                                <a href="#">
                                                    <span>VS</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="game_3">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm2.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>psg</h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="game_btm_cntnt float_left">
                                        <p>thu, 21 may - 01:00 PM</p>
                                        <a href="#">buy ticket<i class="flaticon-up-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="game1_slider_wrapper float_left hvr-wobble-horizontal">
                                    <div class="game_slider_wrapper">
                                        <div class="game_1">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm3.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>bayern</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="game_2">

                                            <div class="new new_2">
                                                <a href="#">
                                                    <span>VS</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="game_3">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm5.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>psg</h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="game_btm_cntnt float_left">
                                        <p>fri, 22 may - 01:00 PM</p>
                                        <a href="#">buy ticket<i class="flaticon-up-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="game1_slider_wrapper float_left hvr-wobble-horizontal">
                                    <div class="game_slider_wrapper">
                                        <div class="game_1">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm1.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>LEYON</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="game_2">

                                            <div class="new new_2">
                                                <a href="#">
                                                    <span>VS</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="game_3">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm6.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>paris</h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="game_btm_cntnt float_left">
                                        <p>sat, 23 may - 01:00 PM</p>
                                        <a href="#">buy ticket<i class="flaticon-up-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="game1_slider_wrapper float_left hvr-wobble-horizontal">
                                    <div class="game_slider_wrapper">
                                        <div class="game_1">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm2.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>LEYON</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="game_2">

                                            <div class="new new_2">
                                                <a href="#">
                                                    <span>VS</span>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="game_3">
                                            <div class="match_list_wrapper">
                                                <div class="match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/football/images/gm3.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>psg</h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="game_btm_cntnt float_left">
                                        <p>thu, 21 may - 01:00 PM</p>
                                        <a href="#">buy ticket<i class="flaticon-up-arrow"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--upcoming games wrapper end-->
	
	<!--gallery wrapper start-->
    <div class="portfolio_grid float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ft_left_heading_wraper center_heading">
                        <h1>media gallery</h1>

                    </div>

                    <ul class="protfoli_filter">
                        <li class="active" data-filter="*"><a href="#">show all</a></li>
                        <li data-filter=".dribbble"><a href="#">water sports</a></li>
                        <li data-filter=".behance"><a href="#">football</a></li>
                        <li data-filter=".website"><a href="#">shoes</a></li>
                        <li data-filter=".design"><a href="#">player</a></li>
                        <li data-filter=".ux_ui"><a href="#">stadium</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row portfoli_inner pi_3">
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 dribbble website ux_ui">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic1.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic1.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 behance website design">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic2.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic2.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 dribbble design ux_ui">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic3.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic3.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 dribbble behance website">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic4.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic4.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 behance website design ux_ui">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic5.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic5.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 dribbble behance design website">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic6.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic6.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 website design ux_ui behance">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic7.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic7.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Items -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 p-0 dribbble behance ux_ui ">
                <div class="portfolio_item">
                    <img src="{{ URL::asset('assets/frontend/sports/football/images/pic8.jpg') }}" alt="">
                    <div class="portfolio_hover">
                        <a href="#">the final championship<span>football, match</span></a>
                        <div class="zoom_popup">
                            <a class="img-link" href="{{ URL::asset('assets/frontend/sports/football/images/pic8.jpg') }}"> <i class="flaticon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--gallery wrapper end-->
    <!-- counter wrapper start-->
    <div class="counter_section float_left">
        <div class="counter-section">
            <div class="container text-center">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="counter_cntnt_box">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="fa fa-star-o"></i></a>
                                </div>
                            </div>
                            <div class="count-description"><span class="timer">230</span>+
                                <h5 class="con1"> Matches Played</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="counter_cntnt_box">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="fa fa-futbol-o"></i></a>
                                </div>
                            </div>
                            <div class="count-description"> <span class="timer">89</span>+
                                <h5 class="con2">Touchdowns</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="counter_cntnt_box">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="fa fa-users"></i></a>
                                </div>
                            </div>
                            <div class="count-description"> <span class="timer">60</span>+
                                <h5 class="con2">team members</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="counter_cntnt_box">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="flaticon-trophy"></i></a>
                                </div>
                            </div>
                            <div class="count-description"> <span class="timer">27</span>+
                                <h5 class="con4">awards won</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- counter wrapper end-->
    <!-- bx slider wrapperStart -->
    <div class="bx_slider_wrapper float_left">

        <div class="wrap-album-slider">
            <ul class="album-slider">
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">18</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx1.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">19</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx2.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">20</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx3.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">21</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx4.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">22</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx5.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">23</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx6.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>
                <!-- End album slider item -->
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <h1 class="bx_slider_text">24</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/football/images/bx7.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper match_btn slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view profile</a></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- End album body -->
                    </figure>
                    <!-- End album -->
                </li>

            </ul>
        </div>
    </div>

    <!-- bx slider Wrapper end -->
	
	
	<!-- latest result wrapper start-->
    <div class="latest_result_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ft_left_heading_wraper">
                        <h1>latest result</h1>

                    </div>
                </div>
                <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12 col-12">
                    <div class="upcoming_matches_wrapper float_left ft_main_wraspper">
                        <div class="row">

                            <div class="col-md-3 col-sm-12 col-12">
                                <div class="match_list_wrapper as">
                                    <div class="match_list_img">
                                        <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm1.png') }}" class="img-responsive" alt="logo">
                                        <h4>leyon</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="latest_match_box float_left ft_result_wrapper">
                                    <p class="ft_result">1 - 4</p>
                                    <h1>Friday 3rd March 2017</h1>
                                    <h2>Dubai International Cricket Stadium, Dubai</h2>
                                    <h3> leyon and german win 5-4 on penalties.    </h3>
                                 
                                </div>

                            </div>
                            <div class="col-md-3 col-sm-12 col-12">
                                <div class="match_list_wrapper match_wraper_2">
                                    <div class="match_list_img">
                                        <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm2.png') }}" class="img-responsive" alt="logo">
                                        <h4>german</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- latest result wrapper end-->
    <!-- result wrapper start -->
    <div class="latest_result_wrappwer float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ft_left_heading_wraper">
                        <h1>results</h1>

                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="table_next_race result_match_wrapper overflow-scroll ft_table_cntnt">
                        <table>
                            <tr>
                                <th>date</th>
                                <th>teams</th>
                                <th>score</th>
                                <th>won</th>
                                <th>venue</th>

                            </tr>
                            <tr>
                                <td>12/4/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm1.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> Lions</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                            <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> Wolf</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm3.png') }}" alt="img">
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                        </div></td>
                                <td>2-6</td>
                                <td>lions win</td>
                                <td>Expo Arena</td>

                            </tr>
                            <tr>
                                <td>17/4/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm3.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> psg</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                            <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> Wolf</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm2.png') }}" alt="img">
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                        </div></td>
                                <td>1-2</td>
                                <td>psg win</td>
								  <td>Django Stadium</td>

                            </tr>
                            <tr>
                                <td>22/5/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm5.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> sydeny</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                             <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> berone</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm5.png') }}" alt="img">
                                                </div>
                                            </div>
                                        </div></td>
                                <td>3-6</td>
                                <td>berone win</td>
								 <td>dhaka Stadium</td>
                            </tr>
                            <tr>
                                <td>12/6/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm4.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> slovan</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                             <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> Wolf</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm2.png') }}" alt="img">
                                                </div>
                                                </div>
                                            </div></td>
                                <td>5-1</td>
                                <td>slovan win</td>
								 <td>USWE Stadium</td>
                            </tr>
                            <tr>
                                <td>23/6/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm3.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> beron</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                            <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> italy</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm1.png') }}" alt="img">
                                                </div>
                                                </div>
                                            </div></td>
                                <td>5-3</td>
                                <td>italy win</td>
								 <td>indore Stadium</td>
                            </tr>
                           <tr>
                                <td>2/7/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm5.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> africa</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                            <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> german</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm4.png') }}" alt="img">
                                                </div>
                                                </div>
                                            </div></td>
                                <td>2-3</td>
                                <td>german win</td>
								 <td>arena Stadium</td>
                            </tr>
                            <tr>
                                <td>4/8/2024</td>
                                <td><div class="tb-opponanet-contant">
                                            <!--Team 1 Start-->
                                            <div class="tb-team-1">
                                                <div class="team-logo">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm1.png') }}" alt="img">
                                                </div>
                                                <div class="text">
                                                    <h6><a href="#"> africa</a></h6>
                                                </div>
                                            </div>
                                            <!--Team 1 End-->
                                            <div class="tb-opponanet">
                                                <h6>VS</h6>
                                            </div>
                                            <!--Team 2 Start-->
                                             <div class="tb-team-2">
                                                <div class="text txt22">
                                                    <h6><a href="#"> leyon</a></h6>
                                                </div>
                                                <div class="team-logo lohoww">
                                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/gm3.png') }}" alt="img">
                                                </div>
                                                </div>
                                            </div></td>
                                <td>1-3</td>
                                <td>africa win</td>
								 <td>dhaka Stadium</td>
                            </tr>                     
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- result wrapper end -->
    <!--trophy wrapper start-->
    <div class="trophy_wrapper float_left">
        <div class="dream_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- slider start -->
                <div class="col-md-12">
                    <div class="trophy_slider">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="trophyslider_wrapper float_left">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/tp1.png') }}" alt="img" class="img-responsive">
                                    <p>2020</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="trophyslider_wrapper float_left">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/tp2.png') }}" alt="img" class="img-responsive">
                                    <p>2020-2021</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="trophyslider_wrapper float_left">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/tp3.png') }}" alt="img" class="img-responsive">
                                    <p>2022</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="trophyslider_wrapper float_left">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/tp4.png') }}" alt="img" class="img-responsive">
                                    <p>2024</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--trophy wrapper end-->
    <!--patner slider Start -->
    <div class="patner_main_section_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="pn_slider_wraper">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="pn_img_wrapper">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/logo01.png') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="pn_img_wrapper">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/logo02.png') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="pn_img_wrapper">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/logo03.png') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="pn_img_wrapper">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/logo04.png') }}" alt="patner_img">
                                </div>
                            </div>
                            <div class="item">
                                <div class="pn_img_wrapper">
                                    <img src="{{ URL::asset('assets/frontend/sports/common/images/inner/logo05.png') }}" alt="patner_img">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prs patner slider End -->
	
	
	
	
@endsection