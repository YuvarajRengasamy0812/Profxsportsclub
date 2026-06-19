@extends('dashboard.layouts.master')
@section('title', 'MT5 Server List')
@section('content')
<div class="padding">
    <div class="box">

        <div class="box-header dker">
            <h2><i class="material-icons">&#xe8e5;</i> MT5 Server List</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
            </small>
             <div>
       
        	<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">
					<a class="btn btn-fw primary" href="{{ route('mt5accounts.create') }}">
						<i class="material-icons">&#xe7fe;</i> Add New MT5 Server
					</a>
				</div>
			</div>
    </div>
        </div>

        @if($mt5accounts->total() > 0)
        <div class="table-responsive">
            <table class="table table-bordered m-a-0">
                <thead class="dker">
                    <tr>
                        <th class="width20">#</th>
                        <th>Company Title</th>
                        <th>MT5 Company Name</th>
                        <th>Server IP</th>
                        <th>Server Port</th>
                        <th>Web Login</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mt5accounts as $account)
                    <tr>
                        <td>{{ $loop->iteration + ($mt5accounts->currentPage()-1) * $mt5accounts->perPage() }}</td>
                        <td>{{ $account->company_title }}</td>
                        <td>{{ $account->mt5_company_name }}</td>
                        <td>{{ $account->mt5_server_ip }}</td>
                        <td>{{ $account->mt5_server_port }}</td>
                        <td>{{ $account->mt5_server_web_login }}</td>
                        <td>
                            @if($account->status == 1)
                                <span class="badge bg-success rounded" style="padding:0.4rem!important">Active</span>
                            @else
                                <span class="badge bg-danger rounded" style="padding:0.4rem!important">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <!--<a class="btn btn-sm success" -->
                            <!--   href="{{ route('mt5Edit', ['id' => $account->id]) }}">-->
                            <!--    <small>Edit <i class="material-icons" style="font-size:"0.3rem!important">&#xe3c9;</i></small>-->
                            <!--</a>-->
                            <a class="btn btn-sm btn-success" 
                               href="{{ route('mt5Edit', ['id' => $account->id]) }}">
                                Edit <i class="material-icons" style="font-size:14px; vertical-align:middle;">&#xe3c9;</i>
                            </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <footer class="dker p-a">
            <div class="row">
                <div class="col-sm-6">
                    <small class="text-muted">
                        {{ __('backend.showing') }} {{ $mt5accounts->firstItem() }} - {{ $mt5accounts->lastItem() }} 
                        {{ __('backend.of') }} <strong>{{ $mt5accounts->total() }}</strong> {{ __('backend.records') }}
                    </small>
                </div>
                <div class="col-sm-6 text-right text-center-xs">
                    {!! $mt5accounts->links() !!}
                </div>
            </div>
        </footer>
        @else
            <div class="p-3">
                <p>No MT5 Server found.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    // Optional: any JS for table interactions
</script>
@endpush
