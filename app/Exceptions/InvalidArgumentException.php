<?php

namespace App\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $this->code,
            'message' => $this->message,
        ], $this->code);
    }
}
