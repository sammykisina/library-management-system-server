<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Borrows;

use Domains\Admin\Services\BorrowService;
use Domains\User\Models\Borrow;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class RejectBookBorrowController {
    public function __construct(
        protected BorrowService $service
    ) {
    }

    public function __invoke(Borrow $borrow): JsonResponse {
        try {
            $this->service->rejectBookBorrow(borrow: $borrow);
            return response()->json(
                data:[
                    'error' => 0,
                    'message' => 'Initiated book borrow was rejected successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data:[
                    'error' => 1,
                    'message' => 'Something went wrong.Borrow not rejected.Try Deleting instead.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
