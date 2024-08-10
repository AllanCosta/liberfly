<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryEloquent;
use App\Http\Resources\AuthResource;
use App\Http\Resources\AuthResourceCollection;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\CustomException;
use App\Helpers\PaginationHelper;

use Illuminate\Support\Facades\Log;

/**
 * UserService.
 */
class UserService extends AppService
{
    protected $repository;

    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): AuthResourceCollection
    {
        try {
            return new AuthResourceCollection(
                PaginationHelper::paginate(
                    $this->repository->all(),
                    $request
                )
            );
        } catch (\Exception $e) {
            throw new CustomException($e);
        }
    }

    public function me(): AuthResource
    {
        try {
            return new AuthResource(
                Auth::guard('api')->user()
            );
        } catch (\Exception $e) {
            throw new CustomException($e);
        }
    }

    public function store(array $data): AuthResource
    {
        try {
            return new AuthResource(
                $this->repository->create($data)
            );
        } catch (\Exception $e) {
            throw new CustomException($e);
        }
    }
}
