<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use App\Repositories\OAuthRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    private $userRepository;
    private $oAuthRepository;

    public function __construct(
        UserRepository $userRepository,
        OAuthRepository $oAuthRepository
    ) {
        $this->userRepository = $userRepository;
        $this->oAuthRepository = $oAuthRepository;
    }

    public function register(AuthRegisterRequest $request): JsonResponse
    {
        $userData = $request->validated();
        $userData['email_verified_at'] = now();
        $user =  $this->userRepository->create($userData);
        $response = $this->oAuthRepository->register($userData);
        $user['token'] = $response->json();

        return response()->json([
            'success' => true,
            'statusCode' => 201,
            'message' => 'User has been registered successfully.',
            'data' => $user,
        ], 201);
    }

    /**
     * Login user
     */
    // public function login(LoginRequest $request): JsonResponse
    // {
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();

    //         $response = Http::post(env('APP_URL') . '/oauth/token', [
    //             'grant_type' => 'password',
    //             'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
    //             'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
    //             'username' => $request->email,
    //             'password' => $request->password,
    //             'scope' => '',
    //         ]);

    //         $user['token'] = $response->json();

    //         return response()->json([
    //             'success' => true,
    //             'statusCode' => 200,
    //             'message' => 'User has been logged successfully.',
    //             'data' => $user,
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'success' => true,
    //             'statusCode' => 401,
    //             'message' => 'Unauthorized.',
    //             'errors' => 'Unauthorized',
    //         ], 401);
    //     }

    //}

    /**
     * Login user
     *
     * @param  LoginRequest  $request
     */
    // public function me(): JsonResponse
    // {

    //     $user = auth()->user();

    //     return response()->json([
    //         'success' => true,
    //         'statusCode' => 200,
    //         'message' => 'Authenticated use info.',
    //         'data' => $user,
    //     ], 200);
    // }

    /**
     * refresh token
     *
     * @return void
     */
    // public function refreshToken(RefreshTokenRequest $request): JsonResponse
    // {
    //     $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
    //         'grant_type' => 'refresh_token',
    //         'refresh_token' => $request->refresh_token,
    //         'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID'),
    //         'client_secret' => env('PASSPORT_PASSWORD_SECRET'),
    //         'scope' => '',
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'statusCode' => 200,
    //         'message' => 'Refreshed token.',
    //         'data' => $response->json(),
    //     ], 200);
    // }

    /**
     * Logout
     */
    // public function logout(): JsonResponse
    // {
    //     Auth::user()->tokens()->delete();

    //     return response()->json([
    //         'success' => true,
    //         'statusCode' => 204,
    //         'message' => 'Logged out successfully.',
    //     ], 204);
    // }
}
