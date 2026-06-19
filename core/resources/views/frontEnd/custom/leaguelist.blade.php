@extends('frontEnd.layouts.master')

@section('content')
<style>
.countdown {
    display: flex;
    justify-content: center;
    gap: 10px;
}
.countdown .time-box {
    text-align: center;
}
.countdown .time-box span {
    display: block;
    padding: 6px 10px;
    color: #45F882;
    border: 2px solid #45F882;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold; /* numbers bold */
    background: transparent;
}

.countdown .time-box small {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #45F882; /* label color */
    font-weight: normal; /* labels normal */
}
</style>
    <div class="th-hero-wrapper hero-4" id="hero">
		<div class="container th-container5">
			<div class="text-center">
				<h1 class="hero-title custom-anim-top wow" data-wow-duration="1.2s"
					data-wow-delay="0.2s"></h1>
				<div class="hero-thumb4-1 custom-anim-top wow" data-wow-duration="1.2s"
					data-wow-delay="0.2s">
					<div class="character"><img style="width:100%;opacity:0.3" decoding="async" src="{{ URL::asset('assets/frontend/img/bull-bear.jpg') }}" alt="" />
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-11">
					<div class="lg-slider-area slider-area hero-game-slider4-1">
						<div class="swiper th-slider" id="heroGameSlider4-1"
							data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}'>
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="tournament-card style5">
										<div class="tournament-card-shape"
											data-bg-src="{{ URL::asset('assets/frontend/img/hero-slider-bg-shape4-1.png') }}">
										</div>
										<div class="tournament-player-wrap">
											<div class="tournament-card-img"
												data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
												<img decoding="async"
													src="{{ URL::asset('assets/frontend/img/bull.png') }}"
													alt="tournament image">
											</div>
											<div class="card-title-wrap">
												<h3 class="tournament-card-title title"><a
														>Bull</a></h3>
											</div>
										</div>
										<div class="tournament-card-versus"><img decoding="async"
                								src="{{ URL::asset('assets/frontend/img/game-vs2.svg') }}" alt="game vs2" />
                						</div>
										<div class="tournament-player-wrap style2">
											<div class="tournament-card-img"
												data-bg-src="{{ URL::asset('assets/frontend/img/logo-bg4.png') }}">
												<img decoding="async"
													src="{{ URL::asset('assets/frontend/img/bear.png') }}"
													alt="tournament image">
											</div>
											<div class="card-title-wrap">
												<h3 class="tournament-card-title title"><a
														>Bear</a></h3>
											</div>
										</div>
										<div class="tournament-card-content">
											<div class="tournament-card-details">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="btn-wrap mt-40 justify-content-center"><a href="https://www.youtube.com/@profxleague" target="_blank" class="th-btn th_btn">WATCH LEAGUE<i class="fas fa-arrow-right ms-2"></i></a></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="title-area text-center custom-anim-top wow" data-wow-duration="1.5s" data-wow-delay=".2s">
		<!--<span class="sub-title style3"><span class="sub-title-shape icon-masking">-->
		<!--<span class="mask-icon" data-mask-src="{{ URL::asset('assets/frontend/img/section-title-bg.svg') }}"></span>-->
		<!--	{{ $category->catname }}-->
		<!--</span></span>-->
		<!--<h2 class="sec-title d-none">League Rounds</h2>-->
		<span class="sub-title style3"><span class="sub-title-shape icon-masking">
		<span class="mask-icon" data-mask-src="{{ URL::asset('assets/frontend/img/section-title-bg.svg') }}"></span>
		</span>{{ $category->catname }}</span>
		<h2 class="sec-title d-none">League Rounds</h2>
	</div>
	<div class="container">
		<div class="row gy-4 filter-active">
			
			
			@foreach($leaguelist as $resluague)
			<?php
			$startdate = date('M d Y', strtotime($resluague->leagurStartdate));
			$startTime = date('H:i A', strtotime($resluague->leagurStartdate));
			$enddate = date('M d', strtotime($resluague->leagurEnddate));
			?>
			<div class="col-lg-12 col-md-12 filter-item demo tour-all test">
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
					<div class="tournament-details">
						<div class="lg-tournament-details">
							<div class="tournament-card-date-wrap">
								<div class="countdown" data-date="{{ $startdate }}"></div>
								{{-- <h6 class="tournament-card-time text-white"><?PHP echo $startTime; ?></h6> --}}
								{{-- <p class="tournament-card-date"><?PHP echo $startdate.' - '.$enddate; ?></p> --}}
							</div>
							<p>{!! \Illuminate\Support\Str::limit(strip_tags(@$resluague->description), 100) !!}</p>
							
						</div>
					</div>
					<div class="tournament-card-content">
						<div class="tournament-card-details">
							<h6 class="tournament-card-time">{{ $resluague->leagurTitle }}</h6>
							<p class="tournament-card-date"><?PHP echo $startdate ?></p>
							
						</div>						
						<div class="btn-wrap">							
							<a href="{{ url('/leaguesdetail/') }}?leagueslug={{ $resluague->id }}" class="th-btn th_btn"><span class="btn-border">More Info</span></a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	
	{{-- @include('frontEnd.homepage.blogs') --}}
	
	{{-- @include('frontEnd.homepage.partners')        --}}     
    

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
	document.addEventListener("DOMContentLoaded", function () {
    function padNumber(num) {
        return num.toString().padStart(2, "0");
    }

    function initializeCountdown(element) {
        let targetDate = new Date(element.getAttribute("data-date")).getTime();

        function updateCountdown() {
            let now = new Date().getTime();
            let distance = targetDate - now;
            
             if (distance < -24 * 60 * 60 * 1000) { // more than 1 day after start
                element.innerHTML = "<span class='text-danger'>League Completed</span>";
                return;
            }

            if (distance <= 0) {
                element.innerHTML = "<span class='text-danger'>Started</span>";
                return;
            }
            
             


            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = padNumber(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
            let minutes = padNumber(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
            let seconds = padNumber(Math.floor((distance % (1000 * 60)) / 1000));

            element.innerHTML =
                `<div class="time-box"><span>${days}</span><small>Days</small></div>
                 <div class="time-box"><span>${hours}</span><small>Hours</small></div>
                 <div class="time-box"><span>${minutes}</span><small>Minutes</small></div>
                 <div class="time-box"><span>${seconds}</span><small>Seconds</small></div>`;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    document.querySelectorAll(".countdown").forEach(el => initializeCountdown(el));
});
	</script>
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
