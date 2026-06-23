@extends('dashboard.layouts.master')
@section('title', __('Transaction Details'))

@section('content')
<div class="padding">

    {{-- User Details --}}
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
            </table>
        </div>
    </div>

    {{-- Transaction Details --}}
    <div class="box">
        <div class="box-header dker">
            <h3>{{ __('Transaction Details') }}</h3>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="{{ route('paymentApproval') }}">{{ __('Transactions List') }}</a> /
                {{ __('Transaction Details') }}
            </small>
        </div>

        <div class="p-a">
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('Payment Purpose') }}</th>
                    <td>{{ $transaction->trans_purpose }}</td>
                </tr>
                <tr>
                    <th>{{ __('Amount') }}</th>
                    <td>{{ $transaction->trans_currency }} {{ $transaction->trans_amount }} </td>
                </tr>
                <!--<tr>-->
                <!--    <th>{{ __('Method') }}</th>-->
                <!--    <td>{{ $transaction->trans_method }}</td>-->
                <!--</tr>-->
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
                          <a href="{{ URL::to($transaction->deposit_proof) }}" class="btn btn-sm bg-info" target="_blank">View File</a>
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
                @if($transaction->status == 0) {{-- Pending --}}
                    <button class="btn btn-sm btn-success m-x" data-toggle="modal" data-target="#approve-{{ $transaction->id }}">
                        <i class="fa fa-check"></i> {{ __('Approve') }}
                    </button>

                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject-{{ $transaction->id }}">
                        <i class="fa fa-times"></i> {{ __('Reject') }}
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
<div id="approve-{{ $transaction->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST">
            @csrf
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Confirm Approve') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to approve this transaction?') }}</p>
                    <div class="form-group">
                        <label for="remark">{{ __('Admin Remark') }}</label>
                        <textarea name="trans_adminremark" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
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
                    <h5 class="modal-title">{{ __('Confirm Reject') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to reject this transaction?') }}</p>
                    <div class="form-group">
                        <label for="remark">{{ __('Admin Remark') }}</label>
                        <textarea name="trans_adminremark" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Reject') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
