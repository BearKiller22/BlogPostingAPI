<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//http://localhost:8000/api/editComment?commentID=101&comment=editTest Edit Commentari synraxi URL dan
// http://localhost:8000/api/deletepost/17 es prosta ert arguments ro atan mashin

// Urlshi ramdenime datas ro atan " & " <- amit unda gamoyo

// POSTS
// Get All Posts || no arguments needed
Route::get('/index', [PostsController::class, 'getAll']); 

// Get User Posts || need -> id (Users id);
Route::get('/myposts/{id}', [PostsController::class, 'getUserPosts']);

// Create New Post || need -> title; user_id; body;
Route::get('/upload', [PostsController::class, 'upload']);

// Edit Post  || need -> post_id; title; body;
Route::get('editpost',[PostsController::class, 'edit']);

// Delete Post  || need -> id (Post id);
Route::get('deletepost/{id}',[PostsController::class, 'delete']);



// Create Comment || need -> user_id; post_id; body
Route::get('/addComment', [PostsController::class, 'addComment']);

// Delete Comment || need -> id ( Comment ID );
Route::get('deleteComment/{id}',[PostsController::class, 'deleteComment']);

// Edit Comment  || need -> commentID; comment
Route::get('editComment',[PostsController::class, 'editComment']);



// Edit Profile  || need ->  id ( User ID ); name; email; password;
Route::get('editProfile',[UserController::class, 'test']);



// Register  || need -> name; email; password
Route::get('/register', [RegisteredUserController::class, 'store']);

// Login || need -> email; password;
Route::get('/login', [AuthenticatedSessionController::class, 'store_api']); // ar mushaobs jer




Route::group(['middleware' => ['auth:sanctum']], function(){
    // Protected Routes Go here (only users with token can go here);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Add Comment URL
// http://localhost:8000/api/addComment?user_id=51&post_id=16&body=apiaddcommenttestiaagi

// Edit Comment URL
// http://localhost:8000/api/editComment?commentID=104&comment=editCommentWorks

// Register URL
// http://localhost:8000/api/register?name=datvi&email=datvi@gmail.com&password=asdasdasd