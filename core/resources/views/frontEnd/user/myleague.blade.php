@extends('frontEnd.layouts.master')

@section('content')
    <?php
    $title_var = 'title_' . @Helper::currentLanguage()->code;
    $title_var2 = 'title_' . config('smartend.default_language');
    $details_var = 'details_' . @Helper::currentLanguage()->code;
    $details_var2 = 'details_' . config('smartend.default_language');
    $aboutsection1 = Helper::Topic(155);
    $aboutsecupcoming = Helper::Topic(156);
    $aboutseconemid = Helper::Topic(158);
    $aboutsectwomid = Helper::Topic(159);
    $aboutjoinleague = Helper::Topic(160);
    ?>
    <div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">

        <div class="container">
            <div class="row">
                <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
                @include('frontEnd.user.usermenu')
                  @if (auth()->user()->payment_status == 1)
                  
                  
                <div class="col-lg-10 col-sm-12">
                    <div class="row align-items-stretch c-dashboard-group m-3">
                        <div class="col-lg-12">
                            <h2 class="widget_title">ProFX <span class="text-theme">My League</span> !</h2>
                        </div>
                    </div>

                    <div class="row align-items-stretch c-dashboard-group m-3">
                        @forelse($leaguelist as $resluague)
                            <?php
							$today = date('Y-m-d');
                            $startdate = date('M d Y', strtotime($resluague->leagurStartdate));
                            $startTime = date('H:i A', strtotime($resluague->leagurStartdate));
                            $enddate = date('M d', strtotime($resluague->leagurEnddate));
							
							$btnstartdate = date('Y-m-d', strtotime($resluague->leagurStartdate));
							$btnenddate   = date('Y-m-d', strtotime($resluague->leagurEnddate));
							
							$btnClass = "";
							$btnText  = '<span class="btn-border"><i class="bi bi-lock-fill"></i> Join Now</span>';
							$btnStyle = "";
							$disabled = false;
							$btnactionclass = "";
							$popupdata = "";
							$btnHref = "javascript:void(0);";
							$countdownstart = "";
							$countdownend = "display:none";
							
							if ($btnstartdate > $today) {
								// League not started yet -> disabled
								$btnStyle = "opacity:0.5; cursor:none; pointer-events:none;";
							} elseif ($btnstartdate <= $today && $btnenddate >= $today && $resluague->received_flag == 0) {
								// League ongoing -> enabled
								$btnStyle = "";
								$btnText  = '<span class="btn-border"><i class="bi bi-unlock-fill"></i> Get Live Account</span>';
								$btnactionclass = 'joinnowLeague';
							} elseif ($btnenddate < $today && $resluague->received_flag == 1) {
								// League ended -> show result button
								$btnText = '<span class="btn-border"><i class="bi bi-trophy-fill"></i> View Result</span>';
								$popupdata = 'accountResultModal-'.$resluague->id;
								//$btnHref = route('user.myresult');
								$btnactionclass = 'open-modal';
								$countdownstart = "display:none";
								$countdownend = "display:block";
							} elseif($resluague->received_flag == 1){
								$btnText = '<span class="btn-border"><i class="bi bi-graph-up"></i> View Account</span>';
								$popupdata = 'accountDetailsModal-'.$resluague->id;
								$btnactionclass = 'open-modal';
							} elseif ($btnenddate < $today && $resluague->received_flag == 0) {
							    $btnText = '<span class="btn-border"><i class="bi bi-unlock-fill"></i> Expired</span>';
							    $countdownstart = "display:none";
								$countdownend = "display:block";
							}
							
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="tournament-card style5 d-flex justify-content-center align-items-center">
                                    <div class="tournament-card-shape"
                                        data-bg-src="{{ URL::asset('assets/frontend/img/tournament-card6-bg.png') }}">
                                    </div>
                                    <div class="tournament-card-shape2"
                                        data-bg-src="{{ URL::asset('assets/frontend/img/tournament-card6-2-bg.png') }}">
                                    </div>
                                    <div class="tournament-card-content m-0 ">
                                        <div class="tournament-card-details pt-0 mt-0">
                                            <h6 class="tournament-card-time">{{ $resluague->leagurTitle }}</h6>
                                            <p class="tournament-card-date"><?php echo $startdate; ?></p>
                                        </div>
                                        <div class="tournament-card-date-wrap">
                                            <div class="countdown" style="{{ $countdownstart }}" data-date="{{ $startdate }}"></div>
                                            <div class="countdownend" style="{{ $countdownend }}" data-date="">Finished</div>
                                        </div>
                                        <div class="btn-wrap d-flex justify-content-center align-items-center my-3">
                                            <a href="javascript:void(0);" class="th-btn style2 btn-sm open-modal" data-modal-target="eventDetailsModal-{{ $resluague->id }}">
                                                <span><i class="bi bi-info-circle"></i> Event Details</span>
                                            </a>
                                            <a href="{{ $btnHref }}" class="th-btn th_btn btn-sm {{ $btnactionclass }}" data-id="{{ md5($resluague->id) }}" style="{{ $btnStyle }}" data-modal-target="{{ $popupdata }}"><?PHP echo $btnText; ?></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Event Details Popup Modal -->
                                <div id="eventDetailsModal-{{ $resluague->id }}" class="eventdetails-modal mt-5" aria-hidden="true" role="dialog" aria-modal="true" style="z-index:999999999999!important">
                                    <div class="eventdetails-backdrop" data-close="backdrop"></div>
                                    <div class="eventdetails-dialog" role="document" aria-labelledby="eventDetailsTitle">
                                        <button class="eventdetails-close" type="button" aria-label="Close" data-close="btn">✕</button>
                                        <h3 id="eventDetailsTitle" class="eventdetails-title">Event Details</h3>
                            
                                        <div class="eventdetails-body">
                                            {!! $resluague->privacydescription !!}
                                        </div>
                            
                                        <div class="eventdetails-actions d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                            <button type="button" class="th-btn md:w-auto" data-close="btn">Close</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- View Account Details Popup Modal -->
                                <div id="accountDetailsModal-{{ $resluague->id }}" class="eventdetails-modal mt-5" aria-hidden="true" role="dialog" aria-modal="true" style="z-index:999999999999!important">
                                    <div class="eventdetails-backdrop" data-close="backdrop"></div>
                                    <div class="eventdetails-dialog" role="document" aria-labelledby="eventDetailsTitle">
                                        <button class="eventdetails-close" type="button" aria-label="Close" data-close="btn">✕</button>
                                        <h3 id="eventDetailsTitle" class="eventdetails-title">Account Details</h3>
                            
                                        <div class="eventdetails-body">
                                            <table>
                                                <tbody class="no-border">
                                                    <tr>
                                                        <th class="text-white">Account ID</th>
                                                        <td>{{ $resluague->trade_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Master Password</th>
                                                        <td>{{ $resluague->trader_pwd }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Investor Password</th>
                                                        <td>{{ $resluague->invester_pwd }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Leverage</th>
                                                        <td >{{ $resluague->leverage }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Server</th>
                                                        <td>{{ $resluague->company_title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Platform</th>
                                                        <td>MT5</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Windows</th>
                                                        <td><a href="{{ $platformsettings['mt5_windows_platform'] }}">Download Here</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Android</th>
                                                        <td><a href="{{ $platformsettings['mt5_android_platform'] }}">Download Here</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Apple / iOS</th>
                                                        <td><a href="{{ $platformsettings['mt5_ios_platform'] }}">Download Here</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                            
                                        <div class="eventdetails-actions d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                            <button type="button" class="th-btn md:w-auto" data-close="btn">Close</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- League Result -->
								<div id="accountResultModal-{{ $resluague->id }}" class="eventdetails-modal mt-5" aria-hidden="true" role="dialog" aria-modal="true" style="z-index:999999999999!important">
                                    <div class="eventdetails-backdrop" data-close="backdrop"></div>
                                    <div class="eventdetails-dialog" role="document" aria-labelledby="eventDetailsTitle">
                                        <button class="eventdetails-close" type="button" aria-label="Close" data-close="btn">✕</button>
                                        <h3 id="eventDetailsTitle" class="eventdetails-title">Your Result</h3>
                            
                                        <div class="eventdetails-body">
                                            <table>
                                                <tbody class="no-border">
                                                    <tr>
                                                        <th class="text-white">Account ID</th>
                                                        <td>{{ $resluague->trade_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Deposit</th>
                                                        <td>${{ $resluague->ac_min_deposit }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Balance</th>
                                                        <td>${{ $resluague->Balance }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Equity</th>
                                                        <td>${{ $resluague->equity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Profit</th>
                                                        <td><?PHP echo '$'. $resluague->equity - $resluague->ac_min_deposit; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Percentage(%)</th>
                                                        <td>${{ $resluague->profitpercentage }}</td>
                                                    </tr>
													<tr>
                                                        <th class="text-white">#Rank</th>
                                                        <td><img src="{{ asset('assets/winnercup.png') }}" alt="" width="30" height="30" /> {{ $resluague->rank }}</td>
                                                    </tr>
													<tr>
                                                        <th class="text-white">Prize</th>
                                                        <td>${{ $resluague->prizeAmount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-white">Reward Status</th>
                                                        <td>
														@if($resluague->prizeReceived == 1)
															<span>Received on {{ date('Y-m-d', strtotime($resluague->prizedistributeDate)) }}</span>
														@endif
														</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                            
                                        <div class="eventdetails-actions d-flex flex-wrap align-items-center gap-2 justify-content-center">
                                            <button type="button" class="th-btn md:w-auto" data-close="btn">Close</button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        @empty
                            <div class="col-lg-12 col-sm-12 mb-5">
                                <div class="text-center tournament-card d-grid pt-4 pb-4">
                                    <h5 class="text-white text-center">No League Enrolled!!!</h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                 @else
              <div class="col-lg-10 col-sm-12">
                    <div class="row align-items-stretch c-dashboard-group m-3">
                        <div class="col-lg-12">
                            <h2 class="widget_title">ProFX <span class="text-theme">My League</span> !</h2>
                        </div>
                    </div>
                        <div class="text-center tournament-card d-grid pt-4 pb-4">
                            <h5 class="text-white text-center">Get ready to trade and earn! Activate your ProFxLeague
                                account with $25 and start referring.</h5>
                            <div class="tournament-card-meta d-flex justify-content-center">
                                <a type="button" href="{{ route('user.choosepayment', 'register') }}"
                                    class="th-btn th_btn style2" style="min-width:100px">Pay Now $25</a>
                            </div>
                        </div>
                       

                    </div>
             @endif
            </div>
        </div>
    </div>

    
@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-styles')
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


        /* Event Details Modal */

		/* Event Modal Button Adjustment */
		.small-btn {
            font-size: 0.75rem !important;
            height: auto !important;
            line-height: 1.2 !important;
            max-height: 28px !important;
            min-width: 100px !important;
            width: auto !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
		/* Event Modal Button Adjustment */

        .eventdetails-modal {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
        }

        .eventdetails-modal.is-open {
            display: block;
        }

        .eventdetails-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .6);
        }

        .eventdetails-dialog {
            position: relative;
            margin: 24px auto;
            max-width: 720px;
            width: calc(100% - 24px);
            background: #0b0e13;
            color: #fff;
            border: 2px solid var(--themebrandclr);
            border-radius: 16px;
            padding: 18px 16px 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .45);
        }

        .eventdetails-title {
            margin: 0 40px 12px 0;
            font-size: 1.25rem;
            color: #fff;
        }

        .eventdetails-close {
            position: absolute;
            right: 10px;
            top: 10px;
            border: 1px solid var(--themebrandclr);
            background: transparent;
            color: #fff;
            border-radius: 999px;
            width: 32px;
            height: 32px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
        }

        .eventdetails-close:hover {
            background: rgba(69, 248, 130, .12);
        }

        .eventdetails-body {
            /*border: 1px solid var(--themebrandclr);*/
            border-radius: 12px;
            padding: 12px 14px;
            max-height: min(70vh, 640px);
            overflow: auto;
            scrollbar-gutter: stable both-edges;
        }

        .eventdetails-body strong {
            color: var(--themebrandclr);
        }

        .eventdetails-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .eventdetails-actions .th-btn {
            padding: .6rem 1.2rem;
            border-radius: 12px;
        }

        .eventdetails-actions .eventdetails-cancel {
            background: #ffbe18;
            color: #0b0e13;
        }

        .eventdetails-actions .eventdetails-cancel:hover {
            background: #fff;
        }

        .no-scroll {
            overflow: hidden !important;
            height: 100vh;
        }

        /* Scrollbar */
        .eventdetails-body::-webkit-scrollbar {
            width: 8px;
        }

        .eventdetails-body::-webkit-scrollbar-track {
            background: #0b0e13;
            border-radius: 8px;
        }

        .eventdetails-body::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--themebrandclr), #28b463);
            border-radius: 8px;
        }

        .eventdetails-body::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #28b463, var(--themebrandclr));
        }

        .eventdetails-body {
            scrollbar-width: thin;
            scrollbar-color: var(--themebrandclr) #0b0e13;
        }

        @media (max-width: 640px) {
            .eventdetails-dialog {
                width: calc(100% - 16px);
                margin: 12px auto;
                padding: 14px;
            }

            .eventdetails-actions {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
    <script>
		$(document).ready(function () {
	$('.joinnowLeague').click(function (e) {
		e.preventDefault();
		let leagueId = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Do you want to live account in this league?",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, Enroll',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "{{ route('user.getliveaccount') }}", 
					type: "POST",
					data: {
						_token: "{{ csrf_token() }}",
						leagueid: leagueId
					},
					success: function(response) {
						Swal.fire(
							'Success!',
							'Requested Live Account Details Are Sent to your Registered Email Address!',
							'success'
						).then(() => {
							location.reload(); 
						});
					},
					error: function(xhr) {
						Swal.fire(
							'Error!',
							'Something went wrong. Please try again.',
							'error'
						);
					}
				});
			}
		});
	});
});

		
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


        // event details modal
        document.addEventListener('click', function(e) {
            // Open modal
            const trigger = e.target.closest('.open-modal');
            if (trigger) {
                e.preventDefault();
                const targetId = trigger.getAttribute('data-modal-target');
                let modal = document.getElementById(targetId);

                if (modal) {
                    // Move modal to body if it's not already there
                    if (!document.body.contains(modal)) {
                        document.body.appendChild(modal);
                    } else if (modal.parentElement !== document.body) {
                        document.body.appendChild(modal);
                    }

                    modal.classList.add('is-open');
                    document.body.classList.add('no-scroll');
                }
            }

            // Close modal
            const isCloseBtn = e.target.closest('[data-close="btn"]');
            const isBackdrop = e.target.matches('.eventdetails-backdrop') || e.target.matches(
                '[data-close="backdrop"]');
            if (isCloseBtn || isBackdrop) {
                const modal = e.target.closest('.eventdetails-modal') || document.querySelector(
                    '.eventdetails-modal.is-open');
                if (modal) {
                    modal.classList.remove('is-open');
                    document.body.classList.remove('no-scroll');
                }
            }
        });

        // ESC to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.eventdetails-modal.is-open');
                if (openModal) {
                    openModal.classList.remove('is-open');
                    document.body.classList.remove('no-scroll');
                }
            }
        });
    </script>
    {{-- integrate your custom js code/files here --}}
@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here --}}
@endsection
