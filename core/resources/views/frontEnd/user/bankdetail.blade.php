@extends('frontEnd.layouts.master')

@section('content')
<?php
$user = auth()->user();
?>
<style>
    .card-body.box-profile.fx-userpro-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .fx-avatar { position: relative; display: inline-block; }
    .fx-avatar .edit-icon { position: absolute; bottom: 0; right: 0; color: #45F882; border-radius: 50%; padding: 5px; font-size: 25px; transition: 0.3s; }
    .modal-dialog { max-width: 500px; }
    .modal-content { max-height: 600px; overflow-y: auto; padding: 1.5rem; }
    #bankModal .modal-body::-webkit-scrollbar { width: 10px; }
    #bankModal .modal-body::-webkit-scrollbar-track { background: #0b0e13; border-radius: 5px; }
    #bankModal .modal-body::-webkit-scrollbar-thumb { background-color: #45F882; border-radius: 5px; border: 2px solid #0b0e13; }
    #bankModal .modal-body { scrollbar-width: thin; scrollbar-color: #45F882 #0b0e13; }
    .th-btn-close { position: relative; width: 32px; height: 32px; background-color: #45F882; border: none; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background-color 0.3s, transform 0.2s; }
    .th-btn-close:hover { background-color: #3ac06f; transform: scale(1.1); }
    .th-btn-close:before, .th-btn-close:after { content: ''; position: absolute; width: 16px; height: 2px; background-color: #fff; top: 50%; left: 50%; transform-origin: center; }
    .th-btn-close:before { transform: translate(-50%, -50%) rotate(45deg); }
    .th-btn-close:after { transform: translate(-50%, -50%) rotate(-45deg); }
    .error-msg { color: red; font-size: 13px; margin-top: 5px; display: block; }
</style>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">
    <div class="container">
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
            @include('frontEnd.user.usermenu')

            <div class="col-lg-10 col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="widget_title">Profx Bank Details!</h2>
                    </div>

                    <div class="col-lg-12 col-md-12 mt-3">
                        <div class="bg-transparent">
                            <div class="card-header h5 mb-0 text-white d-flex justify-content-between align-items-center">
                                Bank Details
                                <button class="th-btn md:w-auto" data-bs-toggle="modal" data-bs-target="#bankModal"
                                        onclick="openAddModal()">+ Add Bank</button>
                            </div>
                            <div class="card-body pb-0 text-white">
                                <div style="width: 100%; overflow-x: auto;">
                                    <table class="table table-striped table-bordered text-white vertical-middle"
                                           style="min-width: 700px;">
                                        <thead>
                                        <tr >
                                            <th class="text-white">#</th>
                                            <th class="text-white">Bank Name</th>
                                            <th class="text-white">Account Number</th>
                                            <th class="text-white">Account Holder</th>
                                            <th class="text-white">IFSC Code</th>
                                            <th class="text-white">SWIFT Code</th>
                                            <th class="text-white">Proof</th>
                                            <th class="text-white">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($banks as $key => $bank)
                                            <tr class="text-white" style="text-align: center; vertical-align: middle">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $bank->bank_name }}</td>
                                                <td>{{ $bank->account_holder }}</td>
                                                <td>{{ $bank->account_number }}</td>
                                                <td>{{ $bank->ifsccode }}</td>
                                                <td>{{ $bank->swift_code }}</td>
                                                <td>
                                                @if($bank->bank_proof)
                                                    <a href="{{ asset($bank->bank_proof) }}" target="_blank">
                                                        <img src="{{ asset($bank->bank_proof) }}" 
                                                            alt="Proof" 
                                                            style="width:50px; height:50px; object-fit:cover; border-radius:5px; border:1px solid #45F882;">
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                                <td class="d-flex gap-2 justify-content-center">
                                                    <button class="th-btn" style="min-width:100px"
                                                            onclick="openEditModal('{{ $bank->id }}', '{{ $bank->bank_name }}', '{{ $bank->account_holder }}' , '{{ $bank->account_number }}','{{ $bank->ifsccode }}', '{{ $bank->swift_code }}','{{ $bank->bank_proof ? asset($bank->bank_proof) : '' }}')">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('bankdetails.destroy', $bank->id) }}"
                                                          method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="th-btn style2 delete-btn" style="min-width:100px">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-white">No bank details found.</td>
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


    <!-- Bank Modal -->
    <div class="modal fade modal-details" id="bankModal" tabindex="-1">
        <div class="modal-dialog"
            style="max-width: 1000px; width: 90%; height: 90vh; margin: 0; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); border-color: #45F882;">
            <form id="bankForm" method="POST" action="">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="bankId">

                <div class="modal-content d-flex flex-column rounded-20"
                    style="height: 100%; background-color: #0b0e13; border: 1px solid #45F882">
                    <!-- Header -->
                    <div class="modal-header flex-shrink-0 rounded-20 mb-2">
                        <h5 class="modal-title text-white" id="bankModalLabel">Add Bank Detail</h5>
                        <button type="button" class="th-btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Scrollable Body -->
                    <div class="modal-body flex-grow-1 rounded-20"
                        style="overflow-y: auto; height: 100dvh;">
                        <div class="mb-3">
                            <label class="form-label text-white">Bank Name</label>
                            <input type="text" name="bank_name" id="bankName" class="form-control"
                                style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Account Holder</label>
                            <input type="text" name="account_holder" id="accountHolder" class="form-control"
                                style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Account Number</label>
                            <input type="text" name="account_number" id="accountNumber" class="form-control"
                                style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">ifsc code</label>
                            <input type="text" name="ifsccode" id="ifsccode" class="form-control"
                                style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-white">Swift Code</label>
                            <input type="text" name="swift_code" id="swiftCode" class="form-control"
                                style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        </div>

                        <div class="mb-3">
                        <label class="form-label text-white">Bank Proof</label>
                        <input type="file" name="bank_proof" id="bankProof" class="border-0 text-white"
                            style="background: #0b0e13; color: #ffffff!important; border: 1px solid #45F882" required>
                        <div id="bankProofPreview" class="mt-2">
                            <img src="" alt="Proof" style="width:100px; height:100px; object-fit:cover; border-radius:5px; display:none;">
                        </div>
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

                    <!-- Footer -->
                        <div class="modal-footer flex-shrink-0">
                            <button type="submit" class="th-btn" id="saveBtn">Save</button>
                            <button type="button" class="th-btn style2" data-bs-dismiss="modal">Close</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>

   
$(document).ready(function(){

    // Add Modal
    window.openAddModal = function() {
        $('#bankModalLabel').text("Add Bank");
        const bankForm = $('#bankForm');
        bankForm.attr('action', "{{ route('bankdetails.store') }}");
        $('#formMethod').val("POST");
        bankForm[0].reset();
        $('.otp-section').hide();
        $('#saveBtn').prop('disabled', false).text('Save');
    }
    window.openEditModal = function(id, bankName, accountHolder, accountNumber, ifsccode, swift,bank_proof) {
    document.getElementById('bankModalLabel').innerText = "Edit Bank";
    const bankForm = document.getElementById('bankForm');

    document.getElementById('formMethod').value = "POST"; 
    document.getElementById('bankId').value = id;
    document.getElementById('bankName').value = bankName;
    document.getElementById('accountHolder').value = accountHolder;
    document.getElementById('accountNumber').value = accountNumber;
    document.getElementById('ifsccode').value = ifsccode;
    document.getElementById('swiftCode').value = swift || '';

      const proofImg = document.querySelector('#bankProofPreview img');
    // if(bank_proof){
    //     proofImg.src = bank_proof;
    //     proofImg.style.display = 'block';
    // } else {
    //     proofImg.style.display = 'none';
    //     proofImg.src = '';
    // }

    const modal = new bootstrap.Modal(document.getElementById('bankModal'));
    modal.show();
}

    // Delete confirmation
    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'Yes, delete it!'
        }).then((result)=>{
            if(result.isConfirmed){
                form.submit();
            }
        });
    });

    // Validation + OTP flow
    $("#bankForm").validate({
        rules: {
            bank_name: { required: true },
            account_number: { required: true, digits:true, minlength:6, maxlength:20 },
            account_holder: { required:true },
            ifsccode: { required:true, minlength:10, maxlength:34 },
            swift_code: { required:true, minlength:8, maxlength:11 }
        },
        errorElement: "span",
        errorClass: "error-msg",
        errorPlacement: function(error, element){ error.insertAfter(element); },
        submitHandler: function(form){
            var userId = "{{ $user->id }}";
            $.post("{{ route('sendotp') }}",
                {_token:"{{ csrf_token() }}", user_id:userId},
                function(res){
                    if(res.success){
                        $('.otp-section').show();
                        $('#otpMsg').text("OTP sent to your email").css("color","#45F882");
                        $('#saveBtn').prop('disabled', true).text("Verify OTP First");
                    }
                });
            return false;
        }
    });

    // OTP verification
    let otpProcessing = false;

$("#otpInput").on("keyup", function () {
    var otp = $(this).val();
    var user_id = "{{ $user->id }}";

    if (otp.length === 6 && !otpProcessing) {
        otpProcessing = true;

        // Create FormData for file upload
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('otp', otp);
        formData.append('user_id', user_id);
        formData.append('bank_id', $('#bankId').val());
        formData.append('bank_name', $("#bankName").val());
        formData.append('account_number', $("#accountNumber").val());
        formData.append('account_holder', $("#accountHolder").val());
        formData.append('ifsccode', $("#ifsccode").val());
        formData.append('swift_code', $("#swiftCode").val());
        formData.append('_method', $("#formMethod").val());

        // Append bank proof file if selected
        var fileInput = $('#bankProof')[0];
        if(fileInput.files.length > 0){
            formData.append('bank_proof', fileInput.files[0]);
        }

        $.ajax({
            url: "{{ route('verifyotp') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                otpProcessing = false;
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(){
                otpProcessing = false;
            }
        });
    }
});

});
</script>
@endpush
