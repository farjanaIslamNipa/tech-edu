<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // role
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            // admin
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            // client
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            // course category
            'course-category-list',
            'course-category-create',
            'course-category-edit',
            'course-category-delete',
            // course module
            'course-module-list',
            'course-module-create',
            'course-module-edit',
            'course-module-delete',
            // faqs
            'frequently-asked-question-list',
            'frequently-asked-question-create',
            'frequently-asked-question-edit',
            'frequently-asked-question-delete',
            // contact
            'contact-list',
            'contact-delete',
            // settings
            'setting-edit',
            // package
            'package-list',
            'package-create',
            'package-edit',
            'package-delete',
            // package subscription
            'package-subscription-list',
            'package-subscription-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
