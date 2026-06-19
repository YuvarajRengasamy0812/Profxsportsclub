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
			<div class="col-md-4" style="background-image: url('{{ URL::asset('assets/frontend/img/prize.png') }}'); background-size: 70%; background-repeat: no-repeat; background-position: center;">&nbsp;</div>
			
			<div class="col-md-4">
				<div class="title-area text-center">
					<h2 class="sec-title text-white">Register</h2>
				</div>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul class="mb-0">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form method="post" id="fx-register-form" action="" novalidate class="contact-form ajax-contact pb-xl-0 space-bottom">
					@csrf
					<div class="row form-row">
						<div class="col-md-6">
							<div class="form-group">
								<input autocomplete="new-first" type="text" name="firstname" class="form-control border" placeholder="First Name" value="{{ old('firstname') }}" required>
						
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input autocomplete="new-lastname" type="text" name="lastname" class="form-control border" placeholder="Last Name" value="{{ old('lastname') }}" required>
							
							</div>
						</div>
					</div>
					
					<div class="row form-row">
						<div class="col-md-12">
							<div class="form-group">
								<input autocomplete="new-email" type="email"
									name="email"
									class="form-control border @error('email') is-invalid @enderror"
									placeholder="Email"
									value="{{ old('email') }}"
									required
								>
								@error('email')
									<span class="invalid-feedback d-block text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group mb-3">
								<select name="nationalities" id="nationlities" class="form-control border w-100" required>
									<option value="" selected disabled>Nationality</option>
									@foreach($nationalities as $national)
										<option value="{{ $national['id'] }}" data-code="{{ $national['tel'] }}" {{ old('nationalities') == $national['id'] ? 'selected' : '' }}>
											{{ $national['title_en'] }}
										</option>
									@endforeach
								</select>
						
							</div>
						</div>
					</div>

					<div class="row form-row">
						<div class="col-4">
							<div class="form-group">
								<select name="country_code" id="country_code" class="form-control border select2" required>
									<option value="" selected disabled>Country Code</option>
									@foreach($nationalities as $national)
										<option value="{{ $national['tel'] }}" {{ old('tel') == $national['tel'] ? 'selected' : '' }}>
											+{{ $national['tel'] }} - {{ $national['title_en'] }}
										</option>
									@endforeach
								</select>
						
							</div>
						</div>

						<div class="col-8">
							<div class="form-group">
								<input autocomplete="new-phone" type="text" name="contact_phone" class="form-control border" placeholder="Mobile Number" value="{{ old('contact_phone') }}" required>
						
							</div>
						</div>
					</div>

					<div class="row form-row">
						<div class="col-md-6">
							<div class="form-group">
								<input autocomplete="new-password" type="password" name="password" class="form-control border" placeholder="Password" required>
							
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<input autocomplete="new-confirm-password" type="password" name="confirm_password" class="form-control border" placeholder="Confirm Password" required>
						
							</div>
						</div>
					</div>

					<div class="form-group">
						<input name="referral_code" value="{{ old('refCode', $refCode ?? '') }}" class="form-control border" type="text" placeholder="Enter Referral Code">
					</div>

					<div class="row">
						<div class="col-md-12">
							<label class="text-white d-block mb-2">Mode of Registration</label>
							<div class="form-group d-flex flex-wrap">
								<div class="custom-control custom-radio mr-3 mb-2">
									<input type="radio" id="mode_online" name="registration_mode" value="Online" class="custom-control-input"  required {{ request('mode') == 'on' ? 'checked' : '' }}>
									<label class="custom-control-label text-white" for="mode_online">Online </label> &nbsp;&nbsp;&nbsp;
								</div>
								<div class="custom-control custom-radio mb-2 ml-3">
									<input type="radio" id="mode_offline" name="registration_mode" value="Offline" class="custom-control-input"  required {{ request('mode') == 'off' ? 'checked' : '' }}>
									<label class="custom-control-label text-white" for="mode_offline">Offline</label>
								</div>
						
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group mt-3 custom-checkbox notice">
								<input id="terms_and_conditions" value="1" name="terms_and_conditions" type="checkbox" {{ old('terms_and_conditions') ? 'checked' : '' }} required>
								<label for="terms_and_conditions" class="text-white">
									I accept the <a href="{{ url('/terms') }}" target="_blank">Terms & Conditions</a>
								</label>
							
							</div>
						</div>
					</div>
					
					<p class="form-row form-group"><button type="submit" value="Register" class="th-btn w-100">Register</button></p>
					<p class="mb-0 text-center">Do have an account? <a href="{{ url('/login') }}" class="btn-inline text-white">Login here</a></p>
				</form>
				
			</div>
			
			<div class="col-md-4" style="background-image: url('{{ URL::asset('assets/frontend/img/vr.png') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center;">&nbsp;</div>
			
		</div>
	</div>
</div>


	
	

@endsection
@push('before-styles')
	<link rel="stylesheet"
          href="{{ URL::asset('assets/frontend/vendor/intl-tel-input/css/intlTelInput.min.css') }}?v={{ Helper::system_version() }}"/>
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css?v=2&" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css?v=2&" rel="stylesheet" />
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
	<script src="{{ URL::asset('assets/frontend/vendor/intl-tel-input/js/intlTelInput.min.js') }}?v={{ Helper::system_version() }}"></script>	
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>	
	<script>
	$(document).ready(function () {
		$("#fx-register-form").validate({
			ignore: [],
			rules: {
				firstname: { required: true },
				lastname: { required: true },
				email: { required: true, email: true },
				nationalities: { required: true },
				country_code: { required: true },
				contact_phone: {
					required: true,
					digits: true,
					minlength: 6,
					maxlength: 15
				},
				password: {
					required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					equalTo: "[name='password']"
				},
				registration_mode: { required: true },
				terms_and_conditions: { required: true }
			},
			errorElement: "div",
			errorPlacement: function (error, element) {
				if (element.attr("type") === "radio" || element.attr("type") === "checkbox") {
					error.addClass("text-danger w-100 mt-1");
					error.appendTo(element.closest(".form-group"));
				} else {
					error.addClass("invalid-feedback");
					element.closest(".form-group").append(error);
				}
			},
			highlight: function (element) {
				$(element).addClass("is-invalid");
			},
			unhighlight: function (element) {
				$(element).removeClass("is-invalid");
			},
			submitHandler: function (form) {
				// ✅ Set the form action dynamically (change URL as needed)
				$(form).attr("action", "{{ route('register') }}");

				// ✅ Show loading overlay
				$('#loadingOverlay').show();

				// ✅ Disable the submit button to prevent double clicks
				$('.th-btn[type="submit"]').prop('disabled', true);

				// ✅ Optional debug
				console.log("Form is valid. Submitting...");
				console.log("Form action:", $(form).attr("action"));

				// ✅ Submit the form normally
				form.submit();
			}
		});
	});
	</script>
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
