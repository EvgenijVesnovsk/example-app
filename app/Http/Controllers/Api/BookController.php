<?php

namespace App\Http\Controllers\Api;

use App\DTOs\BookIndexDTO;
use App\DTOs\BookStoreDTO;
use App\DTOs\BookUpdateDTO;
use App\Exceptions\InvalidArgumentException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceCollection;
use App\Services\Book\BookService;
use Illuminate\Http\Request;
use SM\SMException;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @throws InvalidArgumentException
     */
    public function index(Request $request): BookResourceCollection
    {
        try {
            $dto = BookIndexDTO::fromRequest($request);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $books = $this->service->list($dto);
        return new BookResourceCollection($books);
    }

    public function show($id): BookResource
    {
        $book = $this->service->get($id);
        return new BookResource($book);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function store(StoreRequest $request): BookResource
    {
        try {
            $dto = new BookStoreDTO($request->all());
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book = $this->service->create($dto);
        return new BookResource($book);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function update(UpdateRequest $request, $id): BookResource
    {
        try {
            $dto = new BookUpdateDTO($request->all());
            $book = $this->service->update($dto, $id);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return new BookResource($book);
    }

    public function destroy($id)
    {
        $result = $this->service->delete($id);
        [$code, $message] = $result === true ? [Response::HTTP_OK, 'Успешно удалено'] : [Response::HTTP_INTERNAL_SERVER_ERROR, 'Произошла ошибка при удалении'];
        return response()->json([
            'code' => $code,
            'message' => $message
        ]);
    }
}
