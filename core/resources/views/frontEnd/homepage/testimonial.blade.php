<?php
$TestimonialsLimit = 0; // 0 = all
$Testimonials = Helper::Topics(11, 0, $TestimonialsLimit, 1);
?>
@if(count($Testimonials)>0)
<div class="about-sec-3 overflow-hidden space-top position-relative z-index-common" data-bg-src="{{ URL::asset('assets/frontend/img/bg-testi.avif') }}">
	<div class="gr-bg1 overlay"></div>
    <div class="container">
		<div class="row justify-content-center">
			<div class="title-area  text-center custom-anim-top wow" data-wow-duration="1.5s" data-wow-delay=".2s">
				<span class="sub-title style3"><span class="sub-title-shape icon-masking"><span class="mask-icon" data-mask-src="{{ URL::asset('assets/frontend/img/section-title-bg.svg') }}"></span></span>Calling All Top Forex Brokers</span>
				<h2 class="sec-title">Join the & Be Part of Something Big!</h2>
			</div>
		</div>
		<div class="slider-area testi-slider1">
			<div class="swiper th-slider" id="testiSlide1"
				data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}},"effect":"slide","loop":false,"thumbs":{"swiper":".testi-grid-thumb"}}'>
				<div class="swiper-wrapper">
					<?php $section_url = ""; ?>
					@foreach($Testimonials as $Topictest)
					<?php
						if ($Topictest->$title_var != "") {
							$titletesti = $Topictest->$title_var;
						} else {
							$titletesti = $Topictest->$title_var2;
						}
						if ($Topictest->$details_var != "") {
							$detailstesti = $details_var;
						} else {
							$detailstesti = $details_var2;
						}
						if ($section_url == "") {
							$section_url = Helper::sectionURL($Topictest->webmaster_id);
						}
						$topic_link_url = Helper::topicURL($Topictest->id,"",$Topictest);
						$HomeSectionType = @$Topictest->webmasterSection->type;
						if (!@$require_mp3_player && $HomeSectionType == 3) {
							$require_mp3_player = 1;
						}
					?>
					<div class="swiper-slide">
						<div class="testi-card"
							data-bg-src="{{ URL::asset('assets/frontend/img/testi-card-bg1.png') }}">
							<p class="testi-card_text text">{!! strip_tags($Topictest->$details_var) !!}</p>
							<div class="testi-card_profile">
								<div class="testi-card_content">
									<h3 class="testi-card_name name">{{ $titletesti }}</h3>
								</div>
								<div class="quote-icon icon-masking"><span class="mask-icon" data-mask-src="{{ URL::asset('assets/frontend/img/quote1-1.svg') }}"></span><img decoding="async" src="{{ URL::asset('assets/frontend/img/quote1-1.svg') }}" alt="quote1 1" /></div>
							</div>
						</div>
						
					</div>
					@endforeach
				</div>
				<div class="slider-pagination"></div>
			</div>
			<button data-slider-prev="#testiSlide1" class="slider-arrow style2 slider-prev"><i class="far fa-arrow-left"></i></button>
			<button data-slider-next="#testiSlide1" class="slider-arrow style2 slider-next"><i class="far fa-arrow-right"></i></button>
		</div>
	</div>
</div>
@endif