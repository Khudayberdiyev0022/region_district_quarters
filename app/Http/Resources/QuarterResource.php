<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property int $soato_id
 * @property int $order
 * @property int $district_id
 */
class QuarterResource extends BaseResource
{
  public function toArray(Request $request): array
  {
    return [
      'id'          => $this->id,
      'soato_id'    => $this->soato_id,
      'name'        => $this->getLocalizedField('name'),
      'order'       => $this->order,
      'district_id' => $this->district_id,
      'district'    => DistrictResource::make($this->whenLoaded('district')),
    ];
  }
}
