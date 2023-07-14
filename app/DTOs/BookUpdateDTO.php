<?php

namespace App\DTOs;

use App\Enums\BookStates;
use Illuminate\Validation\Rules\Enum;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class BookUpdateDTO extends ValidatedDTO
{
    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'title' => ['string', 'max:255'],
            'state' => [new Enum(BookStates::class)],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO instantiation.
     */
    protected function mapBeforeValidation(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO export.
     */
    protected function mapBeforeExport(): array
    {
        return [];
    }

    /**
     * Defines the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Defines the custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [];
    }

    public function getData(): array
    {
        return $this->validatedData;
    }

    public function getState(): ?string
    {
        return $this->state ?? null;
    }
}
