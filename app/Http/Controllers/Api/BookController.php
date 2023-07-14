<?php

namespace App\Http\Controllers\Api;

use App\DTOs\BookStoreDTO;
use App\DTOs\BookUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceCollection;
use App\Services\Book\BookService;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

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

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function store(StoreRequest $request): BookResource
    {
        $dto = new BookStoreDTO($request->all());
        $book = $this->service->create($dto);
        return new BookResource($book);
    }

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function update(UpdateRequest $request, $id): BookResource
    {
        $dto = new BookUpdateDTO($request->all());
        $book = $this->service->update($dto, $id);
        return new BookResource($book);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
