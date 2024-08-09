<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Resources\AuthResource;
use App\Http\Requests\Auth\RegisterRequest;


/**
 * @OA\Tag(
 *     name="User",
 *     description="Endpoints for managing users"
 * )
 */



class UserController extends Controller
{
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     summary="List all users",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index(): AuthResource //JsonResponse
    {
        return $this->service->index();
    }

    /**
     * @OA\Get(
     *     path="/api/me",
     *     summary="Get the authenticated user",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response=200,
     *         description="Authenticated user data",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function me(): AuthResource
    {
        return $this->service->me();
    }


    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function register(RegisterRequest $request): AuthResource
    {
        return $this->service->store($request);
    }
}
