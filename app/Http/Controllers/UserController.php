<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade for password hashing
use App\Services\UserService; // Import the UserService class
use App\Http\Requests\User\StoreRequest; // Import the StoreRequest for validation
use App\Http\Requests\User\UpdateRequest; // Import the UpdateRequest for validation

class UserController extends Controller 
{ 
    protected $UserService; // Declare the UserService property

    // Dependency Injection of UserService
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService; // Assign the injected UserService
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Fetch all users with their associated roles
        return User::with('roles')->get(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) {
        // Validate the incoming request using the StoreRequest
        $data = $request->validated();

        // Create a new user using the UserService
        $user = $this->UserService->createUser($data);

        // Check if user creation was successful
        if (!$user) {
            return response()->json(['error' => 'Created failed'], 422); // Return an error response if creation failed
        }

        // Return the newly created user with a 201 Created status code
        return response()->json($user, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Return the requested user as JSON
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    { 
        // Validate the incoming request using the UpdateRequest
        $data = $request->validated();

        // Update the user using the UserService
        $updatedUser = $this->UserService->updateUser($user, $data);

        // Check if update was successful
        if (!$updatedUser) {
            return response()->json(['error' => 'Updated failed'], 422); // Return an error response if update failed
        }
        // Return the updated user with a 201 Created status code
        return response()->json($updatedUser, 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the user using the UserService
        $deleted = $this->UserService->deleteUser($user);

        // Check if deletion was successful
        if (!$deleted) {
            return response()->json(['error' => 'Deleted failed'], 422); // Return an error response if deletion failed
        }

        // Return a 204 No Content status code to indicate successful deletion
        return response()->json(null, 204); 
    }
}