<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Mt5_account;
use App\Models\League;
use App\Models\Categorie;
use App\Models\Leagueprizes;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use Helper;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Services\MailService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Models\account_type;
use App\Models\Leaderboardrank;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class TournamentController extends Controller
{
    private $uploadPath = "uploads/settings/";
	protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->middleware('auth');
		$this->mailService = $mailService;
    }
    
    public function createSlug($string) {
		$slug = strtolower($string);
		$slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
		$slug = preg_replace('/[\s-]+/', '-', $slug);
		$slug = trim($slug, '-');		
		return $slug;
	}
	
	public function categorylist(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$categories = Categorie::with('parent')->orderBy('id', 'desc')->paginate(5);

		$parentcat = Categorie::where('parent_id',0)->orderby('id','asc')->get();

		
		
		return view("dashboard.tournament.category", compact('GeneralWebmasterSections','categories','parentcat'));		
	}
	 public function getMt5Groups(Request $request)
{
    $serverId = $request->server_id;

    // Fetch groups for selected server
    $groups = account_type::where('mt5_server_id', $serverId)
                ->select('ac_index', 'ac_group') // Adjust 'group_name' to your column in account_type
                ->get();

    return response()->json($groups);
}

	public function categoriesstore(Request $request)
    {
		$slugval = $this->createSlug($request->catname);
		if($request->id) {
            $category     = Categorie::findOrFail($request->id);
			$message = 'Category updated successfully';
        } else {
            $category     = new Categorie();
			$category->created_at = now();
			$message = 'Category added successfully';
        }		
		$category->catname = $request->catname;
        $category->slug = $slugval;
        $category->registerstartDate = $request->registerstartDate;
        $category->eventstartDate = $request->eventstartDate;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status ?? 0;
        $category->updated_at = now();
        $category->save();
		return redirect()->back()->with('success', $message);
		
    }
		public function catnameexit(Request $request){
			$exists = Categorie::where('catname', $request->catname)
						->when($request->id, fn($q) => $q->where('id', '!=', $request->id))
						->exists();

			return response()->json(['exists' => $exists]);
		}
    public function categorydelete($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
	public function leaguelist(Request $request){
     $leagues = League::with(['category', 'subcategory', 'mt5Server'])->get();

		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.tournament.list", compact('GeneralWebmasterSections','leagues'));		
	}
	public function leaguecreate(Request $request){
     
         
		 $catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get();
		 $mt5server = Mt5_account::get();
		 $mt5group = '';
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.tournament.create", compact('GeneralWebmasterSections','catgorylist','mt5server'));		
	}
 public function leaguesave(Request $request)
    {
        // Validate input
        // $request->validate([
        //     'categoryid' => 'required|exists:categories,id',
        //     'subcategoryid' => 'required|exists:categories,id',
        //     'leagurTitle' => 'required|string|max:255',
        //     'leagurEntryfees' => 'required|numeric',
        //     'leagurStartdate' => 'required|date',
        //     'leagurEnddate' => 'required|date',
        //     'leagurtotPartic' => 'required|integer',
        //     'leagurImage' => 'required|image|max:2048',
        //     'mt5_server_id' => 'required',
        //     'mt5_company_name' => 'required|string',
        //     'mt5_server_ip' => 'required|string',
        //     'mt5_server_port' => 'required|string',
        //     'mt5_server_web_login' => 'required|string',
        //     'mt5_server_web_password' => 'required|string',
        // ]);

        // Upload image
        $imagePath = null;
       
		 if ($request->hasFile('leagurImage')) {
        $file = $request->file('leagurImage');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = base_path('../uploads/league');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $file->move($destinationPath, $fileName);
        $imagePath = 'uploads/league/' . $fileName;
    }
    
    if ($request->hasFile('league_certificate')) {
    $file = $request->file('league_certificate');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $destinationPath = base_path('../uploads/league_certificate');
    
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0755, true);
    }

    $file->move($destinationPath, $fileName);
    $imagecerficate = 'uploads/league_certificate/' . $fileName;
}
//  echo'<pre>';print_r($request->all());exit;
          // Save League
    $league = new League();
    $league->categoryid        = $request->categoryid;
    $league->subcategoryid     = $request->subcategoryid;
    $league->leagurTitle       = $request->leagurTitle;
    $league->leagurEntryfees   = $request->leagurEntryfees;
    $league->leagurStartdate   = $request->leagurStartdate;
    $league->leagurEnddate     = $request->leagurEnddate;
    $league->leagurtotPartic   = $request->leagurtotPartic;
    $league->leagurImage       = $imagePath;
    $league->league_certificate       = $imagecerficate;
    $league->description       = $request->description;
    $league->privacydescription = $request->privacydescription;
    $league->rulesdescription   = $request->rulesdescription;
    $league->Mt5groupid        = $request->Mt5groupid;
    $league->leaderboard_option = $request->leaderboard_option;
	$league->status = $request->status;
	

    // MT5 details
   if ($request->mt5_server_id === 'new') {
    // Create a new MT5 server
    $mt5server = new Mt5_account();
	$mt5server->company_title         = $request->company_title;
    $mt5server->mt5_company_name        = $request->mt5_company_name;
    $mt5server->mt5_server_ip           = $request->mt5_server_ip;
    $mt5server->mt5_server_port         = $request->mt5_server_port;
    $mt5server->mt5_server_web_login    = $request->mt5_server_web_login;
    $mt5server->mt5_server_web_password = $request->mt5_server_web_password;
	$mt5server->created_by = Auth::id();
	$mt5server->status = 1;
    $mt5server->save();

    // Assign the new id to the league
    $league->mt5_server_id = $mt5server->id;
} else {
    // Use existing integer id (or null if not provided)
    $league->mt5_server_id = !empty($request->mt5_server_id) ? (int)$request->mt5_server_id : null;
}

    $league->save();
        return redirect()->route('leaguelist')->with('success', 'League created successfully!');
    }
	public function getSubcat(Request $request)
{
    $categoryId = $request->catid;
    $subcategories = Categorie::where('parent_id', $categoryId)->get();
    return response()->json($subcategories);
}
public function edit($id)
    {
		// echo'<pre>';print_r('yes');exit;
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
        $league = League::findOrFail($id);
        $catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get(); // your categories
        $subcategorylist = Categorie::where('parent_id', $league->categoryid)->get();
        $mt5server = Mt5_account::all(); // your MT5 servers
		$mt5groups = account_type::get();

        return view('dashboard.tournament.edit', compact('league', 'catgorylist', 'subcategorylist', 'mt5server','mt5groups','GeneralWebmasterSections'));
    }

    // Update league
    public function update(Request $request, $id)
    {
        $league = League::findOrFail($id);
    
       
        // If MT5 server is new, insert a record and get its ID
        if ($request->mt5_server_id === 'new') {
            $mt5server = new Mt5_account();
    	$mt5server->company_title         = $request->company_title;
        $mt5server->mt5_company_name        = $request->mt5_company_name;
        $mt5server->mt5_server_ip           = $request->mt5_server_ip;
        $mt5server->mt5_server_port         = $request->mt5_server_port;
        $mt5server->mt5_server_web_login    = $request->mt5_server_web_login;
        $mt5server->mt5_server_web_password = $request->mt5_server_web_password;
    	$mt5server->created_by = Auth::id();
        $mt5server->save();
    
            $league->mt5_server_id = $mt5server->id; // assign the new server id
        } else {
            $league->mt5_server_id = $request->mt5_server_id;
        }
    
        // Fill other fields
        $league->categoryid = $request->categoryid;
        $league->subcategoryid = $request->subcategoryid;
        $league->leagurTitle = $request->leagurTitle;
        $league->leagurEntryfees = $request->leagurEntryfees;
        $league->leagurStartdate = $request->leagurStartdate;
        $league->leagurEnddate = $request->leagurEnddate;
        $league->leagurtotPartic = $request->leagurtotPartic;
        $league->description = $request->description;
        $league->privacydescription = $request->privacydescription;
        $league->rulesdescription = $request->rulesdescription;
        $league->status = $request->status;
        $league->leaderboard_option = $request->leaderboard_option;
        $league->Mt5groupid = $request->Mt5groupid;
    
        
    	 $imagePath = null;
           
    		 if ($request->hasFile('leagurImage')) {
            $file = $request->file('leagurImage');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../uploads/league');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $imagePath = 'uploads/league/' . $fileName;
    		$league->leagurImage =  $imagePath ;
        }
         if ($request->hasFile('league_certificate')) {
            $file = $request->file('league_certificate');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../uploads/league_certificate');
        
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
        
            $file->move($destinationPath, $fileName);
            $imagePath = 'uploads/league_certificate/' . $fileName;
        
            $league->league_certificate = $imagePath;
        }
        
    
        $league->save();
    
        return redirect()->route('leaguelist')->with('success', 'League updated successfully.');
    }
    
    /*Manual Leader Board Manage*/
	public function leaderranklist(Request $request){
		$leaderrank = DB::table('leaderboards as lb')
			->join('users as u', 'u.id', '=', 'lb.userid')
			->join('countries as c', 'c.id', '=', 'u.nationalities')
			->join('leagues as le', 'le.id', '=', 'lb.tournament_id')
			->join('categories as mcat', 'mcat.id', '=', 'lb.categoryid')
			->join('categories as scat', 'scat.id', '=', 'lb.subcategoryid')
			->select('u.id as userid', 'u.name', 'u.email as usemail', 'u.country_code', 'u.phone', 'u.profile_image', 'lb.*', 'c.title_en AS country', 'c.code AS ccode', 'le.leagurTitle', 'mcat.catname', 'scat.catname as subcatname', 'lb.tradeid')
			->orderBy('lb.id', 'desc')			
			->get();
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.leaderrank.list", compact('GeneralWebmasterSections','leaderrank'));		
	}
	public function leaderrankcreate(Request $request){
		$catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get();
		$leaderuser = User::where('user_type',5)->orderby('id','desc')->get();
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.leaderrank.create", compact('GeneralWebmasterSections', 'catgorylist', 'leaderuser' ));	
	}	
	public function getTournament(Request $request){
		$categoryId = $request->catid;
		$subcategoryId = $request->subcategoryId;
		$league = League::where('categoryid', $categoryId)->where('subcategoryId', $subcategoryId)->where('status', 1)->get();
		return response()->json($league);
	}
	public function getTournamentuser(Request $request){
		$tournamentId = $request->tournamentId;
		$users = DB::table('tournament_liveaccount as li')
			->join('users as u', 'u.email', '=', 'li.email')
			->select('u.id', 'u.name', 'u.email', 'li.trade_id')
			->where('li.tournament_id', $request->tournamentId)
			->get();
		return response()->json($users);
	}
	
	public function getliveaccountbalance(Request $request){
		$tradeid = $request->tradeid;
		$trade = DB::table('tournament_liveaccount as li')
			->join('users as u', 'u.email', '=', 'li.email')
			->select('u.id as userid', 'li.trade_id', 'li.balance')
			->where('li.trade_id', $request->tradeid)
			->first();
		return response()->json($trade);
	}
	
	public function leaderrankedit($id)
    {
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$leaderboard = Leaderboardrank::findOrFail($id);
        $catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get();
		$subcategories = Categorie::where('id', $leaderboard->subcategoryid)->first();
		$league = League::where('id', $leaderboard->tournament_id)->first();
		$leaderuser = User::where('user_type',5)->orderby('id','desc')->get();
		
        return view('dashboard.leaderrank.edit', compact('GeneralWebmasterSections', 'leaderboard', 'catgorylist', 'subcategories', 'league', 'leaderuser'));
    }
	
	public function storeleaderrank(Request $request){
		
		$request->validate([
            'userid'        => 'required|integer',
            'categoryid'    => 'required|integer',
            'subcategoryid' => 'required|integer',
            'tournament_id' => 'required|integer',            
            'balance'       => 'required|numeric|min:0',
            'equity'        => 'required|numeric|min:0',
            'profit'        => 'required|numeric',
            'status'        => 'required|in:0,1'
        ]);
		
		$leaderboard = new Leaderboardrank();
        $leaderboard->userid        = $request->userid;
        $leaderboard->categoryid    = $request->categoryid;
        $leaderboard->subcategoryid = $request->subcategoryid;
        $leaderboard->tournament_id = $request->tournament_id;
        $leaderboard->tradeid       = 0;
        $leaderboard->balance       = $request->balance;
        $leaderboard->equity        = $request->equity;
        $leaderboard->profit        = $request->profit;
        $leaderboard->status        = $request->status;
        $leaderboard->save();
		
		return redirect()->route('leaderranklist')->with('success', 'Leader rank data added successfully.');
	}
	
	public function leaderrankupdate(Request $request, $id)
    {
        $request->validate([
			'userid'        => 'required|integer',
			'categoryid'    => 'required|integer',
			'subcategoryid' => 'required|integer',
			'tournament_id' => 'required|integer',			
			'balance'       => 'required|numeric|min:0',
			'equity'        => 'required|numeric|min:0',
			'profit'        => 'required|numeric',
			'status'        => 'required|in:0,1'
		]);

        $leaderboard = Leaderboardrank::findOrFail($id);
        $leaderboard->userid        = $request->userid;
        $leaderboard->categoryid    = $request->categoryid;
        $leaderboard->subcategoryid = $request->subcategoryid;
        $leaderboard->tournament_id = $request->tournament_id;
        $leaderboard->tradeid       = 0;
        $leaderboard->balance       = $request->balance;
        $leaderboard->equity        = $request->equity;
        $leaderboard->profit        = $request->profit;
        $leaderboard->status        = $request->status;
        $leaderboard->save();

        return redirect()->route('leaderranklist')->with('success', 'Leaderboard entry updated successfully.');
    }
    
    /*Prize List*/
	public function leagueprizelist(Request $request){
		$leagueprize = Leagueprizes::from('leagueprizes as lp')
			->join('leagues as le', 'le.id', '=', 'lp.tournament_id')
			->join('categories as mcat', 'mcat.id', '=', 'lp.categoryid')
			->join('categories as scat', 'scat.id', '=', 'lp.subcategoryid')
			->select(
				'lp.*',
				'le.leagurTitle',
				'le.leagurImage',
				'mcat.catname',
				'scat.catname as subcatname'
			)
			->orderBy('lp.id', 'desc')
			->get();
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.leagueprize.list", compact('GeneralWebmasterSections','leagueprize'));		
	}
	
	public function leagueprizecreate(Request $request){
		$catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get();
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.leagueprize.create", compact('GeneralWebmasterSections', 'catgorylist'));	
	}

	public function leagueprizestore(Request $request){
		
		$request->validate([
			'categoryid'    => 'required',
			'subcategoryid' => 'required',
			'tournament_id' => 'required',			
			'rank'          => 'required|array',
			'prize'         => 'required|array',
		]);

		// Combine rank and prize into array
		$prizes = [];
		foreach ($request->rank as $key => $rank) {
			$prizes[] = [
				'rank'  => $rank,
				'value' => $request->prize[$key] ?? 0,
			];
		}

		// Save
		$leaguePrize = new Leagueprizes();
		$leaguePrize->categoryid    = $request->categoryid;
		$leaguePrize->subcategoryid = $request->subcategoryid;
		$leaguePrize->tournament_id = $request->tournament_id;
		$leaguePrize->totalprize    = $request->totalprize;
		$leaguePrize->status        = 1;
		$leaguePrize->prizevalue    = json_encode($prizes); // store as JSON
		$leaguePrize->created_by    = auth()->id();
		$leaguePrize->updated_by    = auth()->id();
		$leaguePrize->save();

		return redirect()->route('leagueprizelist')->with('success', 'Prize added successfully');
	}
	
	public function leagueprizeedit($id)
	{
		$leaguePrize = Leagueprizes::findOrFail($id);
		$prizes = json_decode($leaguePrize->prizevalue, true);
		$catgorylist = Categorie::where('parent_id',0)->orderby('id','asc')->get();
		$subcategories = Categorie::where('id', $leaguePrize->subcategoryid)->first();
		$league = League::where('id', $leaguePrize->tournament_id)->first();
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();	
		return view('dashboard.leagueprize.edit', compact('GeneralWebmasterSections', 'leaguePrize', 'prizes', 'league', 'subcategories', 'catgorylist'));
	}
	
	public function leagueprizeupdate(Request $request, $id)
	{
		$request->validate([
			'categoryid'    => 'required',
			'subcategoryid' => 'required',
			'tournament_id' => 'required',			
			'rank'          => 'required|array',
			'prize'         => 'required|array',
		]);

		$prizes = [];
		foreach ($request->rank as $key => $rank) {
			$prizes[] = [
				'rank'  => $rank,
				'value' => $request->prize[$key] ?? 0,
			];
		}

		$leaguePrize = Leagueprizes::findOrFail($id);
		$leaguePrize->categoryid    = $request->categoryid;
		$leaguePrize->subcategoryid = $request->subcategoryid;
		$leaguePrize->tournament_id = $request->tournament_id;
		$leaguePrize->totalprize    = $request->totalprize;
		$leaguePrize->status        = 1;
		$leaguePrize->prizevalue    = json_encode($prizes);
		$leaguePrize->updated_by    = auth()->id();
		$leaguePrize->save();

		return redirect()->route('leagueprizelist')->with('success', 'Prize updated successfully');
	}
	
	public function leagueprizeresult(Request $request, $id){
		// 1. Get active league
        $activeleague = League::where('id', $id)->first();
			
        // Decide what to show
        if ($activeleague) {
            // Show active league results
            $showLeague = $activeleague;
        } elseif ($lastleague && $nextleague) {
            // No active league, show last league results + info about next league
            $showLeague = $lastleague;
        } else {
            // Fallback: just show next league
            $showLeague = $nextleague;
        }
        
        /*Account Type*/
        $accounttypeval = DB::table('account_types')
                ->where('account_types.ac_index', $showLeague->Mt5groupid)
                ->first();
				
		// 2. Get prize details for this tournament
		$leaguePrize = DB::table('leagueprizes')
				->where('tournament_id', $showLeague->id)
				->first();

		$prizeMapping = [];
		if ($leaguePrize && $leaguePrize->prizevalue) {
			$prizeMapping = collect(json_decode($leaguePrize->prizevalue, true))
							->pluck('value','rank'); // rank => value
		}
		
		if($leaguePrize){
        
            $liveaccountData = DB::table('tournament_liveaccount as tourlive')
                ->join('users as u', 'u.email', '=', 'tourlive.email')
                ->join('countries as c', 'c.id', '=', 'u.nationalities')
                ->join('account_types as accty', 'accty.ac_index', '=', 'tourlive.account_type')
                ->where('tourlive.tournament_id', $showLeague->id)
                ->select(
                    'u.userid as randuser',
                    'u.name',
                    'u.email as usemail',
                    'u.country_code',
                    'u.phone',
                    'u.profile_image',
                    'c.title_en AS country',
                    'c.code AS ccode',
                    'accty.ac_min_deposit as depositval',
                    'accty.ac_group',
                    'tourlive.*'
                )
                ->get()
                ->map(function ($row) {
                    $balance = $row->depositval ?? 0;
                    $equity  = $row->equity ?? 0;
        
                    if ($balance > 0) {
                        $profit = (($equity - $balance) / $balance) * 100;
                    } else {
                        $profit = 0;
                    }
        
                    // prevent negative
                    $row->profit_percent = round($profit, 2);
        
                    return $row;
                })
                ->sortByDesc('profit_percent')
    			->take($leaguePrize->totalprize)
                ->values(); 
        
            // 4. Assign ranks + prize
    		$rank = 1;
    		foreach ($liveaccountData as $row) {
    			if ($row->profit_percent > 0) {
    				$row->rank = $rank;
    
    				// prize from mapping
    				$row->prize_amount = $prizeMapping[$rank] ?? 0;
    
    				$rank++;
    			} else {
    				$row->rank = null;
    				$row->prize_amount = 0;
    			}
    		}
	    } else {
	        $liveaccountData = [];
	    }
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();		
		return view("dashboard.tournament.winnerlist", compact('GeneralWebmasterSections','liveaccountData', 'showLeague'));
	}
	
	public function distributePrize(Request $request, $id){		
		DB::beginTransaction();
		try {
			$leaguePrize = Leagueprizes::where('tournament_id', $id)->first();
			if (!$leaguePrize) {
				return response()->json(['message' => 'No prize configuration found.'], 404);
			}
			
			$prizeMapping = collect(json_decode($leaguePrize->prizevalue, true))->pluck('value','rank');
			
			$winners = DB::table('tournament_liveaccount as tourlive')
				->join('users as u', 'u.email', '=', 'tourlive.email')
				->join('account_types as accty', 'accty.ac_index', '=', 'tourlive.account_type')
				->where('tourlive.tournament_id', $id)
				->select('u.id','u.email','u.name', 'tourlive.equity', 'accty.ac_min_deposit as depositval', 'tourlive.id as liveid', 'tourlive.prizeReceived as prizereceive')
				->get()
				->map(function ($row) {
					$deposit = $row->depositval; // or fetch deposit from account_types
					$row->profit_percent = ($deposit > 0)
						? round((($row->equity - $deposit) / $deposit) * 100, 2)
						: 0;
					return $row;
				})
				->sortByDesc('profit_percent')
				->take($leaguePrize->totalprize)
				->values();
				
			$rank = 1;
			foreach ($winners as $winner) {
				if ($winner->profit_percent > 0) {
					$prizeAmount = $prizeMapping[$rank] ?? 0;
					
					if($winner->prizereceive == 0){
    					// Update wallet balance					
    					$wallet = DB::table('wallets')->where('user_id', $winner->id)->first();
    					if ($wallet) {
    						// Update existing record
    						$walletUp = DB::table('wallets')
    							->where('user_id', $winner->id)
    							->update([
    								'reward_balance' => DB::raw('reward_balance + ' . (float)$prizeAmount),
    								'updated_at'     => now(),
    							]);
    					} else {
    						// Insert new record
    						DB::table('wallets')->insert([
    							'user_id'          => $winner->id,
    							'balance'          => 0,
    							'reward_balance'   => $prizeAmount,
    							'referral_balance' => 0,
    							'created_at'       => now(),
    							'updated_at'       => now(),
    						]);
    					}
						
						$livaccUp = DB::table('tournament_liveaccount')
							->where('id', $winner->liveid)
							->update([
								'prizeReceived' => 1,
								'profitpercentage' => $winner->profit_percent,
								'rank' => $rank,
								'prizeAmount' => $prizeAmount,
								'prizedistributeDate' => now(),
							]);
    					
    					WalletTransaction::create([
    						'user_id' => $winner->id,
    						'from_user_id' => 1,
    						'amount' => $prizeAmount,
    						'type' => 'credit',
    						'description' => 'Seaaion Winning Prize',
    					]);
    					
    					/*// Prepare template variables
    					$templateVars = [
    						'session' => $id,
    						'name'  => $winner->name,
    						'rank'  => $rank,
    						'prize' => $prizeAmount,
    						'deposit' => $winner->depositval,
    					];
    
    					// Send using Blade template (instead of raw)
    					$this->mailService->sendEmail(
    						'stanisamj@gmail.com',         
    						'PROFXSPORTSCLUB - 🎉 Congratulations! You Won a Prize!', 
    						[],                   
    						'emails.leaguecongurlations',
    						$templateVars
    					);*/
					}
					$rank++;
				}
			}
			/*League Update*/
			$updateleague = League::where('id', $id)
				->update([
					'price_distribute' => 1
				]);
				
			DB::commit();
			return response()->json(['message' => 'Prizes distributed successfully!']);
		} catch (\Exception $e) {
			DB::rollBack();
			return response()->json(['message' => 'Error: '.$e->getMessage()], 500);
		}
	}
}
