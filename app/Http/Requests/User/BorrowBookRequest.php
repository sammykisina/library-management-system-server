<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Domains\User\Enums\BorrowedBookStatuses;
use Illuminate\Foundation\Http\FormRequest;

class BorrowBookRequest extends FormRequest {
    public function rules(): array {
        return [
            'dateBorrowed' => [
                'required',
                'string'
            ],
            'dateToReturn' => [
                'required',
                'string'
            ]
        ];
    }

    public function borrowBookData(): array {
        $borrowBookData = $this->validated();
        $borrowBookData['status'] = BorrowedBookStatuses::NOTAPPROVED->value;
        return $borrowBookData;
    }
}
