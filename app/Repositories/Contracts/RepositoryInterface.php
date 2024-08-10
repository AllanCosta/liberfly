<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
  public function all();

  public function allWithoutPagination();

  public function create(array $data);

  public function find(int $id);

  public function update(array $data, int $id);

  public function delete(int $id);

  public function skipPresenter();
}
