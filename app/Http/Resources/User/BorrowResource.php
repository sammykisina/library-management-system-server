<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\Admin\BookResource;
use App\Http\Resources\Shared\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => 'borrow',
            'attributes' => [
                'dateBorrowed' => $this->dateBorrowed,
                'dateToReturn' => $this->dateToReturn,
                'dateReturned' => $this->dateReturned,
                'bookCondition' => $this->bookCondition,
                'charges' => $this->charges,
                'status' => $this->status,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'borrower' => new UserResource(
                    resource: $this->whenLoaded(
                        relationship: 'borrower'
                    )
                ),
                'book' => new BookResource(
                    resource: $this->whenLoaded(
                        relationship: 'book'
                    )
                )
            ]
        ];
    }
}
