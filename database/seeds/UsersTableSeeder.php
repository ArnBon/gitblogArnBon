<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        User::truncate();

        $adminRole = Role::create(['name' => 'Admin']);
        $writerRole = Role::create(['name' => 'Writer']);

        $admin = new User;
        $admin->name = 'Arnaldo Bonillo';
        $admin->email = 'arnaldo@mail.com';
        $admin->password = bcrypt('admin1');
        $admin->save();

        $admin->assignRole($adminRole);

        $writer = new User;
        $writer->name = 'Yuney Herrera';
        $writer->email = 'yuney@mail.com';
        $writer->password = bcrypt('admin2');
        $writer->save();

        $writer->assignRole($writerRole);
    }
}
