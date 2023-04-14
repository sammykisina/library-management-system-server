<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Librarians;

use App\Http\Requests\Admin\StoreLibrarianRequest;
use Domains\Admin\Services\LibrarianService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class LibrarianStoreController {
    public function __invoke(StoreLibrarianRequest $request, LibrarianService $librarianService): JsonResponse {
        try {
            $librarianService->storeLibrarian(
                newLibrarianData: $request->newLibrarianData()
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Librarian created successfully.'
                ],
                status: Http::CREATED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Librarian not created.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
