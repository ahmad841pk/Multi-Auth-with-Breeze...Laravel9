<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//............Admin Route..........

     Route::controller(AdminController::class)->group(function (){
         Route::prefix('/admin')->group(function (){


         Route::get('/login', 'index')->name('login_form');
         Route::post('/login/owner', 'Login')->name('admin.login');
         Route::get('/dashboard', 'Dashboard')->name('admin.dashboard')->middleware('admin');
         Route::get('/logout', 'logOut')->name('admin.logout');
         Route::get('/register', 'adminRegister')->name('admin.register');
         Route::post('/register/create', 'adminRegisterCreate')->name('admin.register.create');

     });



 });

//............End Admin Route..........

//............Seller Route..........

Route::controller(SellerController::class)->group(function (){
    Route::prefix('/seller')->group(function (){


        Route::get('/login', 'index')->name('seller_login_form');
        Route::post('/login/owner', 'sellerLogin')->name('seller.login');
        Route::get('/dashboard', 'sellerDashboard')->name('seller.dashboard')->middleware('seller');
        Route::get('/logout', 'sellerLogOut')->name('seller.logout');
        Route::get('/register', 'sellerRegister')->name('seller.register');
        Route::post('/register/create', 'sellerRegisterCreate')->name('seller.register.create');

    });



});

//............End Seller Route..........


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
