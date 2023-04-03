<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\dashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\StoresController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;

// Route::get('/dashboard', [dashboardController::class , 'index'] )
// ->middleware(['auth'])
// ->name('dashboard');

 // Route::resource('dashboard/Categories' , [CategoriesController::class]);

 // Route::get('dashboard','App\Http\Controllers\dashboardController@index')->middleware(['auth'])->name('dashboard');

// Route::resource('dashboard/Categories/',CategoriesController::class)->middleware(['auth']);

 Route::group([
    'middleware'=>['auth','CheckUserType:super-admin,admin,user','UpdateUserLastActiveAt'],
     'as'=>'dashboard.',
     'prefix'=>'dashboard',
],function(){
        // profile routes
        Route::get('profile',[ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile',[ProfileController::class, 'update'])->name('profile.update');


        Route::get('/', [dashboardController::class , 'index'] )
        ->name('dashboard');
        Route::get('/Categories/trash', [CategoriesController::class ,'trash'])
        ->name('Categories.trash');

        Route::put('/Categories/{Category}/restore', [CategoriesController::class ,'restore'])
        ->name('Categories.restore');

        Route::delete('/Categories/{Category}/force-delete', [CategoriesController::class ,'forcedelete'])
        ->name('Categories.forcedelete');


    Route::resource('/Categories',CategoriesController::class);
    Route::resource('/Products',ProductsController::class);
    Route::resource('/Stores',StoresController::class);

});



