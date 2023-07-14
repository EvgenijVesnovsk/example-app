<?php

namespace App\Services\Book;

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

    public function list()
    {
        return $this->repository->paginate(25);
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
