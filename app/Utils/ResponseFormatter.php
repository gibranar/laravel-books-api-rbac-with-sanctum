<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class ResponseFormatter
{
    /**
     * @param  string  $resourcesName  Resources name
     * @param  mixed  $data  Response data
     * @param  int  $status  HTTP status code
     * @param  string  $message  Optional success message
     * @param  array  $extraHeaders  Optional extra headers
     */
    public static function singleton(
        string $resourcesName,
        mixed $data,
        int $status = 200,
        ?string $message = null,
        array $extraHeaders = []
    ): JsonResponse {
        return response()->json([
            'status' => 'success',
            'status_code' => $status,
            'message' => $message,
            $resourcesName => $data,
        ], $status, $extraHeaders);
    }

    /**
     * @param  string  $resourcesName  Resources name
     * @param  mixed  $data  Response data
     * @param  int  $status  HTTP status code
     * @param  string  $message  Optional success message
     * @param  array  $extraHeaders  Optional extra headers
     */
    public static function collection(
        string $resourcesName,
        mixed $data,
        int $status = 200,
        ?string $message = null,
        array $extraHeaders = []
    ): JsonResponse {
        return response()->json([
            'status' => 'success',
            'status_code' => $status,
            'message' => $message,
            $resourcesName => $data,
        ], $status, $extraHeaders);
    }

    /**
     * @param  string  $resourcesName  Resources name
     * @param  LengthAwarePaginator  $data  Paginated response data
     * @param  int  $status  HTTP status code
     * @param  string  $message  Optional success message
     * @param  array  $extraHeaders  Optional extra headers
     */
    public static function paginatedCollection(
        string $resourcesName,
        LengthAwarePaginator $data,
        int $status = 200,
        ?string $message = null,
        array $extraHeaders = []
    ): JsonResponse {
        return JSendFormatter::success($message, [
            'meta' => [
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
            ],
            $resourcesName => $data->items(),
            'status_code' => $status
        ], $status, $extraHeaders);
    }
}
