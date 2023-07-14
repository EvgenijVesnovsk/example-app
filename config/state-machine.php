<?php

return [
    'audio' => [
        'class' => App\Models\Book::class,
        'graph' => 'audio',
        'property_path' => App\Models\Book::STATE,
        'metadata' => [
            'title' => 'Agreement stage',
        ],
        'callbacks' => [
            'guard' => [],
        ],
        'states' => [
            [
                'name' => \App\Enums\BookStates::DRAFT->value,
                'metadata' => [],
            ],
            [
                'name' => \App\Enums\BookStates::PRODUCTION->value,
                'metadata' => [],
            ],
            [
                'name' => \App\Enums\BookStates::PRINT->value,
                'metadata' => [],
            ],
            [
                'name' => \App\Enums\BookStates::DONE->value,
                'metadata' => [],
            ],
        ],

        'transitions' => [
            \App\Enums\BookStates::DRAFT->value => [
                'from' => [
                    \App\Enums\BookStates::PRODUCTION->value,
                    \App\Enums\BookStates::PRINT->value,
                ],
                'to' => \App\Enums\BookStates::DRAFT->value,
            ],
            \App\Enums\BookStates::PRODUCTION->value => [
                'from' => [
                    \App\Enums\BookStates::DRAFT->value,
                    \App\Enums\BookStates::PRINT->value,
                ],
                'to' => \App\Enums\BookStates::PRODUCTION->value,
            ],
            \App\Enums\BookStates::PRINT->value => [
                'from' => [
                    \App\Enums\BookStates::DRAFT->value,
                    \App\Enums\BookStates::PRODUCTION->value,
                ],
                'to' => \App\Enums\BookStates::PRINT->value,
            ],
            \App\Enums\BookStates::DONE->value => [
                'from' => [
                    \App\Enums\BookStates::PRINT->value
                ],
                'to' => \App\Enums\BookStates::DONE->value,
            ],
        ],
    ],
];
