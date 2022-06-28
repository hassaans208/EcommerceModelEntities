<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $data = User::all();
    return view('admin.index', compact('data'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group( function() {

    Route::controller(AdminController::class)->group(function () {
        Route::get('admin/profile', 'Profile')->name('admin.profile');
        Route::get('admin/users/view', 'viewUsers')->name('admin.viewUser');
        Route::get('admin/logout', 'Destroy')->name('admin.logout');
        
        Route::get('admin/users/delete/{id}', 'deleteUsers')->name('user.delete');

        Route::get('admin/brand/view', 'Brandview')->name('user.Brandview');
        Route::post('admin/brand/add', 'Brandadd')->name('user.Brandadd');
        Route::post('admin/brand/editPost/{id}', 'BrandEditPost')->name('user.Brandedit');
        Route::get('admin/brand/delete/{id}', 'BrandDelete')->name('brand.delete');
        Route::get('admin/brand/edit/{id}', 'BrandEdit')->name('brand.edit');

    
    });
});

require __DIR__.'/auth.php';
