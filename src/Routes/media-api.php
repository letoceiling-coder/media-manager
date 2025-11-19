<?php

use Illuminate\Support\Facades\Route;
use LetoceilingCoder\MediaManager\Http\Controllers\Api\FolderController;
use LetoceilingCoder\MediaManager\Http\Controllers\Api\MediaController;

/*
|--------------------------------------------------------------------------
| Media2 API Routes (без токенов авторизации)
|--------------------------------------------------------------------------
|
| Роуты для работы с медиа-файлами и папками
| Все роуты доступны без токенов авторизации
|
*/

// Роуты для папок
Route::get('folders/tree/all', [FolderController::class, 'tree'])->name('media2.folders.tree');
Route::post('folders/update-positions', [FolderController::class, 'updatePositions'])->name('media2.folders.update-positions');
Route::post('folders/{id}/restore', [FolderController::class, 'restore'])->name('media2.folders.restore');
Route::apiResource('folders', FolderController::class)->names([
    'index' => 'media2.folders.index',
    'store' => 'media2.folders.store',
    'show' => 'media2.folders.show',
    'update' => 'media2.folders.update',
    'destroy' => 'media2.folders.destroy',
]);

// Роуты для медиа-файлов
Route::post('media/{id}/restore', [MediaController::class, 'restore'])->name('media2.media.restore');
Route::delete('media/trash/empty', [MediaController::class, 'emptyTrash'])->name('media2.media.trash.empty');
Route::apiResource('media', MediaController::class)->names([
    'index' => 'media2.media.index',
    'store' => 'media2.media.store',
    'show' => 'media2.media.show',
    'update' => 'media2.media.update',
    'destroy' => 'media2.media.destroy',
]);

