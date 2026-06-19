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
    padding-bottom: 21px;
    color: var(--white-color);
    /* margin: -0.12em 0 40px 0; */
}
</style>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >
	
	<div class="container">
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
				<!--<div class="row align-items-stretch c-dashboard-group m-3">-->
					
					<!--<div class="col-lg-12">-->
					<!--	<h2 class="widget_title" style="margin:0px;">-->
					<!--		ProFX <span class="text-theme">Withdraw</span> ! -->
					<!--		<span style="float:right;"> <small>Available Balance :</small> $<span class="text-theme">{{ number_format($availableWallet, 2) }}</span></span>-->
					<!--	</h2>-->
					<!--</div>-->
					
					<div class="d-flex flex-wrap gap-3 mt-2 justify-content-center justify-content-lg-between align-items-center widget_title">
                        <!-- Left side -->
                        <h2 class="widget_text m-0 p-0">
                            ProFX <span class="text-theme">Withdraw</span> ! 
                        </h2>

                        <!-- Right side -->
                    <div>
                        <span style="float:right;"> <small>Available Balance :</small> $<span class="text-theme">{{ number_format($availableWallet, 2) }}</span></span>
                    </div>
                </div>
			<!--</div>-->
				
				@if($withdrawapproval > 0)
					<div class="row align-items-stretch c-dashboard-group m-3">
						<div class="col-lg-12">
							<h3 class="text-danger">You already have a pending withdraw request.</h3>
						</div>
					</div>
				@else
				<form class="form-horizontal d-lg-flex  d-block" id="withdrawForm" autocomplete="off" method="POST" action="" enctype="multipart/form-data">
                @csrf
				<div class="row align-items-stretch c-dashboard-group m-3">
					
					<div class="col-lg-12">
						
					
						<div class="card bg-transparent" style="border: none;">
                            <div class="card-body">
								
								<input type="hidden" name="wallet_balance" class="availableBalance" value="{{ number_format($availableWallet, 2) }}" />
								<div class="row">
									<div class="col-md-6 col-sm-12 mb-3">
										<div class="form-group m-1">                                        
											<select name="withdraw_type" id="withdrawType" class="form-control border" required >
												<option selected disabled value="">Withdraw Type</option>
												<option value="Bank">Bank</option>
												<option value="Crypto">Crypto</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 mb-3">
										<div class="form-group m-1"> 
											<select name="withdraw_account" id="withdrawAccount" class="form-control border" required >
												<option selected disabled value="">Choose Account</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-12 mb-3">
										<div class="form-group m-1"> 
											<input type="number" name="withdraw_amount" id="withdrawAmount" class="form-control border" required placeholder="Enter Request Amount" max="{{ $availableWallet }}" />
										</div>
									</div>
									
									<!--<div class="col-lg-6 col-sm-12 mb-3">
										<div class="form-group m-1"> 
											<input type="file" name="withdraw_proof" id="withdrawProof" class="" required />
											<p><small>Upload Your selected account proof</small></p>
										</div>
									</div>-->
									
									<hr />
								</div>
								<div class="row">
									<div class="col-lg-4 col-sm-12 mb-3">
										<button type="submit" class="fx-btn-1 btn bg-theme" id="updateBtn">
											<span class="btn-text" style="color: #000000; font-weight:500">Send Request</span>
											<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
										</button>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				</form>
				@endif
				
				<div class="bg-transparent ">
					<div class="card-header h5 mb-0 text-white">Requests</div>
					<div class="card-body pb-0">
					    <div style="overflow-x: auto;">
						<table style="min-width: 600px; width: 100%; border-collapse: collapse;" class="table table-striped table-bordered text-white vertical-middle" id="walletTable">
							<thead>
								<tr>
									<th class="text-white">#</th>
									<th class="text-white">Balance</th>
									<th class="text-white">Req Amount</th>
									<th class="text-white">Req Type</th>
									<th class="text-white">Req Date</th>
									<th class="text-white">Status</th>
								</tr>
							</thead>
							<tbody>
							@if($walletwithdraw)
								@foreach ($walletwithdraw as $key => $wwtxn)
								<tr>
									<td class="text-white">{{ $key + 1 }}</td>
									<td class="text-white">${{ number_format($wwtxn->wallet_balance, 2) }}</td>
									<td class="text-white">${{ number_format($wwtxn->withdraw_amount, 2) }}</td>
									<td class="text-white">{{ ucfirst($wwtxn->withdraw_type) }}</td>
									<td class="text-white">{{ date('Y-m-d', strtotime($wwtxn->withdraw_requestdate)) }}</td>
									<td class="text-white"> <?PHP if($wwtxn->status == 0){ echo "Pending"; } ?></td>
								</tr>
								@endforeach
							@endif
							</tbody>
						</table>
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
	$(document).on('input', '#withdrawAmount', function () {
		let available = parseFloat($('.availableBalance').val()) || 0;
		let entered   = parseFloat($(this).val()) || 0;

		if (entered > available) {
			Swal.fire({
				icon: 'info',
				title: 'Insufficient Balance',
				text: 'Withdraw amount cannot be greater than available balance!',
				confirmButtonText: 'OK'
			});
			$(this).val(''); // clear the field
		}
	});
	
	$('#withdrawType').on('change', function () {
		let type = $(this).val();
		let url  = ''; 

		if (type === 'Bank') {
			url = 'get-bank-accounts';
		} else if (type === 'Crypto') {
			url = 'get-crypto-wallets';
		}

		if (url !== '') {
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				success: function (res) {
					let options = '<option selected disabled value="">Choose Account</option>';
					if (type === 'Bank') {
						$.each(res, function (key, item) {
							options += `<option value="${item.id}">${item.bank_name} - ${item.account_number}</option>`;
						});
					} else if (type === 'Crypto') {
						$.each(res, function (key, item) {
							options += `<option value="${item.id}">${item.wallet_name} - ${item.wallet_network}</option>`;
						});
					}
					$('#withdrawAccount').html(options);
				},
				error: function () {
					Swal.fire({
						icon: 'info',
						title: 'Account Error',
						text: 'Failed to load accounts. Please try again! Or Check with Site Admin',
						confirmButtonText: 'OK'
					});
				}
			});
		}
	});
	
	$('#withdrawForm').on('submit', function (e) {
		e.preventDefault(); // stop normal form submission

		let formData = new FormData(this);

		$.ajax({
			url: 'withdrawrequest',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function () {
				$('#updateBtn .spinner-border').removeClass('d-none');
				$('#updateBtn .btn-text').text('Processing...');
			},
			success: function (res) {
				$('#withdrawForm')[0].reset(); // clear form
				Swal.fire({
					icon: 'success',
					title: 'Withdraw Request',
					text: 'Withdraw request submitted successfully! Please wait for approval.',
					confirmButtonText: 'OK'
				});
			},
			error: function (xhr) {
				console.log(xhr.responseText);
				Swal.fire({
					icon: 'Danger',
					title: 'Withdraw Request',
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
