<?php

namespace App\Http\Controllers\Api\System\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemApiAuthController extends Controller
{
    public function login(Request $request)
    {
        \Config::set('auth.defaults.guard', 'web');
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $access_token = $user->createToken('system_user')->plainTextToken;
            return response()->json(['status' => 1, 'user' => $user, 'token' => $access_token]);
        } else {
            return response()->json(['status' => 2, 'message' => 'Something Wrong!']);
        }
    }
}
