<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuarterFilterRequest;
use App\Http\Resources\QuarterResource;
use App\Services\QuarterService;
use App\Traits\ApiResponse;
use Dedoc\Scramble\Attributes\HeaderParameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuarterController extends Controller
{
  use ApiResponse;

  public function __construct(private readonly QuarterService $service)
  {
  }

  /**
   * Quarters with filter & sort
   */
  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function index(QuarterFilterRequest $request)
  {
    $filters = $request->filters();

    $districts = $this->service->filter($filters);

    return $this->successResponse(
      QuarterResource::collection($districts),
    );
  }

  /**
   * Quarter with relations
   */
  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function show($id)
  {
    try {
      $quarter = $this->service->getByIdWithRelations($id);

      return $this->successResponse(
        QuarterResource::make($quarter)
      );
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse('Quarter not found');
    }
  }
}
