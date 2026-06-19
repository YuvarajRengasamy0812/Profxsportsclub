@php
    $Gallery = Helper::Topics(4);

    $buttonlink = '';
    if(isset($Gallery[0]->fields) && count($Gallery[0]->fields) > 0) {
        if($Gallery[0]->fields[0]['field_id'] == 50 && $Gallery[0]->fields[0]['field_id'] != '' ){
            $buttonlink = $Gallery[0]->fields[0]['field_value'];
        }
    }
@endphp

<section class="portfolio-style-two pb_110 pl_70 pr_70">
    <div class="auto-container">
        <div class="sec-title mb_60">
            <span class="sub-title">{{ $Gallery[0]->title_en ?? '' }}</span>
            <h2>{!! $Gallery[0]->details_en ?? '' !!}</h2>
            <a href="{{ $buttonlink }}" class="theme-btn btn-one">Learn More</a>
        </div>
    </div>

    <div class="outer-container">
        <div class="row clearfix">
            @foreach ($Gallery as $gallery)
                @php
                    $image = !empty($gallery->photo_file)
                        ? asset('uploads/topics/' . $gallery->photo_file)
                        : asset('assets/frontend/images/portfolio/portfolio-5.jpg');

                    $title = $gallery->title_en ?? 'Golf Courses';
                    $description = $gallery->seo_description_en ?? 'Lorem ipsum dolor sit amet consectetur elit.';
                @endphp

                <div class="col-lg-3 col-md-6 col-sm-12 portfolio-block">
                    <div class="portfolio-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ $image }}" alt="{{ $title }}"></figure>
                            <div class="view-btn">
                                <a href="{{ $image }}" class="lightbox-image" data-fancybox="gallery"><i class="icon-32"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
