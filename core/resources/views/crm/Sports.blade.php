@extends('crm.layouts.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="bg-gray-50 p-8">
  <div class="max-w-7xl mx-auto space-y-12">

    <!-- HEADER + TABS -->
    <div class="flex flex-col md:flex-row justify-between items-end gap-6">

    <div>
      <span class="text-[#e85a3c] font-black text-xs uppercase tracking-[0.4em] mb-4 inline-block">
        ProFX Athletic Division
      </span>
      <h6 class="text-2xl md:text-5xl font-black text-[#0f172a] tracking-tighter leading-none">
        Choose Your Discipline
      </h6>
    </div>

      <!-- Tabs -->
      <div class="flex gap-2 p-2 bg-white rounded-3xl shadow-sm border border-slate-100">
        <button class="tab-btn px-4 sm:px-6 py-2 bg-[#e85a3c] text-white font-bold rounded-xl text-sm sm:text-base" onclick="filterSports('ALL', this)">ALL</button>
        @foreach($categories as $cat)
          <button class="tab-btn px-4 sm:px-6 py-2 bg-gray-200 text-gray-700 font-bold rounded-xl text-sm sm:text-base"
            onclick="filterSports('{{ strtoupper(trim($cat->title_en)) }}', this)">
            {{ strtoupper($cat->title_en) }}
          </button>
        @endforeach
      </div>
    </div>

    <!-- SPORTS GRID -->
    <div id="sportsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>

  </div>
</div>

<!-- TEAM SELECT MODAL -->
<div id="modal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-6">
  <div class="absolute inset-0 bg-black/80" onclick="closeModal()"></div>
  <div class="relative bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl">
    <button onclick="closeModal()" class="absolute top-6 right-6">
      <i data-lucide="x"></i>
    </button>
    <div id="modalContent"></div>
  </div>
</div>

<!-- PAYMENT MODAL -->
<div id="paymentModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-4 sm:p-6">
  <div class="absolute inset-0 bg-black/80 backdrop-blur-sm" onclick="closePaymentModal()"></div>
  <div class="relative bg-white w-full max-w-4xl rounded-3xl p-8 sm:p-10 shadow-2xl transform scale-90 opacity-0 transition-all duration-300 payment-modal-animate max-h-[90vh] overflow-y-auto">
    <button onclick="closePaymentModal()" class="absolute top-4 sm:top-6 right-4 sm:right-6 text-gray-500 hover:text-gray-800">
      <i data-lucide="x" class="w-6 h-6"></i>
    </button>

    <div class="flex justify-between items-center mb-6">
      <div>
        <h3 id="paymentPlanName" class="text-3xl sm:text-4xl font-extrabold text-[#0f172a]">Plan Name</h3>
        <div class="text-xl font-bold text-[#e85a3c] mt-1" id="paymentPlanAmount">$0</div>
      </div>
    </div>

    <div class="flex gap-2 mb-4 flex-wrap">
      <button class="payTabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#0f172a]" data-tab="stripe">Stripe</button>
      <button class="payTabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c]" data-tab="nowpayment">NowPayments</button>
      <button class="payTabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c]" data-tab="usdt">USDT</button>
      <button class="payTabBtn px-4 text-white py-2 rounded-full font-semibold transition hover:bg-[#0f172a] bg-[#e85a3c]" data-tab="bank">Bank</button>
    </div>

    <div class="payTabItem mt-6" data-tab="stripe">
      <p class="font-bold mb-4">Pay with Card (Stripe)</p>
      <button onclick="paySportsWithStripe()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Stripe</button>
    </div>

    <div class="payTabItem mt-6 hidden" data-tab="nowpayment">
      <p class="font-bold mb-4">Pay with Crypto (NowPayments)</p>
      <button onclick="paySportsWithNowPayments()" class="w-60 py-3 bg-[#e85a3c] text-white rounded-xl font-bold">Pay with Crypto</button>
    </div>

    <div class="payTabItem hidden" data-tab="usdt">
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
      <input type="text" id="sportsUsdtAmount" placeholder="Enter Amount" class="w-full p-3 border rounded-lg mt-2">
      <input type="file" id="sportsUsdtProof" class="w-full mt-3 border rounded-lg p-2">
      <div class="flex justify-center mt-5">
        <button id="sportsUsdtSubmit" class="w-60 py-3 bg-[#e85a3c] text-white rounded-2xl font-bold hover:bg-[#0f172a]">Submit Payment</button>
      </div>
    </div>

    <div class="payTabItem hidden" data-tab="bank">
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
          <input type="text" id="sportsBankAmount" placeholder="Enter Amount" class="w-full p-3 border rounded-lg mb-4">
          <label class="block text-sm font-semibold text-gray-600 mb-1">Upload Receipt</label>
          <input type="file" id="sportsBankProof" class="w-full border rounded-lg p-2 mb-6">
          <div class="flex justify-center">
            <button id="sportsBankSubmit" class="w-60 py-3 bg-[#e85a3c] text-white rounded-2xl font-bold hover:bg-[#0f172a]">Submit Payment</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<form id="sportsPaymentForm" method="POST" action="{{ route('paymentstore') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="payment_purpose" value="sports">
  <input type="hidden" name="payment_gateway" id="sports_payment_gateway">
  <input type="hidden" name="payment_amount" id="sports_payment_amount">
  <input type="hidden" name="game" id="sports_game">
  <input type="hidden" name="team_id" id="sports_team_id">
  <input type="file" name="deposit_proof" id="sports_deposit_proof_input" style="display:none;">
  <input type="file" name="usdt_deposit_proof" id="sports_usdt_deposit_proof_input" style="display:none;">
</form>

<script>
window.sports = @json($sportsItems);
window.teams = @json($teams);
window.activeCategory = 'ALL';
window.currentPaidTeam = null;
window.currentSportTitle = null;
window.normalizeCategory = function (value) {
    return String(value || '').trim().toUpperCase().replace(/\s+/g, '');
};

window.renderSports = function() {
    const grid = document.getElementById('sportsGrid');
    grid.innerHTML = '';
    const activeCategory = window.normalizeCategory(window.activeCategory);
    const filtered = (window.sports || []).filter(s => {
        const categories = (s.categories || []).map(c => window.normalizeCategory(c));
        return activeCategory === 'ALL' || categories.includes(activeCategory);
    });

    if (!filtered.length) {
        grid.innerHTML = `
        <div class="flex flex-col items-center justify-center p-12 bg-white rounded-2xl shadow-lg border border-gray-200 animate-fade-in">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-300 mb-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2h6v2m2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h3l2 3 2-3h3a2 2 0 012 2v10a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No Upcoming Sports Events</h3>
            <p class="text-gray-400 text-center max-w-xs">There are currently no upcoming sports events. Check back soon or explore other categories.</p>
        </div>`;
        return;
    }

    filtered.forEach(s => {
        const btnHtml = s.is_booked
            ? `<button class="w-full py-4 rounded-2xl bg-gray-400 text-white font-black uppercase tracking-widest cursor-not-allowed" disabled>Booked</button>`
            : `<button onclick="openModal('${s.title.replace(/'/g, "\\'")}')" class="w-full py-4 rounded-2xl bg-[#0f172a] text-white font-black uppercase tracking-widest hover:bg-[#e85a3c]">Book Session</button>`;

        grid.innerHTML += `
            <div class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-xl hover:shadow-2xl transition">
                <div class="h-56 relative">
                    <img src="{{ asset('') }}${s.image}" class="w-full h-full object-cover"/>
                </div>
                <div class="p-10">
                    <h3 class="text-3xl font-black text-[#0f172a] mb-4">${s.title}</h3>
                    <p class="text-slate-500 font-medium mb-10 text-sm">${s.excerpt || 'Professional training & tournament ready'}</p>
                    <div class="grid grid-cols-2 gap-4 mb-10">
                        <div class="bg-slate-50 p-4 rounded-3xl flex items-center gap-3">
                            <i data-lucide="users" class="text-indigo-600 w-5 h-5"></i>
                            <div>
                                <div class="text-[10px] font-black text-slate-400 uppercase">Game Type</div>
                                <div class="text-[10px] font-black">${(s.categories || []).join(', ')}</div>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-3xl flex items-center gap-3">
                            <i data-lucide="calendar" class="text-[#e85a3c] w-5 h-5"></i>
                            <div>
                                <div class="text-[10px] font-black text-slate-400 uppercase">DATE</div>
                                <div class="text-[10px] font-black">${s.date || ''}</div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">${btnHtml}</div>
                </div>
            </div>`;
    });

    lucide.createIcons();
};

window.filterSports = function(cat, el) {
    window.activeCategory = cat || 'ALL';
    document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('bg-[#e85a3c]', 'text-white');
        b.classList.add('bg-gray-200', 'text-gray-700');
    });
    el.classList.remove('bg-gray-200', 'text-gray-700');
    el.classList.add('bg-[#e85a3c]', 'text-white');
    window.renderSports();
};

window.openModal = function(sportTitle) {
    const BASE_URL = "{{ url('uploads/topics') }}";
    const sportTeams = window.teams[sportTitle] || [];
    let html = `<h3 class="text-3xl font-black text-center mb-6">Book ${sportTitle}</h3>`;

    if (!sportTeams.length) {
        html += '<p class="text-center text-gray-500">No teams available for this sport.</p>';
    } else {
        html += `<div id="teamGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-4">`;

        sportTeams.forEach(t => {
            const availableSlots = t.max_players - t.booked_players;
            const isFull = t.status === 'full' || availableSlots <= 0;
            const alreadyBooked = t.already_booked || false;
            const entryFee = parseFloat(t.entryFee || 0);

            html += `
            <div class="team-card relative cursor-pointer rounded-xl overflow-hidden border-2 border-transparent hover:border-[#e85a3c] transition-shadow shadow-sm hover:shadow-xl ${isFull || alreadyBooked ? 'opacity-60 cursor-not-allowed' : ''}"
                data-team-id="${t.id}"
                ${isFull || alreadyBooked ? 'data-disabled="true"' : ''}>

                <img src="${t.logo ? `${BASE_URL}/${t.logo}` : 'https://profxsportsclub.com/uploads/topics/17633877482094.png'}" class="w-full h-48 object-cover"/>
                <div class="absolute top-2 right-2 bg-yellow-500 text-black px-3 py-1 rounded-full text-sm font-bold shadow-lg z-10">$${entryFee}</div>
                <div class="absolute bottom-0 left-0 right-0 bg-black/80 p-4 text-white text-center">
                    <h4 class="font-bold text-lg mt-2">${t.name}</h4>
                    <div class="flex gap-2 text-sm font-semibold mt-5 justify-center">
                        <span class="text-white text-md">${t.sports}</span>
                        <span class="text-white text-md">${t.booked_players} / ${t.max_players}</span>
                    </div>
                    ${alreadyBooked
                        ? `<span class="inline-block mt-2 px-3 py-1 bg-gray-500 rounded-full text-xs font-bold">Booked</span>`
                        : isFull
                            ? `<span class="inline-block mt-2 px-3 py-1 bg-red-500 rounded-full text-xs font-bold">FULL</span>`
                            : `<span class="inline-block mt-2 px-3 py-1 bg-green-500 rounded-full text-sm font-bold">${availableSlots} Slots Left</span>`
                    }
                </div>
                <div class="absolute inset-0 bg-[#e85a3c]/30 opacity-0 team-selected flex items-center justify-center text-white text-3xl font-black">SELECTED</div>
            </div>`;
        });

        html += `</div>
            <input type="hidden" id="selectedTeamId" name="team_id" required>
            <button id="confirmBookingBtn" class="w-full bg-[#0f172a] text-white py-3 rounded-2xl font-black mt-4 hover:bg-[#e85a3c]">Continue</button>`;
    }

    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalContent').innerHTML = html;
    lucide.createIcons();

    document.querySelectorAll('.team-card').forEach(card => {
        if (card.dataset.disabled) return;
        card.addEventListener('click', function() {
            document.querySelectorAll('.team-card .team-selected').forEach(sel => sel.style.opacity = 0);
            this.querySelector('.team-selected').style.opacity = 1;
            document.getElementById('selectedTeamId').value = this.dataset.teamId;
        });
    });

    document.getElementById('confirmBookingBtn')?.addEventListener('click', function() {
        const teamId = document.getElementById('selectedTeamId').value;
        if (!teamId) {
            Swal.fire({ icon: 'warning', title: 'Oops!', text: 'Please select a team first!', confirmButtonColor: '#e85a3c' });
            return;
        }

        const selectedTeam = sportTeams.find(t => String(t.id) === String(teamId));
        if (!selectedTeam) {
            Swal.fire({ icon: 'error', title: 'Team not found', text: 'Please try again.', confirmButtonColor: '#e85a3c' });
            return;
        }

        const fee = parseFloat(selectedTeam.entryFee || 0);
        if (fee > 0) {
            closeModal();
            openPaymentModal(selectedTeam, sportTitle);
        } else {
            submitFreeSportsBooking(teamId, sportTitle);
        }
    });
};

window.submitFreeSportsBooking = function(teamId, sportTitle) {
    const formData = new FormData();
    formData.append('team_id', teamId);
    formData.append('sport_title', sportTitle);
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route("crmtemsbook") }}', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-10">
                    <div class="w-24 h-24 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i data-lucide="check" class="w-12 h-12"></i>
                    </div>
                    <h3 class="text-3xl font-black">Booking Confirmed!</h3>
                    <p class="mt-2 text-gray-500">${data.booking.sport_title} - Team booked successfully.</p>
                </div>`;
            const item = window.sports.find(s => s.title === sportTitle);
            if (item) item.is_booked = true;
            window.teams[sportTitle] = (window.teams[sportTitle] || []).map(t => {
                if (String(t.id) === String(teamId)) t.already_booked = true;
                return t;
            });
            window.renderSports();
            lucide.createIcons();
            setTimeout(window.closeModal, 2000);
        } else {
            Swal.fire({ icon: 'error', title: data.message || 'Booking failed!', confirmButtonColor: '#e85a3c' });
        }
    })
    .catch(() => Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong.', confirmButtonColor: '#e85a3c' }));
};

window.openPaymentModal = function(team, sportTitle) {
    window.currentPaidTeam = team;
    window.currentSportTitle = sportTitle;
    document.getElementById('paymentPlanName').innerText = `${sportTitle} - ${team.name}`;
    document.getElementById('paymentPlanAmount').innerText = `$${team.entryFee}`;
    document.getElementById('paymentModal').classList.remove('hidden');
    setTimeout(() => document.querySelector('.payment-modal-animate').classList.remove('scale-90', 'opacity-0'), 10);
};

window.closePaymentModal = function() {
    document.querySelector('.payment-modal-animate').classList.add('scale-90', 'opacity-0');
    setTimeout(() => document.getElementById('paymentModal').classList.add('hidden'), 200);
};

window.submitSportsPayment = function(type, amountInputId, proofInputId) {
    const team = window.currentPaidTeam;
    if (!team) return;

    const amount = document.getElementById(amountInputId).value;
    const proofInput = document.getElementById(proofInputId);

    if (!amount) return alert('Please enter the payment amount.');
    if (!proofInput || proofInput.files.length === 0) return alert('Please upload proof of payment.');

    document.getElementById('sports_payment_gateway').value = type;
    document.getElementById('sports_payment_amount').value = amount;
    document.getElementById('sports_team_id').value = team.id;
    document.getElementById('sports_game').value = team.game || window.currentSportTitle || '';

    const dt = new DataTransfer();
    dt.items.add(proofInput.files[0]);
    if (type === 'usdt') {
        document.getElementById('sports_usdt_deposit_proof_input').files = dt.files;
    } else {
        document.getElementById('sports_deposit_proof_input').files = dt.files;
    }

    document.getElementById('sportsPaymentForm').submit();
};

window.paySportsWithStripe = function() {
    const team = window.currentPaidTeam;
    if (!team) return;
    document.getElementById('sports_payment_gateway').value = 'stripe';
    document.getElementById('sports_payment_amount').value = team.entryFee;
    document.getElementById('sports_team_id').value = team.id;
    document.getElementById('sports_game').value = team.game || window.currentSportTitle || '';
    document.getElementById('sportsPaymentForm').submit();
};

window.paySportsWithNowPayments = function() {
    const team = window.currentPaidTeam;
    if (!team) return;
    document.getElementById('sports_payment_gateway').value = 'nowpayment';
    document.getElementById('sports_payment_amount').value = team.entryFee;
    document.getElementById('sports_team_id').value = team.id;
    document.getElementById('sports_game').value = team.game || window.currentSportTitle || '';
    document.getElementById('sportsPaymentForm').submit();
};

window.closeModal = function() {
    document.getElementById('modal').classList.add('hidden');
};

document.querySelectorAll('.payTabBtn').forEach(btn => {
    btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;
        document.querySelectorAll('.payTabItem').forEach(item => item.classList.add('hidden'));
        document.querySelector(`.payTabItem[data-tab="${tab}"]`).classList.remove('hidden');

        document.querySelectorAll('.payTabBtn').forEach(b => {
            b.classList.remove('bg-[#0f172a]');
            b.classList.add('bg-[#e85a3c]');
        });
        btn.classList.remove('bg-[#e85a3c]');
        btn.classList.add('bg-[#0f172a]');
    });
});

document.getElementById('sportsUsdtSubmit').addEventListener('click', () => {
    window.submitSportsPayment('usdt', 'sportsUsdtAmount', 'sportsUsdtProof');
});

document.getElementById('sportsBankSubmit').addEventListener('click', () => {
    window.submitSportsPayment('bank_deposit', 'sportsBankAmount', 'sportsBankProof');
});

document.addEventListener('DOMContentLoaded', window.renderSports);
</script>

<style>
.team-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.team-card:hover {
    transform: translateY(-5px);
}
.team-selected {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    pointer-events: none;
    font-weight: 900;
}

</style>

@endsection
