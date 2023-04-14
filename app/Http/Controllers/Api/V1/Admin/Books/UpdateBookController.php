<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Books;

use Domains\Admin\Enums\BookStatus;
use Domains\Admin\Models\Book;
use Domains\Admin\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use JustSteveKing\StatusCode\Http;

class UpdateBookController {
    public function __construct(
        protected BookService $service
    ) {
    }

    public function __invoke(Request $request, Book $book) {
        try {
            $validated = $request->validate([
                'isbn' => [
                    'required',
                    'string',
                    Rule::unique('books', 'isbn')->ignore(id: $book->id),
                ],
                'name' => [
                    'required',
                    'string',
                ],
                'author' => [
                    'required',
                    'string'
                ],
                'publisher' => [
                    'required',
                    'string',
                ],
                'dateOfPublish' => [
                    'required',
                    'string',
                ],
                'publisherAddress' => [
                    'required',
                    'string',
                ],
                'price' => [
                    'required',
                    'numeric',
                    'min:1'
                ],
                'description' => [
                    'required',
                    'string',
                ],
                'count' => [
                    'required',
                    'numeric',
                    'min:1'
                ],
                'pages' => [
                    'required',
                    'numeric',
                    'min:1'
                ],
                'status' => [
                    new Enum(BookStatus::class)
                ]
            ]);

            $this->service->updateBook(
                updatedBookData: $validated,
                book: $book
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Book updated Successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Book not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
