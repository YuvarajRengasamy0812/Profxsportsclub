@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
$aboutsection1 = Helper::Topic(155);
$aboutsecupcoming = Helper::Topic(156);
$aboutseconemid = Helper::Topic(158);
$aboutsectwomid = Helper::Topic(159);
$aboutjoinleague = Helper::Topic(160);
?>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >
	
	<div class="container">
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
			
			</div>
		</div>
	</div>
</div>

	
	

@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
