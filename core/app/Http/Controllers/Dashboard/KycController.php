<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kyc;
use App\Models\WebmasterSection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class KycController extends Controller
{
    
  public function index()
    {
        
       $perPage = 10;
        $currentPage = request()->get('page', 1);
    
        // Get all KYC records
        $kycRaw = kyc::orderBy('created_at', 'desc')->get();
    
        // Group by email and merge kyc_type
        $grouped = $kycRaw->groupBy('email')->map(function($items) {
            return (object)[
                'id' => $items->first()->id,
                'userid' => $items->first()->userid,
                'email' => $items->first()->email,
                'kyc_type' => $items->pluck('kyc_type')->implode(','),
                'status' => $items->first()->status,
                'adminremark' => $items->first()->adminremark,
            ];
        })->values();

    // Manual pagination
    $total = $grouped->count();
    $kyc = new LengthAwarePaginator(
        $grouped->forPage($currentPage, $perPage),
        $total,
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    $GeneralWebmasterSections = WebmasterSection::where('status', 1)
        ->orderby('row_no', 'asc')->get();

    return view("dashboard.KYC.list", compact('kyc','GeneralWebmasterSections'));
       
    }
    // Approve KYC
    // public function approve($id)
    // {
        
    //     $GeneralWebmasterSections = WebmasterSection::where('status', 1);
    //     $user = User::findOrFail($id);
    //     if ($user->kyc_status == 0) {
    //         $user->kyc_status = 1;
    //         $user->save();

    //         return redirect()->back()->with('doneMessage', 'KYC approved successfully.');
    //     }

    //      return redirect()->back()->with('doneMessage', 'KYC cannot be approved.');
    // }

    // // Reject KYC
    // public function reject($id)
    // {
        
    //     $GeneralWebmasterSections = WebmasterSection::where('status', 1);
    //     $user = User::findOrFail($id);
    //     if ($user->kyc_status == 0) {
    //         $user->kyc_status = 2;
    //         $user->save();

    //          return redirect()->back()->with('doneMessage', 'KYC rejected successfully.');
    //     }

    //      return redirect()->back()->with('doneMessage', 'KYC cannot be rejected.');
    // }
     public function show($id)
    {
    
        $Users = User::findOrFail($id);
         // General for all pages
       $GeneralWebmasterSections = WebmasterSection::where('status', 1);
        // General END
        return view('dashboard.users.kyc', compact('Users','GeneralWebmasterSections'));
    }
    
        public function viewKyc($userId)
        {
            // Fetch all KYC records for this user
            $kycRecords = Kyc::where('userid', $userId)->get();
       
            // General webmaster sections if needed
            $GeneralWebmasterSections = WebmasterSection::where('status', 1)
                ->orderby('row_no', 'asc')->get();
        
            return view('dashboard.KYC.show', compact('kycRecords','userId','GeneralWebmasterSections'));
        }
        public function approveKyc(Request $request, $id)
        {
           // Get all KYC records of the user
                $kycRecords = Kyc::where('userid', $id)->where('status', 0)->get();
            
                if($kycRecords->isEmpty()) {
                    return redirect()->back()->with('errorMessage', 'No pending KYC found.');
                }
            
                // Approve all KYC records
                foreach($kycRecords as $kyc) {
                    $kyc->adminremark = $request->adminremark;
                    $kyc->status = 1; // approved
                    $kyc->approvedby = auth()->id();
                    $kyc->save();
                }
            
                // Update user's kyc_status
                $user = User::findOrFail($id);
                $user->kyc_status = 1;
                $user->save();
            
                return redirect()->back()->with('doneMessage', 'KYC records approved successfully.');
        }
        
        public function rejectKyc(Request $request, $id)
        {
            
             $kycRecords = Kyc::where('userid', $id)->where('status', 0)->get();
            
                if($kycRecords->isEmpty()) {
                    return redirect()->back()->with('errorMessage', 'No pending KYC found.');
                }
            
                // Approve all KYC records
                foreach($kycRecords as $kyc) {
                    $kyc->adminremark = $request->adminremark;
                    $kyc->status = 2; // approved
                    $kyc->approvedby = auth()->id();
                    $kyc->save();
                }
                
             // Update user's kyc_status
                $user = User::findOrFail($id);
                $user->kyc_status = 2;
                $user->save();
            
            $GeneralWebmasterSections = WebmasterSection::where('status', 1);
              return redirect()->back()->with('errorMessage',  'KYC rejected');
         
        }
}

