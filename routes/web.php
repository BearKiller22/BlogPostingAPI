<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

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

Route::get('/index', [PostsController::class, 'getAll'])->name('index'); //Works On Api
Route::get('/', [PostsController::class, 'getAll'])->name('index');

Route::get('deleteComment/ {id}',[PostsController::class, 'deleteComment'])->name('deleteComment');
Route::post('editComment',[PostsController::class, 'editComment'])->name('editComment');
Route::get('editProfile',[UserController::class, 'editProfile'])->name('editProfile');

// Route::post('editComment',[PostsController::class, 'editComment'])->name('editComment');

// Route::get('/', function() {
//     return [PostsController::class, 'getAll'];
// })->middleware(['auth'])->name('dashboard');

Route::get('edit',[PostsController::class, 'edit'])->middleware(['auth'])->name('edit');
Route::get('delete/{id}',[PostsController::class, 'delete'])->middleware(['auth'])->name('delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/myposts', [PostsController::class, 'getUserPosts'])->name('myposts');
Route::get('/create', [PostsController::class, 'create'])->name('create');
Route::post('/upload', [PostsController::class, 'upload'])->name('upload');

require __DIR__.'/auth.php';
