<?php

namespace App\Repositories;


use App\Models\District;
use Illuminate\Database\Eloquent\Collection;

class DistrictRepository
{
  public function filter(array $filters, array $with = []): Collection
  {
    $query  = District::with($with)->withCount('quarters');
    $locale = app()->getLocale();

    if (!empty($filters['search'])) {
      $query->where("name_{$locale}", 'ilike', $filters['search'].'%');
    }

    if (!empty($filters['sort'])) {
      $query->orderBy($filters['sort'], $filters['order'] ?? 'asc');
    }

    return $query->get();
  }

  public function findById(int $id, array $with = []): District
  {
    return District::with($with)->withCount($with)->findOrFail($id);
  }
}
