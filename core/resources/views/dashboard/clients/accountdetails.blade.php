@extends('dashboard.layouts.master')
@section('title', 'Account Details')
@section('content')
   <div class="padding">
		<div class="box">
			<div class="box-header dker">
			  <h3><i class="material-icons">manage_accounts</i> Account Details</h3>
			  <small><a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a></small>
			</div>

		<div class="card-main">
		  <div class="row p-4">
			<!-- Left Column (Profile) -->
			<div class="col-md-4">
			  <div class="card text-center">
				<div class="card-body" style="padding:20px">
					<!--<img style="border-radius: 50px;" src="https://avatar.iran.liara.run/public/boy" width="75" height="75" alt="Profile">-->
					@if($Users->profile_image)
					
				
						<img style="border-radius: 50px;" src="{{ asset($Users->profile_image) }}" width="75" height="75"/>
					@else
						<img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="75" height="75" />
					@endif
					  <h5 class="card-title" style="margin-top:0.5rem;">{{ucfirst($Users->name)}}</h5>
					  <p class="text-muted">{{$Users->email}}</p>
						@if($Users->status == 1)
                        <span class="badge badge-success text-white">Active</span>
                    @else
                        <span class="badge badge-danger text-white" style="background: red; color:#fff; border-radius:40px; padding:5px;">Inactive</span>
                    @endif

				  <div class="mt-3" style="margin-top:0.5rem;">
					<h6><strong>{{$accountdetails->trade_id}}</strong></h6>
					<p class="text-muted">{{$leaguedetails->ac_group}}</p>
				  </div>

				  <ul class="list-group text-left mt-3">
				      <hr>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Leverage 
					  <span> ${{$accountdetails->leverage}} </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Balance <span> ${{$accountdetails->Balance}} </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Equity <span>$ {{$accountdetails->equity}} </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Credit <span>$ {{$accountdetails->credit}} </span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Free Margin <span>${{$accountdetails->MarginFree}}</span>
					</li>
					<li class="list-group-item" style="display: flex; align-items:center; justify-content: space-between; gap:10px">
					  Margin <span> {{$accountdetails->MarginLevel}} </span>
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
				  <div class="card" style="padding:20px">
					<h6>Total Deposit</h6>
					<h4 class="text-primary">${{$accountdetails->Balance}}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:20px">
					<h6>Balance</h6>
					<h4>${{$accountdetails->Balance}}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:20px">
					<h6>Equity</h6>
					<h4>${{$accountdetails->equity}}</h4>
				  </div>
				</div>
				<div class="col-md-3">
				  <div class="card" style="padding:20px">
					<h6> Rank</h6>
					<h4>{{$accountdetails->rank}}</h4>
				  </div>
				</div>
			  </div>

			  <!-- Security / Passwords -->
                <!--<div class="card p-3 mb-4" style="padding:20px">-->
                <!--  <h6>Security / Passwords</h6>-->
                
                <!--  <div style="display: flex; align-items:end; jutify-content: center; gap:3px;" >-->
                <!--    <div class="form-group flex-fill">-->
                <!--      <label>Master Password</label>-->
                <!--      <input type="password" class="form-control" value="******">-->
                <!--    </div>-->
                
                <!--    <div class="form-group flex-fill">-->
                <!--      <label>Investor Password</label>-->
                <!--      <input type="password" class="form-control" value="******">-->
                <!--    </div>-->
                
                <!--    <div class="form-group" style="padding-left:1rem;">-->
                <!--      <button class="btn btn-danger w-100">Update Credentials</button>-->
                <!--    </div>-->
                <!--  </div>-->
                <!--</div>-->


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