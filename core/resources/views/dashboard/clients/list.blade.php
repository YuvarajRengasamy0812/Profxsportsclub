@extends('dashboard.layouts.master')
@section('title', 'Client List')
@section('content')
<style>
    /* Grid Layout */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 1rem !important;
    }

    /* Card Styling */
    .stat-card {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
    }

    .stat-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-row.spread {
        justify-content: space-between;
        align-items: flex-start;
    }

    .stat-col {
        flex: 1;
        text-align: center;
    }

    .stat-label {
        font-size: 14px;
        margin-bottom: 6px;
        text-align: center;
    }

    .stat-value {
        margin: 0;
    }

    .icon-primary { font-size: 30px; color: #0d6efd; }
    .icon-success { font-size: 20px; color: #28a745; }
    .icon-danger { font-size: 20px; color: #dc3545; }

    .clickable { cursor: pointer; }
    
    .c-btn {
        padding: 10px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        transition: background-color 0.2s ease, border-radius 0.2s ease;
    }
    .c-btn:hover {
        background-color: #f8f9fa;
        border-radius: 8px;
        color: #000;
    }
</style>

<div class="padding">
    <div class="stats-grid ">
        <!-- Total Users -->
        <div class="stat-card clickable" onclick="location.href='{{ route('clientlist') }}'">
            <div class="stat-row" style="font-size: 5rem!important;">
                <i class="material-icons icon-primary">people</i>
                <div>
                    <div class="stat-label" style="font-size: 2rem!important;">Total Users</div>
                    <h4 class="stat-value" style="font-size: 2rem!important;">{{ $stats->totalCount }}</h4>
                </div>
            </div>
        </div>

        <!-- Paid / Not Paid -->
        <div class="stat-card">
            <div class="stat-label" style="color: green; font-weight: bolder !important;">Payment Status</div>
            <div class="stat-row spread">
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['payment_status' => 1]) }}'">
                    <i class="material-icons icon-success">paid</i>
                    <div>Paid</div>
                    <h5 class="stat-value">{{ $stats->paymentCount }}</h5>
                </div>
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['payment_status' => 0]) }}'">
                    <i class="material-icons icon-danger">money_off</i>
                    <div>Not Paid</div>
                    <h5 class="stat-value">{{ $stats->paymentNotCount }}</h5>
                </div>
            </div>
        </div>

        <!-- KYC Verified / Not Verified -->
        <div class="stat-card">
            <div class="stat-label" style="color: #6886fe; font-weight: bolder !important;">KYC Status</div>
            <div class="stat-row spread">
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['kyc_status' => 1]) }}'">
                    <i class="material-icons icon-success">verified_user</i>
                    <div>Verified</div>
                    <h5 class="stat-value">{{ $stats->kycCount }}</h5>
                </div>
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['kyc_status' => 0]) }}'">
                    <i class="material-icons icon-danger">highlight_off</i>
                    <div>Not Verified</div>
                    <h5 class="stat-value">{{ $stats->kycNotCount }}</h5>
                </div>
            </div>
        </div>

        <!-- Email Verified / Not Verified -->
        <div class="stat-card">
            <div class="stat-label" style="color: orange; font-weight: bolder !important;">Email Status</div>
            <div class="stat-row spread">
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['email_verified_at' => 'notnull']) }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#81C784"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" size="25" color="#81C784"
                        class="tabler-icon tabler-icon-mail-check">
                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M15 19l2 2l4 -4"></path>
                    </svg>
                    <div>Verified</div>
                    <h5 class="stat-value">{{ $stats->emailCount }}</h5>
                </div>
                <div class="stat-col clickable c-btn"
                    onclick="location.href='{{ route('clientlist', ['email_verified_at' => 'null']) }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#FFCC80"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" size="25"
                        class="tabler-icon tabler-icon-mail-x">
                        <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                        <path d="M3 7l9 6l9 -6"></path>
                        <path d="M22 22l-5 -5"></path>
                        <path d="M17 22l5 -5"></path>
                    </svg>
                    <div>Not Verified</div>
                    <h5 class="stat-value">{{ $stats->emailNotCount }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <div class="box-header dker">
            <h2><i class="material-icons">&#xe7fe;</i> Clients List</h2>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a>
            </small>
        </div>

        <!-- Search Form -->
        <div class="row p-a pull-right" style="margin-top: -70px;">
            <div class="col-sm-12">
                <form method="GET" action="{{ route('clientlist') }}" class="form-inline">
                    <input type="text" name="email" placeholder="Email" value="{{ request('email') }}" class="form-control mr-1">
                    <input type="text" name="mobile" placeholder="Mobile" value="{{ request('mobile') }}" class="form-control mr-1">
                    <select name="country" id="country" class="form-control mr-1">
						<option value="" selected disabled>Nationality</option>
						@foreach($nationalcoutry as $national)
							<option value="{{ $national['id'] }}" {{ old('country') == $national['id'] ? 'selected' : '' }} >
								{{ $national['title_en'] }}
							</option>
						@endforeach
					</select>
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="material-icons">filter_alt</i> Search</button>
                @php
                    $exportParams = array_merge(request()->all(), ['export' => 'csv']);
                @endphp
                <a class="btn info btn-sm" style="margin-right:5px; margin-left:5px;" href="{{ route('clientlist', $exportParams) }}">
                    <i class="material-icons">&#xe2c4;</i> Export List
                </a>
                <a class="btn primary btn-sm" href="{{ route('clientCreate') }}">
                    <i class="material-icons">&#xe7fe;</i> Add New Client
                </a>
                </form>
            </div>
        </div>


        @if($Users->total() > 0)
            {{Form::open(['route'=>'clientsUpdateAll','method'=>'post'])}}
            <div class="table-responsive">
                <table class="table table-bordered m-a-0">
                    <thead class="dker">
                        <tr>
                            <th class="width20 dker">
                                <label class="ui-check m-a-0">
                                    <input id="checkAll" type="checkbox"><i></i>
                                </label>
                            </th>
                            <th class="text-center" style="width:220px;">Status / Action</th>
                            <th>Name / Email</th>       
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Registered At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Users as $User)
                            <tr>
                                <td class="dker">
                                    <label class="ui-check m-a-0">
                                        <input type="checkbox" name="ids[]" value="{{ $User->id }}"><i></i>
                                        {!! Form::hidden('row_ids[]',$User->id, array('class' => 'form-control row_no')) !!}
                                    </label>
                                </td>
                                <td class="text-center d-flex align-center">
                                    <!--<i class="fa {{ ($User->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>-->
                                    <!--<a href="{{ route("clientedit",["id"=>$User->id]) }}"> -->
                                    <!--    <small><i class="material-icons">&#xe3c9;</i></small>-->
                                    <!--</a>-->
                                    <!--Users-->
                                    <!--<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"-->
                                    <!--    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" size="25"-->
                                    <!--    class="tabler-icon tabler-icon-user-scan">-->
                                    <!--    <title>User</title> -->
                                    <!--    <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0">-->
                                    <!--    </path>-->
                                    <!--    <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>-->
                                    <!--    <path d="M4 16v2a2 2 0 0 0 2 2h2">-->
                                    <!--    </path>-->
                                    <!--    <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>-->
                                    <!--    <path d="M16 20h2a2 2 0 0 0 2 -2v-2">-->
                                    <!--    </path>-->
                                    <!--    <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2"></path>-->
                                    <!--</svg>-->
                                    <!--View User-->
									<a href="{{ route('clientview', ['userid' => md5($User->userid)]) }}">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye"> <title>View</title>
											<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
											<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
											<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
										</svg>
									</a>
                                    <!--Edit Icon-->
                                    <a href="{{ route("clientedit",["id"=>$User->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit text-secondary">
                                            <title>Edit</title>
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                  {{-- Email Verification Status --}}
                                        @if($User->email_verified_at)
                                            {{-- Verified SVG --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#81C784"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" size="25" color="#81C784"
                                            class="tabler-icon tabler-icon-mail-check" style="cursor:pointer">
                                                <title>Email Verified</title>
                                            <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                            <path d="M3 7l9 6l9 -6"></path>
                                            <path d="M15 19l2 2l4 -4"></path>
                                        </svg>
                                        @else
                                            @php
                                                $canResend = false;
                                                $remainingTime = null;
                                                if(!$User->resendemail_date) {
                                                    $canResend = true; 
                                                } else {
                                                    $resendAfter = \Carbon\Carbon::parse($User->resendemail_date)->addDay();
                                                    if(now() >= $resendAfter) {
                                                        $canResend = true;
                                                    } else {
                                                        $remainingTime = $resendAfter->diffForHumans(); 
                                                    }
                                                }
                                            @endphp
                                        
                                            {{-- Resend Email SVG --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" 
                                             fill="none" stroke="{{ $canResend ? '#FFCC80' : 'gray' }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                             class="tabler-icon tabler-icon-mail-x resend-email-svg"
                                             data-id="{{ $User->id }}" 
                                             data-url="{{ route('resend', $User->id) }}"
                                             style="cursor: {{ $canResend ? 'pointer' : 'not-allowed' }};"
                                             title="{{ $canResend ? 'Resend Email' : 'Email sent ' . $remainingTime }}">
                                                <title>
                                                    {{ $canResend ? 'Resend Email' : 'Resend Email Sent ' . ($remainingTime ? '('.$remainingTime.')' : '') }}
                                                </title>
                                            <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                            <path d="M3 7l9 6l9 -6"></path>
                                            <path d="M22 22l-5 -5"></path>
                                            <path d="M17 22l5 -5"></path>
                                        </svg>
                                        @endif

                                </td>
                               
                                <!--<td class="h6"><b>{!! $User->name !!}</b><br/><small>{!! $User->email !!}</small></td>-->
                                <td class="h6">
                                    <a href="{{ route('clientview', ['userid' => md5($User->userid)]) }}">
                                        <b>{{ $User->name }}</b>
                                    
                                    <br/>
                                    <small>{{ $User->email }}</small>
                                    </a>
                                </td>
                                <td class="h6">{{ $User->country_code ? '+' . $User->country_code . ' ' . $User->phone : $User->phone }}</td>
                                <td class="h6"><img src="https://flagcdn.com/24x18/{{ strtolower($User->flagcode) }}.png" alt="{{ $User->flagcode }}" /> {!! ucfirst($User->country) !!}</td>
                                <td class="h6">{{ date('Y-m-d', strtotime($User->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <footer class="dker p-a">
                <div class="row">
                    <div class="col-sm-3 hidden-xs">
                        @if(@Auth::user()->permissionsGroup->settings_status)
                            <select name="action" id="action" class="form-control c-select w-sm inline v-middle" required>
                                <option value="">{{ __('backend.bulkAction') }}</option>
                                <option value="activate">{{ __('backend.activeSelected') }}</option>
                                <option value="block">{{ __('backend.blockSelected') }}</option>
                                <option value="delete">{{ __('backend.deleteSelected') }}</option>
                            </select>
                            <button type="submit" id="submit_all" class="btn white">{{ __('backend.apply') }}</button>
                            <button id="submit_show_msg" class="btn white" data-toggle="modal" style="display: none" data-target="#m-all" ui-toggle-class="bounce" ui-target="#animate">{{ __('backend.apply') }}</button>
                        @endif
                    </div>
                    <div class="col-sm-3 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">{{ __('backend.showing') }} {{ $Users->firstItem() }} -{{ $Users->lastItem() }} {{ __('backend.of') }} <strong>{{ $Users->total()  }}</strong> {{ __('backend.records') }}</small>
                    </div>
                    <div class="col-sm-6 text-right text-center-xs">
                        {!! $Users->links() !!}
                    </div>
                </div>
            </footer>
            {{Form::close()}}
        @endif
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push("after-scripts")
<script type="text/javascript">
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $("#action").change(function () {
        if (this.value == "delete") {
            $("#submit_all").css("display", "none");
            $("#submit_show_msg").css("display", "inline-block");
        } else {
            $("#submit_all").css("display", "inline-block");
            $("#submit_show_msg").css("display", "none");
        }
    });

 $(document).on('click', '.resend-email-svg', function () {
    let svg = $(this);
    let url = svg.data('url');
    let canResend = svg.css('cursor') !== 'not-allowed';

    if(!canResend) return; // Prevent click if disabled

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to resend the verification email?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, resend it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function (response) {
                    Swal.fire({
                        icon: response.status,
                        title: response.status === 'success' ? 'Sent!' : 'Error!',
                        text: response.message
                    }).then(() => {
                        if(response.status === 'success') {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong while resending.', 'error');
                }
            });
        }
    });
});

</script>
@endpush
