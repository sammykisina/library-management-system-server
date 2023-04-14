<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'isbn')->unique();

            $table->string(column: 'name');
            $table->string(column: 'author');
            $table->string(column: 'publisher');
            $table->string(column: 'dateOfPublish');
            $table->string(column: 'publisherAddress');
            $table->integer(column: 'price');
            $table->text(column: 'description');
            $table->integer(column: 'count');
            $table->integer(column: 'currentCount');
            $table->integer(column: 'pages');
            $table->string(column: 'status');

            $table->string(column: 'block')->nullable();
            $table->string(column: 'shelve')->nullable();
            $table->string(column: 'row')->nullable();

            $table->timestamps();
        });
    }
};
