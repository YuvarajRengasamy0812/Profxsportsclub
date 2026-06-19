@extends('frontEnd.layouts.master')

@section('content')
<?php $user = auth()->user(); ?>

<style>
    .error-msg { color: red; font-size: 13px; margin-top: 5px; display: block; }
    .th-btn-close {
        position: relative;
        width: 32px; height: 32px;
        background-color: #45F882;
        border: none; border-radius: 50%;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: background-color 0.3s, transform 0.2s;
    }
    .th-btn-close:hover { background-color: #3ac06f; transform: scale(1.1); }
    .th-btn-close:before, .th-btn-close:after {
        content: ''; position: absolute;
        width: 16px; height: 2px; background-color: #fff;
        top: 50%; left: 50%; transform-origin: center;
    }
    .th-btn-close:before { transform: translate(-50%, -50%) rotate(45deg); }
    .th-btn-close:after { transform: translate(-50%, -50%) rotate(-45deg); }
    select option { background-color: #0b0e13; color: #fff; }
    #walletNetwork:focus{
        color: #fff!important;
        border: none!important;
    }
    #walletCrypto:focus{
        color: #fff!important;
        border: none!important;
    }
</style>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">
    <div class="container">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error Message --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
            @include('frontEnd.user.usermenu')

            <div class="col-lg-10 col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="widget_title">Crypto Wallet Details!</h2>
                    </div>

                    {{-- Wallets Table --}}
                    <div class="col-lg-12 col-md-12 mt-3">
                        <div class="bg-transparent">
                            <div class="card-header h5 mb-0 text-white d-flex justify-content-between align-items-center">
                                Wallet Details
                                <button class="th-btn md:w-auto" data-bs-toggle="modal" data-bs-target="#walletModal"
                                        onclick="openAddWalletModal()">+ Add Wallet</button>
                            </div>
                            <div class="card-body pb-0 text-white">
                                <div style="width: 100%; overflow-x: auto;">
                                    <table class="table table-striped table-bordered text-white vertical-middle" style="min-width: 700px;">
                                        <thead>
                                        <tr>
                                            <th class="text-white">#</th>
                                            <th class="text-white">Wallet Name</th>
                                            <th class="text-white">Crypto</th>
                                            <th class="text-white">Network</th>
                                            <th class="text-white">Address</th>
                                            <th class="text-white">Status</th>
                                            <th class="text-white">Proof</th>
                                            <th class="text-white">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($wallets as $key => $wallet)
                                            <tr class="text-white text-center">
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $wallet->wallet_name }}</td>
                                                <td>{{ $wallet->wallet_crypto }}</td>
                                                <td>{{ $wallet->wallet_network }}</td>
                                                <td>{{ $wallet->wallet_address }}</td>
                                                <td>{{ $wallet->status ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                @if($wallet->wallet_proof)
                                                    <a href="{{ asset($wallet->wallet_proof) }}" target="_blank">
                                                        <img src="{{ asset($wallet->wallet_proof) }}" 
                                                            alt="Proof" 
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:5px; border:1px solid #45F882;">
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                                <td class="d-flex gap-2 justify-content-center">
                                                    <button class="th-btn" style="min-width:100px"
                                                            onclick="openEditWalletModal('{{ $wallet->id }}','{{ $wallet->wallet_name }}','{{ $wallet->wallet_crypto }}','{{ $wallet->wallet_network }}','{{ $wallet->wallet_address }}','{{ $wallet->status }}','{{ $wallet->wallet_proof ? asset($wallet->wallet_proof) : '' }}')">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('cryptowallet.destroy',$wallet->id) }}" method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="th-btn style2 delete-btn" style="min-width:100px">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center text-white" colspan="7">No wallet details found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Wallet Modal --}}
<div class="modal fade" id="walletModal" tabindex="-1">
    <div class="modal-dialog" style="max-width: 800px; width: 90%;max-height:50vh; margin: auto; top: 50%; transform: translateY(-50%);">
        <form id="walletForm" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="walletFormMethod" value="POST">
            <input type="hidden" name="wallet_id" id="walletId">

            <div class="modal-content rounded-20" style="background-color:#0b0e13; border:1px solid #45F882;">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="walletModalLabel">Add Wallet</h5>
                    <button type="button" class="th-btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-white">
                    <div class="mb-3">
                        <label class="form-label text-white">Wallet Name</label>
                        <input type="text" name="wallet_name" id="walletName" class="form-control"
                               style="background:#0b0e13; color:#fff!important; border:1px solid #45F882" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Wallet Crypto</label>
                        <select name="wallet_crypto" id="walletCrypto" class="form-control text-white"
                                style="background:#0b0e13; border:1px solid #45F882" required>
                            <option value="usdt" selected>USDT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Wallet Network</label>
                        <select name="wallet_network" id="walletNetwork"
                                class="form-control text-white"
                                style="background:#0b0e13; border:1px solid #45F882" required>
                            <option value="BEP20">BEP20</option>
                            <option value="Trc20">Trc20</option>
                            <option value="Erc20">Erc20</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white">Address</label>
                        <input type="text" name="wallet_address" id="walletAddress" class="form-control"
                               style="background:#0b0e13; color:#fff!important; border:1px solid #45F882" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label text-white">Wallet Proof</label>
                    <input type="file" name="wallet_proof" id="walletProof" class="border-0 text-white" 
                        style="background:#0b0e13; color:#fff; border:1px solid #45F882">
                    <div id="walletProofPreview" class="mt-2">
                        <img src="" alt="Proof" style="width:100px; height:100px; object-fit:cover; border-radius:5px; display:none;">
                    </div>
                </div>
              <div class="mb-3">
                    <label class="form-label text-white">Status</label>
                    <select name="status" id="walletStatus" class="form-control text-white"
                            style="background:#0b0e13; border:1px solid #45F882" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                   

                    <div class="mb-3 otp-section" style="display: none;">
                        <label class="form-label text-white">Enter OTP</label>
                        <div class="d-flex gap-2">
                            <input type="text" name="otp" id="otpInput" class="form-control"
                                   style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882"
                                   placeholder="Enter OTP" required>
                            <button type="button" class="th-btn style2" id="verifyOtpBtn">Verify OTP</button>
                        </div>
                        <span id="otpMsg" class="text-info mt-2"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="th-btn" id="walletSaveBtn">Save</button>
                    <button type="button" class="th-btn style2" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){

   window.openAddWalletModal = function(){
    $('#walletModalLabel').text("Add Wallet");
    const walletForm = $('#walletForm');
    walletForm.attr('action', "{{ route('cryptowallet.store') }}");
    $('#walletFormMethod').val("POST");
    $('#walletId').val("");
    walletForm[0].reset();
    $('#walletStatus').val('1'); // Default to Active
    $('.otp-section').hide();
    $('#walletSaveBtn').prop('disabled', false).text("Save");
}

    // Edit Wallet Modal
   window.openEditWalletModal = function(id,name,crypto,network,address,status,wallet_proof){
    $('#walletModalLabel').text("Edit Wallet");
    const walletForm = $('#walletForm');
    walletForm.attr('action', "/cryptowallet/" + id);
    $('#walletFormMethod').val("POST");
    $('#walletId').val(id);
    $('#walletName').val(name);
    $('#walletCrypto').val(crypto);
    $('#walletNetwork').val(network);
    $('#walletAddress').val(address);
    $('#walletStatus').val(status);

    // Show proof if exists
    // if(wallet_proof){
    //     $('#walletProofPreview img').attr('src', wallet_proof).show();
    // } else {
    //     $('#walletProofPreview img').hide();
    // }

    $('.otp-section').hide();
    $('#walletSaveBtn').prop('disabled', false).text("Save");
    const modal = new bootstrap.Modal(document.getElementById('walletModal'));
    modal.show();
}

    // Delete confirm
    $(document).on('click','.delete-btn',function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this wallet?",
            icon: 'warning',
            showCancelButton:true,
            confirmButtonText:'Yes, delete it!'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });
    });

    // Form Validation + OTP request
    $("#walletForm").validate({
        rules: {
            wallet_name: { required: true },
            wallet_crypto: { required: true },
            wallet_network: { required: true },
            wallet_address: { required: true }
        },
        errorElement: "span",
        errorClass: "error-msg",
        errorPlacement: function(error, element){ error.insertAfter(element); },
        submitHandler: function(form){
            var userId = "{{ $user->id }}";
            $.post("{{ route('walletsendotp') }}",
                {_token:"{{ csrf_token() }}", user_id:userId},
                function(res){
                    if(res.success){
                        $('.otp-section').show();
                        $('#otpMsg').text("OTP sent to your email").css("color","#45F882");
                        $('#walletSaveBtn').prop('disabled', true).text("Verify OTP First");
                    }
                });
            return false;
        }
    });

    let otpProcessing = false;
$("#otpInput").on("keyup", function () {
    var otp = $(this).val();
    var user_id = "{{ $user->id }}";

    if (otp.length === 6 && !otpProcessing) {
        otpProcessing = true;

        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('otp', otp);
        formData.append('user_id', user_id);
        formData.append('wallet_id', $('#walletId').val());
        formData.append('wallet_name', $("#walletName").val());
        formData.append('wallet_crypto', $("#walletCrypto").val());
        formData.append('wallet_network', $("#walletNetwork").val());
        formData.append('wallet_address', $("#walletAddress").val());
        formData.append('status', $("#walletStatus").val());

        // Add image file if selected
        var fileInput = $('#walletProof')[0];
        if(fileInput.files.length > 0){
            formData.append('wallet_proof', fileInput.files[0]);
        }

        $.ajax({
            url: "{{ route('walletverifyotp') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                otpProcessing = false;
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => { location.reload(); });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message });
                }
            },
            error: function(){
                otpProcessing = false;
            }
        });
    }
});
    // OTP verification
    // let otpProcessing = false;
    // $("#otpInput").on("keyup", function () {
    //     var otp = $(this).val();
    //     var user_id = "{{ $user->id }}";

    //     if (otp.length === 6 && !otpProcessing) {
    //         otpProcessing = true;
    //         $.ajax({
    //             url: "{{ route('walletverifyotp') }}",
    //             type: "POST",
    //             data: {
    //                 _token: "{{ csrf_token() }}",
    //                 otp: otp,
    //                 user_id: user_id,
    //                 wallet_id: $('#walletId').val(),
    //                 wallet_name: $("#walletName").val(),
    //                 wallet_crypto: $("#walletCrypto").val(),
    //                 wallet_network: $("#walletNetwork").val(),
    //                 wallet_address: $("#walletAddress").val(),
    //                 status: $("#walletStatus").val(),
    //                 _method: $("#walletFormMethod").val()
    //             },
    //             success: function (response) {
    //                 otpProcessing = false;
    //                 if (response.success) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: 'Success',
    //                         text: response.message,
    //                         timer: 2000,
    //                         showConfirmButton: false
    //                     }).then(() => { location.reload(); });
    //                 } else {
    //                     Swal.fire({ icon: 'error', title: 'Error', text: response.message });
    //                 }
    //             },
    //             error: function(){
    //                 otpProcessing = false;
    //             }
    //         });
    //     }
    // });
});
</script>
@endpush
