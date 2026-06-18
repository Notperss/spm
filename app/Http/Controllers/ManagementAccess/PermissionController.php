<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementAccess\StorePermissionRequest;
use App\Http\Requests\ManagementAccess\UpdatePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {

        $permissions = Permission::with([
            'roles' => function ($query) {
                $query->select('id', 'name');
            }
        ])
            ->orderBy('name')
            ->get();


        $roles = Role::orderBy('name')->get();

        return view('management-access.permission.index', compact('permissions', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated())
                ?->assignRole(! blank($request->roles) ? $request->roles : array());

        return back()->with('success', 'Permission has been created successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated())
            && $permission->syncRoles(! blank($request->roles) ? $request->roles : array());

        return back()->with('success', 'Permission has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Permission has been deleted successfully!');
    }
}
