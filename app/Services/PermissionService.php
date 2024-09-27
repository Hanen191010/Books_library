<?php

namespace App\Services;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Import the Log facade

class PermissionService
{
    /*
     * Create a new permission.
     *
     * @param array $data The data for the new permission.
     * @return Permission|false The newly created permission object or false if an error occurred.
     */
    public function createPermission(array $data)
    {
        try {
            // Create the permission using the provided data
            $Permission = Permission::create($data);

            // Return the newly created permission object
            return $Permission;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to create permission: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Update an existing permission.
     *
     * @param Permission $permission The permission object to update.
     * @param array $data The data to update the permission with.
     * @return Permission|false The updated permission object or false if an error occurred.
     */
    public function updatePermission(Permission $permission, array $data)
    {
        try {
            // Update the permission with the provided data
            $permission->update($data);

            // Return the updated permission object
            return $permission;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to update permission: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }

    /*
     * Delete a permission.
     *
     * @param Permission $permission The permission object to delete.
     * @return bool True if the permission was deleted successfully, false if an error occurred.
     */
    public function deletePermission(Permission $permission)
    {
        try {
            // Delete the permission from the database
            $permission->delete();

            // Return true to indicate successful deletion
            return true;
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error when trying to delete permission: ' . $e->getMessage());

            // Return false to indicate an error occurred
            return false;
        }
    }
}
