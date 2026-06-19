	<meta charset="utf-8">
	<title>{{(@$PageTitle !="")? @$PageTitle:Helper::GeneralSiteSettings("site_title_" . @Helper::currentLanguage()->code)}}</title>
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
	
<!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Marcellus&display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
	<link href="{{ URL::asset('assets/frontend/css/font-awesome-all.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/flaticon.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/owl.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/bootstrap.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/jquery.fancybox.min.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/animate.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/nice-select.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/odometer.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/elpath.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/color.css') }}?v={{ Helper::system_version() }}" id="jssDefault" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/rtl.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/style.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/header.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/banner.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/service.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/about.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/funfact.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/portfolio.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/pricing.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/event.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/cta.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/news.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/faq.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/footer.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/responsive.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/contact.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/event-details.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
<link href="{{ URL::asset('assets/frontend/css/module-css/blog-details.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/frontend/css/module-css/blog-sidebar.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">


	<!-- about -->

		<link href="{{ URL::asset('assets/frontend/css/module-css/page-title.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/history.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/fluid.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/testimonial.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/video.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
		<link href="{{ URL::asset('assets/frontend/css/module-css/team.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">



	{{-- Google Tags and google analytics --}}
	@if(@Helper::GeneralWebmasterSettings("google_tags_status") && @Helper::GeneralWebmasterSettings("google_tags_id") !="")
		
	@endif