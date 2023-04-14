<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Borrows;

use Domains\Admin\Services\BorrowService;
use Domains\User\Models\Borrow;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class ReceiveBookBackController {
    public function __construct(
        protected BorrowService $service
    ) {
    }

    public function __invoke(Request $request, Borrow $borrow): JsonResponse {
        try {
            $this->service->receiveBookBack(data:$request->all(), borrow: $borrow);
            return response()->json(
                data:[
                    'error' => 0,
                    'message' => 'Book received successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data:[
                    'error' => 1,
                    'message' => 'Something went wrong.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
