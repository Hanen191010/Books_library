<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import the Log facade

class RoleService
{
    /*
     * Create a new role.
     *
     * @param array $data The data for the new role.
     * @return Role|false The newly created role object or false if an error occurred.
     */
    public function createRole(array $data)
    {
        try {
            // Create the role using the provided data
            $role = Role::create($data);

            // Return the newly created role object
            return $role;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to create role: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Update an existing role.
     *
     * @param Role $role The role object to update.
     * @param array $data The data to update the role with.
     * @return Role|false The updated role object or false if an error occurred.
     */
    public function updateRole(Role $role, array $data)
    {
        try {
            // Update the role with the provided data
            $role->update($data);

            // Return the updated role object
            return $role;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to update role: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Delete a role.
     *
     * @param Role $role The role object to delete.
     * @return bool True if the role was deleted successfully, false if an error occurred.
     */
    public function deleteRole(Role $role)
    {
        try {
            // Delete the role from the database
            $role->delete();

            // Return true to indicate successful deletion
            return true;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to delete role: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }
}
