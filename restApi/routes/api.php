<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group( function(){

    Route::post('add-post', [PostController::class, 'addPost']); //Add Post
    Route::get('edit-post/{id}', [PostController::class, 'showPost']); //show Post
    Route::post('update-post', [PostController::class, 'updatePost']); //Update Post
    Route::delete('delete-post', [PostController::class, 'deletePost']); //Delete Post
    Route::get('post', [PostController::class, 'Post']); //Get Post

});



// CRUD
// C = Create
// R = Read
// U = Update
// D = Delete
