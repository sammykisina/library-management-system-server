<?php

declare(strict_types=1);

namespace Domains\User\Services;

use Domains\User\Models\Borrow;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class BorrowBookService {
    public function getAllBorrows(): Collection {
        return QueryBuilder::for(Borrow::class)
            ->allowedIncludes(includes: ['borrower', 'book'])
            ->defaultSort('-created_at')
            ->get();
    }

    public function storeBookBorrow(array $borrowBookData): void {
        Borrow::create($borrowBookData);
    }

    public function deleteBookBorrow(Borrow $borrow): void {
        $borrow->delete();
    }
}
