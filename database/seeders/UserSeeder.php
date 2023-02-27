<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
                'id'                => 1,
                'first_name'        => 'Super',
                'last_name'         => 'Admin',
                'email'             => 'info@geekslearning.com.au',
                'phone_number'      => '0291600058',
                'password'          => bcrypt('admin@123')
        ]);

        $role = Role::create(['name' => 'Super Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $admin = Admin::create([
            'user_id'   => 1,
            'role_id'   => 1,
            'status'    => 1,
        ]);
    }
}
