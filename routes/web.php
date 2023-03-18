<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth/login');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {

    //home route
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //post routes
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}', [PostController::class, 'getOnePost'])->name('post');
    Route::delete('/post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
    Route::put('/post/update/', [PostController::class, 'update'])->name('post.update');

    //comment routes
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
    Route::put('/comment/update/', [CommentController::class, 'update'])->name('comment.update');

    //reply routes
    Route::post('/reply/store', [ReplyController::class, 'store'])->name('reply.store');
    Route::delete('/reply/delete/{id}', [ReplyController::class, 'destroy'])->name('reply.delete');
    Route::put('/reply/update/', [ReplyController::class, 'update'])->name('reply.update');


});