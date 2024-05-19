<?php

use App\Http\Controllers\Dashboard\AlbumController;
use App\Http\Controllers\Dashboard\MultiImageUploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('albums/{album}/upload', [MultiImageUploadController::class, 'upload'])->name('albums.upload');
Route::post('albums/{album}/upload', [MultiImageUploadController::class, 'store'])->name('albums.storeImage');
Route::delete('/images/{id}', [MultiImageUploadController::class, 'destroy'])->name('images.destroy');
Route::get('/images/{id}/move', [MultiImageUploadController::class, 'showMoveForm'])->name('images.move');
Route::post('/images/{id}/move', [MultiImageUploadController::class, 'move'])->name('images.move.update');
Route::delete('/albums/{albumId}/delete-images', [AlbumController::class, 'deleteImagesInAlbum'])->name('albums.delete-images');





Route::resource('albums',AlbumController::class);

