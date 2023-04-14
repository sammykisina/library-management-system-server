<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Http\Resources\User\BorrowResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'attributes' => [
                'isbn' => $this->isbn,
                'name' => $this->name,
                'author' => $this->author,
                'publisher' => $this->publisher,
                'dateOfPublish' => $this->dateOfPublish,
                'publisherAddress' => $this->publisherAddress,
                'price' => $this->price,
                'description' => $this->description,
                'count' => $this->count,
                'currentCount' => $this->currentCount,
                'pages' => $this->pages,
                'status' => $this->status,
                'block' => $this->block,
                'shelve' => $this->shelve,
                'row' => $this->row,
                'createdAt' => $this->created_at
            ],
            'relationships' => [
                'borrows' => BorrowResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'borrows'
                    )
                )
            ]
        ];
    }
}
