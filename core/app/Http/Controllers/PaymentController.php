<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\AdminTravel;
use App\Models\TravelPlayer;
use App\Models\AdminTravelBooking;
use App\Models\AdminNetwork;
use App\Models\NetworkPlayer;
use App\Models\AdminNetworkBooking;
use App\Models\AdminTeam;
use App\Models\Player;
use App\Models\AdminTeamBooking;
use App\Models\User;
use App\Models\ReferralCommission;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\Paymentgateway;
use App\Models\PaymentLog;
use App\Models\Transactions;
use App\Models\Payment;
use Redirect;
use Helper;
use Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Services\ReferralService;
use App\Services\CertificateService;
use App\Services\MailService;
class PaymentController extends Controller
{

   protected $mailService; 
    public function __construct(MailService $mailService)
    {
		/*Get the keys and General*/
		$paygateway = Paymentgateway::find(1);
		$this->settings = $paygateway;
		 $this->mailService = $mailService;
    }

	public function paymentstore(Request $request){
    //   dd($request);
		/*Get the logged user*/
		$user = Auth::user();
        $travelId = $request->input('travel_id');     // may be null
        $networkId = $request->input('network_id');   // may be null
        $game = $request->input('game');
        $paymentPurpose = $request->input('payment_purpose');
        $sportsTeamId = $request->input('team_id');

        // Reuse network_id column to persist sports team id for payment callback flows.
        if ($paymentPurpose === 'sports' && $sportsTeamId) {
            $networkId = $sportsTeamId;
        }

		/*Payment Log*/
		$datapaymentlog = [
			"payment_purpose" => $paymentPurpose,
			"payment_amount" => $request->payment_amount,
			"payment_type" => $request->payment_gateway,
			"payment_reference_id" => "",
             "travel_id" => $travelId,
        "network_id" => $networkId,
        "game" => $game,
			"payment_status" => "Initiated",
			"initiated_by" => $user->email
		];

        if ($paymentPurpose === 'corporate' && (float) $request->payment_amount <= 0) {
            Payment::create([
                'user_id' => $user->id,
                'plan_name' => $request->input('plan_name', $game ?: 'Corporate Plan'),
                'amount' => 0,
                
                'proof' => '',
            ]);
            return redirect()->route('crmcorporate')->with('success', 'Corporate plan booked successfully.');
        }

		if($request->payment_gateway === "nowpayment"){
            $paymentLog = PaymentLog::create($datapaymentlog);
            $orderId = 'nowPay' . $paymentLog->id;
            $currency = 'USD';
            $amountval = $request->payment_amount;
            $payment = $this->createPayment($amountval, $currency, $orderId, $paymentLog->payment_id);
            if ($payment) {
                return redirect($payment['invoice_url']);
            } else {
                return redirect()->back()->with('error', 'Something went wrong in NowPayment. Please try again other Payment methods or try again later.');
            }
        }
        if($request->payment_gateway === "stripe"){
            // dd('test');
            $paymentLog = PaymentLog::create($datapaymentlog);

            $orderId = 'stripe' . $paymentLog->id;
            $currency = 'USD';
            $amountval = $request->payment_amount;
            $payment = $this->createStripePayment($amountval, $currency, $orderId, $paymentLog->payment_id);
            // dd($payment);
            if (isset($payment['url'])) {
                return redirect($payment['url']);
            } else {
                return redirect()->back()->with('error', 'Something went wrong with Stripe. Please try again.');
            }

        }

        if ($request->payment_gateway === "xyrapay") {
            // 1. Create payment log
            $paymentLog = PaymentLog::create($datapaymentlog);

            $orderId = 'xyrapay' . $paymentLog->id;
            $currency = 'USD';
            $amountval = $request->payment_amount;
            $email = $request->email;

            // 2. API endpoint
            //$url = 'https://api.paygate.to/control/wallet.php';
            $url = 'https://checkout.paygate.to/process-payment.php';

            // 3. Static address from your merchant account (replace with your wallet address)
            $address = '0x8ff69bc4e5d3a68790ea55219617d9c95933d21f';

            $address = null;
            if (isset($this->settings['xyrapay_api']) && !empty($this->settings['xyrapay_api'])) {
                $address = $this->settings['xyrapay_api'];
            }

            // 4. Callback URL
            $callback = url('/payment-confirmation?payment_id=' . md5($paymentLog->id));

            // 5. Build request URL
            $fullUrl = "$url?address=$address&callback=" . urlencode($callback);

            // 6. Save request data
            $payment_req = json_encode([
                'address'   => $address,
                'callback'  => $callback,
                'amount'    => $amountval,
                'currency'  => $currency,
                'orderId'   => $orderId
            ]);

            // 7. Call Paygate API
            $response = Http::get($fullUrl);

            if ($response->failed()) {
                // Save error
                $errorResponse = $response->body();
                $paymentLog->update(['payment_res' => $errorResponse]);
                return redirect()->back()->with('error', 'XyraPay failed: ' . $errorResponse);
            }

            // 8. Parse response
            $resp = $response->json();

            // 9. Build redirect URL (checkout page)
            $redirect_url = "https://checkout.paygate.to/pay.php"
                . "?address=" . $resp['address_in']
                . "&amount=" . $amountval
                . "&email=" . urlencode($email)
                . "&currency=$currency"
                . "&domain=checkout.paygate.to";

                // dd($redirect_url);

            // 10. Update payment log
            $paymentLog->update([
                'payment_url' => $redirect_url,
                'payment_req' => $payment_req,
                'payment_res' => $response->body(),
                'payment_status' => 'Initiated',
            ]);

            // 11. Redirect user to checkout
            return redirect($redirect_url);
        }

		if ($request->payment_gateway === "usdt")
        {
        //   dd($request);

            $validator = Validator::make($request->all(), [
                'usdt_deposit_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'usdt_deposit_proof.required' => 'Please upload your deposit proof.',
                'usdt_deposit_proof.mimes' => 'Allowed file types: jpg, jpeg, png, pdf.',
                'usdt_deposit_proof.max' => 'Maximum allowed file size is 2MB.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $validator->errors()->first('usdt_deposit_proof'));
            }

            // $depositProofPath = null;
            // if ($request->hasFile('deposit_proof')) {
            //     $file = $request->file('deposit_proof');
            //     $depositProofPath = $file->store('usdt_proofs', 'public');
            // }

            $depositProofPath = null;

            if ($request->hasFile('usdt_deposit_proof')) {
                $file = $request->file('usdt_deposit_proof');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Define the path outside core, in the project folder uploads/bank_proofs
                $destinationPath = base_path('../uploads/usdt_proofs');

                // Make sure the folder exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the uploaded file
                $file->move($destinationPath, $fileName);

                // Store relative path in DB
                $depositProofPath = 'uploads/usdt_proofs/' . $fileName;
            }


            $orderId = 'usdt' . time();

            $paymentLog = PaymentLog::create([
                "payment_purpose" => $request->payment_purpose,
                "payment_amount" => $request->payment_amount,
                "payment_type" => $request->payment_gateway,
                "payment_reference_id" => "",
                'initiated_by'    =>$user->email,
                'payment_currency'=> 'USDT',
                'payment_status'  => 'initiated',
                'travel_id'=> $request->input('travel_id'),
                'network_id' =>$request->input('network_id'),
                  'game'=> $request->input('game'),
                'payment_req'     => json_encode([
                    'amount'    => $request->payment_amount,
                    'currency'  => 'USDT',
                    'orderId'   => $orderId,
                ]),
                'deposit_proof' => $depositProofPath,
                'usdt_wallet_id' => null,
                'usdt_wallet_qr' => null,
                'payment_res'     => null
            ]);

            Transactions::create([
                'useremail'         => $paymentLog->initiated_by,
                'trans_purpose'     => $paymentLog->payment_purpose,
                'trans_amount'      => $paymentLog->payment_amount,
                'trans_currency'    => $paymentLog->payment_currency ?? 'USD',
                'trans_method'      => $paymentLog->payment_type,
                'travel_id'=> $paymentLog->travel_id,
                'network_id' =>$paymentLog->network_id,
                  'game'=> $request->input('game'),
                'trans_adminremark' => 'pending',
                'trans_status'      => 'pending',
                'payment_log_id'    => $paymentLog->payment_id,
                'deposit_proof'=> $paymentLog->deposit_proof
            ]);

    if ($request->payment_purpose === 'corporate') {
        Payment::create([
            'user_id' => $user->id,
            'plan_name' => $request->input('plan_name', $request->input('game', 'Corporate Plan')),
            'amount' => $request->payment_amount,
            'methods' => 'USDT',
            'proof' => $paymentLog->deposit_proof ?: '',
        ]);
        return redirect()->route('crmcorporate')->with('success', 'Corporate payment submitted successfully. Waiting for approval.');
    }

    $travelId = $request->input('travel_id');
    if ($request->payment_purpose === 'travel' && $travelId) {
        $travel = AdminTravel::findOrFail($travelId);

        if ($travel->status === 'full') {
            return redirect()->back()->with('error', 'Travel already full.');
        }

        if (AdminTravelBooking::where('travel_id', $travel->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this travel.');
        }

        AdminTravelBooking::create([
            'travel_id' => $travel->id,
            'user_id' => $user->id,
            'game' => $travel->game,
        ]);

        TravelPlayer::create([
            'team_id' => $travel->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $travel->increment('booked_travelers');
        if ($travel->booked_travelers >= $travel->max_travelers) {
            $travel->update(['status' => 'full']);
        }
    }

    // --- NETWORK BOOKING ---
    $networkId = $request->input('network_id');
    if ($request->payment_purpose === 'network' && $networkId) {
        $network = AdminNetwork::findOrFail($networkId);

        if ($network->status === 'full') {
            return redirect()->back()->with('error', 'Network already full.');
        }

        if (AdminNetworkBooking::where('network_id', $network->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this network.');
        }

        AdminNetworkBooking::create([
            'network_id' => $network->id,
            'user_id' => $user->id,
            'game' => $network->game,
        ]);

        NetworkPlayer::create([
            'team_id' => $network->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $network->increment('booked_networks');
        if ($network->booked_networks >= $network->max_networks) {
            $network->update(['status' => 'full']);
        }
    }

    // --- SPORTS BOOKING ---
    if ($request->payment_purpose === 'sports' && $sportsTeamId) {
        $team = AdminTeam::findOrFail($sportsTeamId);

        if ($team->status === 'full') {
            return redirect()->back()->with('error', 'Team is full.');
        }

        if (AdminTeamBooking::where('team_id', $team->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this team.');
        }

        AdminTeamBooking::create([
            'team_id' => $team->id,
            'game' => $team->game,
            'user_id' => $user->id,
        ]);

        Player::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $team->increment('booked_players');
        if ($team->booked_players >= $team->max_players) {
            $team->update(['status' => 'full']);
        }
    }

            return redirect()->route('user.dashboard')->with('success', 'Payment submitted successfully. Waiting for admin approval.');
        }

        if ($request->payment_gateway === "bank_deposit")
        {
            // dd($request);
            $validator = Validator::make($request->all(), [
            'deposit_proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'deposit_proof.required' => 'Please upload your deposit proof.',
                'deposit_proof.mimes' => 'Allowed file types: jpg, jpeg, png, pdf.',
                'deposit_proof.max' => 'Maximum allowed file size is 2MB.',
            ]);

            if ($validator->fails()) {
				return redirect()->back()
					->withInput()
					->with('error', $validator->errors()->first('deposit_proof'));
            }
            $depositProofPath = null;

            if ($request->hasFile('deposit_proof')) {
                $file = $request->file('deposit_proof');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Define the path outside core, in the project folder uploads/bank_proofs
                $destinationPath = base_path('../uploads/bank_proofs');

                // Make sure the folder exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Move the uploaded file
                $file->move($destinationPath, $fileName);

                // Store relative path in DB
                $depositProofPath = 'uploads/bank_proofs/' . $fileName;
            }


            $orderId = 'bank' . time();

            $paymentLog = PaymentLog::create([
                "payment_purpose" => $request->payment_purpose,
                "payment_amount" => $request->payment_amount,
                "payment_type" => $request->payment_gateway,
                "payment_reference_id" => "",
                'initiated_by'    =>$user->email,
                'payment_currency'=> 'USD',
                'payment_status'  => 'initiated',
                  'travel_id'=> $request->input('travel_id'),
                'network_id' =>$request->input('network_id'),
                  'game'=> $request->input('game'),
                'payment_req'     => json_encode([
                    'amount'    => $request->payment_amount,
                    'currency'  => 'USD',
                    'orderId'   => $orderId,
                ]),
                'deposit_proof' => $depositProofPath,

                'payment_res'     => null
            ]);

            Transactions::create([
                'useremail'         => $paymentLog->initiated_by,
                'trans_purpose'     => $paymentLog->payment_purpose,
                'trans_amount'      => $paymentLog->payment_amount,
                'trans_currency'    => $paymentLog->payment_currency ?? 'USD',
                'trans_method'      => $paymentLog->payment_type,
                'travel_id'=> $paymentLog->travel_id,
                'network_id' =>$paymentLog->network_id,
                  'game'=> $request->input('game'),
                'trans_adminremark' => 'pending',
                'trans_status'      => 'pending',
                'payment_log_id'    => $paymentLog->payment_id,
                'deposit_proof'=> $paymentLog->deposit_proof
            ]);

    if ($request->payment_purpose === 'corporate') {
        Payment::create([
            'user_id' => $user->id,
            'plan_name' => $request->input('plan_name', $request->input('game', 'Corporate Plan')),
            'amount' => $request->payment_amount,
            'methods' => 'Bank',
            'proof' => $paymentLog->deposit_proof ?: '',
        ]);
        return redirect()->route('crmcorporate')->with('success', 'Corporate payment submitted successfully. Waiting for approval.');
    }

    // --- TRAVEL BOOKING ---
    $travelId = $request->input('travel_id');
    if ($request->payment_purpose === 'travel' && $travelId) {
        $travel = AdminTravel::findOrFail($travelId);

        if ($travel->status === 'full') {
            return redirect()->back()->with('error', 'Travel already full.');
        }

        if (AdminTravelBooking::where('travel_id', $travel->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this travel.');
        }

        AdminTravelBooking::create([
            'travel_id' => $travel->id,
            'user_id' => $user->id,
            'game' => $travel->game,
        ]);

        TravelPlayer::create([
            'team_id' => $travel->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $travel->increment('booked_travelers');
        if ($travel->booked_travelers >= $travel->max_travelers) {
            $travel->update(['status' => 'full']);
        }
    }

    // --- NETWORK BOOKING ---
    $networkId = $request->input('network_id');
    if ($request->payment_purpose === 'network' && $networkId) {
        $network = AdminNetwork::findOrFail($networkId);

        if ($network->status === 'full') {
            return redirect()->back()->with('error', 'Network already full.');
        }

        if (AdminNetworkBooking::where('network_id', $network->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this network.');
        }

        AdminNetworkBooking::create([
            'network_id' => $network->id,
            'user_id' => $user->id,
            'game' => $network->game,
        ]);

        NetworkPlayer::create([
            'team_id' => $network->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $network->increment('booked_networks');
        if ($network->booked_networks >= $network->max_networks) {
            $network->update(['status' => 'full']);
        }
    }

    // --- SPORTS BOOKING ---
    if ($request->payment_purpose === 'sports' && $sportsTeamId) {
        $team = AdminTeam::findOrFail($sportsTeamId);

        if ($team->status === 'full') {
            return redirect()->back()->with('error', 'Team is full.');
        }

        if (AdminTeamBooking::where('team_id', $team->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this team.');
        }

        AdminTeamBooking::create([
            'team_id' => $team->id,
            'game' => $team->game,
            'user_id' => $user->id,
        ]);

        Player::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $team->increment('booked_players');
        if ($team->booked_players >= $team->max_players) {
            $team->update(['status' => 'full']);
        }
    }
            return redirect()->route('user.dashboard')->with('success', 'Payment submitted successfully. Waiting for admin approval.');
        }
	}

	private function createPayment($amount, $currency, $orderId, $paymentId)
    {
        $success_url = $this->settings['site_url'] . "payment-response?amount=" . $amount . "&payment_id=" . md5($paymentId) . "&status=success";
        $cancel_url = $this->settings['site_url'] . "payment-response?amount=" . $amount . "&payment_id=" . md5($paymentId) . "&status=cancel";
        $url = 'https://api.nowpayments.io/v1/invoice';
        $data = [
            'price_amount' => $amount,
            'price_currency' => $currency,
            'order_id' => $orderId,
            'success_url' => $success_url,
            'ipn_callback_url' => $success_url . "&forceToLoad=true",
            'cancel_url' => $cancel_url,
        ];
        $apiKey = null;
        if (isset($this->settings['nowpayment_api']) && !empty($this->settings['nowpayment_api'])) {
            $apiKey = $this->settings['nowpayment_api'];
        }
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => $apiKey,
        ])->post($url, $data);
        if ($response->successful()) {
            PaymentLog::where('payment_id', $paymentId)->update([
                'payment_req' => json_encode($data),
                'payment_url' => $response['invoice_url'],
                'remarks' => $success_url,
            ]);
            return $response->json();
        }
        return null;
    }

	public function handlePaymentResponse(Request $request, CertificateService $certificateService)
    {
        // dd($request);
        $user = Auth::user();
		$status = $request->input('status');
        $payment_id = $request->input('payment_id');
        $payment_res = json_encode($request->all());
        $paymentLog = PaymentLog::where(DB::raw('MD5(payment_id)'), $payment_id)->with('user')->first();
        if ($status == "success") {
            // Get the payment log
			if ($paymentLog && strtolower($paymentLog->payment_status) != "success") {
                // Update payment log
                $paymentLog->update([
                    'payment_res' => $payment_res,
                    'payment_status' => $status,
                ]);
                $email = $paymentLog->initiated_by;
                $amount = $paymentLog->payment_amount;
				
                Transactions::create([
                    'useremail'         => $email,
                    'trans_purpose'     => $paymentLog->payment_purpose,
                    'trans_amount'      => $amount,
                    'trans_currency'    => $paymentLog->payment_currency,
                    'trans_method'      => $paymentLog->payment_type,
                    'travel_id'=> $paymentLog->travel_id,
                'network_id' =>$paymentLog->network_id,
                  'game'=> $paymentLog->game,
                    'trans_adminremark' => 'auto approved, amount update the wallet',
                    'trans_status'      => 'approved',
                    'payment_log_id'   => $paymentLog->payment_id
                ]);

                if ($paymentLog->payment_purpose === 'corporate') {
                    $paymentUser = User::where('email', $paymentLog->initiated_by)->first();
                    if ($paymentUser) {
                        Payment::create([
                            'user_id' => $paymentUser->id,
                            'plan_name' => $paymentLog->game ?: 'Corporate Plan',
                            'amount' => $paymentLog->payment_amount,
                            'methods' => ucfirst((string) $paymentLog->payment_type),
                            'proof' => '',
                        ]);
                    }
                    return redirect()->route('crmcorporate')->with('success', 'Corporate plan activated successfully.');
                }

                    $travelId = $paymentLog->travel_id;
    if ($paymentLog->payment_purpose === 'travel' && $travelId) {
        $travel = AdminTravel::findOrFail($travelId);

        if ($travel->status === 'full') {
            return redirect()->back()->with('error', 'Travel already full.');
        }

        if (AdminTravelBooking::where('travel_id', $travel->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this travel.');
        }

        AdminTravelBooking::create([
            'travel_id' => $travel->id,
            'user_id' => $user->id,
            'game' => $travel->game,
        ]);

        TravelPlayer::create([
            'team_id' => $travel->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $travel->increment('booked_travelers');
        if ($travel->booked_travelers >= $travel->max_travelers) {
            $travel->update(['status' => 'full']);
        }
    }

    // --- NETWORK BOOKING ---
    $networkId = $paymentLog->network_id;
    if ($paymentLog->payment_purpose === 'network' && $networkId) {
        $network = AdminNetwork::findOrFail($networkId);

        if ($network->status === 'full') {
            return redirect()->back()->with('error', 'Network already full.');
        }

        if (AdminNetworkBooking::where('network_id', $network->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this network.');
        }

        AdminNetworkBooking::create([
            'network_id' => $network->id,
            'user_id' => $user->id,
            'game' => $network->game,
        ]);

        NetworkPlayer::create([
            'team_id' => $network->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $network->increment('booked_networks');
        if ($network->booked_networks >= $network->max_networks) {
            $network->update(['status' => 'full']);
        }
    }

    // --- SPORTS BOOKING ---
    if ($paymentLog->payment_purpose === 'sports' && $paymentLog->network_id) {
        $team = AdminTeam::findOrFail($paymentLog->network_id);

        if ($team->status === 'full') {
            return redirect()->back()->with('error', 'Team is full.');
        }

        if (AdminTeamBooking::where('team_id', $team->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this team.');
        }

        AdminTeamBooking::create([
            'team_id' => $team->id,
            'game' => $team->game,
            'user_id' => $user->id,
        ]);

        Player::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $team->increment('booked_players');
        if ($team->booked_players >= $team->max_players) {
            $team->update(['status' => 'full']);
        }
    }
                $certificatePath = $certificateService->generateCertificate($user->name, now()->format('d-m-Y'));
                $file_path ="https://profxleague.com/".$certificatePath;
                $user->update([
                    'certificate_path' => $certificatePath
                ]);
				
				/*Wallet and Wallet Transcations*/
				$this->walletupdate($email, $amount);
				
                return redirect()->route('user.dashboard')->with('success', "Payment processed successfully. Your funds will be added to your wallet within a few minutes.");
            } else {
                return redirect('/user/dashboard')->with('error', "Payment already processed or invalid.");
            }
        } else {
            // Update payment log for failed payment
            $paymentLog->update([
                'payment_res' => $payment_res,
                'payment_status' => $status,
            ]);
            return redirect('/user/dashboard')->with('error', "Payment Failed: Something Went Wrong. Please try again");
        }
    }

    private function createStripePayment($amount, $currency, $orderId, $paymentId)
    {
        $success_url = $this->settings->site_url
                    . "stripe-response?payment_id=" . md5($paymentId)
                    . "&status=success&session_id={CHECKOUT_SESSION_ID}";
        $apiKey = isset($this->settings['stripe_apikey']) ? $this->settings['stripe_apikey'] : null;

        if (!$apiKey) {
            return null;
        }

        Stripe::setApiKey($apiKey);

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => strtolower($currency),
                        'product_data' => [
                            'name' => "Order #" . $orderId,
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',

                'success_url' => $this->settings->site_url
                    . "stripe-response?payment_id=" . md5($paymentId)
                    . "&status=success&session_id={CHECKOUT_SESSION_ID}",

                'cancel_url' => $this->settings->site_url
                    . "stripe-response?payment_id=" . md5($paymentId)
                    . "&status=cancel",
                'metadata' => [
                    'order_id' => $orderId,
                    'payment_id' => $paymentId,
                ],
            ]);

            // Save details in DB
            PaymentLog::where('payment_id', $paymentId)->update([
                'payment_req' => json_encode([
                    'amount' => $amount,
                    'currency' => $currency,
                    'orderId' => $orderId,
                ]),
                'payment_url' => $session->url,
                'payment_reference_id' => $session->id,
                'remarks' => $success_url ,
            ]);

            return $session->toArray();

        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


    public function stripeResponse(Request $request, CertificateService $certificateService)
    {
        $user = Auth::user();
        $apiKey = $this->settings->stripe_apikey;
        Stripe::setApiKey($apiKey);
        
        $session_id = $request->get('session_id');
        $payment_id_hashed = $request->get('payment_id');

        if (!$session_id) {
            return redirect()->route('user.dashboard')->with('error', 'No Stripe session found.');
        }
        $session = Session::retrieve($session_id);
        $paymentLog = PaymentLog::whereRaw('MD5(payment_id) = ?', [$payment_id_hashed])->first();
        if (!$paymentLog) {
            return redirect()->route('user.dashboard')->with('error', 'Payment log not found.');
        }

        $status = $request->get('status');
        if ($status === 'cancel') {
			$paymentLog->update([
				'payment_status' => 'Cancelled',
				'payment_res' => json_encode($request->all())
			]);

			return redirect()->route('user.dashboard')->with('error', 'Payment was cancelled.');
        }

        // Check payment status
        if ($session->payment_status == 'paid' && $session->status == 'complete') {
            $paymentLog->update([
                'payment_status' => $session->payment_status,
                'payment_res' => json_encode($session)
            ]);

            Transactions::create([
                'useremail'         => $paymentLog->initiated_by,
                'trans_purpose'     => $paymentLog->payment_purpose,
                'trans_amount'      => $paymentLog->payment_amount,
                'trans_currency'    => $paymentLog->payment_currency ?? 'USD',
                'trans_method'      => $paymentLog->payment_type,
                'travel_id'=> $paymentLog->travel_id,
                'network_id' =>$paymentLog->network_id,
                  'game'=> $paymentLog->game,
                'trans_adminremark' => 'auto approved amount added your wallet',
                'trans_status'      => 'approved',
                'payment_log_id'   => $paymentLog->payment_id

            ]);

            if ($paymentLog->payment_purpose === 'corporate') {
                $paymentUser = User::where('email', $paymentLog->initiated_by)->first();
                if ($paymentUser) {
                    Payment::create([
                        'user_id' => $paymentUser->id,
                        'plan_name' => $paymentLog->game ?: 'Corporate Plan',
                        'amount' => $paymentLog->payment_amount,
                        'methods' => ucfirst((string) $paymentLog->payment_type),
                        'proof' => '',
                    ]);
                }
                return redirect()->route('crmcorporate')->with('success', 'Corporate plan activated successfully.');
            }

                $travelId = $paymentLog->travel_id;
    if ($paymentLog->payment_purpose === 'travel' && $travelId) {
        $travel = AdminTravel::findOrFail($travelId);

        if ($travel->status === 'full') {
            return redirect()->back()->with('error', 'Travel already full.');
        }

        if (AdminTravelBooking::where('travel_id', $travel->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this travel.');
        }

        AdminTravelBooking::create([
            'travel_id' => $travel->id,
            'user_id' => $user->id,
            'game' => $travel->game,
        ]);

        TravelPlayer::create([
            'team_id' => $travel->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $travel->increment('booked_travelers');
        if ($travel->booked_travelers >= $travel->max_travelers) {
            $travel->update(['status' => 'full']);
        }
    }

    // --- NETWORK BOOKING ---
    $networkId = $paymentLog->network_id;
    if ($paymentLog->payment_purpose === 'network' && $networkId) {
        $network = AdminNetwork::findOrFail($networkId);

        if ($network->status === 'full') {
            return redirect()->back()->with('error', 'Network already full.');
        }

        if (AdminNetworkBooking::where('network_id', $network->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this network.');
        }

        AdminNetworkBooking::create([
            'network_id' => $network->id,
            'user_id' => $user->id,
            'game' => $network->game,
        ]);

        NetworkPlayer::create([
            'team_id' => $network->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $network->increment('booked_networks');
        if ($network->booked_networks >= $network->max_networks) {
            $network->update(['status' => 'full']);
        }
    }

    // --- SPORTS BOOKING ---
    if ($paymentLog->payment_purpose === 'sports' && $paymentLog->network_id) {
        $team = AdminTeam::findOrFail($paymentLog->network_id);

        if ($team->status === 'full') {
            return redirect()->back()->with('error', 'Team is full.');
        }

        if (AdminTeamBooking::where('team_id', $team->id)->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this team.');
        }

        AdminTeamBooking::create([
            'team_id' => $team->id,
            'game' => $team->game,
            'user_id' => $user->id,
        ]);

        Player::create([
            'team_id' => $team->id,
            'user_id' => $user->id,
            'name' => $user->name,
        ]);

        $team->increment('booked_players');
        if ($team->booked_players >= $team->max_players) {
            $team->update(['status' => 'full']);
        }
    }
            
            $certificatePath = $certificateService->generateCertificate($user->name, now()->format('d-m-Y'));
            $file_path ="https://profxleague.com/".$certificatePath;
            $user->update([
                'certificate_path' => $certificatePath
            ]);
			
			/*Wallet and Wallet Transcations*/
			$this->walletupdate($paymentLog->initiated_by, $paymentLog->payment_amount);

            return redirect()->route('user.dashboard')->with('success', 'Card payment successful! Your funds will be added to your wallet within a few minutes.');
        } else {
            $paymentLog->update([
                'payment_status' => $session->payment_status,
                'payment_res' => json_encode($session)
            ]);

            return redirect()->route('user.dashboard')->with('error', 'Card payment failed or canceled.');
        }
    }

    public function xyrapayResponse(Request $request)
    {
        $payment_id_hashed = $request->query('payment_id');

        if (!$payment_id_hashed) {
            return redirect()->route('user.dashboard')->with('error', 'No Xyrapay payment ID found.');
        }

        $paymentLog = PaymentLog::whereRaw('MD5(id) = ?', [$payment_id_hashed])->first();
        if (!$paymentLog) {
            return redirect()->route('user.dashboard')->with('error', 'Payment log not found.');
        }

        \Log::info('Xyrapay Callback:', $request->all());

        // $status = $request->get('status');
        $status = 'completed';


        // if ($status === 'cancel') {
        //     $paymentLog->update([
        //         'payment_status' => 'Cancelled',
        //         'payment_res' => json_encode($request->all())
        //     ]);

        //     return redirect()->route('user.dashboard')->with('error', 'Payment was cancelled.');
        // }

        // if ($status === 'success') {
            $paymentLog->update([
                'payment_status' => 'paid',
                'payment_res' => json_encode($request->all())
            ]);

            Transactions::create([
                'useremail'         => $paymentLog->initiated_by,
                'trans_purpose'     => $paymentLog->payment_purpose,
                'trans_amount'      => $paymentLog->payment_amount,
                'trans_currency'    => $paymentLog->payment_currency ?? 'USD',
                'trans_method'      => $paymentLog->payment_type,
                'trans_adminremark' => 'auto approved. Your amount added the wallet',
                'trans_status'      => 'approved',
                'payment_log_id'   => $paymentLog->payment_id

            ]);
			
			/*Wallet and Wallet Transcations*/
			$this->walletupdate($paymentLog->initiated_by, $paymentLog->payment_amount);

            return redirect()->route('user.dashboard')->with('success', 'Xyrapay payment successful! Your funds will be added to your wallet within a few minutes.');
        // } else {
        //     $paymentLog->update([
        //         'payment_status' => 'Failed',
        //         'payment_res' => json_encode($request->all())
        //     ]);

            // return redirect()->route('user.dashboard')->with('error', 'Xyrapay payment failed or canceled.');
        // }
    }

	public function walletupdate($email, $amount){
	    $referralService = new ReferralService();
		$user = User::where('email', $email)->first();
		if ($user) {
			$desccommt = "Deposit Amount";
			if($user->payment_status == 0){
				$user->update([
					'payment_status' => 1,
				]);
				$referralService->distributeRegistrationCommission($user->id, $user->name, $amount);
				$desccommt = "Register Amount";					
			}
			
			$wallet = Wallet::firstOrCreate(['user_id' => $user->id], ['balance' => 0]);
			$wallet->increment('balance', $amount);
			WalletTransaction::create([
				'user_id' => $user->id,
				'from_user_id' => $user->id,
				'amount' => $amount,
				'type' => 'credit',
				'description' => $desccommt,
			]);	
			
			//send email for approve
			
			$approvedTemplateVars = [
                'name'        => $user->name,
                'server_name' => 'PROFXSPORTSCLUB',
                'site_link'   => 'https://profxleague.com',
                'email'       => $user->email,
                'amount'      => $paymentAmount ?? null, // optional
            ];
            
            /*$this->mailService->sendEmail(
                $user->email,
                'Payment Confirmation – PROFXSPORTSCLUB',
                [],
                'emails.approvedmail',                   // Blade template
                $approvedTemplateVars
            );*/
		}
	}


}
