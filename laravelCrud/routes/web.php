<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// crud laravel
Route::get("/", [CrudController::class,"index"])->name("all.user");
Route::get("add", [CrudController::class,"add"])->name("add");
Route::get("add-user", [CrudController::class,"addUser"])->name("add.user");
Route::get("edit-user/{id}", [CrudController::class,"editUser"])->name("edit.user");
Route::post("update-user/{id}", [CrudController::class,"updateUser"])->name("update.user");
Route::get("delete-user/{id}", [CrudController::class,"deleteUser"])->name("delete.user");

// upload image laravel
Route::get("image", [ImageController::class, "image"])->name("image");
Route::post("image-upload", [ImageController::class, "imageUpload"])->name("image.upload");
