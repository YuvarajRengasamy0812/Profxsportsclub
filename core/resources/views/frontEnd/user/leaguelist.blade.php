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
						<h2 class="widget_title">ProFX <span class="text-theme">{{ $pagetitle }}</span> !</h2>
					</div>
				</div>
				 @if (auth()->user()->payment_status == 1)
				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						@forelse($leagueslist as $resluague)
							<?PHP
							$startdate = date('M d Y', strtotime($resluague->registerstartDate));
							$startTime = date('H:i A', strtotime($resluague->registerstartDate));
							$enddate = date('M d', strtotime($resluague->eventstartDate));							
							?>
							<div class="col-lg-12 col-md-12 filter-item demo tour-all">
								<div class="tournament-card style5 style5-2">
									<div class="tournament-card-shape"
										data-bg-src="{{ URL::asset('assets/frontend/img/tournament-card6-bg.png') }}">
									</div>
									<div class="tournament-card-shape2"
										data-bg-src="{{ URL::asset('assets/frontend/img/tournament-card6-2-bg.png') }}">
									</div>
									<div class="lg-tournament-wrapper">
										<div class="tournament-player-wrap">
												<div class="tournament-card-img"
												data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
												<img decoding="async"
													src="{{ URL::asset('assets/frontend/img/team-bull.png') }}"
													alt="tournament image">
											</div>
											<div class="card-title-wrap">
												<h3 class="tournament-card-title title"><a >Bull</a></h3>
											</div>
										</div>
										<div class="tournament-card-versus"><img decoding="async"
												src="{{ URL::asset('assets/frontend/img/game-vs2.svg') }}" alt="game vs2" />
										</div>
										<div class="tournament-player-wrap style2">
											<div class="tournament-card-img"
												data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
												<img decoding="async"
													src="{{ URL::asset('assets/frontend/img/team-bear.png') }}"
													alt="tournament image">
											</div>
											<div class="card-title-wrap">
												<h3 class="tournament-card-title title"><a >Bear</a></h3>
											</div>
										</div>
									</div>
									
									<div class="tournament-card-content">
										<div class="tournament-card-details">
											<h6 class="tournament-card-time">{{ $resluague->catname }}</h6>
											<p class="tournament-card-date"><?PHP echo $startdate ?></p>
										</div>						
										<div class="btn-wrap">
										<?PHP if($listtype == 'active'){ ?>
											<a href="javascript:void();" class="th-btn th_btn enrollLeague" data-id="{{ $resluague->id }}" ><span class="btn-border">Enroll Now</span></a>
										<?PHP } if($listtype == 'upcoming'){ ?>
											<a href="javascript:void(0);" class="th-btn th_btn disabled" style="pointer-events: none; opacity: 0.6;">Enrollment Locked</a>
										<?PHP } ?>
										</div>
									</div>
								</div>
							</div>
						@empty
							<div class="col-lg-12 col-sm-12 mb-5">
								<div class="text-center tournament-card d-grid pt-4 pb-4">
									<h5 class="text-white text-center">No League Founded!!!</h5>
								</div>
							</div>
						@endforelse
					</div>
				</div>
				@else
                  <div class="col-lg-12 col-sm-12">
                        <div class="text-center tournament-card d-grid pt-4 pb-4">
                            <h5 class="text-white text-center">Get ready to trade and earn! Activate your ProFxLeague
                                account with $25 and start referring.</h5>
                            <div class="tournament-card-meta d-flex justify-content-center">
                                <a type="button" href="{{ route('user.choosepayment', 'register') }}"
                                    class="th-btn th_btn style2" style="min-width:100px">Pay Now $25</a>
                            </div>
                        </div>
                       

                    </div>
             @endif
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
	<script>
	
	$(document).ready(function () {
		 $('.enrollLeague').click(function (e) {
			e.preventDefault();
			let leagueId = $(this).data('id');
			Swal.fire({
				title: 'Are you sure?',
				text: "Do you want to enroll in this league?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, Enroll',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "{{ route('user.enrollleague') }}", 
						type: "POST",
						data: {
							_token: "{{ csrf_token() }}",
							leaguecatid: leagueId
						},
						success: function(response) {
							Swal.fire(
								'Enrolled!',
								'You have successfully enrolled in this league.',
								'success'
							);
						},
						error: function(xhr) {
							Swal.fire(
								'Error!',
								'Something went wrong. Please try again.',
								'error'
							);
						}
					});
				}
			});
		});
	});
	
	function checkKYC(targetUrl){
		const kycStatus = {{ Auth::user()->kyc_status }};

		if(kycStatus === 0) {
			Swal.fire({
				icon: 'info',
				title: 'KYC Pending',
				text: 'Your KYC is pending. Please wait for approval before proceeding.',
				confirmButtonText: 'OK'
			});
		} else if(kycStatus === 2) {
			Swal.fire({
				icon: 'warning',
				title: 'KYC Rejected',
				text: 'Your KYC was rejected. Please upload/update your KYC to continue.',
				showCancelButton: true,
				confirmButtonText: 'Upload KYC',
				cancelButtonText: 'Cancel',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "{{ route('user.kyc') }}";
				}
			});
		} else {
			window.location.href = targetUrl;
		}
	 }
	 </script>
	
	
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
