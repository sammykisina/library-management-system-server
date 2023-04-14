<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User\Profile;

use App\Http\Requests\User\UpdatePasswordRequest;
use Domains\User\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JustSteveKing\StatusCode\Http;

class UpdatePasswordController {
    public function __invoke(UpdatePasswordRequest $request, ProfileService $profileService): JsonResponse {
        try {
            $profileService->updatePassword(updatePasswordData: $request->updatedPasswordData());

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Password updated successfully.'
                ],
                status: Http::ACCEPTED()
            );
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'Something went wrong. Password not updated.'
                ],
                status: Http::NOT_IMPLEMENTED()
            );
        }
    }
}
