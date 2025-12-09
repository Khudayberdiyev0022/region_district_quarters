<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $soato_id
 * @property int $order
 * @property int $region_id
 * @property int $quarters_count
 */
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
