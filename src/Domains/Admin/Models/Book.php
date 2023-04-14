<?php

declare(strict_types=1);

namespace Domains\Admin\Models;

use Domains\Admin\Enums\BookStatus;
use Domains\User\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model {
    use HasFactory;

    protected $fillable =  [
        'isbn',
        'name',
        'author',
        'publisher',
        'dateOfPublish',
        'publisherAddress',
        'price',
        'description',
        'count',
        'currentCount',
        'pages',
        'status',
        'block',
        'shelve',
        'row'
    ];

    protected $casts = [
        'status' => BookStatus::class
    ];

    public function borrows(): HasMany {
        return $this->hasMany(
            related: Borrow::class,
            foreignKey: 'book_id'
        );
    }
}
