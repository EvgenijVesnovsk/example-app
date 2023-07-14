<?php

namespace App\Services\Book;

use App\DTOs\BookIndexDTO;
use App\DTOs\BookStoreDTO;
use App\DTOs\BookUpdateDTO;
use App\Enums\BookStates;
use App\Models\Book;
use App\Services\Book\Repositories\BookRepository;
use SM\Factory\FactoryInterface;
use SM\SMException;
use Symfony\Component\HttpFoundation\Response;

class BookService
{

    private BookRepository $repository;
    private FactoryInterface $factory;

    public function __construct
    (
        BookRepository   $repository,
        FactoryInterface $factory
    )
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function list(BookIndexDTO $dto): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->repository->query();

        foreach ([
                     'title',
                     'state',
                 ]
                 as $fieldName) {
            $query->when(!empty($dto->{$fieldName}), function ($q) use ($dto, $fieldName) {
                return $q->where($fieldName, $dto->{$fieldName});
            });
        }

        $query->when(!empty($dto->getSort() && !empty($dto->getBy())), function ($q) use ($dto) {
            return $q->orderBy($dto->getSort(), $dto->getBy());
        });
        return $this->repository->queryPaginate($query, $dto->getPerGage())->withQueryString();
    }

    public function get($id): Book
    {
        return $this->repository->findOrFail($id);
    }

    public function create(BookStoreDTO $dto): Book
    {
        $data = $dto->getData();
        $data[Book::STATE] = BookStates::DRAFT->value;
        return $this->repository->create($data);
    }

    /**
     * @throws SMException
     */
    public function update(BookUpdateDTO $dto, $id): Book
    {
        $book = $this->get($id);

        if (!empty($dto->getState())) {
            $stateMachine = $this->factory->get($book, 'book');
            try {
                $stateMachine->can($dto->getState());
            } catch (\Exception $e) {
                throw new \Exception('Нельзя изменить статус', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $this->repository->update($dto->getData(), $book);
        return $book->refresh();
    }

    public function delete($id): bool
    {
        $book = $this->get($id);
        return $this->repository->delete($book);
    }
}
