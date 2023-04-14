<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookBorrowApproved extends Notification {
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
            'tag' => 'approved',
            'title' => "Book Borrow Approved.",
            'description' => "The book you requested to borrow, ".$this->borrow->book->isbn." has been approved by the librarian.",
            'action' => 'Enjoy your read. See you again soon for more.'
        ];
    }
}
