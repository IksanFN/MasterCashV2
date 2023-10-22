<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query()->latest()->paginate();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->permission;
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        Alert::success('Success', 'Role Created Successfully');
        return to_route('roles.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = $role->permissions;
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
        //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //     ->all();
        return view('roles.edit', compact('role','permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        // $permissionExist = DB::table('model_has_permissions')->where()
        // if ($role->hasPermissionTo($request->permission)) {
        //     Alert::warning('Information', 'Permission has been taken');
        //     return back();
        // }

        $role->name = $request->name;
        $role->save();
    
        $role->syncPermissions($request->permission);

        Alert::success('Success', 'Role Updated Successfully');
        return to_route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Alert::success('Success', 'Role Deleted Successfully');
        return view('roles.index');
    }

    public function destroyPermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            Alert::success('Success', 'Permission in Role deleted successfully');
            return back();
        }

        Alert::success('Success', 'Permission in Role deleted successfully');
        return back();
    }
}
