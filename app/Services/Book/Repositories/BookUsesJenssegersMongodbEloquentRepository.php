<?php

namespace App\Services\Book\Repositories;

use App\Models\Book;

class BookUsesJenssegersMongodbEloquentRepository implements BookRepository
{

    public function paginate(int $limit)
    {
        return Book::paginate($limit);
    }

    public function findOrFail($modelId)
    {
        return Book::findOrFail($modelId);
    }

    public function findByField(string $fieldName, string $op, $value)
    {
        return Book::where($fieldName, $op, $value)->first();
    }

    public function searchByField(string $fieldName, string $op, $value)
    {
        return Book::where($fieldName, $op, $value)->get();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(array $data, Book $model)
    {
        return $model->update($data);
    }

    public function updateOrCreate(array $search, array $data)
    {
        return Book::updateOrCreate($search, $data);
    }

    public function forceFill(array $data, Book $model): void
    {
        $model->forceFill($data)->save();
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
