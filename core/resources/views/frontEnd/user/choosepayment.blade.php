@extends('frontEnd.layouts.master')

@section('content')
<?php
$title_var = "title_" . @Helper::currentLanguage()->code;
$title_var2 = "title_" . config('smartend.default_language');
$details_var = "details_" . @Helper::currentLanguage()->code;
$details_var2 = "details_" . config('smartend.default_language');
$aboutsection1 = Helper::Topic(155);
$aboutsecupcoming = Helper::Topic(156);
$aboutseconemid = Helper::Topic(158);
$aboutsectwomid = Helper::Topic(159);
$aboutjoinleague = Helper::Topic(160);
?>
<style>
    /* Radio + label wrapper */
input[type="radio"] {
    display: none; /* hide native radio */
}

input[type="radio"] + label {
    display: flex!important;
    align-items: center!important;   /* ✅ vertical centering */
    gap: 10px!important;             /* ✅ space between radio / img / text */
    cursor: pointer!important;
    margin-bottom: 0!important;
}

/* Custom radio */
input[type="radio"] + label::before {
    content: "";
    position: relative!important;
    width: 18px;
    height: 18px;
    top:0!important;
}

</style>
<div id="loadingOverlay" style="display: none;">
    <div class="loading-box">
        <p>Please wait! Your payment will be processing...</p>
        <div class="spinner"></div>
    </div>
</div>
<div class="overflow-hidden space position-relative z-index-common" style="margin-top:100px;" >

	<div class="container">
        @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
		<div class="row">
			<div id="sidebar-overlay" class="overlay w-100 vh-100 d-none position-fixed"></div>
			@include('frontEnd.user.usermenu')
			<div class="col-lg-10 col-sm-12">
				<form id="fx-payment-form" method="POST" action="{{ route('paymentstore') }}" onsubmit="this.querySelector('button[type=submit]').disabled = true;" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="payment_purpose" value="{{ $type }}" />

				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						<h2 class="widget_title" style="margin-bottom:0px;">ProFX <span class="text-theme">Payment Method</span>!</h2>
					</div>
				</div>
				<div class="row align-items-stretch c-dashboard-group m-3">
				<h6 class="text-white">E Wallet</h6>				
					@if($paygateway->nowpayment_status == 1)
						<div class="col-12 col-md-4 text-center" style="margin-top:1.5rem;">
							<div class="form-group d-flex flex-wrap">
								<div class="custom-control custom-radio mr-3 mb-2">
									<input type="radio" id="mode_nowpay" name="payment_gateway" value="nowpayment" class="custom-control-input" checked />
									{{-- <label class="custom-control-label text-white" for="mode_nowpay"><img src="{{ asset('uploads/payment/' . $paygateway->nowpayment_logo) }}" alt="Now Payment" style="max-height: 80px; vertical-align: middle;" /> </label> --}}
									<label class="custom-control-label text-white" for="mode_nowpay"><img src="{{ URL::to('uploads/payment/now.png') }}" alt="Now Payment" style="max-height: 80px; vertical-align: middle;" /> </label>

								</div>
							</div>
						</div>
					@endif	
					
					@if($paygateway->usdt_status == 1)
                        <div class="col-12 col-md-4 text-center">
                            <div class="form-group d-flex flex-wrap">
                                <div class="custom-control custom-radio mr-3 mb-2">
                                    <input type="radio" id="mode_usdt" name="payment_gateway" value="usdt" class="custom-control-input" />

                                    <label class="form-check-label w-100 cursor-pointer d-flex" for="mode_usdt">
                                        <img src="{{ URL::to('uploads/payment/trc.png') }}" 
                                            alt="USDT"
                                            class="img-fluid mb-2"
                                            style="max-width: 50px;" />
                                    <div class="fw-bold text-white" style="width:max-content">USDT Payment</div>


                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-12 col-md-4 text-center">
                            <div class="address-check  trade-deposit-type border rounded">
                                <div class="form-check">
                                    <input type="radio" name="deposit_type" class="form-check-input input-primary tradefund-deposit" id="usdtpay-check-5" value="USDT Deposit" data-type="usdtpay" checked>
                                    <label class="form-check-label d-block" for="usdtpay-check-5">
                                        <span class="card-body p-2 d-block">
                                            <span class="d-flex justify-content-between">
                                            <span><span class="h6 f-w-500 mb-1 d-block">USDT Payment</span>
                                            <span class="f-10 text-muted">USDT / CRYPTO Payment</span>
                                            </span>
                                            <span class="text-success">
                                            <img src="{{ URL::to('uploads/payment/usdt.png') }}" alt="img" class="img-fluid ms-1 wid-25" /></span>
                                        </span></span>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                    @endif
				</div>
				
				<div class="row align-items-stretch c-dashboard-group m-3">
					@if($paygateway->stripe_status == 1)
					<div class="col-12 col-md-4">
				    <h6 class="text-white">Card Payment</h6>				
						<div class="form-group d-flex flex-wrap">
							<div class="custom-control custom-radio mr-3 mb-2">
								<input type="radio" id="mode_stripe" name="payment_gateway" value="stripe" class="custom-control-input" />
								<label class="custom-control-label text-white" for="mode_stripe"><img src="{{ URL::to('uploads/payment/stripe.png') }}" alt="Stripe" style="max-height: 60px; vertical-align: middle;" /> </label>
							</div>
					    </div>
				    </div>
					@endif
                    @if($paygateway->xyrapay_status == 1)
                        <div class="col-12 col-md-4">
                            <div class="form-group d-flex flex-wrap">
                                <div class="custom-control custom-radio mr-3 mb-2">
                                    <input type="radio" id="mode_xyrapay" name="payment_gateway" value="xyrapay" class="custom-control-input" />
                                    <label class="custom-control-label text-white" for="mode_xyrapay">
                                        <img src="{{ URL::to('uploads/payment/xyra.png') }}" alt="Xyrapay" style="width:193px; vertical-align: middle;" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
				    <!--</div>-->
				
				    <!--<div class="row align-items-stretch c-dashboard-group m-3">-->
                    @if($paygateway->bank_deposit_status == 1)
                        <div class="col-12 col-md-4">
				    <h6 class="text-white">Other Payments</h6>
                            <div class="form-group d-flex flex-wrap">
                                <div class="custom-control custom-radio mr-3 mb-2">
                                    <input type="radio" id="mode_bank" name="payment_gateway" value="bank_deposit" class="custom-control-input" />

                                    <label class="form-check-label w-100 cursor-pointer d-flex" for="mode_bank">
                                        <img src="{{ URL::to('uploads/payment/bank.png') }}"
                                            alt="USDT"
                                            class="img-fluid mb-2"
                                            style="max-width: 50px;" />
                                    <div class="fw-bold text-white" style="width:max-content">Bank Deposit</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endif
				</div>
				
				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-lg-12">
						<h2 class="widget_title">Deposit <span class="text-theme">Details</span> !</h2>
					</div>
				</div>

                <div class="container usdtpay trade-deposit-details wallet-deposit-details" style="display:none;">
                    {{-- <form method="post" style="padding:10px;"
                        class="md-float-material form-material"
                        enctype="multipart/form-data"> --}}
                        <input type="hidden" name="user[deposit_type]"
                            class="tradedeposittype" value="USDT Deposit">
                        <input type="hidden" name="user[email]"
                            value="{{ session('clogin') }}">
                        {{-- <input type="hidden" name="user[usdt_wallet_id]"
                            value="{{ $user_groups['usdt_wallet_id'] }}">
                        <input type="hidden" name="user[usdt_wallet_qr]"
                            value="{{ $user_groups['usdt_wallet_qr'] }}">
                        <input class="user_trade_id" type="hidden"
                            name="user[trade_id]" value="" readonly required > --}}


                        <div class="col-12 mt-2">
                            <div class="form-group row">
                                <div class="col-lg-4 col-sm-12">
                                    <label class="col-form-label text-white">DEPOSIT ADDRESS : </label>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mx-4">
                                    {{-- <medium class="text-muted d-block text-center"><b>Tron</b></medium> --}}
                                    <a href="#" class="d-block mb-4"><img src="{{ URL::to('uploads/payment/tron.jpeg') }}" alt="" height="210"></a>
                                    <medium class="text-white d-block text-break text-center"><b>TGGbNk9YvAEdguozs3EdapnEAuc1RYghio</b></medium>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <div class="mx-4">
                                    {{-- <medium class="text-muted d-block text-center"><b>Ethereum</b></medium> --}}
                                    <a href="#" class="d-block mb-4"><img src="{{ URL::to('uploads/payment/ethereum.jpeg') }}" alt="" height="210"></a>
                                    <medium class="text-white d-block text-break text-center"><b>0x07b0a37f957b82633ce1aadb8e6752c88f115094</b></medium>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="form-group row"><label
                                    class="col-lg-4 col-form-label text-white">DEPOSIT
                                    CURRENCY
                                    :<small class="text-muted d-block"> Please
                                        select the currency you wish to use for
                                        the payment </small></label>
                                <input type="hidden" name="currency"
                                    value="USDT TRC20">
                                <div class="col-lg-8"><select class="form-select bg-dark"
                                        id="exampleFormControlSelect1" disabled=""
                                        name="currencyType">
                                        <option value="USDT TRC20">USDT</option>
                                    </select></div>
                            </div>
                            {{-- <div class="form-group row"><label
                                    class="col-lg-4 col-form-label">ENTER
                                    AMOUNT :<small class="text-muted d-block">
                                        Please enter the amount to be deposited
                                        in selected
                                        currency</small></label>
                                <div class="col-lg-8">
                                    <div class="input-group mb-3"><span
                                            class="input-group-text">USDT
                                            </span><input type="number"
                                            class="form-control wallet-amount"
                                            aria-label="Amount" name="user[deposit]" min="10" placeholder="Minimum $10" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label
                                    class="col-lg-4 col-form-label">AMOUNT IN
                                    USD :<small class="text-muted d-block">
                                        Deposit amount in USD </small></label>
                                <div class="col-lg-8">
                                    <div class="input-group mb-3"><span
                                            class="input-group-text">USD</span><input
                                            type="text"
                                            class="form-control wallet-amount-usd"
                                            aria-label="Amount" disabled=""><!---->
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group row"><label
                                    class="col-lg-4 col-form-label text-white">DEPOSIT
                                    PROOF:<small class="text-muted d-block">
                                        Upload proof of your transaction
                                    </small></label>
                                <div class="col-lg-8"><input type="file"
                                        accept="application/pdf,image/png,image/jpeg"
                                        class="form-control" data-limit="2"
                                        name="usdt_deposit_proof" style="border:none;" >
                                    <small data-v-d6f2db71=""
                                        class="text-muted mt-2">Maximum File
                                        Size Allowed : 2MB</small>
                                </div>
                            </div>
                            <!---->
                            {{-- <div class="">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <div class="row g-1">
                                        <button type="submit" class="btn btn-primary col-12">PROCESS PAYMENT</button>
                                            <!--<input type="submit" name="add_wallet"
                                                class="btn btn-primary col-12"
                                                value="PROCESS PAYMENT">-->
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                    {{-- </form> --}}
                </div>
                <div class="container bank-deposit-details wallet-deposit-details" style="display:none;">
                    <input type="hidden" name="user[deposit_type]" value="Bank Deposit">
                    <input type="hidden" name="user[email]" value="{{ session('clogin') }}">

                    {{-- <div class="col-12 mt-2">
                        <div class="form-group row bank-input">
                            <div class="col-lg-4 col-sm-12">
                                <label class="col-form-label text-white">ACCOUNT HOLDER :</label>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mx-4">
                                    <medium class="text-white d-block text-break"><b>Profx Media FZ-LLC</b></medium>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input">
                            <div class="col-lg-4 col-sm-12">
                                <label class="col-form-label text-white">ACCOUNT NUMBER :</label>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mx-4">
                                    <medium class="text-white d-block text-break"><b>9924196506</b></medium>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input">
                            <div class="col-lg-4 col-sm-12">
                                <label class="col-form-label text-white">IBAN :</label>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mx-4">
                                    <medium class="text-white d-block text-break"><b>AE460860000009924196506</b></medium>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input">
                            <div class="col-lg-4 col-sm-12">
                                <label class="col-form-label text-white">BIC :</label>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mx-4">
                                    <medium class="text-white d-block text-break"><b>WIOBAEADXXX</b></medium>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input">
                            <div class="col-lg-4 col-sm-12">
                                <label class="col-form-label text-white">BANK ADDRESS :</label>
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <div class="mx-4">
                                    <medium class="text-white d-block text-break"><b>Etihad Airways Centre 5th Floor, Abu Dhabi, UAE</b></medium>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-12 mt-2">
                        <div class="form-group row bank-input align-items-center">
                            <div class="col-lg-4">
                                <label class="col-form-label text-white mb-0">ACCOUNT HOLDER :</label>
                            </div>
                            <div class="col-lg-8 ">
                                <span class="text-white d-block text-break fw-bold">Profx Media FZ-LLC</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input align-items-center">
                            <div class="col-lg-4">
                                <label class="col-form-label text-white mb-0">ACCOUNT NUMBER :</label>
                            </div>
                            <div class="col-lg-8 ">
                                <span class="text-white d-block text-break fw-bold">9924196506</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input align-items-center">
                            <div class="col-lg-4 ">
                                <label class="col-form-label text-white mb-0">IBAN :</label>
                            </div>
                            <div class="col-lg-8 ">
                                <span class="text-white d-block text-break fw-bold">AE460860000009924196506</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input align-items-center">
                            <div class="col-lg-4 ">
                                <label class="col-form-label text-white mb-0">BIC :</label>
                            </div>
                            <div class="col-lg-8 ">
                                <span class="text-white d-block text-break fw-bold">WIOBAEADXXX</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group row bank-input align-items-center">
                            <div class="col-lg-4 ">
                                <label class="col-form-label text-white mb-0">BANK ADDRESS :</label>
                            </div>
                            <div class="col-lg-8 ">
                                <span class="text-white d-block text-break fw-bold">Etihad Airways Centre 5th Floor, Abu Dhabi, UAE</span>
                            </div>
                        </div>
                    </div> --}}
                    <div style=" border: 1px solid #fbfbfb; border-radius: 10px; background-color: rgba(0,0,0,0.1);" class="p-3">
                        <div class="col-12 mt-2">
                        <div class="form-group d-flex justify-content-between align-items-center bank-input">
                            <label class="col-form-label text-white mb-0 me-2 col-sm-6">ACCOUNT HOLDER :</label>
                            <span class="text-white fw-bold text-break col-sm-6">Profx Media FZ-LLC</span>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group d-flex justify-content-between align-items-center bank-input">
                            <label class="col-form-label text-white mb-0 me-2 col-sm-6">ACCOUNT NUMBER :</label>
                            <span class="text-white fw-bold text-break col-sm-6">9924196506</span>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group d-flex justify-content-between align-items-center bank-input">
                            <label class="col-form-label text-white mb-0 me-2 col-sm-6">IBAN :</label>
                            <span class="text-white fw-bold text-break col-sm-6">AE460860000009924196506</span>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group d-flex justify-content-between align-items-center bank-input">
                            <label class="col-form-label text-white mb-0 me-2 col-sm-6">BIC :</label>
                            <span class="text-white fw-bold text-break col-sm-6">WIOBAEADXXX</span>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group d-flex justify-content-between align-items-center bank-input">
                            <label class="col-form-label text-white mb-0 me-2 col-sm-6">BANK ADDRESS:</label>
                            <span class="text-white fw-bold text-break col-sm-6">Etihad Airways Centre 5th Floor, Abu Dhabi, UAE</span>
                        </div>
                    </div>
                    </div>



                    <div class="col-12 mt-2">
                    <div class="form-group d-flex justify-content-between align-items-center"><label
                                    class=" col-form-label text-white mb-0 me-2 col-sm-6">DEPOSIT
                                    PROOF:<small class="text-muted d-block">
                                        Upload proof of your transaction
                                    </small></label>
                                <div class="col-sm-6"><input type="file"
                                        accept="application/pdf,image/png,image/jpeg"
                                        class="form-control" data-limit="2"
                                        name="deposit_proof" style="border:none;" >
                                    <small data-v-d6f2db71=""
                                        class="text-muted mt-2">Maximum File
                                        Size Allowed : 2MB</small>
                                </div>

                            </div>
                    </div>
                </div>


				

				<div class="row align-items-stretch c-dashboard-group m-3">
					<div class="col-md-6">
						<div class="form-group">
							<input type="number" name="payment_amount" class="form-control border text-dark" placeholder="Enter Amount" value="{{ $amount }}" required {{ $type === 'register' ? 'readonly' : '' }} />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" name="paynow" class="th-btn w-50 text-end">Pay Now !</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>




@endsection
@push('before-styles')
    {{-- integrate your custom css code/files here --}}
    <style>
        .bank-input{
        margin-bottom: 0 !important;
    }
    </style>

@endpush
@push('after-styles')
    {{-- integrate your custom css code/files here --}}
@endpush
@push('after-scripts')
	<script src="{{ URL::asset('assets/frontend/vendor/intl-tel-input/js/intlTelInput.min.js') }}?v={{ Helper::system_version() }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
	$(document).ready(function () {
		$("#fx-payment-form").validate({
			ignore: [],
			rules: {
				payment_gateway: { required: true },
				payment_amount: { required: true }
			},
			errorElement: "div",
			errorPlacement: function (error, element) {
				error.addClass("invalid-feedback");
				element.closest(".form-group").append(error);
			},
			highlight: function (element) {
				$(element).addClass("is-invalid");
			},
			unhighlight: function (element) {
				$(element).removeClass("is-invalid");
			},
			submitHandler: function (form) {
				$('#loadingOverlay').show();
				$('.th-btn[type="submit"]').prop('disabled', true);
				form.submit();
			}
		});
	});


	</script>
    <script>
// document.addEventListener('DOMContentLoaded', function() {
//     const usdtRadio = document.getElementById('mode_usdt');
//     const usdtForm = document.querySelector('.usdtpay.trade-deposit-details');

//     // Hide by default
//     usdtForm.style.display = 'none';

//     // Listen for changes
//     const paymentRadios = document.querySelectorAll('input[name="payment_gateway"]');
//     paymentRadios.forEach(radio => {
//         radio.addEventListener('change', function() {
//             if (this.value === 'usdt') {
//                 usdtForm.style.display = 'block';
//             } else {
//                 usdtForm.style.display = 'none';
//             }
//         });
//     });

//     const bankForm = document.querySelector('.bank-deposit-details');
//     bankForm.style.display = 'none';

//     const paymentRadios = document.querySelectorAll('input[name="payment_gateway"]');
//     paymentRadios.forEach(radio => {
//         radio.addEventListener('change', function() {
//             if (this.value === 'bank_deposit') {
//                 bankForm.style.display = 'block';
//             } else {
//                 bankForm.style.display = 'none';
//             }
//         });
//     });


// });
document.addEventListener('DOMContentLoaded', function() {
    const usdtForm = document.querySelector('.usdtpay.trade-deposit-details');
    const bankForm = document.querySelector('.bank-deposit-details');

    // Hide both forms by default
    usdtForm.style.display = 'none';
    bankForm.style.display = 'none';

    const paymentRadios = document.querySelectorAll('input[name="payment_gateway"]');

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'usdt') {
                usdtForm.style.display = 'block';
                bankForm.style.display = 'none';
            } else if (this.value === 'bank_deposit') {
                bankForm.style.display = 'block';
                usdtForm.style.display = 'none';
            } else {
                usdtForm.style.display = 'none';
                bankForm.style.display = 'none';
            }
        });
    });
});

</script>

@endpush
@section('footInclude')
    {{-- integrate your custom js code/files here--}}
@endsection
