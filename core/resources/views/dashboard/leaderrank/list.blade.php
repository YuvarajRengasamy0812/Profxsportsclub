@extends('dashboard.layouts.master')
@section('title', 'Tournament List')
@section('content')
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe7fe;</i> Leader Rank List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">
					<a class="btn btn-fw primary" href="{{ route('leaderrankcreate') }}">
						<i class="material-icons">&#xe7fe;</i> Add New Leader Rank
					</a>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered m-a-0">
					<thead class="dker">
						<tr>
							<th>Name / Image</th>
							<th>League Details</th>
							<th>Balance</th>						
							<th>Equity</th>
							<th>Profit(%)</th>
							<th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
						</tr>
					</thead>
					<tbody>
                        @forelse($leaderrank as $ledrank)
						<tr>
							<td>
							    <div style="display: flex; align-items: center; gap: 10px;">
							        <div>
        							    @if($ledrank->profile_image)
        								    <img style="border-radius: 50px;" src="{{ asset($ledrank->profile_image) }}" width="60" height="60" />
                                        @else
                                            <img style="border-radius: 50px;" src="{{ asset('assets/frontend/img/user.png') }}" width="60" height="60" />
                                        @endif
                                   </div>
                                   <div>
								        <strong>{{ ucfirst($ledrank->name) }}</strong><br />
								        <small>{{ $ledrank->usemail }}  >> <br> <?PHP echo '+'.$ledrank->country_code.' '.$ledrank->phone; ?></small>
								   </div>
								</div>
							</td>
							<td class="h6">
								{{ $ledrank->leagurTitle }}
								<br />
								<small>{{ $ledrank->catname }} >> {{ $ledrank->subcatname }}</small>
							</td>
							<td>{{ $ledrank->balance }}</td>
							<td>{{ $ledrank->equity }}</td>
							<td>{{ $ledrank->profit }}</td>
							<td class="text-center">
								<a class="btn btn-sm success" href="{{ route('leaderrankedit', ['id' => $ledrank->id]) }}">
									<small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}</small>
								</a>
							</td>
						</tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Leader Ranks found</td>
                        </tr>
                        @endforelse
					</tbody>
				</table>
			</div>
        </div>
    </div>
@endsection

@push("after-scripts")

@endpush