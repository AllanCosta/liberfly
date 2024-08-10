<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class PaginationHelper
{
  private const PAGINATION = 10;
  /**
   * Pagina uma coleção de dados.
   *
   * @param Collection $collection
   * @param int $perPage
   * @param Request $request
   * @return LengthAwarePaginator
   */
  public static function paginate(Collection $collection, Request $request): LengthAwarePaginator
  {
    $perPage = self::PAGINATION;
    $currentPage = $request->get('page', 1);
    $currentPage = $currentPage <= 0 ? 1 : $currentPage;
    $offset = ($currentPage - 1) * $perPage;
    $currentItems = $collection->slice($offset, $perPage)->all();

    return new LengthAwarePaginator(
      $currentItems,
      $collection->count(),
      $perPage,
      $currentPage,
      ['path' => $request->url(), 'query' => $request->query()]
    );
  }
}
