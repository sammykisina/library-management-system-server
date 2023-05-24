<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Domains\Shared\Services\UserService;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

class RegisterController {
    public function __construct(
        protected UserService $service
    ) {
    }

    public function __invoke(RegisterRequest $request): JsonResponse {
        if ($user = $this->service->storeNewUser(newUserStoreData: $request->newUserStoreData())) {
            $role = $user->role()->pluck('slug')->all();
            $plainTextToken = $user->createToken('lms-api-token', $role)->plainTextToken;

            return response()->json(
                data: [
                    'error' => 0,
                    'message' => 'Account Created. Welcome',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'role' => $role[0],
                    ],
                    'token' => $plainTextToken
                ],
                status: Http::ACCEPTED()
            );
        }

        return response()->json(
            data: [
                'error' => 1,
                'message' => 'Something went wrong. Account not created.',
            ],
            status: Http::NOT_IMPLEMENTED()
        );
    }
}
