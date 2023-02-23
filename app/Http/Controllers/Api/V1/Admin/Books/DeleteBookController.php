<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Books;

use Domains\Admin\Models\Book;
use Domains\Admin\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class DeleteBookController {
    public function __construct(
        protected BookService $service
    ) {
    }

    public function __invoke(Book $book): JsonResponse {
        try {
            $this->service->deleteBook(book: $book);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Book deleted successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Book not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
