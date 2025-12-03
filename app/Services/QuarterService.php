<?php

namespace App\Services;

use App\Models\Quarter;
use App\Repositories\QuarterRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class QuarterService
{
  public function __construct(private QuarterRepository $repository)
  {
  }

  public function filter(array $filters): Collection
  {
    return $this->repository->filter($filters);
  }

  public function getByIdWithRelations(int $id): Quarter
  {
    return $this->repository->findById($id, ['district']);
  }
}

