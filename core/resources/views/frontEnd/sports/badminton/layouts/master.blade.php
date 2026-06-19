<!DOCTYPE html>
<html lang="{{ @Helper::currentLanguage()->code }}" dir="{{ @Helper::currentLanguage()->direction }}">
<head>
    <meta charset="utf-8">
	<title>Badminton | {{(@$PageTitle !="")? @$PageTitle:Helper::GeneralSiteSettings("site_title_" . @Helper::currentLanguage()->code)}}</title>
	<meta name="description" content="{{(@$PageDescription !="")? @$PageDescription:Helper::GeneralSiteSettings("site_desc_" . @Helper::currentLanguage()->code)}}"/>
	<meta name="keywords" content="{{(@$PageKeywords !="")? @$PageKeywords:Helper::GeneralSiteSettings("site_keywords_" . @Helper::currentLanguage()->code)}}"/>
	<meta name="author" content="{{ URL::to('') }}"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<!-- Favicon and Touch Icons -->
	@if(Helper::GeneralSiteSettings("style_fav") !="")
		<link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_fav")) }}" rel="shortcut icon"
			  type="image/png">
	@else
		<link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="shortcut icon" type="image/png">
	@endif
	
	@if(Helper::GeneralSiteSettings("style_apple") !="")
		<link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon">
		<link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
			  sizes="72x72">
		<link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
			  sizes="114x114">
		<link href="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings("style_apple")) }}" rel="apple-touch-icon"
			  sizes="144x144">
	@else
		<link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon">
		<link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="72x72">
		<link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="114x114">
		<link href="{{ URL::asset('uploads/settings/nofav.png') }}" rel="apple-touch-icon" sizes="144x144">
	@endif

	<meta property='og:title'
		  content='{{@$PageTitle}} {{(@$PageTitle =="")? Helper::GeneralSiteSettings("site_title_" . @Helper::currentLanguage()->code):""}}'/>
	@if(@$Topic->photo_file !="")
		<meta property='og:image' content='{{ URL::asset('uploads/topics/'.@$Topic->photo_file) }}'/>
	@elseif(Helper::GeneralSiteSettings("style_apple") !="")
		<meta property='og:image'
			  content="{{ URL::asset('uploads/settings/'.Helper::GeneralSiteSettings('style_apple')) }}"/>
	@else
		<meta property='og:image'
			  content="{{ URL::asset('uploads/settings/nofav.png') }}" />
	@endif
	<meta property="og:site_name" content="{{ Helper::GeneralSiteSettings("site_title_" . @Helper::currentLanguage()->code) }}">
	<meta property="og:description" content="{{@$PageDescription}}"/>
	<meta property="og:url" content="{{ url()->full()  }}"/>
	<meta property="og:type" content="website"/>

	<link rel="canonical" href="{{ url()->current() }}">
	
	<!-- ======= Meta & CSS ======= -->
    @stack('before-styles')
    @include('frontEnd.sports.shared.head')
	<link rel="stylesheet" href="{{ URL::asset('assets/frontend/sports/common/flaticon/badminton/flaticon.css') }}?v={{ Helper::system_version() }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/layers.css') }}?v={{ Helper::system_version() }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/navigation.css') }}?v={{ Helper::system_version() }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/settings.css') }}?v={{ Helper::system_version() }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/frontend/sports/badminton/css/badminton_style.css') }}?v={{ Helper::system_version() }}">
</head>

<body>
	<div id="preloader">
        <div id="status">
            <img src="{{ URL::asset('assets/frontend/sports/badminton/images/loader.gif') }}" id="preloader_image" alt="loader">
        </div>
    </div>
	<div class="cursor cursor-shadow"></div>
    <div class="cursor cursor-dot"></div>
    <!-- Top Scroll Start --><a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- Top Scroll End -->
	
	<!-- ======= Header ======= -->
	@include('frontEnd.sports.badminton.layouts.header')
	
	@yield('content')
	
	<!-- ======= Footer ======= -->
	@include('frontEnd.sports.badminton.layouts.footer')

	

<!-- ======= JS Including ======= -->
@stack('before-scripts')
@include('frontEnd.sports.shared.foot')
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/jquery.themepunch.revolution.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/jquery.themepunch.tools.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.addon.snow.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.actions.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.carousel.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.kenburn.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.layeranimation.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.migration.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.navigation.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.parallax.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.slideanims.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/plugin/rs_slider/revolution.extension.video.min.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/cursor.js') }}?v={{ Helper::system_version() }}"></script>
<script src="{{ URL::asset('assets/frontend/sports/badminton/js/badminton.js') }}?v={{ Helper::system_version() }}"></script>

<script>
	$('.zoom_popup').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1]
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function (item) {
				return item.el.attr('title') + '<small></small>';
			}
		}
	});
</script>
</body>
</html>
