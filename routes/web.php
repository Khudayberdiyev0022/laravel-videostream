<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('/crypt',[\App\Http\Controllers\VideoController::class,'crypt']);
Route::get('/tree',[\App\Http\Controllers\VideoController::class,'tree']);
Route::get('/tree2',[\App\Http\Controllers\VideoController::class,'tree2']);
Route::get('/{slug}', [\App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');

Route::prefix('uploads')->group(function () {
  Route::get('/playlist/{folder}/{file}', [\App\Http\Controllers\VideoController::class, 'getVideo'])->name('video.playlist');
  Route::get('/video/{folder}/{file}', [\App\Http\Controllers\VideoController::class, 'getFile'])->name('video.file');
  Route::get('/key/{folder}/{key}', [\App\Http\Controllers\VideoController::class, 'getKey'])->name('video.key');
});
