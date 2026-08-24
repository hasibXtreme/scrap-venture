<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return redirect()->route('collectors.index');
});

Route::get('/collectors/create',[CollectorController::class,'create'])->name('collectors.create');
Route::post('/collectors',[CollectorController::class,'store'])->name('collectors.store');
Route::get('/collectors',[CollectorController::class,'index'])->name('collectors.index');

Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(
    function()
    {
        Route::get('/collectors',[CollectorController::class,'adminindex'])->name('collectors.index');
        Route::patch('/collectors/{collector}/verify',[CollectorController::class,'verify'])->name('collectors.verify');
        Route::delete('/collectors/{collector}/',[CollectorController::class,'destroy'])->name('collectors.destroy');
    }
);

Route::get('/login',[AuthController::class,'loginpage'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('login.submit');
Route::post('logout',[AuthController::class,'logout'])->name('logout');