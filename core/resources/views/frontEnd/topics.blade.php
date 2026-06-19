@extends('frontEnd.layouts.master')

@section('content')
    <div>
        <?php
        $title_var = "title_" . @Helper::currentLanguage()->code;
        $title_var2 = "title_" . config('smartend.default_language');
        $webmaster_section_title = "";
        $category_title = "";
        $page_title = "";
        $category_image = "";
        if (@$WebmasterSection != "none") {
            if (@$WebmasterSection->$title_var != "") {
                $webmaster_section_title = @$WebmasterSection->$title_var;
            } else {
                $webmaster_section_title = @$WebmasterSection->$title_var2;
            }
            $page_title = $webmaster_section_title;
            if (@$WebmasterSection->photo != "") {
                $category_image = URL::to('uploads/topics/' . @$WebmasterSection->photo);
            }
        }
        if ($CurrentCategory != "none") {
            if (!empty($CurrentCategory)) {
                if (@$CurrentCategory->$title_var != "") {
                    $category_title = @$CurrentCategory->$title_var;
                } else {
                    $category_title = @$CurrentCategory->$title_var2;
                }
                $page_title = $category_title;
                if (@$CurrentCategory->photo != "") {
                    $category_image = URL::to('uploads/sections/' . @$CurrentCategory->photo);
                }
            }
        }
        if (!empty(@$DBTag)) {
            $page_title = $DBTag->title;
        }
		
		if($webmaster_section_title == 'Blog'){ 
        ?>
		<div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
			<div class="container">
				<div class="breadcumb-content">
					<h1 class="breadcumb-title">Latest News</h1>
					<ul class="breadcumb-menu">
						<li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
						<li class="active">{{ $page_title }}</li>
					</ul>
				</div>
			</div>
		</div>
		
		<section class="th-blog-wrapper space-top space-extra-bottom arrow-wrap">
		    <!--Announcement Component-->
		    <div class="bg-dark gradient-border rounded-20 container py-4">
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
                                            <li class="alert alert-warning">Registration for online PROFXSPORTSCLUB Started
                                                from 26 Aug 2025.
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
            <!--Announcement Component-->
			<div class="container pt-4">
				<div class="row">
					 <?php
						$title_var = "title_" . @Helper::currentLanguage()->code;
						$title_var2 = "title_" . config('smartend.default_language');
						$details_var = "details_" . @Helper::currentLanguage()->code;
						$details_var2 = "details_" . config('smartend.default_language');
						$slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
						$slug_var2 = "seo_url_slug_" . config('smartend.default_language');
						$i = 0;
						$cols_lg = 4;
						$cols_md = 6;
						if (count($Categories) > 0) {
							$cols_lg = 6;
							$cols_md = 12;
						}
						?>
					@foreach($Topics as $Topic)
					<?PHP 
					
					if ($Topic->$title_var != "") {
						$titleblogval = $Topic->$title_var;
					} else {
						$titleblogval = $Topic->$title_var2;
					}
					$topic_link_url = Helper::topicURL($Topic->id,"",$Topic);
					$HomeSectionType = @$Topic->webmasterSection->type;
					?>
						<div class="col-lg-6">
							<!-- Single Post -->
							<div class="post-33 post type-post status-publish format-standard has-post-thumbnail hentry category-mx-xbox tag-3d-game th-blog blog-single has-post-thumbnail">
								<!-- blog-content -->
								<!-- Post Thumbnail -->
								<div class="blog-img"><a href="{{ $topic_link_url }}" class="post-thumbnail"><img
											fetchpriority="high" width="750" height="360"
											src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
											class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""
											decoding="async" sizes="(max-width: 750px) 100vw, 750px" /></a></div>
								<!-- End Post Thumbnail -->
								<div class="blog-content">
									<div class="blog-meta">
										<a href="#"><i class="far fa-user"></i>By Admin</a>
										<a href="#"><i class="far fa-calendar"></i><?PHP echo date('d M, Y', strtotime($Topic->date)); ?></a>
									</div><!-- Post Title -->
									<h2 class="blog-title"><a href="{{ $topic_link_url }}">{{ $titleblogval }}</a></h2><!-- End Post Title -->
									<!-- Post Summary -->
									<p class="blog-text">{!! mb_substr(strip_tags($Topic->$details_var),0, 200)."..." !!} </p>
									<a href="{{ $topic_link_url }}" class="link-btn style2">READ MORE<i class="fa-regular fa-arrow-right ms-2"></i></a><!-- End Post Summary -->
								</div><!-- End Post Content -->
							</div><!-- End Single Post -->
						</div>
					@endforeach	
				</div>
			</div>
		</section>
		<?PHP } else if($webmaster_section_title == 'Photos'){ ?>
		<div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
			<div class="container">
				<div class="breadcumb-content">
					<h1 class="breadcumb-title">Our Gallery</h1>
					<ul class="breadcumb-menu">
						<li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
						<li class="active">{{ $page_title }}</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="space">
			<div class="container">
				<div class="row gy-4 masonary-active">
				@foreach($Topics as $Topic)
					
					<div class="col-xl-3 col-md-3 col-sm-6 filter-item">
						<div class="gallery-card">
							<div class="box-img">
								<img class="card-img-top" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"  width="100%" height="100%" loading="lazy"/>
								<a href="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" class="play-btn popup-image style3"><i class="fa-solid fa-arrow-up-right"></i></a>
							</div>
						</div>
					</div>
					
				@endforeach
				</div>
			</div>
		</div>
		
		<?PHP } else if($webmaster_section_title == 'Videos'){ ?>
		
		<div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
			<div class="container">
				<div class="breadcumb-content">
					<h1 class="breadcumb-title">Our Videos</h1>
					<ul class="breadcumb-menu">
						<li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
						<li class="active">{{ $page_title }}</li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="space">
			<div class="container">
				<div class="row gy-4">
				@foreach($Topics as $Topic)
				<?PHP $topic_link_url = Helper::topicURL($Topic->id,"",$Topic);
					$HomeSectionType = @$Topic->webmasterSection->type; ?>
					<div class="col-12 col-md-4">
						<div class="filter-item fx-gallery">
							<div class="gallery-card">
								<div class="box-img">
								@php
									$videoId = '';
									if (str_contains($Topic->video_file, 'youtu.be')) {
										$videoId = last(explode('/', $Topic->video_file));
									} elseif (str_contains($Topic->video_file, 'youtube.com') && str_contains($Topic->video_file, 'v=')) {
										parse_str(parse_url($Topic->video_file, PHP_URL_QUERY), $query);
										$videoId = $query['v'] ?? '';
									}
								@endphp

								@if($videoId)
								<iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $videoId }}"
									title="YouTube video player" frameborder="0"
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
									referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
								@endif
									
								</div>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
		
		<?PHP } else if($webmaster_section_title == 'Referral'){ ?>
		<div class="breadcumb-wrapper " data-bg-src="{{ URL::asset('assets/frontend/img/breadcumb-bg.png') }}">
			<div class="container">
				<div class="breadcumb-content">
					<h1 class="breadcumb-title">Referral Program</h1>
					<ul class="breadcumb-menu">
						<li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
						<li class="active">{{ $page_title }}</li>
					</ul>
				</div>
			</div>
		</div>
		
		
		
		<?PHP } else { ?>
        @if($category_image !="")
            @include("frontEnd.topic.cover")
        @endif
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{  (@$search_word !="")?(__('backend.resultsFoundFor')." [ ".@$search_word." ]"):$page_title }}</h2>
                    <ol>
                        <li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
                        @if(@$search_word !="")
                            <li class="active">{!! __("backend.search") !!}</li>
                        @elseif($webmaster_section_title !="")
                            <li class="active"><a
                                    href="{{ Helper::sectionURL(@$WebmasterSection->id) }}">{!! $webmaster_section_title !!}</a>
                            </li>
                        @elseif(@$search_word!="")
                            <li class="active">{{ @$search_word }}</li>
                        @elseif(!empty(@$DBTag))
                            <li class="active">{{ @$DBTag->title }}</li>
                        @else
                            <li class="active">{{ @$User->name }}</li>
                        @endif
                        @if($category_title !="")
                            <li class="active"><a
                                    href="{{ Helper::categoryURL(@$CurrentCategory->id) }}">{{ $category_title }}</a>
                            </li>
                        @endif
                    </ol>
                </div>

            </div>
        </section>
        <section id="content">
            <div class="container">
                <div class="row">
                    @if(@count($Categories)>1)
                        @include('frontEnd.layouts.side')
                    @endif
                    <div
                        class="col-lg-{{(@count($Categories)>1)? "9":"12"}} col-md-{{(@count($Categories)>1)? "7":"12"}} col-sm-12 col-xs-12">
                        @if($Topics->total() == 0)
                            <div class="p-5 card text-center no-data">
                                <i class="fa fa-desktop fa-5x opacity-50"></i>
                                <h5 class="mt-3 text-muted">{{ __('frontend.noData') }}</h5>
                            </div>
                        @else
                            <div class="row">
                                @if($Topics->total() > 0)

                                    <?php
                                    $title_var = "title_" . @Helper::currentLanguage()->code;
                                    $title_var2 = "title_" . config('smartend.default_language');
                                    $details_var = "details_" . @Helper::currentLanguage()->code;
                                    $details_var2 = "details_" . config('smartend.default_language');
                                    $slug_var = "seo_url_slug_" . @Helper::currentLanguage()->code;
                                    $slug_var2 = "seo_url_slug_" . config('smartend.default_language');
                                    $i = 0;
                                    $cols_lg = 4;
                                    $cols_md = 6;
                                    if (count($Categories) > 0) {
                                        $cols_lg = 6;
                                        $cols_md = 12;
                                    }
                                    ?>
                                    @foreach($Topics as $Topic)
                                        <?php
                                        if ($Topic->$title_var != "") {
                                            $title = $Topic->$title_var;
                                        } else {
                                            $title = $Topic->$title_var2;
                                        }
                                        if ($Topic->$details_var != "") {
                                            $details = $details_var;
                                        } else {
                                            $details = $details_var2;
                                        }

                                        $topic_link_url = Helper::topicURL($Topic->id, "", $Topic);
                                        ?>
                                        <div
                                            class="col-lg-{{$cols_lg}} col-md-{{$cols_md}}">
                                            @include("frontEnd.topic.card",["Topic"=>$Topic])
                                        </div>
                                        <?php
                                        $i++;
                                        ?>
                                    @endforeach

                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    {!! $Topics->appends($_GET)->links() !!}
                                </div>
                                <div class="col-lg-4 text-end">
                                    <h5 style="padding-top: 18px">{{ $Topics->firstItem() }}
                                        - {{ $Topics->lastItem() }} {{ __('backend.of') }}
                                        ( {{ $Topics->total()  }} ) {{ __('backend.records') }}</h5>
                                </div>
                            </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
		<?PHP } ?>
    </div>
    @include('frontEnd.layouts.popup',['Popup'=>@$Popup])
@endsection
@if (@in_array(@$WebmasterSection->type, [3]))
    @push('before-styles')
        <link rel="stylesheet"
              href="{{ URL::asset('assets/frontend/vendor/green-audio-player/css/green-audio-player.min.css') }}?v={{ Helper::system_version() }}"/>
    @endpush
    @push('after-scripts')
        <script
            src="{{ URL::asset('assets/frontend/vendor/green-audio-player/js/green-audio-player.min.js') }}?v={{ Helper::system_version() }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                GreenAudioPlayer.init({
                    selector: '.audio-player',
                    stopOthersOnPlay: true,
                    showTooltips: true,
                });
            });
        </script>
    @endpush
@endif
