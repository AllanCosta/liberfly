<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function index(): AuthResource //JsonResponse
    {
        return new AuthResource(
            //return response()->json(
            $this->repository->all()
        );
    }

    public function me(): AuthResource
    {
        return new AuthResource(Auth::guard('api')->user());
    }

    public function store(RegisterRequest $request): AuthResource
    {
        $user = User::create(array_merge(
            $request->validated(),
            [
                'password' => Hash::make($request->password),
                'active' => 1,
            ]
        ));

        $keysToUnset = ['updated_at', 'password', 'id'];
        array_walk($keysToUnset, function ($key) use (&$user) {
            unset($user[$key]);
        });

        return new AuthResource($user);
    }
}
