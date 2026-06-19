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
				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						<h2 class="widget_title">My Referral Tree (3 Levels)!</h2>
					</div>
					<div class="mb-2">
						<span class="collapse-toggle" onclick="expandAll()">Expand All</span> |
						<span class="collapse-toggle" onclick="collapseAll()">Collapse All</span>
						
						<!--<a href="{{ route('user.referredfamily')}}" > Family Tree </a>-->
					</div>
					
					<div class="col-lg-12">
						<div class="tree">
							@foreach($topUsers as $user)
								@include('frontEnd.user.referrednode', ['user' => $user, 'level' => 1])
							@endforeach
						</div>
					</div>
				</div>
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
<script>	
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-icon').forEach(function (icon) {
            const targetId = icon.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);

            if (target) {
                target.addEventListener('show.bs.collapse', function () {
                    icon.classList.remove('bi-caret-right-fill');
                    icon.classList.add('bi-caret-down-fill');
                });

                target.addEventListener('hide.bs.collapse', function () {
                    icon.classList.remove('bi-caret-down-fill');
                    icon.classList.add('bi-caret-right-fill');
                });
            }
        });
    });

    function expandAll() {
        document.querySelectorAll('.collapse').forEach(el => el.classList.add('show'));
        document.querySelectorAll('.toggle-icon').forEach(icon => {
            icon.classList.remove('bi-caret-right-fill');
            icon.classList.add('bi-caret-down-fill');
        });
    }

    function collapseAll() {
        document.querySelectorAll('.collapse').forEach(el => el.classList.remove('show'));
        document.querySelectorAll('.toggle-icon').forEach(icon => {
            icon.classList.remove('bi-caret-down-fill');
            icon.classList.add('bi-caret-right-fill');
        });
    }
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
