@extends('crm.layouts.master')
@php
    $user = Auth::user();
@endphp
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<div class="max-w-7xl mx-auto px-8 pt-6">
    <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl font-bold">{{ session('success') }}</div>
</div>
@endif
@if(session('error'))
<div class="max-w-7xl mx-auto px-8 pt-6">
    <div class="bg-red-100 text-red-700 px-6 py-4 rounded-2xl font-bold">{{ session('error') }}</div>
</div>
@endif

@if($user && $user->role === 'corporate')
<div class="bg-gray-50 p-8">
    <div class="space-y-10 max-w-7xl mx-auto">
        <div class="bg-[#0f172a] rounded-[3rem] p-10 md:p-14 text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 p-12 opacity-10 rotate-12">
                <i data-lucide="shield" style="width:300px;height:300px"></i>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-indigo-600 p-3 rounded-2xl shadow-xl"><i data-lucide="briefcase"></i></div>
                    <span class="text-xs font-black uppercase tracking-[0.3em] text-indigo-300">Corporate Hub</span>
                </div>
                <h2 class="text-5xl font-black mb-6 tracking-tighter">Corporate Subscription Plans</h2>
                <div class="flex gap-10 text-indigo-200 flex-wrap">
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-1">Booked Plans</div>
                        <div class="text-2xl font-black">{{ $corporatePlans->count() }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-1">Latest Plan</div>
                        <div class="text-2xl font-black">{{ optional($corporatePlans->first())->plan_name ?? 'None' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
            @php $events = Helper::Topics(38); @endphp
            @foreach($events as $event)
                @php
                    $image = !empty($event->photo_file) ? asset('uploads/topics/' . $event->photo_file) : asset('assets/frontend/images/resource/event-1.jpg');
                    $amount = is_numeric($event->details_en) ? (float) $event->details_en : (float) preg_replace('/[^0-9.]/', '', (string)$event->details_en);
                    $amount = $amount ?: 0;
                @endphp
                <div class="plan-card cursor-pointer border rounded-2xl shadow hover:shadow-xl p-4 text-center transform transition duration-300 hover:-translate-y-1 hover:scale-105"
                     data-id="{{ $event->id }}"
                     data-name="{{ $event->title_en }}"
                     data-amount="{{ $amount }}">
                    <img src="{{ $image }}" class="w-full h-56 object-cover rounded-xl mb-2">
                    <div class="font-bold text-lg">{{ $event->title_en }}</div>
                    <div class="text-[#e85a3c] font-black mt-1">${{ number_format($amount, 2) }}</div>
                    <button class="mt-3 w-full py-3 bg-[#0f172a] text-white rounded-2xl font-black hover:bg-[#e85a3c]">
                        {{ $amount <= 0 ? 'Direct Booking' : 'Choose Payment' }}
                    </button>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-black">My Booked Plans</h3>
            </div>
            @if($corporatePlans->isEmpty())
                <div class="text-slate-500 font-semibold">No plan booked yet. Please subscribe to continue.</div>
            @else
                <div class="space-y-4">
                    @foreach($corporatePlans as $plan)
                        <div class="border rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div>
                                <div class="text-lg font-black text-[#0f172a]">{{ $plan->plan_name }}</div>
                                <div class="text-sm text-slate-500">Method: {{ $plan->methods }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-black text-[#e85a3c]">${{ number_format((float)$plan->amount, 2) }}</div>
                                <div class="text-xs text-slate-400">{{ optional($plan->created_at)->format('d M Y h:i A') }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<div id="modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white w-full max-w-4xl p-8 shadow-2xl overflow-y-auto max-h-[90vh] rounded-3xl transform scale-90 opacity-0 transition-all duration-300 modal-animate">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 id="modalPlanName" class="text-3xl font-extrabold text-gray-900">Plan Name</h3>
                <div class="text-xl font-bold text-[#e85a3c] mt-1" id="modalPlanAmount">$0</div>
            </div>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-700"><i data-lucide="x" class="w-6 h-6"></i></button>
        </div>

        <div class="flex gap-2 mb-4 flex-wrap">
            <button class="tabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#0f172a]" data-tab="stripe">Stripe</button>
            <button class="tabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c]" data-tab="nowpayment">NowPayments</button>
            <button class="tabBtn px-4 py-2 rounded-full font-semibold transition hover:bg-[#0f172a] hover:text-white bg-[#e85a3c] text-white" data-tab="usdt">USDT</button>
            <button class="tabBtn px-4 py-2 rounded-full font-semibold transition hover:bg-[#0f172a] hover:text-white bg-[#e85a3c] text-white" data-tab="bank">Bank</button>
        </div>

        <div id="tabContent" class="space-y-6">
            <div class="tabItem mt-6" data-tab="stripe">
                <p class="font-bold mb-4">Pay with Card (Stripe)</p>
                <button onclick="payWithStripe()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Stripe</button>
            </div>
            <div class="tabItem mt-6 hidden" data-tab="nowpayment">
                <p class="font-bold mb-4">Pay with Crypto (NowPayments)</p>
                <button onclick="payWithNowPayments()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Crypto</button>
            </div>
            <div class="tabItem hidden" data-tab="usdt">
                <p class="font-bold mb-4 text-center">USDT Payment</p>
                <div class="flex justify-center gap-6 flex-wrap mb-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/frontend/images/payment/erc-20.jpeg') }}" class="w-44 h-44 object-contain rounded-xl border shadow" alt="ERC20">
                        <p class="mt-2 text-sm font-semibold text-gray-600">ERC20</p>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('assets/frontend/images/payment/trc-20.jpeg') }}" class="w-44 h-44 object-contain rounded-xl border shadow" alt="TRC20">
                        <p class="mt-2 text-sm font-semibold text-gray-600">TRC20</p>
                    </div>
                </div>
                <input type="text" id="usdsAmount" placeholder="Enter Amount" class="w-full p-3 border rounded-lg mt-2">
                <input type="file" id="usdsProof" class="w-full mt-3 border rounded-lg p-2">
                <div class="flex justify-center mt-5">
                    <button id="usdsSubmit" class="w-60 py-3 bg-[#e85a3c] text-white rounded-2xl font-bold hover:bg-[#0f172a]">Submit Payment</button>
                </div>
            </div>
            <div class="tabItem hidden" data-tab="bank">
                <p class="font-bold text-center mb-4">Bank Transfer</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 border rounded-2xl p-6">
                        <h4 class="text-lg font-extrabold mb-4 text-gray-800">Account Details</h4>
                        <ul class="space-y-3 text-sm text-gray-700">
                            <li class="flex justify-between"><span class="font-semibold">Account Holder</span><span>Profx Media FZ-LLC</span></li>
                            <li class="flex justify-between"><span class="font-semibold">Account Number</span><span>9924196506</span></li>
                            <li class="flex justify-between"><span class="font-semibold">IBAN</span><span>AE460860000009924196506</span></li>
                            <li class="flex justify-between"><span class="font-semibold">BIC</span><span>WIOBAEADXXX</span></li>
                        </ul>
                    </div>
                    <div class="bg-white border rounded-2xl p-6 shadow-sm">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Amount Paid</label>
                        <input type="text" id="bankAmount" placeholder="Enter Amount" class="w-full p-3 border rounded-lg mb-4">
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Upload Receipt</label>
                        <input type="file" id="bankProof" class="w-full border rounded-lg p-2 mb-6">
                        <div class="flex justify-center">
                            <button id="bankSubmit" class="w-60 py-3 bg-[#e85a3c] text-white rounded-2xl font-bold hover:bg-[#0f172a]">Submit Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="corporatePaymentForm" method="POST" action="{{ route('paymentstore') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="payment_purpose" value="corporate">
    <input type="hidden" name="payment_gateway" id="payment_gateway">
    <input type="hidden" name="payment_amount" id="payment_amount">
    <input type="hidden" name="plan_name" id="plan_name">
    <input type="hidden" name="game" id="game">
    <input type="file" name="deposit_proof" id="deposit_proof_input" style="display:none;">
    <input type="file" name="usdt_deposit_proof" id="usdt_deposit_proof_input" style="display:none;">
</form>

@else
<div class="flex items-center justify-center py-24">
    <div class="bg-white shadow-2xl rounded-[2.5rem] p-12 text-center max-w-md w-full">
        <div class="w-16 h-16 bg-orange-100 text-[#e85a3c] rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
            <i data-lucide="building" class="w-8 h-8"></i>
        </div>
        <h3 class="text-2xl font-black text-[#0f172a] mb-3">Corporate Access</h3>
        <p class="text-slate-500 text-sm mb-8">Please contact support to activate corporate role.</p>
    </div>
</div>
@endif

<script>
const planCards = document.querySelectorAll('.plan-card');
const modal = document.getElementById('modal');
const modalAnimate = modal ? modal.querySelector('.modal-animate') : null;
const tabButtons = modal ? modal.querySelectorAll('.tabBtn') : [];
const tabItems = modal ? modal.querySelectorAll('.tabItem') : [];
window.currentPlan = null;

function openModal() {
    if (!modal) return;
    modal.classList.remove('hidden');
    setTimeout(() => modalAnimate.classList.remove('scale-90','opacity-0'), 10);
}
function closeModal() {
    if (!modal) return;
    modalAnimate.classList.add('scale-90','opacity-0');
    setTimeout(() => modal.classList.add('hidden'), 200);
}

function submitDirectBooking(plan) {
    document.getElementById('payment_gateway').value = 'direct';
    document.getElementById('payment_amount').value = 0;
    document.getElementById('plan_name').value = plan.name;
    document.getElementById('game').value = plan.name;
    document.getElementById('corporatePaymentForm').submit();
}

planCards.forEach(card => {
    card.addEventListener('click', () => {
        const plan = {
            id: card.dataset.id,
            name: card.dataset.name,
            amount: parseFloat(card.dataset.amount || 0),
        };
        window.currentPlan = plan;

        if (plan.amount <= 0) {
            submitDirectBooking(plan);
            return;
        }

        openModal();
        document.getElementById('modalPlanName').innerText = plan.name;
        document.getElementById('modalPlanAmount').innerText = `$${plan.amount.toFixed(2)}`;

        tabItems.forEach(item => item.classList.add('hidden'));
        document.querySelector('.tabItem[data-tab="stripe"]').classList.remove('hidden');

        tabButtons.forEach(btn => {
            btn.classList.remove('bg-[#0f172a]');
            btn.classList.add('bg-[#e85a3c]');
        });
        const defaultBtn = document.querySelector('.tabBtn[data-tab="stripe"]');
        defaultBtn.classList.add('bg-[#0f172a]');
        defaultBtn.classList.remove('bg-[#e85a3c]');
    });
});

tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;
        tabItems.forEach(item => item.classList.add('hidden'));
        document.querySelector(`.tabItem[data-tab="${tab}"]`).classList.remove('hidden');
        tabButtons.forEach(b => {
            b.classList.remove('bg-[#0f172a]');
            b.classList.add('bg-[#e85a3c]');
        });
        btn.classList.add('bg-[#0f172a]');
        btn.classList.remove('bg-[#e85a3c]');
    });
});

function submitGatewayPayment(gateway, amount, proofInputId, usdt = false) {
    if (!window.currentPlan) return;

    if (proofInputId) {
        const proofInput = document.getElementById(proofInputId);
        if (!amount) {
            alert('Please enter the payment amount.');
            return;
        }
        if (!proofInput || proofInput.files.length === 0) {
            alert('Please upload payment proof.');
            return;
        }
        const dt = new DataTransfer();
        dt.items.add(proofInput.files[0]);
        if (usdt) {
            document.getElementById('usdt_deposit_proof_input').files = dt.files;
        } else {
            document.getElementById('deposit_proof_input').files = dt.files;
        }
    }

    document.getElementById('payment_gateway').value = gateway;
    document.getElementById('payment_amount').value = amount;
    document.getElementById('plan_name').value = window.currentPlan.name;
    document.getElementById('game').value = window.currentPlan.name;
    document.getElementById('corporatePaymentForm').submit();
}

function payWithStripe() {
    if (!window.currentPlan) return;
    submitGatewayPayment('stripe', window.currentPlan.amount);
}

function payWithNowPayments() {
    if (!window.currentPlan) return;
    submitGatewayPayment('nowpayment', window.currentPlan.amount);
}

const usdsSubmit = document.getElementById('usdsSubmit');
if (usdsSubmit) {
    usdsSubmit.addEventListener('click', () => {
        const amount = document.getElementById('usdsAmount').value;
        submitGatewayPayment('usdt', amount, 'usdsProof', true);
    });
}

const bankSubmit = document.getElementById('bankSubmit');
if (bankSubmit) {
    bankSubmit.addEventListener('click', () => {
        const amount = document.getElementById('bankAmount').value;
        submitGatewayPayment('bank_deposit', amount, 'bankProof', false);
    });
}

lucide.createIcons();
</script>
@endsection
