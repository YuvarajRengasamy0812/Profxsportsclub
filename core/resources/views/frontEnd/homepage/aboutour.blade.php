@php
    $About = Helper::Topics(17);
@endphp

<section class="about-section pb_140">
    <div class="auto-container">
        <div class="row clearfix">
            @foreach($About as $about)
                @php
                    // Default values
                    $buttonlink = '';
                    $titlename = '';
                    $section1 = '';
                    $section2 = '';
                    $section3 = '';
                    $image = asset('assets/frontend/images/resource/about-1.jpg');

                    // Fetch custom fields
                    if (!empty($about->fields)) {
                        foreach ($about->fields as $field) {
                            switch ($field['field_id']) {
                                case 20:
                                    $buttonlink = $field['field_value'];
                                    break;
                                case 45:
                                    $titlename = $field['field_value'];
                                    break;
                                case 46:
                                    $section1 = $field['field_value'];
                                    break;
                                case 47:
                                    $section2 = $field['field_value'];
                                    break;
                                case 48:
                                    $section3 = $field['field_value'];
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
                    

                    // Main background image (topic main photo)
                    $background = !empty($about->photo_file)
                        ? asset('uploads/topics/' . $about->photo_file)
                        : asset('assets/frontend/images/resource/about-1.jpg');
                @endphp

                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box mr_70 pt_15">
                            <div class="sec-title mb_30">
                                <span class="sub-title">{{ $about->title_en ?? '' }}</span>
                                @if(!empty($titlename))
                                    <h2>{{ $titlename }}</h2>
                                @endif
                            </div>
                            <div class="text-box mb_30">
                                <p>{!! $about->details_en ?? '' !!}</p>
                            </div>

                            <ul class="list-style-one clearfix mb_40">
                                @if(!empty($section1))
                                    <li><i class="fas fa-check-circle"></i>{{ $section1 }}</li>
                                @endif
                                @if(!empty($section2))
                                    <li><i class="fas fa-check-circle"></i>{{ $section2 }}</li>
                                @endif
                                @if(!empty($section3))
                                    <li><i class="fas fa-check-circle"></i>{{ $section3 }}</li>
                                @endif
                            </ul>

                            @if(!empty($buttonlink))
                                <div class="btn-box">
                                    <a href="{{ $buttonlink }}" class="theme-btn btn-one">Learn More</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box ml_20 pl_140 pt_15">
                            <div class="image-shape">
                                <div class="shape-1 z_1"></div>
                                <div class="shape-2" style="background-image: url('{{ asset('assets/frontend/images/shape/shape-1.png') }}');"></div>
                            </div>
                            <figure class="image image-1 image-hov-two">
                                <img src="{{ $background }}" alt="{{ $titlename }}">
                            </figure>
                            <figure class="image image-2 p_absolute l_0 b_70 z_2">
                                <img src="{{ $image }}" alt="{{ $titlename }}">
                            </figure>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
