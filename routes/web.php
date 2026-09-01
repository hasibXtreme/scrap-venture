<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

        Route::post('/products/create',[ProductController::class,'productinput'])->name('products.create');
        Route::get('/products/create',[ProductController::class,'productcreate'])->name('products.createwindow');
        Route::get('/products/{product}/update',[ProductController::class,'updatewindow'])->name('products.updatewindow');
        Route::delete('/products/{product}/delete',[ProductController::class,'productdlt'])->name('products.delete');
        Route::put('/products/{product}/update',[ProductController::class,'productupdate'])->name('products.update');
        Route::get('/products/index',[ProductController::class,'productindex'])->name('products.index');
       
    }
);


Route::get('/login',[AuthController::class,'loginpage'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');