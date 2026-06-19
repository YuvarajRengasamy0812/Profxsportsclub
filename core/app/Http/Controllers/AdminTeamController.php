<?php

namespace App\Http\Controllers;

use App\Models\AdminTeam;
use App\Models\AdminTeamBooking;
use App\Models\AdminTravel;
use App\Models\TravelPlayer;
use App\Models\AdminTravelBooking;
use App\Models\AdminNetwork;
use App\Models\NetworkPlayer;
use App\Models\AdminNetworkBooking;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Auth;
use File;
use Helper;
class AdminTeamController extends Controller
{ 
    
private $uploadPath = "uploads/topics/";
    public function index()
    {
        $teams = AdminTeam::latest()->get();
        return view('dashboard.team.listteam', compact('teams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'category' => 'required',
            'game' => 'required',
            'entryFee' => 'required',
            'max_players' => 'required|integer|min:1',
            'logo' => 'required|image'
        ]);

           $formFileName = 'logo';                 // input name
    $fileFinalName = null;

     if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);

            // resize & optimize
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }
        AdminTeam::create([
            'name' => $request->team_name,
            'sports' => $request->category,
            'entryFee' => $request->entryFee,
            'game' => $request->game,
            'max_players' => $request->max_players,
            'booked_players' => 0,
            'status' => 'open',
            'logo' => $fileFinalName, // save RELATIVE PATH
        ]);

        return back()->with('success', 'Team Created Successfully');
    }
public function viewteam($id)
    {
        $team = AdminTeam::with('players')->findOrFail($id);

        return view('dashboard.team.view', compact('team'));
    }
    public function book(AdminTeam $team)
    {
        if ($team->status === 'full') {
            return back()->with('error', 'Team is already full');
        }

        if (AdminTeamBooking::where('team_id', $team->id)
            ->where('user_id', Auth::id())->exists()) {
            return back()->with('error', 'You already booked this team');
        }

        AdminTeamBooking::create([
            'team_id' => $team->id,
            'user_id' => Auth::id()
        ]);

        $team->increment('booked_players');

        if ($team->booked_players >= $team->max_players) {
            $team->update(['status' => 'full']);
        }

        return back()->with('success', 'Booking Successful');
    }
    
        // travels

public function crmtravel()
{
    $teams = AdminTravel::latest()->get();

    foreach ($teams as $team) {

        // ✅ Image full URL
        if (!empty($team->image)) {
            $team->image = url('uploads/topics/' . $team->image);
        } else {
            $team->image = null;
        }

        // ✅ CHECK ALREADY BOOKED FOR LOGGED USER
        $team->already_booked = AdminTravelBooking::where('travel_id', $team->id)
            ->where('user_id', Auth::id())
            ->exists();
    }

    return view('crm.Travel', compact('teams'));
}

        public function travel(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'location'=>'required',
            'category' => 'required',
             'entryFee' => 'required',
            'game' => 'required',
            'max_travelers' => 'required|integer|min:1',
            'image' => 'required|image'
        ]);

           $formFileName = 'image';                 // input name
    $fileFinalName = null;

     if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);

            // resize & optimize
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }
       AdminTravel::create([
            'name' => $request->team_name,
            'location'=>$request->location,
            'sports' => $request->category,
            'game' => $request->game,
            'entryFee' => $request->entryFee,
            'max_travelers' => $request->max_travelers,
            'booked_travelers' => 0,
            'status' => 'open',
            'image' => $fileFinalName, // save RELATIVE PATH
        ]);

        return back()->with('success', 'Travel Created Successfully');
    }
public function viewtravel($id)
    {
        $travel = AdminTravel::with('players')->findOrFail($id);

        return view('dashboard.travel.view', compact('travel'));
    }
public function crmtravelbook(Request $request)
{
    $request->validate([
        'travel_id' => 'required|exists:admintravels,id',
       
    ]);

    $travel = AdminTravel::findOrFail($request->travel_id);

    // Check if travel is full
    if ($travel->status === 'full') {
        return response()->json([
            'success' => false,
            'message' => 'Travel already full'
        ]);
    }

    // Check if user already booked
    if (AdminTravelBooking::where('travel_id', $travel->id)
        ->where('user_id', Auth::id())
        ->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Already booked. Please choose another team'
        ]);
    }

    // Insert into AdminTravelBooking
    AdminTravelBooking::create([
        'travel_id' => $travel->id,
        'user_id' => Auth::id(),
        'game' => $travel->game, // only save game here
    ]);

    // Insert into TravelPlayer
    TravelPlayer::create([
        'team_id' => $travel->id,
        'user_id' => Auth::id(),
        'name' => Auth::user()->name, // <-- must be a string
    ]);

    // Increment booked travelers
    $travel->increment('booked_travelers');

    // Update status if full
    if ($travel->booked_travelers >= $travel->max_travelers) {
        $travel->update(['status' => 'full']);
    }

    return response()->json([
        'success' => true,
        'message' => 'Booking confirmed!'
    ]);
}



// network
 public function crmnetwork()
{

    // Get all travel teams, latest first
    $teams = AdminNetwork::latest()->get();

    // Add full image URL for each team if image exists
    foreach ($teams as $team) {
        if (!empty($team->image)) {
            $team->image = url('uploads/topics/' . $team->image);
        } else {
            $team->image = null;
        }

        $team->already_booked = AdminNetworkBooking::where('network_id', $team->id)
            ->where('user_id', Auth::id())
            ->exists();
    }
    // Return view with teams and sections
    return view('crm.network', compact( 'teams'));
}

 public function network(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
            'location'=>'required',
             'entryFee' => 'required',
            'category' => 'required',
            'game' => 'required',
            'max_networks' => 'required|integer|min:1',
            'image' => 'required|image'
        ]);

           $formFileName = 'image';                 // input name
    $fileFinalName = null;

     if ($request->$formFileName != "") {
            $fileFinalName = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->uploadPath;
            $request->file($formFileName)->move($path, $fileFinalName);

            // resize & optimize
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }
       AdminNetwork::create([
            'name' => $request->team_name,
            'location'=>$request->location,
            'sports' => $request->category,
             'entryFee' => $request->entryFee,
            'game' => $request->game,
            'max_networks' => $request->max_networks,
            'booked_networks' => 0,
            'status' => 'open',
            'image' => $fileFinalName, // save RELATIVE PATH
        ]);

        return back()->with('success', 'Travel Created Successfully');
    }
public function viewNetwork($id)
    {
        $network = AdminNetwork::with('players')->findOrFail($id);

        return view('dashboard.network.view', compact('network'));
    }
// public function crmnetworkbook(Request $request)
// {
//     $request->validate([
//         'network_id' => 'required|exists:adminnetworks,id',
       
//     ]);

//     $network = AdminNetwork::findOrFail($request->network_id);

//     // Check if travel is full
//     if ($network->status === 'full') {
//         return response()->json([
//             'success' => false,
//             'message' => 'Travel already full'
//         ]);
//     }

//     // Check if user already booked
//     if (AdminNetworkBooking::where('network_id', $network->id)
//         ->where('user_id', Auth::id())
//         ->exists()) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Already booked. Please choose another team'
//         ]);
//     }
//     $fileFinalName = null;
//     if ($request->hasFile('proof')) {
//         $file = $request->file('proof');
//         $fileFinalName = time() . rand(1000,9999) . '.' . $file->getClientOriginalExtension();
//         $file->move(public_path('uploads/payment_proofs'), $fileFinalName);
//     }
//     // Insert into AdminTravelBooking
//     AdminTravelBooking::create([
//         'travel_id' => $network->id,
//         'user_id' => Auth::id(),
//         'game' => $network->game, // only save game here
       
//     ]);

//     // Insert into TravelPlayer
//     TravelPlayer::create([
//         'team_id' => $network->id,
//         'user_id' => Auth::id(),
//         'name' => Auth::user()->name, // <-- must be a string
//     ]);

//     // Increment booked travelers
//     $network->increment('booked_travelers');

//     // Update status if full
//     if ($network->booked_networks >= $network->max_networks) {
//         $network->update(['status' => 'full']);
//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Booking confirmed!'
//     ]);
// }


public function crmnetworkbook(Request $request)
{
    $request->validate([
        'network_id' => 'required|exists:adminnetworks,id',
    ]);

    $network = AdminNetwork::findOrFail($request->network_id);

    if ($network->status === 'full') {
        return response()->json([
            'success' => false,
            'message' => 'Network already full'
        ]);
    }

    if (AdminNetworkBooking::where('network_id', $network->id)
        ->where('user_id', Auth::id())
        ->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Already booked. Please choose another team'
        ]);
    }

    AdminNetworkBooking::create([
        'network_id' => $network->id,
        'user_id' => Auth::id(),
        'game' => $network->game,
    ]);

    NetworkPlayer::create([
        'team_id' => $network->id,
        'user_id' => Auth::id(),
        'name' => Auth::user()->name,
    ]);

    $network->increment('booked_networks');

    if ($network->booked_networks >= $network->max_networks) {
        $network->update(['status' => 'full']);
    }

    return response()->json([
        'success' => true,
        'message' => 'Booking confirmed!'
    ]);
}

    public function crmtransaction(Request $request)
    {
        $query = Transactions::where(
            'useremail',
            Auth::user()->email
        );

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('payment_log_id', 'like', '%' . $request->search . '%')
                    ->orWhere('trans_purpose', 'like', '%' . $request->search . '%')
                    ->orWhere('trans_method', 'like', '%' . $request->search . '%');
            });
        }

        // 📅 Date Filter
        if ($request->filled('start_date')) {
            $query->whereDate('trans_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('trans_date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('trans_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view(
            'crm.transactions',
            compact('transactions')
        );
    }


}
