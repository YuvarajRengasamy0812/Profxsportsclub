<!-- news-section -->

@php
    $Blog = Helper::Topics(35);
@endphp

        <section class="news-section pt_140 pb_110">
            <div class="auto-container">
                <div class="sec-title centred mb_60">
                    <span class="sub-title">Our Testimonial</span>
                    <h2>Victory Voices<br /></h2>
                </div>
                <div class="row clearfix">
	@foreach($Blog as $blog)
                @php   

				  $buttonlink = '';
                    $titlename = '';
                    
                   

                    // Fetch custom fields
                    if (!empty($blog->fields)) {
                        foreach ($blog->fields as $field) {
                            switch ($field['field_id']) {
                                case 53:
                                    $buttonlink = $field['field_value'];
                                    break;
                                case 54:
                                    $titlename = $field['field_value'];
                                    break;
                                 case 55:
                                    $count = $field['field_value'];
                                    break;
                              
                            }
                        }
                    }
                    $background = !empty($blog->photo_file)
                        ? asset('uploads/topics/' . $blog->photo_file)
                        : asset('assets/frontend/images/news/news-1.jpg');
						
                @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="blog-details.html"><img src="{{ $background }}" alt=""></a></figure>
                                    <figure class="overlay-image"><a href="blog-details.html"><img src="{{ $background }}" alt=""></a></figure>
                                    <span class="post-date">{{ $blog->date ?? '' }}</span>
                                </div>
                                <div class="lower-content">
                                    <!-- <span class="category">{{ $blog->title_en ?? '' }}</span> -->
                                    <h3><a href="blog-details.html">{{ $buttonlink }}</a></h3>
                                    <p>{{$titlename}}</p>
                                    <ul class="post-info">
                                        <li class="author">
                                            <!--<div class="image"><img src="assets/frontend/images/news/author-1.png" alt=""></div>-->
                                            <!--<a href="blog-details.html">{{$titlename}}</a>-->
                                        </li>
                                        <!--<li><i class="icon-26"></i>{{ $count }}</li>-->
                                    </ul>
                                   <div class="btn-box mt-3">
                        <a href="{{ $blog->details_en ?? '' }} " class="theme-btn btn-one">Read More</a>
                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- news-section -->