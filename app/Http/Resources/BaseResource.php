<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
  protected function getLocalizedField(string $fieldPrefix): ?string
  {
    $locale    = app()->getLocale();
    $fieldName = "{$fieldPrefix}_{$locale}";

    return $this->{$fieldName} ?? null;
  }
}
