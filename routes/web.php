<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\local\TypeController;
use App\Http\Controllers\local\BanerController;
use App\Http\Controllers\local\MediaController;
use App\Http\Controllers\local\TacheController;
use App\Http\Controllers\local\ScrollController;
use App\Http\Controllers\local\SubjectController;
use App\Http\Controllers\local\DashboardController;
use App\Http\Controllers\local\NewsexpressController;
use App\Http\Controllers\local\posts\EventController;
use App\Http\Controllers\local\accounts\RoleController;
use App\Http\Controllers\local\accounts\UserController;
use App\Http\Controllers\local\posts\ArticleController;
use App\Http\Controllers\local\accounts\PermissionController;

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

Route::middleware('auth')->group(function()
{
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('scrolls', ScrollController::class);

    Route::resource('subjects', SubjectController::class);

    Route::resource('articles', ArticleController::class);

    Route::get('baners', [BanerController::class, 'index'])->name('baners.index');
    Route::get('baners/create', [BanerController::class, 'create'])->name('baners.create');
    Route::post('baners', [BanerController::class, 'store'])->name('baners.store');
    Route::delete('baners/{baner}', [BanerController::class, 'destroy'])->name('baners.destroy');

    Route::resource('events', EventController::class);

    Route::resource('types', TypeController::class);

    Route::resource('taches', TacheController::class);

    Route::resource('medias', MediaController::class);

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::resource('newsexpresses', NewsexpressController::class);

    Route::get('youtube', [MediaController::class, 'youtube']);
});



require __DIR__.'/auth.php';
