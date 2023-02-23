<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use Domains\Shared\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class LibrarianService {
    public function getAllLibrarians(): Collection {
        return QueryBuilder::for(subject: User::class)
              ->allowedIncludes(includes: ['role'])
              ->defaultSort('-created_at')
              ->allowedFilters(filters: AllowedFilter::exact('role.slug'))
              ->get();
    }

    public function storeLibrarian(array $newLibrarianData): void {
        User::create($newLibrarianData);
    }

    public function updateLibrarian(array $librarianUpdateData, User $librarian): void {
        $librarian->update(attributes: $librarianUpdateData);
    }

    public function deleteLibrarian(User $librarian): void {
        $librarian->delete();
    }
}
