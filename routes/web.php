<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\clients\HomePage;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ChatController;
use App\Http\Controllers\admin\BillsController;
use App\Http\Controllers\clients\CartController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\DasboardController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\clients\AuthUserController;
use App\Http\Controllers\admin\UserController;


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



// route admin

//login
Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'loginSubmit'])->name('admin.loginSubmit');

Route::group(['prefix' => 'admin', 'middleware' => 'checkAuth', 'as' => 'admin.'], function () {
    Route::get('/', [DasboardController::class, 'index'])->name('home');

    //logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');


    // create employees 



    Route::resource('user', UserController::class);

    Route::resource('category', CategoriesController::class);

    Route::resource('products', ProductsController::class);

    Route::resource('bills', BillsController::class);

    Route::resource('role', RoleController::class);


    // Route::get('chat', [ChatController::class, 'index'])->name('chat');
    Route::post('chat/send-message/{id?}', [ChatController::class, 'sendMessage'])->name('send.message');
    Route::get('chat/{id?}', [ChatController::class, 'chatPrivate'])->name('chat.private');
});

// client 



Route::prefix('/')->group(function () {
    Route::get('/', [HomePage::class, 'index'])->name('homepage');
    //login 
    Route::get('login', [AuthUserController::class, 'login'])->name('user.login');
    Route::post('login', [AuthUserController::class, 'loginSubmit'])->name('user.loginSubmit');
    //signup
    Route::get('signup', [AuthUserController::class, 'signup'])->name('user.signup');
    Route::post('signup', [AuthUserController::class, 'signupSubmit'])->name('user.signupSubmit');
    // logout
    Route::delete('logout', [AuthUserController::class, 'logout'])->name('user.logout');

    // profile

    Route::get('profile', [AuthUserController::class, 'profile'])->name('user.profile');

    Route::get('ProDetails/{id}', [HomePage::class, 'ProDetails'])->name('proDetails');
    Route::post('addCmt', [HomePage::class, 'addCmt'])->name('addCmt');
    Route::post('addCart/{id}', [CartController::class, 'addToCart'])->name('addCart');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('deCart/{id}', [CartController::class, 'delToCart'])->name('delCart');
    Route::get('showCart', [CartController::class, 'cart'])->name('showCart');
    Route::get('buy', [CartController::class, 'buySubmit'])->name('buySubmit');
    Route::post('momoPay', [CartController::class, 'momo_payment'])->name('momoPay')->middleware('checkAuthUser');

    // qr_code

    Route::get('qr_code', [CartController::class, 'createQR_CODE'])->name('bankPay');

    // 
    Route::get('product/{id?}', [HomePage::class, 'ListProduct'])->name('product');

    Route::get('search', [HomePage::class, 'search'],)->name('search');
});
