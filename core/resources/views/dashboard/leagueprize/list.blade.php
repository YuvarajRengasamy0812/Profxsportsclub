@extends('dashboard.layouts.master')
@section('title', 'League Prize List')
@section('content')
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe7fe;</i> League Prize List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">
					<a class="btn btn-fw primary" href="{{ route('leagueprizecreate') }}">
						<i class="material-icons">&#xe7fe;</i> Add New Prize List
					</a>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered m-a-0">
					<thead class="dker">
						<tr>
							<th>League Image</th>
							<th>League Details</th>
							<th>Total Prize</th>						
							<th>Prize Money</th>
							<th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
						</tr>
					</thead>
					<tbody>
                        @forelse($leagueprize as $prize)
						<tr>
							<td class="h6">
                                @if($prize->leagurImage)
								    <img src="{{ asset($prize->leagurImage) }}" width="60" />
                                @else
                                    <img src="{{ asset('no-image.png') }}" width="60" />
                                @endif
							</td>
							<td class="h6">
								{{ $prize->leagurTitle }}
								<br />
								<small>{{ $prize->catname }} >> {{ $prize->subcatname }}</small>
							</td>
							<td>{{ $prize->totalprize }}</td>
							<td>
								@php
									$prizes = json_decode($prize->prizevalue, true);
								@endphp
								@if(!empty($prizes))
									{{ collect($prizes)->map(function($p){
										return "Rank {$p['rank']}: {$p['value']}";
									})->implode(', ') }}
								@else
									<span class="text-muted">No Prizes</span>
								@endif
							</td>
							<td class="text-center">
								<a class="btn btn-sm success" href="{{ route('leagueprizeedit', ['id' => $prize->id]) }}">
									<small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}</small>
								</a>
							</td>
						</tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Prize values found</td>
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