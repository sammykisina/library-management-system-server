<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User\Borrows;

use Domains\User\Enums\BorrowedBookStatuses;
use Domains\User\Models\Borrow;
use Domains\User\Services\BorrowBookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class DeleteBorrowController {
    public function __construct(
        protected BorrowBookService $service
    ) {
    }

    public function __invoke(Borrow $borrow): JsonResponse {
        try {
            if ($borrow->status === BorrowedBookStatuses::REPORTEDLOST->value) {
                return response()->json(
                    data: [
                        'error' => 1,
                        'message' => 'The book you borrowed is reported to be lost.Please visit the library for more information.'
                    ],
                    status: Http::NOT_IMPLEMENTED()
                );
            }

            $this->service->deleteBookBorrow(borrow: $borrow);
            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Record deleted successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong.Book borrow record is not delete.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
