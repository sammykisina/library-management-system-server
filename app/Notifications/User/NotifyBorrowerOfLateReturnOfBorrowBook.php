<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NotifyBorrowerOfLateReturnOfBorrowBook extends Notification {
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
            'title' => "Late Borrowed Book Return.",
            'description' => "This is to inform you that due to failure of returning the borrowed book, ".$this->borrow->book->isbn."  in time, each day after the indicated date of return will be charged a cost of 5 (USD).",
            'action' => 'Visit the library for further inquires.'
        ];
    }
}
