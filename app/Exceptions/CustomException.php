<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception implements CustomExceptionInterface
{
    protected $slug;
    protected $title;
    protected $description;
    protected $statusCode;

    public function __construct(
        Exception $e = null,
        int $statusCode = null,
        string $slug = null,
        string $title = null,
        string $description = null
    ) {
        $statusCode = $statusCode ?? 500;

        parent::__construct($e->getMessage(), $statusCode);

        $this->slug = $slug ?? 'Error';
        $this->title = $title ?? 'Internal Error';
        $this->description = $description ?? $e->getMessage();
        $this->statusCode = $statusCode;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
