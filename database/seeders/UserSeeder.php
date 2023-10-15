<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $admin_assignRole=Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'end-user']);

        // Define permissions (assuming you have routes or actions named like this)
        Permission::create(['name' => 'access login']);
        Permission::create(['name' => 'access signup']);
        Permission::create(['name' => 'access product_master']);
        Permission::create(['name' => 'access category_master']);
        Permission::create(['name' => 'access product_listing']);
        Permission::create(['name' => 'access product_details']);
        Permission::create(['name' => 'order']);
        Permission::create(['name' => 'checkout']);

        // Assign permissions to roles
        $superAdmin = Role::findByName('super-admin');
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::findByName('admin');
        $admin->givePermissionTo([
            'access login',
            'access signup',
            'access product_master',
            'access category_master',
        ]);

        $endUser = Role::findByName('end-user');
        $endUser->givePermissionTo([
            'access product_listing',
            'access product_details',
            'order',
            'checkout',
        ]);
        $admin=User::create([
            'name'=>'Dilip',
            'email'=>'dilip@gmail.com',
            'password'=>bcrypt('123456')
        ]);
        $admin->assignRole($admin_assignRole);
    }
}
