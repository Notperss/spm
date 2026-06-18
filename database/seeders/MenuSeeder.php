<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementAccess\MenuItem;
use App\Models\ManagementAccess\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuMain = MenuGroup::create([
            'name' => 'Dashboard',
            'icon' => 'bi-house-door-fill',
            'permission_name' => 'menu.dashboard',
            'route' => 'dashboard.index',
            'order' => 1,
            'child_menu' => false,
        ]);

        // MenuItem::create([
        //     'name' => 'Dashboard',
        //     // 'icon' => 'ri-shield-star-line',
        //     'route' => 'dashboard.index',
        //     'permission_name' => 'dashboard.index',
        //     'menu_group_id' => $menuMain->id,
        //     'order' => 1,
        // ]);

        $menuRolePermission = MenuGroup::create([
            'name' => 'Roles & Permissions',
            'icon' => 'bi-shield-lock',
            'permission_name' => 'menu.role-permission',
            'order' => 3,
            'child_menu' => true,
        ]);

        MenuItem::create([
            'name' => 'Permissions',
            // 'icon' => 'ri-shield-star-line',
            'route' => 'permission.index',
            'permission_name' => 'permission.index',
            'menu_group_id' => $menuRolePermission->id,
            'order' => 1,
        ]);

        MenuItem::create([
            'name' => 'Roles',
            // 'icon' => 'ri-shield-user-line',
            'route' => 'role.index',
            'permission_name' => 'role.index',
            'menu_group_id' => $menuRolePermission->id,
            'order' => 2,
        ]);

        $menuAccess = MenuGroup::create([
            'name' => 'Access Management',
            'icon' => 'bi-gear',
            'permission_name' => 'menu.access-management',
            'order' => 4,
            'child_menu' => true,
        ]);

        MenuItem::create([
            'name' => 'User Management',
            // 'icon' => 'ri-file-user-line',
            'route' => 'user.index',
            'permission_name' => 'user.index',
            'menu_group_id' => $menuAccess->id,
            'order' => 1,
        ]);

        MenuItem::create([
            'name' => 'Route Management',
            // 'icon' => 'ri-settings-2-line',
            'route' => 'route.index',
            'permission_name' => 'route.index',
            'menu_group_id' => $menuAccess->id,
            'order' => 2,
        ]);


        MenuItem::create([
            'name' => 'Menu Management',
            // 'icon' => 'ri-menu-line',
            'route' => 'menu.index',
            'permission_name' => 'menu-group.index',
            'menu_group_id' => $menuAccess->id,
            'order' => 3,
        ]);

        $workUnit = MenuGroup::create([
            'name' => 'Work Unit',
            'icon' => 'bi-people-fill',
            'permission_name' => 'menu.work-unit',
            'order' => 2,
            'child_menu' => true,
        ]);

        MenuItem::create([
            'name' => 'Companies',
            // 'icon' => 'ri-shield-star-line',
            'route' => 'company.index',
            'permission_name' => 'company.index',
            'menu_group_id' => $workUnit->id,
            'order' => 1,
        ]);

        $activityLogs = MenuGroup::create([
            'name' => 'Activity Logs',
            'icon' => 'bi-clock-history',
            'permission_name' => 'menu.activity-log',
            'route' => 'activity-log.index',
            'order' => 6,
            'child_menu' => false,
        ]);

    }
}
