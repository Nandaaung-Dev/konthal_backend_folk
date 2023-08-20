<?php

namespace App\Http\Controllers\Dashboard\Shop\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopAuthController extends Controller
{
    public function login(Request $request)
    {
        \Config::set('auth.defaults.guard', 'owner');
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $owner = Auth::user();
            $owner->token = $owner->createToken('shop_owner')->plainTextToken;
            return redirect()->route('shop_dashboard.dashboard.index');
        }
    }
}
