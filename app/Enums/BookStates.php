<?php

namespace App\Enums;

enum BookStates: string
{
    case DRAFT = 'draft';
    case PRODUCTION = 'production';
    case PRINT = 'print';
    case DONE = 'done';
}
