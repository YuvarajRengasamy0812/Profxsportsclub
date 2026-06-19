@extends('dashboard.layouts.master') 
@section('title','ViewTeam Details')

@section('content')

  <link href="{{ URL::asset('assets/crm/css/style.css') }}" rel="stylesheet">
   <script src="https://unpkg.com/lucide/dist/umd/lucide.js"></script>
    <script src="{{ URL::asset('assets/crm/js/style.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
<div class="bg-slate-50 min-h-screen p-8">
<div class="max-w-7xl mx-auto space-y-14">

{{-- HERO SECTION --}}
<div class="relative overflow-hidden rounded-[4rem] bg-gradient-to-br from-[#0f172a] via-slate-900 to-black p-14 text-white shadow-2xl">

    {{-- Overlay Icons --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <i data-lucide="users" class="absolute -top-10 -right-10 w-96 h-96"></i>
        <i data-lucide="shield" class="absolute bottom-0 left-0 w-80 h-80"></i>
    </div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-10">

        <div class="space-y-6">
            <div class="inline-flex items-center gap-2 bg-white/10 px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest text-[#e85a3c] backdrop-blur">
                Team Profile
            </div>

            <h1 class="text-6xl font-black tracking-tighter">
                {{ $team->name }}
            </h1>

            <p class="text-slate-300 max-w-xl leading-relaxed">
                This squad is currently active and eligible for upcoming tournaments.
                Manage players, analyze strength and prepare for matches.
            </p>

            <div class="flex gap-4 pt-4">
                <a href="{{ route('crmtems') }}"
                   class="px-8 py-4 rounded-3xl bg-white/10 hover:bg-white/20 font-black text-xs uppercase tracking-widest transition">
                    ← Back
                </a>

                <button
                   class="px-8 py-4 rounded-3xl bg-[#e85a3c] hover:scale-105 transition font-black text-xs uppercase tracking-widest shadow-lg">
                    Manage Squad
                </button>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-2 gap-6 self-center">
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-4xl font-black">{{ $team->travelplayers->count() }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">Players</div>
            </div>
 <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-4xl font-black">{{ $team->game }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">{{ strtoupper($team->sports) }} </div>
            </div>
            
        </div>

    </div>
</div>

{{-- PLAYERS GRID --}}
<div>
    <h3 class="text-3xl font-black mb-8 tracking-tight text-[#0f172a]">
        Squad Members
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($team->travelplayers as $player)
        <div class="group relative bg-white rounded-[2.5rem] p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

            {{-- Overlay --}}
            <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-br from-[#e85a3c]/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

            <div class="relative z-10 text-center space-y-4">

                {{-- Avatar --}}
                <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#0f172a] to-slate-700 flex items-center justify-center text-white text-2xl font-black shadow-lg group-hover:scale-110 transition">
                    {{ strtoupper(substr($player->name,0,1)) }}
                </div>

                <div>
                    <h4 class="text-lg font-black text-[#0f172a]">
                        {{ $player->name }}
                    </h4>
                    <p class="text-xs uppercase tracking-widest text-slate-400">
                        Squad Player
                    </p>
                </div>

                {{-- Hover Actions --}}
                <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition">
                    <button class="p-3 rounded-xl bg-slate-50 hover:bg-[#e85a3c] hover:text-white transition">
                        <i data-lucide="edit" class="w-4 h-4"></i>
                    </button>
                    <button class="p-3 rounded-xl bg-slate-50 hover:bg-red-500 hover:text-white transition">
                        <i data-lucide="trash" class="w-4 h-4"></i>
                    </button>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

</div>
</div>

<script>
lucide.createIcons();
</script>

@endsection
