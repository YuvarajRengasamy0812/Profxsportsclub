@extends('crm.layouts.master')

@section('content')
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .payment-modal {
        margin-left: 275px;
        max-height: 90vh;
        overflow-y: auto;
    }
    @media (max-width: 1023px) {
        .payment-modal {
            margin-left: 0px !important;
        }
    }
</style>

<div class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-8 space-y-16">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center">
                <h3 class="text-[#e85a3c] font-black text-xs uppercase tracking-[0.4em] mb-4 inline-block">
                    Travel Events
                </h3>
                <h6 class="text-2xl md:text-5xl font-black text-[#0f172a] tracking-tighter leading-none">
                    Choose Your Adventure
                </h6>
            </div>

            <!-- Tabs -->
            <div class="flex gap-2 p-2 bg-white justify-center items-center rounded-3xl shadow-sm border border-slate-100">
                <button class="tab-btn px-4 sm:px-6 py-2 bg-[#e85a3c] text-white font-bold rounded-xl text-sm sm:text-base" onclick="filterSports('ALL', this)">All</button>
                <button class="tab-btn px-4 sm:px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl text-sm sm:text-base" onclick="filterSports('Esport', this)">Esport</button>
                <button class="tab-btn px-4 sm:px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl text-sm sm:text-base" onclick="filterSports('Physical', this)">Physical</button>
                <button class="tab-btn px-4 sm:px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl text-sm sm:text-base" onclick="filterSports('Indoor', this)">Indoor</button>
            </div>
        </div>

        <!-- EVENTS GRID -->
        <div id="sportsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10"></div>

    </div>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="payment-modal relative bg-white w-full max-w-4xl rounded-3xl p-8 sm:p-10 shadow-2xl transform scale-90 opacity-0 transition-all duration-300 modal-animate">
        <button onclick="closeModal()" class="absolute top-4 sm:top-6 right-4 sm:right-6 text-gray-500 hover:text-gray-800">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 id="modalPlanName" class="text-3xl sm:text-4xl font-extrabold text-[#0f172a]">Plan Name</h3>
                <div class="text-xl font-bold text-[#e85a3c] mt-1" id="modalPlanAmount">$0</div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex gap-2 mb-4 flex-wrap">
            <button class="tabBtn px-4 py-2 text-white rounded-full font-semibold transition hover:bg-[#0f172a]  bg-[#e85a3c] " data-tab="stripe">Stripe</button>
            <button class="tabBtn px-4 py-2 text-white rounded-full font-semibold transition hover:bg-[#0f172a]  bg-[#e85a3c] " data-tab="nowpayment">NowPayments</button>
            <button class="tabBtn px-4 py-2 text-white rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c] " data-tab="usds">USDT</button>
            <button class="tabBtn px-4 py-2 text-white rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c] " data-tab="bank">Bank</button>
        </div>

        <!-- Tab Content -->
        <div class="tabItem mt-6 hidden" data-tab="stripe">
            <p class="font-bold mb-4">Pay with Card (Stripe)</p>
            <button onclick="payWithStripe()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Stripe</button>
        </div>

        <div class="tabItem mt-6 hidden" data-tab="nowpayment">
            <p class="font-bold mb-4">Pay with Crypto (NowPayments)</p>
            <button onclick="payWithNowPayments()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Crypto</button>
        </div>

            <div class="tabItem hidden" data-tab="usds">
                <p class="font-bold mb-4 text-center">USDT Payment</p>
                <div class="flex justify-center gap-6 flex-wrap mb-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/frontend/images/payment/erc-20.jpeg') }}"
                            class="w-44 h-44 object-contain rounded-xl border shadow" alt="ERC20">
                        <p class="mt-2 text-sm font-semibold text-gray-600">ERC20</p>
                    </div>
                    <div class="text-center">
                        <img src="{{ asset('assets/frontend/images/payment/trc-20.jpeg') }}"
                            class="w-44 h-44 object-contain rounded-xl border shadow" alt="TRC20">
                        <p class="mt-2 text-sm font-semibold text-gray-600">TRC20</p>
                    </div>
                </div>
                <input type="text" id="usdsAmount" placeholder="Enter Amount" class="w-full p-3 border rounded-lg mt-2">
                <input type="file" id="usdsProof" class="w-full mt-3 border rounded-lg p-2">
                <div class="flex justify-center mt-5">
                    <button id="usdsSubmit"
                        class="w-60 py-3 bg-[#e85a3c] text-white rounded-2xl font-bold hover:bg-[#0f172a]">Submit Payment</button>
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

<!-- Hidden Form -->
<form id="travelPaymentForm" method="POST" action="{{ route('paymentstore') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="payment_purpose" value="travel">
    <input type="hidden" name="payment_gateway" id="payment_gateway">
    <input type="hidden" name="payment_amount" id="payment_amount">
    <input type="hidden" name="game" id="game">
    <input type="hidden" name="travel_id" id="travel_id">

    <!-- Hidden file inputs -->
    <input type="file" name="deposit_proof" id="deposit_proof_input" style="display:none;">
    <input type="file" name="usdt_deposit_proof" id="usdt_deposit_proof_input" style="display:none;">
</form>

<script>
    window.teams = @json($teams);
    window.activeCategory = 'ALL';
    window.normalizeCategory = function (value) {
        return String(value || '').trim().toLowerCase().replace(/\s+/g, '');
    };

    // Render events
    window.renderSports = function () {
        const grid = document.getElementById('sportsGrid');
        grid.innerHTML = '';
        const activeCategory = window.normalizeCategory(window.activeCategory);
        const filtered = (window.teams || []).filter(t => {
            const teamCategory = window.normalizeCategory(t.sports || 'Physical');
            return activeCategory === 'all' || teamCategory === activeCategory;
        });

        if (!filtered.length) {
            grid.innerHTML = `<div class="flex flex-col items-center justify-center p-8 sm:p-12 bg-white rounded-2xl shadow-lg border border-gray-200 animate-fade-in">
                <h3 class="text-lg sm:text-xl font-bold text-gray-700 mb-2">No Upcoming Sports Events</h3>
                <p class="text-gray-400 text-center max-w-xs text-sm sm:text-base">There are currently no upcoming sports events. Check back soon.</p>
            </div>`;
            return;
        }

        filtered.forEach(t => {
            const availableSlots = t.max_travelers - t.booked_travelers;
            const isFull = t.status === 'full' || availableSlots <= 0;
            const alreadyBooked = t.already_booked || false;

            grid.innerHTML += `
            <div class="bg-white rounded-[2rem] sm:rounded-[3rem] overflow-hidden border border-slate-100 shadow-lg hover:shadow-2xl transition transform hover:scale-105">
                <div class="h-48 sm:h-56 relative">
                    <img src="${t.image || ''}" class="w-full h-full object-cover"/>
                    <div class="absolute top-4 right-4 bg-[#0f172a] text-white px-4 py-2 rounded-full text-xs sm:text-sm font-black shadow-lg flex items-center gap-1">
                        <i data-lucide="dollar-sign" class="w-4 h-4"></i>
                        <span>${t.entryFee && t.entryFee > 0 ? `$${t.entryFee}` : 'Free'}</span>
                    </div>
                </div>
                <div class="p-6 sm:p-10">
                    <div class="flex flex-wrap justify-center gap-3 mb-3">
                        <div class="flex items-center gap-2">
                            <i data-lucide="activity" class="w-5 h-5 text-indigo-600"></i>
                            <span class="text-sm sm:text-lg font-semibold text-gray-700">${t.sports}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="gamepad" class="w-5 h-5 text-orange-500"></i>
                            <span class="text-sm sm:text-lg font-semibold text-gray-700">${t.game}</span>
                        </div>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-black text-[#0f172a] mb-4 mt-3 text-center">${t.name}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6 sm:mb-10">
                        <div class="bg-slate-50 p-3 sm:p-4 rounded-2xl sm:rounded-3xl flex items-center gap-2 sm:gap-3">
                            <i data-lucide="map-pin-house" class="text-indigo-600 w-4 h-4 sm:w-5 sm:h-5"></i>
                            <div>
                                <div class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase">Location</div>
                                <div class="text-[9px] sm:text-[10px] font-black">${t.location}</div>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-3 sm:p-4 rounded-2xl sm:rounded-3xl flex items-center gap-2 sm:gap-3">
                            <i data-lucide="calendar" class="text-[#e85a3c] w-4 h-4 sm:w-5 sm:h-5"></i>
                            <div>
                                <div class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase">Date</div>
                                <div class="text-[9px] sm:text-[10px] font-black">${new Date(t.created_at).toLocaleDateString('en-GB')}</div>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-3 sm:p-4 rounded-2xl sm:rounded-3xl flex items-center gap-2 sm:gap-3">
                            <i data-lucide="users" class="text-green-600 w-4 h-4 sm:w-5 sm:h-5"></i>
                            <div>
                                <div class="text-[8px] sm:text-[10px] font-black text-slate-400 uppercase">Slots</div>
                                <div class="text-[9px] sm:text-[10px] font-black">${availableSlots > 0 ? availableSlots : 'Full'}</div>
                            </div>
                        </div>
                    </div>

                    <button ${isFull || alreadyBooked ?
                        'disabled class="w-full py-3 sm:py-4 rounded-2xl bg-gray-400 text-white font-black uppercase cursor-not-allowed"' :
                        'onclick="handleBooking(' + t.id + ')" class="w-full py-3 sm:py-4 rounded-2xl bg-[#0f172a] text-white font-black uppercase hover:bg-[#e85a3c]"'
                    }>
                        ${alreadyBooked ? 'Already Booked' : (availableSlots <= 0 ? 'Full' : 'Book Session')}
                    </button>
                </div>
            </div>`;
        });

        lucide.createIcons();
    };

    window.filterSports = function (cat, el) {
        window.activeCategory = cat || 'ALL';
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('bg-[#e85a3c]', 'text-white'));
        el.classList.add('bg-[#e85a3c]', 'text-white');
        window.renderSports();
    };

    window.handleBooking = function (teamId) {
        const team = window.teams.find(t => t.id === teamId);
        if (!team) return;

        if (team.already_booked) {
            Swal.fire({ icon: 'info', title: 'Already Booked', text: 'You have already booked this event.', confirmButtonColor: '#e85a3c' });
            return;
        }

        if (!team.entryFee || team.entryFee == 0) {
            bookFreeEvent(team);
        } else {
            openPaymentModal(team);
        }
    };

    function bookFreeEvent(team) {
        const formData = new FormData();
        formData.append('travel_id', team.id);
        formData.append('game', team.game);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route("crmtravelbook") }}', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({ icon: 'success', title: 'Booking Confirmed!', text: 'Your booking has been saved.', confirmButtonColor: '#e85a3c' });
                    team.already_booked = true;
                    window.renderSports();
                } else {
                    Swal.fire({ icon: 'warning', title: 'Already Booked', text: data.message });
                }
            }).catch(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong' }));
    }

    function openPaymentModal(team) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalPlanName').innerText = team.name;
        document.getElementById('modalPlanAmount').innerText = `$${team.entryFee}`;
        window.currentPaidTeam = team;
        setTimeout(() => document.querySelector('.modal-animate').classList.remove('scale-90', 'opacity-0'), 10);
    }

    window.closeModal = function () {
        document.querySelector('.modal-animate').classList.add('scale-90', 'opacity-0');
        setTimeout(() => document.getElementById('modal').classList.add('hidden'), 200);
    };

   document.querySelectorAll('.tabBtn').forEach(btn => btn.addEventListener('click', () => {
    const tab = btn.dataset.tab;

    // Hide all tab contents
    document.querySelectorAll('.tabItem').forEach(item => item.classList.add('hidden'));
    document.querySelector(`.tabItem[data-tab="${tab}"]`).classList.remove('hidden');

    // Reset all tabs background (but keep text-white)
    document.querySelectorAll('.tabBtn').forEach(b => {
        b.classList.remove('bg-[#0f172a]');
        b.classList.add('bg-[#e85a3c]');
        // text-white stays
    });

    // Set clicked tab active background
    btn.classList.add('bg-[#0f172a]');
    btn.classList.remove('bg-[#e85a3c]');
}));

function submitPayment(type, amountInputId, proofInputId) {
        const team = window.currentPaidTeam;
        const amount = document.getElementById(amountInputId).value;
        const proofInput = document.getElementById(proofInputId);

        if (!amount) return alert('Please enter the payment amount.');
        if (proofInput.files.length === 0) return alert('Please upload proof of payment.');

        // Set hidden form values
        document.getElementById('payment_gateway').value = type.toLowerCase() === 'bank' ? 'bank' : type.toLowerCase();
        document.getElementById('payment_amount').value = amount;
        document.getElementById('travel_id').value = team.id;
        document.getElementById('game').value = team.game;

        // Copy file to hidden input
        const dt = new DataTransfer();
        dt.items.add(proofInput.files[0]);

        if (type.toLowerCase() === 'usdt') {
            document.getElementById('usdt_deposit_proof_input').files = dt.files;
        } else {
            document.getElementById('deposit_proof_input').files = dt.files;
        }

        // Submit form
        document.getElementById('travelPaymentForm').submit();
    }

    // USDT Submit
    document.getElementById('usdsSubmit').addEventListener('click', () => {
        submitPayment('usdt', 'usdsAmount', 'usdsProof');
    });

    // Bank Submit
    document.getElementById('bankSubmit').addEventListener('click', () => {
        submitPayment('bank', 'bankAmount', 'bankProof');
    });

    // Stripe
    function payWithStripe() {
        const team = window.currentPaidTeam;
        document.getElementById('payment_gateway').value = 'stripe';
        document.getElementById('payment_amount').value = team.entryFee;
        document.getElementById('travel_id').value = team.id;
        document.getElementById('game').value = team.game;
        document.getElementById('travelPaymentForm').submit();
    }

    // NowPayments
    function payWithNowPayments() {
        const team = window.currentPaidTeam;
        document.getElementById('payment_gateway').value = 'nowpayment';
        document.getElementById('payment_amount').value = team.entryFee;
        document.getElementById('travel_id').value = team.id;
        document.getElementById('game').value = team.game;
        document.getElementById('travelPaymentForm').submit();
    }
document.addEventListener('DOMContentLoaded', renderSports);

</script>
@endsection
