<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();

            $table->foreignId(column: 'book_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId(column: 'user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->string(column: 'dateBorrowed');
            $table->string(column: 'dateToReturn');
            $table->string(column: 'status');
            $table->string(column: 'dateReturned')->nullable();
            $table->string(column: 'bookCondition')->nullable();
            $table->integer(column: 'charges')->default(0);

            $table->timestamps();
        });
    }
};
