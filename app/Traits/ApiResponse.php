<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
  /**
   * Success response
   */
  protected function successResponse(
    $data,
    string $message = 'Operation successfully',
    int $status = 200
  ): JsonResponse {
    $response = [
      'status'  => $status,
      'success' => true,
    ];

    if ($message) {
      $response['message'] = $message;
    }

    $response['data'] = $data;

    return response()->json($response, $status);
  }

  /**
   * Paginated response
   */
  protected function paginatedResponse(
    $resource,
    string $message = ''
  ): JsonResponse {
    $paginator = $resource->resource;

    $response = [
      'status'  => 200,
      'success' => true,
    ];

    if ($message) {
      $response['message'] = $message;
    }

    $response['data']       = $resource->collection($paginator);
    $response['pagination'] = [
      'total'        => $paginator->total(),
      'per_page'     => $paginator->perPage(),
      'current_page' => $paginator->currentPage(),
      'last_page'    => $paginator->lastPage(),
      'from'         => $paginator->firstItem(),
      'to'           => $paginator->lastItem(),
      'has_more'     => $paginator->hasMorePages(),
    ];

    return response()->json($response, 200);
  }

  /**
   * Error response
   */
  protected function errorResponse(
    string $message,
    int $status = 400,
    array $errors = []
  ): JsonResponse {
    $response = [
      'status'  => $status,
      'success' => false,
      'message' => $message,
    ];

    if (!empty($errors)) {
      $response['errors'] = $errors;
    }

    return response()->json($response, $status);
  }

  /**
   * No content response (for delete operations)
   */
  protected function noContentResponse(string $message = ''): JsonResponse
  {
    $response = [
      'status'  => 204,
      'success' => true,
    ];

    if ($message) {
      $response['message'] = $message;
    }

    return response()->json($response, 204);
  }

  /**
   * Created response
   */
  protected function createdResponse(
    $data,
    string $message = 'Resource created successfully'
  ): JsonResponse {
    return $this->successResponse($data, $message, 201);
  }

  /**
   * Not found response
   */
  protected function notFoundResponse(
    string $message = 'Resource not found'
  ): JsonResponse {
    return $this->errorResponse($message, 404);
  }

  /**
   * Validation error response
   */
  protected function validationErrorResponse(
    array $errors,
    string $message = 'Validation failed'
  ): JsonResponse {
    return $this->errorResponse($message, 422, $errors);
  }
}
