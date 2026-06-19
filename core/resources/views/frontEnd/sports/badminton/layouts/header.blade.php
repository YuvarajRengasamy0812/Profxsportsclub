<!-- navi wrapper Start -->
    <div class="ft_navi_main_wrapper float_left">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="ft_logo_wrapper">
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
                    <div class="ft_right_wrapper">
                        <ul>                            
                            <li>
                                <div class="hs_btn_wrapper d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                    <ul>
                                        <li><a href="ticket_booking.html">ticket</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="hs_btn_wrapper d-block d-sm-block d-md-block d-lg-block d-xl-block">
                                    <ul>
                                        <li><a href="login.html">login</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- navi wrapper End -->