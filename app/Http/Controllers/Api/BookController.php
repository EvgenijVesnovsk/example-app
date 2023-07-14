<?php

namespace App\Http\Controllers\Api;

use App\DTOs\BookIndexDTO;
use App\DTOs\BookStoreDTO;
use App\DTOs\BookUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\Book\BookResource;
use App\Http\Resources\Book\BookResourceCollection;
use App\Services\Book\BookService;
use Illuminate\Http\Request;
use SM\SMException;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function index(Request $request): BookResourceCollection
    {
        $dto = BookIndexDTO::fromRequest($request);
        $books = $this->service->list($dto);
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
     * @throws SMException
     */
    public function update(UpdateRequest $request, $id): BookResource
    {
        $dto = new BookUpdateDTO($request->all());
        $book = $this->service->update($dto, $id);
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
