<?php

declare(strict_types=1);

namespace Domains\User\Models;

use Domains\Admin\Models\Book;
use Domains\Shared\Models\User;
use Domains\User\Enums\BorrowedBookStatuses;
use Domains\User\Enums\ReturnedBookConditions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model {
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'dateBorrowed',
        'dateToReturn',
        'dateReturned',
        'bookCondition',
        'charges',
        'status'
    ];

    protected $casts = [
        'bookCondition' => ReturnedBookConditions::class,
        'status' => BorrowedBookStatuses::class,
    ];

    public function borrower(): BelongsTo {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id'
        );
    }

    public function book(): BelongsTo {
        return $this->belongsTo(
            related: Book::class,
            foreignKey: 'book_id'
        );
    }
}
