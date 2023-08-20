<?php

namespace App\Http\Controllers\Api\Shop\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Owner\OwnerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopApiAuthController extends Controller
{
    public function login(Request $request)
    {
        \Config::set('auth.defaults.guard', 'owner');
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $owner = Auth::user();
            $access_token = $owner->createToken('shop_owner')->plainTextToken;
            return response()->json(['status' => 1, 'owner' => $owner, 'token' => $access_token]);
            // return [
            //     'message' => ['successfully logged in'],
            //     'token' => $owner->access_token
            // ];
        } else {
            return response()->json(['status' => 2, 'message' => 'Somethin Wrong!']);
        }
    }
    public function me(Request $request)
    {
        $owner = $request->user();
        return new OwnerResource($owner->load(['city', 'township', 'shops', 'shops.shop_type']));
    }
    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['status' => 1, 'message' => 'Successfully Logout!']);
    }
}
