<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Http\Resources\AuthResource;
use Illuminate\Http\JsonResponse;

// use Illuminate\Support\Facades\Log;

/**
 * UserService.
 */
class UserService extends AppService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): JsonResponse
    {
        //return new AuthResource(
        return response()->json(
            $this->repository->all()
        );
    }
}
