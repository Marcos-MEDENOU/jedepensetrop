<?php

namespace Database\Seeders;

use BalajiDharma\LaravelMenu\Models\Menu;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminCoreSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'menu list',
            'menu create',
            'menu edit',
            'menu delete',
            'menu.item list',
            'menu.item create',
            'menu.item edit',
            'menu.item delete',
            'author list',
            'author delete',
            'author create',
            'author edit',
            'scrapping edit',
            'scrapping delete',
            'scrapping create',
            'scrapping list',
            'newsletter delete',
            'newsletter create',
            'newsletter list',
            'newsletter edit',
            'category delete',
            'category list',
            'category create',
            'category edit',
            'posts edit',
            'posts list',
            'posts delete',
            'posts create',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign existing permissions
        // $role1 = Role::create(['name' => 'writer']);
        // $role1->givePermissionTo('permission list');
        // $role1->givePermissionTo('role list');
        // $role1->givePermissionTo('user list');
        // $role1->givePermissionTo('menu list');
        // $role1->givePermissionTo('menu.item list');

        // $role2 = Role::create(['name' => 'admin']);
        // foreach ($permissions as $permission) {
        //     $role2->givePermissionTo($permission);
        // }

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $role1 = Role::create(['name' => 'user']);

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'superadmin@fr',
        ]);
        $user->assignRole($role3);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        // ]);
        // $user->assignRole($role2);

        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole($role1);

        // create menu
        // $super_admin_menu = Menu::create([
        //     'name' => 'Admin',
        //     'machine_name' => 'admin',
        //     'description' => 'Admin Menu',
        // ]);

        $super_admin_menu = Menu::create([
            'name' => 'super admin',
            'machine_name' => 'super-admin',
            'description' => 'super-admin Menu',
        ]);
        

        $none_menu = Menu::create([
            'name' => 'none',
            'machine_name' => 'none',
            'description' => 'none',
        ],);

        $user_menu = Menu::create([
            'name' => 'user',
            'machine_name' => 'user',
            'description' => 'user',
        ],);
        $none_menu_items = [];
        $none_menu->menuItems()->createMany($none_menu_items);
        $user_menu->menuItems()->createMany($none_menu_items);

       
        $super_admin_menu_items = [
            [
                'name' => 'Dashboard',
                'uri' => '/dashboard',
                'enabled' => 1,
                'weight' => 0,
                'icon'=>'mdiChartTimelineVariant'
            ],
            [
                'name' => 'Permissions',
                'uri' => '/<admin>/permission',
                'enabled' => 1,
                'weight' => 1,
                'icon'=>'mdiAccountEye'
            ],
            [
                'name' => 'Roles',
                'uri' => '/<admin>/role',
                'enabled' => 1,
                'weight' => 2,
                'icon'=>'mdiRobot'
            ],
            [
                'name' => 'Utilisateurs',
                'uri' => '/<admin>/user',
                'enabled' => 1,
                'weight' => 3,
                'icon'=>'mdiAccountGroup'
            ],
            [
                'name' => 'Menus',
                'uri' => '/<admin>/menu',
                'enabled' => 1,
                'weight' => 4,
                'icon'=>'mdiMenu'
            ],
            [
                'name' => 'Auteurs',
                'uri' => '/<admin>/author',
                'enabled' => 1,
                'weight' => 5,
                'icon'=>'mdiShapePlusOutline'
            ],
            [
                'name' => 'Articles',
                'uri' => '/<admin>/posts',
                'enabled' => 1,
                'weight' => 6,
                'icon'=>'mdiShapePlusOutline'
            ],
            [
                'name' => 'Newsletters',
                'uri' => '/<admin>/newsletter',
                'enabled' => 1,
                'weight' => 7,
                'icon'=>'mdiAccountKey'
            ],
            [
                'name' => 'Exttraction de data',
                'uri' => '/<admin>/scrapping',
                'enabled' => 1,
                'weight' => 8,
                'icon'=>'mdiPlus'
            ],
            [
                'name' => 'Catégorie',
                'uri' => '/<admin>/category',
                'enabled' => 1,
                'weight' => 8,
                'icon'=>'mdiPostageStamp'
            ],
        ];

        $super_admin_menu->menuItems()->createMany($super_admin_menu_items);
       

    }
}
