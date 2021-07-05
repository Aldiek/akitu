<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\ChatInboxController;
use App\Http\Controllers\TaskTimeController;

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

Route::get('/', function () {
    return view('welcome');
})->name("home");

Auth::routes();


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
Route::get("/dashboard", function () {
        return view("dashboard");
    });
  Route::get("/contact", function () {
        return view("contact");
    })->name("contact");
  
    Route::group(["middleware" => "superAdminChatWithAdmin"], function () {

    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
    Route::get('/inbox/{id}', [InboxController::class, 'show'])->name('inbox.show');
});

    Route::group(["middleware" => "adminChatWithUser"], function () {
        Route::get("chat/inbox", [ChatInboxController::class, "index"])->name("chat.inbox");
        Route::get("chat/inbox/{id}", [ChatInboxController::class,"show"])->name("chat.inbox.show");
    });


Route::group(["middleware" => "authAdmin"], function () {
    Route::get("/task/{id}", [TaskTimeController::class, "index"])->name("task.time");
    Route::post("/task/update/{id}", [TaskTimeController::class,"updateTask"])->name("update.task");
    });

    Route::group(["middleware" => "authUser"], function () {
    Route::get("/task-time", [TaskTimeController::class, "taskShow"])->name("task.show");
    });


    });
