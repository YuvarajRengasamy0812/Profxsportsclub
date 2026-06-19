@php
    $Homebanner = Helper::Topics(30);
@endphp

<section class="service-section centred pt_95 pb_100">
    <div class="auto-container">
        <div class="sec-title centred mb_55">
            <span class="sub-title">
                {{ $Homebanner[0]->title_en ?? '' }}
            </span>
            <h2>{!! $Homebanner[0]->details_en ?? '' !!}</h2>
        </div>

        <div class="row clearfix">
            @foreach ($Homebanner as $banner)
                @php
                  

                      if (!empty($banner->fields)) {
                        foreach ($banner->fields as $field) {
                            switch ($field['field_id']) {
                              
                                case 38 :
                                    $titlename = $field['field_value'];
                                    break;
                                case 37:
                                    $section1 = $field['field_value'];
                                    break;
                                case 47:
                                    $section2 = $field['field_value'];
                                    break;
                                case 48:
                                    $section3 = $field['field_value'];
                                    break;
                                      case 57:
                                    $urllink = $field['field_value'];
                                    break;
                                case 49:
                                    // If it's a full URL, use as is; otherwise, treat it as an upload path
                                    $image = Str::startsWith($field['field_value'], ['http://', 'https://'])
                                        ? $field['field_value']
                                        : asset('uploads/topics/' . $field['field_value']);
                                    break;
                            }
                        }
                    }

                    $image = !empty($banner->photo_file)
                        ? asset('uploads/topics/' . $banner->photo_file)
                        : asset('assets/frontend/images/service/service-1.jpg');

                    $title = $banner->title_en ?? 'Golf Courses';
                    $description = $banner->seo_description_en ?? 'Lorem ipsum dolor sit amet consectetur elit.';
                @endphp

                <div class="col-lg-4 col-md-6 col-sm-12 service-block">
                    <div class="service-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ $image }}" alt="{{ $title }}">
                                </figure>
                            </div>
                            <div class="lower-content">
                                <h3><a href="#">{{$section1 }}</a></h3>
                                <p>{{ $titlename }}</p>
                                <div class="link">
                                    <a href="{{$urllink}}"><i class="icon-7"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
