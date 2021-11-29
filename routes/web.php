<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BanerController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\posts\EventController;
use App\Http\Controllers\Medias\MediaController;
use App\Http\Controllers\posts\ScrollController;
use App\Http\Controllers\posts\ArticleController;
use App\Http\Controllers\Medias\YoutubeController;
use App\Http\Controllers\posts\NewsexpressController;
use App\Http\Controllers\accounts\RoleController;
use App\Http\Controllers\accounts\UserController;
use App\Http\Controllers\accounts\PermissionController;


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

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('scrolls', ScrollController::class);

    Route::resource('subjects', SubjectController::class);

    Route::resource('articles', ArticleController::class);

    // Route::get('baners', [BanerController::class, 'index'])->name('baners.index');
    // Route::get('baners/create', [BanerController::class, 'create'])->name('baners.create');
    // Route::post('baners', [BanerController::class, 'store'])->name('baners.store');
    // Route::delete('baners/{baner}', [BanerController::class, 'destroy'])->name('baners.destroy');

    Route::resource('baners', BanerController::class);

    Route::resource('events', EventController::class);

    Route::resource('types', TypeController::class);

    Route::resource('taches', TacheController::class);

    Route::resource('medias', MediaController::class);

    Route::post('medias/{media}/youtube/upload', [YoutubeController::class, 'upload'])->name('medias.youtube.upload');
    Route::put('medias/{media}/youtube/update', [YoutubeController::class, 'update'])->name('medias.youtube.update');

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);

    Route::resource('newsexpresses', NewsexpressController::class);
});

require __DIR__ . '/auth.php';
