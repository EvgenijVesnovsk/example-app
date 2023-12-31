<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
