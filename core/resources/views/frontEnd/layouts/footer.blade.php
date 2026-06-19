<?php
    $bg_color = Helper::GeneralSiteSettings('style_color2');
    $footer_style = 'background: ' . $bg_color;
    if (Helper::GeneralSiteSettings('style_footer_bg') != '') {
        $bg_file = URL::to('uploads/settings/' . Helper::GeneralSiteSettings('style_footer_bg'));
        $footer_style = "style='background-image: url($bg_file);'";
    }
    if (Helper::GeneralSiteSettings('style_footer') != 1) {
        $footer_style = 'style=padding:0';
    }
    $contacts_cols = 3;
    if (!Helper::GeneralSiteSettings('style_subscribe')) {
        $contacts_cols = 4;
    }
    $footercontent = Helper::Topic(151);
    $footerpresentby = Helper::Topic(152);
    $footerassoiate = Helper::Topic(153);
    ?>
    <!--==============================
  Footer Area
 ==============================-->


    <style>
        a.fx-terms-txt:hover {
            color: #45F882 !important;
        }

        a.fx-policy-txt:hover {
            color: #45F882 !important;
        }

        /* Make sure the title is positioned relative so :after positions correctly */
        .newsletter-widget .follow_title {
            position: relative;
            max-width: 270px;
            color: var(--white-color);
            font-weight: 700;
            font-size: 30px;
            text-transform: capitalize;
            margin: -0.12em 0 35px 0;
            padding-bottom: 16px;
        }

        /* Only this newsletter widget title gets full-width underline */
        .newsletter-widget .follow_title:after {
            content: '';
            position: absolute;
            height: 2px;
            width: 100%;
            /* full viewport width */
            bottom: 0;
            left: 0;
            background-image: linear-gradient(to right, var(--theme-color), var(--theme-color2));
        }

        @media (min-width: 992px) and (max-width: 1200px) {
            .col-lg-auto {
                margin-right: auto;
                padding: 0;
                width: auto;
            }
        }
    </style>


    <footer class="main-footer pt_150">
        <div class="pattern-layer" style="background-image: url(assets/frontend/images/shape/shape-4.png);"></div>
        <div class="auto-container">
            {{-- <div class="footer-top">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-12 col-sm-12 logo-column">
                        <figure class="footer-logo"><a href="#"><img src="assets/images/logo-3.png"
                                    alt=""></a></figure>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 subscribe-column">
                        <div class="subscribe-content">
                            <h3>Subscribe Now</h3>
                            <div class="form-inner">
                                <form method="post" action="contact.html">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your email" required>
                                        <button type="submit" class="theme-btn btn-one">Subscribe Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="widget-section pt_95 pb_95">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="about-widget footer-widget mr_40">
                            <div class="">
                                <figure class="">
                                    <a href="{{ Helper::homeURL() }}">
                                        <img src="assets/dashboard/images/logo-white.png" alt="white logo">
                                    </a>
                                </figure>
                            </div>
                            <div class="widget-content mt-3">
                                <p>
                                    Profx Sports Club is an exclusive community for verified forex professionals,
                                    bringing the industry together through physical sports, esports, and indoor
                                    competitions that fuel connection, performance, and brand presence.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="links-widget footer-widget ml_30">
                            <div class="widget-title">
                                <h3>Links</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix">
                                    <li><a href={{ route('about') }}>About Us</a></li>
                                    <li><a href={{ route('event') }}>Events</a></li>
                                    <li><a href={{ route('sports') }}>Sports</a></li>
                                    <li><a href={{ route('membership') }}>Membership</a></li>
                                    <li><a href={{ route('contact') }}>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="schedule-widget footer-widget ml_55">
                            <div class="widget-title">
                                <h3>Working Hours</h3>
                            </div>
                            <div class="widget-content">
                                <p>
                                    We are open to serve you during the working hours listed below. Feel free to
                                    contact us for any inquiries or assistance.
                                </p>
                                <ul class="schedule-list clearfix">
                                    <li>Mon - Fri: 9:00AM - 6:00PM</li>
                                    <li>Sat - Sun: 8:00AM - 4:00PM</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="contact-widget footer-widget">
                            <div class="widget-title">
                                <h3>Get In Touch</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li>
                                        <div class="icon-box"><i class="icon-3"></i></div>
                                        Add: Business Center 03<br>
                                        RAKEZ Business Zone-FZRAK, UAE
                                    </li>
                                    <li>
                                        <div class="icon-box"><i class="icon-2"></i></div>
                                        Email: <a href="mailto:info@profxsportsclub.com">info@profxsportsclub.com</a>
                                    </li>
                                    <li>
                                        <div class="icon-box"><i class="icon-5"></i></div>
                                        Phone: <a href="tel:971588845033">971 58 884 5033</a>
                                    </li>
                                </ul>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li><li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom centred">
            <div class="copyright">
                <p>Copyright <?php echo date('Y'); ?> by <a
                        href="{{ Helper::homeURL() }}">{{ __('frontend.AllRightsReserved') }}</a></p><br>
                        <?php
            // 1. Definisikan semua URL target dalam bentuk array
            
        ?>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->

    <?php
    /*
@if (Helper::GeneralSiteSettings('social_link10'))
<a href="https://wa.me/{{ Helper::GeneralSiteSettings('social_link10') }}" class="whatsapp_float" target="_blank"  aria-label="Whatsapp"
       rel="noopener noreferrer">
        <i class="fa fa-whatsapp"></i>
    </a>
@endif
*/
    ?>
    @if (@Auth::check())
        @if (!Helper::GeneralSiteSettings('site_status'))
            <div class="text-center alert alert-warning m-0">
                <div class="h6 mb-0">
                    {{ __('backend.websiteClosedForVisitors') }}
                </div>
            </div>
        @endif
    @endif