@extends('dashboard.layouts.master')
@section('title', __('KYC'))

@section('content')
<style>
      .status {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
}

.status.approved {
    background-color: #28a745; /* green */
}

.status.rejected {
    background-color: #dc3545; /* red */
}

.status.pending {
    background-color: #ffc107; /* warning */
}
</style>
<div class="padding">
    <div class="box">

        <div class="box-header dker">
            <h3>KYC List</h3>
        </div>

       <div class="table-responsive">
    <table class="table table-bordered m-a-0">
        <thead class="dker">
            <tr>
                <th>#</th>
                <th>User Email</th>
                <th>KYC Type</th>
                <th>Status</th>
                <th>Admin Remark</th>
                <th class="text-center" style="width:150px;">Options</th>
            </tr>
        </thead>
        <tbody>
          @foreach($kyc as $index => $item)
                <tr>
                    <td>{{ $kyc->firstItem() + $index }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->kyc_type }}</td>
                    <td>
                        @if($item->status == 0)
                            <span class="status pending">Pending</span>
                        @elseif($item->status == 1)
                            <span class="status approved">Approved</span>
                        @else
                            <span class="status rejected">Rejected</span>
                        @endif
                    </td>
                    <td>{{ $item->adminremark ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('kyc.view', $item->userid) }}" class="btn btn-sm btn-info">View</a>
                        <!--<a href="#" class="btn btn-sm btn-primary">Edit</a>-->
                    </td>
                </tr>
                @endforeach
           <div class="p-a text-center">
                        {{ $kyc->links() }}
                    </div>
        </tbody>
    </table>
</div>

<div class="p-a text-center">
    {{ $kyc->links() }} {{-- pagination links --}}
</div>
    </div>
</div>
@endsection
