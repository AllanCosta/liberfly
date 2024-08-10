<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;


/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Endpoints for user authentication"
 * )
 */


/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com")
 * )
 */

class AuthController extends Controller
{

  protected $service;

  /**
   * @param UserService $service
   */
  public function __construct(AuthService $service)
  {
    $this->service = $service;
  }

  /**
   * @OA\Post(
   *     path="/api/login",
   *     summary="Login a user",
   *     tags={"Authentication"},
   *     @OA\RequestBody(
   *         required=true,
   *         description="User login credentials",
   *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="Successful login",
   *         @OA\JsonContent(
   *             type="object",
   *             @OA\Property(property="access_token", type="string", example="your_jwt_token"),
   *             @OA\Property(property="token_type", type="string", example="bearer"),
   *             @OA\Property(property="expires_in", type="integer", example=3600)
   *         )
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="Unauthorized"
   *     )
   * )
   */
  public function login(LoginRequest $request): JsonResponse
  {
    return $this->service->login($request->validated());
  }

  /**
   * @OA\Post(
   *     path="/api/logout",
   *     summary="Logout a user",
   *     tags={"Authentication"},
   *     @OA\Response(
   *         response=200,
   *         description="Successful logout",
   *         @OA\JsonContent(
   *             type="object",
   *             @OA\Property(property="message", type="string", example="Successfully logged out")
   *         )
   *     ),
   *     security={{"bearerAuth":{}}}
   * )
   */
  public function logout(): JsonResponse
  {
    $this->service->logout();
    return $this->successResponse([
      'message' => 'Successfully logged out'
    ]);
  }
}
