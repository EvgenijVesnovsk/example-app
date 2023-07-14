<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    public const TITLE = 'title';
    public const STATE = 'state';

    protected $fillable = [
        self::TITLE,
        self::STATE,
    ];
}
