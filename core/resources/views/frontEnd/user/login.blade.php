@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
?>
<div id="loadingOverlay" style="display: none;">
    <div class="loading-box">
        <p>Please wait...</p>
        <div class="spinner"></div>
    </div>
</div>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" data-bg-src="{{ URL::asset('assets/frontend/img/bg_auth.png') }}" >
	
	<div class="container-fuild">
		<div class="row">
			<div class="col-md-4" style="background-image: url('{{ URL::asset('assets/frontend/img/prize.png') }}'); background-size: 75%; background-repeat: no-repeat; background-position: center;">&nbsp;</div>
			
			<div class="col-md-4">
				<div class="title-area text-center">
					<h2 class="sec-title text-white">Login</h2>
				</div>
				<form method="post" id="fx-login-form" action="{{ route('login')}}" novalidate class="contact-form ajax-contact pb-xl-0 space-bottom">
					@csrf
					<input type="hidden" name="login_type" value="user" />
					<div class="row m-0">
                        {{-- <div class="alert response-login w-100"></div> --}}
                         <div class="response-login w-100">
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
                        </div>
                    </div>

					<div class="form-group">
						<input name="email" class="form-control border" type="email" required placeholder="Email Address">
						<i class="fal fa-envelope"></i>
					</div>

					<div class="form-group">
						<input name="password" class="form-control border" type="password" required placeholder="Password">
						<i class="fal fa-lock"></i>
					</div>

                    <p class="mb-2"><a href="/forgot-password" class="btn-inline text-white">Forgot Your Password?</a></p>
                    <p class="form-row form-group"><button type="submit" name="login" class="th-btn w-100">Login</button></p>
                    <p class="mb-0 text-center">Don't have an account? <a href="{{ url('/register') }}" class="btn-inline text-white">Register here</a></p>
				</form>
				
			</div>
			<div class="col-md-4" style="background-image: url('{{ URL::asset('assets/frontend/img/vr.png') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center;">&nbsp;</div>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $("#fx-login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please provide a valid email address",
                    email: "Enter a valid email address"
                },
                password: {
                    required: "Please provide your password",
                    minlength: "Password must be at least 6 characters"
                }
            },
            errorClass: "is-invalid",
            validClass: "is-valid",
           highlight: function (element) {
    $(element).addClass("is-invalid").removeClass("is-valid");
},
unhighlight: function (element) {
    $(element).removeClass("is-invalid").addClass("is-valid");
},
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass("invalid-feedback");
                error.insertAfter(element);
            },
            submitHandler: function (form) {
				 $('#loadingOverlay').show();
                // Regular form submission
                form.submit();
            }
        });
    });
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
