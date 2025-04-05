<?php

use App\Http\Controllers\api\Category\CategoriesContoller;
use Illuminate\Support\Facades\Route;

Route::controller(CategoriesContoller::class)
->prefix('/categories')
->middleware('auth:sanctum')
->group(function() {
    Route::get('/', 'index')->name('category.index');
    Route::post('/', 'store')->name('category.store');
    Route::delete('/{category}', 'delete')->name('category.delete');
});