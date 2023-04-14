<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'type' => "notification",
            'attributes' => [
                'tag' => $this->data['tag'],
                'title' => $this->data['title'],
                'description' => $this->data['description'],
                'action' => $this->data['action'],
                'createdAt' => $this->created_at
            ]
        ];
    }
}
