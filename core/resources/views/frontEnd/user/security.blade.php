@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
$aboutsection1 = Helper::Topic(155);
$aboutsecupcoming = Helper::Topic(156);
$aboutseconemid = Helper::Topic(158);
$aboutsectwomid = Helper::Topic(159);
$aboutjoinleague = Helper::Topic(160);
?>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >

	<div class="container">
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
                 <div class="row">
            <div class="col-lg-4 fx-userpro-user">
                <!-- Profile Image -->
                <div class="card card-primary card-outline bg-transparent">
                    <div class="card-body box-profile fx-userpro-box">
                        <div class="text-center fx-avatar text-center" id="fx-avatar" onclick="loadAvatarModal()" >
                            <img class="profile-user-img img-fluid img-circle rounded-circle"
                                src="{{ URL::to( ($user->profile_image ?? 'https://profxleague.com/assets/frontend/img/user.png')) }}"
                                alt="User profile picture" style="height: 100px; width:100px;">
                        </div>
                        <div class="row" id="fx-avatar-update" style="display:none">
                            <form id="fx-avatar-form" class="form form-vertical" action="#"
                                enctype="multipart/form-data">
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
                                style="width:800px;display:none" onclick=""></div>

                        </div>
                        <h3 class="profile-username text-center text-white">
                            <?= $user['name'] . ' ' . $user['lastname'] ?>
                        </h3>
                        <ul class="list-group list-group-unbordered mb-3 fx-userpro-details">
                            <li class="list-group-item">
                                <p class="float-right w-100" data-tippy-placement="bottom" data-tippy-arrow="true"
                                    data-tippy-content="<?= $user['email'] ?>">
                                    <?= $user['email'] ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-lg-8">
                <div class="card bg-transparent">
                    <div class="card-header fx-label-1">
                        <h4 class="card-title w-100">
                            <a class="d-block w-100 fx-text-black" data-toggle="collapse"
                                href="#collapseChangePassword">
                                Change Password
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" id="update-pswd-form" autocomplete="off" method="POST" action="{{ route('user.update.password') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="fx-up-pswd" class="col-sm-2 col-form-label">New
                                    Password</label>
                                <div class="col-sm-10">
                                    <input autocomplete="new-password" type="password" class="form-control border"
                                        id="fx-up-pswd" placeholder="Enter Password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fx-up-c-pswd" class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <input autocomplete="new-password" type="password" class="form-control border"
                                        id="fx-up-c-pswd" placeholder="Confirm Password" name="password_confirmation"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="th-btn style2">
                                        Update
                                        <span class="spinner-border spinner-border-sm d-none" role="status"
                                            aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="alert response-change-pswd ms-3"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
<script>
document.getElementById('nationality-select').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption.getAttribute('data-code');
    const countryCodeSelect = document.getElementById('country-code-select');
    countryCodeSelect.value = countryCode;
});
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
