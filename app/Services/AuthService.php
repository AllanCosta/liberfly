<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\PasswordResetRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\RepositoryInterface;

class AuthService extends AppService
{
    private const TOKEN_TYPE = 'bearer';

    protected $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Exception
     */
    public function login(array $data): array
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $token = auth('api')->attempt($credentials);

        if (empty($token)) {
            throw new \Exception('Unauthorized', 401);
        }

        return $this->getResponseToken(
            $token
        );
    }

    public function logout(): void
    {
        auth('api')->logout();
    }


    private function getResponseToken($token): array
    {
        return [
            'data' => [
                'access_token' => $token,
                'token_type' => self::TOKEN_TYPE
            ]
        ];
    }
}
