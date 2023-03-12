<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $viewPostsPermission   = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $viewUsersPermission   = Permission::create(['name' => 'View users']);
        $creaUsersPermission   = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $admin = new User;
        $admin->name = 'Arnaldo Bonillo';
        $admin->email = 'arnaldo@mail.com';
        $admin->password = 'admin1';
        $admin->save();

        $admin->assignRole($adminRole);
        $admin->givePermissionTo($viewPostsPermission);   
        $admin->givePermissionTo($createPostsPermission); 
        $admin->givePermissionTo($updatePostsPermission); 
        $admin->givePermissionTo($deletePostsPermission); 

       

        $writer = new User;
        $writer->name = 'Yuney Herrera';
        $writer->email = 'yuney@mail.com';
        $writer->password = 'admin2';
        $writer->save();

        $writer->assignRole($writerRole);
        $writer->givePermissionTo($viewPostsPermission);  
    }
}
