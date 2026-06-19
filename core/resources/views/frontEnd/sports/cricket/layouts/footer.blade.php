<!-- footer Wrapper start -->
    <div class="footer_wrapper float_left">
        <div class="section_2">
            <div class="section2_footer_overlay"></div>
            <div class="section2_footer_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                            <div class="footer_widget section2_about_wrapper">
                                <div class="wrapper_first_image">
                                     <a href="{{ Helper::homeURL() }}">
										@if (Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code) != '')
											<img alt="{{ Helper::GeneralSiteSettings('site_title_' . @Helper::currentLanguage()->code) }}"
												src="{{ URL::to('uploads/settings/' . Helper::GeneralSiteSettings('style_logo_' . @Helper::currentLanguage()->code)) }}"
												style="max-width:140px" />
										@else
											<img alt="{{ Helper::GeneralSiteSettings('site_title_' . @Helper::currentLanguage()->code) }}"
												src="{{ URL::to('uploads/settings/nologo.png') }}"  />
										@endif
									</a>
                                </div>
                                <div class="abotus_content">
                                    <p>Fusce et sem elementum, mis nibh nec, tincidunt ipsum etiau euntum, mis nibh nec, tincid ctor.
                                    </p>
                                    <p>Cras vel dui vel orciarel gravida.rpis. Quisque sitmi tincidunt ipsum etiau.</p>
                                </div>
                                <a href="#">READ MORE</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                            <div class="footer_widget section2_blog_wrapper">
                                <h4>portfolio</h4>
                                <div class="ft_blog_wrapper1">
                                    <div class="ft_blog_image">
                                        <img src="{{ URL::asset('assets/frontend/sports/badminton/images/bg1.jpg') }}" class="img-responsive" alt="blog-img1_img" />
                                    </div>
                                    <div class="ft_blog_text">
                                        <h5><a href="#">Fusce Quisque gravida sitmi</a></h5>
                                        <div class="ft_blog_date">June 20, 2024</div>
                                    </div>
                                </div>
                                <div class="ft_blog_wrapper2">
                                    <div class="ft_blog_image">
                                        <img src="{{ URL::asset('assets/frontend/sports/badminton/images/bg2.jpg') }}" class="img-responsive" alt="blog-img2_img" />
                                    </div>
                                    <div class="ft_blog_text">
                                        <h5><a href="#">Cras vel dui vel orciarel</a></h5>
                                        <div class="ft_blog_date">June 28, 2024</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                            <div class="footer_widget section2_useful_wrapper">
                                <h4>useful links </h4>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>About academy</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>academy profile</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>academy team</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>events</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-right"></i>played matches</a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                            <div class="footer_widget section2_useful_second_wrapper">
                                <h4>contact <span> info </span></h4>
                                <ul>
                                    <li><i class="fa fa-location-arrow"></i>Timposn, Suite 247 USA
                                    </li>
                                    <li><i class="fa fa-flag"></i> ABN 11 119 159 741
                                    </li>
                                    <li><i class="fa fa-phone-square"></i>+61 3 8376 6284
                                    </li>
                                    <li><a href="#"><i class="fa fa-envelope-square"></i>info@example.com</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section2_bottom_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="btm_foter_box">

                                <p><i class="fa fa-copyright"></i><?php echo date('Y'); ?>. <a href="{{ Helper::homeURL() }}">{{ __('frontend.AllRightsReserved') }}</a></p>
                                <ul class="aboutus_social_icons">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                    </li>
                                    <li> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="close_wrapper">
        </div>
        <!-- section-2 end -->
    </div>
    <!--footer wrapper end-->