<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\CustomException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        CustomException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (\Throwable $e) {});
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof CustomException) {
            $data = [
                'slug' => $e->getSlug(),
                'title' => $e->getTitle(),
                'description' => $e->getDescription(),
            ];

            $statusCode = $e->getStatusCode();

            return response()->json($data, $statusCode);
        }

        if ($e instanceof UnauthorizedHttpException) {
            throw new CustomException(
                $e,
                401,
                null,
                'Token Expired',
                'Please log in again.',
            );
        }

        return parent::render($request, $e);
    }
}
