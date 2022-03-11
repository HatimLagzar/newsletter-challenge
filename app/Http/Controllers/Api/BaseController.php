<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function withError(
        string $errorMessage,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return new JsonResponse(
            [
                'message' => $errorMessage
            ],
            $statusCode
        );
    }

    public function withSuccess(
        array $payload = [],
        int $statusCode = Response::HTTP_OK
    ): JsonResponse {
        return new JsonResponse(
            $payload,
            $statusCode
        );
    }
}