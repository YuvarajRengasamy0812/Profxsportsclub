@extends('crm.layouts.master')

@section('content')
    <!-- Main Content Container -->
<div class="bg-gray-50 p-8">
   <div class="space-y-10 animate-in fade-in slide-in-from-bottom-8 duration-1000">

    <div class="text-center space-y-4 max-w-2xl mx-auto">
      <div class="inline-flex items-center gap-2 bg-amber-100 text-amber-600 px-6 py-2 rounded-full font-black text-xs uppercase tracking-[0.3em] shadow-sm">
        <i data-lucide="trophy" class="w-4 h-4 fill-current"></i>
        Hall of Fame
      </div>

      <h2 class="text-5xl md:text-6xl font-black text-[#0f172a] tracking-tighter">
        Season Leaders
      </h2>

      <p class="text-slate-500 font-bold">
        Compete with the best at ProFX Sports Club. Your performance defines your legacy.
      </p>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

      <!-- LEADERBOARD LIST -->
      <div class="lg:col-span-3 space-y-4">

        <!-- USER 1 (YOU) -->
        <div class="group flex items-center justify-between p-6 rounded-[2.5rem] bg-[#0f172a] border border-slate-800 shadow-2xl ring-4 ring-orange-100">

          <div class="flex items-center gap-8">
            <div class="w-12 text-center">
              <i data-lucide="crown" class="text-amber-400 mx-auto w-6 h-6"></i>
            </div>

            <div class="flex items-center gap-5">
              <img src="https://i.pravatar.cc/100?img=1" class="w-16 h-16 rounded-2xl border-4 border-white shadow-lg" />
              <div>
                <h4 class="text-xl font-black text-white">
                  Alex Johnson
                  <span class="text-[10px] text-[#e85a3c] ml-2 font-black uppercase tracking-widest">(YOU)</span>
                </h4>
                <div class="flex items-center gap-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                  <span>12,500 XP</span>
                  <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                  <span class="text-indigo-400">32 Wins</span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-10 pr-4">
            <div class="hidden md:block text-right">
              <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Status</div>
              <div class="flex items-center gap-2">
                <i data-lucide="arrow-up" class="text-green-500 w-4 h-4"></i>
                <span class="text-xs font-black text-white">Climbing</span>
              </div>
            </div>

            <div class="h-10 w-px bg-slate-700"></div>

            <button class="p-3 rounded-2xl bg-white/10 text-white">
              <i data-lucide="award" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

        <!-- USER 2 -->
        <div class="flex items-center justify-between p-6 rounded-[2.5rem] bg-white border border-slate-100 shadow-xl hover:-translate-y-1 transition">

          <div class="flex items-center gap-8">
            <div class="w-12 text-center">
              <i data-lucide="medal" class="text-slate-400 mx-auto w-6 h-6"></i>
            </div>

            <div class="flex items-center gap-5">
              <img src="https://i.pravatar.cc/100?img=2" class="w-16 h-16 rounded-2xl border-4 border-white shadow-lg" />
              <div>
                <h4 class="text-xl font-black text-[#0f172a]">Rahul Verma</h4>
                <div class="flex items-center gap-4 text-xs font-bold text-slate-400 uppercase tracking-widest">
                  <span>11,200 XP</span>
                  <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                  <span class="text-indigo-600">28 Wins</span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-10 pr-4">
            <div class="hidden md:block text-right">
              <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Status</div>
              <div class="flex items-center gap-2">
                <i data-lucide="minus" class="text-slate-300 w-4 h-4"></i>
                <span class="text-xs font-black text-slate-800">Steady</span>
              </div>
            </div>

            <div class="h-10 w-px bg-slate-100"></div>

            <button class="p-3 rounded-2xl bg-slate-50 text-slate-400 hover:text-[#e85a3c]">
              <i data-lucide="award" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

      </div>

      <!-- RIGHT SIDE -->
      <div class="space-y-8">

        <!-- PRIZE CARD -->
        <div class="bg-[#e85a3c] rounded-[3rem] p-10 text-white shadow-2xl relative overflow-hidden">
          <div class="absolute top-0 right-0 opacity-10">
            <i data-lucide="trophy" class="w-40 h-40"></i>
          </div>

          <div class="relative z-10">
            <h3 class="text-3xl font-black mb-4">Current Season Prize Pool</h3>
            <div class="text-5xl font-black mb-8">$10000</div>
            <button class="w-full py-4 rounded-2xl bg-white text-[#e85a3c] font-black uppercase tracking-widest hover:scale-105 transition">
              View Rewards
            </button>
          </div>
        </div>

        <!-- BADGES -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-xl space-y-6">
          <h3 class="text-xl font-black text-[#0f172a]">Your Badges</h3>
          <div class="grid grid-cols-3 gap-4">
            <div class="aspect-square bg-slate-50 rounded-2xl flex items-center justify-center text-slate-200">
              <i data-lucide="medal" class="w-8 h-8"></i>
            </div>
            <div class="aspect-square bg-slate-50 rounded-2xl flex items-center justify-center text-slate-200">
              <i data-lucide="medal" class="w-8 h-8"></i>
            </div>
            <div class="aspect-square bg-slate-50 rounded-2xl flex items-center justify-center text-slate-200">
              <i data-lucide="medal" class="w-8 h-8"></i>
            </div>
          </div>
          <p class="text-xs text-slate-400 font-bold text-center">
            Unlock more badges by participating in tournaments.
          </p>
        </div>

      </div>
    </div>
  </div>
<div>



@endsection

