<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends BaseResource
{
  public function toArray(Request $request): array
  {
    return [
      'id'        => $this->id,
      'soato_id'  => $this->soato_id,
      'name'      => $this->getLocalizedField('name'),
      'order'     => $this->order,
      'region_id' => $this->region_id,
      'region'    => RegionResource::make($this->whenLoaded('region')),
      'quarters'  => QuarterResource::collection($this->whenLoaded('quarters')),
      'quarters_count' => $this->quarters_count,
    ];
  }
}
