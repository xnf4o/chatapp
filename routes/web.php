<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('home');

//override logout route
Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::prefix('panel')->middleware("auth")->group(function(){
    Route::controller(TaskController::class)->name('task.')->prefix('task')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::match(['get', 'post'], '/create', 'create')->name('create');
    });
});
