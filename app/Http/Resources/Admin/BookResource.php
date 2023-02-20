<?php

declare(strict_types=1);

namespace App\Http\Resources\Admin;

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
                'yearOfPublisher' => $this->yearOfPublisher,
                'price' => $this->price,
                'description' => $this->description,
                'count' => $this->count,
                'pages' => $this->pages,
                'status' => $this->status
            ]
        ];
    }
}
