<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\AuthLoginRequest;
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

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        OAuthRepository $oAuthRepository
    ) {
        $this->userRepository = $userRepository;
        $this->oAuthRepository = $oAuthRepository;
    }

    /**
     * register
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function register(AuthRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['email_verified_at'] = now();
        $user =  $this->userRepository->create($data);
        $response = $this->oAuthRepository->register($data);
        $user['token'] = $response->json();

        return response()->json([
            'success' => true,
            'statusCode' => 201,
            'message' => 'User has been registered successfully.',
            'data' => $user,
        ], 201);
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $response = $this->oAuthRepository->login($data);
            $user['token'] = $response->json();

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => 'User has been logged successfully.',
                'data' => $user,
            ], 200);
        }

        return response()->json([
            'success' => true,
            'statusCode' => 401,
            'message' => 'Unauthorized.',
            'errors' => 'Unauthorized',
        ], 401);
    }
}
