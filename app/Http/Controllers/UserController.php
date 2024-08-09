<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Resources\AuthResource;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController.
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
    public function index(): JsonResponse
    {
        return $this->service->index();
    }
}
