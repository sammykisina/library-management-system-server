<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookReturnNotification extends Notification {
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
            'title' => "Book Return.",
            'description' => "The book, ".$this->borrow->book->isbn."  has been received. Please check your Library History under this book to see if you have been charged with anything.",
            'action' => 'If charged, all charges should be deposited in the library accounts office.'
        ];
    }
}
