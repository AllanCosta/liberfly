<?php

declare(strict_types=1);

namespace App\Presenters;

use Illuminate\Support\Collection;
use App\Presenters\Traits\PresentTrait;

use Illuminate\Support\Facades\Log;

class UserPresenter
{
    use PresentTrait;

    /**
     * Transforma uma coleção de dados paginados.
     *
     * @param Collection $data
     * @return Collection
     */
    public function presentCollection(Collection $data): Collection
    {
        // Transforme os itens da coleção
        $transformedItems = $data->map(function ($item) {
            return $this->transformItem($item);
        });

        return $transformedItems;
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
            'created_at' => $this->formatDate((string) $item->created_at),
            'updated_at' => $this->formatDate((string) $item->updated_at),
            'active' => $this->booleanToText($item->active),
        ];
    }
}
