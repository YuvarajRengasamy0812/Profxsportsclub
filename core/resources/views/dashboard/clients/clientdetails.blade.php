@extends('dashboard.layouts.master')
@section('title', 'Client Details')
@section('content')
   <div class="padding">
		<div class="box">
			<div class="box-header dker">
			  <h3><i class="material-icons">manage_accounts</i> Client Details</h3>
			  <small><a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a></small>
			</div>

		<div class="card-main">
		  <div class="row p-4">
			<!-- Left Column (Profile) -->
			<div class="col-md-4">
			  <div class="card text-center">
				<div class="card-body" style="padding:20px">
					@if($clientdetails->profile_image)
					
				
						<img style="border-radius: 50px;" src="{{ asset($clientdetails->profile_image) }}" width="75" height="75"/>
					@else
						<img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="75" height="75" />
					@endif
					<h5 class="card-title" style="margin-top:0.5rem;">{{ ucfirst($clientdetails->name) }}</h5>
					<p class="text-muted">{{ $clientdetails->email }} / {{ $clientdetails->userid }}</p>
					@if($clientdetails->status == 1)
                        <span class="badge badge-success text-white">Active</span>
                    @else
                        <span class="badge badge-danger text-white" style="background: red; color:#fff; border-radius:40px; padding:5px;">Inactive</span>
                    @endif

				  <ul class="list-group text-left mt-3">
				      <hr>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Phone <span>{{$clientdetails->phone}}</span>
					</li>
				<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
                    Email Verified
                    <span>
                        @if($clientdetails->email_verified_at)
                            <!-- Verified -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#81C784"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="tabler-icon tabler-icon-mail-check">
                                <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                                <path d="M15 19l2 2l4 -4"></path>
                            </svg>
                        @else
                            <!-- Not Verified -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#FFCC80"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                class="tabler-icon tabler-icon-mail-x">
                                <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                                <path d="M22 22l-5 -5"></path>
                                <path d="M17 22l5 -5"></path>
                            </svg>
                        @endif
                    </span>
                </li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  KYC Verified 
					  <span>
					      @if($clientdetails->kyc_status)
					      <i class="material-icons icon-success">verified_user</i>
					       @else
					      <i class="material-icons icon-danger">highlight_off</i>
					       @endif
					  </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  <span>Payment Status</span> 
					  <span>
					      @if($clientdetails->payment_status)
					  <i class="material-icons icon-success">paid</i>
					  @else
					  <i class="material-icons icon-danger">money_off</i>
					   @endif
					  </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  <span>Referral Code</span>
					  <span>{{$clientdetails->referral_code}}</span>
					</li>
				  </ul>
				</div>
			  </div>
			</div>

			<!-- Right Column (Stats + Security + Deposits) -->
			<div class="col-md-8" style="padding:20px">
			  <!-- Stats -->
			  <div class="row text-center mb-4">
				<div class="col-md-3">
				  <div class="card" style="padding:10px">
					<h6>Wallet Balance</h6>
					<h4 class="text-primary">${{ $availableWallet['balance'] }}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:10px">
					<h6>Reward Balance</h6>
					<h4>${{ $availableWallet['reward_balance'] }}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:10px">
					<h6>Referral Bonus</h6>
					<h4>${{ $availableWallet['referral_balance'] }}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:10px">
					<h6>Total Contest</h6>
					<h4>{{$accountcount}}</h4>
				  </div>
				</div>
			  </div>

			  <!-- Deposits Table -->
			 <div class="card" style="padding:10px">
                    <h6>Transactions</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $key => $txn)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $txn->fromUser->name ?? 'System' }}</td>
                                        <td>${{ number_format($txn->amount, 2) }}</td>
                                        <td>{{ ucfirst($txn->type) }}</td>
                                        <td>{{ $txn->description }}</td>
                                        <td>{{ $txn->created_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No data found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
			  <!-- Withdraw Table -->
		<div class="card" style="padding:10px">
                <h6>Withdraw Request</h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Account No</th>
                                <th>Deposit Amount</th>
                                <th>Deposit Type</th>
                                <th>Deposit From</th>
                                <th>Deposited Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($walletdetails as $kt => $tl)
                                <tr>
                                    <td>{{ $tl->withdraw_account }}</td>
                                    <td>${{ $tl->withdraw_amount }}</td>
                                    <td>{{ $tl->withdraw_type }}</td>
                                    <td>{{ $tl->deposit_from }}</td>
                                    <td>{{ $tl->withdraw_requestdate }}</td>
                                    <td>
                                        @if ($tl->status == 1)
                                            <span class="badge badge-success text-white">Approved</span>
                                        @else
                                            <span class="badge badge-warning text-white">Pending</span>
                                        @endif
                                    </td>
                                    <td><i class="material-icons">visibility</i></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No data found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

			  <!-- Trasaction Table -->
			 <!-- <div class="card" style="padding:10px">-->
				<!--<h6>Referal</h6>-->
				<!--<div class="table-responsive">-->
				<!--  <table class="table table-striped">-->
				<!--	<thead>-->
				<!--	  <tr>-->
				<!--		<th>Account No</th>-->
				<!--		<th>Deposit Amount</th>-->
				<!--		<th>Deposit Type</th>-->
				<!--		<th>Deposit From</th>-->
				<!--		<th>Deposited Date</th>-->
				<!--		<th>Status</th>-->
				<!--		<th>Actions</th>-->
				<!--	  </tr>-->
				<!--	</thead>-->
				<!--	<tbody>-->
				<!--	  <tr>-->
				<!--		<td>5997705</td>-->
				<!--		<td>$5000</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>2025-08-01 16:16:38</td>-->
				<!--		<td><span class="badge badge-success text-white">Approved</span></td>-->
				<!--		<td><i class="material-icons">visibility</i></td>-->
				<!--	  </tr>-->
				<!--	  <tr>-->
				<!--		<td>5997705</td>-->
				<!--		<td>$5000</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>2025-08-01 16:12:55</td>-->
				<!--		<td><span class="badge badge-success text-white">Approved</span></td>-->
				<!--		<td><i class="material-icons">visibility</i></td>-->
				<!--	  </tr>-->
				<!--	  <tr>-->
				<!--		<td>5997705</td>-->
				<!--		<td>$10000</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>Discount</td>-->
				<!--		<td>2025-07-31 18:07:55</td>-->
				<!--		<td><span class="badge badge-success text-white">Approved</span></td>-->
				<!--		<td><i class="material-icons">visibility</i></td>-->
				<!--	  </tr>-->
				<!--	</tbody>-->
				<!--  </table>-->
				<!--</div>-->
			 <!-- </div>-->

			</div>
		  </div>
		</div>
	  </div>
	</div>

	
	
	<style>
        /* General box/card styling */
		.card {
		  border: none;
		  border-radius: 10px;
		  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
		  margin-bottom: 20px;
		}

		/* Profile image */
		.card img.rounded-circle {
		  border: 3px solid #f0f0f0;
		}

		/* Headings */
		.card h5 {
		  font-weight: 600;
		}

		.card h6 {
		  font-size: 14px;
		  font-weight: 600;
		  margin-bottom: 8px;
		}

		/* Badges */
		.badge-primary {
		  background-color: #007bff;
		  padding: 6px 12px;
		  border-radius: 12px;
		}

		.badge-success {
		  background-color: #00b894;
		  padding: 6px 12px;
		  border-radius: 12px;
		  font-size: 12px;
		}

		/* List group */
		.list-group-item {
		  border: none;
		  border-bottom: 1px solid #f1f1f1;
		  font-size: 14px;
		  padding: 10px 15px;
		}

		/* Stat cards */
		.row.text-center .card {
		  background: #fff;
		  border-radius: 10px;
		  box-shadow: 0 1px 5px rgba(0,0,0,0.08);
		}

		.row.text-center .card h6 {
		  font-size: 13px;
		  color: #777;
		  margin-bottom: 6px;
		}

		.row.text-center .card h4 {
		  font-weight: 700;
		  color: #1e3799;
		}

		/* Table */
		.table th {
		  font-size: 13px;
		  text-transform: uppercase;
		  color: #555;
		  border-bottom: 2px solid #f1f1f1;
		}

		.table td {
		  font-size: 14px;
		  vertical-align: middle;
		}

		.table td i.material-icons {
		  font-size: 20px;
		  color: #007bff;
		  cursor: pointer;
		}

		/* Update credentials button */
		.btn-danger {
		  background: linear-gradient(90deg, #f44336, #d32f2f);
		  border: none;
		  border-radius: 6px;
		  padding: 8px 18px;
		  font-weight: 600;
		  transition: 0.3s;
		}

		.btn-danger:hover {
		  background: linear-gradient(90deg, #d32f2f, #b71c1c);
		}

    </style>
@endsection

@push("after-scripts")

@endpush