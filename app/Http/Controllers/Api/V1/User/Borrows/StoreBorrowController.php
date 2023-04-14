<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User\Borrows;

use App\Http\Requests\User\BorrowBookRequest;
use Domains\Admin\Models\Book;
use Domains\Shared\Models\User;
use Domains\User\Services\BorrowBookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class StoreBorrowController {
    public function __construct(
        protected BorrowBookService $service
    ) {
    }

    public function __invoke(
        BorrowBookRequest $request,
        User $user,
        Book $book
    ): JsonResponse {
        try {
            if ($book->currentCount <= 1) {
                return response()->json(
                    data: [
                        'error' => 1,
                        'message' => 'Sorry.This book can current be read from the library.'
                    ],
                    status: Http::NOT_IMPLEMENTED()
                );
            }

            $this->service->storeBookBorrow(
                borrowBookData: array_merge(
                    $request->borrowBookData(),
                    ['book_id' => $book->id,'user_id' => $user->id]
                )
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Borrowing book initiated.Please visit the counter.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Book borrow not initiated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
