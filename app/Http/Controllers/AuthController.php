<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function register(RegisterAuthRequest $request)
    {
        return User::create($request->validated())->createToken('auth_token')->plainTextToken;
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $tokens = $user->tokens;

            if (empty($tokens)) {
                return response()->json(['tokens' => $tokens]);
            } else {
                return response()->json(['tokens' => [$user->createToken('auth_token')->plainTextToken]]);
            }

        }

        return response()->json(['message' => 'Invalid login credentials'], 401);

    }

    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }


}