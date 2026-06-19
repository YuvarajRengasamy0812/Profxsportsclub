<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Enquiry;
use App\Models\Travels;
use App\Models\Network;
use App\Models\Booking;
use App\Models\Sports;

use Illuminate\Http\Request;
class MemberController extends Controller
{
    // Show the form
    public function create()
    {
        return view('frontend.membership'); // Blade file path
    }

    // Handle form submission
    public function store(Request $request)
    {
         // Validate input
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'nullable|email',
        'phone'   => 'required|string|max:20',
        'company' => 'required|string|max:255',
        'role'    => 'required|string|max:255',
        // 'proof'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'location'=> 'required|string|max:255',
        'sports'  => 'required|array', // <-- note array
        'sports.*'=> 'string|max:50',   // each selected sport
    ]);

    try {
        // Store uploaded file
        // $proofPath = $request->file('proof')->store('uploads/proof', 'public');

        // Create membership
        Membership::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'location' => $request->location,
            'company'  => $request->company,
            'role'     => $request->role,
            // 'proof'    => $proofPath,
            'sports'   => json_encode($request->sports), // store as JSON
            'squad'    => $request->squad,
        ]);

        return redirect()->back()
            ->with('success', 'Membership  successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
    }
    
    }


    //   public function tournament() {
    //     return view('frontend.tournaments'); // Blade file path
    // }
     // public function tournaments(){
    //     return view('frontEnd.tournaments');
    // }
     public function tournaments(Request $request) {
        //    echo'<pre>';print_r($request->all());exit;

 try {

        Enquiry::create([
            
            'type' => $request->type,
            'date' => $request->date,
            'comments' => $request->comments,
            
        ]);

        return redirect()->back()
            ->with('success', ' submitted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
     }
    
    }

     public function travel(){
        return view('frontEnd.travel');
    }
     public function travels(Request $request){
        //    echo'<pre>';print_r($request->all());exit;

    try {

        Travels::create([
            
            'location' => $request->location,
            'date' => $request->date,
            'comments' => $request->comments,
            'email'=> $request->email,
            
        ]);

        return redirect()->back()
            ->with('success', ' submitted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
     }
    
    }


      public function network(){
        return view('frontEnd.Network');
    }
     public function networks(Request $request)
    {
        //    echo'<pre>';print_r($request->all());exit;

    try {

        Network::create([
            
            'location' => $request->location,
            'comments' => $request->comments,
            'email'=> $request->email,
            
        ]);

        return redirect()->back()
            ->with('success', ' submitted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
     }
    
    }
      public function sports(Request $request) {
        //   echo'<pre>';print_r($request->all());exit;

 try {

        Sports::create([
            'type' => $request->type,
            'date' => $request->date,
            'comments' => $request->comments,
            
        ]);

        return redirect()->back()
            ->with('success', ' submitted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
     }
    
    }
    
    public function booking(Request $request)
{
     try {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'game' => 'required',
        'subGame' => 'required',
    ]);

    Booking::create([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'game'    => $request->game,
        'subGame' => $request->subGame,
        'message' => $request->message,
    ]);

     return redirect()->back()
            ->with('success', ' submitted successfully.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'An error occurred: ' . $e->getMessage());
     }
}
    
}
