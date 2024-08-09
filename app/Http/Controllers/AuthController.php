<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\AuthResource;
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

  protected $jwt;

  public function __construct(JWTAuth $jwt)
  {
    $this->jwt = $jwt;
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
    $credentials = $request->validated();
    $token = Auth::attempt($credentials);

    if (!$token) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
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
    Auth::guard('api')->logout();
    return response()->json(['message' => 'Successfully logged out']);
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
    return new AuthResource(Auth::guard('api')->user());
  }



  protected function respondWithToken($token): JsonResponse
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => $this->jwt::factory()->getTTL() * 60
    ]);
  }
}
