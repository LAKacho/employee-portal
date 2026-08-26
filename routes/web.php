<?php
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/hello', [EmployeeController::class, 'hello']);


Route::get('/employees-list', [EmployeeController::class, 'list']);



Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (\Illuminate\Http\Request $request) {
     $credentials = $request->only('email', 'password');

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        return redirect('/employees-list');
    }

    return response()->json(['message' => 'Неверный email или пароль'], 401);
});
