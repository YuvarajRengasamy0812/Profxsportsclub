@extends('dashboard.layouts.master')
@section('title', __('Transaction Details'))

@section('content')
<div class="padding">

    {{-- User Details Card --}}
    <div class="box mb-4">
        <div class="box-header dker">
            <h3>{{ __('User Details') }}</h3>
        </div>
        <div class="p-a">
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ $transaction->user->name ?? '—' }} {{ $transaction->user->lastname ?? '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Email') }}</th>
                    <td>{{ $transaction->user->email ?? '—' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Registration Mode') }}</th>
                    <td>{{ $transaction->user->registration_mode ?? '—' }}</td>
                </tr>
                {{-- <tr>
                    <th>{{ __('Country Code') }}</th>
                    <td>{{ $transaction->user->country_code ?? '—' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Nationality') }}</th>
                    <td>{{ $transaction->user->nationalities ?? '—' }}</td>
                </tr> --}}
            </table>
        </div>
    </div>

    {{-- Transaction Details Card --}}
    <div class="box">
        <div class="box-header dker">
            <h3>{{ __('Transaction Details') }}</h3>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('paymentApproval') }}">{{ __('Transactions List') }}</a> /
                {{ __('Transaction Details') }}
            </small>
        </div>

        {{-- @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger m-3">{{ session('error') }}</div>
        @endif --}}

        <div class="p-a">
            <table class="table table-bordered">
                {{-- <tr>
                    <th>{{ __('User Email') }}</th>
                    <td>{{ $transaction->useremail }}</td>
                </tr> --}}
                <tr>
                    <th>{{ __('Payment Purpose') }}</th>
                    <td>{{ $transaction->trans_purpose }}</td>
                </tr>
                <tr>
                    <th>{{ __('Amount') }}</th>
                    <td>{{ $transaction->trans_amount }} {{ $transaction->trans_currency }}</td>
                </tr>
                <tr>
                    <th>{{ __('Method') }}</th>
                    <td>{{ $transaction->trans_method }}</td>
                </tr>
                <tr>
                    <th>{{ __('Status') }}</th>
                    <td>
                        <span class="btn-xs {{ $transaction->trans_status == 'pending' ? 'btn-warning' : ($transaction->trans_status == 'approved' ? 'btn-success' : 'btn-danger') }}">
                            {{ ucfirst($transaction->trans_status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Admin Remark') }}</th>
                    <td>{{ $transaction->trans_adminremark ?? '—' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Deposit Proof') }}</th>
                    <td>
                        @if($transaction->deposit_proof)
                            @php
                                $ext = pathinfo($transaction->deposit_proof, PATHINFO_EXTENSION);
                            @endphp

                            {{-- @if(in_array($ext, ['jpg','jpeg','png','gif']))
                                <img src="{{ asset('storage/' . $transaction->deposit_proof) }}" alt="Deposit Proof" style="max-width:200px; height:auto; border:1px solid #ccc; padding:5px;">
                            @elseif($ext == 'pdf') --}}
                                <a href="{{ URL::to($transaction->deposit_proof) }}" class="btn btn-sm bg-info" target="_blank">View File</a>
                            {{-- @else
                                <span>File not supported</span>
                            @endif --}}
                        @else
                            <span>—</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Transaction Date') }}</th>
                    <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Updated At') }}</th>
                    <td>{{ $transaction->updated_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>

            {{-- Action Buttons --}}
            <div class="mt-3">
                @if($transaction->trans_status == 'pending')
                    <button class="btn btn-sm success m-x" data-toggle="modal" data-target="#approve-{{ $transaction->id }}">
                        <small><i class="fa fa-check"></i> Approve</small>
                    </button>

                    <button class="btn btn-sm danger" data-toggle="modal" data-target="#reject-{{ $transaction->id }}">
                        <small><i class="fa fa-times"></i> Reject</small>
                    </button>
                @endif

                <a href="{{ route('paymentApproval') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Approve Modal --}}
{{-- <div id="approve-{{ $transaction->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Approve</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve this transaction?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('transactions.approve', md5($transaction->id)) }}" class="btn btn-success">Approve</a>
            </div>
        </div>
    </div>
</div> --}}

{{-- Reject Modal --}}
{{-- <div id="reject-{{ $transaction->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Reject</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject this transaction?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ route('transactions.reject', md5($transaction->id)) }}" class="btn btn-danger">Reject</a>
            </div>
        </div>
    </div>
</div> --}}

{{-- Approve Modal --}}
<div id="approve-{{ $transaction->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST">
            @csrf

            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Approve</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this transaction?</p>
                    <div class="form-group">
                        <label for="remark">Admin Remark</label>
                        <textarea name="trans_adminremark" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Reject Modal --}}
<div id="reject-{{ $transaction->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('transactions.reject', $transaction->id) }}" method="POST">
            @csrf

            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Reject</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this transaction?</p>
                    <div class="form-group">
                        <label for="remark">Admin Remark</label>
                        <textarea name="trans_adminremark" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
