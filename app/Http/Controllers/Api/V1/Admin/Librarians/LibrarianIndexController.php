<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Librarians;

use App\Http\Resources\Shared\UserResource;
use Domains\Admin\Services\LibrarianService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class LibrarianIndexController {
    public function __invoke(LibrarianService $librarianService): JsonResponse {
        return response()->json(
            data: UserResource::collection(
                resource: $librarianService->getAllLibrarians()
            ),
            status: Http::OK()
        );
    }
}
