<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin\Librarians;

use Domains\Admin\Services\LibrarianService;
use Domains\Shared\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use JustSteveKing\StatusCode\Http;

class LibrarianUpdateController {
    public function __invoke(Request $request, User $librarian, LibrarianService $librarianService): JsonResponse {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string'
                ],
                'email' => [
                    'required',
                    'string',
                    Rule::unique('users', 'email')->ignore(id: $librarian->id),
                ],
                'password' => [
                    'required',
                    'string'
                ],

            ]);

            $librarianService->updateLibrarian(
                librarianUpdateData: $validated,
                librarian: $librarian
            );

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Librarian updated successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Librarian not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
