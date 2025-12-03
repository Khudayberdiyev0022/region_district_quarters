<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegionResource;
use App\Services\RegionService;
use App\Traits\ApiResponse;
use Dedoc\Scramble\Attributes\HeaderParameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RegionController extends Controller
{
  use ApiResponse;

  public function __construct(private readonly RegionService $service)
  {
  }

  /**
   * Regions filter & sort
   */
  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function index(Request $request)
  {
    $filters = [
      'search' => $request->query('search'),
      'sort'   => $request->query('sort'),
      'order'  => $request->query('order'),
    ];

    $regions = $this->service->filter($filters);

    return $this->successResponse(
      RegionResource::collection($regions)
    );
  }

  /**
   * Region with relations
   */

  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function show($id)
  {
    try {
      $region = $this->service->getByIdWithRelations($id);

      return $this->successResponse(
        RegionResource::make($region)
      );
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse('Region not found');
    }
  }
}
