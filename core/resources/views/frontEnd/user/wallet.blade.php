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
    padding-bottom: 17px;
    color: var(--white-color);
    /* margin: -0.12em 0 40px 0; */
}
/* Apply th-btn style to pagination links */
.dataTables_wrapper .dataTables_paginate .page-item .page-link {
    @apply th-btn; /* if you’re using Tailwind + @apply */
}

/* Or pure CSS copy of your th-btn */
.dataTables_wrapper .dataTables_paginate .page-item .page-link {
    position: relative;
    z-index: 2;
    overflow: hidden;
    vertical-align: middle;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: none;
    text-align: center;
    background-color: var(--theme-color);
    color: var(--title-color)!important;
    font-family: var(--title-font);
    font-size: 14px;
    font-weight: 700;
    line-height: 1;
    padding: 10px 18px;  /* smaller than your main .th-btn */
    min-width: 50px;     /* smaller to fit pagination */
    border-radius: 0;
    clip-path: polygon(10px 0%, calc(100% - 10px) 0%, 100% 50%, calc(100% - 10px) 100%, 10px 100%, 0% 50%);
    transition: 0.2s;
    margin: 0 3px;
}

/* Before/After pseudo styles */
.dataTables_wrapper .dataTables_paginate .page-item .page-link:before,
.dataTables_wrapper .dataTables_paginate .page-item .page-link:after {
    content: "";
    position: absolute;
    background-color: var(--title-color);
    z-index: -1;
    transition: all 0.4s ease-out;
    top: 3px;
    left: 3px;
    width: 10px;
    height: calc(100% - 6px);
    clip-path: polygon(85% 0, 100% 0, 15% 50%, 100% 100%, 85% 100%, 0% 50%);
}

.dataTables_wrapper .dataTables_paginate .page-item .page-link:after {
    right: 3px;
    left: auto;
    transform: rotate(180deg);
}

/* Hover & active */
.dataTables_wrapper .dataTables_paginate .page-item .page-link:hover,
.dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
    background: var(--white-color)!important;
    clip-path: polygon(0px 0%, 100% 0%, 100% 50%, 100% 100%, 0 100%, 0% 50%)!important;
    color: var(--title-color)!important;
}

.dataTables_wrapper .dataTables_paginate .page-item .page-link:hover:before,
.dataTables_wrapper .dataTables_paginate .page-item .page-link:hover:after,
.dataTables_wrapper .dataTables_paginate .page-item.active .page-link:before,
.dataTables_wrapper .dataTables_paginate .page-item.active .page-link:after {
    clip-path: polygon(2px 60%, 2px calc(100% - 2px), 100% calc(100% - 0px), 100% 100%, 0 100%, 0 100%);
}

</style>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >
	
	<div class="container">
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
				<div class="container">
					<div class="row align-items-stretch c-dashboard-group m-3">
						<!--<div class="col-lg-12">-->
						<!--	<h2 class="widget_title">Profx <span class="text-theme">Wallet</span> !</h2>-->
						<!--</div>-->
						<div class="d-flex flex-wrap gap-3 mt-2 justify-content-center   justify-content-lg-between align-items-center widget_title p-0">
                                <!-- Left side -->
                                <h2 class="widget_text m-0 p-0">
                                    Profx <span class="text-theme">Wallet</span> !
                                </h2>

                                <!-- Right side buttons -->
                                <div class="btn-group d-table" role="group" aria-label="Wallet actions">
                                    <button class="action-button"
                                        onclick="checkKYC('{{ route('user.withdraw') }}')">
                                        <i class="fa fa-download"></i>
                                        <label>Withdraw</label>
                                    </button>
                                    <button class="action-button"
                                        onclick="checkKYC('{{ route('user.choosepayment', 'deposit') }}')">
                                        <i class="fa fa-upload"></i>
                                        <label>Deposit</label>
                                    </button>
                                    <button class="action-button disabled">
                                        <i class="fa fa-tag"></i>
                                        <label>Purchase</label>
                                    </button>
                                    <button class="action-button"
                                        onclick="checkKYC('{{ route('user.transfer') }}')">
                                        <i class="fa fa-arrow-right-arrow-left"></i>
                                        <label>Transfer</label>
                                    </button>
                                </div>
                            </div>
						<div class="col-lg-12 col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="card bg-transparent border">
										<div class="card-header h6 mb-0 text-white">ProFX Wallet Balance</div>
										<div class="h3 card-header mb-0 theme-text border-bottom">${{ $availableWallet['balance'] }}</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card bg-transparent border">
										<div class="card-header h6 mb-0 text-white">Total Reward Balance</div>
										<div class="h3 card-header theme-text mb-0">${{ $availableWallet['reward_balance'] }}</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card bg-transparent border">
										<div class="card-header h6 mb-0 text-white">Total Referral Bonus</div>
										<div class="h3 card-header theme-text mb-0">${{ $availableWallet['referral_balance'] }}</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 mt-3">	
							<div class="bg-transparent ">
								<div class="card-header h5 mb-0 text-white">
									Transactions
								</div>
							<div class="card-body pb-0">
								<div style="overflow-x: auto;">
									<table style="min-width: 600px; width: 100%; border-collapse: collapse;" class="table table-striped table-bordered text-white vertical-middle" id="walletTable">
										<thead>
											<tr>
												<th class="text-white">#</th>
												<th class="text-white">Name</th>
												<th class="text-white">Amount</th>
												<th class="text-white">Type</th>
												<th class="text-white">Description</th>
												<th class="text-white">Date Time</th>
											</tr>
										</thead>
										<tbody>
										@if($transactions)
											@foreach ($transactions as $key => $txn)
											<tr>
												<td class="text-white">{{ $key + 1 }}</td>
												<td class="text-white">{{ $txn->fromUser->name ?? 'System' }}</td>
												<td class="text-white">${{ number_format($txn->amount, 2) }}</td>
												<td class="text-white">{{ ucfirst($txn->type) }}</td>
												<td class="text-white">{{ $txn->description }}</td>
												<td class="text-white">{{ $txn->created_at->format('d M Y h:i A') }}</td>
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
		</div>
	</div>
</div>
	
	

@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		$(document).ready(function () {
			$('#walletTable').DataTable({
				pageLength: 10,
				order: [[5, 'desc']],
				searching: false,
				info: false,
				language: {
            emptyTable: '<span style="color:white;">No Data Found</span>'
        }
			});
		});
	
	function checkKYC(targetUrl)
 {
    const kycStatus = {{ Auth::user()->kyc_status }};

    if(kycStatus === 0) {
        Swal.fire({
            icon: 'info',
            title: 'KYC Pending',
            text: 'Your KYC is pending. Please wait for approval before proceeding.',
            confirmButtonText: 'OK'
        });
    } else if(kycStatus === 2) {
        Swal.fire({
            icon: 'warning',
            title: 'KYC Rejected',
            text: 'Your KYC was rejected. Please upload/update your KYC to continue.',
            showCancelButton: true,
            confirmButtonText: 'Upload KYC',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('user.kyc') }}";
            }
        });
    } else {
        window.location.href = targetUrl;
    }
 }
 </script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
