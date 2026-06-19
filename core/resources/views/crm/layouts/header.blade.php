@php
    $user = Auth::user();
@endphp

<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<style>
    .menu-icon { font-size: 38px; cursor: pointer; }
    .h1-6 { height: 2.5rem; background-color: #011C32; border-radius: 10px; }
</style>

<!-- HEADER -->
<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 px-4 sm:px-6 md:px-8 lg:px-12 py-4 flex justify-between items-center">
    
    <!-- Mobile: Hamburger + Logo -->
    <div class="flex items-center gap-4 lg:hidden">
        <button onclick="toggleSidebar()" class="p-2 bg-slate-50 rounded-xl">
            <span class="material-icons-round menu-icon">menu</span>
        </button>
        <!-- <img src="{{ asset('assets/dashboard/images/logo-white.png') }}" alt="ProFX" class="h1-6"> -->
    </div>

    <!-- Desktop/Tablet: Live Info -->
    <div class="hidden md:flex items-center gap-3 text-slate-400">
        <div class="w-2 h-2 rounded-full bg-green-500"></div>
        <span class="text-[10px] font-black uppercase tracking-[0.2em]"> PROFXSPORTSCLUB</span>
    </div>

    <!-- Right Section: Social + Share + Notifications -->
    <div class="flex items-center gap-2 sm:gap-3">
        <!-- Share -->
        <button onclick="showShare()" class="p-2 sm:p-3 bg-white rounded-2xl border text-[#e85a3c] border-slate-100 hover:text-[#0f172a] hover:bg-slate-50 transition">
            <i data-lucide="share-2" class="w-5 h-5 sm:w-6 sm:h-6 text-[#e85a3c]"></i>
        </button>

        <!-- Social Links -->
        <a href="https://www.facebook.com/profxsportsclub" target="_blank" class="p-2 sm:p-3 bg-white text-[#e85a3c] rounded-2xl border border-slate-100 hover:text-[#0f172a] hover:bg-slate-50 transition">
            <i data-lucide="facebook" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </a>

        <a href="https://x.com/profxsportsclub" target="_blank" class="p-2 sm:p-3 bg-white text-[#e85a3c] rounded-2xl border border-slate-100 hover:text-[#0f172a] hover:bg-slate-50 transition flex items-center justify-center">
            <svg viewBox="0 0 1200 1227" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5 stroke-current" fill="none" stroke-width="80">
                <path d="M714.163 519.284L1160.89 0H1055.03L667.137 450.887L357.328 0H0L468.492 681.821L0 1226.37H105.866L515.491 750.218L842.672 1226.37H1200L714.137 519.284H714.163ZM569.165 687.828L521.697 619.934L144.011 79.6944H306.615L611.412 515.685L658.88 583.579L1055.08 1150.3H892.476L569.165 687.854V687.828Z"/>
            </svg>
        </a>

        <a href="https://www.instagram.com/profxsportsclub" target="_blank" class="p-2 sm:p-3 bg-white text-[#e85a3c] rounded-2xl border border-slate-100 hover:text-[#0f172a] hover:bg-slate-50 transition">
            <i data-lucide="instagram" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </a>

        <a href="https://www.linkedin.com/company/profxsportsclub" target="_blank" class="p-2 sm:p-3 bg-white text-[#e85a3c] rounded-2xl border border-slate-100 hover:text-[#0f172a] hover:bg-slate-50 transition">
            <i data-lucide="linkedin" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </a>

        <!-- Notifications
        <button onclick="showNotifications()" class="p-2 sm:p-3 bg-white text-[#e85a3c] rounded-2xl border border-slate-100 relative hover:bg-slate-50 transition">
            <i data-lucide="bell" class="w-5 h-5 sm:w-6 sm:h-6"></i>
            <span class="absolute top-1.5 sm:top-2 right-1.5 sm:right-2 w-3 h-3 sm:w-4 sm:h-4 bg-[#0f172a] text-white rounded-full text-[6px] sm:text-[8px] flex items-center justify-center font-black border-2 border-white">2</span>
        </button> -->
    </div>
</header>

<!-- MODALS (Notifications + Share) -->
<div id="notifications-modal" class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm z-[100] hidden justify-end">
    <div class="relative w-full max-w-md bg-white h-screen shadow-2xl p-6 sm:p-8 flex flex-col">
        <div class="flex justify-between items-center mb-6 sm:mb-10">
            <h3 class="text-2xl sm:text-3xl font-black text-[#0f172a] tracking-tighter">Club Alerts</h3>
            <button onclick="hideNotifications()" class="p-2 hover:bg-slate-50 rounded-full transition">✖️</button>
        </div>
        <div class="flex-1 overflow-y-auto space-y-4 pr-2 scrollbar-hide">
            <div class="p-4 sm:p-6 rounded-[2rem] border bg-orange-50/50 border-orange-100 shadow-sm">Match tomorrow at 6 PM</div>
            <div class="p-4 sm:p-6 rounded-[2rem] border bg-orange-50/50 border-orange-100 shadow-sm">New coaching session announced</div>
        </div>
        <button onclick="hideNotifications()" class="mt-4 sm:mt-8 w-full py-3 sm:py-5 rounded-2xl bg-[#0f172a] text-white font-black text-xs sm:text-sm uppercase tracking-widest shadow-xl">Mark All Read</button>
    </div>
</div>

<!-- Share Modal -->
<div id="share-modal" class="fixed inset-0 bg-[#0f172a]/80 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4 sm:p-6">
    <div class="relative bg-white w-full max-w-md rounded-[3rem] p-6 sm:p-10 shadow-2xl">
        <div class="flex justify-between items-center mb-6 sm:mb-10">
            <h3 class="text-2xl sm:text-3xl font-black text-[#0f172a] tracking-tighter">Share Profile</h3>
            <button onclick="hideShare()" class="p-2 hover:bg-slate-50 rounded-full transition">✖️</button>
        </div>
        <div class="space-y-6 sm:space-y-8">
            <!-- User Info -->
            <div class="p-4 sm:p-6 bg-slate-50 rounded-[2rem] border border-slate-100 text-center">
                <img src="{{ URL::to($user->photo ?? 'https://profxleague.com/assets/frontend/img/user.png') }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-2 sm:mb-4 border-4 border-white object-cover shadow-lg">
                <p class="font-black text-[#0f172a] text-base sm:text-lg">{{ $user->name }}</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $user->email }}</p>
            </div>

            <!-- Buttons -->
            <div class="grid grid-cols-2 gap-2 sm:gap-4">
                <button id="copyProfileLink" class="bg-slate-50 p-3 sm:p-4 rounded-2xl flex flex-col items-center gap-1 sm:gap-2 hover:bg-orange-50 transition border border-transparent hover:border-orange-100">
                   <i data-lucide="globe" class="w-5 h-5 sm:w-6 sm:h-6 text-[#e85a3c] hover:text-[#0f172a]"></i>
                   <span class="text-[9px] sm:text-[10px] font-[#e85a3c] hover:text-[#0f172a] uppercase">Copy URL</span>
                </button>

                <button id="generateQRCode" class="bg-slate-50 p-3 sm:p-4 rounded-2xl flex flex-col items-center gap-1 sm:gap-2 hover:bg-blue-50 transition border border-transparent hover:border-blue-100">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6 text-[#e85a3c] hover:text-[#0f172a]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="4" height="4"/>
                        <rect x="17" y="3" width="4" height="4"/>
                        <rect x="3" y="17" width="4" height="4"/>
                        <rect x="10" y="10" width="4" height="4"/>
                        <rect x="17" y="17" width="4" height="4"/>
                        <line x1="10" y1="3" x2="10" y2="7"/>
                        <line x1="3" y1="10" x2="7" y2="10"/>
                        <line x1="17" y1="10" x2="21" y2="10"/>
                        <line x1="10" y1="17" x2="10" y2="21"/>
                   </svg>
                   <span class="text-[9px] sm:text-[10px] font-[#e85a3c] hover:text-[#0f172a] uppercase">QR Code</span>
                </button>
            </div>

            <div id="qrcodeContainer" class="mt-2 sm:mt-4 text-center hidden">
                <div id="qrcode" class="flex justify-center"></div>
                <p class="text-[8px] sm:text-xs mt-1">Scan to open profile</p>
            </div>
        </div>
    </div>
</div>

<!-- QRCode Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    // Sidebar toggle (mobile)
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar'); 
        sidebar.classList.toggle('-translate-x-full');
    }

    // Share modal
    const shareModal = document.getElementById('share-modal');
    function showShare() { shareModal.classList.remove('hidden'); }
    function hideShare() { 
        shareModal.classList.add('hidden'); 
        document.getElementById('qrcodeContainer').classList.add('hidden');
        document.getElementById('qrcode').innerHTML = "";
    }

    // Notifications modal
    const notificationsModal = document.getElementById('notifications-modal');
    function showNotifications() { notificationsModal.classList.remove('hidden'); }
    function hideNotifications() { notificationsModal.classList.add('hidden'); }

    document.addEventListener('DOMContentLoaded', function() {
        const userProfileURL = "{{ route('crmaccount', ['id' => $user->id]) }}";

        document.getElementById('copyProfileLink').addEventListener('click', function() {
            navigator.clipboard.writeText(userProfileURL).then(() => {
                Swal.fire({ icon: 'success', title: 'Link Copied!', text: 'Profile URL copied.', showConfirmButton: false, timer: 1500 });
            }).catch(() => {
                Swal.fire({ icon: 'error', title: 'Failed!', text: 'Unable to copy link.' });
            });
        });

        document.getElementById('generateQRCode').addEventListener('click', function() {
            const container = document.getElementById('qrcodeContainer');
            container.classList.toggle('hidden');
            if(!container.classList.contains('hidden')){
                document.getElementById('qrcode').innerHTML = "";
                new QRCode(document.getElementById("qrcode"), { text: userProfileURL, width: 160, height: 160, colorDark : "#0f172a", colorLight : "#ffffff", correctLevel : QRCode.CorrectLevel.H });
                container.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>
