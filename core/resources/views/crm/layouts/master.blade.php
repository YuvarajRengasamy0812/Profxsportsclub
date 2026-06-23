<!DOCTYPE html>
<html lang="en">

<head>
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
	

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="{{ URL::asset('assets/crm/css/style.css') }}?v={{ Helper::system_version() }}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>


</head>

<body class="bg-[#f8fafc] min-h-screen flex">

  @include('crm.layouts.sidebar')
  <div class="flex-1 lg:ml-72 flex flex-col min-h-screen">
    @include('crm.layouts.header')
    <!-- Main Content -->
    <main id="main">

      @yield('content')
    </main>

    <!-- Notifications Modal -->
  </div>

  <script>
    // Initialize all Lucide icons after DOM loads
    document.addEventListener("DOMContentLoaded", function() {
      lucide.createIcons();
    });
  </script>

  <script src="{{ URL::asset('assets/crm/js/style.js') }}?v={{ Helper::system_version() }}"></script>

</body>

</html>