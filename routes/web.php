<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\clients\HomePage;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ChatController;
use App\Http\Controllers\admin\BillsController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\clients\CartController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\clients\AuthUserController;

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

Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'loginSubmit'])->name('admin.loginSubmit');


Route::middleware('checkAuth')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.Dashboard');
    })->name('home');

    // create employees 

    // Route::prefix('user')->group(function () {
    //     Route::get('/', [AuthController::class, 'index'])->name('admin.user');
    //     Route::get('create', [AuthController::class, 'createUser'])->name('employees.create');
    // })->middleware('checkRoles:admin');

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::resource('categories', CategoriesController::class)->names([
        'index' => 'homeCate',
        'create' => 'addCate',
        'edit' => 'editCate',
        'destroy' => 'deleteCate'
    ])->middleware('checkRoles:admin|nhanvien');
    Route::middleware('checkRoles:nhanvien|admin')->resource('products', ProductsController::class)->names([
        'index' => 'homeProduct',
    ]);

    Route::resource('bills', BillsController::class)->middleware('checkRoles:admin');
});

// client 


Route::get('/vue', function () {
    return view('welcome');
});

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

    Route::get('ProDetails/{id}', [HomePage::class, 'ProDetails'])->name('proDetails');
    Route::post('addCmt', [HomePage::class, 'addCmt'])->name('addCmt');
    Route::post('addCart/{id}', [CartController::class, 'addToCart'])->name('addCart');
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('deCart/{id}', [CartController::class, 'delToCart'])->name('delCart');
    Route::get('showCart', [CartController::class, 'cart'])->name('showCart');
    Route::get('buy', [CartController::class, 'buySubmit'])->name('buySubmit');
    Route::post('momoPay', [CartController::class, 'momo_payment'])->name('momoPay')->middleware('checkAuthUser');

    // 
    Route::get('product/{id?}', [HomePage::class, 'ListProduct'])->name('product');
});
