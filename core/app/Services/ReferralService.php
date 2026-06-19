<?php
namespace App\Services;

use App\Models\User;
use App\Models\ReferralCommission;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class ReferralService
{
    public function distributeRegistrationCommission($newUserId, $newuserName, $baseAmount)
    {
        $percentages = [
			1 => 10,
			2 => 5,
			3 => 2.5,
		];

		$level = 1;
		$referrer = User::find($newUserId)->referrer;

		while ($referrer && $level <= 3) {
			$percent = $percentages[$level];
			$commissionAmount = ($baseAmount * $percent) / 100;

			$description = "Level $level Referral Bonus from {$newuserName}";
			
			ReferralCommission::create([
				'from_user_id' => $newUserId,
				'to_user_id' => $referrer->id,
				'amount' => $commissionAmount,
				'percent' => $percent,
				'level' => $level,
				'description' => $description,
			]);

			// Update wallet
			$wallet = Wallet::firstOrCreate(['user_id' => $referrer->id], ['balance' => 0]);
			$wallet->increment('balance', $commissionAmount);
			
			// Create wallet transaction
			WalletTransaction::create([
				'user_id' => $referrer->id,
				'from_user_id' => $newUserId,
				'amount' => $commissionAmount,
				'type' => 'credit',
				'description' => 'Referral bonus from ' . User::find($newUserId)->name,
			]);

			$referrer = $referrer->referrer;
			$level++;
		}
    }
}
