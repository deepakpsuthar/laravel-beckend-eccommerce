<?php
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ProductController;


Route::middleware(['guest'])->prefix('admin')->group(function () {
    Route::get('/login',[AuthController::class,'index'])->name('admin.login');
    Route::post('/login',[AuthController::class,'login'])->name('admin.attempt');
});
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth'
], function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('users/bulkdelete',[UserController::class,'bulkDelete'])->name('users.bulkdelete');
    Route::resource('users',UserController::class);
    Route::resource('product/categories',CategoryController::class);
    Route::resource('products',ProductController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('settings',SettingController::class);

});
