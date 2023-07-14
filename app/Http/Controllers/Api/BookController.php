<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceCollection;
use App\Services\Book\BookService;

class BookController extends Controller
{
    private BookService $service;

    public function __construct
    (
        BookService $service
    )
    {
        $this->service = $service;
    }

    public function index(): BookResourceCollection
    {
        $books = $this->service->list();
        return new BookResourceCollection($books);
    }

    public function show($id): BookResource
    {
        $book = $this->service->get($id);
        return new BookResource($book);
    }

    public function store(StoreRequest $request): BookResource
    {
        $book = $this->service->create($request->all());
        return new BookResource($book);
    }

    public function update(UpdateRequest $request, $id): BookResource
    {
        $book = $this->service->update($request->all(), $id);
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
    }
}
