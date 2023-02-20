<?php

declare(strict_types=1);

namespace Domains\Admin\Models;

use Domains\Admin\Enums\BookStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;

    protected $fillable =  [
        'isbn',
        'name',
        'author',
        'publisher',
        'yearOfPublish',
        'price',
        'description',
        'count',
        'pages',
        'status'
    ];

    protected $casts = [
        'status' => BookStatus::class
    ];
}
