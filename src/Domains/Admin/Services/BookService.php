<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use Domains\Admin\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class BookService {
    public function fetchAllBooks(): Collection {
        return QueryBuilder::for(Book::class)
        ->allowedIncludes(includes:['borrows.book', 'borrows.borrower'])
          ->defaultSort('-created_at')
          ->get();
    }

    public function storeBook(array $newBookData): void {
        Book::create($newBookData);
    }

    public function updateBook(array $updatedBookData, Book $book): void {
        $book->update($updatedBookData);
    }

    public function deleteBook(Book $book): void {
        $book->delete();
    }

    public function storeBookLocation(array $bookLocationData, Book $book): void {
        $book->update($bookLocationData);
    }
}
