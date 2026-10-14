<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NovelController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LibraryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReadingListController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/novels', [NovelController::class, 'index']);
Route::get('/novels/{novel}', [NovelController::class, 'show']);
Route::get('/novels/{novel}/chapters', [NovelController::class, 'chapters']);
Route::get('/novels/{novel}/chapters/{number}', [NovelController::class, 'chapter']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/me', [AuthController::class, 'me']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/me/profile', [ProfileController::class, 'show']);
Route::put('/me', [ProfileController::class, 'update']);
Route::get('/me/activities', [ProfileController::class, 'activities']);

Route::get('/me/library', [LibraryController::class, 'index']);
Route::put('/me/progress/{novel}', [LibraryController::class, 'updateProgress']);

Route::get('/me/reading-lists', [ReadingListController::class, 'index']);
Route::post('/me/reading-lists', [ReadingListController::class, 'store']);
Route::post('/me/reading-lists/{list}/novels', [ReadingListController::class, 'addNovel']);
Route::delete('/me/reading-lists/{list}/novels/{novel}', [ReadingListController::class, 'removeNovel']);
});