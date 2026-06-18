<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementAccess\StoreUserRequest;
use App\Http\Requests\ManagementAccess\UpdateUserRequest;
use App\Models\User;
use App\Models\WorkUnit\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('roles', function ($query) {
                return $query->select('name');
            })
            ->latest()
            ->get();
        $roles = Role::orderBy('name')->get();
        $companies = Company::orderBy('name')->get();

        return view('management-access.user.index', compact('users', 'roles', 'companies'));
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
    public function store(StoreUserRequest $request)
    {
        User::create(array_merge(
            $request->all(),
            array(
                'password' => Hash::make('password'),
                'email_verified_at' => ! blank($request->verified) ? now() : null,
            )
        ))?->assignRole(! blank($request->role) ? $request->role : array());

        return back()->with('success', 'User has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, user $user)
    {
        $user->syncRoles($request->role);

        $emailExists = User::firstWhere('email', $request->email) !== null;
        $isSameEmail = $request->email === $user->email;

        $email = $isSameEmail || ! $emailExists ? $request->email : null;

        if ($email) {
            $user->update([
                'email' => $email,
                'email_verified_at' => $request->verified ? now() : null,
            ] + $request->except('email'));
        }

        return back()->with('success', 'User has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User has been deleted successfully!');
    }
}
