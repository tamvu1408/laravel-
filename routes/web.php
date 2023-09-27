<?php

// use App\Models\User;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/employee', [UserController::class, 'index'])->name('employee.index');
    Route::get('/employee/{user}', [UserController::class, 'show'])->name('employee.show');
    Route::post('/employee/update/{user}', [UserController::class, 'update'])->name('employee.update');
    Route::post('/employee/delete/{user}', [UserController::class, 'delete'])->name('employee.delete');
    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
});
