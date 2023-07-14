<?php

namespace App\Listeners;

use App\Events\BookUpdatedEvent;
use App\Exceptions\OneCServiceException;
use App\Helpers\BookStateHelper;
use App\Models\Book;
use App\Services\OneCService;

class BookStateChangedToDoneListener
{
    private OneCService $oneCService;

    public function __construct
    (
        OneCService $oneCService
    )
    {
        $this->oneCService = $oneCService;
    }

    /**
     * @throws OneCServiceException
     */
    public function handle(BookUpdatedEvent $event): void
    {
        $dto = $event->dto;
        $state = $dto->getState();
        if (!empty($state) && BookStateHelper::isDone($state)) {
            $comment = 'Статус книги "' . $event->book->{Book::TITLE} . '" изменился на ' . $event->book->{Book::STATE};
            $this->oneCService->addCommentToEdition($comment);
        }
    }
}
