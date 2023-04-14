<?php

declare(strict_types=1);

namespace Domains\Admin\Services;

use App\Notifications\User\BookBorrowApproved;
use App\Notifications\User\BookBorrowRejected;
use App\Notifications\User\BookReportedHasLostNotification;
use App\Notifications\User\BookReturnNotification;
use App\Notifications\User\NotifyBorrowerOfLateReturnOfBorrowBook;
use App\Notifications\User\ReturnBookToday;
use Domains\Admin\Models\Book;
use Domains\Shared\Models\User;
use Domains\User\Enums\BorrowedBookStatuses;
use Domains\User\Enums\ReturnedBookConditions;
use Domains\User\Models\Borrow;

class BorrowService {
    public function rejectBookBorrow(Borrow $borrow): void {
        $borrow->update([
            'status' => BorrowedBookStatuses::REJECTED->value
        ]);

        // send notification
        $borrower = User::query()
            ->where('id', $borrow->user_id)
            ->first();

        $borrower->notify(new BookBorrowRejected(borrow: $borrow));
    }

    public function approveBookBorrow(Borrow $borrow): void {
        if ($borrow->update([
            'status' => BorrowedBookStatuses::APPROVEDAWAITINGRETURN->value,
        ])) {
            // update the available book count
            $book = Book::query()
                ->where('id', $borrow->book_id)
                ->first();
            $book->update([
                'currentCount' => $book->currentCount - 1
            ]);

            // send notification
            $borrower = User::query()
                ->where('id', $borrow->user_id)
                ->first();


            $borrower->notify(new BookBorrowApproved(borrow: $borrow));
        }
    }

    public function notifyBorrowerToReturnBookToday(Borrow $borrow): void {
        if ($borrow->update([
            'status' => BorrowedBookStatuses::NOTIFIEDTORETURNBOOKTODAY->value
        ])) {
            // send notification
            $borrower = User::query()
                ->where('id', $borrow->user_id)
                ->first();

            $borrower->notify(new ReturnBookToday(borrow: $borrow));
        }
    }

    public function notifyBorrowerOfLateReturnOfBorrowedBook(Borrow $borrow): void {
        if ($borrow->update([
            'status' => BorrowedBookStatuses::NOTIFIEDOFLATERETURN->value
        ])) {
            // send notification
            $borrower = User::query()
                ->where('id', $borrow->user_id)
                ->first();

            $borrower->notify(new NotifyBorrowerOfLateReturnOfBorrowBook(borrow: $borrow));
        }
    }

    public function receiveBookBack(array $data, Borrow $borrow): void {
        if ($borrow->update([
            'status' => $data['bookCondition'] === ReturnedBookConditions::LOST->value
                ? BorrowedBookStatuses::REPORTEDLOST->value
                : BorrowedBookStatuses::RETURNED->value,
            'charges' => $data['charges'],
            'bookCondition' => $data['bookCondition'],
            'dateReturned' => $data['dateReturned']
        ])) {
            // update the available book count
            $book = Book::query()
                ->where('id', $borrow->book_id)
                ->first();
            $book->update([
                'currentCount' => $book->currentCount + 1
            ]);

            // send notification
            $borrower = User::query()
                ->where('id', $borrow->user_id)
                ->first();

            $data['bookCondition'] === ReturnedBookConditions::LOST->value
                ? $borrower->notify(new BookReportedHasLostNotification(borrow: $borrow))
                : $borrower->notify(new BookReturnNotification(borrow: $borrow));
        }
    }
}
