<?php

declare(strict_types=1);

namespace Domains\User\Services;

use Domains\Shared\Models\User;

class ProfileService {
    public function getProfile(User $user): User {
        return User::query()
          ->where('id', $user->id)
          ->with(['bookBorrows.book', 'notifications'])
          ->first();
    }

    public function updatePassword(array $updatePasswordData): void {
        $user = User::query()
            ->where('email', $updatePasswordData['email'])
            ->first();

        $user->update([
            'password' => $updatePasswordData['password']
        ]);
    }
}
