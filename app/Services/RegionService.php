<?php

namespace App\Services;

use App\Models\Region;
use App\Repositories\RegionRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class RegionService
{
  public function __construct(private RegionRepository $repository)
  {
  }

  public function filter(array $filters): Collection
  {
    return $this->repository->filter($filters);
  }

  public function getByIdWithRelations(int $id): Region
  {
    return $this->repository->findById($id, ['districts.quarters']);
  }
}

