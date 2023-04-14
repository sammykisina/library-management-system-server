<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Shared\Books;

use App\Http\Resources\Admin\BookResource;
use Domains\Admin\Services\BookService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class IndexBookController {
    public function __construct(
        protected BookService $service
    ) {
    }

    public function __invoke(): JsonResponse {
        return response()->json(
            data: BookResource::collection(
                resource: $this->service->fetchAllBooks(),
            ),
            status: Http::OK()
        );
    }
}
