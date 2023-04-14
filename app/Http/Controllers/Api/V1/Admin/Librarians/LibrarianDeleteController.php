<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Librarians;

use Domains\Admin\Services\LibrarianService;
use Domains\Shared\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class LibrarianDeleteController {
    public function __invoke(User $librarian, LibrarianService $librarianService): JsonResponse {
        try {
            $librarianService->deleteLibrarian(
                librarian: $librarian
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Librarian created successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Librarian not deleted.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
