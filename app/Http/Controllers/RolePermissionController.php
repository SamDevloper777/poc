<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    // Show all roles with their permissions
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('role-permission', compact('roles', 'permissions'));
    }

    // Show create role form
    public function createRole()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    // Store role
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('role-permission.index')->with('success', 'Role created successfully.');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role->name = $request->name;
    $role->save();

    
    $permissions = Permission::whereIn('id', $request->permissions ?? [])->pluck('name')->toArray();

   
    $role->syncPermissions($permissions);

    return redirect()->route('role-permission.index')->with('success', 'Role updated successfully.');
    }

   
    public function createPermission()
    {
        return view('permissions.create');
    }

 
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions'
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('role-permission.index')->with('success', 'Permission created successfully.');
    }
}
