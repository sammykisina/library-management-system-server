<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Domains\Shared\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreLibrarianRequest extends FormRequest {
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
            ]
        ];
    }
     public function newLibrarianData(): array {
         $data = $this->validated();
         $adminUserRole = Role::query()->where('slug', 'admin')->first();
         $data['password'] = Hash::make(value: $data['password']);
         $data['role_id'] = $adminUserRole->id;
         return $data;
     }
}
