<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReturnBookToday extends Notification {
    use Queueable;

    public function __construct(
        public Borrow $borrow
    ) {
    }

    public function via(object $notifiable): array {
        return ['database'];
    }

    public function toArray(object $notifiable): array {
        return [
            'tag' => 'notify',
            'title' => "Book Return Notification.",
            'description' => "This is a kind reminder that the book, ".$this->borrow->book->isbn." you borrowed 7 days ago should be  returned to the library today to avoid late return penates.",
            'action' => 'Make a point of visiting the library today. Here to serve you.'
        ];
    }
}
