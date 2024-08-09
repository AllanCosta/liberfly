<?php

declare(strict_types=1);

namespace App\Presenters;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Presenters\Traits\PresentTrait;

use Illuminate\Support\Facades\Log;

class UserPresenter
{
    use PresentTrait;

    /**
     * Transforma uma coleção de dados paginados.
     *
     * @param LengthAwarePaginator $data
     * @return LengthAwarePaginator
     */
    public function presentCollection(LengthAwarePaginator $data): LengthAwarePaginator
    {
        // Transforme os itens da coleção
        $transformedItems = $data->getCollection()->map(function ($item) {
            return $this->transformItem($item);
        });

        // Crie uma nova instância de LengthAwarePaginator com os itens transformados
        return $data->setCollection($transformedItems);
    }

    /**
     * Transforma um item de dados.
     *
     * @param object $item
     * @return object
     */
    protected function transformItem(object $item): object
    {
        return (object) [
            'id' => $item->id,
            'name' => $item->name,
            'document' => $this->maskDocument($item->document),
            'email' => $item->email,
            'registered_at' => $this->formatDate((string) $item->created_at),
            'is_active' => $this->booleanToText($item->active),
        ];
    }
}
