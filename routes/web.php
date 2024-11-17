<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EmployeeController,
                            AuthController,
                            DepartmentController,
                            TaskController,
                            AssignTaskController};


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/employees', EmployeeController::class);
    Route::get('get-managers/{id}', [EmployeeController::class, 'getManagersByDepartment']);
    Route::resource('/departments', DepartmentController::class);
    Route::resource('/tasks', TaskController::class);
    Route::resource('/assign-tasks', AssignTaskController::class);
});

