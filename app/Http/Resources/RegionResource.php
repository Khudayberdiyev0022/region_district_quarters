<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends BaseResource
{
  public function toArray(Request $request): array
  {
    return [
      'id'             => $this->id,
      'soato_id'       => $this->soato_id,
      'name'           => $this->getLocalizedField('name'),
      'order'          => $this->order,
      'districts'      => DistrictResource::collection($this->whenLoaded('districts')),
      'district_count' => $this->districts_count,
      'quarters_count' => $this->quarters_count,
    ];
  }
}
