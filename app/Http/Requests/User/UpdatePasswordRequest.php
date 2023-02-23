<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }
    public function updatedPasswordData(): array {
        $data = $this->validated();
        $data['password']  = Hash::make(value: $data['password']);
        return $data;
    }
}
