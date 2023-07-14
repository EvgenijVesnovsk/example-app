<?php

namespace App\Http\Resources\Book;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->{Book::TITLE},
            'state' => $this->{Book::STATE},
            'created_at' =>  $this->{Model::CREATED_AT}->format('d.m.Y H:i:s'),
            'updated_at' =>  $this->{Model::UPDATED_AT}->format('d.m.Y H:i:s'),
        ];
    }
}
