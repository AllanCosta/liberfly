<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
  public function all(int $limit = 15);

  public function allWithoutPagination();

  public function create(array $data);

  public function find(int $id);

  public function update(array $data, int $id);

  public function delete(int $id);

  public function findByUuid(string $uuid);

  public function updateByUuid(array $data, string $uuid);

  public function deleteByUuid(string $uuid);

  public function paginate(int $limit);

  public function skipPresenter();
}
