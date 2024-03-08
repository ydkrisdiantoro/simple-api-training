<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WilayahController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/user/me', [AuthController::class, 'user']);

Route::post('/employee/login', [EmployeeController::class, 'login']);

Route::get('/provincy', [WilayahController::class, 'provincy']);
Route::get('/regency/{provinceId}', [WilayahController::class, 'regency']);
Route::get('/district/{regencyId}', [WilayahController::class, 'district']);
Route::get('/village/{districtId}', [WilayahController::class, 'village']);
// Route::get('/student/{year?}/{count?}', [WilayahController::class, 'student']);

Route::resource('/student', StudentController::class);
