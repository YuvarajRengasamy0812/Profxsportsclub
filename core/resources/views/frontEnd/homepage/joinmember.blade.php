<!-- cta-section -->

@php
    $Counter = Helper::Topics(33);
@endphp

<section class="cta-section bg-color-2 pt_140 pb_150">
	@foreach($Counter as $counter)
                @php   

				  $buttonlink = '';
                    $titlename = '';
                    
                   

                    // Fetch custom fields
                    if (!empty($counter->fields)) {
                        foreach ($counter->fields as $field) {
                            switch ($field['field_id']) {
                                case 51:
                                    $buttonlink = $field['field_value'];
                                    break;
                                case 52:
                                    $titlename = $field['field_value'];
                                    break;
                                
                              
                            }
                        }
                    }
                    $background = !empty($counter->photo_file)
                        ? asset('uploads/topics/' . $counter->photo_file)
                        : asset('assets/frontend/images/resource/cta-1.png');
						
                @endphp
	<div class="pattern-layer"></div>
	<figure class="image-layer p_absolute r_200 b_0" data-parallax='{"x": 100}'><img  src="{{ $background }}" alt=""></figure>
	<div class="auto-container">
		<div class="content-box">
			
			<div class="sec-title light mb_40">
				<span class="sub-title">{{ $counter->title_en ?? '' }}</span>
				<h2>{!! $counter->details_en ?? '' !!}</h2>
			</div>
			<div class="btn-box">
				<a  href="{{ $buttonlink }}" class="theme-btn btn-one">become a member</a>
				<a  href="{{$titlename}}" class="theme-btn btn-two">Contact Us</a>
			</div>
		</div>
	</div>
	 @endforeach
</section>
<!-- cta-section end -->