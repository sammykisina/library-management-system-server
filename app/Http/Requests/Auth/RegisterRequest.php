<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Domains\Shared\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'string',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string'
            ],
            'phone' => [
                'required',
                'string'
            ]
        ];
    }

    public function newUserStoreData(): array {
        $data = $this->validated();
        $defaultUserRole = Role::query()->where('slug', 'user')->first();
        $data['password'] = Hash::make(value: $data['password']);
        $data['role_id'] = $defaultUserRole->id;
        return $data;
    }
}
