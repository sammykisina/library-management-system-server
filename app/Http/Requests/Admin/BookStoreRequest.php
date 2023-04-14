<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Domains\Admin\Enums\BookStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'isbn' => [
                'required',
                'string',
                'unique:books,isbn'
            ],
            'name' => [
                'required',
                'string',
            ],
            'author' => [
                'required',
                'string'
            ],
            'publisher' => [
                'required',
                'string',
            ],
            'dateOfPublish' => [
                'required',
                'string',
            ],
            'publisherAddress' => [
                'required',
                'string',
            ],
            'price' => [
                'required',
                'numeric',
                'min:1'
            ],
            'description' => [
                'required',
                'string',
            ],
            'count' => [
                'required',
                'numeric',
                'min:1'
            ],
            'pages' => [
                'required',
                'numeric',
                'min:1'
            ],
            'status' => [
                new Enum(BookStatus::class)
            ]
        ];
    }

    public function bookStoreData(): array {
        $bookStoreData = $this->validated();
        $bookStoreData['currentCount'] = $bookStoreData['count'];
        return $bookStoreData;
    }
}
