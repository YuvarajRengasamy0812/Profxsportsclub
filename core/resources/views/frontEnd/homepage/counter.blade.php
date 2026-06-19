
@php
    $Counter = Helper::Topics(32);
@endphp


<section class="funfact-section pt_80 pb_50" style="background:#011C32">
	
	<div class="auto-container">
		<div class="inner-container clearfix">

		@foreach($Counter as $counter)
                @php   
                    $background = !empty($counter->photo_file)
                        ? asset('uploads/topics/' . $counter->photo_file)
                        : asset('assets/frontend/images/resource/about-1.jpg');
                @endphp
			<div class="funfact-block-one">
				<div class="inner-box">
					<div class="icon-box" style="background:#fff"><img src="{{ $background }}" alt=""style="max-width:100%; max-height:100%; object-fit:cover;"></div>
					<div class="count-outer">
						<p class="" style="color:#fff;">{{ $counter->title_en ?? '' }}</p>
					</div>
					<h4>{!! $counter->details_en ?? '' !!}</h4>
				</div>
			</div>
			 @endforeach
		</div>
		
	</div>
</section>