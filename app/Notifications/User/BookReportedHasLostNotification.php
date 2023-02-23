<?php

declare(strict_types=1);

namespace App\Notifications\User;

use Domains\User\Models\Borrow;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookReportedHasLostNotification extends Notification {
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
             'title' => "Book Reported Has Lost.",
             'description' => "The book, ".$this->borrow->book->isbn."  has been reported to us (library) has lost. 
            Full payment has been indicated in your library history page.",
             'action' => 'Payment should be deposited in the library accounts office.'
         ];
     }
}
