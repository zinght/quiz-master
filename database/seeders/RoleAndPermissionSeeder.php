<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'view quizzes']);
        Permission::create(['name' => 'create quizzes']);
        Permission::create(['name' => 'take quizzes']);
        Permission::create(['name' => 'edit quizzes']);
        Permission::create(['name' => 'delete quizzes']);
        Permission::create(['name' => 'view quiz questions']);
        Permission::create(['name' => 'view quiz answers']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'view global results']);

        // create roles and assign created permissions

        // this can be done as separate statements



        // or may be done by chaining
        $administrator = Role::create(['name' => 'administrator'])
            ->givePermissionTo(['view quizzes', 'create quizzes', 'take quizzes', 'edit quizzes', 'delete quizzes', 'view quiz questions', 'view quiz answers', 'manage users', 'view global results']);
        $user = Role::create(['name' => 'user'])
            ->givePermissionTo(['view quizzes', 'take quizzes','view quiz questions', 'view quiz answers']);
        $restricted_user = Role::create(['name' => 'restricted user'])
            ->givePermissionTo(['view quizzes', 'take quizzes']);
    }
}
