<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementAccess\StoreMenuGroupRequest;
use App\Http\Requests\ManagementAccess\UpdateMenuGroupRequest;
use App\Models\ManagementAccess\MenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class MenuGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuGroups = MenuGroup::orderBy('order')->get();
        $permissions = Permission::orderBy('name')->get();
        $routes = Route::getRoutes();

        return view('management-access.menu.index', compact('menuGroups', 'permissions', 'routes'));
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
    public function store(StoreMenuGroupRequest $request)
    {
        $request['order'] = MenuGroup::max('order') + 1;

        MenuGroup::create(array_merge(
            $request->all(),

            array('status' => ! blank($request->status) ? true : false),
            array('child_menu' => ! blank($request->child_menu) ? true : false),
        ));

        return back()->with('success', 'Menu Group has been created successfully!');
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
    public function update(UpdateMenuGroupRequest $request, MenuGroup $menu)
    {
        $newOrder = $request->input('order');
        $oldOrder = $menu->order;

        if (! is_null($newOrder) && $newOrder !== $oldOrder) {
            if ($newOrder < $oldOrder) {
                $menu->where('order', '>=', $newOrder)
                    ->where('order', '<', $oldOrder)
                    ->increment('order');
            } elseif ($newOrder > $oldOrder) {
                $menu->where('order', '<=', $newOrder)
                    ->where('order', '>', $oldOrder)
                    ->decrement('order');
            }
        }


        $menu->update(array_merge(
            $request->all(),
            array('status' => ! blank($request->status) ? true : false),
            array('child_menu' => ! blank($request->child_menu) ? true : false),
        ));

        return back()->with('success', 'Menu group has been updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuGroup $menu)
    {
        if ($menu->items()->count() > 0) {
            return back()->with('error', 'Menu group cannot be deleted because it has menu items!');
        }


        $oldOrder = $menu->order;
        $menu->where('order', '>', $oldOrder)
            ->decrement('order');

        $menu->delete();

        return back()->with('success', 'Menu group has been deleted successfully!');
    }
}
