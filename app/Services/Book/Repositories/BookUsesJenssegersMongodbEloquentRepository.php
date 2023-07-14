<?php

namespace App\Services\Book\Repositories;

use App\Models\Book;

class BookUsesJenssegersMongodbEloquentRepository implements BookRepository
{

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return Book::query();
    }

    public function queryPaginate(\Illuminate\Database\Eloquent\Builder $query, int $perPage): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $query->paginate($perPage);
    }

    public function findOrFail($modelId)
    {
        return Book::findOrFail($modelId);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(array $data, Book $model)
    {
        return $model->update($data);
    }

    public function delete(Book $model)
    {
        return $model->delete();
    }

    public function refresh(Book $model)
    {
        return $model->refresh();
    }
}
