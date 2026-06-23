@extends('crm.layouts.master')

@section('content')

<script src="https://unpkg.com/lucide/dist/umd/lucide.js"></script>

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
                <a href="javascript:history.back()"
                   class="px-8 py-4 rounded-3xl bg-white/10 hover:bg-white/20 font-black text-xs uppercase tracking-widest transition">
                    ← Back
                </a>

                <button onclick="openManageSquad()"
                   class="px-8 py-4 rounded-3xl bg-[#e85a3c] hover:scale-105 transition font-black text-xs uppercase tracking-widest shadow-lg">
                    Manage Squad
                </button>
            </div>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-2 gap-6 self-center">
            <div class="bg-white/10 backdrop-blur p-8 rounded-3xl text-center hover:bg-white/20 transition">
                <div class="text-4xl font-black">{{ $team->players->count() }}</div>
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
        @foreach($team->players as $player)
        <div id="player-card-{{ $player->id }}" class="group relative bg-white rounded-[2.5rem] p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

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
                    <button onclick="removePlayer({{ $player->id }})"
                            class="p-3 rounded-xl bg-slate-50 hover:bg-red-500 hover:text-white transition">
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

<!-- ===== MANAGE SQUAD MODAL ===== -->
<div id="manageSquadModal" class="fixed inset-0 bg-black/70 z-50 items-center justify-center p-4" style="display:none;">
  <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-8 relative" style="max-height:80vh; overflow-y:auto;">

    <button onclick="closeManageSquad()" class="absolute top-6 right-6 text-gray-400 hover:text-black text-xl font-black">✕</button>

    <h3 class="text-2xl font-black mb-2">Manage Squad</h3>
    <p id="squadCount" class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6">
      {{ $team->players->count() }} / {{ $team->max_players }} players
    </p>

    <div id="squadList" class="space-y-3 mb-6">
      @foreach($team->players as $player)
      <div class="flex items-center justify-between bg-slate-50 p-4 rounded-2xl" id="modal-player-{{ $player->id }}">
        <span class="font-bold text-[#0f172a]">{{ $player->name }}</span>
        <button onclick="removePlayer({{ $player->id }})"
                class="p-2 rounded-xl bg-red-50 hover:bg-red-500 hover:text-white text-red-500 transition">
          <i data-lucide="trash-2" class="w-4 h-4"></i>
        </button>
      </div>
      @endforeach
    </div>

    <p id="squadError" class="text-red-500 text-sm font-bold mb-3 hidden"></p>

    <div class="flex gap-3">
      <input id="newPlayerName" type="text" placeholder="Enter player name"
             class="flex-1 p-4 rounded-xl border font-bold outline-none focus:border-[#e85a3c]">
      <button onclick="addPlayer()"
              class="px-6 py-4 bg-[#e85a3c] text-white rounded-xl font-black hover:bg-[#0f172a] transition">
        Add
      </button>
    </div>

  </div>
</div>

<script>
const TEAM_ID = {{ $team->id }};
const CSRF    = '{{ csrf_token() }}';
let playerCount = {{ $team->players->count() }};
const maxPlayers = {{ $team->max_players }};

function openManageSquad() {
  document.getElementById('manageSquadModal').style.display = 'flex';
}
function closeManageSquad() {
  document.getElementById('manageSquadModal').style.display = 'none';
}

function updateCount() {
  document.getElementById('squadCount').textContent = playerCount + ' / ' + maxPlayers + ' players';
}

function removePlayer(playerId) {
  fetch('/player/' + playerId + '/remove', {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      document.getElementById('modal-player-' + playerId)?.remove();
      document.getElementById('player-card-' + playerId)?.remove();
      playerCount--;
      updateCount();
    }
  });
}

function addPlayer() {
  const input  = document.getElementById('newPlayerName');
  const errEl  = document.getElementById('squadError');
  const name   = input.value.trim();

  errEl.classList.add('hidden');

  if (!name) {
    errEl.textContent = 'Player name is required.';
    errEl.classList.remove('hidden');
    return;
  }

  fetch('/squad/' + TEAM_ID + '/add-player', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/json' },
    body: JSON.stringify({ name })
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      input.value = '';
      playerCount++;
      updateCount();

      // Add row to modal list
      const list = document.getElementById('squadList');
      const row  = document.createElement('div');
      row.className = 'flex items-center justify-between bg-slate-50 p-4 rounded-2xl';
      row.id = 'modal-player-' + data.player.id;
      row.innerHTML = `
        <span class="font-bold text-[#0f172a]">${data.player.name}</span>
        <button onclick="removePlayer(${data.player.id})"
                class="p-2 rounded-xl bg-red-50 hover:bg-red-500 hover:text-white text-red-500 transition">
          <i data-lucide="trash-2" class="w-4 h-4"></i>
        </button>`;
      list.appendChild(row);

      // Add card to main grid
      const grid  = document.querySelector('.grid.grid-cols-1.sm\\:grid-cols-2');
      const card  = document.createElement('div');
      card.className = 'group relative bg-white rounded-[2.5rem] p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2';
      card.id = 'player-card-' + data.player.id;
      card.innerHTML = `
        <div class="absolute inset-0 rounded-[2.5rem] bg-gradient-to-br from-[#e85a3c]/10 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
        <div class="relative z-10 text-center space-y-4">
          <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-br from-[#0f172a] to-slate-700 flex items-center justify-center text-white text-2xl font-black shadow-lg group-hover:scale-110 transition">
            ${data.player.name.charAt(0).toUpperCase()}
          </div>
          <div>
            <h4 class="text-lg font-black text-[#0f172a]">${data.player.name}</h4>
            <p class="text-xs uppercase tracking-widest text-slate-400">Squad Player</p>
          </div>
          <div class="flex justify-center gap-3 opacity-0 group-hover:opacity-100 transition">
            <button onclick="removePlayer(${data.player.id})"
                    class="p-3 rounded-xl bg-slate-50 hover:bg-red-500 hover:text-white transition">
              <i data-lucide="trash" class="w-4 h-4"></i>
            </button>
          </div>
        </div>`;
      grid.appendChild(card);

      lucide.createIcons();
    } else {
      errEl.textContent = data.message ?? 'Failed to add player.';
      errEl.classList.remove('hidden');
    }
  })
  .catch(() => {
    errEl.textContent = 'Network error. Please try again.';
    errEl.classList.remove('hidden');
  });
}

lucide.createIcons();
</script>

@endsection
