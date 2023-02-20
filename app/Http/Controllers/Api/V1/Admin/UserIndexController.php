<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Resources\Shared\UserResource;
use Domains\Shared\Services\UserService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class UserIndexController {
    public function __construct(
        protected UserService $service
    ) {
    }

    public function __invoke(): JsonResponse {
        return response()->json(
            data: UserResource::collection(
                resource:  $this->service->getAllUsers()
            ),
            status: Http::OK()
        );
    }
}
