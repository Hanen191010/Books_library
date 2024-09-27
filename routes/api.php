<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

// Grouping routes related to authentication
Route::controller(AuthController::class)->group(function () {
    // Route for user login
    Route::post('login', 'login');
    // Route for user registration
    Route::post('register', 'register');
    // Route for user logout
    Route::post('logout', 'logout');
    // Route to refresh authentication token
    Route::post('refresh', 'refresh');
});

// Middleware group to protect routes that require authentication
Route::middleware('auth:api')->group(function () {

    // Resource routes for managing users
    Route::apiResource('users', UserController::class);
    // Resource routes for managing roles
    Route::apiResource('roles', RoleController::class);
    // Resource routes for managing permissions
    Route::apiResource('permissions', PermissionController::class);
    
    // Route to attach permissions to a specific role
    Route::post('roles/{role}/permissions', [RoleController::class, 'attachPermission']);
    
    // Middleware to restrict access to users with the 'manage-categories' permission
    Route::middleware('permission:manage-categories')->group(function () {
        // Resource routes for managing categories
        Route::apiResource('categories', CategoryController::class);
    });
    
    // Middleware to restrict access to users with the 'manage-books' permission
    Route::middleware('permission:manage-books')->group(function () {
        // Resource routes for managing books
        Route::apiResource('books', BookController::class);
    });
    
    // Route to retrieve books by a specific category ID
    Route::get('categories/{categoryId}/books', [BookController::class, 'indexByCategory']);
});
