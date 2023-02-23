<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookLocationStoreRequest extends FormRequest {
    public function rules(): array {
        return [
            'block' => [
                'required',
                'string',
            ],
            'shelve' => [
                'required',
                'string',
            ],
            'row' => [
                'required',
                'string',
            ]
        ];
    }

    public function bookLocationData(): array {
        return $this->validated();
    }
}
