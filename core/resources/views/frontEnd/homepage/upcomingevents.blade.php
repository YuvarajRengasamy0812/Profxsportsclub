@php
    $Event = Helper::Topics(37);
@endphp


<section class="event-section pb_150">
    <div class="auto-container">
        <div class="sec-title centred mb_55">
            <span class="sub-title">Upcoming Event Section</span>
            <h2>Gear Up for Action</h2>
        </div>

        <div class="row clearfix"> <!-- ✅ Added row -->
            @foreach ($Event as $event)
                @php
                    $buttonlink = '';

                    // Fetch custom fields
                    if (!empty($event->fields)) {
                        foreach ($event->fields as $field) {
                            switch ($field['field_id']) {
                                case 56:
                                    $buttonlink = $field['field_value'];
                                    break;
                            }
                        }
                    }

                    $image = !empty($event->photo_file)
                        ? asset('uploads/topics/' . $event->photo_file)
                        : asset('assets/frontend/images/resource/event-1.jpg');
                @endphp

                <!-- ✅ Column layout for each event box -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb_30">
                    <div class="event-block-one wow fadeInUp animated">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="event-details.html"><img src="{{ $image }}" alt=""></a>
                                </figure>
                                <span class="location">{{ $event->title_en ?? '' }}</span>
                            </div>
                            <div class="lower-content">
                                <span class="post-date">
                                    <i class="icon-17"></i>{{ $event->date }} || {{ $buttonlink ?: '#' }}
                                </span>
                                <h3><a href="event-details.html">{{ $event->details_en ?? '' }}</a></h3>
                                <div class="btn-box justify-content-center">
                                    <a href="{{ url('/upcomeingEvent') }}" class="theme-btn btn-two">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> <!-- ✅ end .row -->
    </div>
</section>
<!-- event-section end -->
