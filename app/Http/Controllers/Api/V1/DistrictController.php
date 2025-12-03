<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Services\DistrictService;
use App\Traits\ApiResponse;
use Dedoc\Scramble\Attributes\HeaderParameter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
  use ApiResponse;

  public function __construct(private readonly DistrictService $service)
  {
  }
  /**
   * Districts filter & sort
   */
  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function index(Request $request)
  {
    $filters = [
      'search' => $request->query('search'),
      'sort'   => $request->query('sort'),
      'order'  => $request->query('order'),
    ];

    $districts = $this->service->filter($filters);

    return $this->successResponse(
      DistrictResource::collection($districts),
    );
  }
  /**
   * District with relations
   */
  #[HeaderParameter('Accept-Language', type: 'string', default: 'uz', example: 'uz,oz,ru')]
  public function show($id)
  {
    try {
      $district = $this->service->getByIdWithRelations($id);

      return $this->successResponse(
        DistrictResource::make($district),
      );
    } catch (ModelNotFoundException $e) {
      return $this->notFoundResponse('District not found');
    }
  }
}
