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
$user = auth()->user();
?>
<style>
.card-body.box-profile.fx-userpro-box{
    display :flex;
    flex-direction:column;
    align-items: center;
    justify-content: center;
    
}
    .fx-avatar {
    display: inline-block;
    position: relative;
}

.fx-avatar .edit-icon {
    position: absolute;
    bottom: 0;
    right: 0;
    /*background-color: #fff;*/
    color: #45F882;
    border-radius: 50%;
    padding: 5px;
    font-size: 25px;
    transition: 0.3s;
}

.fx-avatar:hover .edit-icon {
    /*background-color: rgba(0,0,0,0.8);*/
}
</style>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">
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
                <div class="row ">
                     <form class="form-horizontal d-lg-flex  d-block" id="myForm"
                                      autocomplete="off"
                                      method="POST"
                                      action="{{ route('user.profile.update') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                    <!-- Profile Image Column -->
                    <div class="col-lg-4 fx-userpro-user">
                        <div class="card card-primary card-outline bg-transparent">
                            <div class="card-body box-profile fx-userpro-box">
                                <div class="text-center fx-avatar position-relative" id="fx-avatar" style="width:100px; margin:auto; cursor:pointer;">
                                    <img id="profileImage" class="profile-user-img img-fluid img-circle"
                                         src="{{ URL::to( ($user->profile_image ?? 'https://profxleague.com/assets/frontend/img/user.png')) }}"
                                         alt="User profile picture" style="height: 100px; width:100px; border-radius:50%">
                                    
                                    <!-- Edit Icon Overlay -->
                                    <span class="edit-icon">
                                        <i class="fa fa-pencil-alt"></i>
                                    </span>
                                    
                                    <input type="file" id="profileInput" name="profile_image" style="display:none;" accept="image/*">
                                </div>
                                <h3 class="profile-username text-center text-white">{{ $user->name .' '. $user->lastname}}</h3>
                                <ul class="list-group list-group-unbordered mb-3 fx-userpro-details">
                                    <li class="list-group-item">
                                        <p class="float-right w-100" data-tippy-placement="bottom" data-tippy-arrow="true"
                                           data-tippy-content="{{ $user->email }}">
                                            {{ $user->email }}
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form Column -->
                    <div class="col-lg-8">
                        <div class="card bg-transparent" style="border: none;">
                            <div class="card-body">
                               

                                    <!-- Name & Lastname -->
                                    <div class="form-group row gap-3 gap-lg-0">
                                        <div class="col-lg-6">
                                            <input autocomplete="new-firstname" type="text"
                                                   value="{{ old('name', $user->name) }}"
                                                   class="form-control border"
                                                   placeholder="First Name" name="name" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <input autocomplete="new-lastname" type="text"
                                                   value="{{ old('lastname', $user->lastname) }}"
                                                   class="form-control border"
                                                   placeholder="Last Name" name="lastname" required>
                                        </div>
                                    </div>

                                    <!-- Nationality -->
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <select name="nationalities" id="nationality-select" class="form-control border">
                                                @foreach($nationalities as $national)
                                                   <option value="{{ $national->id }}" data-code="{{ $national->tel }}"
                                                        {{ old('nationalities', $user->nationalities) == $national->id ? 'selected' : '' }}>
                                                        {{ $national->title_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Country Code & Phone -->
                                    <div class="form-group row gap-3 gap-lg-3">
                                        <div class="col-lg-3">
                                            <select name="country_code" id="country-code-select" class="form-control border">
                                                @foreach($nationalities as $national)
                                                    <option value="{{ $national->tel }}"
                                                        {{ old('country_code', (string)$user->country_code) === (string)$national->tel ? 'selected' : '' }}>
                                                        +{{ $national->tel }} - {{ $national->title_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autocomplete="new-phone" type="number"
                                                   value="{{ old('phone', $user->phone) }}"
                                                   class="form-control border"
                                                   placeholder="Phone" name="phone" required>
                                        </div>
                                    </div>

                                    <!--<div class="form-group row">-->
                                    <!--    <button type="submit" class="fx-btn-1 btn bg-theme">-->
                                    <!--        Update-->
                                    <!--        <span class="spinner-border spinner-border-sm d-none"-->
                                    <!--              role="status" aria-hidden="true"></span>-->
                                    <!--    </button>-->
                                    <!--</div>-->
                                  <div class="form-group row">
                                    <button type="submit" class="fx-btn-1 btn bg-theme" id="updateBtn">
                                        <span class="btn-text" style="color: #000000; font-weight:500">Update</span>
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                     </form>
                </div>
            </div> <!-- /.col-lg-10 -->
        </div>
    </div>
</div>

@endsection

@push('after-scripts')
<script>

document.getElementById('myForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('updateBtn');
    const textSpan = btn.querySelector('.btn-text');
    const spinner = btn.querySelector('.spinner-border');

    // Disable the button
    btn.disabled = true;

    // Show the spinner
    spinner.classList.remove('d-none');

    // Change button text to "Processing" and make it black
    textSpan.textContent = 'Processing...';
    textSpan.style.color = 'black';

    // Optionally, keep the spinner next to text without breaking layout
    spinner.style.marginLeft = '5px';

    // Form will submit naturally
});
// Nationality → country code sync
document.getElementById('nationality-select').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const countryCode = selectedOption.getAttribute('data-code');
    document.getElementById('country-code-select').value = countryCode;
});

// Profile image preview
const fxAvatar = document.getElementById('fx-avatar');
const profileInput = document.getElementById('profileInput');
const profileImage = document.getElementById('profileImage');

fxAvatar.addEventListener('click', () => profileInput.click());

profileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        profileImage.src = e.target.result; // preview selected image
    }
    reader.readAsDataURL(file);
});

</script>
@endpush
