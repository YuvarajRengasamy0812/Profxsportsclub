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
<style>
  #availableBalance:focus {
    color: #9291a4!important;
    background-color: #fff!important;
  }
  #transferType option:hover{
      background-color: ##4df57e!important;
  }
</style>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >
	
	<div class="container">
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
			
				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						<h2 class="widget_title" style="margin:0px;">ProFX <span class="text-theme">Transfer</span> !</h2>
					</div>
				</div>
				
				<form class="form-horizontal d-lg-flex  d-block" id="transferForm" autocomplete="off" method="POST" action="" enctype="multipart/form-data">
                @csrf
				<div class="row align-items-stretch c-dashboard-group m-3">
					
					<div class="col-lg-12">
						
					
						<div class="card bg-transparent" style="border: none;">
                            <div class="card-body">
								<div class="row">
									<div class="col-md-6 col-sm-12 mb-3">
										<div class="form-group m-1">                                        
											<select name="transfer_type" id="transferType" class="form-select border" required >
												<option selected disabled value="">Transfer Type</option>
												<option value="Reward">Reward Balance</option>
												<option value="Referral">Referral Bonus</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 mb-3">
										<div class="form-group m-1"> 
											<input style="background-color:#0b0e13; color:#989fb2" type="text" name="available_balance" id="availableBalance" class="form-control border " value="0" readonly />
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 mb-3">
										<div class="form-group m-1"> 
											<input type="number" name="transfer_amount" id="transferAmount" class="form-control border" required placeholder="Enter Transfer Amount" max="" />
										</div>
									</div>
									
									<hr />
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-12 mb-3">
										<button type="submit" class="fx-btn-1 btn bg-theme" id="updateBtn">
											<span class="btn-text" style="color: #000000; font-weight:500">Transfer Now</span>
											<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
										</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				</form>
				
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
    $(document).on('input', '#transferAmount', function () {
		let available = parseFloat($('#availableBalance').val()) || 0;
		let entered   = parseFloat($(this).val()) || 0;

		if (entered > available) {
			Swal.fire({
				icon: 'info',
				title: 'Insufficient Balance',
				text: 'Transfer amount cannot be greater than available balance!',
				confirmButtonText: 'OK'
			});
			$(this).val(''); // clear the field
		}
	});
	
	$('#transferType').on('change', function () {
		let type = $(this).val();
		let url  = ''; 

		if (type === 'Reward') {
			url = 'rewardbalance';
		} else if (type === 'Referral') {
			url = 'referralbalance';
		}

		if (url !== '') {
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				success: function (res) {
					if (type === 'Reward') {
						$('#availableBalance').val(res.reward_balance);
					} else if (type === 'Referral') {
						$('#availableBalance').val(res.referral_balance);
					}
				},
				error: function () {
					Swal.fire({
						icon: 'info',
						title: 'Balance Error',
						text: 'Failed to balance. Please try again! Or Check with Site Admin',
						confirmButtonText: 'OK'
					});
				}
			});
		}
	});
	
	$('#transferForm').on('submit', function (e) {
		e.preventDefault(); // stop normal form submission

		let formData = new FormData(this);

		$.ajax({
			url: 'storetransfer',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
				$('#updateBtn .spinner-border').removeClass('d-none');
				$('#updateBtn .btn-text').text('Processing...');
			},
			success: function (res) {
				$('#transferForm')[0].reset(); // clear form
				Swal.fire({
					icon: 'success',
					title: 'Internal Transfer',
					text: 'Amount update to your wallet successfully.',
					confirmButtonText: 'OK'
				});
			},
			error: function (xhr) {
				console.log(xhr.responseText);
				Swal.fire({
					icon: 'Danger',
					title: 'Internal Transfer',
					text: 'Something went wrong. Please try again.',
					confirmButtonText: 'OK'
				});
			},
			complete: function () {
				$('#updateBtn .spinner-border').addClass('d-none');
				$('#updateBtn .btn-text').text('Send Request');
			}
		});
	});
</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
