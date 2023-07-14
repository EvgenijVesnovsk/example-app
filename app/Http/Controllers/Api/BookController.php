<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        $books = $this->service->list();
        return $books;
    }

    public function show($id)
    {
        $book = $this->service->get($id);
        return $book;
    }

    public function store(Request $request)
    {
        $book = $this->service->create($request->all());
        return $book;
    }

    public function update(Request $request, $id)
    {
        $book = $this->service->update($request->all(), $id);
        return $book;
    }

    public function destroy($id)
    {
        $this->service->delete($id);
    }
}
