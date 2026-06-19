@extends('dashboard.layouts.master') 
@section('title','Team Details')

@section('content')

  <link href="{{ URL::asset('assets/crm/css/style.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/lucide/dist/umd/lucide.js"></script>
 <script src="{{ URL::asset('assets/crm/js/style.js') }}"></script>
 
<script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* =======================
       TABS & BADGES STYLES
    ======================= */

        .tab-btn {
            padding: 12px 22px;
            border-radius: 14px;
            font-weight: 800;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .tab-btn.category.active {
            background: #0f172a;
            color: #fff;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .3);
        }

        .tab-btn.game {
            background: #fff7ed;
            color: #ea580c;
            border: 2px solid #fed7aa;
        }

        .tab-btn.game.active {
            background: linear-gradient(135deg, #ea580c, #fb923c);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 12px 30px rgba(234, 88, 12, .4);
        }

        /* BADGES */
        .badge {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .15em;
            text-transform: uppercase;
        }

        .badge-sport {
            background: #0f172a;
            color: #fff;
        }

        .badge-game {
            background: #ea580c;
            color: #fff;
        }

        #categoryTabs,
        #gamesTabs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* =========================
       TABLET (≤ 1024px)
    ========================= */
        @media (max-width: 1024px) {

            #categoryTabs,
            #gamesTabs {
                gap: 10px;
            }

            .tab-btn {
                padding: 10px 18px;
                font-size: 10px;
                border-radius: 12px;
            }
        }

        /* =========================
       MOBILE (≤ 768px)
    ========================= */
        @media (max-width: 768px) {

            /* Modal padding reduce */
            #createTeamModal>div.relative {
                padding: 24px;
                border-radius: 24px;
            }

            /* Tabs stack nicely */
            #categoryTabs,
            #gamesTabs {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .tab-btn {
                width: 100%;
                text-align: center;
                padding: 14px 10px;
                font-size: 11px;
                border-radius: 14px;
            }
        }

        /* =========================
       SMALL MOBILE (≤ 480px)
    ========================= */
        @media (max-width: 480px) {

            /* Single column tabs */
            #categoryTabs,
            #gamesTabs {
                grid-template-columns: 1fr;
            }

            .tab-btn {
                font-size: 12px;
                padding: 16px;
            }

            /* Modal full screen feel */
            #createTeamModal {
                padding: 10px;
            }
        }
    </style>

    <div class="bg-slate-50 p-8">
        <div class="max-w-7xl mx-auto space-y-12">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-end gap-6">
                <div>
                    <h2 class="text-5xl font-black tracking-tighter text-[#0f172a]">
                        Squad Management
                    </h2>
                    <p class="text-slate-500 font-bold mt-2 max-w-lg">
                        Create teams, manage players and track squad strength.
                    </p>
                </div>

                <button onclick="openCreateTeamModal()"
                    class="bg-[#0f172a] text-white px-10 py-5 rounded-3xl font-black text-xs uppercase tracking-widest shadow-xl hover:bg-[#e85a3c] transition">
                    Create New Squad
                </button>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl font-bold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TEAMS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                @foreach($teams as $team)
    @php
        $availableSlots = $team->max_players - $team->booked_players;
    @endphp

                <div
                        class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-xl hover:border-[#e85a3c] transition">

                        {{-- SPORT & GAME --}}
                        <div class="flex gap-2 mb-4">
                            <span class="badge badge-sport">{{ strtoupper($team->sports) }}</span>

                        </div>

                        <div class="flex justify-between mb-8">
                           <div class="text-left">
                                <div class="text-[10px] font-black text-slate-300 uppercase">
                                   Status
                                </div>
                                <div class="text-xl font-black text-[#0f172a]">
                                    {{ $team->status }}
                                </div>
                            </div>
                            <div class="text-left">
                                <div class="text-[10px] font-black text-slate-300 uppercase">
                                    Sports
                                </div>
                                <div class="text-xl font-black text-[#0f172a]">
                                    {{ $team->game }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] font-black text-slate-300 uppercase">
                                    Slots
                                </div>
                                <div class="text-xl font-black text-[#0f172a]">
                                    {{ $availableSlots }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-4  bg-orange-50 rounded-2xl">
    <!-- Icon -->
    <div class="text-[#e85a3c]">
        <i data-lucide="users" class="w-6 h-6"></i>
    </div>

    <!-- Team Name -->
    <h3 class="text-3xl font-black text-[#0f172a] m-0">
        {{ $team->name }}
    </h3>
</div>

                       

                        {{-- PLAYERS --}}
                        <div class="flex -space-x-2 mt-5 mb-8">
                            @foreach($team->players->take(5) as $player)
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-xs font-black border-2 border-white">
                                    {{ strtoupper(substr($player->name, 0, 1)) }}
                                </div>
                            @endforeach
                        </div>

                        <a href="{{ route('teamdetails', $team->id) }}"
                            class="block text-center py-4 bg-[#0f172a] text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#e85a3c] transition">
                            View Team
                        </a>
                    </div>
                @endforeach

                {{-- CREATE CARD --}}
                <div onclick="openCreateTeamModal()"
                    class="bg-white rounded-[3rem] p-10 border-4 border-dashed border-slate-200 flex flex-col items-center justify-center text-center cursor-pointer hover:border-[#e85a3c] hover:bg-orange-50 transition">

                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                        <i data-lucide="plus" class="w-10 h-10 text-slate-400"></i>
                    </div>

                    <h3 class="text-xl font-black text-slate-400">
                        Create New Team
                    </h3>
                </div>

            </div>
        </div>
    </div>

    {{-- CREATE TEAM MODAL --}}
 


  <div id="createTeamModal" class="fixed inset-0 hidden z-[9999] flex items-center justify-center p-6">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-md" onclick="closeCreateTeamModal()"></div>

    <div class="relative bg-white w-full max-w-2xl rounded-[1rem] p-10 shadow-2xl overflow-y-auto max-h-[90vh]">

        {{-- Close --}}
        <button onclick="closeCreateTeamModal()" class="absolute top-5 right-5 p-2 rounded-full hover:bg-slate-100">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        <h3 class="text-3xl font-black mb-8 text-[#0f172a]">
            Create New Team
        </h3>

        <form action="{{  route('teams.store')  }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Team Name --}}
            <div>
                <label class="block font-bold mb-2">Team Name</label>
                <input type="text" name="team_name"
                    class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-[#e85a3c]"
                    placeholder="Enter team name" required>
            </div>
<div>
    <label class="block font-bold mb-2">Entry Fee</label>
    <input
        type="number"
        name="entryFee"
        class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-[#e85a3c]"
        placeholder="Enter entry fee"
        required
    >
</div>
            {{-- Team Logo --}}
            <div>
                <label class="block font-bold mb-2">Team Logo</label>
                <input type="file" name="logo"
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 border rounded-xl"
                    required>
            </div>

            {{-- Sport Category --}}
            <div>
                <label class="block font-bold mb-3">Sport Category</label>
                <div id="categoryTabs" class="flex gap-3 flex-wrap">
                    <div class="tab-btn category" data-category="physical">Physical</div>
                    <div class="tab-btn category" data-category="esports">E-Sports</div>
                    <div class="tab-btn category" data-category="indoor">Indoor</div>
                </div>
            </div>

            {{-- Games --}}
            <div id="gamesSection" class="hidden">
                <label class="block font-bold mb-3">Select Game</label>
                <div id="gamesTabs" class="flex flex-wrap gap-3"></div>
            </div>

            {{-- Hidden values --}}
            <input type="hidden" name="category" id="selectedCategory" required>
            <input type="hidden" name="game" id="selectedGame" required>

            {{-- TOTAL PLAYERS (NEW FIELD) --}}
            <div>
                <label class="block font-bold mb-2">
                    Total Players Required
                </label>
                <input type="number" name="max_players"
                    class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-[#e85a3c]"
                    placeholder="Example: Cricket = 11"
                    min="1"
                    required>
                <p class="text-xs text-slate-400 mt-2">
                    This defines how many users can book this team.
                </p>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-[#e85a3c] text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:scale-[1.02] transition">
                Create Team
            </button>
        </form>
    </div>
</div>



    {{-- JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const categories = {
                indoor: ['Chess', 'Carrom', 'Table Tennis', 'Snooker'],
                physical: ['Cricket', 'Football', 'Basketball'],
                esports: ['BGMI', 'Free Fire', 'Valorant']
            };

            const categoryTabs = document.querySelectorAll('#categoryTabs .category');
            const gamesTabs = document.getElementById('gamesTabs');
            const gamesSection = document.getElementById('gamesSection');
            const selectedCategory = document.getElementById('selectedCategory');
            const selectedGame = document.getElementById('selectedGame');

            categoryTabs.forEach(tab => {
                tab.onclick = () => {
                    categoryTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const category = tab.dataset.category;
                    selectedCategory.value = category;

                    gamesSection.classList.remove('hidden');
                    gamesTabs.innerHTML = '';
                    selectedGame.value = '';

                    categories[category].forEach(game => {
                        const g = document.createElement('div');
                        g.className = 'tab-btn game';
                        g.innerText = game;

                        g.onclick = () => {
                            document.querySelectorAll('#gamesTabs .game').forEach(t => t.classList.remove('active'));
                            g.classList.add('active');
                            selectedGame.value = game;
                        };

                        gamesTabs.appendChild(g);
                    });
                };
            });
        });

        function openCreateTeamModal() {
            document.getElementById('createTeamModal').classList.remove('hidden');
        }
        function closeCreateTeamModal() {
            document.getElementById('createTeamModal').classList.add('hidden');
        }
        function addPlayer() {
            const container = document.getElementById('playersContainer');
            const div = document.createElement('div');
            div.className = 'flex gap-3';
            div.innerHTML = `
            <input type="text" name="players[]" class="flex-1 p-3 border rounded-xl" required>
            <button type="button" onclick="removePlayer(this)"
                class="px-4 rounded-xl bg-red-500 text-white font-black">✕</button>
        `;
            container.appendChild(div);
        }
        function removePlayer(btn) {
            btn.parentElement.remove();
        }

        lucide.createIcons();
    </script>

@endsection