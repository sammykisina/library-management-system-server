<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User\Borrows;

use App\Http\Resources\User\BorrowResource;
use Domains\User\Services\BorrowBookService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexBorrowController {
    public function __construct(
        protected BorrowBookService $service
    ) {
    }

    public function __invoke(): JsonResponse {
        return response()->json(
            data: BorrowResource::collection(
                resource: $this->service->getAllBorrows()
            ),
            status: Http::OK()
        );
    }
}
