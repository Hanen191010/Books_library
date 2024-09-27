<?php

// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Services\RoleService; // Import the RoleService class
use App\Http\Requests\Role\StoreRequest; // Import the StoreRequest for validation
use App\Http\Requests\Role\UpdateRequest; // Import the UpdateRequest for validation

class RoleController extends Controller {

    protected $RoleService; // Declare the RoleService property

    // Dependency Injection of RoleService
    public function __construct(RoleService $RoleService)
    {
        $this->RoleService = $RoleService; // Assign the injected RoleService
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Fetch all roles
        return Role::all(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) {
        // Validate the incoming request using the StoreRequest
        $data = $request->validated();

        // Create a new role using the RoleService
        $role = $this->RoleService->createRole($data);

        // Check if role creation was successful
        if (!$role) {
            return response()->json(['error' => 'Created failed'], 422); // Return an error response if creation failed
        }

        // Return the newly created role with a 201 Created status code
        return response()->json($role, 201); 
    }

    /**
     * Attach a permission to a role.
     */
    public function attachPermission(Request $request, Role $role) {
        // Validate the incoming request 
        $request->validate([
            'permission_id' => 'required|exists:permissions,id', // Ensure permission_id exists in the permissions table
        ]);

        // Attach the permission to the role
        $role->permissions()->attach($request->permission_id);

        // Return a success message with a 200 OK status code
        return response()->json(['message' => 'Permission added to role'], 200); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        // Return the requested role as JSON
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Role $role)
    { 
        // Validate the incoming request using the UpdateRequest
        $data = $request->validated();

        // Update the role using the RoleService
        $updated_Role = $this->RoleService->updateRole($role, $data);

        // Check if update was successful
        if (!$updated_Role) {
            return response()->json(['error' => 'Updated failed'], 422); // Return an error response if update failed
        }

        // Return the updated role with a 201 Created status code
        return response()->json($updated_Role, 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Delete the role using the RoleService
        $deleted = $this->RoleService->deleteRole($role);

        // Check if deletion was successful
        if (!$deleted) {
            return response()->json(['error' => 'Deleted failed'], 422); // Return an error response if deletion failed
        }

        // Return a 204 No Content status code to indicate successful deletion
        return response()->json(null, 204); 
    }
}