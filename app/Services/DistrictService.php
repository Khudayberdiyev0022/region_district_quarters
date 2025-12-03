<?php

namespace App\Services;

use App\Models\District;
use App\Repositories\DistrictRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class DistrictService
{
  public function __construct(private DistrictRepository $repository)
  {
  }

  public function filter(array $filters): Collection
  {
    return $this->repository->filter($filters);
  }

  public function getByIdWithRelations(int $id): District
  {
    return $this->repository->findById($id, ['quarters']);
  }
}

