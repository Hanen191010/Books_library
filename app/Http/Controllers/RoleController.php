<?php

// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller {

    public function index() {
        return Role::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'nullable',
        ]);

        $role = Role::create($request->all());
        return response()->json($role, 201);
    }

    public function attachPermission(Request $request, Role $role) {
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role->permissions()->attach($request->permission_id);
        return response()->json(['message' => 'Permission added to role'], 200);
    }
/**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    { 

        $request->validate([
            'name' => 'nullable|string|max:20|unique:roles,name', 
            'description' =>'nullable|string|max:255'
        ]);

        $role->update($request->all());

        return response()->json($role, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(null, 204);
    }
}
