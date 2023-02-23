<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\User\Profile;

use App\Http\Resources\Shared\UserResource;
use Domains\Shared\Models\User;
use Domains\User\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class GetProfileController {
    public function __construct(
        protected ProfileService $service
    ) {
    }

    public function __invoke(User $user): JsonResponse {
        return response()->json(
            data: new UserResource(
                resource: $this->service->getProfile(user: $user)
            )
        );
    }
}
