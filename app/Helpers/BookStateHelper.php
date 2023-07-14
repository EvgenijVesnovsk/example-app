<?php

namespace App\Helpers;

use App\Enums\BookStates;

class BookStateHelper
{
    public static function isDone(string $state): bool
    {
        return $state === BookStates::DONE->value;
    }
}
