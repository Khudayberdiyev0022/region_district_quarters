<?php

namespace App\Repositories;


use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RegionRepository
{
  public function filter(array $filters, array $with = []): Collection
  {
    $query = Region::with($with)->withCount(['districts', 'quarters']);
    $locale = app()->getLocale();

    if (!empty($filters['search'])) {
      $query->where("name_{$locale}",'ilike', $filters['search'].'%');
    }

    if (!empty($filters['sort'])) {
      $query->orderBy($filters['sort'], $filters['order'] ?? 'asc');
    }

    return $query->get();
  }

  public function findById(int $id, array $with = []): Region
  {
    return Region::with($with)->findOrFail($id);
  }
}
