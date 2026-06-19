<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Configsetting;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use Helper;
use App\Models\Mt5_account;
use App\Models\account_type;
use App\Models\Mt5group;
use App\Models\MT5GroupCategory;
use App\MT5\MTWebAPI;
use App\Services\MT5Service;
use DB;
use App\MT5\MTRetCode;
class SettingsController extends Controller
{
    // Define Default Settings ID
    private $uploadPath = "uploads/settings/";

     protected $api;

    protected $mt5Service;

    public function __construct(MT5Service $mt5Service, MTWebAPI $api)
    {
        $this->middleware('auth');

        $this->mt5Service = $mt5Service;
        
        $this->api = $this->mt5Service->getApi();

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->settings_status || !Helper::GeneralWebmasterSettings("settings_status")) {
            return Redirect::to(route('NoPermission'))->send();
        }

        \Session()->forget('_Loader_Web_Settings');

    }

    public function edit()
    {
        //

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $id = 1;
        $Setting = Setting::find($id);
        if (!empty($Setting)) {
            return view("dashboard.settings.settings", compact("Setting", "GeneralWebmasterSections"));

        } else {
            return redirect()->route('adminHome');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id = 1 for default settings
     * @return \Illuminate\Http\Response
     */
    public function updateSiteInfo(Request $request)
    {
        //
        $id = 1;
        $Setting = Setting::find($id);
        if (!empty($Setting)) {

            $this->validate($request, [
                'style_logo_en' => 'image',
                'style_logo_ar' => 'image',
                'style_fav' => 'image',
                'style_apple' => 'image',
                'style_bg_image' => 'image',
                'style_footer_bg' => 'image',
            ]);
            foreach (Helper::languagesList() as $ActiveLanguage) {

                // Start of Upload Files
                $formFileName = "style_logo_" . $ActiveLanguage->code;
                $fileFinalName = "";
                if ($request->$formFileName != "") {
                    $this->validate($request, [
                        $formFileName => 'image'
                    ]);

                    $fileFinalName = time() . rand(1111,
                            9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->uploadPath;
                    $request->file($formFileName)->move($path, $fileFinalName);
                }

                //save file name
                if ($fileFinalName != "") {
                    // Delete a banner file
                    if ($Setting->{"style_logo_" . $ActiveLanguage->code} != "" && $Setting->{"style_logo_" . $ActiveLanguage->code} != "nologo.png") {
                        File::delete($this->uploadPath . $Setting->{"style_logo_" . $ActiveLanguage->code});
                    }

                    $Setting->{"style_logo_" . $ActiveLanguage->code} = $fileFinalName;
                }

                $Setting->{"site_title_" . $ActiveLanguage->code} = strip_tags($request->{"site_title_" . $ActiveLanguage->code});
                $Setting->{"site_desc_" . $ActiveLanguage->code} = strip_tags($request->{"site_desc_" . $ActiveLanguage->code});
                $Setting->{"site_keywords_" . $ActiveLanguage->code} = strip_tags($request->{"site_keywords_" . $ActiveLanguage->code});
                $Setting->{"contact_t1_" . $ActiveLanguage->code} = strip_tags($request->{"contact_t1_" . $ActiveLanguage->code});
                $Setting->{"contact_t7_" . $ActiveLanguage->code} = strip_tags($request->{"contact_t7_" . $ActiveLanguage->code});
            }
            $Setting->site_webmails = $request->site_webmails;
            $Setting->notify_messages_status = $request->notify_messages_status;
            $Setting->notify_comments_status = $request->notify_comments_status;
            $Setting->notify_orders_status = $request->notify_orders_status;
            $Setting->notify_table_status = $request->notify_table_status;
            $Setting->notify_private_status = $request->notify_private_status;
            $Setting->site_url = $request->site_url;


            $formFileName2 = "style_fav";
            $fileFinalName2 = "";
            if ($request->$formFileName2 != "") {
                // Delete a style_fav photo
                if ($Setting->style_fav != "" && $Setting->style_fav != "nofav.png") {
                    File::delete($this->uploadPath . $Setting->style_fav);
                }

                $fileFinalName2 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName2)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName2)->move($path, $fileFinalName2);
            }


            $formFileName3 = "style_apple";
            $fileFinalName3 = "";
            if ($request->$formFileName3 != "") {
                // Delete a style_apple photo
                if ($Setting->style_apple != "" && $Setting->style_apple != "nofav.png") {
                    File::delete($this->uploadPath . $Setting->style_apple);
                }

                $fileFinalName3 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName3)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName3)->move($path, $fileFinalName3);
            }


            $formFileName4 = "style_bg_image";
            $fileFinalName4 = "";
            if ($request->$formFileName4 != "") {
                // Delete a style_bg_image photo
                if ($Setting->style_bg_image != "") {
                    File::delete($this->uploadPath . $Setting->style_bg_image);
                }

                $fileFinalName4 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName4)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName4)->move($path, $fileFinalName4);
            }


            $formFileName5 = "style_footer_bg";
            $fileFinalName5 = "";
            if ($request->$formFileName5 != "") {
                // Delete a style_footer_bg photo
                if ($Setting->style_footer_bg != "" && $Setting->style_footer_bg != "footer-bg.webp") {
                    File::delete($this->uploadPath . $Setting->style_footer_bg);
                }

                $fileFinalName5 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName5)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName5)->move($path, $fileFinalName5);
            }

            // End of Upload Files
            if ($fileFinalName2 != "") {
                $Setting->style_fav = $fileFinalName2;
            }
            if ($fileFinalName3 != "") {
                $Setting->style_apple = $fileFinalName3;
            }

            $Setting->style_color1 = $request->style_color1;
            $Setting->style_color2 = $request->style_color2;
            $Setting->style_color3 = $request->style_color3;
            $Setting->style_color4 = $request->style_color4;
            $Setting->style_type = ($request->style_type) ? 1 : 0;
            $Setting->style_change = ($request->style_change) ? 1 : 0;
            $Setting->style_bg_type = $request->style_bg_type;
            $Setting->style_bg_pattern = $request->style_bg_pattern;
            $Setting->style_bg_color = $request->style_bg_color;
            if ($fileFinalName4 != "") {
                $Setting->style_bg_image = $fileFinalName4;
            }
            $Setting->style_subscribe = $request->style_subscribe;
            $Setting->style_footer = $request->style_footer;
            $Setting->style_header = $request->style_header;
            if ($request->photo_delete == 1) {
                // Delete style_footer_bg
                if ($Setting->style_footer_bg != "" && $Setting->style_footer_bg != "footer-bg.webp") {
                    File::delete($this->uploadPath . $Setting->style_footer_bg);
                }

                $Setting->style_footer_bg = "";
            }

            if ($fileFinalName5 != "") {
                $Setting->style_footer_bg = $fileFinalName5;
            }
            $Setting->style_preload = $request->style_preload;
            $Setting->css = $request->css_code;
            $Setting->js = $request->js_code;
            $Setting->body = $request->body_code;

            $Setting->social_link1 = $request->social_link1;
            $Setting->social_link2 = $request->social_link2;
            $Setting->social_link3 = $request->social_link3;
            $Setting->social_link4 = $request->social_link4;
            $Setting->social_link5 = $request->social_link5;
            $Setting->social_link6 = $request->social_link6;
            $Setting->social_link7 = $request->social_link7;
            $Setting->social_link8 = $request->social_link8;
            $Setting->social_link9 = $request->social_link9;
            $Setting->social_link10 = $request->social_link10;

            $Setting->contact_t3 = $request->contact_t3;
            $Setting->contact_t4 = $request->contact_t4;
            $Setting->contact_t5 = $request->contact_t5;
            $Setting->contact_t6 = $request->contact_t6;

            $Setting->site_status = $request->site_status;
            $Setting->close_msg = $request->close_msg;


            $Setting->updated_by = Auth::user()->id;

            $Setting->save();
            return redirect()->action('Dashboard\SettingsController@edit')
                ->with('doneMessage', __('backend.saveDone'))
                ->with('active_tab', $request->active_tab);
        } else {
            return redirect()->route('adminHome');
        }
    }
	
	/*MT5 Configuration*/
	public function mt5serverlist(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$settings = Configsetting::pluck('value', 'name')->toArray();
	 $mt5accounts = Mt5_account::orderBy('id','desc')->paginate(config('smartend.backend_pagination'));
		return view("dashboard.MT5.list", compact('GeneralWebmasterSections', 'settings','mt5accounts'));		
	}

    public function mt5group(Request $request){

      $groupMains = mt5group::get();
        $AddGroup= account_type::with('server')
            ->get();
        $groupCategories = MT5GroupCategory::with('server')
            ->where('mt5_grp_cat_type', 'type')
            ->get();
         $groupTypes = mt5GroupCategory::with('server')
            ->where('mt5_grp_cat_type' ,'book')->get();

            $groupMains = mt5group::with('server')
            ->get();
         $mt5Servers = Mt5_account::orderBy('id','desc')->paginate(config('smartend.backend_pagination'));
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$settings = Configsetting::pluck('value', 'name')->toArray();
		return view("dashboard.settings.mt5group", compact(
    'GeneralWebmasterSections',
    'settings',
    'groupMains',
    'groupCategories','groupTypes','mt5Servers','AddGroup'
));		
	}
	public function mt5Groupcreate(Request $request)
{

    // echo'<pre>';print_r($request->all());exit;
    if ($request->has('groupCreation')) {
        try {
            // If group_id (ac_index) is empty => Create
            if (empty($request->input('ac_index'))) {

                $settings = Mt5_account::where('id', $request->mt5_server_id)->first();
                $this->mt5Service->connect($request->mt5_server_id);

                $ac_group = $request->input('ac_group');
                $is_exist = DB::table('account_types')
                    ->where('ac_group', $ac_group)
                    ->exists();
                if ($is_exist) {
                    return response()->json(['error' => 'Group name already exists.'], 409);
                }

                $newGroup = $this->api->GroupCreate();
                $symbol = $this->api->SymbolCreate();
                $symbol->Symbol = '*';

                $newGroup->Group = $ac_group;
                $newGroup->Commissions = 0;
                $newGroup->Symbols = [$symbol];
                $newGroup->Company = $settings->mt5_company_name;
                $newGroup->Server = 1;
                $newGroup->MarginMode = 2;
                $newGroup->LimitPositions = 0;

                $error_code = $this->api->GroupAdd($newGroup, $new_group);
                if ($error_code != MTRetCode::MT_RET_OK) {
                    return response()->json([
                        'error' => "Something went wrong. Please try again later. Code: $error_code [" . MTRetCode::GetError($error_code) . "]"
                    ], 500);
                }

                // Insert into DB
                $inquiry_status = $request->input('inquiry_status');
                $is_client_group = $inquiry_status == 2 ? 0 : $request->input('is_client_group');

                $accountTypeId = DB::table('account_types')->insertGetId([
                    'ac_type' => $request->input('ac_type'),
                    'ac_name' => $request->input('ac_name'),
                    'ac_group' => $ac_group,
                    'ac_min_deposit' => $request->input('ac_min_deposit'),
                    'ac_max_leverage' => $request->input('ac_max_leverage'),
                    'ac_spread' => $request->input('ac_spread'),
                    'ac_swap' => $request->input('ac_swap'),
                    'status' => $request->input('status'),
                    'ib_enabled' => $request->input('ib_enabled'),
                    'ac_category' => $request->input('ac_category'),
                    'ac_book_type' => $request->input('ac_book_type'),
                    'is_client_group' => $is_client_group,
                    'user_group_id' => 1,
                    'mt5_server_id' => $request->mt5_server_id,
                    'display_priority' => $request->display_priority,
                    'inquiry_status' => $inquiry_status
                ]);

                foreach (explode(",", $request->ac_max_leverage) as $lev) {
                    DB::table('leverages')->insert([
                        'account_type_id' => $accountTypeId,
                        'account_leverage' => $lev
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'Group created successfully.']);

            } else {
                // -------------------------
                // 🔹 Update Flow
                // -------------------------
                $id = $request->input('ac_index');

                $inquiry_status = $request->input('inquiry_status');
                $is_client_group = $inquiry_status == 2 ? 0 : $request->input('is_client_group');

                // Update record
                DB::table('account_types')
                    ->where('ac_index', $id)
                    ->update([
                        'ac_type' => $request->input('ac_type'),
                        'ac_name' => $request->input('ac_name'),
                        'ac_min_deposit' => $request->input('ac_min_deposit'),
                        'ac_max_leverage' => $request->input('ac_max_leverage'),
                        'ac_spread' => $request->input('ac_spread'),
                        'ac_swap' => $request->input('ac_swap'),
                        'status' => $request->input('status'),
                        'ib_enabled' => $request->input('ib_enabled'),
                        'ac_category' => $request->input('ac_category'),
                        'ac_book_type' => $request->input('ac_book_type'),
                        'is_client_group' => $is_client_group,
                        'mt5_server_id' => $request->mt5_server_id,
                        'display_priority' => $request->display_priority,
                        'inquiry_status' => $inquiry_status
                    ]);

                // Update Leverages (remove old and insert new)
                DB::table('leverages')->where('account_type_id', $id)->delete();
                foreach (explode(",", $request->ac_max_leverage) as $lev) {
                    DB::table('leverages')->insert([
                        'account_type_id' => $id,
                        'account_leverage' => $lev
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'Group updated successfully.']);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred. ' . $e->getMessage()], 500);
        }
    }

    return response()->json(['error' => 'No group creation requested.'], 400);
}
//  public function mt5Groupcreate(Request $request)
//     {
//         //  echo'<pre>';print_r($request->all());exit;
//         if ($request->has('groupCreation')) {
//             if (empty($request->input('ac_index'))) {
//                 try {
//                      $settings = Mt5_account::where('id',$request->mt5_server_id)->first();
//                   $this->mt5Service->connect($request->mt5_server_id);
//                     $ac_group = $request->input('ac_group');
//                     $is_exist = DB::table('account_types')
//                         ->where('ac_group', $ac_group)
//                         ->exists();
//                     if ($is_exist) {
//                         return response()->json(['error' => 'Group name already exists.'], 409);
//                     }
//                     $newGroup = $this->api->GroupCreate();
//                     // $symb=$this->api->SymbolGet("*",$test);
//                     // echo MTRetCode::GetError($symb);
//                     // exit();
//                     $symbol = $this->api->SymbolCreate();
//                     $symbol->Symbol = '*';
//                     $newGroup->Group = $ac_group;
//                     $newGroup->Commissions = 0;
//                     $newGroup->Symbols = [$symbol];
//                     $newGroup->Company = $settings->mt5_company_name;
//                     $newGroup->Server = 1;
//                     $newGroup->MarginMode = 2;
//                     $newGroup->LimitPositions = 0;

//                     $error_code = $this->api->GroupAdd($newGroup, $new_group);
//                     if ($error_code != MTRetCode::MT_RET_OK) {
//                         return response()->json([
//                             'error' => "Something went wrong. Please try again later. Code: $error_code [" . MTRetCode::GetError($error_code) . "]"
//                         ], 500);
//                     }
//                     // Insert group details into the database
//                     $inquiry_status=$request->input('inquiry_status');
//                     $is_client_group=$inquiry_status==2?0:$request->input('is_client_group');
                    
//                     $maxlever = explode(',', $request->input('ac_max_leverage'));
                    
//                     $accountTypeId = DB::table('account_types')->insertGetId([
//                         'ac_type' => $request->input('ac_type'),
//                         'ac_name' => $request->input('ac_name'),
//                         'ac_group' => $ac_group,
//                         'ac_min_deposit' => $request->input('ac_min_deposit'),
//                         'ac_max_leverage' => max($maxlever),
//                         'ac_spread' => $request->input('ac_spread'),
//                         'ac_swap' => $request->input('ac_swap'),
//                         'status' => $request->input('status'),
//                         'ib_enabled' => $request->input('ib_enabled'),
//                         'ac_category' => $request->input('ac_category'),
//                         'ac_book_type' => $request->input('ac_book_type'),
//                         'is_client_group' => $is_client_group,
//                         'user_group_id' => 1,
//                         'mt5_server_id'=>$request->mt5_server_id,
//                         'display_priority' => $request->display_priority,
//                         'inquiry_status'=>$inquiry_status
//                     ]);
//                     foreach (explode(",", $request->ac_max_leverage) as $lev) {
//                         DB::table('leverages')->insert([
//                             'account_type_id' => $accountTypeId,
//                             'account_leverage' => $lev
//                         ]);
//                     }
//                     return response()->json(['success' => true]);
//                 } catch (Exception $e) {
//                     dd($e);
//                     return response()->json(['error' => 'An error occurred.' . $e->getMessage()], 500);
//                 }
//             } else {
//                 return response()->json(['error' => 'Invalid input.'], 400);
//             }
//         }
//         return response()->json(['error' => 'No group creation requested.'], 400);
//     }

public function mt5groupadd(Request $request)
{
    try {
      
 
        
        if ($request->has('mt5_group_name')) {
            // =============================
            // 1. Group Main (mt5_groups)
            // =============================
            if ($request->filled('groupMain_id')) {
               
                // Update
                mt5group::where("mt5_group_id", [$request->groupMain_id])
                    ->update([
                        'mt5_group_name' => $request->mt5_group_name,
                        'mt5_group_type' => $request->mt5_group_type,
                        'mt5_group_desc' => $request->mt5_group_desc,
                        'mt5_server_id' => $request->mt5_server_id,
                        'is_active'      => $request->is_active,
                        'user_group_id'  => 1,
                        'updated_by'     => auth()->id() ?? 1,
                        'updated_at'     => now(),
                    ]);
                     
                return response()->json(['status'=>'success','message'=>'Group Main updated successfully']);
            } else {
                // Create
                mt5group::insert([
                    'mt5_group_name' => $request->mt5_group_name,
                    'mt5_group_type' => $request->mt5_group_type,
                    'mt5_group_desc' => $request->mt5_group_desc,
                    'mt5_server_id' => $request->mt5_server_id,
                    'is_active'      => $request->is_active,
                    'user_group_id'  => $request->user_group_id,
                    'updated_by'     => auth()->id() ?? 1,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
                return response()->json(['status'=>'success','message'=>'Group Main added successfully']);
            }
        }

        if ($request->has('mt5_grp_cat_name')) {
            // =============================
            // 2. Group Category (mt5_group_categories)
            // =============================
            if ($request->filled('groupCategory_id')) {
                // Update

               
                mt5GroupCategory::where("mt5_grp_cat_id", [$request->groupCategory_id])
                    ->update([
                        'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                        'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                        'mt5_grp_cat_type' => $request->mt5_grp_cat_type,
                        'is_active'        => $request->is_active,
                        'mt5_server_id' => $request->mt5_server_id,
                        // 'updated_by'       => auth()->id() ?? 1,
                        'updated_at'       => now(),
                    ]);
                return response()->json(['status'=>'success','message'=>'Group Category updated successfully']);
            } else {
                // Create
                mt5GroupCategory::insert([
                    'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                    'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                    'mt5_grp_cat_type' => $request->mt5_grp_cat_type,
                    'mt5_server_id' => $request->mt5_server_id,
                    'is_active'        => $request->is_active,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
                return response()->json(['status'=>'success','message'=>'Group Category added successfully']);
            }
        }

        if ($request->has('group_type_name')) {
            // echo'<pre>';print_r($request->all());exit;
            // =============================
            // 3. Group Type (mt5_group_types)
            // =============================
            if ($request->filled('mt5_grp_type_id')) {
                // Update
                mt5GroupCategory::where("mt5_grp_cat_id", [$request->mt5_grp_type_id])
                    ->update([
                           'mt5_grp_cat_name'    => $request->group_type_name,
                            'mt5_grp_cat_desc'    => $request->group_type_desc,
                            'mt5_grp_cat_type'=> $request->group_type_category,
                            'is_active'             => $request->is_active,
                            'mt5_server_id' => $request->mt5_server_id,
                            'created_at'         => now(),
                            'updated_at'         => now(),
                    ]);
                return response()->json(['status'=>'success','message'=>'Group Type updated successfully']);
            } else {
                // Create
                mt5GroupCategory::insert([
                    'mt5_grp_cat_name'    => $request->group_type_name,
                    'mt5_grp_cat_desc'    => $request->group_type_desc,
                    'mt5_grp_cat_type'=> $request->group_type_category,
                    'is_active'             => $request->is_active,
                    'mt5_server_id' => $request->mt5_server_id,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
                return response()->json(['status'=>'success','message'=>'Group Type added successfully']);
            }
        }

        return response()->json(['status'=>'error','message'=>'Invalid request, no matching form fields found'], 400);

    } catch (\Exception $e) {
        return response()->json(['status'=>'error','message'=>'Something went wrong: '.$e->getMessage()], 500);
    }
}

public function getmt5group(Request $request)
{
    try {
        
        // ðŸ”¹ Get Group Main
        if ($request->has('get_groupMains')) {
            $id = $request->id;

            $group = Mt5Group::whereRaw("MD5(mt5_group_id) = ?", [$id])->first();

            if ($group) {
                return response()->json($group);
            } else {
                return response()->json(['error' => 'Group Main not found'], 404);
            }
        }

        // ðŸ”¹ Get Group Category
        if ($request->has('get_groupCategories')) {
            $id = $request->id; // use id instead of mt5_grp_cat_id

            $groupCat = MT5GroupCategory::whereRaw("MD5(mt5_grp_cat_id) = ?", [$id])->first();

            if ($groupCat) {
                return response()->json($groupCat);
            } else {
                return response()->json(['error' => 'Group Category not found'], 404);
            }
        }
// echo'<pre>';print_r($request->all());exit;
        // ðŸ”¹ Get Group Type
        if ($request->has('get_groupTypes')) {
            $id = $request->mt5_grp_type_id; // passed as md5 hash
        
           $groupType = MT5GroupCategory::where("mt5_grp_cat_id", $id)
                ->where('mt5_grp_cat_type', 'book')
                ->first();
// 
            if ($groupType) {
                return response()->json($groupType);
            } else {
                return response()->json(['error' => 'Group Type not found'], 404);
            }
        }

        return response()->json(['error' => 'Invalid request'], 400);

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()
        ], 500);
    }
}
     public function mt5groupCategoryAdd(Request $request)
{
    try {

     
        if ($request->filled('mt5_grp_cat_id')) {
            // ðŸ”¹ Update existing category
            $group = MT5GroupCategory::where('mt5_grp_cat_id', $request->mt5_grp_cat_id)->first();

            if (!$group) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Group Category not found.'
                ]);
            }

            $group->update([
                'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                'mt5_grp_cat_type' => $request->mt5_grp_cat_type,
                'is_active'        => $request->is_active,
                'updated_by'       => session('alogin'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Group Category updated successfully!'
            ]);
        } else {
            // ðŸ”¹ Create new category
            
            $group = MT5GroupCategory::create([
                'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                'mt5_grp_cat_type' => $request->mt5_grp_cat_type,
                'is_active'        => $request->is_active,
                'updated_by'       => session('alogin'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Group Category created successfully!'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
}
public function mt5GroupTypeAdd(Request $request)
{
    try {
        if ($request->filled('mt5_grp_cat_id')) {
            // Update existing Group Type
            $group = MT5GroupCategory::find($request->mt5_grp_cat_id);

            if (!$group) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Group Type not found.'
                ]);
            }

            $group->update([
                'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                'mt5_grp_cat_type' => 'type', // default for Group Type
                'is_active'        => $request->is_active,
                'updated_by'       => session('alogin'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Group Type updated successfully!'
            ]);

        } else {
            // Create new Group Type
            MT5GroupCategory::create([
                'mt5_grp_cat_name' => $request->mt5_grp_cat_name,
                'mt5_grp_cat_desc' => $request->mt5_grp_cat_desc,
                'mt5_grp_cat_type' => 'type', // default
                'is_active'        => $request->is_active,
                'updated_by'       => session('alogin'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Group Type created successfully!'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
}
	public function editMt5Account($id)
{
    $GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
    $account = Mt5_account::findOrFail($id);
    return view('dashboard.MT5.edit', compact('account','GeneralWebmasterSections'));
}

public function updateMt5Account(Request $request, $id)
{
    $GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
    $account = Mt5_account::findOrFail($id);
    $account->update($request->only([
        'company_title',
        'mt5_company_name',
        'mt5_server_ip',
        'mt5_server_port',
        'mt5_server_web_login',
        'mt5_server_web_password',
        'status'
    ]));
    return redirect()->back()->with('doneMessage', 'MT5 Server updated successfully.');
   
}

public function createMt5Account()
    {
        
        $GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
        return view('dashboard.MT5.create',compact( "GeneralWebmasterSections"));
    }

    public function storeMt5Account(Request $request)
    {
        $request->validate([
            'company_title' => 'required|string|max:255',
            'mt5_company_name' => 'required|string|max:255',
            'mt5_server_ip' => 'required|string|max:50',
            'mt5_server_port' => 'required|numeric',
            'mt5_server_web_login' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $account = new Mt5_account();
        $account->company_title = $request->company_title;
        $account->mt5_company_name = $request->mt5_company_name;
        $account->mt5_server_ip = $request->mt5_server_ip;
        $account->mt5_server_port = $request->mt5_server_port;
        $account->mt5_server_web_login = $request->mt5_server_web_login;
        $account->mt5_server_web_password = $request->mt5_server_web_password;
        $account->status = $request->status;
        $account->created_by = Auth::id();
        $account->save();

       return redirect()->back()->with('doneMessage', 'MT5 Server Created successfully.');
    }

	public function smtpconfig(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$settings = Configsetting::pluck('value', 'name')->toArray();
		return view("dashboard.settings.smtp_settings", compact('GeneralWebmasterSections', 'settings'));		
	}
	
	public function platformconfig(Request $request){
		$GeneralWebmasterSections = WebmasterSection::where('status', 1)->orderby('row_no', 'asc')->get();
		$settings = Configsetting::pluck('value', 'name')->toArray();
		return view("dashboard.settings.platform_settings", compact('GeneralWebmasterSections', 'settings'));		
	}
	
	public function mt5configstore(Request $request){
		$req = $request->except(["_token", "update"]);
        foreach ($req as $key => $value) {
            Configsetting::where("name", $key)->update(["value" => $value]);
        }
		return redirect()->back()->with('doneMessage', 'Settings updated successfully');
	}

}
