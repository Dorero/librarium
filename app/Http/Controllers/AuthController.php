<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * @group Authentication
 *
 * APIs for user authentication
 * 
 * @OA\Info(
 *     version="1.0.0",
 *     title="librarium API",
 *     description="API Documentation",
 *     @OA\Contact(
 *         email="domenoer@gmail.com"
 *     )
 * )
 */
class AuthController extends Controller
{

    /**
     * Registration user and return token
     * 
     * @param RegisterAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *     path="/api/register",
     *     operationId="registeredUser",
     *     tags={"Authentication"},
     *     summary="Registration user and return token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="!@#123QWEasd")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOi..."),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Email or password not validated"
     *     )
     * )
     */
    public function register(RegisterAuthRequest $request)
    {
        return response()->json(["token" => User::create($request->validated())->createToken('auth_token')->plainTextToken], 201);
    }


    /**
     * Login user and return token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Post(
     *     path="/api/login",
     *     operationId="authenticateUser",
     *     tags={"Authentication"},
     *     summary="Login user and return token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="!@#123QWEasd")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="tokens", type="array", @OA\Items(), example={"eyJhbGciOi...", "beHaiZdiQr..."})
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid login credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Invalid login credentials")
     *         )
     *     )
     * )
     */

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


    /**
     * Logout user, delete all tokens
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @OA\Delete(
     *     path="/api/logout",
     *     operationId="logoutUser",
     *     tags={"Authentication"},
     *     summary="Logout user, delete all tokens",
     *     @OA\Response(
     *         response=200,
     *         description="Tokens delete successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logged out successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User not authenticated"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }


}