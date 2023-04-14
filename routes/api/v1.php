<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Admin\Books\DeleteBookController;
use App\Http\Controllers\Api\V1\Admin\Books\StoreBookController;
use App\Http\Controllers\Api\V1\Admin\Books\StoreBookLocationController;
use App\Http\Controllers\Api\V1\Admin\Books\UpdateBookController;
use App\Http\Controllers\Api\V1\Admin\Borrows\ApproveBookBorrowController;
use App\Http\Controllers\Api\V1\Admin\Borrows\NotifyBorrowOfLateReturnOfBorrowedBookController;
use App\Http\Controllers\Api\V1\Admin\Borrows\NotifyToReturnBookTodayController;
use App\Http\Controllers\Api\V1\Admin\Borrows\ReceiveBookBackController;
use App\Http\Controllers\Api\V1\Admin\Borrows\RejectBookBorrowController;
use App\Http\Controllers\Api\V1\Admin\Librarians\LibrarianDeleteController;
use App\Http\Controllers\Api\V1\Admin\Librarians\LibrarianIndexController;
use App\Http\Controllers\Api\V1\Admin\Librarians\LibrarianStoreController;
use App\Http\Controllers\Api\V1\Admin\Librarians\LibrarianUpdateController;
use App\Http\Controllers\Api\V1\Admin\UserIndexController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Shared\Books\IndexBookController;
use App\Http\Controllers\Api\V1\User\Borrows\DeleteBorrowController;
use App\Http\Controllers\Api\V1\User\Borrows\IndexBorrowController;
use App\Http\Controllers\Api\V1\User\Borrows\StoreBorrowController;
use App\Http\Controllers\Api\V1\User\Profile\GetProfileController;
use App\Http\Controllers\Api\V1\User\Profile\UpdatePasswordController;
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
    Route::post("/books", StoreBookController::class)->name(name: 'bookStore');
    Route::patch("/books/{book}", UpdateBookController::class)->name(name: 'bookUpdate');
    Route::delete("/books/{book}", DeleteBookController::class)->name(name: 'bookDelete');
    Route::post("/books/{book}/location", StoreBookLocationController::class)->name(name: 'bookLocationStore');

    /**
     * borrows management routes
     */
    Route::get("/books/borrows", IndexBorrowController::class)->name(name: 'bookBorrowIndex');
    Route::post("/books/borrows/{borrow}/reject", RejectBookBorrowController::class)->name(name: 'bookBorrowReject');
    Route::post("/books/borrows/{borrow}/approve", ApproveBookBorrowController::class)->name(name: 'bookBorrowApprove');
    Route::post("/books/borrows/{borrow}/notify-to-return-book-today", NotifyToReturnBookTodayController::class)->name(name: 'notifyToReturnBookToday');
    Route::post("/books/borrows/{borrow}/notify-of-late-return", NotifyBorrowOfLateReturnOfBorrowedBookController::class)->name(name: 'notifyOfLateReturn');
    Route::post("/books/borrows/{borrow}/receive-book", ReceiveBookBackController::class)->name(name: 'receiveBookBack');

    /**
     * librarian management routes
     */
    Route::get("/librarians", LibrarianIndexController::class)->name(name: 'librarianIndex');
    Route::post("/librarians", LibrarianStoreController::class)->name(name: 'librarianStore');
    Route::patch("/librarians/{librarian}", LibrarianUpdateController::class)->name(name: 'librarianUpdate');
    Route::delete("/librarians/{librarian}", LibrarianDeleteController::class)->name(name: 'librarianDelete');
});

/**
 * routes shared by all authenticated users
 */
Route::group([
    'prefix' => 'users',
    'as' => 'users:',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get("/books", IndexBookController::class)->name(name: 'booksIndex');
    Route::post("/{user}/books/{book}/borrow", StoreBorrowController::class)->name(name: 'bookBorrowStore');

    Route::delete("/borrows/{borrow}", DeleteBorrowController::class)->name(name: 'bookBorrowDelete');

    /**
     * get current user profile
     */
    Route::get("/{user}/profile}", GetProfileController::class)->name(name: 'profile');
    Route::post("users/password-reset", UpdatePasswordController::class)->name(name: 'password-reset');
});
