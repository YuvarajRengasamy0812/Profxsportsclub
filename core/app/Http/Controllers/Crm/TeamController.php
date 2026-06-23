<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminTeam;
use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use Helper;

class TeamController extends Controller
{
    private $uploadPath = "uploads/topics/";

    public function crmtems()
    {
        $user = Auth::user();

        $teamsQuery = AdminTeam::with('players')->withCount('players')->latest();
        if ((int) $user->user_type !== 1) {
            $teamsQuery->where('user_id', $user->id);
        }

        $teams = $teamsQuery->get();

        return view('crm.teams', compact('teams'));
    }

    public function crmtemssave(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'game' => 'required|string|max:255',
            'entryFee' => 'required|numeric|min:0',
            'max_players' => 'required|integer|min:1',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'players' => 'required|array|min:1',
            'players.*' => 'required|string|max:255',
        ]);

        $players = collect($request->players)->filter(fn($p) => trim((string) $p) !== '')->values();
        if ($players->isEmpty()) {
            return back()->withErrors(['players' => 'Please add at least one player.'])->withInput();
        }

        if ($players->count() > (int) $request->max_players) {
            return back()->withErrors(['max_players' => 'Max players must be greater than or equal to entered players count.'])->withInput();
        }

        $formFileName = 'logo';
        $fileFinalName = null;
        if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111, 9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }

        $team = AdminTeam::create([
            'user_id' => Auth::id(),
            'name' => $request->team_name,
            'sports' => $request->category,
            'game' => $request->game,
            'entryFee' => $request->entryFee,
            'max_players' => $request->max_players,
            'booked_players' => 0,
            'status' => 'open',
            'logo' => $fileFinalName,
        ]);

        foreach ($players as $playerName) {
            Player::create([
                'team_id' => $team->id,
                'user_id' => Auth::id(),
                'name' => trim($playerName),
            ]);
        }

        return redirect()
            ->route('crmtems')
            ->with('success', 'Team created successfully!');
    }

    public function viewteam($id)
    {
        $team = AdminTeam::with('players')->findOrFail($id);
        $user = Auth::user();

        if ((int) $user->user_type !== 1 && (int) $team->user_id !== (int) $user->id) {
            abort(403);
        }

        return view('crm.viewteam', compact('team'));
    }

    public function addPlayer(Request $request, $teamId)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $team = AdminTeam::with('players')->findOrFail($teamId);
        $user = Auth::user();

        if ((int) $user->user_type !== 1 && (int) $team->user_id !== (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        if ($team->players->count() >= $team->max_players) {
            return response()->json(['success' => false, 'message' => 'Squad is already at max capacity (' . $team->max_players . ' players).'], 422);
        }

        $player = Player::create([
            'team_id' => $team->id,
            'user_id' => Auth::id(),
            'name'    => trim($request->name),
        ]);

        return response()->json(['success' => true, 'player' => $player]);
    }

    public function removePlayer($playerId)
    {
        $player = Player::with('team')->findOrFail($playerId);
        $user   = Auth::user();

        if ((int) $user->user_type !== 1 && (int) $player->team->user_id !== (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $player->delete();

        return response()->json(['success' => true]);
    }

    public function updatePlayer(Request $request, $playerId)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $player = Player::with('team')->findOrFail($playerId);
        $user   = Auth::user();

        if ((int) $user->user_type !== 1 && (int) $player->team->user_id !== (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $player->update(['name' => trim($request->name)]);

        return response()->json(['success' => true, 'player' => $player]);
    }
}
