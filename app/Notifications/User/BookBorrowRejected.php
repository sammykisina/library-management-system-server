<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookBorrowRejected extends Notification {
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
            'tag' => 'reject',
            'title' => "Book Borrow Rejected.",
            'description' => "The book borrow you initiated of book ".$this->borrow->book->isbn." was rejected by the librarian",
            'action' => 'Visit the library for further inquires.'
        ];
    }
}
