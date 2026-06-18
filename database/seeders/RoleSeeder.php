<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        //permission for user
        $permissionUser = [
            'menu.dashboard',
            'dashboard.index',
            // 'menu.folder',
            // 'folder.index',
            // 'folder.store',
            // 'folder.update',
            // 'folder.destroy',

            // 'document.index',
            // 'document.store',
            // 'document.update',
            // 'document.destroy',
        ];

        $superadmin = Role::create(['name' => 'super-admin',]);
        // $user = Role::create(['name' => 'user']);
        $user1 = Role::create(['name' => 'user-1']);
        $user2 = Role::create(['name' => 'user-2']);

        $makeSuperAdmin = User::factory()->create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            // 'profile_photo_path' => 'dist\assets\static\images\faces\1.png',
            'email' => 'super@admin.com',
        ]);

        $makeUser1 = User::factory()->create([
            'company_id' => 1,
            'name' => 'user-1',
            'username' => 'user1',
            // 'profile_photo_path' => 'dist\assets\static\images\faces\2.png',
            'email' => 'user@user.com',
        ]);

        $makeUser2 = User::factory()->create([
            'company_id' => 2,
            'name' => 'user-2',
            'username' => 'user2',
            // 'profile_photo_path' => 'dist\assets\static\images\faces\3.png',
            'email' => 'user@users.com',
        ]);

        $makeSuperAdmin->assignRole($superadmin);
        $makeUser1->assignRole($user1);
        $makeUser2->assignRole($user2);

        $superadmin->givePermissionTo(Permission::all());
        $user1->givePermissionTo([
            $permissionUser,
        ]);
        $user2->givePermissionTo([
            $permissionUser,
        ]);
    }
}







