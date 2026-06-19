<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\Paymentgateway;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class LeaguecrmController extends Controller
{
    // Define Default Settings ID
    private $uploadPath = "uploads/settings/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (!@Auth::user()->permissionsGroup->settings_status || !Helper::GeneralWebmasterSettings("settings_status")) {
            return Redirect::to(route('NoPermission'))->send();
        }

        \Session()->forget('_Loader_Web_Settings');

    }

    public function payments()
    {
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
		$id = 1;
        $paygateway = Paymentgateway::find($id);
        if (!empty($paygateway)) {
            return view("dashboard.paymentsetting.payment", compact("paygateway", "GeneralWebmasterSections"));
        } else {
            return redirect()->route('adminHome');
        }
    }
	
	public function paymentsettingsUpdate(Request $request)
    {
		$id = 1;
        $paygateway = Paymentgateway::find($id);
		if(!empty($paygateway)) {
			
			if($request->payment_type == 'nowpay'){
				
				$request->validate([
					'nowpayment_api'      => 'required|string|max:255',
					'nowpayment_security' => 'required|string|max:255',
					'nowpayment_status'   => 'required|boolean',
					'nowpayment_logo'     => $paygateway->nowpayment_logo
												? 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:1024'
												: 'required|image|mimes:jpg,jpeg,png,svg,gif|max:1024'
				]);
				
				if ($request->hasFile('nowpayment_logo')) {
					if (!empty($paygateway->nowpayment_logo) && File::exists(asset('uploads/payment/' . $paygateway->nowpayment_logo))) {
						File::delete(asset('uploads/payment/' . $paygateway->nowpayment_logo));
					}
					$fileNamenow = time() . '.' . $request->nowpayment_logo->extension();
					$request->nowpayment_logo->move(asset('uploads/payment'), $fileNamenow);
					$paygateway->nowpayment_logo = $fileNamenow;
				}
				$paygateway->nowpayment_api = $request->nowpayment_api;
				$paygateway->nowpayment_security = $request->nowpayment_security;
				$paygateway->nowpayment_status = $request->nowpayment_status;
			}
			
			if($request->payment_type == 'stripe'){
				$request->validate([
					'stripe_type'      => 'required',
					'stripe_apikey'      => 'required|string|max:255',
					'stripe_publishedkey' => 'required|string|max:255',
					'stripe_status'   => 'required|boolean',
					'stripe_logo'     => $paygateway->stripe_logo
												? 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:1024'
												: 'required|image|mimes:jpg,jpeg,png,svg,gif|max:1024'
				]);
				
				if ($request->hasFile('stripe_logo')) {
					if (!empty($paygateway->stripe_logo) && File::exists(base_path('uploads/payment/' . $paygateway->stripe_logo))) {
						File::delete(base_path('uploads/payment/' . $paygateway->stripe_logo));
					}
					$fileNamenow = time() . '.' . $request->stripe_logo->extension();
					$request->stripe_logo->move(base_path('uploads/payment'), $fileNamenow);
					$paygateway->stripe_logo = $fileNamenow;
				}
				$paygateway->stripe_type = $request->stripe_type;
				$paygateway->stripe_apikey = $request->stripe_apikey;
				$paygateway->stripe_publishedkey = $request->stripe_publishedkey;
				$paygateway->stripe_status = $request->stripe_status;
			}
			
			$paygateway->created_by = Auth::user()->id;
			$paygateway->updated_by = Auth::user()->id;
            $paygateway->save();
			
            return redirect()->action('Dashboard\LeaguecrmController@payments')
                ->with('doneMessage', __('backend.saveDone'))
                ->with('active_tab', $request->active_tab);
		} else {
            return redirect()->route('adminHome');
        }
	}
	
}
