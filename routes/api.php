<?php

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\ChatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cart', function () {
    $data = session()->get('cart');
    // $data = [
    //     'asd' => 'asd',
    // ];
    echo json_encode($data);
});

Route::get('/search', [ApiController::class, 'search']);
Route::post('/profileUpdate', [ApiController::class, 'profile']);

Route::get('/getUser', [AuthController::class, 'getUser']);
