<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import the Log facade

class UserService
{
    /**
     * Create a new user.
     *
     * @param array $data The data for the new user.
     * @return User|false The newly created user object or false if an error occurred.
     */
    public function createUser(array $data)
    {
        try {
            // Create the user using the provided data, hashing the password
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // Use Hash::make() for password hashing
            ]);

            // Attach the user to the project with their role
            $user->roles()->attach([$data['role_id']]);

            // Return the newly created user object
            return $user;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to create user: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /**
     * Update an existing user.
     *
     * @param User $user The user object to update.
     * @param array $data The data to update the user with.
     * @return User|false The updated user object or false if an error occurred.
     */
    public function updateUser(User $user, array $data)
    {
        try {
            // Update the user with the provided data
            $user->update($data);
            
            // Return the updated user object
            return $user;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to update user: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /**
     * Delete a user.
     *
     * @param User $user The user object to delete.
     * @return bool True if the user was deleted successfully, false if an error occurred.
     */
    public function deleteUser(User $user)
    {
        try {
            // Delete the user from the database
            $user->delete();

            // Return true to indicate successful deletion
            return true;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to delete user: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }
}
