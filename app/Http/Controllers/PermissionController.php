<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\PermissionService; // Import the PermissionService class
use App\Http\Requests\Permission\StoreRequest; // Import the StoreRequest for validation
use App\Http\Requests\Permission\UpdateRequest; // Import the UpdateRequest for validation

class PermissionController extends Controller
{
    protected $PermissionService; // Declare the PermissionService property

    // Dependency Injection of PermissionService
    public function __construct(PermissionService $PermissionService)
    {
        $this->PermissionService = $PermissionService; // Assign the injected PermissionService
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all permissions with their associated roles
        return Permission::with('roles')->get(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Validate the incoming request using the StoreRequest
        $data = $request->validated();

        // Create a new permission using the PermissionService
        $permission = $this->PermissionService->createPermission($data);

        // Check if permission creation was successful
        if (!$permission) {
            return response()->json(['error' => 'Created failed'], 422); // Return an error response if creation failed
        }

        // Return the newly created permission with a 201 Created status code
        return response()->json($permission, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        // Return the requested permission as JSON
        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        // Validate the incoming request using the UpdateRequest
        $data = $request->validated();

        // Update the permission using the PermissionService
        $permission_update = $this->PermissionService->updatePermission($permission, $data);

        // Check if update was successful
        if (!$permission_update) {
            return response()->json(['error' => 'Updated failed'], 422); // Return an error response if update failed
        }

        // Return the updated permission with a 201 Created status code
        return response()->json($permission_update, 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        // Delete the permission using the PermissionService
        $deleted = $this->PermissionService->deletePermission($permission);

        // Check if deletion was successful
        if (!$deleted) {
            return response()->json(['error' => 'Deleted failed'], 422); // Return an error response if deletion failed
        }

        // Return a 204 No Content status code to indicate successful deletion
        return response()->json(null, 204); 
    }
}