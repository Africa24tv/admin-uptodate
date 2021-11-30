<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BanerController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\posts\EventController;
use App\Http\Controllers\posts\ScrollController;
use App\Http\Controllers\posts\ArticleController;
use App\Http\Controllers\posts\NewsexpressController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles', [ArticleController::class, 'articlesPubliers']);

Route::get('articles/show/{id}', [ArticleController::class, 'article']);

Route::get('evenements', [EventController::class, 'eventsPubliers']);

Route::get('scrolls', [ScrollController::class, 'scrolls']);

Route::get('subjects', [SubjectController::class, 'subjects']);

Route::get('categories', [SubjectController::class, 'categories']);

Route::get('subject/{id}/articles', [SubjectController::class, 'subjectArticles']);

Route::get('subject/{id}/events', [SubjectController::class, 'subjectEvents']);

Route::get('programmes/presentations', [SubjectController::class, 'programmesPresentations']);

Route::get('newsexpresses', [NewsexpressController::class, 'newsExpress']);

Route::get('regions', [SubjectController::class, 'regions']);
Route::get('regions/{slug}', [SubjectController::class, 'region']);

Route::get('baners', [BanerController::class, 'baners']);
