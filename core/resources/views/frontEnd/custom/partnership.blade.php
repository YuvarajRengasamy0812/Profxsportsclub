@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
$partnerinto = Helper::Topic(165);
$partnerwhy = Helper::Topic(166);
$partnerwhyimg = Helper::Topic(167);

?>
<style>
    .accordion-button:not(.collapsed) {
            color: #45F882 !important;
            background-color: transparent !important;
            box-shadow: none;
        }

        .accordion-card.style2 .accordion-button::after {
    background-color: #0b0e13 0b0e13!important; /* black when collapsed */
        }

        .accordion-card.style2 .accordion-button:not(.collapsed)::after {
    background-color: #45F882 !important; /* green when expanded */
}
.floating-close-btn {
  position: absolute;
  top: 20px;
  left: 20px;
  background: rgba(255,255,255,0.2);
  color: white;
  font-size: 30px;
  border: none;
  border-radius: 50%;
  width: 50px; height: 50px;
  display: flex; justify-content: center; align-items: center;
  cursor: pointer;
  z-index: 1056;
  transition: background 0.3s;
}
.floating-close-btn:hover {
  background: rgba(255,255,255,0.5);
}
iframe{
    width:10%; !important;
}
</style>
<!--==============================
    Breadcumb
============================== -->
    <div class="th-hero-wrapper hero-1" id="hero">
		<div class="th-hero-bg" data-bg-src="{{ URL::to('uploads/topics/'.$partnerinto->photo_file) }}">
		</div>
		<div class="container">
			{!! @$partnerinto->$details_var !!}			
		</div>
	</div>
	
	
<div class="about-sec-3 overflow-hidden space-top position-relative z-index-common"
        data-bg-src="assets/img/bg/about-bg2.png">
        <div class="gr-bg1 overlay"></div>
        <div class="container">
            <div class="about-wrap3">
                <div class="row gy-40">
                    <div class="col-xl-6">
                        {!! @$partnerwhy->$details_var !!}
                        @if (count($partnerspecialacc) > 0)
                            <div class="accordion faq-wrap2" id="faqAccordion6">
                                @foreach ($partnerspecialacc as $key => $partneracc)
                                    @php
                                        $titleacc = $partneracc->$title_var ?: $partneracc->$title_var2;
                                        $detailsacc = $partneracc->$details_var ?: $partneracc->$details_var2;

                                        $itemId = 'collapse-fx-' . $key;
                                        $headerId = 'collapse-item-fx-' . $key;

                                        $isFirst = $key === 0 ? 'show' : '';
                                        $ariaExpanded = $key === 0 ? 'true' : 'false';
                                    @endphp

                                    <div class="accordion-card style2">
                                        <div class="accordion-header" id="{{ $headerId }}">
                                            <button class="accordion-button title {{ $key !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{ $itemId }}" aria-expanded="{{ $ariaExpanded }}"
                                                aria-controls="{{ $itemId }}">
                                                {{ $titleacc }}
                                            </button>
                                        </div>
                                        <div id="{{ $itemId }}"
                                            class="accordion-collapse collapse {{ $isFirst }}"
                                            aria-labelledby="{{ $headerId }}" data-bs-parent="#faqAccordion6">
                                            <div class="accordion-body desc">
                                                <div>{{ $detailsacc }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <!--<div class="col-xl-6">-->
                    <!--    <div class="text-xl-end video-box1 custom-anim-right wow"><img decoding="async"-->
                    <!--            src="{{ URL::to('uploads/topics/' . $partnerwhyimg->photo_file) }}" alt="video2 1" />-->
                    <!--        <a href="https://youtu.be/8Sl8THGGbI8?si=iZuKXrcyXcH-nsQZ" class="play-btn style3"><i-->
                    <!--                class="fa-sharp fa-solid fa-play"></i></a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-xl-6">
    <div class="text-xl-end video-box1 custom-anim-right wow">
        <img decoding="async"
             src="{{ URL::to('uploads/topics/' . $partnerwhyimg->photo_file) }}"
             alt="video2 1" style="cursor: pointer;" 
             data-bs-toggle="modal" data-bs-target="#videoModal" />
        
        <a href="javascript:void(0)" class="play-btn style3" 
           data-bs-toggle="modal" data-bs-target="#videoModal">
            <i class="fa-sharp fa-solid fa-play"></i>
        </a>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
	<section class="tournament-details-page space-top space-extra2-bottom">
        <div class="container">
            <div class="row gx-40">

                <div class="col-12">
					<div class="title-area ">
						<span class="sub-title style2">Are Numbers Your Passion?</span>
						<h6 class="sec-title">Join us now by registering through the form below and be part of a transformative journey in the world of trading.</h6>
					</div>
				</div>
                <div class="col-12">
					<div class="row">
						<div class="form-group style-border2 col-md-6">
							<input type="text" placeholder="Brand Name *" value="" name="brand_name" class="form-control"  required />
							<i class="far fa-tag"></i>
						</div>
						<div class="form-group style-border2 col-md-6">
							<input type="text" class="form-control" placeholder="Company Name" value="" name="company_name"  required />
							<i class="far fa-building"></i>
						</div>
						<div class="form-group style-border2 col-md-6">
							<input class="form-control" placeholder="Contact Person" value="" type="text" name="contact_person" required />
							<i class="fal fa-user"></i>
						</div>
						<div class="form-group style-border2 col-md-6">
							<input class="form-control" placeholder="Designation" value="" type="text" name="designation" required />
							<i class="fal fa-user-tie"></i>
						</div>
						<div class="form-group style-border2 col-md-6">
							<input class="form-control" placeholder="Official Email" value="" type="email" name="email" required />
							<i class="fal fa-envelope"></i>
						</div>
						<div class="form-group style-border2 col-md-6">
							<input class="form-control" placeholder="Phone Number" value="" type="number" name="phone"  required />
							<i class="far fa-phone"></i>
						</div>
						<div class="col-12 form-group style-border2">
							<textarea cols="40" rows="10" class="form-control" placeholder="Write Massage..." name="message" required></textarea>
							<i class="far fa-pencil"></i>
						</div>
						<div class="col-12 form-group mb-0">
							<button class="th-btn" type="submit">Send Message <i class="fa-solid fa-arrow-right ms-2"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
        <button type="button" class="floating-close-btn" data-bs-dismiss="modal" aria-label="Close">
   <i class="fa fa-times"></i>
</button>
      <div class="ratio ratio-16x9">
        <iframe id="videoIframe" 
                src="" 
                title="YouTube video player" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>
</div>
	</section>

	@include('frontEnd.homepage.testimonial')
	@include('frontEnd.homepage.blogs')

	@include('frontEnd.homepage.partners')

@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
@endpush
@push('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
$('.popup-youtube').magnificPopup({
    type: 'iframe',
    iframe: {
        patterns: {
            youtube: {
                index: 'youtube.com/',
                id: 'v=',
                src: 'https://www.youtube.com/embed/%id%?autoplay=1&mute=1&rel=0&showinfo=0'
            }
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    var videoModal = document.getElementById('videoModal');
    var videoIframe = document.getElementById('videoIframe');
    var videoUrl = "https://www.youtube.com/embed/8Sl8THGGbI8?autoplay=1";

    videoModal.addEventListener('show.bs.modal', function () {
        videoIframe.src = videoUrl;
    });

    videoModal.addEventListener('hidden.bs.modal', function () {
        videoIframe.src = ""; // stop video when modal closes
    });
});
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
