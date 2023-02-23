<?php

declare(strict_types=1);

namespace App\Http\Resources\Shared;

use App\Http\Resources\User\BorrowResource;
use App\Http\Resources\User\NotificationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    public function toArray($request): array {
        return [
            'id' => $this->id,
            'type' => 'user',
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'bookBorrows' => BorrowResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'bookBorrows'
                    )
                ),
                'notifications' => NotificationResource::collection(
                    $this->whenLoaded(
                        relationship: 'notifications'
                    )
                )
            ]
        ];
    }
}
