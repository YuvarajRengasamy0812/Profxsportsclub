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
						<a href="{{ route('user.referred') }}" > Binary Tree </a>
					</div>
					
					<div class="col-lg-12">
						<div class="container text-center">
							<!-- Root User -->
							<?PHP 
								if($topUsers->photo != ''){
									$imagepath = URL::to('uploads/users/'.$topUsers->photo);
								} else {
									$imagepath = URL::asset('assets/frontend/img/icon.png');
								}
							?>
							<div class="mb-4">
								<div class="hex red mx-auto">
									<img src="{{ $imagepath }}" alt="User" />
									<div class="text">{{ $topUsers->name }}</div>
								</div>
							</div>

							<!-- First Level Referrals -->
							<div class="d-flex justify-content-center gap-3 mb-4">
								@foreach($topUsers->referrals as $ref1)
								<?PHP 
									if($ref1->photo != ''){
										$imagepath1 = URL::to('uploads/users/'.$ref1->photo);
									} else {
										$imagepath1 = URL::asset('assets/frontend/img/icon.png');
									}
								?>
									<div class="hex yellow">
										<img src="{{ $imagepath1 }}" alt="User" />
										<div class="text">{{ $ref1->name }}</div>
									</div>
								@endforeach
							</div>

							<!-- Second Level Referrals -->
							<div class="d-flex justify-content-center flex-wrap gap-4">
								@foreach($topUsers->referrals as $ref1)
									@foreach($ref1->referrals as $ref2)
										<?PHP 
											if($ref2->photo != ''){
												$imagepath2 = URL::to('uploads/users/'.$ref2->photo);
											} else {
												$imagepath2 = URL::asset('assets/frontend/img/icon.png');
											}
										?>
										<div class="hex blue">
											<img src="{{ $imagepath2 }}" alt="User" />
											<div class="text">{{ $ref2->name }}</div>
										</div>
									@endforeach
								@endforeach
							</div>
						</div>
					</div>
					
					<div class="tree-container">
						<?PHP 
							if($topUsers->photo != ''){
								$imagepath = URL::to('uploads/users/'.$topUsers->photo);
							} else {
								$imagepath = URL::asset('assets/frontend/img/icon.png');
							}
						?>
						<div class="mb-4">
							<div class="hex red mx-auto">
								<img src="{{ $imagepath }}" alt="User" />
								<div class="text">{{ $topUsers->name }}</div>
							</div>
						</div>
						<div class="line-horizontal"></div>
						<!-- Level 1 -->
						<div class="tree-level">
							@foreach($topUsers->referrals as $level1)
								<?PHP 
									if($level1->photo != ''){
										$imagepathlevel1 = URL::to('uploads/users/'.$level1->photo);
									} else {
										$imagepathlevel1 = URL::asset('assets/frontend/img/icon.png');
									}
								?>
								<div class="text-center">
									<div class="hex" style="border-color:#f0ad4e;">
										<img src="{{ $imagepathlevel1 }}" alt="">
										<div class="text">{{ $level1->name }}</div>
									</div>
								</div>
							@endforeach
							<div class="line-horizontal"></div>
						</div>
						<div class="line-down"></div>

						<!-- Level 2 -->
						<div class="tree-level">
							@foreach($topUsers->referrals as $level1)
								@foreach($level1->referrals as $level2)
									<?PHP 
										if($level2->photo != ''){
											$imagepathlevel2 = URL::to('uploads/users/'.$level2->photo);
										} else {
											$imagepathlevel2 = URL::asset('assets/frontend/img/icon.png');
										}
									?>
									<div class="text-center">
										<div class="hex" style="border-color:#5bc0de;">
											<img src="{{ $imagepathlevel2 }}" alt="">
											<div class="text">{{ $level2->name }}</div>
										</div>
									</div>
								@endforeach
							@endforeach
							<div class="line-horizontal"></div>
						</div>
						<div class="line-down"></div>

						<!-- Level 3 -->
						<div class="tree-level">
							@foreach($topUsers->referrals as $level1)
								@foreach($level1->referrals as $level2)
									@foreach($level2->referrals as $level3)
										<?PHP 
											if($level3->photo != ''){
												$imagepathlevel3 = URL::to('uploads/users/'.$level3->photo);
											} else {
												$imagepathlevel3 = URL::asset('assets/frontend/img/icon.png');
											}
										?>
										<div class="text-center">
											<div class="hex" style="border-color:#d9534f;">
												<img src="{{ $imagepathlevel3 }}" alt="">
												<div class="text">{{ $level3->name }}</div>
											</div>
										</div>
									@endforeach
								@endforeach
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
