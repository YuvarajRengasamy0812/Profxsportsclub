<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Crm\TeamController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\SportsListController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use App\Services\ReferralService;
use Illuminate\Auth\Events\Verified;

use App\Http\Controllers\Tournaments;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

// Forgot Password Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Reset Password Routes
// Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
//     ->name('password.reset');

// Route::post('reset-password', [ResetPasswordController::class, 'reset'])
//     ->name('password.update');



// Show reset password form (link from email)
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// Handle form submission (update password)
Route::post('reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');
    
    
/*Custom page controller*/
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name("aboutus");
Route::get('/partnership', [HomeController::class, 'partnership'])->name("partnership");
Route::get('/leaderboards', [HomeController::class, 'leaderboards'])->name("leaderboards");
Route::get('/leagues/{pageslug?}', [HomeController::class, 'leagues'])->name("leagues");
Route::get('/leagueslist/{pageslug?}', [HomeController::class, 'leagueslist'])->name("leagueslist");
Route::get('/leaguesdetail', [HomeController::class, 'leaguesdetail'])->name("leaguesdetail");
Route::get('/blogs', [HomeController::class, 'blogs'])->name("blogs");
Route::get('/privacy', [HomeController::class, 'privacy'])->name("privacy");
Route::get('/terms', [HomeController::class, 'terms'])->name("terms");
Route::get('/referral', [HomeController::class, 'referral'])->name("referral");
//Route::get('/login', [UserController::class, 'login'])->name("login");

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/userregister', [RegisterController::class, 'userregister'])->name('userregister');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

/*Sports page redirect links*/
Route::get('/cricket', [SportsController::class, 'cricket'])->name('cricket');
Route::get('/football', [SportsController::class, 'football'])->name('football');
Route::get('/subsports', [SportsController::class, 'esports'])->name('esports');
Route::get('/badminton', [SportsController::class, 'badminton'])->name('badminton');
Route::get('/tennis', [SportsController::class, 'tennis'])->name('tennis');
Route::get('/volleyball', [SportsController::class, 'volleyball'])->name('volleyball');
Route::get('/chess', [SportsController::class, 'chess'])->name('chess');
Route::get('/womendivision', [SportsController::class, 'womendivision'])->name('womendivision');
Route::get('/about', [SportsController::class, 'about'])->name('about');
Route::get('/media', [SportsController::class, 'media'])->name('media');
Route::get('/blog', [SportsController::class, 'blog'])->name('blog');
Route::get('/travel', [SportsController::class, 'travel'])->name('travel');
Route::get('/Network', [SportsController::class, 'Network'])->name('Network');
Route::get('/membership', [SportsController::class, 'membership'])->name('membership');
Route::get('/tournaments', [SportsController::class, 'tournaments'])->name('tournaments');
Route::get('/sportshome', [SportsController::class, 'sports'])->name('sports');
Route::get('/physicalsports', [SportsController::class, 'physicalsports'])->name('physicalsports');
Route::get('/esports', [SportsController::class, 'subesports'])->name('subesports');
Route::get('/indoorsports', [SportsController::class, 'indoorsports'])->name('indoorsports');
Route::get('/booking', [SportsController::class, 'booking'])->name('booking');
Route::get('/event', [SportsController::class, 'event'])->name('event');
Route::get('/upcomeingEvent', [SportsController::class, 'upcomeingEvent'])->name('upcomeingEvent');
Route::get('/pastEvent', [SportsController::class, 'pastEvent'])->name('pastEvent');
Route::get('/blogdetails', [SportsController::class, 'blogEvent'])->name('blogEvent');
Route::get('/detailsEvent', [SportsController::class, 'detailsEvent'])->name('detailsEvent');
Route::get('/user-profile', [SportsController::class, 'profile'])->name('user-profile');
Route::get('/crmdashboard', [SportsController::class, 'crmdashboard'])->name('crmdashboard');
Route::get('/crmevent', [SportsController::class, 'crmevent'])->name(name: 'crmevent');
// Route::get('/crmports', [SportsController::class, 'crmports'])->name(name: 'crmports');
// Route::get('/crmtems', [SportsController::class, 'crmtems'])->name(name: 'crmtems');
Route::get('/crmleaderboard', [SportsController::class, 'crmleaderboard'])->name(name: 'crmleaderboard');
Route::get('/crmaccount', [SportsController::class, 'crmaccount'])->name(name: 'crmaccount');
Route::get('/crmcorporate', [SportsController::class, 'crmcorporate'])->name(name: 'crmcorporate');
Route::get('/crmtems', [TeamController::class, 'crmtems'])->name('crmtems');
Route::post('/crmtemssave', [TeamController::class, 'crmtemssave'])->name('crmtemssave');
Route::get('/viewteam/{id}', [TeamController::class, 'viewteam'])->name('viewteam');
Route::get('/crmsports', [SportsListController::class, 'crmsports'])->name('crmsports');
Route::get('/crmsports/{id}', [SportsListController::class, 'details'])->name('sports.details');
Route::post('/crmtemsbook', [SportsListController::class, 'crmtemsbook'])->name('crmtemsbook');
Route::post('/corporateSave', [SportsListController::class, 'corporateSave'])->name('corporateSave');
Route::post('/corporateBooking', [SportsListController::class, 'corporateBooking'])->name('corporateBooking');
Route::get('/customer', [AuthController::class, 'customer'])->name('customer');
Route::get('/customerdashboard', [AuthController::class, 'customerdashboard'])->name('customerdashboard');
Route::post('/sportsRegister', [AuthController::class, 'sportsRegister'])->name('sportsRegister');
Route::post('/customerlogin', [AuthController::class, 'customerlogin'])->name('customerlogin');
Route::post('/logoutcustomer', [AuthController::class, 'logoutcustomer'])->name('logoutcustomer');



// travels

Route::get('/crmtravel', [AdminTeamController::class, 'crmtravel'])->name('crmtravel');
Route::post('/crmtravelbook', [AdminTeamController::class, 'crmtravelbook'])->name('crmtravelbook');

// network
Route::get('/crmnetwork', [AdminTeamController::class, 'crmnetwork'])->name('crmnetwork');
Route::post('/crmnetworkbook', [AdminTeamController::class, 'crmnetworkbook'])->name('crmnetworkbook');

// payments

Route::get('/crmtransaction', [AdminTeamController::class, 'crmtransaction'])->name('crmtransaction');

Route::get('/email/verify', function () {
    return view('frontEnd.user.verify');
})->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request, ReferralService $referralService) {
//     $request->fulfill();
// 	$user = $request->user();
// 	if($user->hasVerifiedEmail()){
// 		try {
// 			$referralService->distributeRegistrationCommission($user->id, $user->name, 100);
// 		} catch (\Exception $e) {
// 			Log::error('Commission error: ' . $e->getMessage());
// 		}

// 		try {
// 			Mail::to($user->email)->send(new WelcomeEmail($user));
// 		} catch (\Exception $e) {
// 			Log::error('Welcome email failed to send: ' . $e->getMessage());
// 		}
// 	}
//     return redirect('/user/dashboard')->with('status', 'Email verified successfully. Welcome!');
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash, ReferralService $referralService) {

    $user = \App\Models\User::findOrFail($id);

    // Validate signed hash
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Invalid verification link.');
    }

    // Mark email as verified if not already
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Verified($user));
    }

    // Auto-login the user (works on new browsers/devices)
    Auth::guard('web')->login($user);

   // try {
    //     $referralService->distributeRegistrationCommission($user->id, $user->name, 100);
    // } catch (\Exception $e) {
    //     Log::error('Commission error: ' . $e->getMessage());
    // }

    // Send welcome email
    try {
        // Mail::to($user->email)->send(new WelcomeEmail($user));
        $templateVars = [
                'name'             => $user->name,
                'server_name'      => 'PROFXSPORTSCLUB',
                'site_link'        => 'https://profxsportsclub.com/',
                'email'            => $user->email,
                'user'             => $user
            ];

            app(\App\Services\MailService::class)->sendEmail(
                $user->email,         // recipient
                'Welcome to PROFXSPORTSCLUB – Your Journey Starts Here', // subject
                [],                   // headers (ignored)
                'emails.greetings',      // <- use the Blade template here
                $templateVars         // variables for template
            );
    } catch (\Exception $e) {
        Log::error('Welcome email failed: ' . $e->getMessage());
    }

    return redirect('/crmdashboard')->with('status', 'Email verified successfully. Welcome!');

})->middleware(['signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    
    
	Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name("user.dashboard");
    Route::get('/user/wallet', [UserController::class, 'wallet'])->name("user.wallet");
    Route::get('/user/leaderboard', [UserController::class, 'leaderboard'])->name("user.leaderboard");
    Route::get('/user/announcements', [UserController::class, 'announcements'])->name("user.announcements");
    Route::get('/user/leaderresult', [UserController::class, 'leaderresult'])->name("user.leaderresult");
    Route::get('/user/profile', [UserController::class, 'profile'])->name("user.profile");
    Route::get('/user/security', [UserController::class, 'security'])->name("user.security");
    Route::get('/user/referral', [UserController::class, 'referral'])->name("user.referral");
    Route::get('/user/referred', [UserController::class, 'referred'])->name("user.referred");
    Route::get('/user/referredfamily', [UserController::class, 'referredfamily'])->name("user.referredfamily");
    Route::get('/user/referralearning', [UserController::class, 'referralearning'])->name("user.referralearning");
    Route::get('/user/choosepayment/{type}', [UserController::class, 'choosepayment'])->where('type', 'register|deposit')->name("user.choosepayment");
	Route::post('/paymentstore/', [PaymentController::class, 'paymentstore'])->name("paymentstore");
	Route::get('/payment-response', [PaymentController::class, 'handlePaymentResponse'])->name('handlePaymentResponse');
    Route::get('/user/bankdetail', [UserController::class, 'bankdetail'])->name("user.bankdetail");
    Route::get('/user/enrollment', [UserController::class, 'enrollment'])->name("user.enrollment");
    Route::get('/user/withdraw', [UserController::class, 'withdraw'])->name("user.withdraw");
    Route::get('/user/get-bank-accounts', [UserController::class, 'getBankAccounts'])->name("user.get.bank.accounts");
	Route::get('/user/get-crypto-wallets', [UserController::class, 'getCryptoWallets'])->name("user.get.crypto.wallets");	
	Route::post('/cryptowallet/store', [UserController::class, 'cryptowallet'])->name('cryptowallet.store');
	Route::get('/user/cryptowallet', [UserController::class, 'cryptowallet'])->name("user.cryptowallet");
    Route::post('/user/withdrawrequest', [UserController::class, 'withdrawrequest'])->name("user.withdrawrequest");
    Route::get('/user/transfer', [UserController::class, 'transfer'])->name("user.transfer");
	Route::get('/user/rewardbalance', [UserController::class, 'getRewardbalance'])->name("user.rewardbalance");
	Route::get('/user/referralbalance', [UserController::class, 'getReferralbalance'])->name("user.referralbalance");
	Route::post('/user/storetransfer', [UserController::class, 'storetransfer'])->name("user.storetransfer");
	Route::get('/user/listleague', [UserController::class, 'listleague'])->name("user.listleague");
	Route::get('/user/myleague', [UserController::class, 'myleague'])->name("user.myleague");
	Route::post('/user/enrollleague', [UserController::class, 'enrollleague'])->name("user.enrollleague");
	Route::POST('/user/getliveaccount', [Tournaments::class, 'getLiveaccount'])->name("user.getliveaccount");
	Route::get('/user/myresult', [UserController::class, 'myresult'])->name("user.myresult");
	Route::get('/leaderboard/refresh', [UserController::class, 'leaderboardrefresh'])->name('leaderboard.refresh');
	
	
    Route::get('/logout', [LoginController::class, 'logoutUser'])->name('logout');

    // stripe
    Route::get('/stripe-response', [PaymentController::class, 'stripeResponse']);
    
     // xyrapay
    Route::get('/payment-confirmation', [PaymentController::class, 'xyrapayResponse']);
    // Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])
    ->name('user.update.password');
    Route::get('/user/kyc', [UserController::class, 'kyc'])->name("user.kyc");
    Route::post('/user/upload_kyc', [UserController::class, 'upload_kyc'])->name("user.upload.kyc");
     Route::get('/user/registration_certificate', [UserController::class, 'reg_certificate'])->name("user.registration.certificate");
    Route::get('/user/leaguecertificate', [UserController::class, 'leaguecertificate'])->name("user.leaguecertificate");
    Route::get('/league/certificate/{id}/download', [UserController::class, 'downloadCertificate'])
    ->name('league.certificate.download');
});
Route::post('/user/profile/update', [UserController::class, 'updateProfile'])
    ->middleware('auth')
    ->name('user.profile.update');
    Route::post('/update-password', [UserController::class, 'updatePassword'])
    ->middleware('auth')
    ->name('user.update.password');

// Language Route
Route::post('/lang', [LanguageController::class, 'index'])->middleware('LanguageSwitcher')->name('lang');
// For Language direct URL link
Route::get('/lang/{lang}', [LanguageController::class, 'change'])->middleware('LanguageSwitcher')->name('langChange');
Route::get('/locale/{lang}', [LanguageController::class, 'locale'])->middleware('LanguageSwitcher')->name('localeChange');
// .. End of Language Route

// Not Found
Route::get('/{lang?}/404', [HomeController::class, 'page_404'])->name('NotFound');


// RSS Feed Routes
if (config('smartend.rss_status')) {
    Route::feeds();
}

// Social Auth
Route::get('/oauth/{driver}', [SocialAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('/oauth/{driver}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::Group(['prefix' => config('smartend.backend_path')], function () {
    Auth::routes();
});

// Add your custom routes here


// Start of Frontend Routes
// - site map
Route::get('/sitemap.xml', [SiteMapController::class, 'siteMap'])->name('siteMap');
Route::get('/{lang}/sitemap', [SiteMapController::class, 'siteMap'])->name('siteMapByLang');

// - Public form submit
Route::post('/form-submit', [HomeController::class, 'form_submit'])->name('formSubmit');

// - Newsletter form submit
Route::post('/subscribe', [HomeController::class, 'subscribe_submit'])->name('subscribeSubmit');

// - Comment form submit
Route::post('/comment', [HomeController::class, 'comment_submit'])->name('commentSubmit');

// - Order form submit
Route::post('/order', [HomeController::class, 'order_submit'])->name('orderSubmit');

// - Contact page form submit
// Route::post('/contact-submit', [HomeController::class, 'contact_submit'])->name('contactPageSubmit');
// Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
// - Tags
Route::get('/tag/{tag_slug?}', [HomeController::class, 'tag'])->name('tag');

// - All Other slugs
Route::get('/{part1?}/{part2?}/{part3?}/{part4?}/{part5?}/{part6?}', [HomeController::class, 'seo'])->name("frontendRoute");
// End of Frontend Route

// Route::get('/forgot_password', [LoginController::class, 'tag'])->name('tag');
Route::post('/user/accept-disclaimer', [UserController::class, 'acceptDisclaimer'])->name('user.acceptDisclaimer');
Route::post('/bank-details/store', [UserController::class, 'bankstore'])->name('bankdetails.store');
Route::post('/bank-details/update/{id}', [UserController::class, 'bankupdate'])->name('bankdetails.update');
Route::delete('/bank-details/delete/{id}', [UserController::class, 'bankdestroy'])->name('bankdetails.destroy');

Route::delete('/cryptowallet/delete/{id}', [UserController::class, 'cryptowalletstroy'])->name('cryptowallet.destroy');
Route::post('/sendotp', [UserController::class, 'sendotp'])->name('sendotp');
Route::post('/verifyotp', [UserController::class, 'verifyotp'])->name('verifyotp');
Route::post('/walletverifyotp', [UserController::class, 'walletverifyotp'])->name('walletverifyotp');
Route::post('/walletsendotp', [UserController::class, 'walletsendotp'])->name('walletsendotp');




// member
// Route::get('/membership', [MemberController::class, 'create'])->name('membership.create');
Route::post('/membership', [MemberController::class, 'store'])->name('membership.store');

// Route::get('/tournaments', [MemberController::class, 'tournament'])->name('tournaments.tournament');
Route::post('/tournaments', [MemberController::class, 'tournaments'])->name('tournaments.tournaments');

Route::get('/travel', [MemberController::class, 'travel'])->name('travels.travel');
Route::post('/travel', [MemberController::class, 'travels'])->name('travels.travels');

Route::get('/network', [MemberController::class, 'network'])->name('networks.network');
Route::post('/network', [MemberController::class, 'networks'])->name('networks.networks');
Route::post('/booking', [MemberController::class, 'booking'])->name('booking.booking');


Route::post('/sportshome', [MemberController::class, 'sports'])->name('sports.sports');
Route::post('/contact', [HomeController::class, 'profx'])->name('profx.profx');


// Route::post('/contact', [HomeController::class, 'contacted'])->name('contacted.contact');




