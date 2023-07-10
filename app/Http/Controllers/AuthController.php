<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{

    public function register(RegisterAuthRequest $request)
    {
        return response()->json(["token" => User::create($request->validated())->createToken('auth_token')->plainTextToken], 201);
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