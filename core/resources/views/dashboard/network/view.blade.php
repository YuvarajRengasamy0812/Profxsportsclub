@extends('dashboard.layouts.master')
@section('title','Network Team Details')

@section('content')

  <link href="{{ URL::asset('assets/crm/css/style.css') }}" rel="stylesheet">
  <script src="https://unpkg.com/lucide/dist/umd/lucide.js"></script>
  <script src="{{ URL::asset('assets/crm/js/style.js') }}"></script>
  <script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config = { corePlugins: { preflight: false } }</script>

<div class="bg-slate-50 min-h-screen p-8">
<div class="max-w-7xl mx-auto space-y-14">

{{-- HERO SECTION --}}
<div class="relative overflow-hidden rounded-[4rem] bg-gradient-to-br from-[#0f172a] via-slate-900 to-black p-14 text-white shadow-2xl">

    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <i data-lucide="users" class="absolute -top-10 -right-10 w-96 h-96"></i>
        <i data-lucide="globe" class="absolute bottom-0 left-0 w-80 h-80"></i>
    </div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between gap-10">

        <div class="space-y-6">
            <div class="inline-flex items-center gap-2 bg-white/10 px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest text-[#e85a3c] backdrop-blur">
                Network Team Profile
            </div>

            <h1 class="text-6xl font-black tracking-tighter">
                {{ $team->name }}
            </h1>

            <p class="text-slate-300 max-w-xl leading-relaxed">
                This network team is currently active. Manage members and track network capacity.
            </p>

            <div class="flex gap-4 pt-4">
                <a href="javascript:history.back()"
                   class="px-8 py-4 rounded-3xl bg-white/10 hover:bg-white/20 font-black text-xs uppercase tracking-widest transition">
                    ← Back
                </a>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-2 gap-6 self-center">
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-4xl font-black">{{ $team->networkplayers->count() }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">Members</div>
            </div>
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-4xl font-black">{{ $team->max_networks - $team->booked_networks }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">Slots Left</div>
            </div>
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-2xl font-black">{{ ucfirst($team->sports) }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">Category</div>
            </div>
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-2xl font-black">{{ $team->game }}</div>
                <div class="text-xs uppercase tracking-widest text-slate-300 mt-2">Game</div>
            </div>
        </div>

    </div>
</div>

{{-- NETWORK MEMBERS GRID --}}
<div>
    <h3 class="text-3xl font-black mb-8 tracking-tight text-[#0f172a]">
        Network Members
    </h3>

    @if($team->networkplayers->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($team->networkplayers as $player)
        <div class="group relative bg-white rounded-[2.5rem] p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

            <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-br from-[#e85a3c]/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>

            <div class="relative z-10 text-center space-y-4">
                <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#0f172a] to-slate-700 flex items-center justify-center text-white text-2xl font-black shadow-lg group-hover:scale-110 transition">
                    {{ strtoupper(substr($player->name, 0, 1)) }}
                </div>
                <div>
                    <h4 class="text-lg font-black text-[#0f172a]">{{ $player->name }}</h4>
                    <p class="text-xs uppercase tracking-widest text-slate-400">Network Member</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-20 text-slate-400 font-bold text-lg">
        No members have joined this network team yet.
    </div>
    @endif
</div>

{{-- STATUS CARD --}}
<div class="bg-white rounded-[3rem] p-10 shadow-xl">
    <h3 class="text-2xl font-black mb-6 text-[#0f172a]">Team Info</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="text-center p-6 bg-slate-50 rounded-2xl">
            <div class="text-xs uppercase tracking-widest text-slate-400 mb-2">Status</div>
            <div class="text-xl font-black text-[#0f172a]">{{ ucfirst($team->status) }}</div>
        </div>
        <div class="text-center p-6 bg-slate-50 rounded-2xl">
            <div class="text-xs uppercase tracking-widest text-slate-400 mb-2">Max Slots</div>
            <div class="text-xl font-black text-[#0f172a]">{{ $team->max_networks }}</div>
        </div>
        <div class="text-center p-6 bg-slate-50 rounded-2xl">
            <div class="text-xs uppercase tracking-widest text-slate-400 mb-2">Booked</div>
            <div class="text-xl font-black text-[#0f172a]">{{ $team->booked_networks }}</div>
        </div>
        <div class="text-center p-6 bg-slate-50 rounded-2xl">
            <div class="text-xs uppercase tracking-widest text-slate-400 mb-2">Available</div>
            <div class="text-xl font-black text-[#e85a3c]">{{ $team->max_networks - $team->booked_networks }}</div>
        </div>
    </div>
</div>

</div>
</div>

<script>
lucide.createIcons();
</script>

@endsection
