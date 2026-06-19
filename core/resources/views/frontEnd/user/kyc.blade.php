@extends('frontEnd.layouts.master')

@section('content')
<?php
$status = Auth::user()->kyc_status;
$badgeClass = $status == 0 ? 'bg-warning' : ($status == 1 ? 'bg-success' : 'bg-danger');
$badgeText  = $status == 0 ? 'Pending' : ($status == 1 ? 'Approved' : 'Rejected');
?>

<style>
.widget_title { font-size: 30px; font-weight: 700; color: var(--white-color); margin-bottom: 20px; }
.step-section { display: none; }
.step-section.active { display: block; }
.uploaded-img { max-width: 200px; max-height: 150px; margin: 10px; border: 2px solid #fff; border-radius: 5px; }
.error-msg { font-size: 13px; margin-top: 5px; display: block; color: #ff6b6b; }


</style>

<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;">
    <div class="container">
        <div class="row">
            @include('frontEnd.user.usermenu')

            <div class="col-lg-10 col-sm-12 pt-3 pt-lg-0">
                <h2 class="widget_title">
                    Profx <span class="text-theme">KYC</span>
                    <button class="btn btn-sm text-white {{ $badgeClass }}">{{ $badgeText }}</button>
                </h2>

                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Show uploaded images --}}
                @if(!empty($kyc))
                    <h4 class="text-white mb-3">Your Uploaded KYC Images</h4>
                    <div class="d-flex flex-wrap">
                        @if($kyc->kyc_fileidfirst)
                            <div>
                                <p style="color:white">ID Front ({{ strtoupper($kyc->kyc_type) }})</p>
                                <img src="{{ asset($kyc->kyc_fileidfirst) }}" class="uploaded-img" alt="ID Front">
                            </div>
                        @endif
                        @if($kyc->kyc_fileidsecond)
                            <div>
                                <p style="color:white">ID Back ({{ strtoupper($kyc->kyc_type) }})</p>
                                <img src="{{ asset($kyc->kyc_fileidsecond) }}" class="uploaded-img" alt="ID Back">
                            </div>
                        @endif
                        @if($kyc->address_proof)
                            <div>
                                <p style="color:white">Address Proof ({{ strtoupper($kyc->address_type) }})</p>
                                <img src="{{ asset($kyc->address_proof) }}" class="uploaded-img" alt="Address Proof">
                            </div>
                        @endif
                        @if($kyc->adminremark && $kyc->status == 2)
                            <div class="w-100 text-danger mt-2"><strong>Admin Remark:</strong> {{ $kyc->adminremark }}</div>
                        @endif
                    </div>
                    <hr>
                @endif

                {{-- Show form only if any document is missing or rejected --}}
                @if(Auth::user()->kyc_status != 1 && (empty($kyc->kyc_fileidfirst) || empty($kyc->kyc_fileidsecond) || empty($kyc->address_proof) || $kyc->status == 2))
                <form method="POST" action="{{ route('user.upload.kyc') }}" enctype="multipart/form-data" id="kycForm">
                    @csrf
                    <input type="hidden" name="typedocument" value="finalsubmit">

                    {{-- STEP 1: ID Proof --}}
                    @if(empty($kyc->kyc_fileidfirst) || $kyc->status == 2)
                    <div class="step-section active" id="step1">
                        <h4 class="text-white mb-3">Step 1: Upload ID Proof</h4>
                        <div class="form-group mb-3 col-md-4">
                            <label style="color:white">ID Proof Type</label>
                            <select class="form-control border" name="kyc_type">
                                <option value="" disabled {{ old('kyc_type', $kyc->kyc_type ?? '') == '' ? 'selected':'' }}>Select ID Proof Type</option>
                                <option value="passport" {{ old('kyc_type', $kyc->kyc_type ?? '')=='passport'?'selected':'' }}>Passport</option>
                                <option value="id_card" {{ old('kyc_type', $kyc->kyc_type ?? '')=='id_card'?'selected':'' }}>ID Card</option>
                                <option value="driving_license" {{ old('kyc_type', $kyc->kyc_type ?? '')=='driving_license'?'selected':'' }}>Driving License</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label style="color:white">ID Front</label>
                                <input type="file" class=" border-0" style="cursor: pointer!important;" name="id_front" accept="image/*,application/pdf">
                            </div>
                            <div class="col-md-6">
                                <label style="color:white">ID Back</label>
                                <input type="file" class="border-0" style="cursor: pointer!important;" name="id_back" accept="image/*,application/pdf">
                            </div>
                        </div>
                        <button type="button" class="th-btn" id="nextBtn">Next</button>
                    </div>
                    @endif

                    {{-- STEP 2: Address Proof --}}
                    @if(empty($kyc->address_proof) || $kyc->status == 2)
                    <div class="step-section {{ empty($kyc->kyc_fileidfirst) || $kyc->status == 2 ? '' : 'active' }}" id="step2">
                        <h4 class="text-white mb-3">Step 2: Upload Address Proof</h4>
                        <div class="form-group mb-3 col-md-4">
                            <label style="color:white">Address Proof Type</label>
                            <select class="form-control border" name="address_type">
                                <option value="" disabled {{ old('address_type', $kyc->address_type ?? '') == '' ? 'selected':'' }}>Select Address Proof</option>
                                <option value="bank_statement" {{ old('address_type', $kyc->address_type ?? '')=='bank_statement'?'selected':'' }}>Bank Statement</option>
                                <option value="electric_bill" {{ old('address_type', $kyc->address_type ?? '')=='electric_bill'?'selected':'' }}>Electric Bill</option>
                                <option value="phone_bill" {{ old('address_type', $kyc->address_type ?? '')=='phone_bill'?'selected':'' }}>Phone Bill</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label style="color:white">Address Proof</label>
                            <input type="file" class="border-0" style="cursor: pointer!important;" name="address_proof" accept="image/*,application/pdf">
                        </div>
                        @if(empty($kyc->kyc_fileidfirst) || $kyc->status == 2)
                        <button type="button" class="btn btn-secondary" id="backBtn">Back</button>
                        @endif
                        <button type="submit" class="th-btn">Final Submit</button>
                    </div>
                    @endif

                </form>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>

<script>
$(document).ready(function () {

    // Multi-step navigation
    $("#nextBtn").click(function(){
        if($("#kycForm").valid()){
            $("#step1").removeClass("active");
            $("#step2").addClass("active");
        }
    });

    $("#backBtn").click(function(){
        $("#step2").removeClass("active");
        $("#step1").addClass("active");
    });

    // jQuery validation
    $("#kycForm").validate({
        ignore: [],
        rules: {
            kyc_type: { 
                required: function(){ return $("#step1").is(":visible"); } 
            },
            id_front: { 
                required: function(){ return $("#step1").is(":visible"); },
                extension: "jpg|jpeg|png|pdf",
            },
            id_back: { 
                required: function(){ return $("#step1").is(":visible"); },
                extension: "jpg|jpeg|png|pdf",
            },
            address_type: { 
                required: function(){ return $("#step2").is(":visible"); } 
            },
            address_proof: { 
                required: function(){ return $("#step2").is(":visible"); },
                extension: "jpg|jpeg|png|pdf",
            }
        },
        messages: {
            kyc_type: "Please select ID Proof Type",
            id_front: {
                required: "Please upload ID Front",
                extension: "Allowed formats: jpg, jpeg, png, pdf"
            },
            id_back: {
                required: "Please upload ID Back",
                extension: "Allowed formats: jpg, jpeg, png, pdf"
            },
            address_type: "Please select Address Proof Type",
            address_proof: {
                required: "Please upload Address Proof",
                extension: "Allowed formats: jpg, jpeg, png, pdf"
            }
        },
        errorElement: "span",
        errorClass: "error-msg",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

});
</script>
@endpush
