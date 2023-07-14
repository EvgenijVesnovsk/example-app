<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookResourceCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => BookResource::collection($this->collection),
        ];
    }
}
