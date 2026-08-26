<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::get('/employees/{id}', [EmployeeController::class, 'show']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->middleware('admin');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->middleware('admin');
    Route::post('/employees', [EmployeeController::class, 'store'])->middleware('admin');
    Route::get('/employees/{id}/certificates', [EmployeeController::class, 'certificates']);
});