<!DOCTYPE html>
<html lang="{{ @Helper::currentLanguage()->code }}" dir="{{ @Helper::currentLanguage()->direction }}">

<head>
    <!-- ======= Meta & CSS ======= -->
    @stack('before-styles')
    @include('frontEnd.layouts.head')
    @include('frontEnd.layouts.colors')
    @yield('headInclude')
    @stack('after-styles')
    @if(Helper::GeneralSiteSettings("css")!="")
        <style type="text/css">
            {!! Helper::GeneralSiteSettings("css") !!}
        </style>
    @endif
    {!! Helper::GeneralSiteSettings("js") !!}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RN8ZQPD5X9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-RN8ZQPD5X9');
    </script>
</head>

<body class="dir-{{ @Helper::currentLanguage()->direction }} lang-{{ @Helper::currentLanguage()->code }} {{ (!Helper::GeneralSiteSettings("style_change") && Helper::GeneralSiteSettings("style_type"))?"dark":"" }}">
<div class="boxed_wrapper ltr">

<!-- preloader -->
	<!--<div class="loader-wrap">-->
	<!--	<div class="preloader">-->
	<!--		<div class="preloader-close"><i class="fal fa-times"></i></div>-->
	<!--		<div id="handle-preloader" class="handle-preloader">-->
	<!--			<div class="animation-preloader">-->
	<!--				<div class="spinner"></div>-->
	<!--				<div class="txt-loading">-->
	<!--					<span data-text-preloader="p" class="letters-loading">-->
	<!--						P-->
	<!--					</span>-->
	<!--					<span data-text-preloader="r" class="letters-loading">-->
	<!--						R-->
	<!--					</span>-->
	<!--					<span data-text-preloader="0" class="letters-loading">-->
	<!--						O-->
	<!--					</span>-->
	<!--					<span data-text-preloader="f" class="letters-loading">-->
	<!--						F-->
	<!--					</span>-->
	<!--					<span data-text-preloader="x" class="letters-loading">-->
	<!--						X-->
	<!--					</span>-->
	<!--					<span data-text-preloader="s" class="letters-loading">-->
	<!--						S-->
	<!--					</span>-->
	<!--					<span data-text-preloader="p" class="letters-loading">-->
	<!--						P-->
	<!--					</span>-->
	<!--					<span data-text-preloader="o" class="letters-loading">-->
	<!--						O-->
	<!--					</span>-->
	<!--					<span data-text-preloader="r" class="letters-loading">-->
	<!--						R-->
	<!--					</span>-->
	<!--					<span data-text-preloader="t" class="letters-loading">-->
	<!--						T-->
	<!--					</span>-->
	<!--					<span data-text-preloader="s" class="letters-loading">-->
	<!--						S-->
	<!--					</span>-->
	<!--					<span data-text-preloader="c" class="letters-loading">-->
	<!--						C-->
	<!--					</span>-->
	<!--					<span data-text-preloader="l" class="letters-loading">-->
	<!--						L-->
	<!--					</span>-->
	<!--					<span data-text-preloader="u" class="letters-loading">-->
	<!--						U-->
	<!--					</span>-->
	<!--					<span data-text-preloader="b" class="letters-loading">-->
	<!--						B-->
	<!--					</span>-->
	<!--				</div>-->
	<!--			</div>  -->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- preloader end -->


	<!-- page-direction -->
	<!--<div class="page_direction">-->
	<!--	<div class="demo-rtl direction_switch"><button class="rtl">RTL</button></div>-->
	<!--	<div class="demo-ltr direction_switch"><button class="ltr">LTR</button></div>-->
	<!--</div>-->
	<!-- page-direction end -->




	


	<!--Search Popup-->
	<div id="search-popup" class="search-popup">
		<div class="popup-inner">
			<div class="upper-box">
				<figure class="logo-box"><a href="index.html"><img src="assets/images/logo-3.png" alt=""></a></figure>
				<div class="close-search"><span class="fas fa-times"></span></div>
			</div>
			<div class="overlay-layer"></div>
			<div class="auto-container">
				<div class="search-form">
					<form method="post" action="index.html">
						<div class="form-group">
							<fieldset>
								<input type="search" class="form-control" name="search-input" value="" placeholder="Type your keyword and hit" required >
								<button type="submit"><i class="icon-4"></i></button>
							</fieldset>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



<!-- ======= Header ======= -->
@include('frontEnd.layouts.header')

<!-- ======= Main contents ======= -->
<main id="main" class="{{ (Helper::GeneralSiteSettings("style_header"))?"fixed-top-margin":"" }}">
    @yield('content')
</main>
<!-- ======= Footer ======= -->
@include('frontEnd.layouts.footer')
@if(Helper::GeneralSiteSettings("style_preload"))
    <div id="preloader"></div>
@endif
<!-- ======= JS Including ======= -->
@stack('before-scripts')
@include('frontEnd.layouts.foot')
@yield('footInclude')
@stack('after-scripts')
{!! Helper::GeneralSiteSettings("body") !!}
<!--<script src="//code.tidio.co/bm6jc72litcbzkwlvov8irmovpmwq6ld.js" async></script>-->
</div>
</body>
</html>
