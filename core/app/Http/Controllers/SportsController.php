<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mail;
use Redirect;
use Helper;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Country;
use App\Models\AdminTeamBooking;
use App\Models\AdminTravelBooking;
use App\Models\AdminNetworkBooking;
use App\Models\Transactions;
use App\Models\Payment;
use App\Mail\NotificationEmail;
use App\Models\Webmail;
use App\Models\WebmasterSection;
use App\Models\WebmasterSetting;

class SportsController extends Controller
{
    public function __construct(){
    
	}
	
    public function cricket(){
        return view('frontEnd.sports.cricket.index');
    }
	
	public function football(){
        return view('frontEnd.sports.football.index');
    }
	
	public function esports(){
        return view('frontEnd.sports.esports.index');
    }
	
	public function badminton(){
        return view('frontEnd.sports.badminton.index');
    }
	
	public function tennis(){
        return view('frontEnd.sports.tennis.index');
    }
	
	public function volleyball(){
        return view('frontEnd.sports.volleyball.index');
    }
	
	public function chess(){
        return view('frontEnd.sports.chess.index');
    }
	
	public function womendivision(){
        return view('frontEnd.sports.womendivision.index');
    }
    
      public function about(){
        return view('frontEnd.about');
    }
    public function media(){
        return view('frontEnd.media');
    }
    public function blog(){
        return view('frontEnd.blog');
    }
    
      public function travel(){
        return view('frontEnd.travel');
    }
      public function Network(){
        return view('frontEnd.Network');
    }
    public function membership(){
         $countries = Country::all();
        return view('frontEnd.membership',compact('countries'));
 
    }
    public function tournaments(){
        return view('frontEnd.tournaments');
    }
    public function sports(){
        return view('frontEnd.sports.sports');
    }
     public function physicalsports(){
        return view('frontEnd.sports.physical');
    }
     public function subesports(){
        return view('frontEnd.sports.subesports');
    }
    
      public function indoorsports(){
        return view('frontEnd.sports.inoorsports');
    }
       public function detailsEvent(){
        return view('frontEnd.event.detailsevent');
    }
    
       public function event(){
        return view('frontEnd.event.mainevent');
    }
       public function upcomeingEvent(){
        return view('frontEnd.event.upcomeing');
    }
       public function pastEvent(){
        return view('frontEnd.event.pastevent');
    }
    
       public function blogEvent(){
        return view('frontEnd.blogdetails');
    }
           public function booking(){
        return view('frontEnd.booking');
    }
           public function profile(){
        return view('frontEnd.layouts.profile');
    }

    public function customer(){
        return view('frontEnd.sportsuser.login');
    }
        public function customerdashboard(){
        return view('frontEnd.sportsuser.register');
        }
        
         public function crmdashboard(){
        $user = Auth::user();

        $sportsBookingCount = 0;
        $travelBookingCount = 0;
        $networkBookingCount = 0;
        $approvedTransactionCount = 0;
        $rejectedTransactionCount = 0;
        $successTransactionCount = 0;

        if ($user) {
            $sportsBookingCount = AdminTeamBooking::where('user_id', $user->id)->count();
            $travelBookingCount = AdminTravelBooking::where('user_id', $user->id)->count();
            $networkBookingCount = AdminNetworkBooking::where('user_id', $user->id)->count();

            $approvedTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['approved'])
                ->count();

            $rejectedTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['rejected'])
                ->count();

            $successTransactionCount = Transactions::where('useremail', $user->email)
                ->whereRaw('LOWER(trans_status) = ?', ['success'])
                ->count();
        }

        $corporatePlans = $user ? Payment::where('user_id', $user->id)->latest()->get() : collect();
        $latestCorporatePlan = $corporatePlans->first();

        return view('crm.dashboard', compact(
            'sportsBookingCount',
            'travelBookingCount',
            'networkBookingCount',
            'approvedTransactionCount',
            'rejectedTransactionCount',
            'successTransactionCount',
            'corporatePlans',
            'latestCorporatePlan'
        ));
        }  
         public function crmevent(){
        return view('crm.Events');
        } 
         public function crmports(){
        return view('crm.Sports');
        }  
        public function crmtems(){
        return view('crm.teams');
        } 

         public function crmleaderboard(){
        return view('crm.Leaderboard');
        } 
          public function crmaccount(){
        return view('crm.Account');
        } 
          public function crmcorporate(){
        $user = Auth::user();
        $corporatePlans = collect();
        if ($user) {
            $corporatePlans = Payment::where('user_id', $user->id)->latest()->get();
        }
        return view('crm.Corporate', compact('corporatePlans'));
        }
}
