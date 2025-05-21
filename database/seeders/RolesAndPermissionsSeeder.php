<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // bom mstr
        Permission::create(['name' => 'engineeering.bommstr.create']);
        Permission::create(['name' => 'engineeering.bommstr.read']);
        Permission::create(['name' => 'engineeering.bommstr.update']);
        Permission::create(['name' => 'engineeering.bommstr.delete']);

        // item mstr
        Permission::create(['name' => 'engineeering.itemmstr.create']);
        Permission::create(['name' => 'engineeering.itemmstr.read']);
        Permission::create(['name' => 'engineeering.itemmstr.update']);
        Permission::create(['name' => 'engineeering.itemmstr.delete']);

        // sales mstr
        Permission::create(['name' => 'sales.salesmstr.create']);
        Permission::create(['name' => 'sales.salesmstr.read']);
        Permission::create(['name' => 'sales.salesmstr.update']);
        Permission::create(['name' => 'sales.salesmstr.delete']);

        // purchase mstr
        Permission::create(['name' => 'purchase.purchasemstr.create']);
        Permission::create(['name' => 'purchase.purchasemstr.read']);
        Permission::create(['name' => 'purchase.purchasemstr.update']);
        Permission::create(['name' => 'purchase.purchasemstr.delete']);

        // material requisition
        Permission::create(['name' => 'ppic.mrmstr.create']);
        Permission::create(['name' => 'ppic.mrmstr.read']);
        Permission::create(['name' => 'ppic.mrmstr.update']);
        Permission::create(['name' => 'ppic.mrmstr.delete']);

        // inventory detail
        Permission::create(['name' => 'ppic.indet.create']);
        Permission::create(['name' => 'ppic.indet.read']);
        Permission::create(['name' => 'ppic.indet.update']);
        Permission::create(['name' => 'ppic.indet.delete']);

        // user mstr
        Permission::create(['name' => 'config.user.create']);
        Permission::create(['name' => 'config.user.read']);
        Permission::create(['name' => 'config.user.update']);
        Permission::create(['name' => 'config.user.delete']);

        // role mstr
        Permission::create(['name' => 'config.role.create']);
        Permission::create(['name' => 'config.role.read']);
        Permission::create(['name' => 'config.role.update']);
        Permission::create(['name' => 'config.role.delete']);

        // permission mstr
        Permission::create(['name' => 'config.permission.create']);
        Permission::create(['name' => 'config.permission.read']);
        Permission::create(['name' => 'config.permission.update']);
        Permission::create(['name' => 'config.permission.delete']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());

        // or may be done by chaining
        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::where('name', 'not like', '%.delete')->get();
        $role->givePermissionTo($permissions);

        // this can be done as separate statements
        $role = Role::create(['name' => 'user']);
        $permissions = Permission::where('name', 'like', '%.read')->get();
        $role->givePermissionTo($permissions);
    }
}
