<?php

namespace App\Events;

use App\DTOs\BookUpdateDTO;
use App\Models\Book;
use Illuminate\Foundation\Events\Dispatchable;

class BookUpdatedEvent
{
    use Dispatchable;

    public BookUpdateDTO $dto;
    public Book $book;

    public function __construct(BookUpdateDTO $dto, Book $book)
    {
        $this->dto = $dto;
        $this->book = $book;
    }
}
