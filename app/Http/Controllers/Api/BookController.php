<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceCollection;
use App\Services\Book\BookService;
use Illuminate\Http\Request;

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

    public function store(Request $request): BookResource
    {
        $book = $this->service->create($request->all());
        return new BookResource($book);
    }

    public function update(Request $request, $id): BookResource
    {
        $book = $this->service->update($request->all(), $id);
        return new BookResource($book);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
    }
}
