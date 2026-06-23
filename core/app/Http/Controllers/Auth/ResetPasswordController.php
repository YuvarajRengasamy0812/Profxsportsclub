<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user && (int) $user->user_type === 2) {
            return '/customer';
        }
        return '/login';
    }
}
