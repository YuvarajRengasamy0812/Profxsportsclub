@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $title_var = 'title_' . @Helper::currentLanguage()->code;
    $title_var2 = 'title_' . config('smartend.default_language');
    $details_var = 'details_' . @Helper::currentLanguage()->code;
    $details_var2 = 'details_' . config('smartend.default_language');
    $section_url = '';
    ?>

    <!--==============================
        Breadcumb
    ============================== -->
    <div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $pagetitle }}</h1>
                <ul class="breadcumb-menu">
                    <li><a href="{{ Helper::homeURL() }}">{{ __('backend.home') }}</a></li>
                    <li class="active">Blog</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-dark gradient-border">
        <div class="card-body">
            <h5 class="card-title text-white">Latest Announcements / Notifications</h5>
            <div class="card-text announcement-content">


                <ul class="list-unstyled">
                    <li class="alert alert-success">Upcoming league: Bull VS Bear starts on
                        Sep 10th, 2025.
                    </li>
                    <li class="alert alert-info">Join the PROFXSPORTSCLUB today and get free
                        subscriptions included with membership of PROFX Club.
                    </li>
                    <li class="alert alert-warning">Registration for online PROFXSPORTSCLUB Started from 26 Aug 2025.
                    </li>
                    <!--<li class="alert alert-warning">Become the next millionaire by leveling-->
                    <!--	up your hustle and dominating the league.-->
                    <!--</li>-->
                    <li class="alert alert-warning">Stay updated with our latest blog posts
                        on forex trading and more.</li>
                </ul>
            </div>
            <!--<a href="{{ route('user.dashboard') }}" class="tab-btn th-btn float-end pt-3 pb-3">View More</a>-->
        </div>
    </div>

    <section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">
        <div class="container">
            <div class="row">
                @foreach ($bloglist as $blogrs)
                    <?php
        if ($blogrs->$title_var != '') {
            $titleblogval = $blogrs->$title_var;
        } else {
            $titleblogval = $blogrs->$title_var2;
        }
        if ($section_url == '') {
            $section_url = Helper::sectionURL($blogrs->webmaster_id);
        }
        $topic_link_url = Helper::topicURL($blogrs->id, '', $blogrs);
        $HomeSectionType = @$blogrs->webmasterSection->type;
        ?>
                    <div class="col-lg-6">
                        <!-- Single Post -->
                        <div
                            class="post-33 post type-post status-publish format-standard has-post-thumbnail hentry category-mx-xbox tag-3d-game th-blog blog-single has-post-thumbnail">
                            <!-- blog-content -->
                            <!-- Post Thumbnail -->
                            <div class="blog-img"><a href="{{ $topic_link_url }}" class="post-thumbnail"><img
                                        fetchpriority="high" width="750" height="360"
                                        src="{{ URL::to('uploads/topics/' . $blogrs->photo_file) }}"
                                        class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
                                        decoding="async" sizes="(max-width: 750px) 100vw, 750px" /></a></div>
                            <!-- End Post Thumbnail -->
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a href="#"><i class="far fa-user"></i>By Admin</a>
                                    <a href="#"><i
                                            class="far fa-calendar"></i><?php echo date('d M, Y', strtotime($blogrs->date)); ?></a>
                                </div><!-- Post Title -->
                                <h2 class="blog-title"><a href="{{ $topic_link_url }}">{{ $titleblogval }}</a></h2>
                                <!-- End Post Title -->
                                <!-- Post Summary -->
                                <p class="blog-text">{!! mb_substr(strip_tags($blogrs->$details_var), 0, 200) . '...' !!} </p>
                                <a href="{{ $topic_link_url }}" class="link-btn style2">READ MORE<i
                                        class="fa-regular fa-arrow-right ms-2"></i></a><!-- End Post Summary -->
                            </div><!-- End Post Content -->
                        </div><!-- End Single Post -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontEnd.homepage.partners')
@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
