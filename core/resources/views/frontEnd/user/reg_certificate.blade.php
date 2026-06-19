@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $title_var = 'title_' . @Helper::currentLanguage()->code;
    $title_var2 = 'title_' . config('smartend.default_language');
    $details_var = 'details_' . @Helper::currentLanguage()->code;
    $details_var2 = 'details_' . config('smartend.default_language');
    $aboutsection1 = Helper::Topic(155);
    $aboutsecupcoming = Helper::Topic(156);
    $aboutseconemid = Helper::Topic(158);
    $aboutsectwomid = Helper::Topic(159);
    $aboutjoinleague = Helper::Topic(160);
    ?>
    
    <style>
.widget_text {
    font-size: 30px;
    font-weight: 700;
    font-family: var(--title-font);
    color: var(--white-color);
}

.widget_title {
    position: relative;
    font-size: 30px;
    font-weight: 700;
    font-family: var(--title-font);
    line-height: 1em;
    padding-bottom: 17px;
    color: var(--white-color);
    /* margin: -0.12em 0 40px 0; */
}
    </style>

    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
    <!-- Sidebar Overlay -->
    <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>

    <!-- Sidebar -->
    @include('frontEnd.user.usermenu')

    <!-- Main Content -->
    <div class="col-lg-10 col-sm-12">
        <div class="row container">
            <!-- Profile Card -->
            <!--<div class="col-lg-4 fx-userpro-user">
                <div class="card card-primary card-outline bg-transparent">
                    <div class="card-body box-profile fx-userpro-box">
                        <div class="text-center fx-avatar text-center" id="fx-avatar" onclick="loadAvatarModal()">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ URL::to('uploads/profile_images/user.png') }}"
                                alt="User profile picture" style="height: 100px; width:100px;">
                        </div>

                        <div class="row" id="fx-avatar-update" style="display:none">
                            <form id="fx-avatar-form" class="form form-vertical" action="#" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="kv-avatar fx-kv-avatar">
                                            <div class="file-loading">
                                                <input id="avatar-2" name="profile_pic" type="file" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div onclick="closeAvatarModal()" id="kv-avatar-errors-2" class="center-block"
                                style="width:800px;display:none"></div>
                        </div>

                        <h3 class="profile-username text-center text-white">
                            {{ $user['firstname'] . ' ' . $user['lastname'] }}
                        </h3>

                        <ul class="list-group list-group-unbordered mb-3 fx-userpro-details">
                            <li class="list-group-item">
                                <p class="float-right w-100" data-tippy-placement="bottom"
                                    data-tippy-arrow="true" data-tippy-content="{{ $user['email'] }}">
                                    {{ $user['email'] }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->

            <!-- Certificate Section -->
<div class="d-flex flex-wrap gap-3 mt-2 justify-content-lg-between justify-content-center align-items-center widget_title p-lg-0 pb-2">
    <!-- Left side -->
    <h2 class="widget_text m-0 p-0">
        Profx <span class="text-theme">Registration Certificate</span> !
    </h2>

    <!-- Right side button -->
    @if(Auth::user()->certificate_path)
        @php
            $certificateExt  = pathinfo(Auth::user()->certificate_path, PATHINFO_EXTENSION);
        @endphp

        @if(in_array(strtolower($certificateExt), ['jpg','jpeg','png', 'pdf']))
            <a href="{{ URL::to(Auth::user()->certificate_path) }}" 
               download="certificate.{{ $certificateExt }}" 
               class="th-btn d-flex gap-2 align-items-center h-25">
               <i class="fa fa-download"></i> Certificate
            </a>
        @endif
    @endif
</div>

            <!--<div class="col-lg-12">-->
			<!--	<h2 class="widget_title">Profx <span class="text-theme">Registration Certificate</span> !</h2>-->
			<!--</div>-->
            <div class="col-lg-12 col-sm-12">
                @if(Auth::user()->certificate_path)
                    <div class="card card-primary card-outline bg-transparent">
                        
                     <div class="card-body">
    @php
        $certificatePath = asset(Auth::user()->certificate_path);
        $certificateExt  = pathinfo(Auth::user()->certificate_path, PATHINFO_EXTENSION);
    @endphp

    @if(in_array(strtolower($certificateExt), ['jpg','jpeg','png']))
        <a href="{{ URL::to(Auth::user()->certificate_path) }}" target="_blank">
            <img src="{{ $certificatePath }}" alt="Registration Certificate"
                style="max-width: 100%; border:1px solid #ccc; padding:5px;">
        </a>

        <!-- Download Button -->
        <!--<div class="mt-3">-->
        <!--    <a href="{{ URL::to(Auth::user()->certificate_path) }}" -->
        <!--       download="certificate.{{ $certificateExt }}" -->
        <!--       class="btn btn-success">-->
        <!--       <i class="fa fa-download"></i> Download Certificate-->
        <!--    </a>-->
        <!--</div>-->
    @elseif(strtolower($certificateExt) === 'pdf')
        <a href="{{ URL::to(Auth::user()->certificate_path) }}" target="_blank"
            class="btn btn-primary btn-sm">
            View Registration Certificate (PDF)
        </a>

        <!-- Download Button -->
        <!--<div class="mt-3">-->
        <!--    <a href="{{ URL::to(Auth::user()->certificate_path) }}" -->
        <!--       download="certificate.pdf" -->
        <!--       class="btn btn-success">-->
        <!--       <i class="fa fa-download"></i> Download Certificate-->
        <!--    </a>-->
        <!--</div>-->
    @endif
</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

        </div>
    </div>




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
