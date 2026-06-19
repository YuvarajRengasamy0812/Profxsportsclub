@php
    $Partner = Helper::Topics(10);
@endphp
@php
    $Faqblog = Helper::Topics(36);
@endphp
<!-- faq-section -->
<section class="faq-section pt_140 pb_150">
	<div class="auto-container">
		<div class="row clearfix">
			<div class="col-lg-6 col-md-12 col-sm-12 content-column">
				<div class="content_block_three">
					<div class="content-box mr_30">
						<div class="sec-title mb_60">
@foreach($Partner as $counter)
                @php 
 @endphp
							
							<h2>{{ $counter->title_en ?? '' }}</h2>
							<p>{!! $counter->details_en ?? '' !!}</p>

 @endforeach
						</div>
						<ul class="accordion-box">
							@foreach($Faqblog as $faqblog)
                @php 
 @endphp
							<li class="accordion block">
								<div class="acc-btn">
									<h3>{{ $faqblog->title_en ?? '' }}</h3>
									<div class="icon-box"><i class="icon-20"></i></div>
								</div>
								<div class="acc-content">
									<div class="text">
										<p>{!! $faqblog->details_en ?? '' !!}</p>
									</div>
								</div>
							</li>
							 @endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 image-column">
				<div class="image_block_two">
					@foreach($Partner as $counter)
                @php   
                    $background = !empty($counter->photo_file)
                        ? asset('uploads/topics/' . $counter->photo_file)
                        : asset('assets/frontend/images/resource/faq-1.jpg');
                @endphp
					<div class="image-box ml_30 pl_110">
						<figure class="image image-hov-two"><img src="{{ $background }}" alt=""></figure>
						<div class="award-box"style="background:#011C32;">
							<div class="icon-box" ><img src="assets/frontend/images/icons/award-1.png" alt=""></div>
							<h4>The Exclusive Offers</h4>
						</div>
					</div>
					 @endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- faq-section end -->