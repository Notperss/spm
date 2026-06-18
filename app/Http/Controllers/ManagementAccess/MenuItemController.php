<?php

namespace App\Http\Controllers\ManagementAccess;

use App\Http\Controllers\Controller;
use App\Models\ManagementAccess\MenuGroup;
use App\Models\ManagementAccess\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MenuGroup $menu)
    {
        $menuItems = $menu->items()->orderBy('name')->get();

        $permissions = Permission::orderBy('name')->get();
        $routes = Route::getRoutes();

        return view('management-access.menu.item.index', compact('menu', 'menuItems', 'permissions', 'routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(MenuGroup $menuGroup)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MenuGroup $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'permission_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $request['order'] = $menu->items()->max('order') + 1;

        $request['status'] = ! blank($request->status) ? true : false;

        // dd($request->all());

        $menu->items()->create($request->all());

        return back()->with('success', 'Menu item has been created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        // $permissions = Permission::orderBy('name')->get();
        // $routes = Route::getRoutes();

        // return view('management-access.menu.item.edit', compact('menuItem', 'permissions', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuGroup $menu, MenuItem $item, Request $request, )
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'permission_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $newOrder = $request->input('order');
        $oldOrder = $item->order;

        if (! is_null($newOrder) && $newOrder !== $oldOrder) {
            if ($newOrder < $oldOrder) {
                $menu->items()
                    ->where('order', '>=', $newOrder)
                    ->where('order', '<', $oldOrder)
                    ->increment('order');
            } elseif ($newOrder > $oldOrder) {
                $menu->items()
                    ->where('order', '<=', $newOrder)
                    ->where('order', '>', $oldOrder)
                    ->decrement('order');
            }
        }

        $item->update($request->all());

        return back()->with('success', 'Menu item has been updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuGroup $menu, MenuItem $item)
    {
        $oldOrder = $item->order;
        $menu->items()
            ->where('order', '>', $oldOrder)
            ->decrement('order');

        $item->delete();

        return back()->with('success', 'Menu item has been deleted successfully!');
    }

    /**
     * Display a listing of the resource.
     */

}
