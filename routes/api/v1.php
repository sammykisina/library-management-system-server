<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Admin\Books\DeleteBookController;
use App\Http\Controllers\Api\V1\Admin\Books\IndexBookController;
use App\Http\Controllers\Api\V1\Admin\Books\StoreBookController;
use App\Http\Controllers\Api\V1\Admin\Books\UpdateBookController;
use App\Http\Controllers\Api\V1\Admin\UserIndexController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/**
 * auth routes
 */
Route::prefix('auth')->as('auth:')->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class)->name('register');
});

/**
 * routes to be accessed by admin
 */
Route::group([
    'prefix' => 'admin',
    'as' => 'admin:',
    'middleware' => ['auth:sanctum', 'abilities:admin']
], function () {
    Route::get("/users", UserIndexController::class)->name(name: 'users');
    
    /**
     * book management routes
     */
    Route::get("/books", IndexBookController::class)->name(name: 'booksIndex');
    Route::post("/books", StoreBookController::class)->name(name: 'bookStore');
    Route::post("/books/{book}", UpdateBookController::class)->name(name: 'bookUpdate');
    Route::delete("/books/{book}", DeleteBookController::class)->name(name: 'bookDelete');
});

/**
 * routes for lectures only
 */

Route::group([
    'prefix' => 'lecturers',
    'as' => 'lecturers:',
    'middleware' => ['auth:sanctum', 'abilities:lecturer']
], function () {
});

/**
 * routes shared by all authenticated users
 */
Route::group([
    'prefix' => 'users',
    'as' => 'users:',
    'middleware' => ['auth:sanctum']
], function () {
});
