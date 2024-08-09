<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PasswordResetRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthService extends AppService
{
    private const TOKEN_TYPE = 'bearer';

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Exception
     */
    public function login(array $data): JsonResponse
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $token = Auth::attempt($credentials);

        if (empty($token)) {
            throw new \Exception('Unauthorized', 401);
        }

        return $this->getResponseToken($token);
    }

    public function logout(): void
    {
        Auth::guard('api')->logout();
    }

    protected function getResponseToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => self::TOKEN_TYPE,
            'expires_in' => $this->jwt::factory()->getTTL() * 60
        ]);
    }
}
