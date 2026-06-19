<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Topic;
use App\Models\TopicCategory;
use App\Models\WebmasterSection;
use App\Models\Team;
use App\Models\TeamBooking;
use App\Models\Player;
use Illuminate\Http\Request;
use Auth;

class GameListController extends Controller
{
    public function crmsports()
    {
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

        // 5️⃣ Build Sports Items
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

    // Get all teams with player count
     $teams = Team::withCount('players')->get()->groupBy('game'); // 'sports' column matches title_en
            // If no category, assign ALL
            if (empty($cats)) $cats[] = 'ALL';

            $sportsItems[] = [
                'id' => $topic->id,
                'title' => $topic->title_en ?? 'Untitled',
                'date'=> $topic->date ?? 'no Slot',
                'excerpt' => strip_tags($topic->details_en ?? ''),
                'image' => $topic->photo_file ? 'uploads/topics/'.$topic->photo_file : 'images/no-image.png',
                'categories' => $cats, // MUST BE ARRAY
            
            ];
        }

      return view('crm.Sports', [
        'sportsItems' => $sportsItems,
        'categories' => $categories,
        'teams' => $teams,
    ]);
    }

     public function crmtemsbook(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'sport_title' => 'required|string',
        ]);

        $booking = TeamBooking::create([
            'user_id' => Auth::id(),
            'team_id' => $request->team_id,
            'sport_title' => $request->sport_title,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking confirmed!',
            'booking' => $booking,
        ]);
    }
}
