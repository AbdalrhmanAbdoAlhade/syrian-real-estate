<?php

use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\PropertyMediaController;
use App\Http\Controllers\Api\SectionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/properties', [PropertyController::class, 'index']);
Route::get('/properties/{property}', [PropertyController::class, 'show']);

Route::get('/sections', [SectionController::class, 'index']);
Route::get('/sections/{section}', [SectionController::class, 'show']);

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::put('/properties/{property}', [PropertyController::class, 'update']);
    Route::patch('/properties/{property}', [PropertyController::class, 'update']);
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy']);

    Route::prefix('properties/{property}')->group(function () {
        Route::post('/media', [PropertyMediaController::class, 'store']);
        Route::delete('/media/{media}', [PropertyMediaController::class, 'destroy']);
        Route::put('/media/{media}/cover', [PropertyMediaController::class, 'cover']);
        Route::post('/media/reorder', [PropertyMediaController::class, 'reorder']);
    });
});

Route::post('/login', function (Request $request) {
    $request->validate(['email' => 'required|email', 'password' => 'required']);
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'بيانات الدخول غير صحيحة'], 401);
    }
    if (! $user->is_admin) {
        return response()->json(['message' => 'غير مصرح - حسابك ليس مشرفاً'], 403);
    }
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
    ]);
});
