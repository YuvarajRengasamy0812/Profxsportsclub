@extends('dashboard.layouts.master')
@section('title', 'Tournament List')
@section('content')
    <div class="padding">
        <div class="box">

            <div class="box-header dker">
                <h2><i class="material-icons">&#xe7fe;</i> Tournament List</h2>
                <small>
                    <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
                </small>
            </div>
			
			<div class="row p-a pull-right" style="margin-top: -70px;">
				<div class="col-sm-12">
					<a class="btn btn-fw primary" href="{{ route('leaguecreate') }}">
						<i class="material-icons">&#xe7fe;</i> Add New Tournament
					</a>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table table-bordered m-a-0">
					<thead class="dker">
						<tr>
							<th class="width20 dker">
								<label class="ui-check m-a-0">
									<input id="checkAll" type="checkbox"><i></i>
								</label>
							</th>
							<th>Image</th>
							<th>League Name</th>
							<th>Dates</th>						
							<th>Fees</th>
							<th>Groups</th>
							<th>MT5 Server</th>
							<th class="text-center" style="width:50px;">{{ __('backend.status') }}</th>
							<th class="text-center" style="width:200px;">{{ __('backend.options') }}</th>
						</tr>
					</thead>
					<tbody>
                        @forelse($leagues as $league)
						<?PHP 
							$today = date('Y-m-d');
                            $startdate = date('M d Y', strtotime($league->leagurStartdate));
                            $startTime = date('H:i A', strtotime($league->leagurStartdate));
                            $enddate = date('M d', strtotime($league->leagurEnddate));
							
							$btnstartdate = date('Y-m-d', strtotime($league->leagurStartdate));
							$btnenddate   = date('Y-m-d', strtotime($league->leagurEnddate));
							
							$btnStyle = "";
							$btnHref = '';
							
							$btnClass = "";
							$btnText  = '<span class="btn-border"><i class="bi bi-lock-fill"></i> Join Now</span>';
							$btnStyle = "";
							$disabled = false;
							$btnactionclass = "";
							$popupdata = "";
							$btnHref = "javascript:void(0);";
							$countstop = '';
							$resultshow = 0;
							
							if ($btnstartdate > $today) {
								// League not started yet -> disabled
								$btnStyle = "opacity:0.5; cursor:none; pointer-events:none;";
							} elseif ($btnenddate < $today && $league->price_distribute == 0) {
								// League ended -> show result button
								$btnText = '<span class="btn-border"><i class="bi bi-trophy-fill"></i> View Result</span>';
								$btnHref = route('leagueprizeresult', ['id' => $league->id]);
								$countstop = "display:none";
								$resultshow = 1;
							}
						?>
						<tr>
							<td class="dker">
                                <label class="ui-check m-a-0">
									<input type="checkbox" name="ids[]" value="{{ $league->id }}">
                                    <i class="dark-white"></i>
								</label>
							</td>

							<td class="h6">
                                @if($league->leagurImage)
								    <img src="{{ asset($league->leagurImage) }}" width="60" />
                                @else
                                    <img src="{{ asset('no-image.png') }}" width="60" />
                                @endif
							</td>

							<td class="h6">
								{{ $league->leagurTitle }}
								<br />
								<small>{{ $league->category->catname ?? '' }} >> {{ $league->subcategory->catname ?? '' }}</small>
							</td>

							<td class="h6">
								{{ \Carbon\Carbon::parse($league->leagurStartdate)->format('M d, Y') }} 
                                - {{ \Carbon\Carbon::parse($league->leagurEnddate)->format('M d, Y') }}
								<div class="countdown " style="margin-top:10px; {{ $countstop }}" data-date="{{ $startdate }}"></div>								
							</td>

							<td class="h6">
								${{ number_format($league->leagurEntryfees, 2) }}
							</td>

							<td class="h6">
							<small>{{ $league->accounttype->ac_group ?? '' }}</small>
							</td>

							<td class="h6">
								{{ $league->mt5Server->mt5_company_name ?? '' }}
								<br />
								<small>{{ $league->mt5Server->mt5_server_ip ?? '' }} >> {{ $league->mt5Server->mt5_server_web_login ?? '' }}</small>
							</td>

							<td class="text-center">
                                @if($league->status == 1)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>

						<td class="text-center">
							<a class="btn btn-sm success" href="{{ route('leagueedit', ['id' => $league->id]) }}">
								<small><i class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}</small>
							</a>
							@if($resultshow == 1)							
							<a href="{{ $btnHref }}" class="btn btn-sm info" data-id="{{ md5($league->id) }}" style="{{ $btnStyle }}" ><?PHP echo $btnText; ?></a>
							@endif
							
						</td>
						</tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No tournaments found</td>
                        </tr>
                        @endforelse
					</tbody>
				</table>
			</div>
        </div>
    </div>
@endsection

<style>
	.countdown {
		display: flex;
		justify-content: center;
		gap: 10px;
	}

	.countdown .time-box {
		text-align: center;
	}

	.countdown .time-box span {
		display: block;
		padding: 6px 10px;
		color: #45F882;
		border: 2px solid #45F882;
		border-radius: 6px;
		font-size: 16px;
		font-weight: bold;
		/* numbers bold */
		background: transparent;
	}

	.countdown .time-box small {
		display: block;
		margin-top: 4px;
		font-size: 12px;
		color: #45F882;
		/* label color */
		font-weight: normal;
		/* labels normal */
	}
</style>

@push("after-scripts")
<script type="text/javascript">
    
	document.addEventListener("DOMContentLoaded", function() {
		function padNumber(num) {
			return num.toString().padStart(2, "0");
		}

		function initializeCountdown(element) {
			let targetDate = new Date(element.getAttribute("data-date")).getTime();

			function updateCountdown() {
				let now = new Date().getTime();
				let distance = targetDate - now;

				if (distance <= 0) {
					element.innerHTML = "<span class='text-danger'>Started</span>";
					return;
				}

				let days = Math.floor(distance / (1000 * 60 * 60 * 24));
				let hours = padNumber(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
				let minutes = padNumber(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
				let seconds = padNumber(Math.floor((distance % (1000 * 60)) / 1000));

				element.innerHTML =
					`<div class="time-box"><span>${days}</span><small>Days</small></div>
			 <div class="time-box"><span>${hours}</span><small>Hours</small></div>
			 <div class="time-box"><span>${minutes}</span><small>Minutes</small></div>
			 <div class="time-box"><span>${seconds}</span><small>Seconds</small></div>`;
			}
			updateCountdown();
			setInterval(updateCountdown, 1000);
		}
		document.querySelectorAll(".countdown").forEach(el => initializeCountdown(el));
	});
	
	
	$("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endpush
