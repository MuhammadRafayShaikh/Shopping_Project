<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        // Check user role
        if ($user->role == 0) {
            Auth::logout(); // Logout the user
            return redirect('/login')->with('error', 'Sorry, You are blocked');
        } else if ($user->role == 2) {
            return redirect('admin.dashboard');
        }

        // Redirect to homepage after successful login
        return redirect()->intended('/');
    }
}
