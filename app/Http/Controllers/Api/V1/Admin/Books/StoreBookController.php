<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Books;

use App\Http\Requests\Admin\BookStoreRequest;
use Domains\Admin\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class StoreBookController {
    public function __construct(
        protected BookService $service
    ) {
    }

    public function __invoke(BookStoreRequest $request): JsonResponse {
        try {
            $this->service->storeBook(
                newBookData: $request->bookStoreData()
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Book created successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Book not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
