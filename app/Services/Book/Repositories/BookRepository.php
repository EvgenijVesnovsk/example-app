<?php

namespace App\Services\Book\Repositories;

use App\Models\Book;

interface BookRepository
{
    public function paginate(int $limit);

    public function findOrFail($modelId);

    public function findByField(string $fieldName, string $op, $value);

    public function searchByField(string $fieldName, string $op, $value);

    public function create(array $data);

    public function update(array $data, Book $model);

    public function updateOrCreate(array $search, array $data);

    public function forceFill(array $data, Book $model);

    public function delete(Book $model);

    public function refresh(Book $model);
}
