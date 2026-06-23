@extends('crm.layouts.master')
  @php
        $user = Auth::user();
          $shareUrl = url('/profile/'.$user->id);
  $shareText = urlencode("Check out my ProFX profile!");
     $Event = Helper::Topics(37);
    @endphp
@section('content')




    <!-- Dashboard -->
    <div class="bg-slate-50">
        <!-- Profile & Stats -->
   <div class="max-w-7xl mx-auto p-6 space-y-10">

  <!-- PROFILE CARD -->
  <div class="bg-white rounded-[3rem] p-10 shadow-2xl border border-slate-100 relative overflow-hidden">

    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-orange-500/10 to-indigo-500/10 rounded-full -mr-32 -mt-32 blur-[120px]"></div>

    <div class="relative z-10 flex flex-col lg:flex-row gap-10 items-center lg:items-start">

      <!-- AVATAR -->
      <div class="relative group">
        <div class="w-44 h-44 rounded-full overflow-hidden border-8 border-white shadow-2xl">
          <img src="{{ $user->photo ? asset($user->photo) : asset('assets/frontend/images/user.png') }}" onerror="this.src='{{ asset('assets/frontend/images/user.png') }}'" class="w-full h-full object-cover">
        </div>
        <!-- <div class="absolute bottom-4 right-4 bg-[#e85a3c] p-3 rounded-full ring-4 ring-white text-white">
          <i data-lucide="zap"></i>
        </div> -->
      </div>

      <!-- USER INFO -->
      <div class="flex-1 text-center lg:text-left">
        <div class="flex flex-col lg:flex-row gap-4 items-center lg:items-end mb-4">
          <h2 class="text-5xl font-black text-[#0f172a]">{{ $user->name }}</h2>
          <!-- <div class="flex gap-2">
            <span class="bg-orange-50 text-[#e85a3c] px-4 py-1 rounded-xl text-[10px] font-black uppercase">Level 42</span>
            <span class="bg-indigo-50 text-indigo-600 px-4 py-1 rounded-xl text-[10px] font-black uppercase">PLAYER</span>
          </div> -->
        </div>

        <p class="text-slate-500 font-bold text-lg mb-8">{{ $user->email }}</p>

        <div class="flex gap-4 justify-center lg:justify-start">
         <button onclick="openEditProfileModal()"
 class="bg-[#e85a3c] text-white px-8 py-4 rounded-2xl font-black shadow-lg">
 Edit Profile
</button>
          <button onclick="openShareProfile()"
              class="bg-[#0f172a] text-white px-8 py-4 rounded-2xl font-black shadow hover:bg-slate-800">
              Share Profile
            </button>
        </div>
      </div>

      <!-- MEMBERSHIP -->
      <div class="hidden xl:block">
        <div class="text-[10px] uppercase font-black tracking-[0.3em] text-slate-400 mb-4">
          Membership Tier
        </div>
        <div class="flex items-center gap-4 bg-slate-50 p-5 rounded-3xl border">
          <div class="p-3 bg-[#e85a3c] rounded-2xl text-white">
            <i data-lucide="star" class="fill-white"></i>
          </div>
          <div>
            <div class="font-black text-xl">Elite Hub</div>
            <div class="text-xs font-bold text-slate-400">Valid until Dec 2026</div>
          </div>
        </div>
      </div>
    </div>

    <!-- STATS -->
    <div class="mt-16 relative z-10 space-y-8">
      <div class="flex items-center justify-between px-2">
        <h3 class="text-2xl md:text-3xl font-black text-[#0f172a]">Booking & Transaction Overview</h3>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-[#0f172a] to-slate-800 rounded-[2.5rem] p-8 text-white shadow-2xl">
          <p class="text-[10px] uppercase font-black tracking-widest text-slate-300 mb-4">Sports Booking</p>
          <p class="text-5xl font-black">{{ $sportsBookingCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-slate-300 font-bold">Total slots booked in sports</p> -->
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100">
          <p class="text-[10px] uppercase font-black tracking-widest text-slate-400 mb-4">Travel Booking</p>
          <p class="text-5xl font-black text-[#0f172a]">{{ $travelBookingCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-slate-500 font-bold">Your travel bookings count</p> -->
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100">
          <p class="text-[10px] uppercase font-black tracking-widest text-slate-400 mb-4">Network Booking</p>
          <p class="text-5xl font-black text-[#0f172a]">{{ $networkBookingCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-slate-500 font-bold">Your network bookings count</p> -->
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-emerald-50 rounded-[2.5rem] p-8 border border-emerald-100 shadow-sm">
          <p class="text-[10px] uppercase font-black tracking-widest text-emerald-600 mb-4">Approved Transactions</p>
          <p class="text-5xl font-black text-emerald-700">{{ $approvedTransactionCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-emerald-600 font-bold">Payments approved by system/admin</p> -->
        </div>

        <div class="bg-rose-50 rounded-[2.5rem] p-8 border border-rose-100 shadow-sm">
          <p class="text-[10px] uppercase font-black tracking-widest text-rose-600 mb-4">Rejected Transactions</p>
          <p class="text-5xl font-black text-rose-700">{{ $rejectedTransactionCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-rose-600 font-bold">Payments rejected by admin</p> -->
        </div>

        <div class="bg-indigo-50 rounded-[2.5rem] p-8 border border-indigo-100 shadow-sm">
          <p class="text-[10px] uppercase font-black tracking-widest text-indigo-600 mb-4">Success Transactions</p>
          <p class="text-5xl font-black text-indigo-700">{{ $successTransactionCount ?? 0 }}</p>
          <!-- <p class="text-xs mt-2 text-indigo-600 font-bold">Transactions marked as success</p> -->
        </div>
      </div>

      @if(Auth::user() && Auth::user()->role === 'corporate')
      <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
          <h3 class="text-2xl font-black text-[#0f172a]">Corporate Subscription</h3>
          <a href="{{ route('crmcorporate') }}" class="px-6 py-3 rounded-2xl bg-[#0f172a] text-white font-black text-xs uppercase tracking-widest hover:bg-[#e85a3c] transition">
            Manage Plans
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
            <div class="text-[10px] uppercase font-black tracking-widest text-slate-400 mb-2">Latest Plan</div>
            <div class="text-2xl font-black text-[#0f172a]">{{ optional($latestCorporatePlan)->plan_name ?? 'No Plan' }}</div>
            <div class="text-sm text-slate-500 mt-2">Method: {{ optional($latestCorporatePlan)->methods ?? '-' }}</div>
          </div>
          <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
            <div class="text-[10px] uppercase font-black tracking-widest text-slate-400 mb-2">Total Corporate Plans</div>
            <div class="text-4xl font-black text-[#e85a3c]">{{ ($corporatePlans ?? collect())->count() }}</div>
          </div>
        </div>

        @if(($corporatePlans ?? collect())->isNotEmpty())
          <div class="mt-6 space-y-3">
            @foreach(($corporatePlans ?? collect())->take(3) as $plan)
              <div class="border rounded-2xl p-4 flex items-center justify-between">
                <div>
                  <div class="font-black text-[#0f172a]">{{ $plan->plan_name }}</div>
                  <div class="text-xs text-slate-500">{{ $plan->methods }}</div>
                </div>
                <div class="text-right">
                  <div class="font-black text-[#e85a3c]">${{ number_format((float)$plan->amount, 2) }}</div>
                  <div class="text-xs text-slate-400">{{ optional($plan->created_at)->format('d M Y') }}</div>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </div>
      @endif
    </div>
  </div>

  <!-- LOWER GRID -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

    <!-- MATCHES -->
    <div class="lg:col-span-2 space-y-6">
      <div class="flex justify-between items-center px-2">
        <h3 class="text-3xl font-black">ProfxSportsClub Recent Matches</h3>
        <!--<span class="text-[#e85a3c] font-black text-xs uppercase">Full History</span>-->
      </div>
    <div class="grid sm:grid-cols-3 gap-6">
    @foreach ($Event->take(-3) as $event) {{-- Take the last 3 items --}}
        @php
            $buttonlink = '';
            if (!empty($event->fields)) {
                foreach ($event->fields as $field) {
                    if ($field['field_id'] == 56) {
                        $buttonlink = $field['field_value'];
                    }
                }
            }

            $image = !empty($event->photo_file)
                ? asset('uploads/topics/' . $event->photo_file)
                : asset('assets/frontend/images/resource/event-1.jpg');
        @endphp
 <a href="{{ route('crmsports', ['id' => $event->id]) }}" class="block">
        <div class="relative rounded-[2.5rem] overflow-hidden shadow-xl aspect-[3/4]">
            <img src="{{ $image }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80"></div>
            <div class="absolute bottom-6 left-6 right-6 text-white">
                <h4 class="font-black text-2xl">{{ $event->title_en }}</h4>
                <p class="text-[#e85a3c] text-xs uppercase font-black">{{ $event->date }}</p>
            </div>
        </div>
        </a>
    @endforeach
</div>

   
    </div>

    <!-- FEED -->
    <div class="space-y-6">
      <h3 class="text-3xl font-black px-2">Club Feed</h3>

      <div class="bg-white rounded-[2.5rem] p-8 shadow-xl space-y-6">
        <div class="flex gap-4">
          <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center">
            <i data-lucide="zap" class="text-amber-500"></i>
          </div>
          <div>
            <p class="font-black">New High Score</p>
            <p class="text-xs text-slate-500">5 match win streak</p>
          </div>
        </div>

        <div class="flex gap-4">
          <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center">
            <i data-lucide="calendar" class="text-[#e85a3c]"></i>
          </div>
          <div>
            <p class="font-black">Upcoming Match</p>
            <p class="text-xs text-slate-500">Cricket Finals 5 PM</p>
          </div>
        </div>

        <a href="{{ route('crmsports') }}" class="w-full bg-[#0f172a] text-white p-6 rounded-[2rem] flex justify-between items-center hover:bg-[#e85a3c] transition">
          <div>
            <p class="font-black text-lg">Next Tournament</p>
            <p class="text-xs opacity-60">Join summer showdown</p>
          </div>
          <div class="bg-white/20 p-3 rounded-full">
            <i data-lucide="play" class="text-white"></i>
          </div>
</a>
      </div>
    </div>
  </div>

</div>

<div id="editProfileModal" class="fixed inset-0 bg-black/70 hidden z-50 flex items-center justify-center">
  <div class="bg-white rounded-[2.5rem] w-full max-w-xl p-8 relative animate-scaleIn">

    <button onclick="closeEditProfileModal()"
     class="absolute top-6 right-6 text-gray-400 hover:text-black">
      ✕
    </button>

    <h3 class="text-3xl font-black mb-6 text-center">Edit Profile</h3>

 <form id="profileForm" enctype="multipart/form-data">
    @csrf
 <label class="text-xs font-black uppercase text-slate-400"> Name</label>
      <input type="text" name="name" placeholder="First Name"
       value="{{ auth()->user()->name }}"
       class="w-full p-4 mt-3 rounded-xl border font-bold">
      <p id="err-name" class="text-red-500 text-xs font-bold mt-1 hidden"></p>
 <label class="text-xs font-black uppercase text-slate-400 mt-3 block"> Last Name</label>
      <input type="text" name="lastname" placeholder="Last Name"
       value="{{ auth()->user()->lastname }}"
       class="w-full p-4 mt-3 rounded-xl border font-bold">
      <p id="err-lastname" class="text-red-500 text-xs font-bold mt-1 hidden"></p>
 <label class="text-xs font-black uppercase text-slate-400 mt-3 block"> Phone</label>
      <input type="text" name="phone" placeholder="Phone"
       value="{{ auth()->user()->phone }}"
       class="w-full p-4 mt-3 rounded-xl border font-bold">
      <p id="err-phone" class="text-red-500 text-xs font-bold mt-1 hidden"></p>
 <label class="text-xs font-black uppercase text-slate-400 mt-3 block">Country</label>
      <input type="text" name="nationalities" placeholder="Nationality"
       value="{{ auth()->user()->nationalities }}"
       class="w-full p-4 mt-3 rounded-xl border font-bold">
      <p id="err-nationalities" class="text-red-500 text-xs font-bold mt-1 hidden"></p>
 <label class="text-xs font-black uppercase text-slate-400 mt-3 block">Profile Image</label>
      <input type="file" name="photo"
       class="w-full p-3 mt-3 border rounded-xl file:mr-4 file:py-2 file:px-4
            file:border-0
            file:text-sm file:font-semibold
            file:bg-dark-50 file:text-white-700
            hover:file:bg-blue-100 border">
      <p id="err-photo" class="text-red-500 text-xs font-bold mt-1 hidden"></p>
 <div class="flex justify-center">
      <button type="submit"
   class="w-60 py-3 bg-[#e85a3c] mt-5 text-white rounded-2xl font-bold hover:bg-[#0f172a] transition">
       Updated
      </button>
      </div>
    </form>

    <p id="profileMsg" class="text-center mt-4 font-bold hidden"></p>

  </div>
</div>


<!-- ===================== SHARE PROFILE MODAL ===================== -->
<div id="shareProfileModal" class="fixed inset-0 hidden z-50 flex items-center justify-center p-6">
  <div class="absolute inset-0 bg-black/70" onclick="closeShareProfile()"></div>

  <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl animate-scale relative">
    <button onclick="closeShareProfile()" class="absolute top-5 right-5 text-gray-500">✕</button>

    <h3 class="text-3xl font-black text-center mb-6">Share Profile</h3>

    <div class="grid grid-cols-2 gap-4">

      <a target="_blank"
         href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}"
         class="share-card bg-green-500">
        <i data-lucide="message-circle"></i> WhatsApp
      </a>

      <a target="_blank"
         href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}"
         class="share-card bg-blue-600">
        <i data-lucide="linkedin"></i> LinkedIn
      </a>

      <a target="_blank"
         href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
         class="share-card bg-blue-500">
        <i data-lucide="facebook"></i> Facebook
      </a>

      <a target="_blank"
         href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
         class="share-card bg-black">
        <i data-lucide="twitter"></i> X
      </a>

    </div>
  </div>
</div>
    </div>
<!-- ===================== JS ===================== -->
<script>
function openEditProfileModal(){
  document.getElementById('editProfileModal').classList.remove('hidden');
}

function closeEditProfileModal(){
  document.getElementById('editProfileModal').classList.add('hidden');
}

document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const fieldIds = ['name', 'lastname', 'phone', 'nationalities', 'photo'];
    fieldIds.forEach(id => {
        const el = document.getElementById('err-' + id);
        if (el) { el.textContent = ''; el.classList.add('hidden'); }
    });
    const profileMsg = document.getElementById('profileMsg');
    profileMsg.textContent = '';
    profileMsg.classList.add('hidden');

    const formData = new FormData(this);

    fetch("{{ route('user.profile.update') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated!',
                text: data.message,
                showConfirmButton: false,
                timer: 2000
            }).then(() => location.reload());
        } else if (data.errors) {
            Object.entries(data.errors).forEach(([field, messages]) => {
                const el = document.getElementById('err-' + field);
                if (el) {
                    el.textContent = messages[0];
                    el.classList.remove('hidden');
                }
            });
        } else {
            profileMsg.textContent = data.message ?? 'Something went wrong. Please try again.';
            profileMsg.classList.remove('hidden');
            profileMsg.style.color = '#e85a3c';
        }
    })
    .catch(() => {
        profileMsg.textContent = 'Network error. Please check your connection and try again.';
        profileMsg.classList.remove('hidden');
        profileMsg.style.color = '#e85a3c';
    });
});

function openShareProfile() {
  document.getElementById('shareProfileModal').classList.remove('hidden');
}
function closeShareProfile() {
  document.getElementById('shareProfileModal').classList.add('hidden');
}
</script>

<!-- ===================== STYLES ===================== -->
<style>
.animate-scale {
  animation: scaleIn .25s ease;
}
@keyframes scaleIn {
  from { transform: scale(.9); opacity: 0 }
  to { transform: scale(1); opacity: 1 }
}
.share-card {
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
  gap:8px;
  color:#fff;
  padding:24px;
  border-radius:20px;
  font-weight:900;
  font-size:14px;
  transition:.25s;
}
.share-card:hover { transform: scale(1.05); }
@keyframes scaleIn {
  from { transform: scale(.9); opacity:0 }
  to { transform: scale(1); opacity:1 }
}
.animate-scaleIn {
  animation: scaleIn .25s ease-out;
}
</style>

@endsection
