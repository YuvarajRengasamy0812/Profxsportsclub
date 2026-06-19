<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\WebmasterSection;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\Walletwithdraw;
use App\Services\ReferralService;
use App\Services\CertificateService;
use App\Services\MailService;
class PaymentController extends Controller
{
    
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     	protected $mailService;
    public function __construct(MailService $mailService)
    {

        $this->mailService = $mailService;
    }
    public function index(Request $request){
		$pagetitle = "Pending Approval";
		$transquery = Transactions::from('transactions as trans')
			->select('trans.*', 'u.id as uid', 'u.email as uemail')
			->leftJoin('users as u', 'u.email', '=', 'trans.useremail');
			

		// Filters
		if ($request->get('type') === 'register') {
			$transquery->where('trans_purpose', 'register')->where('trans.trans_status', '=', 'pending');
			$pagetitle = "Register Pending Approval";			
		}

		if ($request->get('type') === 'deposit') {
			$transquery->where('trans_purpose', 'deposit')->where('trans.trans_status', '=', 'pending');
			$pagetitle = "Deposit Pending Approval";	
		}
		
		if ($request->get('type') === 'internal') {
			$transquery->where('trans_purpose', 'Internal Transfer');
			$pagetitle = "Internal Transfer Transcations";	
		}
		
		if($request->get('type') === 'all'){
			$transquery->where('trans.trans_status', '=', 'approved')->whereNotIn('trans_purpose', ['Internal Transfer']);
			$pagetitle = "All Transcations";	
		}
		
		$transactions = $transquery->orderBy('trans.id', 'desc')
        ->paginate(config('smartend.backend_pagination'));
		
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view("dashboard.PaymentApproval.list", compact("transactions", "GeneralWebmasterSections", 'pagetitle'));
		
    }
	
    public function show($id)
    {
        $transaction = Transactions::with('user')->findOrFail($id);
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.PaymentApproval.show', compact('transaction','GeneralWebmasterSections'));
    }
 public function approve(Request $request, $id,ReferralService $referralService,CertificateService $certificateService)
    {
        $request->validate([
            'trans_adminremark' => 'required|string|max:500',
        ]);

        $transaction = Transactions::findOrFail($id);
        $transaction->update([
            'trans_status' => 'approved',
            'trans_adminremark' => $request->trans_adminremark,
        ]);
        if ($transaction->useremail){
            $user = User::where('email', $transaction->useremail)->first();
            if ($user) {
				$desccommt = "Deposit Amount";
                if($user->payment_status == 0){
					$user->update([
						'payment_status' => 1,
					]);
					$referralService->distributeRegistrationCommission($user->id, $user->name,$transaction->trans_amount );
					$desccommt = "Register Amount";					
				}
				
				$wallet = Wallet::firstOrCreate(['user_id' => $user->id], ['balance' => 0]);
				$wallet->increment('balance', $transaction->trans_amount);
				WalletTransaction::create([
					'user_id' => $user->id,
					'from_user_id' => $user->id,
					'amount' => $transaction->trans_amount,
					'type' => 'credit',
					'description' => $desccommt,
				]);
				
				
                $certificatePath = $certificateService->generateCertificate($user->name, now()->format('d-m-Y'));
                 //dd($certificatePath);
                 $file_path ="https://profxsportsclub.com/".$certificatePath;
                // dd($file_path);
                                $user->update([
                    'certificate_path' => $certificatePath
                ]);
				$approvedTemplateVars = [
                'name'        => $user->name,
                'server_name' => 'PROFXSPORTSCLUB',
                'site_link'   => 'https://profxsportsclub.com/',
                'email'       => $user->email,
                'amount'      => $paymentAmount ?? null,
                'file_path'   => $file_path  // optional
            ];
            $this->mailService->sendEmail(
                $user->email,
                'Payment Confirmation – PROFXSPORTSCLUB',   // Subject
                [],
                'emails.approvedmail',                   // Blade template
                $approvedTemplateVars
            );
            }
        }
        return redirect()->back()->with('doneMessage', 'Transaction approved successfully.');
    }
    public function approvewallet(Request $request, $id)
    {
        $request->validate([
            'trans_adminremark' => 'required|string|max:500',
        ]);
        

       $data = Transactions::findOrFail($id);
        
        $data->update([
            'status' => 1, 
            'transaction_remarks' => $request->trans_adminremark,
        ]);
       
              $user = User::where('id',$data->user_id)->first(); 
				$approvedTemplateVars = [
                'name'        => $user->name,
                'server_name' => 'PROFXSPORTSCLUB',
                'site_link'   => 'https://profxsportsclub.com/',
                'email'       => $user->email,
                'amount'      => $data->withdraw_amount ?? null,
                'file_path'   => ''  // optional
            ];
            
           
            $this->mailService->sendEmail(
                $user->email,
                'Booking Slot  Confirmation – PROFXSPORTSCLUB',  
                [],
                'emails.approvedmail',                   
                $approvedTemplateVars
            );
            
        
        return redirect()->back()->with('doneMessage', 'Transaction approved successfully');
    }

    public function reject(Request $request, $id)
{
    $request->validate([
        'trans_adminremark' => 'required|string|max:500',
    ]);

    $transaction = Transactions::findOrFail($id);

    $transaction->update([
        'trans_status' => 'rejected',
        'trans_adminremark' => $request->trans_adminremark,
    ]);

    return redirect()->back()
        ->with('doneMessage', 'Transaction rejected successfully.');
}
    
    public function walletwithdraw(Request $request)
    {
		$pagetitle = "Pending Approval";
		$withdrawquery = Walletwithdraw::from('wallet_withdraws as ww')
			->select('ww.*', 'u.id as uid', 'u.email as useremail')
			->leftJoin('users as u', 'u.id', '=', 'ww.user_id')
			->leftJoin('bankdetails as bd', 'bd.id', '=', 'ww.withdraw_account');

		// Filters
		if ($request->get('type') === 'withdraw') {
			$withdrawquery->where('ww.status', 0);
			$pagetitle = "Withdrawal Pending Approval";			
		}
		
		if($request->get('type') === 'all'){			
			$pagetitle = "All Withdrawal";
		}
		
		$transactions = $withdrawquery->orderBy('ww.id', 'desc')
        ->paginate(config('smartend.backend_pagination'));
		
		$GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view("dashboard.PaymentApproval.withdrawlist", compact("pagetitle", "transactions","GeneralWebmasterSections"));
	}
	
	public function walletwithdrawshow($id)
    {
       
        $withdraw = Walletwithdraw::with('user')->findOrFail($id);
	
// 	echo'<pre>';print_r($withdraw);exit;
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        return view('dashboard.PaymentApproval.show', compact('withdraw','GeneralWebmasterSections'));
    }
}