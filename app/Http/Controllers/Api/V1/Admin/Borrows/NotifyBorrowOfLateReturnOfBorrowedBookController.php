<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Borrows;

use Domains\Admin\Services\BorrowService;
use Domains\User\Models\Borrow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class NotifyBorrowOfLateReturnOfBorrowedBookController {
    public function __construct(
        protected BorrowService $service
    ) {
    }

    public function __invoke(Borrow $borrow): JsonResponse {
        try {
            $this->service->notifyBorrowerOfLateReturnOfBorrowedBook(borrow: $borrow);
            return response()->json(
                data:[
                    'error' => 0,
                    'message' => 'Borrower notified successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data:[
                    'error' => 1,
                    'message' => 'Something went wrong.Notification not send.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
