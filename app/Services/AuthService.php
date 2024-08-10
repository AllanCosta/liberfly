<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomException;

use Illuminate\Support\Facades\Log;

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
    public function login(array $credentials): JsonResponse
    {
        try {
            $token = Auth::attempt($credentials);
            if (empty($token)) {
                throw new \Exception('Unauthorized', 401);
            }
            return $this->getResponseToken($token);
        } catch (\Exception $e) {
            throw new CustomException($e, $e->getCode());
        }
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
