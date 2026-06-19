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
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 pt-3 pt-lg-0">
							<h2 class="widget_title">Profx <span class="text-theme">Referral</span> Earnings!</h2>
						</div>
						<div class="col-lg-12 col-md-12">
							<div class="row">								
								<div class="col-md-4">
									<div class="card bg-transparent border">
										<div class="card-header mb-0 text-white">Total Referral Bonus</div>
										<div class="h3 card-header theme-text mb-0">${{ $referralBonus }}</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 mt-3">	
							<div class="bg-transparent ">
								<div class="card-header h5 mb-0 text-white">
									Earning
								</div>
								<div class="card-body pb-0">
									<table class="table table-striped table-bordered text-white vertical-middle" id="walletTable">
										<thead>
											<tr>
												<th class="text-white">#</th>
												<th class="text-white">Amount</th>
												<th class="text-white">Description</th>
												<th class="text-white">Date Time</th>
											</tr>
										</thead>
										<tbody>
										@if($earninglist)
											@foreach ($earninglist as $key => $txn)
											<tr>
												<td class="text-white">{{ $key + 1 }}</td>
												<td class="text-white">${{ number_format($txn->amount, 2) }}</td>
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
	<script>
		$(document).ready(function () {
			$('#walletTable').DataTable({
				pageLength: 10,
				order: [[5, 'desc']],
				searching: false,
				info: false
			});
		});
	</script>
    {{-- integrate your custom js code/files here--}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection

