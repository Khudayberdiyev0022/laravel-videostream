<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\VideoController::class, 'index'])->name('videos.index');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('service.detail');

// Dinamik sahifa (oxirida qo'yish kerak)
Route::get('/{slug}', [PageController::class, 'dynamicPage'])->name('page');
//Route::get('/{slug}', [\App\Http\Controllers\VideoController::class, 'show'])->name('videos.show');

Route::prefix('uploads')->group(function () {
  Route::get('/playlist/{folder}/{file}', [\App\Http\Controllers\VideoController::class, 'getVideo'])->name('video.playlist');
  Route::get('/video/{folder}/{file}', [\App\Http\Controllers\VideoController::class, 'getFile'])->name('video.file');
  Route::get('/key/{folder}/{key}', [\App\Http\Controllers\VideoController::class, 'getKey'])->name('video.key');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

  Route::get('/dashboard', function () {
    return view('admin.dashboard');
  })->name('dashboard');

  // Menu CRUD
  Route::resource('menus', MenuController::class);

  // Menu order update (AJAX)
  Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.update-order');
});
