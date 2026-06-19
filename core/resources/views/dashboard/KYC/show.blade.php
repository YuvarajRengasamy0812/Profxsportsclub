@extends('dashboard.layouts.master')
@section('title', __('KYC Details'))

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
.close-btn {
    position: absolute;
    top: 8px;
    right: 12px;
    background: none;
    border: none;
    font-size: 1.5rem;
    color: #333;
    cursor: pointer;
    z-index: 1051;
}
.close-btn:hover {
    color: #000;
}
</style>

<div class="padding">

    {{-- User Details --}}
    <div class="box mb-4">
        <div class="box-header dker"><h3>User Details</h3></div>
        <div class="p-a">
            <table class="table table-bordered">
                <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ $kycRecords->first()->user->name ?? '—' }} {{ $kycRecords->first()->user->lastname ?? '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('Email') }}</th>
                    <td>{{ $kycRecords->first()->user->email ?? '—' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- KYC Records --}}
    @foreach($kycRecords as $kyc)
    <div class="box mb-4">
        <div class="box-header dker">
            <h3>{{ ucfirst($kyc->kyc_type) }} Document</h3>
        </div>
        <div class="p-a">
            <div class="row text-center">

                {{-- ID Front --}}
                @if($kyc->kyc_fileidfirst)
                <div class="col-md-4 mb-2">
                    <p class="fs-3">ID Front</p>
                    <img src="{{ asset($kyc->kyc_fileidfirst) }}" 
                        class="img-fluid img-thumbnail kyc-image" 
                        style="max-width:10rem; max-height:10rem"
                        data-toggle="modal" data-target="#imageModal"
                        data-src="{{ asset($kyc->kyc_fileidfirst) }}"
                        alt="ID Front">
                </div>
                @endif

                {{-- ID Back --}}
                @if($kyc->kyc_fileidsecond)
                <div class="col-md-4 mb-2">
                    <p class="fs-3">ID Back</p>
                    <img src="{{ asset($kyc->kyc_fileidsecond) }}" 
                        class="img-fluid img-thumbnail kyc-image" 
                        style="max-width:10rem; max-height:10rem"
                        data-toggle="modal" data-target="#imageModal"
                        data-src="{{ asset($kyc->kyc_fileidsecond) }}"
                        alt="ID Back">
                </div>
                @endif

                {{-- Address Proof --}}
                @if($kyc->address_proof)
                <div class="col-md-4 mb-2">
                    <p class="fs-3">Address Proof</p>
                    <img src="{{ asset($kyc->address_proof) }}" 
                        class="img-fluid img-thumbnail kyc-image" 
                        style="max-width:10rem; max-height:10rem"
                        data-toggle="modal" data-target="#imageModal"
                        data-src="{{ asset($kyc->address_proof) }}"
                        alt="Address Proof">
                </div>
                @endif

            </div>
        </div>
    </div>
    @endforeach

    {{-- Approve / Reject buttons --}}
<div class="text-center mt-4">
    @php
        $isPending = $kycRecords->contains('status', 0);
        $isApproved = $kycRecords->every(fn($k) => $k->status == 1);
        $isRejected = $kycRecords->every(fn($k) => $k->status == 2);
    @endphp

    @if($isPending)
        <button class="btn btn-success m-x" data-toggle="modal" data-target="#approveAllModal">
            Approve 
        </button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#rejectAllModal">
            Reject 
        </button>
    @elseif($isApproved)
        <span class="status approved">Approved</span>
    @elseif($isRejected)
         <span class="status rejected">Rejected</span>
    @endif
</div>


<!-- Approve All Modal -->
<div class="modal fade" id="approveAllModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Approve All Documents</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('kyc.approve', $userId) }}" method="POST">
        @csrf
        <div class="modal-body">
          <p>Are you sure you want to <b>approve all KYC documents</b> for this user?</p>
          <div class="form-group">
            <label>Admin Remark</label>
            <textarea name="adminremark" class="form-control" required></textarea>
          </div>
        </div>
         
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Yes, Approve</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Reject All Modal -->
<div class="modal fade" id="rejectAllModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Reject All Documents</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ route('kyc.reject', $userId) }}" method="POST">
        @csrf
        <div class="modal-body">
          <p>Are you sure you want to <b>reject all KYC documents</b> for this user?</p>
          <div class="form-group">
            <label>Admin Remark</label>
            <textarea name="adminremark" class="form-control" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Yes, Reject</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content position-relative">
      
      <!-- Close button -->
      <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-close"></i>
      </button>

      <div class="modal-body text-center p-0">
        <img id="modalImage" src="" class="img-fluid" alt="Preview" 
             style="max-height: 80vh; max-width: 100%; margin: auto;">
      </div>
    </div>
  </div>
</div>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.kyc-image');
    const modalImg = document.getElementById('modalImage');

    images.forEach(img => {
        img.addEventListener('click', function() {
            modalImg.src = this.dataset.src;
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const rejectForm = document.querySelector('#rejectAllModal form');

    rejectForm.addEventListener('submit', function (e) {
        const remark = rejectForm.querySelector('textarea[name="adminremark"]').value.trim();
        if (remark.length === 0) {
            e.preventDefault();
            alert('Please enter a remark before rejecting.');
        }
    });
});
</script>
@endsection
