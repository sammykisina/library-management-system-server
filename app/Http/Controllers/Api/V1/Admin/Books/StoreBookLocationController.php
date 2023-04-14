<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Books;

use App\Http\Requests\Admin\BookLocationStoreRequest;
use Domains\Admin\Models\Book;
use Domains\Admin\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class StoreBookLocationController {
    public function __construct(
        protected BookService $service
    ) {
    }

    public function __invoke(BookLocationStoreRequest $request, Book $book): JsonResponse {
        try {
            $this->service->storeBookLocation(
                bookLocationData: $request->bookLocationData(),
                book: $book
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Book location created successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Something went wrong. Book location not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
