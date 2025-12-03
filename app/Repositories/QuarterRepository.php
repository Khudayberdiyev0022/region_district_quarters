<?php

namespace App\Repositories;


use App\Models\Quarter;
use Illuminate\Database\Eloquent\Collection;

class QuarterRepository
{
  public function filter(array $filters, array $with = []): Collection
  {
    $query  = Quarter::with($with);
    $locale = app()->getLocale();

    if (!empty($filters['search'])) {
      $query->where("name_{$locale}", 'ilike', $filters['search'].'%');
    }

    if (!empty($filters['sort'])) {
      $query->orderBy($filters['sort'], $filters['order'] ?? 'asc');
    }

    return $query->get();
  }

  public function findById(int $id, array $with = []): Quarter
  {
    return Quarter::with($with)->findOrFail($id);
  }
}
