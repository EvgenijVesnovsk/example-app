<?php

namespace App\DTOs;

use WendellAdriel\ValidatedDTO\Casting\IntegerCast;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class BookIndexDTO extends ValidatedDTO
{
    public string $sort;
    public string $by;
    public int $per_page;
    public string $title;
    public string $state;

    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'sort' => [],
            'by' => ['in:asc,desc'],
            'per_page' => ['int'],
            'title' => ['string'],
            'state' => ['string'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [
            'sort' => 'updated_at',
            'by' => 'desc',
            'per_page' => 25,
        ];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [
            'per_page' => new IntegerCast()
        ];
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

    public function getSort(): string
    {
        return $this->sort;
    }

    public function getBy(): string
    {
        return $this->by;
    }

    public function getPerGage(): int
    {
        return $this->per_page;
    }
}
