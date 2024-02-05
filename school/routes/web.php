<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::group(['middleware' => 'admin'], function()
{
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->name('all.user');
        Route::post('add-user', 'addUser')->name('add.user');
        Route::post('delete-user/{id}', 'deleteUser')->name('delete.user');
        Route::get('edit-user/{id}', 'editUser')->name('edit.user');
        Route::put('update-user/{id}', 'updateUser')->name('update.user');
        Route::get('filter-use', 'filterUser')->name('filter.user');
        Route::get('search-user', 'searchUser')->name('search.user');
    });

    Route::controller(ClassRoomController::class)->group(function (){

        Route::get('class', 'index')->name('all.class');
        Route::post('add-class', 'addClass')->name('add.class');
        Route::get('edit-class/{id}', 'editClass')->name('edit.class');
        Route::put('update-class/{id}', 'updateClass')->name('update.class');
        Route::get('filter-class', 'filterClass')->name('filter.class');
    });

    Route::controller(SubjectsController::class)->group(function (){

        Route::get('subject', 'index')->name('all.subject');
        Route::post('add-subject', 'addSubject')->name('add.subject');
        Route::get('edit-subject/{id}', 'editSubject')->name('edit.subject');
        Route::put('update-subject/{id}', 'updateSubject')->name('update.subject');
        Route::post('assign-subject', 'assignSubject')->name('assign.subject');
    });

    Route::controller(StudentsController::class)->group(function (){
        Route::get('student', 'index')->name('all.student');
        Route::post('add-student', 'addStudent')->name('add.student');
        Route::get('edit-student/{id}', 'editStudent')->name('edit.student');
        Route::post('update-student/{id}', 'updateStudent')->name('update.student');
        Route::get('filter-student', 'filterStudent')->name('filter.student');
    });

    Route::controller(ParentController::class)->group(function(){
        Route::get('parent', 'index')->name('all.parent');
        Route::post('add-parent', 'addParent')->name('add.parent');
    });



});


Route::group(['middleware' => 'teacher'], function()
{
    Route::get('teacher', [DashboardController::class, 'dashboard'])->name('teacher.dashboard');
});
