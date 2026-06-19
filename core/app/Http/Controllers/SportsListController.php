<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\WebmasterSection;
use App\Models\Team;
use App\Models\TeamBooking;
use App\Models\Player;
use App\Models\AdminTeamBooking;
use App\Models\AdminTeam;
use App\Models\CorporateRequest;
use App\Models\Payment;
use Helper;
use Illuminate\Http\Request;
use Auth;

class SportsListController extends Controller
{
    
    private $uploadPath = "uploads/topics/";
//     public function crmsports()
//     {
//         // 1️⃣ Sports Section
//         $sportsSection = WebmasterSection::where('title_en', 'sports')
//             ->where('status', 1)
//             ->firstOrFail();

//         // 2️⃣ Categories
//         $categories = Section::where('webmaster_id', $sportsSection->id)
//             ->where('status', 1)
//             ->orderBy('row_no')
//             ->get();

//         // Category map: id => uppercase name
//         $categoryMap = [];
//         foreach ($categories as $cat) {
//             $categoryMap[$cat->id] = strtoupper(trim($cat->title_en));
//         }

//         // 3️⃣ Topics
//         $topics = Topic::where('webmaster_id', $sportsSection->id)
//             ->where('status', 1)
//             ->get();

//         // 4️⃣ Topic → Category mapping
//         $topicCategories = TopicCategory::whereIn('topic_id', $topics->pluck('id'))
//             ->get()
//             ->groupBy('topic_id');

//         // 5️⃣ Build Sports Items
//         $sportsItems = [];
//         foreach ($topics as $topic) {
//             $cats = [];
//             if (isset($topicCategories[$topic->id])) {
//                 foreach ($topicCategories[$topic->id] as $tc) {
//                     if (isset($categoryMap[$tc->section_id])) {
//                         $cats[] = $categoryMap[$tc->section_id];
//                     }
//                 }
//             }
// $userId = auth()->id();
//     // Get all teams with player count
//   $teams = Team::withCount('players')
//             // ->where('user_id', $userId)   // only teams of logged-in user
//             ->get()
//             ->groupBy('game');
//             // If no category, assign ALL
//             if (empty($cats)) $cats[] = 'ALL';

//             $sportsItems[] = [
//                 'id' => $topic->id,
//                 'title' => $topic->title_en ?? 'Untitled',
//                 'date'=> $topic->date ?? 'no Slot',
//                 'excerpt' => strip_tags($topic->details_en ?? ''),
//                 'image' => $topic->photo_file ? 'uploads/topics/'.$topic->photo_file : 'images/no-image.png',
//                 'categories' => $cats, // MUST BE ARRAY
            
//             ];
//         }

//       return view('crm.Sports', [
//         'sportsItems' => $sportsItems,
//         'categories' => $categories,
//         'teams' => $teams,
//     ]);
//     }

    public function crmsports()
{
    $userId = auth()->id(); // logged-in user

    // 1️⃣ Sports Section
    $sportsSection = WebmasterSection::where('title_en', 'sports')
        ->where('status', 1)
        ->firstOrFail();

    // 2️⃣ Categories
    $categories = Section::where('webmaster_id', $sportsSection->id)
        ->where('status', 1)
        ->orderBy('row_no')
        ->get();

    // Category map: id => uppercase name
    $categoryMap = [];
    foreach ($categories as $cat) {
        $categoryMap[$cat->id] = strtoupper(trim($cat->title_en));
    }

    // 3️⃣ Topics
    $topics = Topic::where('webmaster_id', $sportsSection->id)
        ->where('status', 1)
        ->get();

    // 4️⃣ Topic → Category mapping
    $topicCategories = TopicCategory::whereIn('topic_id', $topics->pluck('id'))
        ->get()
        ->groupBy('topic_id');

    // 5️⃣ Get all user's bookings
    $userBookings = AdminTeamBooking::where('user_id', $userId)
        ->pluck('game')
        ->toArray(); // array of games user already booked

    // 6️⃣ Build Sports Items
    $sportsItems = [];
    foreach ($topics as $topic) {
        $cats = [];
        if (isset($topicCategories[$topic->id])) {
            foreach ($topicCategories[$topic->id] as $tc) {
                if (isset($categoryMap[$tc->section_id])) {
                    $cats[] = $categoryMap[$tc->section_id];
                }
            }
        }

        if (empty($cats)) $cats[] = 'ALL';

        // Check if user already booked this game
        $isBooked = in_array($topic->title_en, $userBookings);

        $sportsItems[] = [
            'id' => $topic->id,
            'title' => $topic->title_en ?? 'Untitled',
            'date'=> $topic->date ?? 'no Slot',
            'excerpt' => strip_tags($topic->details_en ?? ''),
            'image' => $topic->photo_file ? 'uploads/topics/'.$topic->photo_file : 'images/no-image.png',
            'categories' => $cats,
            'is_booked' => $isBooked, // ✅ this will control booking button in blade
        ];
    }

    // 7️⃣ Teams grouped by game with user booking flag
    $teams = AdminTeam::get()
        ->map(function ($team) use ($userId) {
            $team->already_booked = AdminTeamBooking::where('team_id', $team->id)
                ->where('user_id', $userId)
                ->exists();
            return $team;
        })
        ->groupBy('game');

    return view('crm.Sports', [
        'sportsItems' => $sportsItems,
        'categories' => $categories,
        'teams' => $teams,
    ]);
}

//      public function crmtemsbook(Request $request)
//     {
//         $request->validate([
//             'team_id' => 'required|exists:teams,id',
//             'sport_title' => 'required|string',
//         ]);

//         $booking = TeamBooking::create([
//             'user_id' => Auth::id(),
//             'team_id' => $request->team_id,
//             'sport_title' => $request->sport_title,
//         ]);

//         return response()->json([
//             'success' => true,
//             'message' => 'Booking confirmed!',
//             'booking' => $booking,
//         ]);
//     }
    
    public function crmtemsbook(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'team_id' => 'required|exists:adminteams,id'
    ]);

    $team = AdminTeam::findOrFail($request->team_id);

    if ($team->status === 'full') {
        return response()->json(['success'=>false, 'message'=>'Team is full']);
    }

    if (AdminTeamBooking::where('team_id', $team->id)->where('user_id', $user->id)->exists()) {
        return response()->json(['success'=>false, 'message'=>'You already booked this team']);
    }

    $booking = AdminTeamBooking::create([
        'team_id' => $team->id,
        'game' =>$team->game,
         'user_id' => Auth::id(),
    ]);

    Player::create([
        'team_id' => $team->id,
        'user_id' =>Auth::id(),
        'name'    => $user->name
    ]);

    $team->increment('booked_players');

    if ($team->booked_players >= $team->max_players) {
        $team->update(['status' => 'full']);
    }

    return response()->json([
        'success' => true,
        'booking' => [
            'team_id' => $team->id,
            'sport_title' => $team->sports,
            'team_name' => $team->name
        ]
    ]);
}
       public function corporateSave(Request $request)
{
    $request->validate([
        'plan_name' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'methods' => 'required|string',
        'proof' => 'nullable|file|max:2048', // 2MB max
    ]);

    $fileFinalName = null;

    if ($request->hasFile('proof')) {
        $file = $request->file('proof');
        $fileFinalName = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();

        // Upload path
        $path = public_path('uploads/payment_proofs/');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Move the file
        $file->move($path, $fileFinalName);

        // Optional: resize & optimize if you have Helper class
        if (class_exists('Helper')) {
            Helper::imageResize($path . $fileFinalName);
            Helper::imageOptimize($path . $fileFinalName);
        }
    }

    $payment = Payment::create([
        'user_id' => auth()->id(),       // <-- Save authenticated user ID
        'plan_name' => $request->plan_name,
        'amount' => $request->amount,
        'methods' => $request->methods,
        'proof' => $fileFinalName, // <-- store actual file name
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Payment saved successfully!',
        'data' => $payment,
    ]);
}

public function corporateBooking(Request $request)
{
    $request->validate([
        'company' => 'required',
        'contact' => 'required',
        'email'   => 'required|email'
    ]);

    CorporateRequest::create([
        'user_id' => Auth::id(),
        'company' => $request->company,
        'contact' => $request->contact,
        'email'   => $request->email,
        'message' => $request->message,
        'status'  => 'pending'
    ]);

    return back()->with('success', 'Corporate request sent successfully!');
}





}
