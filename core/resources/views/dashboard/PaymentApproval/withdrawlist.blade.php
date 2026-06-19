@extends('dashboard.layouts.master')
@section('title', $pagetitle)

@section('content')
<div class="padding">
    <div class="box">
         {{-- @if(session('doneMessage'))
            <div class="alert alert-success">{{ session('doneMessage') }}</div>
        @endif
        @if(session('errorMessage'))
            <div class="alert alert-danger">{{ session('errorMessage') }}</div>
        @endif --}}

        <div class="box-header dker">
            <h3>{{ $pagetitle }}</h3>
            <small>
                <a href="{{ route('adminHome') }}">{{ __('backend.home') }}</a> /
                <a href="">{{ __('Withdrawal List') }}</a>
            </small>
        </div>

        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered m-a-0">
                    <thead class="dker">
                        <tr>
                            <th>#</th>
                            <th>User Email</th>
                            <th>Current Balance</th>
                            <th>Request Amount</th>
                            <th>Transfer to</th>
                            <th>Status</th>
                            <th>Admin Remark</th>
                            <th class="text-center" style="width:150px;">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</td>
                                <td>{{ $transaction->useremail }}</td>
                                <td>{{ $transaction->withdraw_currency }}{{ $transaction->wallet_balance }}</td>
                                <td>{{ $transaction->withdraw_currency }}{{ $transaction->withdraw_amount }}</td>
                                <td>{{ $transaction->withdraw_type }}</td>
                               <td>
                                    <span class="btn-xs {{ $transaction->status == 0 ? 'btn-warning' : ($transaction->trans_status == 1 ? 'btn-success' : 'btn-danger') }}">
                                        {{ $transaction->status == 0 ? 'Pending' : 'Approved' }}
                                    </span>
                                </td>
                                <td>{{ $transaction->trans_adminremark }}</td>
                                <td class="text-center">
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-sm btn-info">
                                        <small><i class="fa fa-eye"></i> View</small>
                                    </a>
                                </td>
							</tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="p-a text-center">
                {{ __('No transactions found') }}
            </div>
        @endif

    </div>
</div>
@endsection
