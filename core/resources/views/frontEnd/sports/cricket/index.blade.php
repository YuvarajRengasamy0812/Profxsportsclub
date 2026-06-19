@extends('frontEnd.sports.cricket.layouts.master')

@section('content')
    <!--slider wrapper start-->
    <div class="slider-area">
        <div class="slider-area-overlay"></div>
        <div class="ft_shape_right">
            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/shape2.png') }}" alt="shape">
        </div>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="carousel-captions caption-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper">
                                        <div class="slider_ball_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/cricket_img.png') }}" alt="img">
                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper slider_cntent">

                                        <h2 data-animation="animated fadeInUp">For Who
                                            You Need
                                            More </h2>

                                        <div class="hs_btn_wrapper slider_btn" data-animation="animated fadeInUp">
                                            <ul>
                                                <li><a href="#">view more</a></li>
                                            </ul>
                                        </div>

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
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper">
                                        <div class="slider_ball_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/cricket_img.png') }}" alt="img">
                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper slider_cntent">

                                        <h2 data-animation="animated fadeInUp">For Who
                                            You Need
                                            More </h2>

                                        <div class="hs_btn_wrapper slider_btn" data-animation="animated fadeInUp">
                                            <ul>
                                                <li><a href="#">view more</a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class=" carousel-captions caption-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper">
                                        <div class="slider_ball_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/cricket_img.png') }}" alt="img">
                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                    <div class="content lr_banner_content_inner_wrapper slider_cntent">

                                        <h2 data-animation="animated fadeInUp">For Who
                                            You Need
                                            More </h2>

                                        <div class="hs_btn_wrapper slider_btn" data-animation="animated fadeInUp">
                                            <ul>
                                                <li><a href="#">view more</a></li>
                                            </ul>
                                        </div>

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
                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""><span class="number"></span>
                    </li>

                </ol>
                <div class="carousel-nevigation">
                    <a class="prev" href="#carousel-example-generic" role="button" data-slide="prev"> <i
                            class="flaticon-left-arrow"></i>

                    </a>
                    <a class="next" href="#carousel-example-generic" role="button" data-slide="next"> <i
                            class="flaticon-right-arrow"></i>

                    </a>
                </div>

            </div>
        </div>
        <div class="ft_shape_right_2">
            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/ball.png') }}" alt="shape">
        </div>
        <div class="text_effect">
            <h4><span>C</span>
                <span>r</span>
                <span>i</span>
                <span>c</span>
                <span>k</span>
                <span>e</span>
                <span>t</span>
            </h4>
        </div>
        <ul class="slider_social_icon">
            <li><a href="#"><i class="fa fa-facebook"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-twitter"></i></a>
            </li>
            <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            </li>
            <li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a> </li>
        </ul>
    </div>

    <!-- slider wrapper end -->
	
	
	<!-- Next Match wrapper start-->

    <div class="ticket_slider float_left">
        <div class="container">
            <div class="next_match_wrapper float_left">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="upcoming_matches_wrapper float_left">
                            <div class="row">

                                <div class="col-md-5 col-sm-5 col-4">
                                    <div class="match_list_wrapper as">
                                        <div class="match_list_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/team1.png') }}" class="img-responsive" alt="logo">
                                            <h4>australia</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-4">

                                    <div class="new">
                                        <a href="#">
                                            <span>VS</span>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-md-5 col-sm-5 col-4">
                                    <div class="match_list_wrapper match_wraper_2">
                                        <div class="match_list_img">
                                            <img src="{{ URL::asset('assets/frontend/sports/cricket/images/team2.png') }}" class="img-responsive" alt="logo">
                                            <h4>pakistan</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="next_match_count float_left">

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

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Next Match wrapper end-->
    <!--next match wrapper start-->
    <div class="upcoming_match_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_left title_center">
                        <h1>next match <img src="{{ URL::asset('assets/frontend/sports/cricket/images/heading_icon.png') }}" alt="icon"></h1>

                    </div>
                </div>
                <div class="col-xl-10 offset-xl-1 col-lg-12 col-sm-12 col-md-12 col-12">
                    <div class="upcoming_matches_slider">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="upcoming_matches_wrapper">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match1.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>ENGLAND</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="versus">

                                                <p>Dec 25, 2018 10:00</p>
                                                <h1>1 - 0</h1>
                                                <h2>world championship</h2>
                                                <div class="hs_btn_wrapper next_match_btn">
                                                    <ul>
                                                        <li><a href="#">buy ticket</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match2.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>pakistan </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.upcoming_matches_wrapper -->
                            </div>
                            <div class="item">
                                <div class="upcoming_matches_wrapper">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match3.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>australia</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="versus">

                                                <p>Apr 02, 2018 07:00</p>
                                                <h1>1 - 0</h1>
                                                <h2>world championship</h2>
                                                <div class="hs_btn_wrapper next_match_btn">
                                                    <ul>
                                                        <li><a href="#">buy ticket</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match4.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>south africa</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.upcoming_matches_wrapper -->
                            </div>
                            <div class="item">
                                <div class="upcoming_matches_wrapper">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match1.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>england</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="versus">

                                                <p>Apr 04, 2018 20:00</p>
                                                <h1>2 - 0</h1>
                                                <h2>world championship</h2>
                                                <div class="hs_btn_wrapper next_match_btn">
                                                    <ul>
                                                        <li><a href="#">buy ticket</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
                                            <div class="next_match_list_wrapper">
                                                <div class="next_match_list_img">
                                                    <img src="{{ URL::asset('assets/frontend/sports/cricket/images/match4.png') }}" class="img-responsive"
                                                        alt="logo">
                                                    <h4>india</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.upcoming_matches_wrapper -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--next match wrapper end-->
	
	<!--latest result wrapper start-->
    <div class="latest_result_wrapper float_left">

        <div class="wrap-album-slider">
            <ul class="album-slider">
                <li class="album-slider__item">
                    <figure class="album">
                        <div class="prs_upcom_movie_box_wrapper">
                            <div class="prs_upcom_movie_img_box">
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">india <span>195 - 180</span> pakistan<br> india won by 15 runs
                                </h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx1.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">india <span>192 - 180</span> england<br> india won by 8 runs
                                </h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx2.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">india <span>195 - 180</span> england<br> india won by 15 runs
                                </h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx3.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">pakistan <span>199 - 180</span> australia<br> india won by 1
                                    runs</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx4.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">india <span>195 - 180</span> england<br> india won by 15 runs
                                </h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx5.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">india <span>195 - 180</span> england<br> india won by 15 runs
                                </h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx6.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
                                <div class="prs_upcom_movie_img_box_overlay"></div>
                                <h1 class="match_result">england <span>179 - 181</span> westindies<br> india won by 2
                                    runs</h1>
                                <img src="{{ URL::asset('assets/frontend/sports/cricket/images/bx7.jpg') }}" alt="movie_img" />
                                <div class="prs_upcom_movie_img_overlay"></div>
                                <div class="hs_btn_wrapper slider_bx_btn">
                                    <ul>
                                        <li><a href="#">view details</a></li>

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
    <!--latest result wrapper end-->
    <!--upcoming games wrapper start-->
    <div class="upcoming_games_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_left">
                        <h1>upcoming match <img src="{{ URL::asset('assets/frontend/sports/cricket/images/heading_icon.png') }}" alt="icon"></h1>

                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="tg-upcomingmatch">
                        <div class="tg-match">
                            <div class="tg-matchdetail">
                                <div class="tg-box">
                                    <strong class="tg-teamlogo">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm1.png') }}" alt="image description">
                                    </strong>
                                    <h3>india
                                    </h3>
                                </div>
                                <div class="tg-box">
                                    <h4>vs</h4>
                                </div>
                                <div class="tg-box">
                                    <strong class="tg-teamlogo2">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm2.png') }}" alt="image description">
                                    </strong>
                                    <h3> pakistan</h3>
                                </div>
                            </div>
                            <div class="tg-matchhover">
                                <address>Jan16, 2024 15:30 PM Soccer Stadium, Dubai</address>
                                <div class="tg-btnbox">
                                    <div class="hs_btn_wrapper match_btn float_left btnnww">
                                        <ul>
                                            <li><a href="#" class="hs_btn_hover btn2">read more</a></li>
                                            <li><a href="#" class="hs_btn_hover">buy ticket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tg-match">
                            <div class="tg-matchdetail">
                                <div class="tg-box">
                                    <strong class="tg-teamlogo">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm3.png') }}" alt="image description">
                                    </strong>
                                    <h3>england
                                    </h3>
                                </div>
                                <div class="tg-box">
                                    <h4>vs</h4>
                                </div>
                                <div class="tg-box">
                                    <strong class="tg-teamlogo2">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm4.png') }}" alt="image description">
                                    </strong>
                                    <h3>westindies </h3>
                                </div>
                            </div>
                            <div class="tg-matchhover">
                                <address>Jan16, 2024 15:30 PM Soccer Stadium, Dubai</address>
                                <div class="tg-btnbox">
                                    <div class="hs_btn_wrapper match_btn float_left btnnww">
                                        <ul>
                                            <li><a href="#" class="hs_btn_hover btn2">read more</a></li>
                                            <li><a href="#" class="hs_btn_hover">buy ticket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tg-match">
                            <div class="tg-matchdetail">
                                <div class="tg-box">
                                    <strong class="tg-teamlogo">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm1.png') }}" alt="image description">
                                    </strong>
                                    <h3>pakistan
                                    </h3>
                                </div>
                                <div class="tg-box">
                                    <h4>vs</h4>
                                </div>
                                <div class="tg-box">
                                    <strong class="tg-teamlogo2">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm3.png') }}" alt="image description">
                                    </strong>
                                    <h3>africa </h3>
                                </div>
                            </div>
                            <div class="tg-matchhover">
                                <address>Jan16, 2024 15:30 PM Soccer Stadium, Dubai</address>
                                <div class="tg-btnbox">
                                    <div class="hs_btn_wrapper match_btn float_left btnnww">
                                        <ul>
                                            <li><a href="#" class="hs_btn_hover btn2">read more</a></li>
                                            <li><a href="#" class="hs_btn_hover">buy ticket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tg-match">
                            <div class="tg-matchdetail">
                                <div class="tg-box">
                                    <strong class="tg-teamlogo">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm5.png') }}" alt="image description">
                                    </strong>
                                    <h3> india
                                    </h3>
                                </div>
                                <div class="tg-box">
                                    <h4>vs</h4>
                                </div>
                                <div class="tg-box">
                                    <strong class="tg-teamlogo2">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/gm6.png') }}" alt="image description">
                                    </strong>
                                    <h3>australia </h3>
                                </div>
                            </div>
                            <div class="tg-matchhover">
                                <address>Jan16, 2024 15:30 PM Soccer Stadium, Dubai</address>
                                <div class="tg-btnbox">
                                    <div class="hs_btn_wrapper match_btn float_left btnnww">
                                        <ul>
                                            <li><a href="#" class="hs_btn_hover btn2">read more</a></li>
                                            <li><a href="#" class="hs_btn_hover">buy ticket</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                    <div class="upcoming_match_img float_left">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/upmatch.jpg') }}" class="img-responsive" alt="img">

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- upcoming match end -->
    <!--palyer wrapper start-->
    <div class="best_player_wrapper float_left">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    <div class="heading_left">
                        <h1>best player <img src="{{ URL::asset('assets/frontend/sports/cricket/images/heading_icon.png') }}" alt="icon"></h1>

                    </div>
                    <div id="tg-playerscrollbar" class="tg-players tg-playerscrollbar">
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">batsman</a>
                                    <h3><a href="#">Hustlin’ Owls</a></h3>
                                    <h2>08</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-01.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">keeper</a>
                                    <h3><a href="#">james bond</a></h3>
                                    <h2>91</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-02.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">atacker</a>
                                    <h3><a href="#">AR ashwin</a></h3>
                                    <h2>12</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-01.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">bowler</a>
                                    <h3><a href="#">maliya johnson</a></h3>
                                    <h2>08</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-02.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">defenders</a>
                                    <h3><a href="#">Hustlin’ Owls</a></h3>
                                    <h2>14</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-03.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="tg-player">
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12 pull-right">
                                <div class="tg-playcontent">
                                    <a class="tg-theme-tag" href="#">batsman</a>
                                    <h3><a href="#">james bond</a></h3>
                                    <h2>22</h2>
                                    <div class="tg-description">
                                        <p>Incididunt utia labore et dolore siti magna aliqua adinim lipat</p>
                                    </div>
                                    <ul class="tg-socialicons">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-sm-6 col-12">
                                <figure>
                                    <a href="#">
                                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/img-04.png') }}" alt="image description">
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="heading_left">
                        <h1>play status <img src="{{ URL::asset('assets/frontend/sports/cricket/images/heading_icon.png') }}" alt="icon"></h1>

                    </div>
                    <div class="team-best-player">

                        <div class="best-players-list tab-pane active" id="goals">
                            <a href="#" class="item">
                                <span class="number">9</span>
                                <span>Luis Hernandez</span>
                                <span class="achievement">14</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">5</span>
                                <span>akshay handge</span>
                                <span class="achievement">11</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">7</span>
                                <span>jimmy simon</span>
                                <span class="achievement">14</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">2</span>
                                <span>sachin doe</span>
                                <span class="achievement">9</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">9</span>
                                <span>james bond</span>
                                <span class="achievement">5</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">14</span>
                                <span>farhan shaikh</span>
                                <span class="achievement">3</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">2</span>
                                <span>sachin doe</span>
                                <span class="achievement">9</span>
                            </a>
                            <a href="#" class="item">
                                <span class="number">12</span>
                                <span>nick jonaes</span>
                                <span class="achievement">8</span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--palyer wrapper end-->

    <!--gallery wrapper start-->
    <div class="portfolio_grid float_left">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_left heading_special">
                        <h1>media photos <img src="{{ URL::asset('assets/frontend/sports/cricket/images/heading_icon.png') }}" alt="icon"></h1>

                    </div>

                    <ul class="protfoli_filter">
                        <li class="active" data-filter="*"><a href="#"> all</a></li>

                        <li data-filter=".website"><a href="#">keeper</a></li>
                        <li data-filter=".design"><a href="#">batsman</a></li>
                        <li data-filter=".ux_ui"><a href="#">bowler</a></li>
                    </ul>
                </div>
            </div>
            <div class="row portfoli_inner">
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 website ux_ui">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic1.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic1.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 website design">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic2.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic2.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 design ux_ui">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic3.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic3.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 website">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic4.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic4.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 website design ux_ui">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic5.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic5.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 website design ux_ui">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic7.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic7.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12  ux_ui">
                    <div class="portfolio_item">
                        <img src="{{ URL::asset('assets/frontend/sports/cricket/images/pic8.jpg') }}" alt="">
                        <div class="portfolio_hover">
                            <a href="#"> final championship</a>
                            <div class="zoom_popup">
                                <a class="img-link" href="{{ URL::asset('assets/frontend/sports/cricket/images/pic8.jpg') }}"> <i class="flaticon-magnifier"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Items -->

            </div>
        </div>
    </div>

    <!--gallery wrapper end-->
    <!-- counter wrapper start-->
    <div class="counter_section float_left">
        <div class="counter-section">
            <div class="container text-center">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 pddddd">
                        <div class="counter_cntnt_box float_left">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="flaticon-cricket"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="count-description"><span class="timer">230</span>+
                            <h5 class="con1"> Matches Played</h5>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 pddddd">
                        <div class="counter_cntnt_box float_left">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="flaticon-hockey-helmet"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="count-description"> <span class="timer">89</span>+
                            <h5 class="con2">Touchdowns</h5>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 pddddd">
                        <div class="counter_cntnt_box float_left">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="flaticon-cricket-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="count-description"> <span class="timer">60</span>+
                            <h5 class="con2">team members</h5>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12 pddddd">
                        <div class="counter_cntnt_box float_left">
                            <div class="tb_icon">
                                <div class="icon"> <a href="#"><i class="flaticon-trophy"></i></a>
                                </div>
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
    <!-- counter wrapper end-->
	
	
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