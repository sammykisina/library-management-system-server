<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Shared\Models\Role;
use Domains\Shared\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $adminRole = Role::query()->where('slug', 'admin')->first();
        User::create([
            'name' => 'Librarian',
            'email' => 'librarian@librarian.com',
            'password' => Hash::make(value: 'admin'),
            'role_id' => $adminRole->id,
        ]);
    }
}
