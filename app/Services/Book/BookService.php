<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Services\Book\Repositories\BookRepository;

class BookService
{

    private BookRepository $repository;

    public function __construct
    (
        BookRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function list()
    {
        return $this->repository->paginate(25);
    }

    public function get($id): Book
    {
        return $this->repository->findOrFail($id);
    }

    public function create(array $data): Book
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id): Book
    {
        $book = $this->get($id);
        $this->repository->update($data, $book);
        return $book->refresh();
    }

    public function delete($id): bool
    {
        $book = $this->get($id);
        return $this->repository->delete($book);
    }
}
