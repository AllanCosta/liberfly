<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;
use App\Exceptions\CustomExceptionInterface;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0.0",
 *     description="API documentation for the Laravel application",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="API Server"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $body
     *
     * @return JsonResponse
     */
    protected function successResponse(array $body = []): JsonResponse
    {
        return response()->json($body);
    }
}
