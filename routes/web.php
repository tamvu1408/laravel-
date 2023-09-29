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
    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    Route::resource('users', UserController::class)->names([
        'index' => 'employee.index',
        'show' => 'employee.show',
        'create' => 'employee.create',
        'store' => 'employee.store',
        'update' => 'employee.update',
        'destroy' => 'employee.delete',
    ]);
});
