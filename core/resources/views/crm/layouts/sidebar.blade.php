  @php
        $user = Auth::user();
    @endphp
 
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $errors->first() }}'
        });
    </script>
@endif
 <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r z-[51] border-slate-100 p-6 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <!-- Logo -->
     <div class="flex items-center gap-3 mb-10 cursor-pointer relative" onclick="setActiveView('dashboard')">
        <img src="{{ asset('assets/frontend/images/logo-white.png') }}" 
             alt="ProFX" 
             class="w-24 lg:w-auto">
<button id="close-sidebar" 
                class="absolute top-2 right-2 text-4xl font-extrabold text-slate-700 hover:text-red-500 lg:hidden z-50">
            &times;
        </button><!-- <div>
        <h1 class="text-xl font-black text-[#0f172a] tracking-tighter">PROFX</h1>
        <p class="text-[10px] font-black text-[#e85a3c] uppercase tracking-tighter">Sports Club</p>
      </div> -->
    </div>

    <!-- Nav Items -->
 <div class="space-y-2 flex-1 overflow-y-auto scrollbar-hide">
    <a href="{{ route('crmdashboard') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmdashboard') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
         <i data-lucide="home" class="w-5 h-5"></i>
    <span>Dashboard</span>
    </a>

    <!--<a href="{{ route('crmevent') }}" -->
    <!--   class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest -->
    <!--          {{ request()->routeIs('crmevent') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">-->
    <!--       <i data-lucide="calendar" class="w-5 h-5"></i>-->
    <!--<span>Club Events</span>-->
    <!--</a>-->

    <a href="{{ route('crmsports') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmports') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
      <i data-lucide="target" class="w-5 h-5"></i>
    <span>Sports Directory</span>
    </a>
      <a href="{{ route('crmtravel') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmtravel') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
           <i data-lucide="tram-front" class="w-5 h-5"></i>
    <span>Travel Directory</span>
    </a>

        <a href="{{ route('crmnetwork') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmnetwork') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
           <i data-lucide="calendar" class="w-5 h-5"></i>
    <span>Network Events</span>
    </a>
{{-- Only show for CORPORATE users --}}
@if($user && $user->role === 'corporate')
    <a href="{{ route('crmtems') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmtems') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
        <i data-lucide="users" class="w-5 h-5"></i>
        <span>Official Teams</span>
    </a>
@endif

    <a href="{{ route('crmtransaction') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmtransaction') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
     <i data-lucide="credit-card" class="w-5 h-5"></i>
    <span>Transaction</span>
    </a>

    <a href="{{ route('crmaccount') }}" 
       class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
              {{ request()->routeIs('crmaccount') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
     <i data-lucide="settings" class="w-5 h-5"></i>
    <span>Account Hub</span>
    </a>


    <div class="mt-8 pt-8 border-t border-slate-50" id="corporate-hub">
        <a href="{{ route('crmcorporate') }}" 
           class="nav-item flex items-center gap-3 w-full px-4 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest 
                  {{ request()->routeIs('crmcorporate') ? 'bg-[#e85a3c] text-white shadow-xl shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-[#0f172a]' }}">
            <i data-lucide="shield" class="w-5 h-5"></i>
            <span>Corporate Hub</span>
        </a>
    </div>


</div>


    <!-- User Panel -->
    <div class="mt-auto bg-slate-50 p-6 rounded-[2rem] border border-slate-100">
      <div class="flex items-center gap-3 mb-4">
        <img src="{{ $user->photo ? asset($user->photo) : asset('assets/frontend/images/user.png') }}" onerror="this.src='{{ asset('assets/frontend/images/user.png') }}'" alt="User" class="w-10 h-10 rounded-full border-2 border-white shadow-md">
        <div class="min-w-0">
          <p class="font-black text-sm text-[#0f172a] truncate">{{ $user->name }}</p>
          <!-- <p class="text-[10px] font-bold text-[#e85a3c] uppercase">Level 5 Pro</p> -->
        </div>
      </div>
 
         <form method="POST" action="{{ route('logout') }}">
                                @csrf
                               
                                    <button type="submit" class="w-full flex items-center justify-between text-slate-400 hover:text-red-500 transition font-black text-[10px] uppercase tracking-widest">
       <span>Logout</span>
    <i data-lucide="log-out" class="w-4 h-4"></i>
      </button>
                            </form>
    </div>
  </aside>
  
  <script>
    const sidebar = document.getElementById('sidebar');
    const closeBtn = document.getElementById('close-sidebar');

    closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
    });

    // Optional: add toggle for mobile menu
    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
    }
</script>

<style>
    /* Prefixed styles */
    .profx-aside {
        z-index: 51; /* ensures it's above other elements */
    }

    /* Optional: close button styling */
    #close-sidebar {
        background: transparent;
        border: none;
        cursor: pointer;
    }
</style>


  