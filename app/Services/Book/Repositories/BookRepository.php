<?php

namespace App\Services\Book\Repositories;

use App\Models\Book;

interface BookRepository
{
    public function query(): \Illuminate\Database\Eloquent\Builder;

    public function queryPaginate(\Illuminate\Database\Eloquent\Builder $query, int $perPage): \Illuminate\Contracts\Pagination\LengthAwarePaginator;

    public function findOrFail($modelId);

    public function create(array $data);

    public function update(array $data, Book $model);

    public function delete(Book $model);

    public function refresh(Book $model);
}
