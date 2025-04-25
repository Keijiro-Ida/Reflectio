<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ReflectionController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index']);

Route::middleware(['web'])->post('/login', function(Request $request) {
    $credentials = $request->only('email', 'password');
    Log::info($credentials);
    if (!auth()->attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    return response()->json(auth()->user());
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::apiResource('reflections', ReflectionController::class);

});
