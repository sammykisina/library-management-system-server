<?php

declare(strict_types=1);

namespace Domains\Shared\Services;

use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserService {
    public function storeNewUser(array $newUserStoreData): User {
        return User::create($newUserStoreData);
    }

    public function getAllUsers(): Collection {
        return QueryBuilder::for(subject: User::class)
           ->allowedIncludes(includes: ['role', 'bookBorrows'])
           ->defaultSort('-created_at')
           ->allowedFilters(filters: AllowedFilter::exact('role.slug'))
           ->get();
    }
}
